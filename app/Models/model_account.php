<?php

namespace App\app\Models;

use App\Core\Model;
use App\Core\Db\Db;
use App\Core\Validator\Validator;
use App\Core\Session\Session;

class Model_Account extends Model
{
    public $fail;

    function __construct()
    {

        if (isset($_POST['signup'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $fail = Validator::validate_username($username);
            $fail .= Validator::check_username_exist($username);
            $fail .= Validator::validate_password($password, $confirm);
            if (empty($fail)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $db = new Db();
                $sql = "INSERT INTO users (login, password) VALUES ('$username', '$password')";
                $id = $db->insert($sql);
                $session = new Session();
                $session->has('auth') ? $session->destroyAll() : false;
                $session->start();
                $session->setArray([
                    'auth' => true,
                    'username' => $username,
                    'id' => $id
                ]);

                header('Location: /main');
                exit;
            } else {
                $this->fail = $fail;
            }
        }

        if (isset($_POST['signout'])) {
            $session = new Session();
            $session->start();
            $session->removeCookie("username");
            $session->removeCookie("id");
            $session->removeCookie("hash");
            $session->destroyAll();

            header('Location: /main');
            exit;
        }

        if (isset($_POST['signin'])) {

            $username = Validator::test_input($_POST['username']);
            $password = Validator::test_input($_POST['password']);
            $db = new Db();
            $sql = "SELECT id, password FROM users WHERE login = '$username'";
            $data = $db->row($sql);
            if ($data and password_verify($password, $data[0]['password'])) {
                $session = new Session();
                $session->start();
                $id = $data[0]['id'];
                $session->setArray([
                    'auth' => true,
                    'username' => $username,
                    'id' => $id
                ]);

                if (isset($_POST['save_user'])) {
                    $hash = md5($this->generateCode(10));
                    $insip = ip2long($_SERVER['REMOTE_ADDR']);
                    $sql = "UPDATE users SET hash = '$hash', ip = $insip WHERE id = $id";
                    $db->query($sql);
                    $session->setCookie('id', $id);
                    $session->setCookie('hash', $hash);
                    $session->setCookie('username', $username);
                }

                header('Location: /main');
                exit;
            } else {
                $this->fail = 'Неверный пароль или имя пользователя';
                
            }
        }
    }

    private function generateCode($length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
}
