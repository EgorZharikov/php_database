<?php
use App\Core\Controller;
use App\app\Models\Model_Upload;

class Controller_Upload extends Controller
{
    function action_index()
    {
        $userdata = $this->model->check_user();
        $data = new Model_Upload;
        $this->view->generate('account/upload_view', 'template_view', $userdata, $data);
    }

}
