<?php

namespace api\controllers;

use api\exceptions\ValidationException;
use api\forms\FruitIndexForm;
use api\helpers\ApiController;
use api\forms\FavoriteFruitForm;
use common\services\IFavoriteFruitService;
use yii\filters\AccessControl;
use yii\web\Request;
use yii\web\UnprocessableEntityHttpException;

class FruitController extends ApiController
{
    private IFavoriteFruitService $fruitService;
    private int $user_id;

    public function __construct($id, $module, IFavoriteFruitService $fruitService, $config = [])
    {
        $this->fruitService = $fruitService;

        parent::__construct($id, $module, $config);
    }

    public function beforeAction($action): bool
    {
        $this->user_id = (int)\Yii::$app->user->id;
        $this->user_id = 1; // todo: add auth token to request header

        return parent::beforeAction($action);
    }

    public function actions(): array
    {
        return [];
    }

    protected function verbs(): array
    {
        return [
            'index' => ['GET'],
            'favorites' => ['GET'],
            'add-to-favorite' => ['POST', 'OPTIONS'], // todo: make endpoint PUT /fruits/favorites/{id}
            'remove-from-favorite' => ['POST', 'OPTIONS'], // todo: make endpoint DELETE /fruits/favorites/{id}
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
//                    'roles' => ['@'],
                ],
            ],
        ];

        return $behaviors;
    }

    public function actionIndex(Request $request)
    {
        $form = new FruitIndexForm();
        $form->load($request->get(), '');

        return $this->fruitService->getAllFruits($this->user_id, (int)$form->page - 1);
    }

    public function actionFavorites(Request $request)
    {
        $form = new FruitIndexForm();
        $form->load($request->get(), '');

        return $this->fruitService->getFavoriteFruits($this->user_id);
    }

    public function actionAddToFavorite(Request $request)
    {
        $form = new FavoriteFruitForm();

        try {
            $form->load($request->post(), '');
            if (!$form->validate()) {
                throw new ValidationException($form->getFirstErrors()[0], $form);
            }

            $fruit = $this->fruitService->getFruit($this->user_id, (int)$form->fruit_id);
            $this->fruitService->addToFavorite($this->user_id, $fruit);

            return $this->asJson([
                'status' => 'success',
            ]);
        } catch (ValidationException $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage());
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function actionRemoveFromFavorite(Request $request)
    {
        $form = new FavoriteFruitForm();

        try {
            $form->load($request->post(), '');
            if (!$form->validate()) {
                throw new ValidationException($form->getFirstErrors()[0], $form);
            }

            $fruit = $this->fruitService->getFruit($this->user_id, (int)$form->fruit_id);
            $this->fruitService->removeFromFavorite($this->user_id, $fruit);

            return $this->asJson([
                'status' => 'success',
            ]);
        } catch (ValidationException $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage());
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
