<?php

namespace App\Http\Controllers;

use View;
use Input;
use App\Exceptions\Exception as ToolsException;

class EncryptController extends Controller
{
    public function getpostHash($query = null)
    {
        if (is_null($query)) {
            $query = Input::get('query', '123456');
        }
        $this->validate(compact('query'), ['query' => 'max:2000']);
        $algos = $this->getSortedHashAlgos();

        return View::make('encrypt.hash', compact('algos', 'query'));
    }

    public function getHmac()
    {
        $algos = $this->getSortedHashAlgos();
        $default = ['query' => '', 'algo' => 'sha1', 'key' => '', 'base64encodedkey' => false];

        return View::make('encrypt.hmac', array_merge(compact('algos'), $default));
    }

    public function postHmac()
    {
        $input = Input::only('algo', 'query', 'key', 'base64encodedkey');
        $this->validate($input, ['query' => 'max:2000', 'algo' => 'required', 'key' => 'max:512']);
        $algos = $this->getSortedHashAlgos();
        if (!in_array($input['algo'], $algos)) {
            throw new ToolsException('不支持该算法', ToolsException::CODE_BAD_PARAMS);
        }

        $key = $input['key'];
        if ($input['base64encodedkey']) {
            if (false === ($key = base64_decode($key, true))) {
                throw new ToolsException('密钥不能base64 decode', ToolsException::CODE_BAD_PARAMS);
            }
        }

        $result = hash_hmac($input['algo'], $input['query'], $key);
        $rawResult = base64_encode(hash_hmac($input['algo'], $input['query'], $key, true));

        return View::make('encrypt.hmac', array_merge(compact('algos', 'result', 'rawResult'), $input));
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
