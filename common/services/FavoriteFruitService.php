<?php

namespace common\services;

use common\repositories\IFavoriteRepository;
use console\helpers\FavoriteFruit;
use yii\data\ArrayDataProvider;
use yii\data\DataProviderInterface;

class FavoriteFruitService implements IFavoriteFruitService
{
    private IFruitService $fruitService;
    private IFavoriteRepository $favoriteRepository;

    public function __construct(IFruitService $fruitService, IFavoriteRepository $favoriteRepository)
    {
        $this->fruitService = $fruitService;
        $this->favoriteRepository = $favoriteRepository;
    }

    public function getFruit(int $user_id, int $fruit_id): FavoriteFruit
    {
        $fruit = $this->fruitService->getFruit($fruit_id);

        $favoriteFruit = new FavoriteFruit($fruit);
        $favoriteFruit->isFavorite = $this->favoriteRepository->isFavorite($user_id, $fruit_id);

        return $favoriteFruit;
    }

    public function getAllFruits(int $user_id, int $page): DataProviderInterface // todo: add filterBy name and family
    {
        $dataProvider = $this->fruitService->getAllFruits($page, []);

        $models = [];
        foreach ($dataProvider->getModels() as $key => $value) {
            $models[$key] = new FavoriteFruit($value);
            $models[$key]->isFavorite = $this->favoriteRepository->isFavorite($user_id, $value->id);
        }

        return new ArrayDataProvider([
            'models' => $models,
            'keys' => $dataProvider->getKeys(),
            'sort' => $dataProvider->getSort(),
            'pagination' => $dataProvider->getPagination(),
            'totalCount' => $dataProvider->getTotalCount(),
        ]);
    }

    public function getFavoriteFruits($user_id) : array
    {
        $favoriteIds = $this->favoriteRepository->getFavorites($user_id);

        $dataProvider = $this->fruitService->getAllFruits(0, [
            'ids' => $favoriteIds
        ]);

        $models = [];
        foreach ($dataProvider->getModels() as $key => $value) {
            $models[$key] = new FavoriteFruit($value);
            $models[$key]->isFavorite = true;
        }

        return $models;
    }

    public function addToFavorite(int $user_id, FavoriteFruit $fruit) : void
    {
        $this->favoriteRepository->addToFavorite($user_id, $fruit->fruit->id);
    }

    public function removeFromFavorite(int $user_id, FavoriteFruit $fruit): void
    {
        $this->favoriteRepository->removeFromFavorite($user_id, $fruit->fruit->id);
    }
}
