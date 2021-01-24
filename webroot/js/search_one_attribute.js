$(function(){
    $(".uk-checkbox").click(function()
    {
        var attrbute = $(this).attr("name");
        var check_length = $(this).parent().parent().parent().find("input[type='checkbox']").filter(":checked").length;
        console.log(check_length);
        if(attrbute == "sicknesses_id[]")
        {
            if($(this).prop("checked") && check_length == 1)
            {
                //console.log("disable true 発動");
                $("input[name='symptoms_id[]']").prop("disabled", true);
                $("input[name='locations_id[]']").prop("disabled", true);
            }
            else if(!$(this).prop("checked") && check_length == 0)
            {
                //console.log("disable false 発動");
                $("input[name='symptoms_id[]']").prop("disabled", false);
                $("input[name='locations_id[]']").prop("disabled", false);
            }
        }
        else if(attrbute == "symptoms_id[]")
        {
            if($(this).prop("checked") && check_length == 1)
            {
                //console.log("disable true 発動");
                $("input[name='sicknesses_id[]']").prop("disabled", true);
                $("input[name='locations_id[]']").prop("disabled", true);
            }
            else if(!$(this).prop("checked") && check_length == 0)
            {
                //console.log("disable false 発動");
                $("input[name='sicknesses_id[]']").prop("disabled", false);
                $("input[name='locations_id[]']").prop("disabled", false);
            }
        }
        else if(attrbute == "locations_id[]")
        {
            if($(this).prop("checked") && check_length == 1)
            {
                //console.log("disable true 発動");
                $("input[name='sicknesses_id[]']").prop("disabled", true);
                $("input[name='symptoms_id[]']").prop("disabled", true);
            }
            else if(!$(this).prop("checked") && check_length == 0)
            {
                //console.log("disable false 発動");
                $("input[name='sicknesses_id[]']").prop("disabled", false);
                $("input[name='symptoms_id[]']").prop("disabled", false);
            }
        }
    });
});
