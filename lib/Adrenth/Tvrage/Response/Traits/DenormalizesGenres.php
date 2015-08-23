<?php

namespace Adrenth\Tvrage\Response\Traits;

use Adrenth\Tvrage\Show;

/**
 * Trait DenormalizesGenres
 *
 * Adds the ability to denormalize an array of genres and add it to the Show
 * object.
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Traits
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
trait DenormalizesGenres
{
    /**
     * Handle Genres
     *
     * @param Show  $show
     * @param array $genres
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function handleGenres(Show $show, $genres)
    {
        if (empty($genres)) {
            return;
        }

        if (!is_array($genres) || !array_key_exists('genre', $genres)) {
            return;
        }

        if (is_string($genres['genre'])) {
            $show->addGenre($genres['genre']);
        } elseif (is_array($genres['genre'])) {
            foreach ($genres['genre'] as $genre) {
                if (!empty($genre)) {
                    $show->addGenre($genre);
                }
            }
        }
    }
}
