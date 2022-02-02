<?php
if (@$_SESSION['user__auth'] == true){
    header('Location: '.INCLUDE_PATH);
}else{

if(isset($_POST['env_r'])){
     $nome_n = $_POST['nome_r'];
     $email_n = $_POST['email_r'];
     $pass_n = $_POST['pass_r'];
     $passDafult = $_POST['passDefault'];
     $preg = '/^[a-z0-9]{8,}$/';
     if ($pass_n == $passDafult){
         if (preg_match($preg,$pass_n)){
             User::Create($nome_n,$email_n,$pass_n);
             $fine = true;
         }else{
             $error_preg = true;
         }
     }else{
         $error_match = true;
     }

}
if (isset($_POST['env'])){
 if(User::Enter($_POST['email_login'],$_POST['pass_login'])){
     header('Location:'.INCLUDE_PATH);
     echo 'deu bom';
 }else{
     echo 'deu ruim';
 }
}

?>
<div class="login__container">
    <div class="login">
        <h3>Faça o login</h3>
        <form method="post">
        <div class="inputs l">
            <input type="text" name="email_login" placeholder="Email">
            <input type="password" name="pass_login" placeholder="Senha">
            <input type="submit" name="env" value="Entrar">
            <a class="cc">Criar conta</a>
        </div>
        </form>
        <form method="post">
        <div class="inputs r">
            <input type="text" name="nome_r" placeholder="Coloque seu nome" required>
            <input type="email" name="email_r" placeholder="Coloque seu Email" required>
            <input type="password" name="pass_r" placeholder="Crie sua Senha" required>
            <input type="password" name="passDefault" placeholder="Repita sua Senha" required>
            <input type="submit" name="env_r" value="Criar conta">
            <p style="color:#cccccc;">Obs: A senha deve conter no minímo 8 caracteres</p>
        </div>
        </form>
        <?php if (@$error_match){?>
        <p style="color:#ffffff;background:#ff0000">Senhas não combinam</p>
        <?php }elseif (@$error_preg){ ?>
            <p style="color:#ffffff;background:#ff0000">A senha deve conter no minímo 8 caracteres</p>
        <?php }elseif (@$fine){ ?>
            <p style="color:white;background:lightgreen;font-size: 23px">Conta criada com sucesso!</p>
        <?php } ?>
    </div>
</div>
<?php } ?>
