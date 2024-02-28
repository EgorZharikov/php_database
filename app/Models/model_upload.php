<?php

namespace App\app\Models;

use App\Core\Model;
use App\Core\Db\Db;
use App\Core\Session\Session;

class Model_Upload extends Model
{

    function __construct()
    {
        
        $uploadDir = APP_PATH . '/' . APP_CONFIG['INDEX_DIR'] . '/' . APP_CONFIG['UPLOAD_DIR'];
        $upload_data = $this->get_uploaded_file($uploadDir);
        $session = new Session();

        if (empty($upload_data['errors'])) {
            $file_name = $upload_data['file_name'];
            $timestamp  = time();
            $userId = intval($session->get('id'));
            $db = new Db();
            $sql = "INSERT INTO images (name) VALUES ('$file_name')";
            $db->query($sql);
            $sql = "SELECT id FROM images WHERE name = '$file_name'";
            $img_id = $db->column($sql);
            $sql = "INSERT INTO user_actions (user_id, image_id, timestamp) VALUES ($userId, $img_id, $timestamp)";
            $db->query($sql);
            if ($session->get('upload_errors')) {
                $session->destroy('upload_errors');
            }
            header('Location: /main');
            exit;
            
        } else {
            $session->set('upload_errors', $upload_data['errors']);
            header('Location: /account/profile');
            exit;
        }
    }

    function get_uploaded_file($uploadDir)
    {

        if (!empty($_FILES)) {
  
                $fileName = $_FILES['files']['name'][0];
         
                if ($_FILES['files']['size'][0] > APP_CONFIG['UPLOAD_MAX_SIZE']) {
                    $errors = 'Недопустимый размер файла ' . $fileName . '<br>';
                }
         
                if (!in_array($_FILES['files']['type'][0], APP_CONFIG['ALLOWED_TYPES'])) {
                    $errors = 'Недопустимый формат файла ' . $fileName . '<br>';
                }
         
                $type = strstr($fileName, ".");
                $timestamp = time();
                $name = 'img' . $timestamp . $type;
                $savePath = $uploadDir . '/'. $name;
                $tmpName = $_FILES['files']['tmp_name'][0];
         
                if (!move_uploaded_file($tmpName, $savePath)) {
                    $errors = 'Ошибка загрузки файла ' . '#' . $_FILES['files']['error'][0] . '<br>';
                }
            
                return ['errors' => $errors,
                        'file_name' => $name];
            }
            
    }
}
