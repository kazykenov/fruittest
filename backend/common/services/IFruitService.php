<?php

namespace common\services;

use common\helpers\Fruit;
use yii\data\DataProviderInterface;

interface IFruitService
{
    /**
     * @param int $fruit_id
     * @return Fruit
     */
    public function getFruit(int $fruit_id) : Fruit;

    /**
     * @param int $page
     * @param array $filterBy
     * @return DataProviderInterface
     */
    public function getAllFruits(int $page, array $filterBy): DataProviderInterface;

    /**
     * @param Fruit[] $fruits
     */
    public function populateFruits(array $fruits) : void;
}
