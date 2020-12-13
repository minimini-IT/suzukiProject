$(function(){
    $(".toggle-password").click(function()
        {
            /*
             * icon切り替え
             */
            var icon = $(this);
            if(icon.attr("uk-icon") == "icon: lock")
            {
                icon.attr("uk-icon", "icon: unlock");
            }
            else
            {
                icon.attr("uk-icon", "icon: lock");
            }
            
            /*
             * 入力タイプ切り替え
             */
            let input = $("#password");
            if(input.attr("type") == "password")
            {
                input.attr("type", "text");
            }
            else
            {
                input.attr("type", "password");
            }
        })
});
