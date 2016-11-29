<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
<?php echo template('public','header_view',array('date'=>$date))?>
 <div class="col-xs-12 col-md-4 col-md-offset-4" style="background-color: ;height: 100%;padding: 1%;">
    <div class="col-xs-12 col-md-12" style="height:100%;border-radius:10px;background-image: url('/creditcard/images/bg.jpg');background-size:100% 100%">
        <div class="col-xs-3 col-md-3" style="height:10%;margin-top: 10%">
          <img class="img-responsive center-block" src="/creditcard/images/fulinmen_logo.png">
        </div>
        <div class="col-xs-3 col-md-3" " style="height:10%;margin-top: 10%">
            <img class="img-responsive center-block" width="120%" src="/creditcard/images/shihuijun_logo.png">
        </div>
        <div class="col-xs-6 col-md-6" style="height:10%;margin-top: 10%">
            <img class="img-responsive center-block" width="70%"  src="/creditcard/images/deshuo_logo.png">
        </div>
        <div class="col-xs-8 col-md-8 col-sm-offset-2 col-xs-offset-2" style="height:10%;">
            <img class="img-responsive center-block" src="/creditcard/images/yiyika_logo.png">
        </div>
        <div class="col-xs-8 col-md-8 col-sm-offset-2 col-xs-offset-2 " style="background-image: url('/creditcard/images/middle_bg.png');background-size: 100% 100%; height:52%;">
              <div class="" style="margin-top: 70%">
                <form class="form-horizontal" role="form" id="form">
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="姓名">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <input type="text" class="form-control" id="customer_telephone" name="customer_telephone" placeholder="手机号">
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-7 col-md-7">
                  <input type="text" class="form-control" id="authcode" name="authcode" placeholder="验证码">
                </div>
                <div class="col-xs-4 col-md-4">
                  <button type="button" class="btn btn-info btn-sm" id="get_auth_btn">验证码</button>
                </div>
              </div>


              <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                  <button type="button" class="btn btn-success" id="register">注册</button>
                </div>
              </div>
              <input type="hidden" name="secret_telephone" id="secret_telephone">
              <input type="hidden" name="secret_authcode" id="secret_authcode">
              <input type="hidden" name="salesman" id="salesman" value="<?php echo $salesman;?>">
            </form>              
            </div>

        </div>
        <div class="col-xs-12 col-md-12" style="margin-top: 22%" >
          <div class="col-xs-4 col-md-4">
                <img class="img-responsive center-block" src="/creditcard/images/weixin_logo.png">
          </div>

          <div class="col-xs-4 col-md-4">
                <img class="img-responsive center-block" src="/creditcard/images/zhifubao_logo.png">
          </div>
          <div class="col-xs-4 col-md-4">
                <img class="img-responsive center-block" width="60%" src="/creditcard/images/yinlian_logo.png">
          </div>
        </div>
    </div>

