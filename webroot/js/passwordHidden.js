/*
 * パスワードの表示、非表示切り替え
 */
$(function(){
    $(".tggle-password").click(function()
        {
            $(this).toggleClass("mdi-eye mdi-eye-off");

            /*
             * 入力フォームの取得
             */
            var input = $(this).parent().prev("input");
            /*
             * type切り替え
             */
            if(input.attr("type") === "password")
            {
                input.attr("type", "text");
            }
            else
            {
                input.attr("type", "password");
            }
        });
});
