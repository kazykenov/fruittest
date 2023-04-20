<?php

namespace common\services;

use common\helpers\FavoriteFruit;
use common\helpers\Fruit;
use yii\data\DataProviderInterface;

interface IFavoriteFruitService
{
    /**
     * @param int $fruit_id
     * @return Fruit
     */
    public function getFruit(int $user_id, int $fruit_id) : FavoriteFruit;

    /**
     * @param int $page
     * @return DataProviderInterface
     */
    public function getAllFruits(int $user_id, int $page): DataProviderInterface;

    /**
     * @return Fruit[]
     */
    public function getFavoriteFruits(int $user_id) : array;

    /**
     * @param FavoriteFruit $fruit
     * @param int $user_id
     */
    public function addToFavorite(int $user_id, FavoriteFruit $fruit) : void;

    /**
     * @param FavoriteFruit $fruit
     * @param int $user_id
     */
    public function removeFromFavorite(int $user_id, FavoriteFruit $fruit) : void;
}
