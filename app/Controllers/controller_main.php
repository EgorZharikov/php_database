<?php
use App\Core\Controller;
use App\app\Models\Model_Main;

class Controller_Main extends Controller
{
    
    function action_index()
    {   
        $userdata = $this->model->check_user();
        $data = new Model_Main;
        $this->view->generate('main/main_view', 'template_view', $userdata, $data);
        
    }

}
