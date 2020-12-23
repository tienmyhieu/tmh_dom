<?php
namespace adapters;

class Http
{
    const DATA = 'data';
    const HTTP_CODE = 'http_code';
    const HTTP_OK = 200;
    public function get($url)
    {
        return [$this::HTTP_CODE => $this::HTTP_OK, $this::DATA => file_get_contents($url)];
    }

    public function post($url, $fields)
    {
        $response = [$this::HTTP_CODE => $this::HTTP_OK, $this::DATA => []];
        $ch = curl_init();
        if ($ch) {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response[$this::DATA] = curl_exec($ch) ?? [];
            $response[$this::HTTP_CODE] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close ($ch);
        }
        return $response;
    }
}
