<?php

namespace api\forms;

use yii\base\Model;

class FavoriteFruitForm extends Model
{
    public string $fruit_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['fruit_id', 'integer'],
        ];
    }
}
