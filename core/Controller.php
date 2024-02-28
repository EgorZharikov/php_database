<?php
namespace App\Core;

use App\Core\View;
use App\Core\Model;

class Controller {

    public $view;
    public $model;

    function __construct()
    {
        $this->view = new View;
        $this->model = new Model;
    }
}