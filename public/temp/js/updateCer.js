$(".tanchu").hide();

$("table a").click(function(){
    $supName = $(this).parent().siblings(".supName").text();
    $cerName = $(this).parent().siblings(".cerName").text();
    $dueTime = $(this).parent().siblings(".dueTime").text();
    $id = $(this).attr("id");
    $(".tanchu").children(".supName").text("��Ӧ�����ƣ�" + $supName);
    $(".tanchu").children(".cerName").text("���ʣ�" + $cerName);
    $(".tanchu").children(".dueTime").text("����ʱ�䣺" + $dueTime);
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
        alert("����ԱС��������ʾ������ʱ�䲻�ܲ�����");
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
                $(".msg").text("���³ɹ�").show();
            }else{
                $(".msg").text("ϵͳ�����Ժ�����").show();
            }
        }
    );
});