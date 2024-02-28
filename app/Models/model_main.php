<?php

namespace App\app\Models;

use App\Core\Model;
use App\Core\Db\Db;

class Model_Main extends Model
{
   public $data;
    function __construct() {
    $db = new Db;
    $sql = "SELECT name FROM images";
    $this->data = $db->row($sql);
 
   }
}
