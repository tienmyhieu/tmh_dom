<?php
namespace adapters;

class LocaleService
{
    private $http;
    public function __construct($http)
    {
        $this->http = $http;
    }

    public function get($category, $language)
    {
        $locales = $this->http->get(LOCALE_SERVICE . '/' . $category . '/' . $language . '.json');
        return json_decode($locales[$this->http::DATA], true);
    }
}
