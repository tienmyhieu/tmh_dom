<?php
namespace adapters;

class Locale
{
    private $language;
    private $localeService;
    public function __construct($localeService)
    {
        $this->localeService = $localeService;
    }

    public function creativeCommons()
    {
        return $this->localeService->get('creative_commons', $this->language);
    }

    public function initialize($language)
    {
        $this->language = $language;
    }

    public function getLocale($collection) {
        return $this->localeService->get($collection, $this->language);
    }

    public function metas()
    {
        return $this->localeService->get('metas', $this->language);
    }

    public function search()
    {
        return $this->localeService->get('search', $this->language);
    }

    public function titles()
    {
        return $this->localeService->get('titles', $this->language);
    }
}
