<?php

namespace console\controllers;

use common\services\FruitService;
use console\helpers\FruitClient;
use yii\console\Controller;

class FruitsController extends Controller
{
    private FruitClient $client;
    private FruitService $fruitService;

    public function __construct($id, $module, FruitClient $client, FruitService $fruitService, $config = []) {

        $this->client = $client;
        $this->fruitService = $fruitService;
        parent::__construct($id, $module, $config);
    }

    public function actionFetch()
    {
        $fruits = $this->client->getFruits();

        $this->fruitService->populateFruits($fruits);
    }
}