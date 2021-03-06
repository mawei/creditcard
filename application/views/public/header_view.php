<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
<!--     <meta name="description" content="<?php echo $description?>">
    <meta name="keyword" content="<?php echo $keyword?>">
    <meta name="author" content="autocodeigniter.com">
    <link rel="icon" href="favicon.ico"> -->
    <title>获取|微信支付|支付宝|京东钱包|二维码收款|0.38%秒到</title>


    <!-- Bootstrap core CSS -->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_CSS_PATH?>steup.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="http://v3.bootcss.com/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://v3.bootcss.com/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <?php if(isset($require_js)):?>
    <script language="javascript" type="text/javascript"> var SITE_URL = "<?php echo SITE_URL?>";</script>
    <script src="<?php echo base_url('/scripts/require.js')?>" ></script>
    <?php else:?>
    <script src="<?php echo base_url('/scripts/lib/jquery.js')?>" ></script>
    <script src="<?php echo base_url('/scripts/lib/jquery-ui-1.10.0.custom.min.js')?>"></script>
    <script src="<?php echo base_url('/scripts/lib/jquery.datetimepicker.js')?>"></script>
    <script src="<?php echo base_url('/scripts/lib/jquery.validationEngine-zh_CN.js')?>" ></script>
    <script src="<?php echo base_url('/scripts/lib/jquery.validationEngine.js')?>" ></script>
    <script src="<?php echo base_url('/scripts/lib/global.js')?>"></script>
    <?php endif;?>
  </head>

  <body>