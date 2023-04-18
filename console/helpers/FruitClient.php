<?php

namespace console\helpers;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use yii\helpers\Json;

class FruitClient
{
    private ClientInterface $client;
    private RequestFactoryInterface $requestFactory;

    public function __construct(ClientInterface $client, RequestFactoryInterface $requestFactory)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @return Fruit[]
     * @throws FruitException
     */
    public function getFruits() : array
    {
        $request = $this->requestFactory->createRequest('GET', 'https://fruityvice.com/api/fruit/all');
        $request->withHeader('content-type', 'application/json');

        try {
            $response = $this->client->sendRequest($request);

            $fruitsRaw = Json::decode($response->getBody()->getContents());
            $fruits = [];
            foreach ($fruitsRaw as $key => $value) {
                $fruits[] = new Fruit($value['id'], $value['name'], $value['family'], $value['nutritions']);
            }

            return $fruits;
        } catch (ClientExceptionInterface $e) {
            throw new FruitException($e->getMessage(), $e->getCode(), $e);
        }
    }
}