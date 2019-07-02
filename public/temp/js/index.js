/**
 * Created by Administrator on 16-10-21.
 */
$(".title").click(function(){
    $(this).parent().siblings(".content").toggle();
});
/*
* ������Һ��js������һ�����
* */
$("#search").button().click(function(){
    $datepicker = $("#datepicker").val();
    $url = './ajax/searchList.php';

    if($datepicker == ''){
        $("#result").text("��ѡ������").show();
        return false;
    }else{
        $.post(
            $url,
            {'date':$datepicker},
            function(data){

                $("#list").html("");
                $("#list").append(
                    '<tr>' +
                        '<th>���</th>' +
                        '<th>���浥��</th>' +
                        '<th>����/����</th>' +
                        '<th>��������</th>' +
                        '<th>��������</th>' +
                        '<th>ί�е�λ</th>' +
                        '<th>ί��ʱ��</th>' +
                        '<th>����Ԥ��</th>' +
                        '<th>�깤����</th>' +
                        '<th>�������</th>' +
                        '<th>��ͬ����</th>' +
                        '<th>������</th>' +
                        '<th>����</th>' +
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
                                    '<button class="change" id="' + data[p]['runId'] + '">����</button>' +
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
                                    '<button class="add" id="' + data[p]['runId'] + '">����</button>' +
                                '</td>'+
                            '</tr>'
                        );
                    }

                }
            }
        );
    }
});

//������������ʱ������
$("#datepicker").datepicker(
    {dateFormat: 'yy-mm'}
);
//������ǰ��js���ɵı��ҳ��
$(".finishTimeInput").live('click',function(){
    $(this).datepicker();
});

$("#export").button().click(function()
{
    $datepicker = $("#datepicker").val();
    $url = './ajax/exportList.php?date='+$datepicker;

    if($datepicker == ''){
        $("#result").text("��ѡ������").show();
        return false;
    }else
    {
        window.location.href = $url;
    }
});

$(".change").live('click',function(){
    var $id = $(this).attr("id");

    $(this).text("ȷ��");
});

$(".add").live('click',function(){
    var $id = $(this).attr("id");
    $(this).hide();
    $(this).parent().append("<button class='addSubmit'>ȷ��</button>");//("ȷ��");

    $(this).parent().siblings(".finishDate").html("" +
        "<input type='text'>" +
        "");
    $(this).parent().siblings(".status").html("" +
        "<select>" +
            "<option value='1'>�ϸ�</option>" +
            "<option value='2'>���ϸ�</option> " +
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
                    $this.parent().siblings(".status").text('�ϸ�');
                }else{
                    $this.parent().siblings(".status").text('���ϸ�');
                }
                $this.parent().siblings(".contractCost").text($contractCost);
                $this.parent().append("<button class='change'>����</button>");
                $this.remove();
            }else{
                alert('�������洢���⣬���Ժ����ԣ�');
            }
        }
    );
});

$(".change").live('click',function(){
    $finishDate = $(this).parent().siblings(".finishDate").text();

    $status = $(this).parent().siblings(".status").val();
    $contractCost = $(this).parent().siblings(".contractCost").text();
    $(this).hide();
    $(this).parent().append("<button class='changeSubmit'>ȷ��</button>");
    $(this).parent().siblings(".finishDate").html("" +
        "<input type='text' value='" + $finishDate + "'>" +
        "");
    $(this).parent().siblings(".status").html("" +
        "<select>" +
        "<option value='1'>�ϸ�</option>" +
        "<option value='2'>���ϸ�</option> " +
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
    var $this = $(this);//���ｫ$(this)��������һ����������Ϊ��ajax���ٴε���$(this)�޷��ҵ�����ʹ�ô˱��������ҵ�
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
                    $this.parent().siblings(".status").text('�ϸ�');
                }else{
                    $this.parent().siblings(".status").text('���ϸ�');
                }
                $this.parent().siblings(".contractCost").text($contractCost);
                $this.parent().append("<button class='change'>����</button>");
                $this.remove();
            }else{
                alert('�������洢���⣬���Ժ����ԣ�');
            }
        }
    );
});