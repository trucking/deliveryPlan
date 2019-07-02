/**
 * Created by Administrator on 17-4-21.
 */
$("#supInfoUpdate").click(function(){

   $.ajax({
       type:"POST",
       url:'./ajax/UpdateSupplierInfo.php',
       dataType:"json",
       data:{id : $("#id").text(),
           supplierId : $("#supplierId").val(),
           supplierName : $("#supplierName").val(),
           supplierAddress : $("#supplierAddress").val(),
           goods : $("#goods").val(),
           remark : $("#remark").val()
       },
       contentType: "application/x-www-form-urlencoded; charset=utf-8",
       success:function(data){
           alert("更新成功");
       }

   });
});

$(".delete").click(function(){
    $id = $(this).attr("id");
    $result = confirm("确定删除吗？");
    if($result){
        $.post(
            './ajax/deleteCer.php',
            {id:$id},
            function(data){
                if(data){
                    alert("删除成功！");
                    window.location.reload();
                }else{
                    alert("系统错误！");
                }
            }
        );
    }

});

$(".update").click(function(){
    $id = $(this).attr("id");
    $name = $(this).parent().siblings().children().val();
    $dueTime = $(this).parent().siblings().next().children().val();
    $updateTime = $(this).parent().siblings().next().next().children().val();

    $result = confirm("确定更新吗？");
    alert($id);
    if($result){
        $.post(
            './ajax/updateCerInfo.php',
            {id : $id,
             name : $name,
             dueTime : $dueTime,
             updateTime : $updateTime
            },
            function(data){
                alert('更新成功');
            }
        );
    }
});
