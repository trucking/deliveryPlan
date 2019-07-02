/**
 * Created by Administrator on 17-4-21.
 */
$("#").click(function(){
    $.ajax({
        type:"POST",
        url:'./ajax/UpdateCerInfo.php',
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
            alert();
        }

    });
});
