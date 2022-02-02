<?php
?>
<div class="post_container">
    <?php

    $amigosList = Mysql::conectar()->prepare("SELECT * FROM `amigos_db` WHERE request = 1 AND id_amigo = ? OR id_user = ?");
    $amigosList->execute(array($_SESSION['id_user'],$_SESSION['id_user']));
    @$ListAmigos = $amigosList->fetch()['id_amigo'];
        //Puxar POsts///
        $posts = Mysql::conectar()->prepare("SELECT * FROM `posts`");
        $posts->execute(array($ListAmigos));
        $postsList = $posts->fetchAll();
    foreach($postsList as $listAA) {
        //Validation dos amigos//
        $imgUser = Mysql::conectar()->prepare("SELECT * FROM `usuarios_tb` WHERE id = ?");
        $imgUser->execute(array($listAA['id_user']));
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
            <div class="imgs__postt">
                <?php
             $insertImg = Mysql::conectar()->prepare("SELECT * FROM `imagem_db` WHERE id_post = ?");
            $insertImg->execute(array($listAA['id']));
            $ImageUser = $insertImg->fetchAll();
                 foreach ($ImageUser as $ImageList){?>
            <div><img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $ImageList['img']?>"></div>
                     <?php } ?>
            </div>
        </div>
            <div class="clear"></div>
            <div class="infos__inter">
                <div class="lik">
                    <i class="far fa-heart"></i><input class="likes" type="submit" value="<?php echo $listAA['likes']?> " likesQtn="<?php echo $listAA['likes']?>/<?php echo $listAA['id']?>">
                </div>
                <a class="com" style="cursor: pointer"><i class="fas fa-comment-dots"></i>Comentar</a>
                <a href=""><i class="fas fa-share-square"></i>Compartilhar</a>
            </div>
        <div class="coment">
            <form method="post">
            <textarea class="box-coment" placeholder="Comente algo" name="text__post"></textarea>
            <input id_pub="<?php echo $listAA['id']?>" type="submit" class="ccc" name="post" value="Comentar">
            </form>
        </div>
        <div class="comments">
            <?php
            $com = Mysql::conectar()->prepare("SELECT * FROM `comentarios_db` WHERE id_pub = ?");
            $com->execute(array($listAA['id']));
            foreach ($com as $comentarios){
                $infoCo = Mysql::conectar()->prepare("SELECT * FROM `usuarios_tb` WHERE id = ?");
                $infoCo->execute(array($comentarios['id_userr']));
                $InfosComents = $infoCo->fetchAll();
                foreach ($InfosComents as $userComentario){?>
            <div class="user__info">
                <img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $userComentario['img_user']?>">
                <p><?php echo $userComentario['user_name']?></p>
            </div>
            <div class="clear"></div>
            <div class="post__info">
                <p><?php echo $comentarios['text_comentario']?></p>
            </div>
            <div class="clear"></div>
            <?php } }?>
        </div>
        <div class="see__more">
            <a class="mais">Ver mais</a>
        </div>
    </div>
    <?php }} ?>
</div>
