<?php
namespace App\Core;
use App\Core\Model;
class View
{

    function generate($content_view, $template_view, $userdata = null, $data = null)
    {
        if (!empty ($_GET)) {
            extract($_GET);
        }

        if (isset ($userdata)) {
            extract ($userdata);
        }
        ob_start();
        include_once APP_PATH . '/'. 'app/Views/' . $content_view . '.php';
        $content_view = ob_get_clean();
        include_once APP_PATH . '/'. 'app/Views/' . $template_view . '.php';
      
        
    }

}
