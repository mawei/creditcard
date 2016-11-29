<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<form class="form-horizontal" role="form" id="validateform" name="validateform" action="<?php echo base_url('adminpanel/business/import')?>" >
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
				<label for="business_code" class="col-sm-2 control-label form-control-static">导入文件</label>
				<div class="col-sm-9 ">
					<input type="file" id="file" class="mr10 ml10 input-medium" onchange="uploadSaveProjects()">  
					<!-- <a id="file" class="btn btn-default btn-sm" > 选择文件 ...</a><span class="help-block">只支持xlsx上传.</span> -->
					<progress  id="progressBar" value="0" max="100"></progress>  
					<span id="percentage"></span> 
					<input name="import_file" type="hidden" id="import_file">
				</div>
			</div>
	</fieldset>
							<div class='form-actions'>
				<button class='btn btn-primary ' type='submit' id="dosubmit">导入</button>
			</div>
</form>
			<script language="javascript" type="text/javascript">
			var is_edit =<?php echo ($is_edit)?"true":"false" ?>;
			var id =<?php echo $id;?>;

			require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
		        require(['<?php echo SITE_URL?>scripts/adminpanel/business/import.js']);
		    });
		</script>
	
	