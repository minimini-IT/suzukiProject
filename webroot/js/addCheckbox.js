$(function(){

    /*
     * 病名、症状、部位時のrequired用
     *
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

        /*
         * 無しを選んだ場合は他は選べない
         */
        //console.log($(this).val());
        if($(this).val() == 1)
        {
            if($(this).prop("checked"))
            {
                $("input[name='"+labelFor+"']").prop("disabled", true);
                $(this).prop("disabled", false);
            }
            else
            {
                $("input[name='"+labelFor+"']").prop("disabled", false);
            }
        }
    });

    /*
     * articles add用
     */
    $('[id$=id-1]').click(function(){
        var first_id_count = $("[id$=id-1]").filter(":checked").length;
        console.log(first_id_count);
        /*
         * 病名、症状、部位
         * すべてを無しにするのを防ぐ
         */
        if($(this).prop("checked") && first_id_count >= 2)
        {
            console.log("if");
            var sickness = $("#sicknesses-id-1").prop("checked");
            console.log(sickness);
            var symptoms = $("#symptoms-id-1").prop("checked");
            console.log(symptoms);
            var locations = $("#locations-id-1").prop("checked");
            console.log(locations);
            if(!(sickness))
            {
                $("#sicknesses-id-1").prop("disabled", true);
            }
            else if(!(symptoms))
            {
                $("#symptoms-id-1").prop("disabled", true);
            }
            else if(!(locations))
            {
                $("#locations-id-1").prop("disabled", true);
            }
            
        }
        else if(!($(this).prop("checked")) && first_id_count == 1)
        {
            $("[id$=id-1]").prop("disabled", false);
        }
    });

});
