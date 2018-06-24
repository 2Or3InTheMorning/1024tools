<?php

namespace App\Http\Controllers;

use Log;
use View;
use lessc;
use Exception;
use Illuminate\Http\Request;

class ConvertController extends Controller
{
    private $base64Encoding = ['UTF-8', 'GB18030', 'GBK', 'GB2312', 'BIG-5', 'ASCII',
        'Windows-1251', 'Windows-1252', 'Windows-1254',
        'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4',
        'ISO-8859-5', 'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9',
        'ISO-8859-10', 'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16',
        'CP932', 'CP936', 'CP866', 'CP850'];

    public function getUrlencode()
    {
        return view('convert.urlencode');
    }

    public function postUrlencode(Request $request)
    {
        $input = $request->only('query', 'type', 'method');
        $rules = [
            'query' => 'required',
            'type' => 'required|in:decode,encode',
            'method' => 'required|in:urlencode,rawurlencode',
        ];
        $this->validate($input, $rules);
        $result = explode("\n", $input['query']);
        $functionTable = [
            'urlencode' => ['decode' => 'urldecode', 'encode' => 'urlencode'],
            'rawurlencode' => ['decode' => 'rawurldecode', 'encode' => 'rawurlencode'],
        ];
        array_walk($result, function (&$v, $k) use ($input, $functionTable) {
            $v = $functionTable[$input['method']][$input['type']]($v);
        });

        return $this->success($result);
    }

    public function getXmlJson()
    {
        return view('convert.xmljson');
    }

    public function getBase64(Request $request)
    {
        $query = $request->query('q');
        $encoding = $this->base64Encoding;

        return view('convert.base64', compact('query', 'encoding'));
    }

    public function postBase64(Request $request)
    {
        $input = $request->only('query', 'type', 'encoding');
        $rules = [
            'query' => 'required',
            'type' => 'required|in:decode,encode',
            'encoding' => 'required',
        ];
        $this->validate($input, $rules);
        if (!in_array($input['encoding'], $this->base64Encoding, true)) {
            return $this->error('encoding unsupported');
        }
        if ($input['type'] === 'encode') {
            try {
                $query = iconv('UTF-8', $input['encoding'], $input['query']);
                $result = base64_encode($query);

                return $this->success($result);
            } catch (Exception $e) {
                return $this->error('查询字符串包含'.$input['encoding'].'编码外的字符，请检查所选编码');
            }
        } else {
            if (preg_match("/^[\w\+\/\=]+$/", $input['query'])) {
                $query = iconv('UTF-8', $input['encoding'], $input['query']);
                $result = base64_decode($query, true);

                try {
                    $result = iconv($input['encoding'], 'UTF-8', $result);

                    return $this->success($result);
                } catch (Exception $e) {
                    return $this->error('不能解码转换为合法的'.$input['encoding'].'字符串，请检查编码和查询字符串');
                }
            } else {
                return $this->error('格式错误');
            }
        }
    }

    public function getLess()
    {
        return view('convert.less');
    }

    public function postLess(Request $request)
    {
        $query = $request->post('query');

        try {
            $less = new lessc();
            $result = $less->compile($query);
        } catch (Exception $e) {
            Log::error($e);

            return $this->error($e->getMessage());
        }

        return $this->success($result);
    }

    public function getMarkdown()
    {
        return view('convert.markdown');
    }

    public function getTimestamp()
    {
        return view('convert.timestamp');
    }

    public function getUnserialize()
    {
        return view('convert.unserialize');
    }

    public function postUnserialize(Request $request)
    {
        $query = $request->input('query');

        try {
            if (false !== ($result = unserialize(trim($query)))) {
                return $this->success(print_r($result, true));
            }
        } catch (Exception $e) {
        }

        return $this->error('输入错误，该字符串无法反序列化');
    }
}
