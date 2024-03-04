<?php

namespace App\app\Models;

use App\Core\Model;
use App\Core\Db\Db;
use App\Core\Session\Session;

class Model_Upload extends Model
{
    public $errors;
    function __construct()
    {
        
        $uploadDir = APP_PATH . APP_CONFIG['UPLOAD_DIR'];
        $upload_data = $this->get_uploaded_file($uploadDir);
        $session = new Session();


        if (empty($upload_data['errors'])) {
            $file_name = $upload_data['file_name'];
            $timestamp  = time();
            $userID = intval($session->get('id'));
            $db = new Db();
            $params = ['file_name' => $file_name];
            $db->beginTransaction();
            $sql = "INSERT OR ROLLBACK INTO images (name) VALUES (:file_name)";
            $imgID = $db->insert($sql, $params);
            $params = ['userID' => $userID,
                        'imgID' => $imgID,
                        'timestamp' => $timestamp];
            $sql = "INSERT OR ROLLBACK INTO user_actions (user_id, image_id, timestamp) VALUES (:userID, :imgID, :timestamp)";
            $db->query($sql, $params);
            $db->commit();
            header('Location: /main');
            exit;
            
        } else {
            $this->errors = $upload_data['errors'];
            
        }
    }

    function get_uploaded_file($uploadDir)
    {

        if (!empty($_FILES)) {
  
                $fileName = $_FILES['files']['name'][0];
                $errors = '';
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
