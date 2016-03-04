<?php

namespace App\Exceptions\HTTPRequest;

use App\Exceptions\AppException;
use App\Exceptions\ExceptionCode;

class BadResponseException extends AppException
{
    public function __construct($message = '请求错误')
    {
        parent::__construct($message, ExceptionCode::HTTP_REQUEST_BAD_RESPONSE);
    }
}
