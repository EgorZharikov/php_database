<?php
use App\Core\Controller;
use App\app\Models\Model_Upload;

class Controller_Upload extends Controller
{
    function action_index()
    {
        $userdata = $this->model->check_user();
        $model_profile = new Model_Upload;
    }

}
