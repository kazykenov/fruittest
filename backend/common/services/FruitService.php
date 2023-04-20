<?php

namespace common\services;

use common\repositories\IFruitRepository;
use common\helpers\Fruit;
use yii\data\DataProviderInterface;

class FruitService implements IFruitService
{
    private IFruitRepository $fruitRepository;

    public function __construct(IFruitRepository $fruitRepository)
    {
        $this->fruitRepository = $fruitRepository;
    }

    public function getFruit(int $fruit_id): Fruit
    {
        return $this->fruitRepository->getFruit($fruit_id);
    }

    public function getAllFruits(int $page, array $filterBy): DataProviderInterface
    {
        return $this->fruitRepository->getFruits($page, $filterBy);
    }

    /**
     * @param Fruit[] $fruits
     * @throws \yii\db\Exception
     */
    public function populateFruits(array $fruits) : void
    {
        $this->fruitRepository->saveFruits($fruits);
    }
}
