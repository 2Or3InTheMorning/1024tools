<?php

namespace App\Support;

use Response;
use Exception;

class ApiResponse
{
    const STATUS_ERROR = 0;
    const STATUS_SUCCESS = 1;

    public static function success($data = null)
    {
        return self::send(self::STATUS_SUCCESS, $data);
    }

    public static function error($error = null, Exception $exception = null)
    {
        return self::send(self::STATUS_ERROR, null, $error, $exception);
    }

    private static function send($status, $data, $error = null, Exception $exception = null)
    {
        $data = [
            'status' => $status,
            'result' => $data,
            'error' => $error,
        ];

        return Response::json($data);
    }
}
