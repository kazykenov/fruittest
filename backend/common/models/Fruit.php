<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fruit".
 *
 * @property int $id
 * @property string $name
 * @property string|null $family
 * @property string|null $nutritions
 */
class Fruit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fruit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['nutritions'], 'string'],
            [['name', 'family'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'family' => 'Family',
            'nutritions' => 'Nutritions',
        ];
    }
}
