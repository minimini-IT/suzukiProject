$(function(){

    initialize();
    //$(".symptoms_checkbox :input").prop("disabled", true);
    //症状を複数選択すると部位を選択できなくする
    //
    //チェックボックスクリックすると
    $(".select :input").click(function()
    {
        //console.log($("#symptoms_checkbox :checked").length);
        //症状をクリックすると
        if($("#symptoms_checkbox :checked").length > 1 || $("#symptoms_checkbox :checked").length == 0)
        //if($("#symptoms_checkbox :checked").length > 1)
        {
            //console.log("true");
            $(".locations_checkbox").prop("disabled", true);
        }
        else
        {
            //console.log("false");
            $(".locations_checkbox").prop("disabled", false);
        };
    });
    /*
        if($(".dayOfWeek :checked").length >= 1){
    $(".symptoms_checkbox").prop("disabled", true);
    */

    function initialize()
    {
        if($("#symptoms_checkbox :checked").length == 1)
        {
            $(".locations_checkbox").prop("disabled", false);
        }
    }
});
