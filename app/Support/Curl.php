<?php

namespace App\Support;

class Curl extends \Curl\Curl
{
    const USER_AGENT = '1024TOOLS (+https://1024tools.com)';

    public function __construct()
    {
        parent::__construct();

        $this->setUserAgent(static::USER_AGENT);

    }
}
