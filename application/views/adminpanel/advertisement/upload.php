<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?><?php defined('BASEPATH') or exit('No permission resources.'); ?>
<script type="text/javascript">
<!--
function doCheck() 
{
	if(document.formupload.upload.value == '') {
		alert('请选择文件!');
		return false;
	}
	return true;
}

function previewimage()
{
	<?php if($is_image) { ?>
		if(doucment.formupload.picpath.value) $("#previewpic").attr("src", doucment.formupload.upload.value);
	<?php } ?>
}

//-->
</script>
<div class="container">
<div class="jumbotron">
  <div class="container">
    <div class="media">
     <?php if($is_image) { ?>
      <a class="media-left" href="#" target="_blank">
        <img id="previewpic" src="<?php echo base_url('/images/nopic.gif')?>" width="100">
      </a>
     <?php } ?>
      <div class="media-body">
        <h4 class="media-heading">允许上传类型：gif|jpg|jpeg|png|bmp</h4>
         <form name="formupload" method="post" action="<?php echo current_url()?>" enctype="multipart/form-data" onSubmit="return doCheck();">
      		<input name="upload" type="file" size="15" onChange="previewimage()">
             <input type="hidden" name="oldname"><br/>
             <input type="submit" name="dosubmit" value=" 上传 " class="btn btn-info">
      	</form>
      </div>
    </div>
  </div>
</div>
</div>

<?php if($is_image) { ?>
<script type="text/javascript">
<!--
if($(window.parent.document).find("#<?php echo $control_id;?>").val())
{
    $("#previewpic").attr("src", "#<?php echo $upload_url;?>"+$(window.parent.document).find("#<?php echo $control_id;?>").val()); 
}
else
{
	$("#previewpic").attr("src",SITE_URL+"<?php echo base_url('/images/nopic.gif')?>");
}
//-->
</script>
<?php } ?>