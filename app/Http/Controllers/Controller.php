<?php

namespace App\Http\Controllers;

use Validator;
use App\Support\ApiResponse;
use App\Exceptions\ToolsException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Validator类封装.
     *
     * @param array $data
     * @param array $rules
     */
    protected function validate($data = [], $rules = [])
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new ToolsException($validator->messages()->first(), ToolsException::CODE_BAD_PARAMS);
        }
    }

    /**
     * api响应错误.
     *
     * @param null $error
     * @return mixed
     */
    protected function error($error = null)
    {
        return ApiResponse::error($error, $this->query());
    }

    /**
     * api响应成功.
     *
     * @param null $data
     * @return mixed
     */
    protected function success($data = null)
    {
        return ApiResponse::success($data);
    }
}
