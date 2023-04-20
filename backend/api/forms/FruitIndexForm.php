<?php

namespace api\forms;

use yii\base\Model;

class FruitIndexForm extends Model
{
    public string $page = '0';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['page', 'integer'],
        ];
    }
}
