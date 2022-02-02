<?php
include ('config/config.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <title>WebSocial</title>
</head>
<body>
<?php

if (@$_SESSION['user__auth'] == true){
    include ('Pages/Main.php');
}else{
    include ('Pages/Login.php');
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/animations.js"></script>
<script src="js/ajax.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(function (){
        $('.imgs__postt').slick({
            prevArrow: '<div class="class-to-style p"><a><span class="fa fa-angle-left"></a></span><span class="sr-only">Prev</span></div>',

            nextArrow: '<div class="class-to-style n"><a><span class="fa fa-angle-right"></a></span><span class="sr-only">Next</span></div>',
        });
    })
</script>
</body>
</html>
