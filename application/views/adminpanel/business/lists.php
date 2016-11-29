<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<div class='panel panel-default grid'>
    <div class='panel-heading'>
        <i class='fa fa-table'></i> 商户号列表
        <div class='panel-tools'>
            <div class='btn-group'>
                 <a class="btn " href="<?php echo base_url('adminpanel/business/add')?>"><span class="glyphicon glyphicon-plus"></span> 添加 </a>
                 <a class="btn " href="<?php echo base_url('adminpanel/business/import')?>"><span class="glyphicon glyphicon-plus"></span> 导入 </a>  
                                  <a class="btn " href="<?php echo base_url('adminpanel/business/output')?>"><span class="glyphicon glyphicon-plus"></span> 导出 </a>             </div>
           </div>
            <div class='badge'><?php echo count($data_list)?></div>
        </div>
    </div>
        <div class='panel-filter '>
      <div class='row'>
        <div class='col-md-12'>
        <form class="form-inline" role="form" method="get">
          
<div class="form-group">
<label for="keyword" class="control-label form-control-static">关键词</label>
<input class="form-control" type="text" name="keyword"  value="<?php echo isset($data_info['keyword'])? $data_info['keyword']:"";?>" id="keyword" placeholder="请输入关键词"/></div>
<button type="submit" name="dosubmit" value="搜索" class="btn btn-success"><i class='glyphicon glyphicon-search'></i></button>        </form>
        </div>
      </div> 
    </div>
          <form method="post" id="form_list"  action="<?php echo base_url('adminpanel/business/delete_all')?>"  > 
    <div class='panel-body '>
    <?php if($data_list):?>
        <table class="table table-hover dataTable" id="checkAll">
          <thead>
            <tr>
              <th>#</th>
                            <?php $css=""; $next_url = base_url('adminpanel/business?order=business_code&dir=desc'); ?>
              <?php if(($order=='business_code'&&$dir=='desc')) { ?>
              <?php $css="sorting_desc";$next_url = base_url('adminpanel/business?order=business_code&dir=asc'); ?>
              <?php } elseif (($order=='business_code'&&$dir=='asc')) { ?>
              <?php $css="sorting_asc";?>
              <?php } ?><th class="sorting <?php echo $css;?>"   onclick="window.location.href='<?php echo $next_url;?>'"   nowrap="nowrap">商户号</th>
                            <?php $css=""; $next_url = base_url('adminpanel/business?order=salesman&dir=desc'); ?>
              <?php if(($order=='salesman'&&$dir=='desc')) { ?>
              <?php $css="sorting_desc";$next_url = base_url('adminpanel/business?order=salesman&dir=asc'); ?>
              <?php } elseif (($order=='salesman'&&$dir=='asc')) { ?>
              <?php $css="sorting_asc";?>
              <?php } ?><th class="sorting <?php echo $css;?>"   onclick="window.location.href='<?php echo $next_url;?>'"   nowrap="nowrap">业务员号</th>
                            <?php $css=""; $next_url = base_url('adminpanel/business?order=customer_telephone&dir=desc'); ?>
              <?php if(($order=='customer_telephone'&&$dir=='desc')) { ?>
              <?php $css="sorting_desc";$next_url = base_url('adminpanel/business?order=customer_telephone&dir=asc'); ?>
              <?php } elseif (($order=='customer_telephone'&&$dir=='asc')) { ?>
              <?php $css="sorting_asc";?>
              <?php } ?><th class="sorting <?php echo $css;?>"   onclick="window.location.href='<?php echo $next_url;?>'"   nowrap="nowrap">客户手机号</th>
                            <?php $css=""; $next_url = base_url('adminpanel/business?order=customer_create_time&dir=desc'); ?>
              <?php if(($order=='customer_create_time'&&$dir=='desc')) { ?>
              <?php $css="sorting_desc";$next_url = base_url('adminpanel/business?order=customer_create_time&dir=asc'); ?>
              <?php } elseif (($order=='customer_create_time'&&$dir=='asc')) { ?>
              <?php $css="sorting_asc";?>
              <?php } ?><th class="sorting <?php echo $css;?>"   onclick="window.location.href='<?php echo $next_url;?>'"   nowrap="nowrap">用户注册时间</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($data_list as $k=>$v):?>
            <tr>
              <td><input type="checkbox" name="pid[]" value="<?php echo $v['business_id']?>" /></td>
                             <td><?php echo $v['business_code']?></td>
                            <td><?php echo $v['salesman']?></td>
                            <td><?php echo $v['customer_telephone']?></td>
                            <td><?php echo $v['customer_create_time']?></td>
              <td>
                            	<a href="<?php echo base_url('adminpanel/business/readonly/'.$v['business_id'])?>"  class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt"></span> 查看</a>
                                            <a href="<?php echo base_url('adminpanel/business/edit/'.$v['business_id'])?>"  class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> 修改</a>
                                            <button type="button" class="btn btn-default btn-xs delete-btn" value="<?php echo $v['business_id'];?>"><span class="glyphicon glyphicon-remove"></span> 删除</button>
                
              </td>
            </tr>
            <?php endforeach;?>
            
          </tbody>
        </table> 
    	</div>
      <div class="panel-footer">
        <div class="pull-left">
          <div class="btn-group">
                  <button type="button" class="btn btn-default" id="reverseBtn"><span class="glyphicon glyphicon-ok"></span> 反选</button>
            <button type="button" id="deleteBtn"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除勾选</button>
                 </div>
      </div>
        <div class="pull-right">
        <?php echo $pages;?>
        </div>
      </div> 
      </form>  
  </div>
<?php else:?>
    <div class="no-result">-- 暂无数据 -- </div>
<?php endif;?>

	    <script language="javascript" type="text/javascript">
    require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
        require(['<?php echo SITE_URL?>scripts/adminpanel/business/lists.js']);
    });
</script>
    