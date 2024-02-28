<?php

namespace App\Core\Db;

use PDO;

class Db
{

    protected $db;

    public function __construct()
    {
        // $config = require_once 'config/db.php';
        // foreach (PDO::getAvailableDrivers() as $driver) {
        //     echo $driver . PHP_EOL;
        // }
        $this->db = new PDO("sqlite:" . APP_PATH. APP_CONFIG['database']);
    }

    public function query($sql)
    {
        $this->db->exec( 'PRAGMA foreign_keys = ON;' );
        $query = $this->db->query($sql);
        return $query;
    }

    public function row($sql)
    {
        $result = $this->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql)
    {
        $result = $this->query($sql);
        return $result->fetchColumn();
    }

    public function insert($sql) {
        $this->db->exec( 'PRAGMA foreign_keys = ON;' );
        $insert = $this->db->query($sql);
        return $this->db->lastInsertId();
    }


}
