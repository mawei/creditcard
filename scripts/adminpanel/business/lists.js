	define(function (require) {
	    var $ = require('jquery');
	    var aci = require('aci');
	    require('bootstrap');
	    require('bootstrapValidator');

		$(function () {
			$("#reverseBtn").click(function(){
				aci.ReverseChecked('pid[]')
			});

			$("#deleteBtn").click(function(){
				var _arr = aci.GetCheckboxValue("pid[]");
				if(_arr.length==0)
				{
					alert("请先勾选明细");
					return false;
				}
				if(confirm('确定要删除吗?'))
				{
					$("#form_list").submit();
				}
			});
        
			 $(".delete-btn").click(function(){
				var v = $(this).val();
				if(confirm('确定要删除吗?'))
				{
					window.location.href= SITE_URL+ "adminpanel/business/delete_one/"+v;
				}
			});
            
		$(".datetimepicker").datetimepicker({lang:'ch'});
		$(".datetimepicker").datepicker();
            $('#validateform').bootstrapValidator({
				message: '输入框不能为空',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					 business_code: {
						 validators: {
							notEmpty: {
								message: '商户号输入错误'
							}
						 }
					 },
					 href_a: {
						 validators: {
							notEmpty: {
								message: '链接输入错误'
							}
						 }
					 },
					 salesman: {
						 validators: {
							notEmpty: {
								message: '业务员号输入错误'
							}
						 }
					 },
					 customer_telephone: {
						 validators: {
							notEmpty: {
								message: '客户手机号输入错误'
							}
						 }
					 },
					 customer_create_time: {
						 validators: {
							notEmpty: {
								message: '用户注册时间输入错误'
							}
						 }
					 },
					 business_create_time: {
						 validators: {
							notEmpty: {
								message: '商户导入时间输入错误'
							}
						 }
					 },
				}
			}).on('success.form.bv', function(e) {
				
				e.preventDefault();
				$("#dosubmit").attr("disabled","disabled");
				
				$.scojs_message("正在保存，请稍等...", $.scojs_message.TYPE_ERROR);
				$.ajax({
					type: "POST",
					url: edit?SITE_URL+"adminpanel/business/edit/"+id:SITE_URL+"adminpanel/business/add/",
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
