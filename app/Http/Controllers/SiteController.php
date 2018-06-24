<?php

namespace App\Http\Controllers;

use View;
use Input;
use Response;
use App\Models\Tool;
use App\Support\Cache;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * 首页.
     *
     * @return [type] [description]
     */
    public function getHome()
    {
        $tools = Tool::statusOk()->get();

        return view('site.index', compact('tools'));
    }

    /**
     * 验证码.
     *
     * @return [type] [description]
     */
    public function getCaptcha()
    {
        $builder = (new CaptchaBuilder())->build();
        Session::set('captcha', $builder->getPhrase());

        return Response::make($builder->output(), 200, ['Content-type' => 'image/jpeg']);
    }

    public function getTools(Request $request)
    {
        $cacheKey = 'site.ajax.tools';
        $expireMinite = 3;
        $tools = Cache::get($cacheKey, $expireMinite, function () {
            $tools = Tool::statusOk()->get(['name', 'route', 'description'])->toArray();
            array_walk($tools, function (&$v, $k) {
                $v['url'] = route($v['route'], [], false);
                unset($v['route']);
            });

            return $tools;
        });

        return Response::json($tools)->setCallback($request->query('callback'));
    }

    public function getBrowserDetect()
    {
        if (!Request::cookie('old_browser')) {
            $content = '<script>window.location.reload()</script>';

            return response($content)->withCookie(cookie('old_browser', true));
        }
    }
}
