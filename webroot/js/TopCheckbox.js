$(function(){

    initialize();

    /*
     * 検索クリックでチェックボックス表示
     */
    $("#search_toggle").click(function()
    {
        $("#search").slideToggle();
    });

    /*
     * 症状を複数選択すると部位を選択できなくする
     * チェックボックスクリックすると
     */
    $(".symptoms_input_checkbox").click(function()
    {
        /*
         * 症状をクリックすると
         */
        if($("#symptoms_checkbox :checked").length > 1 || $("#symptoms_checkbox :checked").length == 0)
        {
            $("input[name='locations_id[]']").prop("disabled", true);
            if($("#locations_checkbox").css("display") == "block")
            {
                $("#locations_checkbox").slideToggle();
            }
        }
        else
        {
            $("input[name='locations_id[]']").prop("disabled", false);
            $("#locations_checkbox").slideToggle();
        };
    });

    function initialize()
    {
        if($("#symptoms_checkbox :checked").length == 1)
        {
            $("input[name='locations_id[]']").prop("disabled", false);
            $("#locations_checkbox").css("display", "block");
        }
    }
});
