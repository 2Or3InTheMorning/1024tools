<?php

namespace App\Http\Controllers;

use View;
use Response;
use Exception;
use App\Support\Curl;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    public static $ipApis = [
        'sina' => 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=',
        'taobao' => 'http://ip.taobao.com/service/getIpInfo.php?ip=',
        'pconline' => 'http://whois.pconline.com.cn/ipJson.jsp?json=true&ip=',
        'ip_api' => 'http://ip-api.com/json/',
        'dangdang' => 'http://iplookup.dangdang.com/?format=json&ip=',
    ];

    public function getHeader(Request $request)
    {
        $header = '';
        foreach ($request->server as $k => $v) {
            if (strpos(strtolower($k), 'http_') === 0) {
                if (in_array(strtolower($k), ['http_cookie', 'http_remoteip', 'http_x_forwarded_for'], true)) {
                    continue;
                }
                $name = explode('_', strtolower(substr($k, 5)));
                array_walk($name, function (&$v, $k) {
                    $v = ucfirst($v);
                });
                $header = implode('-', $name).': '.$v."\r\n" . $header;
            }
        }

        return view('http.header', compact('header'));
    }

    public function getIp(Request $request)
    {
        $ip = $request->get('ip', $request->ip());

        return view('http.ip', ['ip' => $ip, 'apis' => self::$ipApis]);
    }

    public function getIpSina(Request $request)
    {
        return $this->doIpProxy($request, 'sina');
    }

    public function getIpTaobao(Request $request)
    {
        return $this->doIpProxy($request, 'taobao');
    }

    public function getIpPconline(Request $request)
    {
        return $this->doIpProxy($request, 'pconline');
    }

    public function getIpIpApi(Request $request)
    {
        return $this->doIpProxy($request, 'ip_api');
    }

    public function getIpDangdang(Request $request)
    {
        return $this->doIpProxy($request, 'dangdang');
    }

    private function doIpProxy(Request $request, $source)
    {
        $url = self::$ipApis[$source].$request->get('ip', $request->ip());
        $curl = new Curl();
        $curl->get($url);
        $data = ['status' => intval(!$curl->curl_error), 'data' => json_decode(trim($curl->response)) ];
        $response = Response::json($data);

        try {
            $response->setCallback($request->query('callback'));
        } catch (Exception $e) {
        }

        return $response;
    }
}
