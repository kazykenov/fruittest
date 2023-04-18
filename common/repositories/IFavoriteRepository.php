<?php

namespace common\repositories;

interface IFavoriteRepository
{
    public function isFavorite($user_id, $id) : bool;

    public function getFavorites($user_id) : array;

    public function addToFavorite($user_id, $id) : void;

    public function removeFromFavorite($user_id, $id) : void;
}
