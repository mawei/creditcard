<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * AutoCodeIgniter.com
 *
 * 基于CodeIgniter核心模块自动生成程序
 *
 * 源项目		AutoCodeIgniter
 * 作者：		AutoCodeIgniter.com Dev Team EMAIL:hubinjie@outlook.com QQ:5516448
 * 版权：		Copyright (c) 2015 , AutoCodeIgniter com.
 * 项目名称：商户号 
 * 版本号：1 
 * 最后生成时间：2016-11-18 17:15:35 
 */
class Business extends Admin_Controller {
	
    var $method_config;
    function __construct()
	{
		parent::__construct();
		$this->load->model(array('business_model'));
        $this->load->helper(array('auto_codeIgniter_helper','array'));
        //$this->load->helper ( array ('form', 'url', 'common' ) );
        $this->load->library ( array( 'form_validation' ,'PHPExcel','PHPExcel/IOFactory'));
  
        $this->method_config['upload'] = array(
                                'file'=>array('upload_size'=>100000,'upload_file_type'=>'xlsx|xls','upload_path'=>'uploadfile','upload_url'=>'upload'),
                                );

        //保证排序安全性
        $this->method_config['sort_field'] = array(
										'business_code'=>'business_code',
										'href_a'=>'href_a',
										'salesman'=>'salesman',
										'customer_telephone'=>'customer_telephone',
										'customer_create_time'=>'customer_create_time',
										'business_create_time'=>'business_create_time',
										);
	}
    
    /**
     * 默认首页列表
     * @param int $pageno 当前页码
     * @return void
     */
    function index($page_no=0,$sort_id=0)
    {
    	$page_no = max(intval($page_no),1);
        
        $orderby = "business_id desc";
        $dir = $order=  NULL;
		$order=isset($_GET['order'])?safe_replace(trim($_GET['order'])):'';
		$dir=isset($_GET['dir'])?safe_replace(trim($_GET['dir'])):'asc';
        
        if(trim($order)!="")
        {
        	//如果找到得
        	if(isset($this->method_config['sort_field'][strtolower($order)]))
            {
            	if(strtolower($dir)=="asc")
            		$orderby = $this->method_config['sort_field'][strtolower($order)]." asc," .$orderby;
                 else
            		$orderby = $this->method_config['sort_field'][strtolower($order)]." desc," .$orderby;
            }
        }
                
        $where ="";
        $_arr = NULL;//从URL GET
        if (isset($_GET['dosubmit'])) {
        	$where_arr = NULL;
			$_arr['keyword'] =isset($_GET['keyword'])?safe_replace(trim($_GET['keyword'])):'';
			if($_arr['keyword']!="") $where_arr[] = "concat(business_code,salesman,customer_telephone) like '%{$_arr['keyword']}%'";
                
		        
        
		        
        	if($where_arr)$where = implode(" and ",$where_arr);
        }

        	$data_list = $this->business_model->listinfo($where,'*',$orderby , $page_no, $this->business_model->page_size,'',$this->business_model->page_size,page_list_url('adminpanel/business/index',true));
        if($data_list)
        {
            	foreach($data_list as $k=>$v)
            	{
					$data_list[$k] = $this->_process_datacorce_value($v);
            	}
        }
    	$this->view('lists',array('require_js'=>true,'data_info'=>$_arr,'order'=>$order,'dir'=>$dir,'data_list'=>$data_list,'pages'=>$this->business_model->pages));
    }
    
    /**
     * 处理数据源结
     * @param array v 
     * @return array
     */
    function _process_datacorce_value($v,$is_edit_model=false)
    {
         return $v;
    }
     /**
     * 新增数据
     * @param AJAX POST 
     * @return void
     */
    function add()
    {
    	//如果是AJAX请求
    	if($this->input->is_ajax_request())
		{
        	//接收POST参数
			$_arr['business_code'] = isset($_POST["business_code"])?trim(safe_replace($_POST["business_code"])):exit(json_encode(array('status'=>false,'tips'=>'商户号必填')));
			if($_arr['business_code']=='')exit(json_encode(array('status'=>false,'tips'=>'商户号必填')));
			$_arr['href_a'] = isset($_POST["href_a"])?trim(safe_replace($_POST["href_a"])):'';
			$_arr['salesman'] = isset($_POST["salesman"])?trim(safe_replace($_POST["salesman"])):'';
			$_arr['customer_telephone'] = isset($_POST["customer_telephone"])?trim(safe_replace($_POST["customer_telephone"])):'';
			$_arr['customer_create_time'] = isset($_POST["customer_create_time"])?trim(safe_replace($_POST["customer_create_time"])):'';
			if($_arr['customer_create_time']!=''){
			if(!is_datetime($_arr['customer_create_time']))exit(json_encode(array('status'=>false,'tips'=>'用户注册时间输入错误')));
			}
			$_arr['business_create_time'] = isset($_POST["business_create_time"])?trim(safe_replace($_POST["business_create_time"])):'';
			if($_arr['business_create_time']!=''){
			if(!is_datetime($_arr['business_create_time']))exit(json_encode(array('status'=>false,'tips'=>'商户导入时间输入错误')));
			}
			
            $new_id = $this->business_model->insert($_arr);
            if($new_id)
            {
				exit(json_encode(array('status'=>true,'tips'=>'信息新增成功','new_id'=>$new_id)));
            }else
            {
            	exit(json_encode(array('status'=>false,'tips'=>'信息新增失败','new_id'=>0)));
            }
        }else
        {
        	$this->view('edit',array('require_js'=>true,'is_edit'=>false,'id'=>0,'data_info'=>$this->business_model->default_info()));
        }
    }

