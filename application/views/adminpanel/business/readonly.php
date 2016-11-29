<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<div class='panel panel-default '>
    <div class='panel-heading'>
        <i class='fa fa-table'></i> 商户号 查看信息 
        <div class='panel-tools'>
            <div class='btn-group'>
            	<a class="btn " href="<?php echo base_url('adminpanel/business')?>"><span class="glyphicon glyphicon-arrow-left"></span> 返回 </a>
            </div>
        </div>
    </div>
    <div class='panel-body '>
<div class="form-horizontal"  >
	<fieldset>
        <legend>基本信息</legend>
     
  	  	
	<div class="form-group">
				<label for="business_code" class="col-sm-2 control-label form-control-static">商户号</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['business_code'])?$data_info['business_code']:'' ?>
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="href_a" class="col-sm-2 control-label form-control-static">链接</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['href_a'])?$data_info['href_a']:'' ?>
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="salesman" class="col-sm-2 control-label form-control-static">业务员号</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['salesman'])?$data_info['salesman']:'' ?>
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="customer_telephone" class="col-sm-2 control-label form-control-static">客户手机号</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['customer_telephone'])?$data_info['customer_telephone']:'' ?>
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="customer_create_time" class="col-sm-2 control-label form-control-static">用户注册时间</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['customer_create_time'])?$data_info['customer_create_time']:'' ?>
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="business_create_time" class="col-sm-2 control-label form-control-static">商户导入时间</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['business_create_time'])?$data_info['business_create_time']:'' ?>
				</div>
			</div>
	    </fieldset>
	</div>
</div>
</div>
