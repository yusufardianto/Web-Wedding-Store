$(function (){
    $(document).scroll(function () {
        var $nav = $(".navbar-fixed-top");
        $nav.togglerClass("scrolled", $(this).scrollTop() > $nav.height());
    });
});