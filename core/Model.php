<?php

namespace App\Core;

use App\Core\Db\Db;
use App\Core\Session\Session;

class Model
{

    public function check_user()
    {
        $session = new Session();
        $session->start();
        if ($session->has('username')) {
            return ['username'=> $session->get('username'),
            'auth'=> $session->get('auth')];
        } else if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
            $db = new Db();
            $id = $_COOKIE['id'];
            $userip = ip2long($_SERVER['REMOTE_ADDR']);
            $sql = "SELECT hash, ip, id, login FROM users WHERE id = $id";
            $userdata = $db->row($sql);
            
            if (($userdata[0]['hash'] !== $_COOKIE['hash']) or ($userdata[0]['id'] !== intval($_COOKIE['id']))
                or (($userdata[0]['ip'] !== $userip)  and ($userdata[0]['ip'] !== "0"))
            ) {
                $session->removeCookie("username");
                $session->removeCookie("id");
                $session->removeCookie("hash");
            } else {
                $session->setArray(['username' => $userdata[0]['login'],
                                    'id' => $userdata[0]['id'],
                                    'auth' => true ]);
               return ['username'=> $userdata[0]['login'],
                        'auth'=> true,
                        'id' => $userdata[0]['id']];
            }
        }

        
    }
}
