<?php
namespace core;

class Controller
{
    private $databaseService;
    private $ip;
    private $locale;
    public function __construct($fields, $databaseService, $ipService, $locale)
    {
        $this->databaseService = $databaseService;
        $this->locale = $locale;
        $this->run($fields, $ipService);
    }

    public function response()
    {
        return $this->ip;
    }

    private function run($fields, $ipService)
    {
        // $ipInfo = $ipService->get($fields);
        $ipInfo = $ipService->getMock($fields);
        $languageId = $this->databaseService->hostLanguage($fields['host']);
        $title = trim($fields['title']);
        if (!$title) {
            $title = $this->databaseService->hostTitle($fields['host']);
        }
        $titleId = $this->databaseService->titleId($languageId, $title);
        if (!$titleId) {
            $language = $this->databaseService->language($languageId);
            $this->locale->initialize($language);
            $titles = $this->locale->titles();
            $title = $titles['not_found'];
            $titleId = $this->databaseService->titleId($languageId, $title);
        }
        $pageId = $this->databaseService->pageId($languageId, $titleId);
        $countryId = $this->databaseService->countryId($ipInfo['countryCode']);
        $subDivisionId = $this->databaseService->subDivisionId($countryId, $ipInfo['region']) ?? 0;
        $fields = [$languageId, $pageId, $countryId, $subDivisionId, $ipInfo['query']];
        if (!$this->databaseService->pageViewExists($ipInfo['query'], $pageId)) {
            $this->databaseService->pageView($fields);
        }
        $resourceId = $this->databaseService->pageResource($pageId);
        $templateId = $this->databaseService->resourceTemplate($resourceId);
        $template = $this->databaseService->template($templateId);
        echo $this->databaseService->pageUuid($pageId) . ' ' . $template;
    }
}
