<?php

use App\Core\Controller;
use App\app\Models\Model_Account;

class Controller_Account extends Controller
{
    function action_signup()
    {
        $userdata = $this->model->check_user();
        $model_account = new Model_Account;
        $data = $model_account->fail;
        $this->view->generate('account/signup_view', 'template_view', $userdata, $data);
    }

    function action_signin()
    {   
        $userdata = $this->model->check_user();
        $model_account = new Model_Account;
        $data = $model_account->fail;

        $this->view->generate('account/signin_view', 'template_view', $userdata, $data);
    }

    function action_profile()
    {
        $userdata = $this->model->check_user();
        if (empty($userdata['auth'])) {
                header('Location: /account/signin');
                exit;
            }
        $model_account = new Model_Account;
        $this->view->generate('account/profile_view', 'template_view', $userdata);
        

    }
}
