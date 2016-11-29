<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<form class="form-horizontal" role="form" id="validateform" name="validateform" action="<?php echo base_url('adminpanel/advertisement/edit')?>" >
	<div class='panel panel-default '>
		<div class='panel-heading'>
			<i class='fa fa-table'></i> 广告管理 修改信息
			<div class='panel-tools'>
				<div class='btn-group'>
					<a class="btn " href="<?php echo base_url('adminpanel/advertisement')?>"><span class="glyphicon glyphicon-arrow-left"></span> 返回 </a>
				</div>
			</div>
		</div>
		<div class='panel-body '>
								<fieldset>
						<legend>基本信息</legend>
													
	<div class="form-group">
				<label for="title" class="col-sm-2 control-label form-control-static">名称</label>
				<div class="col-sm-9 ">
					<input type="text" name="title"  id="title"  value='<?php echo isset($data_info['title'])?$data_info['title']:'' ?>'  class="form-control validate[required]"  placeholder="请输入名称" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="image" class="col-sm-2 control-label form-control-static">广告配图</label>
				<div class="col-sm-9 ">
					<a id="image_a"  ><img  width="100" id="image_SRC" border="1" src="<?php echo SITE_URL?><?php echo isset($data_info["image"])?"uploadfile".$data_info["image"]:"images/nopic.gif" ?>"/></a>
<input type="hidden" id="image" name="image" value="<?php echo isset($data_info["image"])?$data_info["image"]:"" ?>" /> <a id="image_b" class="btn btn-default btn-sm" > 选择图片 ...</a><span class="help-block">只支持图片上传.</span>
				</div>
			</div>
													
	<div class="form-group">
				<label for="href" class="col-sm-2 control-label form-control-static">链接地址</label>
				<div class="col-sm-9 ">
					<input type="text" name="href"  id="href"  value='<?php echo isset($data_info['href'])?$data_info['href']:'' ?>'  class="form-control validate[required]"  placeholder="请输入链接地址" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="sort" class="col-sm-2 control-label form-control-static">排序</label>
				<div class="col-sm-9 ">
					<input type="number" name="sort"  id="sort"  value='<?php echo isset($data_info['sort'])?$data_info['sort']:'' ?>'   class="form-control  validate[required,custom[integer]]" placeholder="请输入排序" >
				</div>
			</div>
													
	<div class="form-group">
				<label for="is_delete" class="col-sm-2 control-label form-control-static">是否有效</label>
				<div class="col-sm-9 ">
					<label class="radio-inline">  <input type="radio" class=" validate[required]" name="is_delete"  id="is_delete1" value="是" <?php if(isset($data_info['is_delete'])&&(trim($data_info['is_delete'])=='是')) { ?> checked="checked" <?php } ?>            > 是</label><label class="radio-inline">  <input type="radio"  class=" validate[required]" name="is_delete"  id="is_delete2" value="否"<?php if(isset($data_info['is_delete'])&&(trim($data_info['is_delete'])=='否')) { ?> checked="checked" <?php } ?>            > 否</label>
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
		        require(['<?php echo SITE_URL?>scripts/adminpanel/advertisement/edit.js']);
		    });
		</script>
	
	