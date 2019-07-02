/**
 * Created by Administrator on 17-5-19.
 */
jQuery(function($){
    $.datepicker.regional['zh-CN'] = {
        closeText: '�ر�',
        prevText: '<����',
        nextText: '����>',
        currentText: '����',
        monthNames: ['һ��','����','����','����','����','����',
            '����','����','����','ʮ��','ʮһ��','ʮ����'],
        monthNamesShort: ['һ','��','��','��','��','��',
            '��','��','��','ʮ','ʮһ','ʮ��'],
        dayNames: ['������','����һ','���ڶ�','������','������','������','������'],
        dayNamesShort: ['����','��һ','�ܶ�','����','����','����','����'],
        dayNamesMin: ['��','һ','��','��','��','��','��'],
        weekHeader: '��',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: true,
        yearSuffix: '��'};
    $.datepicker.setDefaults($.datepicker.regional['zh-CN']);
});