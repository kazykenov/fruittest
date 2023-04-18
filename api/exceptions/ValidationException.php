<?php

namespace api\exceptions;

use yii\base\Model;
use yii\db\Exception;

class ValidationException extends Exception
{
    public Model $model;

    public function __construct($message, Model $model, $errorInfo = [], $code = '', $previous = null)
    {
        $this->model = $model;

        parent::__construct($message, $errorInfo, $code, $previous);
    }
}