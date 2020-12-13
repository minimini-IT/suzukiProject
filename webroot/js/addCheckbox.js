$(function(){

    //initialize();

    /*
     * 一つでもチェックするとその病名、症状の症状、部位のrequiredは解除
     * チェックがひとつもなくなるとrequiredを登録
     */
    var labelFor;
    $('.checkboxRequire').click(function(){
        /*
         * checkboxのinputのnameを取得
         */
        labelFor = $(this).attr("name");
        $(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length;
        /*
         * クリックしたcheckboxがtrueなら
         * and
         * trueが1なら
         * require削除
         */
        if($(this).prop("checked") && $(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length == 1)
        {
            //console.log("required false");
            $("input[name='"+labelFor+"']").prop("required", false);
        }
        /*
         * クリックしたcheckboxがfalseなら
         * and
         * trueが0なら
         * require追加
         */
        else if(!$(this).prop("checked") && $(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length == 0)
        {
            //console.log("required true");
            $("input[name='"+labelFor+"']").prop("required", true);
        }
    });

    
    //function initialize()
    //{
    //    var inputName = "sicknesses_id[]";
    //    //console.log(inputName);
    //    initialVal = $(".checkboxInit").find("input[type='checkbox']").filter(":checked").length;
    //    if(initialVal > 0)
    //    {
    //        console.log("required off");
    //        $("input[name='"+inputName+"']").prop("reuqired", false);
    //    }
    //}

    //var labelFor;
    //$('input').click(function(){
    //    labelFor = $(this).attr("name");
    //    console.log($(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length);
    //    if($(this).prop("checked") && $(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length == 1)
    //    {
    //        $("input[name='"+labelFor+"']").prop("required", false);
    //        //console.log($(this).parent().parent().parent().children("label").attr("for") + "のrequiredを解除");
    //    }
    //    else if(!$(this).prop("checked") && $(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length == 0)
    //    {
    //        $("input[name='"+labelFor+"']").prop("required", true);
    //        //console.log($(this).parent().parent().parent().children("label").attr("for") + "のrequiredを登録");
    //    }
    //});
});
