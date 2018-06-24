<?php

namespace App\Http\Controllers;

use View;
use SqlFormatter;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function getJson()
    {
        return view('format.json');
    }

    public function getHighlight()
    {
        return view('format.highlight');
    }

    public function getSql()
    {
        return view('format.sql');
    }

    public function postSql(Request $request)
    {
        $query = $request->input('query', '');
        $type = $request->input('type', 'format');
        if ($type === 'compress') {
            $result = SqlFormatter::compress($query);
        } else {
            $result = SqlFormatter::format($query);
        }

        return $this->success($result);
    }
}
