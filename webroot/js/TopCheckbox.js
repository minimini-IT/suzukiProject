$(function(){



    initialize();
    /*
     * 症状を複数選択すると部位を選択できなくする
     * チェックボックスクリックすると
     */
    $(".select :input").click(function()
    {
        /*
         * 症状をクリックすると
         */
        if($("#symptoms_checkbox :checked").length > 1 || $("#symptoms_checkbox :checked").length == 0)
        {
            $(".locations_checkbox").prop("disabled", true);
        }
        else
        {
            $(".locations_checkbox").prop("disabled", false);
        };
    });

    function initialize()
    {
        if($("#symptoms_checkbox :checked").length == 1)
        {
            $(".locations_checkbox").prop("disabled", false);
        }
    }
});
