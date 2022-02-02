<?php
include ('../config/configAjax.php');
if (isset($_POST['id'])) {
    $nome_amigo = Mysql::conectar()->prepare("SELECT * FROM `usuarios_tb` WHERE id=?");
    $nome_amigo->execute(array($_POST['id']));
    if ($nome_amigo->rowCount() > 0) {
        $nome = $nome_amigo->fetch()['user_name'];
        $soli = Mysql::conectar()->prepare("INSERT INTO `amigos_db` VALUES (null,?,?,?,?)");
        $soli->execute(array($nome, $_POST['id'], '0', $_SESSION['id_user']));
    }
}
if (isset($_POST['idUser'])){
    $upRes = Mysql::conectar()->prepare("UPDATE `amigos_db` SET request = 1 WHERE id = ?");
    $upRes->execute(array($_POST['idUser']));
}
if (isset($_POST['likes'])){
    $id__post = explode('/',$_POST['likes']);
    $split_point = '/';
    $string = $_POST['likes'];
    //Quantidade
    $reverse_explode = array_reverse(explode($split_point, $string));
   //ID
     $pp =Mysql::conectar()->prepare("SELECT * FROM `posts` WHERE id = ?");
     $pp->execute(array($id__post[1]));
     $inff = $pp->fetch();
     $import = $inff['likes'];
     $soma =  $import + 1;
     //Update no banco de dados;
     $upp = Mysql::conectar()->prepare("UPDATE `posts` SET likes = $soma WHERE id = ?");
     $upp->execute(array($id__post[1]));
     echo '<a class="likes"><i class="far fa-heart"></i>'.$soma.'</a>';
}
if(isset($_POST['id_pub'])) {
    $com = Mysql::conectar()->prepare("INSERT INTO  `comentarios_db` VALUES(null,?,?,?)");
    $com->execute(array($_POST['comentario'], $_SESSION['id_user'], $_POST['id_pub']));
        echo '<div class="user__info">
                <img src="'.INCLUDE_PATH.'imgs/'.$_SESSION['img_user'].'">
                <p>'.$_SESSION['name_user'].'</p>
            </div>
            <div class="clear"></div>
            <div class="post__info">
                <p>' . $_POST['comentario'] . '</p>
            </div>
            <div class="clear"></div>';
}
?>
