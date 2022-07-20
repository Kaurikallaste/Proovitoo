<?php
namespace Proovitoo\Controllers;

use Proovitoo\DB;

require_once(__DIR__.'/../DB.php');

abstract class Controller {

    protected static $db;
    protected static $instance;

    function __construct() {
        self::$db = DB::instance();
    }

    abstract static function instance(): Controller;
}   
?>