/**
 * Created by Administrator on 16-10-21.
 */
$(".title").click(function(){
    $(this).parent().siblings(".content").toggle();
});
/*
* 点击查找后的js，返回一个表格。
* */
$("#search").button().click(function(){
    $datepicker = $("#datepicker").val();
    $url = './ajax/searchList.php';

    if($datepicker == ''){
        $("#result").text("请选择日期").show();
        return false;
    }else{
        $.post(
            $url,
            {'date':$datepicker},
            function(data){

                $("#list").html("");
                $("#list").append(
                    '<tr>' +
                        '<th>编号</th>' +
                        '<th>报告单号</th>' +
                        '<th>车间/部门</th>' +
                        '<th>报告名称</th>' +
                        '<th>申请日期</th>' +
                        '<th>委托单位</th>' +
                        '<th>委托时间</th>' +
                        '<th>费用预估</th>' +
                        '<th>完工日期</th>' +
                        '<th>验收情况</th>' +
                        '<th>合同费用</th>' +
                        '<th>负责人</th>' +
                        '<th>操作</th>' +
                    '</tr>'
                );
                for(p in data)
                {
                    if(data[p]['isRecord'] == 1)
                    {
                        $("#list").append(
                            '<tr>' +
                                '<td>'+data[p]['runId']+'</td>' +
                                '<td>'+data[p]['reportNo']+'</td>' +
                                '<td>'+data[p]['department']+'</td>' +
                                '<td style="width:200px">'+data[p]['reportName']+'</td>' +
                                '<td>'+data[p]['applicationTime']+'</td>' +
                                '<td>'+data[p]['client']+'</td>' +
                                '<td>'+data[p]['delegateTime']+'</td>' +
                                '<td>'+data[p]['estimateCost']+'</td>' +
                                '<td class="finishDate">'+data[p]['finishDate']+'</td>' +
                                '<td class="status">'+data[p]['status']+'</td>' +
                                '<td class="contractCost">'+data[p]['contractCost']+'</td>' +
                                '<td>'+data[p]['chargePerson']+'</td>' +
                                '<td>' +
                                    '<button class="change" id="' + data[p]['runId'] + '">更改</button>' +
                                '</td>'+
                            '</tr>'
                        );
                    }else
                    {
                        $("#list").append(
                            '<tr>' +
                                '<td>'+data[p]['runId']+'</td>' +
                                '<td>'+data[p]['reportNo']+'</td>' +
                                '<td>'+data[p]['department']+'</td>' +
                                '<td style="width:200px">'+data[p]['reportName']+'</td>' +
                                '<td>'+data[p]['applicationTime']+'</td>' +
                                '<td>'+data[p]['client']+'</td>' +
                                '<td>'+data[p]['delegateTime']+'</td>' +
                                '<td>'+data[p]['estimateCost']+'</td>' +
                                '<td class="finishDate">'+data[p]['finishDate']+'</td>' +
                                '<td class="status">'+data[p]['status']+'</td>' +
                                '<td class="contractCost">'+data[p]['contractCost']+'</td>' +
                                '<td>'+data[p]['chargePerson']+'</td>' +
                                '<td>' +
                                    '<button class="add" id="' + data[p]['runId'] + '">增加</button>' +
                                '</td>'+
                            '</tr>'
                        );
                    }

                }
            }
        );
    }
});

//这个是搜索框的时间框调用
$("#datepicker").datepicker(
    {dateFormat: 'yy-mm'}
);
//绑定了由前面js生成的表格页面
$(".finishTimeInput").live('click',function(){
    $(this).datepicker();
});

$("#export").button().click(function()
{
    $datepicker = $("#datepicker").val();
    $url = './ajax/exportList.php?date='+$datepicker;

    if($datepicker == ''){
        $("#result").text("请选择日期").show();
        return false;
    }else
    {
        window.location.href = $url;
    }
});

$(".change").live('click',function(){
    var $id = $(this).attr("id");

    $(this).text("确定");
});

$(".add").live('click',function(){
    var $id = $(this).attr("id");
    $(this).hide();
    $(this).parent().append("<button class='addSubmit'>确定</button>");//("确定");

    $(this).parent().siblings(".finishDate").html("" +
        "<input type='text'>" +
        "");
    $(this).parent().siblings(".status").html("" +
        "<select>" +
            "<option value='1'>合格</option>" +
            "<option value='2'>不合格</option> " +
        " </select>");
    $(this).parent().siblings(".contractCost").html("" +
        "<input type='text'>" +
        "");

});

$(".addSubmit").live('click',function(){
    var $id = $(this).prev().attr("id");
    var $finishDate = $(this).parent().siblings(".finishDate").children().val();
    var $status = $(this).parent().siblings(".status").children().val();
    var $contractCost = $(this).parent().siblings(".contractCost").children().val();
    var $this = $(this);
    $url = './ajax/addCheckStatus.php';
    $.post(
        $url,
        {
            'id' : $id,
            'finishDate' : $finishDate,
            'status' : $status,
            'contractCost' : $contractCost
        },
        function(data){
            if(data){
                //$this.parent().siblings(".finishDate").text($finishDate);
                $this.parent().siblings(".finishDate").text($finishDate);
                if($status == 1){
                    $this.parent().siblings(".status").text('合格');
                }else{
                    $this.parent().siblings(".status").text('不合格');
                }
                $this.parent().siblings(".contractCost").text($contractCost);
                $this.parent().append("<button class='change'>更改</button>");
                $this.remove();
            }else{
                alert('服务器存储问题，请稍后重试！');
            }
        }
    );
});

$(".change").live('click',function(){
    $finishDate = $(this).parent().siblings(".finishDate").text();

    $status = $(this).parent().siblings(".status").val();
    $contractCost = $(this).parent().siblings(".contractCost").text();
    $(this).hide();
    $(this).parent().append("<button class='changeSubmit'>确定</button>");
    $(this).parent().siblings(".finishDate").html("" +
        "<input type='text' value='" + $finishDate + "'>" +
        "");
    $(this).parent().siblings(".status").html("" +
        "<select>" +
        "<option value='1'>合格</option>" +
        "<option value='2'>不合格</option> " +
        " </select>");
    $(this).parent().siblings(".contractCost").html("" +
        "<input type='text' value='" + $contractCost + "'>" +
        "");
});

$(".changeSubmit").live('click',function(){
    var $id = $(this).prev().attr("id");
    var $finishDate = $(this).parent().siblings(".finishDate").children().val();
    var $status = $(this).parent().siblings(".status").children().val();
    var $contractCost = $(this).parent().siblings(".contractCost").children().val();
    var $this = $(this);//这里将$(this)单独给予一个变量是因为在ajax后再次调用$(this)无法找到对象，使用此变量可以找到
    $url = './ajax/updateCheckStatus.php';
    $.post(
        $url,
        {
            'id' : $id,
            'finishDate' : $finishDate,
            'status' : $status,
            'contractCost' : $contractCost
        },
        function(data){
            if(data){
                $this.parent().siblings(".finishDate").text($finishDate);
                if($status == 1){
                    $this.parent().siblings(".status").text('合格');
                }else{
                    $this.parent().siblings(".status").text('不合格');
                }
                $this.parent().siblings(".contractCost").text($contractCost);
                $this.parent().append("<button class='change'>更改</button>");
                $this.remove();
            }else{
                alert('服务器存储问题，请稍后重试！');
            }
        }
    );
});