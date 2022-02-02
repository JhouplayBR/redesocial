<?php

class User{

    public static function Create($nome_n,$email_n,$pass){
        $bio = '';
        $city = '';
        $img = '';
        $sql = Mysql::conectar()->prepare('INSERT INTO `usuarios_tb` VALUES (null,?,?,?,?,?,?)');
        $sql->execute(array($nome_n,$pass,$email_n,$img,$bio,$city));
        return true;
    }
    public static function Enter($email,$senha){
        $smtp = Mysql::conectar()->prepare('SELECT * FROM `usuarios_tb` WHERE password_user = ? AND email_user = ? ');
        $smtp->execute(array($senha,$email));
        if ($smtp->rowCount() == 1){
            $infosUser = $smtp->fetch();
            $_SESSION['id_user'] = $infosUser['id'];
            $_SESSION['email_user'] = $infosUser['email_user'];
            $_SESSION['pass_user'] = $infosUser['password_user'];
            $_SESSION['name_user'] = $infosUser['user_name'];
            $_SESSION['img_user'] = $infosUser['img_user'];
            $_SESSION['bio_user'] = $infosUser['bio_user'];
            $_SESSION['city_user'] = $infosUser['city_user'];
            $_SESSION['user__auth'] = true;
            return true;
        }else{
            return false;
        }


    }
    public static function VerifFiles($file){
        if ($file['type'] == 'image/jpg' || $file['type'] == 'image/jpeg' || $file['type'] == 'image/png' || $file['type'] == 'image/gif'){
            $fileSize = intval($file['size'] / 1024);
            if ($fileSize > 1800){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    public static function UploadFiles($file){
        $fileType = explode('.',$file['name']);
        $fileName = uniqid().'.'.$fileType[count($fileType) - 1];

        if (move_uploaded_file($file['tmp_name'],'./imgs/'.$fileName)){
            return $fileName;
        }
    }


}


?>
