$(function()
    {
        $(".scroll-link").click(function()
            {
                var href= $(this).attr("href");
                var target = $(href);
                var position = target.offset().top;
                $("html, body").stop().animate({scrollTop:position}, 500);
            })
    });
