<?php

namespace App\app\Models;

use App\Core\Db\Db;

class Model_Img
{

    public $imgData;
    public $commentsData;

    public function __construct()
    {
        if (!isset($_GET["name"]) or !file_exists(APP_PATH . APP_CONFIG['UPLOAD_DIR'] . $_GET["name"])) {
            $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location:' . $host . '404');
            exit;
        }


        $db = new Db();
        $imgName = $_GET["name"];
        $params = ['imgName' => $imgName];
        $sql = "SELECT U.login, U.id AS user_id, UA.timestamp, I.id AS image_id, I.name FROM users AS U INNER JOIN user_actions AS UA ON U.id = UA.user_id INNER JOIN images AS I ON UA.image_id = I.id WHERE I.name = :imgName AND UA.comment_id IS NULL";
        $tmpImgData =  $db->row($sql, $params);
        $imgID = intval($tmpImgData[0]["image_id"]);

        if (isset($_POST['remove_comment'])) {
            $commentID = $_POST['comment_id'];
            $userID = $_POST['user_id'];
            if (intval($userID) === intval($_SESSION['id'])) {
                $params = ['commentID' => $commentID];
                $sql = "DELETE FROM comments WHERE id = :commentID;";
                $db->query($sql, $params);
                header("Location: /img?name=$imgName");
                exit;
            }
        }

        if (isset($_POST['add_coment'])) {
            $content = $_POST['text_comment'];
            $userID = intval($_SESSION['id']);
            $imgID = intval($tmpImgData[0]['image_id']);
            $timestamp = time();
            $db->beginTransaction();
            $params = [
                'content' => $content,
            ];
            $sql = "INSERT OR ROLLBACK INTO comments (content) VALUES (:content);";
            $commentID = intval($db->insert($sql, $params));
            $params = [
                'userID' => $userID,
                'imgID' => $imgID,
                'commentID' => $commentID,
                'timestamp' => $timestamp];
            $sql = "INSERT OR ROLLBACK INTO user_actions (user_id, image_id, comment_id, timestamp) VALUES (:userID, :imgID, :commentID, :timestamp)";
            $db->insert($sql, $params);
            $db->commit();
            header("Location: /img?name=$imgName");
            exit;
        }

        if (isset($_POST["remove_image"])) {
            $imgID = intval($_POST["image_id"]);
            $imdUserID = intval($_POST["img_user_id"]);
            $userID = intval($_SESSION['id']);
            if ($imdUserID === $userID) {
                $params = ['imgID' => $imgID];
                $db->beginTransaction();
                $sql = "DELETE FROM comments WHERE id in(SELECT comment_id FROM user_actions WHERE image_id=:imgID AND comment_id NOT NULL);";
                $db->query($sql, $params);
                $sql = "DELETE FROM images WHERE id = :imgID;";
                $db->query($sql, $params);
                $db->commit();
                unlink(APP_PATH . APP_CONFIG['UPLOAD_DIR'] . $imgName);
                header('Location: /main');
                exit;
            }
        }
        $params = ['imgID' => $imgID];
        $sql = "SELECT U.login AS user, U.id AS user_id, UA.timestamp, C.id AS comment_id, C.content FROM users AS U INNER JOIN user_actions AS UA ON U.id = UA.user_id INNER JOIN comments AS C ON UA.comment_id = C.id WHERE UA.image_id = :imgID";
        $tmpCommentsData = $db->row($sql, $params);
        $this->imgData = $tmpImgData;
        $this->commentsData = $tmpCommentsData;
    }
}
