/**
 * Created by 지성 on 2016-10-22.
 */
$(function(){

    $('#slide-submenu').on('click',function() {
        $(this).closest('.list-group').fadeOut('slide',function(){
            $('.mini-submenu').fadeIn();
        });

    });

    $('.mini-submenu').on('click',function(){
        $(this).next('.list-group').toggle('slide');
        $('.mini-submenu').hide();
    })
})
