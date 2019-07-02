$(".tanchu").hide();

$("table a").click(function(){
    $supName = $(this).parent().siblings(".supName").text();
    $cerName = $(this).parent().siblings(".cerName").text();
    $dueTime = $(this).parent().siblings(".dueTime").text();
    $id = $(this).attr("id");
    $(".tanchu").children(".supName").text("供应商名称：" + $supName);
    $(".tanchu").children(".cerName").text("资质：" + $cerName);
    $(".tanchu").children(".dueTime").text("到期时间：" + $dueTime);
    $(".tanchu").show();
    $(".msg").hide();
});

$(".close").click(function(){
    $(".tanchu").hide();
});

$(".update").click(function(){
    //alert($id);
    $newTime = $("#newTime").val();
    if($newTime == ''){
        alert("程序员小李友情提示：更新时间不能不添啊！");
        exit();
    }
    $user = $(".user").text();
    $url = 'updateDueTime.php';
    $.post(
        $url,
        {
            id:$id,
            newTime:$newTime,
            user:$user
        },
        function(data){
            alert(data.result);
            if(data.result == 1){
                $(".msg").text("更新成功").show();
            }else{
                $(".msg").text("系统错误，稍后再试").show();
            }
        }
    );
});