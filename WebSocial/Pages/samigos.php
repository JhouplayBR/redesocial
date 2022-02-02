<?php
if (isset($_POST['sub'])) {
    $_SESSION['nome__pre'] = $_POST['amigos'];
    $nome = $_POST['amigos'];
    $pp = Mysql::conectar()->prepare("SELECT * FROM `usuarios_tb` WHERE user_name LIKE '%$nome%'");
    $pp->execute();
    if ($pp->rowCount() > 0){
        $names = $pp->fetchAll();
    }else{
    }
}
?>
<form method="post">
<div class="inputs__amigos">
    <input type="text" name="amigos" placeholder="Procure por Amigos">
    <input type="submit" name="sub" value="Procurar">
</div>
</form>
<div class="row__search">
    <?php foreach(@$names as $key => $value){
        $soli = Mysql::conectar()->prepare("SELECT * FROM  `amigos_db` WHERE id_amigo = ? AND id_user = ?");
        $soli->execute(array($value['id'],$_SESSION['id_user']));
        $solivalida = $soli->fetchAll();
         ?>
        <form method="post">
    <div class="user__info search">
        <a href="<?php echo INCLUDE_PATH?>samigos?perfil=<?php echo $value['id']?>">
        <?php if ($value['img_user'] == ''){?>
            <img src="https://assets.vogue.in/photos/5ec2209e6591bc79da392879/master/pass/20390958-low_res-normal-people.jpg">
        <?php }else{ ?>
        <img src="<?php echo INCLUDE_PATH?>imgs/<?php echo $value['img_user']?>">
        <?php } ?>
        </a>
        <a style="text-decoration: none;color: white;width: 100%" href="/"><p><?php echo $value['user_name']?></p></a><br>
        <div class="btns__accept">
            <input class="searchs" type="submit" value="Adicionar+" name="add" id__user="<?php echo $value['id']?>">
            <input class="id" type="hidden" value="<?php echo $value['id']?>">
        </div>
        <div class="clear"></div>
    </div><br>
        <div class="clear"></div>
    </form>
    <?php } ?>

</div>
