<?php

/*
 *  $_SESSION['email_user'] = $infosUser['email_user'];
            $_SESSION['pass_user'] = $infosUser['password_user'];
            $_SESSION['name_user'] = $infosUser['user_name'];
            $_SESSION['img_user'] = $infosUser['img_user'];
            $_SESSION['bio_user'] = $infosUser['bio_user'];
            $_SESSION['city_user'] = $infosUser['city_user'];
 */
if (isset($_POST['submit'])){
   $photo = $_FILES['photo_user'];
   if (User::VerifFiles($photo)){
       unlink('imgs/'.$_SESSION['img_user']);
   $Namefoto = User::UploadFiles($photo);
   $u = Mysql::conectar()->prepare('UPDATE `usuarios_tb` SET img_user = ? WHERE id = ?');
   $u->execute(array($Namefoto,$_SESSION['id_user']));
   $_SESSION['img_user'] = $Namefoto;
   echo '<script>window.location.href="http://localhost/WebSocial/perfil"</script>';
   exit();
   }else{
       echo 'ops, looks like your files is too powerful';
   }
}
if (isset($_POST['post'])){
    $photo_Post = $_FILES['file'];
    $text = $_POST['text__post'];
        $qtsImagem = count($_FILES['file']['name']);
        $ss = Mysql::conectar()->prepare("INSERT INTO `posts` VALUES(null,?,?,?,?)");
        $ss->execute(array($_SESSION['id_user'],$text,'0',''));
        $select = Mysql::conectar()->prepare("SELECT * FROM `posts` WHERE id_user = ? ORDER BY id DESC");
        $select->execute(array($_SESSION['id_user']));
        $id_post = $select->fetch()['id'];
        for ($i=0;$i < $qtsImagem;$i++) {
            $filename = $_FILES['file']['name'][$i];
            move_uploaded_file($_FILES['file']['tmp_name'][$i],'imgs/'.$filename);
            $insertImg = Mysql::conectar()->prepare("INSERT INTO `imagem_db` VALUES(null,?,?)");
            $insertImg->execute(array($id_post, $filename));
        }
}

$amigosList = Mysql::conectar()->prepare("SELECT * FROM `amigos_db` WHERE request = 1 AND id_amigo = ? OR id_user = ?");
$amigosList->execute(array($_SESSION['id_user'],$_SESSION['id_user']));
$ListAmigos = $amigosList->fetchAll();
?>
<div class="perfil__container">
    <div class="perfil">
    <div class="img__perfil">
        <a style="cursor: pointer" class="imgg__click">
            <?php if ($_SESSION['img_user'] == ''){?>
    <img src="http://www.rachegebran.com.br/wp-content/uploads/perfil.jpg">
    <?php }else{ ?>
                <img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $_SESSION['img_user']?>">
            <?php } ?>
    </a>
    </div>
        <div class="sobre">
            <h2><?php echo $_SESSION['name_user'] ?></h2>
        </div>
            <div class="sobre__uteis">
            <h4><i class="fas fa-pencil-alt"></i> Hello im really good person</h4>
                <h4><i class="fas fa-home"></i> Barbosa-sp</h4>
        </div>
        <div class="text--pub">
            <textarea class="bait" placeholder="Publique algo..."></textarea>
            <div class="show__pub">
            <form method="post" enctype="multipart/form-data">
                <textarea placeholder="Publique algo..." name="text__post"></textarea>
                <div class="tracks" style="border: 1px solid #2c2929;height: 30px;" >
                <label for="img_post">
                <h3 style="color: white;float: left">Procurar Imagem <i class="fas fa-upload"></i></h3>
                </label>
                </div>
                <div class="clear"></div>
                <div style="float: left;margin: 50px 0px" id="preview"></div>
                <div class="clear"></div>
                <input id="img_post" type="file" name="file[]" style="display: none" multiple>
                <input type="submit" class="env" name="post" value="Publicar">
            </form>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <h2 style="color: white;">Amigos</h2>
    <div class="amigos">
        <?php foreach($ListAmigos as $lista){
            $imgUser = Mysql::conectar()->prepare("SELECT * FROM `usuarios_tb` WHERE id = ?");
            $imgUser->execute(array($lista['id_amigo']));
            $Infos = $imgUser->fetchAll();
            ?>
        <?php  foreach ($Infos as $listaMIMI){
            if ($lista['id_amigo'] != $_SESSION['id_user']){?>
        <div class="img__amigo">
            <img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $listaMIMI['img_user']?>">
            <p><?php echo $listaMIMI['user_name']?></p>
        </div>
                <?php } ?>
            <?php } ?>
        <?php }  ?>
    </div>
</div>
<!---Showw--img--->
<div class="show_img_perfil">
    <a class="close" style="cursor: pointer;float: right;color: white;font-size: 23px"><i class="fas fa-times"></i></a>
    <?php if ($_SESSION['img_user'] != ''){ ?>
        <img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $_SESSION['img_user']?>">
    <?php }else{ ?>
    <img src="http://www.rachegebran.com.br/wp-content/uploads/perfil.jpg">
    <?php } ?>
    <form method="post" enctype="multipart/form-data">
        <label style="color: white;font-size: 23px" for="photo__user"><i class="fas fa-pencil-alt"></i>Mudar Foto de perfil</label>
        <input type="file" style="display: none" id="photo__user" name="photo_user"><br><br>
        <input id="su" type="submit" name="submit" value="Mudar">
    </form>
</div>
<!---Showw--img--->
<br><br>
<div class="post_container">
    <?php
    $posts = Mysql::conectar()->prepare("SELECT * FROM `posts` WHERE id_user = ?");
    $posts->execute(array($_SESSION['id_user']));
    $postsList = $posts->fetchAll();
    foreach($postsList as $listAA) {
        $imgUser = Mysql::conectar()->prepare("SELECT * FROM `usuarios_tb` WHERE id = ?");
        $imgUser->execute(array($_SESSION['id_user']));
        $Infos = $imgUser->fetchAll();
        foreach ($Infos as $infosKey){
            ?>
            <div class="posts">
                <div class="user__info">
                    <img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $infosKey['img_user']?>">
                    <a style="text-decoration: none;color: white" href="/"><p><?php echo $infosKey['user_name']?></p></a>
                </div>
                <div class="clear"></div>
                <div class="post__info">
                    <p><?php echo $listAA['post_text']?></p>
                    <div class="clear"></div>
                    <img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $listAA['img']?>">
                </div>
                <div class="clear"></div>
                <div class="infos__inter">
                    <div class="lik">
                        <i class="far fa-heart"></i><input class="likes" type="submit" value="<?php echo $listAA['likes']?> " likesQtn="<?php echo $listAA['likes']?>/<?php echo $listAA['id']?>">
                    </div>
                    <a href=""><i class="fas fa-comment-dots"></i>Comentar</a>
                    <a href=""><i class="fas fa-share-square"></i>Compartilhar</a>
                </div>
                <div class="comments">
                    <?php for ($i=0;$i < 1;$i++){?>
                        <div class="user__info">
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png">
                            <p>Jhonny</p>
                        </div>
                        <div class="clear"></div>
                        <div class="post__info">
                            <p>Zé batata</p>
                        </div>
                        <div class="clear"></div>
                    <?php } ?>
                </div>
                <div class="see__more">
                    <a>Ver mais</a>
                </div>
            </div>
        <?php }} ?>
</div>



