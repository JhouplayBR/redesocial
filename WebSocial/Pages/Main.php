<?php

$user = Mysql::conectar()->prepare("SELECT * FROM `amigos_db` WHERE request = 0 AND id_amigo = ? ");
$user->execute(array($_SESSION['id_user']));
$request = $user->fetchAll();
$CountFriends = count($request);
?>
<div class="background"></div>
<div class="header">
    <div class="header__container">
        <div class="logo">
            <h3><a style="text-decoration: none;color: white" href="<?php echo INCLUDE_PATH?>posts">WebNet</a></h3>
        </div>
        <div class="uls">
            <ul>
                <li><a href="<?php echo INCLUDE_PATH?>samigos"><i class="fas fa-search"></i></a></li>
                <li><a class="friends"><span class="noti__number"><?php echo $CountFriends?></span><i class="fas fa-users"></i></a></li>
                <li><a class="noti"><i class="fas fa-bell"></i><span class="noti__number">10</span></a></li>
                <li><a class="arrow"><i class="fas fa-arrow-circle-down"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
</div>
<!--Notificações--->
<div class="row-not">
    <?php for ($b=0;$b < 8;$b++){?>
    <div class="notificacao">
    <div class="user__info__not">
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png">
        <a style="text-decoration: none;color: white" href="/"><p>Jhonny</p></a><br>
    </div>
        <p class="noti__info">Acabou de postar uma publicação</p>
    </div>
    <?php } ?>
</div>
<!--End - Notificações-->
<!--Amigos--->
<div class="row-amigos">
    <form method="post">
    <?php foreach ($request as $key){
        $imgUser = Mysql::conectar()->prepare("SELECT * FROM `usuarios_tb` WHERE id = ?");
        $imgUser->execute(array($key['id_user']));
        $Infos = $imgUser->fetchAll();
        foreach ($Infos as $infos){
        ?>
        <div class="notificacao__amigo">
            <div class="user__info__not">
                <img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $infos['img_user']?>">
                <a style="text-decoration: none;color: white" href="/"><p><?php echo $infos['user_name'];?></p></a><br>
            </div>
            <div class="btns__accept">
                <input class="acce" type="submit" value="Aceitar" accept="<?php echo $key['id']?>" name="aceitar">
                <input type="submit" value="Remover" name="remove">
            </div>
        </div>
    <?php } }?>
    </form>
</div>
<!--End - Amigo-->
<!--Config-->
<div class="row-right">
    <div class="uls-right">
        <ul>
            <li><a href="<?php echo INCLUDE_PATH?>perfil"><i class="fas fa-user-alt"></i> Perfil</a></li>
            <li><a href=""><i class="fas fa-sliders-h"></i> Configurações</li>
            <li><a href=""><i class="far fa-address-book"></i> Solicitações Pendentes</a></li>
            <li><a href="">Sair <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>
</div>
<?php
$url = isset($_GET['url']) ? $_GET['url'] : 'posts';
if (file_exists('Pages/'.$url.'.php')){
    include ('Pages/'.$url.'.php');
}

?>
