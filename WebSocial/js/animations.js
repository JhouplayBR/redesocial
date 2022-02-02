$(function (){
 $('.cc').click(function (){
     $('.l').css('display','none');
     $('.r').fadeIn();
 })
    $('.arrow').click(function (){
        if ($('.row-right').is(':hidden')) {
            $('.row-right').fadeIn();
        }else {
            $('.row-right').fadeOut();
        }
    })
    $('.noti').click(function (){
        if ($('.row-not').is(':hidden')) {
            $('.row-not').fadeIn();
        }else {
            $('.row-not').fadeOut();
        }

    })
    $('.friends').click(function (){
        if ($('.row-amigos').is(':hidden')) {
            $('.row-amigos').fadeIn();
        }else {
            $('.row-amigos').fadeOut();
        }

    })
    $('.imgg__click').click(function (){
        $('.perfil__container').css('opacity','10%');
        $('.post_container').css('opacity','10%');
        $('.show_img_perfil').fadeIn();
    })
    $('.close').click(function (){
        $('.show_img_perfil').fadeOut();
        $('.perfil__container').css('opacity','100%');
        $('.post_container').css('opacity','100%');

    })
        $('#photo__user').change(function (){
          $('#su').fadeIn();
        })
         $('.bait').click(function (){
             $('.bait').css('display','none');
             $('.show__pub').fadeIn();
         })

    ///Preview Imagem//
    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function (event) {
                $('#preview').html('<img src="'+event.target.result+'"style="width: 150px;height: 200px" "/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }
    $("#img_post").change(function () {
        imagePreview(this);
    });
})
