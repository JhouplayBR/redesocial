$(function (){
  $('.searchs').click(function (e){
      e.preventDefault();
      var id = $(this).attr("id__user");
      $(this).val('Solicitação Enviada');
      console.log(id);
      $.ajax({
          url:'http://localhost/WebSocial/ajax/request.php',
          method:'post',
          data:{'id':id}
      }).done(function (data){
          console.log(data);
      })
  })
    $('.acce').click(function (e){
        e.preventDefault();
        var id_amigo = $(this).attr("accept");
        console.log(id_amigo);
        $(this).parent().parent().remove();
        $.ajax({
            url:'http://localhost/WebSocial/ajax/request.php',
            method: 'post',
            data: {'idUser':id_amigo}
        }).done(function (data){
        })
    })
    $('.likes').click(function (){
        var likes = $(this).attr("likesQtn");
        $(this).css('background','red');
        var spli = likes.split('/');
        var soma = parseInt(spli) + 1;
        $(this).val(soma);
        $.ajax({
            url:'http://localhost/WebSocial/ajax/request.php',
            method:'post',
            data: {'likes':likes}
        }).done(function (data){
        })
    })
    $('.com').click(function (){
        if ($('.coment').is(':hidden')) {
            $('.coment').fadeIn();
        }else {
            $('.coment').fadeOut();
        }
    })
    $('.box-coment').change(function (){
        window.valor = $(this).val();
    })
    $('.ccc').click(function (e){
        e.preventDefault();
        var id__pub = $(this).attr("id_pub");
        var comentario = window.valor;
        console.log(comentario);
        $('.coment').fadeOut();
        $.ajax({
            url:'http://localhost/WebSocial/ajax/request.php',
            method:'post',
            data: {'id_pub':id__pub,'comentario':comentario}
        }).done(function (data){
         $('.comments').append(data);
        })
    })
})
