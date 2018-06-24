<?php

namespace App\Http\Controllers;

class ManualController extends Controller
{
    public function getAscii()
    {
        return view('manual.ascii');
    }

    public function getJquery()
    {
        return view('manual.jquery');
    }

    public function getHttpStatusCode()
    {
        return view('manual.http-status-code');
    }
}
