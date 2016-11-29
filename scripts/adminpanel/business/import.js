function uploadSaveProjects(){  
    var fileObj = document.getElementById("file").files[0]; // 获取文件对象  
    var FileController = SITE_URL+'adminpanel/business/upload/';
 
    // FormData 对象  
    var form = new FormData();  
    form.append("dosubmit","1");
    form.append("file", fileObj);                           // 文件对象  
    // XMLHttpRequest 对象  
    var xhr = new XMLHttpRequest();  
    xhr.open("post", FileController, true);  
    xhr.onload = function () { 
    	var text = xhr.responseText.replace(/"/g, "");
    	if(text == "-1") 
    	{
    		alert("请确认文件是否为xlsx文件");
    	}else{
    		document.getElementById("import_file").value = text;
    		alert("上传成功");
    	}
    };  
    // 实现进度条功能  
    xhr.upload.addEventListener("progress", progressFunction, false);  
    xhr.send(form);  
} 

function progressFunction(evt) {  
    var progressBar = document.getElementById("progressBar");  
    var percentageDiv = document.getElementById("percentage");  
    if (evt.lengthComputable) {  
        progressBar.max = evt.total;  
        progressBar.value = evt.loaded;  
        percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";  
    }  
} 

	define(function (require) {
	var $ = require('jquery');
	var aci = require('aci');
	require('bootstrap');
	require('bootstrapValidator');
	require('message');
	require('jquery-ui');
	require('jquery-ui-dialog-extend');
	require('datetimepicker');

		$(function () {
	    $.datepicker.regional['zh-CN'] = {
                closeText: '关闭',
                prevText: '<上月',
                nextText: '下月>',
                currentText: '今天',
                monthNames: ['一月','二月','三月','四月','五月','六月',
                '七月','八月','九月','十月','十一月','十二月'],
                monthNamesShort: ['一','二','三','四','五','六',
                '七','八','九','十','十一','十二'],
                dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
                dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
                dayNamesMin: ['日','一','二','三','四','五','六'],
                weekHeader: '周',
                dateFormat: 'yy-mm-dd',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: true,
                yearSuffix: '年'};
     $.datepicker.setDefaults($.datepicker.regional['zh-CN']);


	$(".datepicker").datepicker();
	$(".datetimepicker").datetimepicker({lang:'ch'});

            $('#validateform').bootstrapValidator({
				message: '输入框不能为空',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					 

				}
			}).on('success.form.bv', function(e) {

				e.preventDefault();
				$("#dosubmit").attr("disabled","disabled");

				$.scojs_message("正在保存，请稍等...", $.scojs_message.TYPE_ERROR);
				$.ajax({
					type: "POST",
					url: SITE_URL+"adminpanel/business/import/"+id,
					data:  $("#validateform").serialize(),
					success:function(response){
						var dataObj=jQuery.parseJSON(response);
						if(dataObj.status)
						{
							$.scojs_message('操作成功,3秒后将返回列表页...', $.scojs_message.TYPE_OK);
							aci.GoUrl(SITE_URL+'adminpanel/business/',1);
						}else
						{
							$.scojs_message(dataObj.tips, $.scojs_message.TYPE_ERROR);
							$("#dosubmit").removeAttr("disabled");
						}
					},
					error: function (request, status, error) {
						$.scojs_message(request.responseText, $.scojs_message.TYPE_ERROR);
						$("#dosubmit").removeAttr("disabled");
					}
				});

			}).on('error.form.bv',function(e){ $.scojs_message('带*号不能为空', $.scojs_message.TYPE_ERROR);$("#dosubmit").removeAttr("disabled");});

        });
});