<div id="wrapper"><!-- 最外层部分 -->
    <div id="banner"><!-- 轮播部分 -->
      <ul class="imgList"><!-- 图片部分 -->
      <?php foreach ($ads as $val) {?>
      <li><a href="<?php echo $val['href'];?>"><img src="<?php echo UPLOAD_URL.$val['image'];?>" width="400px" height="200px" alt="<?php echo $val['title'];?>"></a></li>
      <?php }?>
      </ul>
    <!--   <img src="./img/prev.png" width="20px" height="40px" id="prev">
      <img src="./img/next.png" width="20px" height="40px" id="next"> -->
      <div class="bg"></div> <!-- 图片底部背景层部分-->
      <ul class="infoList"><!-- 图片左下角文字信息部分 -->
            <?php foreach ($ads as $val) {?>

        <li class="infoOn"><?php echo $val['title'];?></li>
              <?php }?>
      </ul>
      <ul class="indexList"><!-- 图片右下角序号部分 -->
        <?php foreach ($ads as $key=>$val) {?>

        <li <?if($key==0){?>class="indexOn"<?}?>><?php echo $key+1;?></li>
        <?php }?>
                    </ul>
    </div>
  </div>

 </div>


 <script type="text/javascript">
        require(['<?php echo SITE_URL?>scripts/common.js'], function (common) {
            require(['<?php echo SITE_URL?>scripts/adminpanel/business/edit.js']);
        });

        var wait=60;
        function time(o) {
            if (wait == 0) {
                o.removeAttr("disabled");           
                o.text("重新发送");
                wait = 60;
            } else {
                o.attr("disabled", true);
                o.text(wait);
                wait--;
                setTimeout(function() {
                    time(o)
                },
                1000)
            }
        }

       $("#get_auth_btn").click(function(){
          var customer_telephone = $("#customer_telephone").val();
          $.ajax({
          type: "GET",
          url: SITE_URL+"register/get_authcode?telephone="+customer_telephone,
          success:function(response){
            var dataObj=jQuery.parseJSON(response);
            if(dataObj.code!=0)
            {
              alert(dataObj.data);
            }else{
              $("#secret_telephone").val(dataObj.message);
              $("#secret_authcode").val(dataObj.data);
              time($("#get_auth_btn"));
            }
          },
          error: function (request, status, error) {
            $.scojs_message(request.responseText, $.scojs_message.TYPE_ERROR);
            $("#dosubmit").removeAttr("disabled");
          }
        });
       });

      $("#register").click(function(){

          $.ajax({
          type: "GET",
          url: SITE_URL+"register/register",
          data:  $("#form").serialize(),
          success:function(response){
            var dataObj=jQuery.parseJSON(response);
            if(dataObj.code==0)
            {
              alert("注册成功");
              window.location.href=SITE_URL+'register/success?business_id='+ dataObj.data; 

            }else
            {
              alert(dataObj.data);
            }
          },
          error: function (request, status, error) {
            $.scojs_message(request.responseText, $.scojs_message.TYPE_ERROR);
            $("#dosubmit").removeAttr("disabled");
          }
        });
      });

      var curIndex = 0, //当前index
      imgLen = $(".imgList li").length; //图片总数
     // 定时器自动变换2.5秒每次
  var autoChange = setInterval(function(){ 
    if(curIndex < imgLen-1){ 
      curIndex ++; 
    }else{ 
      curIndex = 0;
    }
    //调用变换处理函数
    changeTo(curIndex); 
  },2500);
   //左箭头滑入滑出事件处理
  $("#prev").hover(function(){ 
    //滑入清除定时器
    clearInterval(autoChange);
  },function(){ 
    //滑出则重置定时器
    autoChangeAgain();
  });
  //左箭头点击处理
  $("#prev").click(function(){ 
    //根据curIndex进行上一个图片处理
    curIndex = (curIndex > 0) ? (--curIndex) : (imgLen - 1);
    changeTo(curIndex);
  });
  //右箭头滑入滑出事件处理
  $("#next").hover(function(){ 
    //滑入清除定时器
    clearInterval(autoChange);
  },function(){ 
    //滑出则重置定时器
    autoChangeAgain();
  });
  //右箭头点击处理
  $("#next").click(function(){ 
    curIndex = (curIndex < imgLen - 1) ? (++curIndex) : 0;
    changeTo(curIndex);
  });
  //对右下角按钮index进行事件绑定处理等
  $(".indexList").find("li").each(function(item){ 
    $(this).hover(function(){ 
      clearInterval(autoChange);
      changeTo(item);
      curIndex = item;
    },function(){ 
      autoChangeAgain();
    });
  });
  //清除定时器时候的重置定时器--封装
  function autoChangeAgain(){ 
      autoChange = setInterval(function(){ 
      if(curIndex < imgLen-1){ 
        curIndex ++;
      }else{ 
        curIndex = 0;
      }
    //调用变换处理函数
      changeTo(curIndex); 
    },2500);
    }
  function changeTo(num){ 
    var goLeft = num * 400;
    $(".imgList").animate({left: "-" + goLeft + "px"},500);
    $(".infoList").find("li").removeClass("infoOn").eq(num).addClass("infoOn");
    $(".indexList").find("li").removeClass("indexOn").eq(num).addClass("indexOn");
  }

 </script>
 <style type="text/css">
  body,div,ul,li,a,img{margin: 0;padding: 0;}
  ul,li{list-style: none;}
  a{text-decoration: none;}
 
  #wrapper{position: relative;margin: 30px auto;width: 100%;height: 200px;}
  #banner{position:relative;width: 100%;height: 200px;overflow: hidden;}
  .imgList{position:relative;width:2000px;height:200px;z-index: 10;overflow: hidden;}
  .imgList li{float:left;display: inline;}
  #prev,
  #next{position: absolute;top:80px;z-index: 20;cursor: pointer;opacity: 0.2;filter:alpha(opacity=20);}
  #prev{left: 10px;}
  #next{right: 10px;}
  #prev:hover,
  #next:hover{opacity: 0.5;filter:alpha(opacity=50);}
  .bg{position: absolute;bottom: 0;width: 100%;height: 40px;z-index:20;opacity: 0.4;filter:alpha(opacity=40);background: black;}
  .infoList{position: absolute;left: 10px;bottom: 10px;z-index: 30;}
  .infoList li{display: none;}
  .infoList .infoOn{display: inline;color: white;}
  .indexList{position: absolute;right: 10px;bottom: 5px;z-index: 30;}
  .indexList li{float: left;margin-right: 5px;padding: 2px 4px;border: 2px solid black;background: grey;cursor: pointer;}
  .indexList .indexOn{background: red;font-weight: bold;color: white;}
</style>
<?php echo template('public','footer_view')?>