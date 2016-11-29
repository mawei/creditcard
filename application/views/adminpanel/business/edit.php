<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<form class="form-horizontal" role="form" id="validateform" name="validateform" action="<?php echo base_url('adminpanel/business/edit')?>" >
	<div class='panel panel-default '>
		<div class='panel-heading'>
			<i class='fa fa-table'></i> 商户号 修改信息
			<div class='panel-tools'>
				<div class='btn-group'>
					<a class="btn " href="<?php echo base_url('adminpanel/business')?>"><span class="glyphicon glyphicon-arrow-left"></span> 返回 </a>
				</div>
			</div>
		</div>
		<div class='panel-body '>
								<fieldset>
						<legend>基本信息</legend>
													
	<div class="form-group">
				<label for="business_code" class="col-sm-2 control-label form-control-static">商户号</label>
				<div class="col-sm-9 ">
					<input type="text" name="business_code"  id="business_code"  value='<?php echo isset($data_info['business_code'])?$data_info['business_code']:'' ?>'  class="form-control validate[required]"  placeholder="请输入商户号" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="href_a" class="col-sm-2 control-label form-control-static">链接</label>
				<div class="col-sm-9 ">
					<input type="text" name="href_a"  id="href_a"  value='<?php echo isset($data_info['href_a'])?$data_info['href_a']:'' ?>'  class="form-control validate[required]"  placeholder="请输入链接" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="salesman" class="col-sm-2 control-label form-control-static">业务员号</label>
				<div class="col-sm-9 ">
					<input type="text" name="salesman"  id="salesman"  value='<?php echo isset($data_info['salesman'])?$data_info['salesman']:'' ?>'  class="form-control validate[required]"  placeholder="请输入业务员号" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="customer_telephone" class="col-sm-2 control-label form-control-static">客户手机号</label>
				<div class="col-sm-9 ">
					<input type="text" name="customer_telephone"  id="customer_telephone"  value='<?php echo isset($data_info['customer_telephone'])?$data_info['customer_telephone']:'' ?>'  class="form-control validate[required]"  placeholder="请输入客户手机号" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="customer_create_time" class="col-sm-2 control-label form-control-static">用户注册时间</label>
				<div class="col-sm-9 ">
					<input type="text" name="customer_create_time"  id="customer_create_time"   value='<?php echo isset($data_info['customer_create_time'])?$data_info['customer_create_time']:'' ?>'  class="form-control datetimepicker validate[custom[datetime]]"  placeholder="请输入用户注册时间" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="business_create_time" class="col-sm-2 control-label form-control-static">商户导入时间</label>
				<div class="col-sm-9 ">
					<input type="text" name="business_create_time"  id="business_create_time"   value='<?php echo isset($data_info['business_create_time'])?$data_info['business_create_time']:'' ?>'  class="form-control datetimepicker validate[custom[datetime]]"  placeholder="请输入商户导入时间" >
				</div>
			</div>
											</fieldset>
							<div class='form-actions'>
				<button class='btn btn-primary ' type='submit' id="dosubmit">保存</button>
			</div>
</form>
			<script language="javascript" type="text/javascript">
			var is_edit =<?php echo ($is_edit)?"true":"false" ?>;
			var id =<?php echo $id;?>;

			require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
		        require(['<?php echo SITE_URL?>scripts/adminpanel/business/edit.js']);
		    });
		</script>
	
	