    function import()
    {
        //如果是AJAX请求
        if($this->input->is_ajax_request())
        {
            $uploadfile = isset($_POST["import_file"])?trim(safe_replace($_POST["import_file"])):exit(json_encode(array('status'=>false,'tips'=>'请选择要上传的文件')));
            $uploadfile = UPLOAD_PATH.$uploadfile;
            //str_replace('"', "", $uploadfile);
            /////////////////////////读取excel
            $extension = pathinfo($uploadfile)['extension'];
            if( $extension =='xlsx' )
            {
             $objReader = new PHPExcel_Reader_Excel2007();
            }
            else
            {
             $objReader = new PHPExcel_Reader_Excel5();
            }
            $objPHPExcel = $objReader->load($uploadfile);//加载目标Excel
            $sheet = $objPHPExcel->getSheet(0);//读取第一个sheet
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $succ_result=$error_result=$repeat_result=0;//设置导入成功和失败的总数为0
        
            //入库
            for($j=1;$j<=$highestRow;$j++)
            {
                $strExcel='';
                $arr = array();
                $arr['business_code'] = $objPHPExcel->getActiveSheet()->getCell("A$j")->getValue();
                $arr['href_a'] = $objPHPExcel->getActiveSheet()->getCell("B$j")->getValue();
                $arr['salesman'] = $objPHPExcel->getActiveSheet()->getCell("C$j")->getValue();
                $r = $this->db->query("select business_id from `t_aci_business` where business_code='{$arr['business_code']}'")->result_array();
                if(count($r) == 0)
                {
                    $this->db->insert('t_aci_business',$arr);
                    $succ_result ++;
                }else{
                    $error_result++;
                }
            }
            exit(json_encode(array('status'=>true,'tips'=>'导入完成,导入'.$succ_result.'条,重复'.$repeat_result.'条','new_id'=>0)));

        }else
        {
            $this->view('import',array('require_js'=>true,'is_edit'=>false,'id'=>0,'data_info'=>$this->business_model->default_info()));
        }
    }

    function output()
    {
        $data = $this->db->query("select * from `t_aci_business` where (customer_telephone != '' && customer_telephone is not null)")->result_array();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("")
                               ->setLastModifiedBy("")
                               ->setTitle("商户导出表")
                               ->setSubject("商户数据")
                               ->setDescription("商户数据")
                               ->setKeywords("商户数据")
                              ->setCategory("result file");
         /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
          $objPHPExcel->setActiveSheetIndex(0)
             //Excel的第A列，uid是你查出数组的键值，下面以此类推
              ->setCellValue('A1', "商户编号")    
              ->setCellValue('B1',"链接")
              ->setCellValue('C1',"客户名字")
              ->setCellValue('D1',"客户电话")
              ->setCellValue('E1',"业务员编号")
              ->setCellValue('F1',"客户注册时间");
        
        foreach($data as $k => $v){
             $num=$k+2;
             $objPHPExcel->setActiveSheetIndex(0)
                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
                          ->setCellValue('A'.$num, $v['business_code'])    
                          ->setCellValue('B'.$num, $v['href_a'])
                          ->setCellValue('C'.$num, $v['customer_name'])
                          ->setCellValue('D'.$num, $v['customer_telephone'])
                          ->setCellValue('E'.$num, $v['salesman'])
                          ->setCellValue('F'.$num, $v['customer_create_time']);
            }
            $objPHPExcel->getActiveSheet()->setTitle('User');
            $objPHPExcel->setActiveSheetIndex(0);
             header('Content-Type: application/vnd.ms-excel');
             $name = "客户数据导出";
             header('Content-Disposition: attachment;filename="'.$name.'.xlsx"');
             header('Cache-Control: max-age=0');
             $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
             $objWriter->save('php://output');
             exit;
    }


     /**
     * 删除单个数据
     * @param int id 
     * @return void
     */
    function delete_one($id=0)
    {
    	$id = intval($id);
        $data_info =$this->business_model->get_one(array('business_id'=>$id));
        if(!$data_info)$this->showmessage('信息不存在');
        $status = $this->business_model->delete(array('business_id'=>$id));
        if($status)
        {
        	$this->showmessage('删除成功');
        }else
        	$this->showmessage('删除失败');
    }

