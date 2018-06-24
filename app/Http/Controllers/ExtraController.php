<?php

namespace App\Http\Controllers;

use View;
use Input;
use Ramsey\Uuid\Uuid;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use App\Exceptions\ToolsException;

class ExtraController extends Controller
{
    public function getRandom()
    {
        return view('extra.random');
    }

    public function getUuid()
    {
        return view('extra.uuid');
    }

    public function postUuid(Request $request)
    {
        $num = $request->post('num', 5);
        try {
            $this->validate(compact('num'), [
                'num' => 'required|integer|between:1,10',
            ]);
            $uuids = [];
            do {
                array_push($uuids, Uuid::uuid4()->toString());
                --$num;
            } while ($num > 0);

            return ApiResponse::success($uuids);
        } catch (ToolsException $e) {
            return ApiResponse::error($e->getMessage());
        }
    }
}
