<?php
namespace adapters;

class IpService
{
    private $http;
    public function __construct($http)
    {
        $this->http = $http;
    }

    public function get($fields)
    {
        $response = $this->http->get(IP_SERVICE . '/json/' . $this->getIp($fields));
        return json_decode($response[$this->http::DATA], true);
    }

    private function getIp($fields)
    {
        $ip1 = $this->getKey('ip1', $fields);
        $ip2 = $this->getKey('ip2', $fields);
        return $ip1 ? $ip1 : $ip2 ? $ip2 : $fields['ip3'];
    }

    public function getMock($fields)
    {
       return [
           'status' => 'success',
           'country' => 'Vietnam',
           'countryCode' => 'VN',
           'region' => 'HN',
           'regionName' => 'Hanoi',
           'zip' => '',
           'lat' => '21.0278',
           'lon' => '105.834',
           'timezone' => 'Asia/Bangkok',
           'isp' => 'VNPT',
           'org' => 'Vietnam Posts and Telecommunications Group',
           'as' => 'AS45899 VNPT Corp',
           'query' => '14.224.10.2'
       ];
    }

    private function getKey($needle, $haystack)
    {
        return 0 < strlen($haystack[$needle]) ? $haystack[$needle] : null;
    }
}
