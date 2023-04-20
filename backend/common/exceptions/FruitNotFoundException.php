<?php

namespace common\exceptions;

use yii\db\Exception;

class FruitNotFoundException extends Exception
{
    public int $fruit_id;

    public function __construct($message, $fruit_id, $errorInfo = [], $code = '', $previous = null)
    {
        $this->fruit_id = $fruit_id;

        parent::__construct($message, $errorInfo, $code, $previous);
    }
}