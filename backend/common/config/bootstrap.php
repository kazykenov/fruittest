<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::$container->set('Psr\Http\Client\ClientInterface', ['class' => 'GuzzleHttp\Client']);
Yii::$container->set('Psr\Http\Message\RequestFactoryInterface', ['class' => 'GuzzleHttp\Psr7\HttpFactory']);