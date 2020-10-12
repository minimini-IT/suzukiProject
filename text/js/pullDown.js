$(function(){

    var addressCount = 1;
    var linkCount = 1;
    $(".addAddress").click(function(){
        $(".address").eq(0).clone(true).appendTo($(this).prev()).addClass("cloneAddress").attr("name", "destination_address["+addressCount+"]");
        addressCount++;
    });

    $(".addLink").click(function(){
        $(".link").eq(0).clone(true).appendTo($(this).prev()).addClass("cloneLink").attr("name", "link["+linkCount+"]");
        linkCount++;
    });

    $(".removeAddress").click(function(){
        $(".cloneAddress").remove();
        addressCount = 1;
    });

    $(".removeLink").click(function(){
        $(".cloneLink").remove();
        linkCount = 1;
    });

    //詳細の表示非表示
    $('.branch tr:nth-child(1)').click(function(){
        console.log("js読み込み");
        $(this).parents("table").next(".node").slideToggle();
    });
    
    //選択肢必要分表示
    $("#reload").click(function(){
        var choice = $("#choice").val();
        //$(".contentInput").removeAttr("value");
        if(choice == 1){
            $(".choiceContent").css("display", "inline");
            $(".choiceContent_sec").css("display", "inline");
        }else if(choice >= 2){
            if($(".choiceContent").length){
                $(".choiceContent").css("display", "inline");
                for(var i = 1; i < choice; i++){
                    $(".contentInput").clone(true).appendTo(".choiceContent").removeClass("contentInput").addClass("addInput").attr("name", "content["+i+"]");
                }
            }else if($(".choiceContent_sec").length){
                $(".choiceContent_sec").css("display", "inline");
                for(var i = 1; i < choice; i++){
                    $(".contentInput").clone(true).appendTo(".choiceContent_sec").removeClass("contentInput").addClass("addInput").attr("name", "content["+i+"]");
                }
            }
        }
        //一回押したら押せなくする
        $(this).prop("disabled", true);
    });
    
    //やり直し用
    $("#reset").click(function(){
        $(".addInput").remove();
        $(".choiceContent").css("display", "none");
        $(".choiceContent_sec").css("display", "none");
        $("#reload").prop("disabled", false);
        //$(".contentInput").attr("value", "null");
    });

    /*
    //ユーザ選択
    $("#private-7").on("click", function(){
        console.log("click");
        $(.privateUser).prop("checked", this.checked);
    });
    */

    //閲覧可能ユーザは必ず選択
    //選択ない場合は全ユーザがcheckされる

    //チェックボックス（private）
    $('#private-7').click(function(){
        if($(this).prop("checked")){
            $("input[name='private[]']").prop("checked", false).prop("disabled", true);
            //$(".privateUser").prop("checked", this.checked);
        }else{
            $("input[name='private[]']").prop("disabled", false);
        }
    });

    //チェックボックス(destination)
    $("#allUser").click(function(){
        if($(this).prop("checked")){
            $("input[name='user[]']").prop("checked", true);
        }else{
            $("input[name='user[]']").prop("checked", false);
        }
    });
    $("input[name='user[]']").click(function(){
        //controlでcheckbox作成時、label部分にhidden input作成されるので-1
        if($("#destinationUser :checked").length == $("#destinationUser :input").length -1 ){
            $("#allUser").prop("checked", true);
        }else{
            $("#allUser").prop("checked", false);
        }
    });

    //チェックボックス(destination 総括班用)
    $("#soukatu").click(function(){
        if($(this).prop("checked")){
            $("input[class='soukatu'").prop("checked", true);
        }else{
            $("input[class='soukatu'").prop("checked", false);
        }
    });
    $("input[class='soukatu']").click(function(){
        //controlでcheckbox作成時、label部分にhidden input作成されるので-1
        /*
        console.log("#soukatuUser :checked");
        console.log($("#soukatuUser :checked").length);
        console.log("#soukatuUser :input");
        console.log($("#soukatuUser :input").length -1);
        */
        if($("#soukatuUser :checked").length == $("#soukatuUser :input").length -1){
            //console.log("check true");
            $("#soukatu").prop("checked", true);
        }else{
            //console.log("check false");
            $("#soukatu").prop("checked", false);
        }
    });

    //チェックボックス(destination 研教班用)
    $("#kenkyo").click(function(){
        if($(this).prop("checked")){
            $("input[class='kenkyo'").prop("checked", true);
        }else{
            $("input[class='kenkyo'").prop("checked", false);
        }
    });
    $("input[class='kenkyo']").click(function(){
        if($("#kenkyoUser :checked").length == $("#kenkyoUser :input").length -1){
            $("#kenkyo").prop("checked", true);
        }else{
            $("#kenkyo").prop("checked", false);
        }
    });

    //チェックボックス(destination シス監班用)
    $("#sistem").click(function(){
        if($(this).prop("checked")){
            $("input[class='sistem'").prop("checked", true);
        }else{
            $("input[class='sistem'").prop("checked", false);
        }
    });
    $("input[class='sistem']").click(function(){
        if($("#sistemUser :checked").length == $("#sistemUser :input").length -1){
            $("#sistem").prop("checked", true);
        }else{
            $("#sistem").prop("checked", false);
        }
    });

    //チェックボックス(destination ｷﾝﾀｲ監班用)
    $("#kintai").click(function(){
        if($(this).prop("checked")){
            $("input[class='kintai'").prop("checked", true);
        }else{
            $("input[class='kintai'").prop("checked", false);
        }
    });
    $("input[class='kintai']").click(function(){
        if($("#kintaiUser :checked").length == $("#kintaiUser :input").length -1){
            $("#kintai").prop("checked", true);
        }else{
            $("#kintai").prop("checked", false);
        }
    });
});
