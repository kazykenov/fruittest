<?php

Yii::$container->set('common\repositories\IFruitRepository', ['class' => 'common\repositories\FruitRepository']);
Yii::$container->set('common\repositories\IFruitService', ['class' => 'common\repositories\FruitService']);
//Yii::$container->set('yii\db\Connection', function() {
//    echo 123;
//    return Yii::$app->db;
//});
