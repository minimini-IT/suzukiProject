$(function(){
    /*
     * 一つでもチェックするとその病名、症状の症状、部位のrequiredは解除
     * チェックがひとつもなくなるとrequiredを登録
     */
    var labelFor;
    $('input').click(function(){
        labelFor = $(this).attr("name");
        console.log($(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length);
        if($(this).prop("checked") && $(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length == 1)
        {
            $("input[name='"+labelFor+"']").prop("required", false);
            //console.log($(this).parent().parent().parent().children("label").attr("for") + "のrequiredを解除");
        }
        else if(!$(this).prop("checked") && $(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length == 0)
        {
            $("input[name='"+labelFor+"']").prop("required", true);
            //console.log($(this).parent().parent().parent().children("label").attr("for") + "のrequiredを登録");
        }
    });
});
