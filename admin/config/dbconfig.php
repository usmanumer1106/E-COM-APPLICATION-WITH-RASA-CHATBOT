<?php
require_once('./config/operationsadmin.php');
require_once('./config/operationscategory.php');
require_once('./config/operationssubcategory.php');
require_once('./config/operationscoupon.php');
require_once('./config/operationsproduct.php');
require_once('./config/operationsorder.php');
require_once('./config/operationsbanner.php');
require_once('./config/operationsreviews.php');
session_start();
class dbconfig
{
    public $connection;

    public function __construct()
    {
        $this->db_connect();
    }

    public function db_connect()
    {
        $this->connection = mysqli_connect('localhost', 'root', '', 'ecom');
        if (mysqli_connect_error()) {
            die(" Connect Failed ");
        }
    }
    public function check($a)
    {
        $return = mysqli_real_escape_string($this->connection,$a);
        return $return;
    }
}