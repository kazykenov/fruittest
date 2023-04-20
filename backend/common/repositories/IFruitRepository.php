<?php

namespace common\repositories;

use common\exceptions\FruitNotFoundException;
use common\helpers\Fruit;
use yii\data\DataProviderInterface;

interface IFruitRepository
{
    /**
     * @return Fruit
     * @throws FruitNotFoundException
     */
    public function getFruit(int $fruit_id) : Fruit;

    public function getFruits(int $page = 0, array $filterBy = []): DataProviderInterface;

    /**
     * @param Fruit[] $fruits
     *
     * @throws \yii\db\Exception
     */
    public function saveFruits(array $fruits) : void;
}
