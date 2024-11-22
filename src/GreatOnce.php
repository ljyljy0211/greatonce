<?php

namespace YiHaiTao\GreatOnce;

use Hanson\Foundation\Foundation;

class GreatOnce extends Foundation
{
    public function __construct($config)
    {
        $config['debug'] = $config['debug'] ?? false;
        parent::__construct($config);
    }

    public function request($method, $params)
    {
        $api = new Api($this->config['app_key'], $this->config['app_secret'], $this->config['seller_id'], $this->config['base_url']);
        return $api->request($method, $params);
    }
}
