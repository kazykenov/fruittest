<?php

namespace console\controllers;

use common\services\FruitService;
use common\helpers\FruitClient;
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
//        var_dump($fruits);

//        try {
            $this->fruitService->populateFruits($fruits);
//        } catch (\Exception $e) {
//            $message = $e->getMessage();
//            echo "Unexpected error ${$message}";
//        }
//        echo $this->message . "\n";
    }
}