<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use App\Exceptions\ToolsException;

class EncryptController extends Controller
{
    public function getpostHash(Request $request, $query = null)
    {
        $query = $request->input('query', is_null($query) ? '123456' : $query);

        $this->validate(compact('query'), ['query' => 'max:2000']);
        $algos = $this->getSortedHashAlgos();

        return view('encrypt.hash', compact('algos', 'query'));
    }

    public function getHmac()
    {
        $algos = $this->getSortedHashAlgos();
        $default = ['query' => '', 'algo' => 'sha1', 'key' => '', 'base64encodedkey' => false, 'hexencodedkey' => false];

        return view('encrypt.hmac', array_merge(compact('algos'), $default));
    }

    public function postHmac(Request $request)
    {
        $input = $request->only('algo', 'query', 'key');
        $base64encodedkey = $request->input('base64encodedkey', false);
        $hexencodedkey = $request->input('hexencodedkey', false);
        $this->validate($input, ['query' => 'max:2000', 'algo' => 'required', 'key' => 'max:512']);
        $algos = $this->getSortedHashAlgos();
        if (!in_array($input['algo'], $algos, true)) {
            throw new ToolsException('不支持该算法', ToolsException::CODE_BAD_PARAMS);
        }

        $key = $input['key'];
        if ($base64encodedkey) {
            if (false === ($key = base64_decode($key, true))) {
                throw new ToolsException('密钥不能base64 decode', ToolsException::CODE_BAD_PARAMS);
            }
        }

        if ($hexencodedkey) {
            try {
                $key = hex2bin($key);
            } catch (\Exception $e) {
                throw new ToolsException('密钥不能hex decode', ToolsException::CODE_BAD_PARAMS);
            }
        }

        $result = hash_hmac($input['algo'], $input['query'], $key);
        $rawResult = base64_encode(hash_hmac($input['algo'], $input['query'], $key, true));

        return view('encrypt.hmac', array_merge(compact('algos', 'result', 'rawResult', 'base64encodedkey', 'hexencodedkey'), $input));
    }

    private function getSortedHashAlgos()
    {
        $commonAlgos = ['md5', 'sha1', 'sha256', 'sha512'];
        $algos = hash_algos();
        $algos = array_diff($algos, array_intersect($commonAlgos, $algos));
        sort($algos);

        return array_merge($commonAlgos, $algos);
    }
}
