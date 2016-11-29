<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<div class='panel panel-default '>
    <div class='panel-heading'>
        <i class='fa fa-table'></i> 广告管理 查看信息 
        <div class='panel-tools'>
            <div class='btn-group'>
            	<a class="btn " href="<?php echo base_url('adminpanel/advertisement')?>"><span class="glyphicon glyphicon-arrow-left"></span> 返回 </a>
            </div>
        </div>
    </div>
    <div class='panel-body '>
<div class="form-horizontal"  >
	<fieldset>
        <legend>基本信息</legend>
     
  	  	
	<div class="form-group">
				<label for="title" class="col-sm-2 control-label form-control-static">名称</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['title'])?$data_info['title']:'' ?>
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="image" class="col-sm-2 control-label form-control-static">广告配图</label>
				<div class="col-sm-9 ">
					<img src='<?php echo SITE_URL;?><?php echo  isset($data_info['image'])?('uploadfile/'.$data_info['image']):'' ?>' width="100" />
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="href" class="col-sm-2 control-label form-control-static">链接地址</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['href'])?$data_info['href']:'' ?>
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="sort" class="col-sm-2 control-label form-control-static">排序</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['sort'])?$data_info['sort']:'' ?>
				</div>
			</div>
	  	
	<div class="form-group">
				<label for="is_delete" class="col-sm-2 control-label form-control-static">是否有效</label>
				<div class="col-sm-9 form-control-static ">
					<?php echo isset($data_info['is_delete'])?$data_info['is_delete']:'' ?>
				</div>
			</div>
	    </fieldset>
	</div>
</div>
</div>
