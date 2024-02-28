<?php
use App\Core\Controller;
use App\App\Models\Model_Img;


class Controller_Img extends Controller
{
    function action_index()
    {
        $userdata = $this->model->check_user();
        $data = new Model_Img();
        $this->view->generate('main/img_view', 'template_view', $userdata , $data);     
    }

}
