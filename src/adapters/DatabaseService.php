<?php
namespace adapters;

class DatabaseService
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function countryId($countryCode)
    {
        $sql = "SELECT country_id " . "FROM country " . "WHERE alpha2_code = '" . $countryCode . "';";
        return $this->db->column($sql);
    }

    public function hostLanguage($host)
    {
        $sql = "SELECT language_id " . "FROM host " . "WHERE host = '" . $host . "';";
        return $this->db->column($sql);
    }

    public function hostTitle($host)
    {
        $sql = "SELECT name " . "FROM host " . "WHERE host = '" . $host .  "';";
        return $this->db->column($sql);
    }

    public function language($languageId)
    {
        $sql = "SELECT language " . "FROM language " . "WHERE language_id = '" . $languageId . "';";
        return $this->db->column($sql);
    }

    public function pageId($languageId, $titleId)
    {
        $sql = "SELECT page_id " . "FROM page " . "WHERE language_id = '" . $languageId . "' AND title_id = '" . $titleId . "';";
        return $this->db->column($sql);
    }

    public function pageUuid($pageId)
    {
        $sql = "SELECT uuid " . "FROM page " . "WHERE page_id = '" . $pageId . "';";
        return $this->db->column($sql);
    }

    public function pageResource($pageId)
    {
        $sql = "SELECT resource_id " . "FROM page " . "WHERE page_id = '" . $pageId . "';";
        return $this->db->column($sql);
    }

    public function pageView($fields)
    {
        $sql = "INSERT " . "INTO " . "page_view (language_id, page_id, country_id, sub_division_id, ip) VALUES ('" . implode("', '", $fields) . "');";
        $this->db->insert($sql);
    }

    public function pageViewExists($ip, $pageId)
    {
        $sql = "SELECT COUNT(*) " . "FROM page_view " . "WHERE page_id = '" . $pageId . "' AND ip = '" . $ip . "';";
        return $this->db->count($sql) > 0;
    }

    public function subDivisionId($countryId, $subDivisionCode)
    {
        $sql = "SELECT sub_division_id " . "FROM sub_division " . "WHERE country_id = '" . $countryId . "' AND geo_code = '" . $subDivisionCode . "';";
        return $this->db->column($sql);
    }

    public function resourceTemplate($resourceId)
    {
        $sql = "SELECT template_id " . "FROM resource " . "WHERE resource_id = '" . $resourceId . "';";
        return $this->db->column($sql);
    }

    public function template($templateId)
    {
        $sql = "SELECT template " . "FROM template " . "WHERE template_id = '" . $templateId . "';";
        return $this->db->column($sql);
    }

    public function titleId($languageId, $title)
    {
        $sql = "SELECT title_id " . "FROM title " . "WHERE language_id = '" . $languageId . "' AND title = '" . $title . "';";
        return $this->db->column($sql);
    }
}
