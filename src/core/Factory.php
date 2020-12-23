<?php
namespace core;

use adapters\DatabaseService;
use adapters\Db;
use adapters\Http;
use adapters\IpService;
use adapters\Locale;
use adapters\LocaleService;
use PDO;

require_once(__DIR__ . '/../../defines.php');
require_once(__DIR__ . '/../adapters/DatabaseService.php');
require_once(__DIR__ . '/../adapters/Db.php');
require_once(__DIR__ . '/../adapters/IpService.php');
require_once(__DIR__ . '/../adapters/Locale.php');
require_once(__DIR__ . '/../adapters/LocaleService.php');
require_once(__DIR__ . '/../adapters/Http.php');
require_once(__DIR__ . '/Controller.php');

class Factory
{
    public function controller()
    {
        return new Controller($this->fields(), $this->databaseService(), $this->ipService(), $this->locale());
    }

    public function databaseService()
    {
        return new DatabaseService($this->db());
    }

    public function db()
    {
        return new Db($this->pdo());
    }

    public function fields()
    {
        return $_POST;
    }

    public function http()
    {
        return new Http();
    }

    public function ipService()
    {
        return new IpService($this->http());
    }

    public function locale()
    {
        return new Locale($this->localeService());
    }

    public function localeService()
    {
        return new LocaleService($this->http());
    }

    public function pdo() {
        return new PDO(DB_DSN, DB_USERNAME2, DB_PASSWORD2);
    }
}