    /**
     * 删除选中数据
     * @param post pid 
     * @return void
     */
    function delete_all()
    {
        if(isset($_POST))
		{
			$pidarr = isset($_POST['pid']) ? $_POST['pid'] : $this->showmessage('无效参数', HTTP_REFERER);
			$where = $this->business_model->to_sqls($pidarr, '', 'business_id');
			$status = $this->business_model->delete($where);
			if($status)
			{
				$this->showmessage('操作成功', HTTP_REFERER);
			}else 
			{
				$this->showmessage('操作失败');
			}
		}
    }
     /**
     * 修改数据
     * @param int id 
     * @return void
     */
    function edit($id=0)
    {
    	$id = intval($id);
        
        $data_info =$this->business_model->get_one(array('business_id'=>$id));
    	//如果是AJAX请求
    	if($this->input->is_ajax_request())
		{
        	if(!$data_info)exit(json_encode(array('status'=>false,'tips'=>'信息不存在')));
        	//接收POST参数
			$_arr['business_code'] = isset($_POST["business_code"])?trim(safe_replace($_POST["business_code"])):exit(json_encode(array('status'=>false,'tips'=>'商户号必填2')));
			if($_arr['business_code']=='')exit(json_encode(array('status'=>false,'tips'=>'商户号必填2')));
			$_arr['href_a'] = isset($_POST["href_a"])?trim(safe_replace($_POST["href_a"])):'';
			$_arr['salesman'] = isset($_POST["salesman"])?trim(safe_replace($_POST["salesman"])):'';
			$_arr['customer_telephone'] = isset($_POST["customer_telephone"])?trim(safe_replace($_POST["customer_telephone"])):'';
			$_arr['customer_create_time'] = isset($_POST["customer_create_time"])?trim(safe_replace($_POST["customer_create_time"])):'';
			if($_arr['customer_create_time']!=''){
			if(!is_datetime($_arr['customer_create_time']))exit(json_encode(array('status'=>false,'tips'=>'用户注册时间输入错误')));
			}
			$_arr['business_create_time'] = isset($_POST["business_create_time"])?trim(safe_replace($_POST["business_create_time"])):'';
			if($_arr['business_create_time']!=''){
			if(!is_datetime($_arr['business_create_time']))exit(json_encode(array('status'=>false,'tips'=>'商户导入时间输入错误')));
			}
			
            $status = $this->business_model->update($_arr,array('business_id'=>$id));
            if($status)
            {
				exit(json_encode(array('status'=>true,'tips'=>'信息修改成功')));
            }else
            {
            	exit(json_encode(array('status'=>false,'tips'=>'信息修改失败')));
            }
        }else
        {
        	if(!$data_info)$this->showmessage('信息不存在');
            $data_info = $this->_process_datacorce_value($data_info,true);
        	$this->view('edit',array('require_js'=>true,'data_info'=>$data_info,'is_edit'=>true,'id'=>$id));
        }
    }

    /**
     * 上传附件
     * @param string $fieldName 字段名
     * @param string $controlId HTML控件ID
     * @param string $callbackJSfunction 是否返回函数
     * @return void
     */
    function upload()
    {
        $fieldName = 'file';
        if(isset($_POST['dosubmit']))
        {
            $upload_path = $this->method_config['upload'][$fieldName]['upload_path'];
           
           if($upload_path=='')die('缺少上传参数');
           
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = $this->method_config['upload'][$fieldName]['upload_file_type'];
            $config['max_size'] = $this->method_config['upload'][$fieldName]['upload_size'];
            $config['overwrite']  = FALSE;
            $config['encrypt_name']=false;
            $config['file_name']=date('Ymdhis').random_string('nozero',4);
            dir_create($upload_path);//创建正式文件夹
            $this->load->library('upload', $config);
             
            if ( ! $this->upload->do_upload('file')) 
            {
                $result = '-1';
            }else{
                $filedata =  $this->upload->data();
                $file_name = $filedata['file_name'];
                $file_size = $filedata['file_size'];
                $result = $file_name;
            }
            echo json_encode($result);
        }else
        {
            $this->view('upload',array('require_js'=>true,'hidden_menu'=>true,'field_name'=>$fieldName,'control_id'=>$controlId,'upload_url'=>$this->method_config['upload']['file']['upload_url'],'is_image'=>$isImage));
        }
    }


  
     /**
     * 只读查看数据
     * @param int id 
     * @return void
     */
    function readonly($id=0)
    {
    	$id = intval($id);
        $data_info =$this->business_model->get_one(array('business_id'=>$id));
        if(!$data_info)$this->showmessage('信息不存在');
		$data_info = $this->_process_datacorce_value($data_info);
        
        $this->view('readonly',array('require_js'=>true,'data_info'=>$data_info));
    }

}

// END business class

/* End of file business.php */
/* Location: ./business.php */
?>