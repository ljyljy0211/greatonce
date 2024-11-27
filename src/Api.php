<?php

namespace YiHaiTao\GreatOnce;

use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    private $appKey;

    private $appSecret;

    private $customerId;

    private $baseUrl;

    public function __construct($appKey, $appSecret, $customerId, $baseUrl)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->customerId = $customerId;
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /*
     * 请求巨益api
     *
     * string $method 接口名,如deliveryorder.create
     * array $data 业务参数
     */
    public function request(string $method, array $data)
    {
        $params = $this->getCommonParams($method);
        $params['sign'] = $this->signature($params, $data);
        $fullUrl = $this->baseUrl . '?' . http_build_query($params);
        $response = $this->getHttp()->json($fullUrl, $data);

        return json_decode($response->getBody(), true);
    }

    /**
     * 签名.
     *
     * @param array $params query参数
     * @param array $data 请的body中的数据
     */
    public function signature($params, $data)
    {
        ksort($params);
        $paramsStr = '';
        foreach ($params as $key => $value) {
            if ($key && strlen($value) > 0) {
                $paramsStr .= $key . $value;
            }
        }
        $jsonBodyData = json_encode($data);
        $signStr = $this->appSecret . $paramsStr . $jsonBodyData . $this->appSecret;
        return strtoupper(md5($signStr));
    }

    /*
     * 封装公共请求参数
     * string $method 接口名
     */
    private function getCommonParams(string $method)
    {
        return [
            'appKey' => $this->appKey,
            'customerId' => $this->customerId,
            'timestamp' => date('Y-m-d H:i:s'),
            'method' => $method,
            'format' => 'json',
            'sign_method' => 'md5',
        ];
    }
}
