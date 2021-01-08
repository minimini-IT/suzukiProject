$(function(){
    //console.log($('.related_sicknesses').length);
    if($(".related_sicknesses").length > 0)
    {
        $("#sicknesses-id-1").prop("disabled", true);
    }

    if($(".related_symptoms").length > 0)
    {
        $("#symptoms-id-1").prop("disabled", true);
    }

    if($(".related_locations").length > 0)
    {
        $("#locations-id-1").prop("disabled", true);
    }

    if(!($("#sicknesses-id-1").length))
    {
        $(".sicknesses_checkbox").prop("disabled", true);
    }

    if(!($("#symptoms-id-1").length))
    {
        $(".symptoms_checkbox").prop("disabled", true);
    }

    if(!($("#locations-id-1").length))
    {
        $(".locations_checkbox").prop("disabled", true);
    }
});
