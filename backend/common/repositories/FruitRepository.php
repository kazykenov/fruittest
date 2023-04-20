<?php

namespace common\repositories;

use common\exceptions\FruitNotFoundException;
use common\helpers\Fruit;
use Exception;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use common\models\Fruit as DBFruit;
use yii\db\Connection;
use yii\helpers\Json;

class FruitRepository implements IFruitRepository
{
    private Connection $db;

    public function __construct()
    {
        $this->db = \Yii::$app->db;
    }

    public function getFruit(int $fruit_id): Fruit
    {
        if (($model = DBFruit::findOne(['id' => $fruit_id])) !== null) {
            return $this->fromDBFruit($model);
        }

        throw new FruitNotFoundException('The requested fruit does not exist.', $fruit_id);
    }

    public function getFruits(int $page = 0, $filterBy = []): DataProviderInterface
    {
        $query = DBFruit::find();

//        if (key_exists('user_id', $filterBy)) {
//            $query->joinWith(['user' => function (ActiveQuery $query) use ($filterBy) {
//                return $query->andWhere(['=', 'user.id', $filterBy['user_id']]);
//            }], false, 'LEFT JOIN');
//        }
        if (key_exists('name', $filterBy)) {
            $query->andWhere(['LIKE', 'fruit.name', $filterBy['name']]);
        }
        if (key_exists('family', $filterBy)) {
            $query->andWhere(['LIKE', 'fruit.family', $filterBy['family']]);
        }
        if (key_exists('ids', $filterBy)) {
            $query->andWhere(['in', 'fruit.id', $filterBy['ids']]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => new Pagination([
                'pageSize' => 50,
                'page' => $page,
            ]),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'db' => $this->db,
        ]);

        $models = [];
        foreach ($dataProvider->getModels() as $key => $value) {
            $models[$key] = $this->fromDBFruit($value);
        }

        $newDataProvider = new ArrayDataProvider();
        $newDataProvider->setKeys($dataProvider->getKeys());
        $newDataProvider->setPagination($dataProvider->getPagination());
        $newDataProvider->setSort($dataProvider->getSort());
        $newDataProvider->setTotalCount($dataProvider->getTotalCount());
        $newDataProvider->setModels($models);

        return $newDataProvider;
    }

    /**
     * @param Fruit[] $fruits
     *
     * @throws \yii\db\Exception
     */
    public function saveFruits(array $fruits) : void
    {
        $ids = [];
        foreach ($fruits as $fruit) {
            $ids[] = $fruit->id;
        }

        $existingDbFruits = DBFruit::find()
            ->where(['in', 'id', $ids])
            ->indexBy('id')
            ->all($this->db);

        $dbFruits = [];
        foreach ($fruits as $fruit) {
            if (array_key_exists($fruit->id, $existingDbFruits)) {
                $dbFruit = $existingDbFruits[$fruit->id];
            } else {
                $dbFruit = new DBFruit();
            }
            $dbFruit->id = $fruit->id;
            $dbFruit->family = $fruit->family;
            $dbFruit->name = $fruit->name;
            $dbFruit->nutritions = json_encode($fruit->nutritions);

            $dbFruits[$fruit->id] = $dbFruit;
        }

        $transaction = $this->db->beginTransaction();
        try {
            foreach ($dbFruits as $dbFruit) {
                $dbFruit->save(false);
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    private function fromDBFruit(DBFruit $dbFruit) : Fruit
    {
        return new Fruit($dbFruit->id, $dbFruit->name, $dbFruit->family, Json::decode($dbFruit->nutritions));
    }
}
