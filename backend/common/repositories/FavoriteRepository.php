<?php

namespace common\repositories;

class FavoriteRepository implements IFavoriteRepository
{
    public function isFavorite($user_id, $id) : bool
    {
        return (new \yii\db\Query())
            ->select(['id'])
            ->from('user_fruit')
            ->where(['user_id' => $user_id])
            ->andWhere(['fruit_id' => $id])
            ->limit(11)
            ->exists();
    }

    public function getFavorites($user_id) : array
    {
        $result = (new \yii\db\Query())
            ->select(['id'])
            ->from('user_fruit')
            ->where(['user_id' => $user_id])
            ->limit(10)
            ->all();

        return array_map(function ($item) {
            return $item['id'];
        }, $result);
    }

    public function addToFavorite($user_id, $id) : void
    {
        \Yii::$app->db->createCommand()
            ->insert('user_fruit', [
                'user_id' => $user_id,
                'fruit_id' => $id,
            ])->execute();
    }

    public function removeFromFavorite($user_id, $id) : void
    {
        \Yii::$app->db->createCommand()
            ->delete('user_fruit', [
                'user_id' => $user_id,
                'fruit_id' => $id,
            ])->execute();
    }
}
