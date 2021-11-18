<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of DatabaseConnection
 *
 * @author Brandon
 */
class DatabaseConnection extends mysqli 
{
    private $connection;
    private static $instance;
    
    public function __construct()
    {
        try 
        {
            $config = parse_ini_file('./php/db-config.ini');
            $this->connection = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        } catch (Exception $e) {
            
        }
    }

    public static function getInstance() 
    {
        if(!self::$instance) 
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __clone() { }

    public function getConnection() 
    {
        return $this->connection;
    }
}
