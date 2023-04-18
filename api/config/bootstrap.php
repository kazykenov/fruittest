<?php

Yii::$container->set('common\repositories\IFruitRepository', ['class' => 'common\repositories\FruitRepository']);
Yii::$container->set('common\repositories\IFavoriteRepository', ['class' => 'common\repositories\FavoriteRepository']);
Yii::$container->set('common\services\IFruitService', ['class' => 'common\services\FruitService']);
Yii::$container->set('common\services\IFavoriteFruitService', ['class' => 'common\services\FavoriteFruitService']);