
$(window).load(function(){
    new WOW({offset:100}).init();
});


$(document).ready(function(){

    $('#layerslider').layerSlider({
        skinsPath : 'public/layerslider/skins/',
        skin : 'fullwidth',
        pauseOnHover: false,
        thumbnailNavigation : 'hover',
    });

    $("#contact-form").validate({
        errorPlacement: function(error,element) {
            return true;
        }
    });

    $('#contact-form').on("submit",function(event){

        event.preventDefault();
        var $form = $(this);

        if(!$form.valid())
        {
            alert("Todos los campos son requeridos, favor de completarlos");
            return false;
        }

        $.ajax('./libs/sendMail.php',{
            type: 'POST',
            data: $form.serialize(),
            dateType:'text',
            success:function(result)
            {
                var jsonResult = JSON.parse(result);

                if(jsonResult.isSuccess)
                {
                    alert("Datos enviados correctamente");
                    $('input[type=text], textarea').val('');

                }else{
                    alert("Error al enviar el mensaje, favor de intentar más tarde");
                }



            }
        });


    });


    $('.lnk-more-info').click(function(){
        $('#cnt-contact').animatescroll({padding:90});
    });


});
