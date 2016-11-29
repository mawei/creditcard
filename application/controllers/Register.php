<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require("ChuanglanSmsApi.php");
class Register extends Front_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->library ( 'encrypt' );
		$this->key = '&(*&(*';
		$this->load->library('qrcode');
	}

	
	function index()
	{
		$ads = $this->db->query("select * from `t_aci_advertisement` where is_delete='是' order by sort")->result_array();
		$salesman = $this->format_get("salesman");
		$this->view('index',array('date'=>date('Y-m-d H:i:s'),'require_js'=>true,'salesman'=>$salesman,'ads'=>$ads));
	}

	function success()
	{
		$ads = $this->db->query("select * from `t_aci_advertisement` where is_delete='是' order by sort")->result_array();

		$business_id = $this->format_get("business_id");
		$r = $this->db->query ( "select href_a,business_code from `t_aci_business` where business_id = '{$business_id}' " )->result_array ();
		$random = mt_rand ( 111111, 999999 );
		$path = "qrcode/qrcode_". $random .".png";
		$business_code = "";
		if(count($r) > 0)
		{
			$this->qrcode->png($r[0]["href_a"],$path,'L',6);
			$business_code = $r[0]['business_code'];
		}

		$this->view('success',array('date'=>date('Y-m-d H:i:s'),'require_js'=>true,'path'=>$path,'ads'=>$ads,'business_code'=>$business_code));
	}


	public function register() {
		$authcode = $this->format_get ( 'authcode' );
		$telephone = $this->format_get ( 'customer_telephone' );
		$secret_telephone = $this->encrypt->decode ( $this->format_get ( 'secret_telephone' ), $this->key );
		$auth_code_secret = $this->encrypt->decode ( $this->format_get ( 'secret_authcode' ), $this->key );
		$salesman =  $this->format_get("salesman");
		$customer_name = $this->format_get ('customer_name');

		if($telephone == "")
		{
			$this->output_result ( - 1, 'failed', '手机号码不能为空' );
		}
		if($customer_name == "")
		{
			$this->output_result ( - 1, 'failed', '姓名不能为空' );
		}
		if($authcode == "")
		{
			$this->output_result ( - 1, 'failed', '验证码不能为空' );
		}

		if ($authcode != $auth_code_secret) {
			$this->output_result ( - 1, 'failed', '验证码错误' );
		}
		$result = $this->db->query ( "select * from `t_aci_business` where customer_telephone = '{$telephone}'" )->result_array ();
		
		if (count ( $result ) >= 1) {
			$this->output_result ( - 1, 'failed', '该用户已注册' );
		} else {
			
			$data['salesman'] = $salesman;
			$data['customer_name'] = $customer_name;
			$data['customer_telephone'] = $telephone;

			$r = $this->db->query ( "select * from `t_aci_business` where salesman = '{$salesman}' and (customer_telephone = '' or customer_telephone is null)" )->result_array ();
			if(count($r) > 0)
			{
				$this->db->query ( "update `t_aci_business` set customer_telephone={$telephone},customer_name='{$customer_name}',customer_create_time=now() where business_id={$r[0]['business_id']}" );
				$this->output_result ( 0, 'success', $r[0]['business_id'] );
			}else{
				$this->output_result ( - 1, 'failed', '注册失败，请联系业务员' );
			}
		}
	}


	public function get_authcode() {
		$telephone = $this->format_get ( 'telephone' );
		$authcode = mt_rand ( 111111, 999999 );
	
		$res['telephone'] = $this->encrypt->encode ( $telephone, $this->key );
		$res['authcode'] = $this->encrypt->encode ( $authcode, $this->key );
	
		$result = $this->db->query ( "select * from `t_aci_business` where customer_telephone = '{$telephone}'" )->result_array ();

		if(count($result) == 0)
		{
			$clapi  = new ChuanglanSmsApi();
			$result = $clapi->sendSMS($telephone, '您好，您的验证码是'.$authcode);
			$result = $clapi->execResult($result);
			if(isset($result[1]) && $result[1]==0){
				$this->output_result(0, $res['telephone'], $res['authcode']);
			}else{
				$this->output_result(-1, 'failed', '发送失败');
			}
		}else{
			$this->output_result(-1, 'failed', '该手机号已注册');
		}
	}

	private function format_get($param, $default = "") {
		return (isset ( $_GET [$param] ) && $_GET [$param] != "") ? trim(urldecode ( addslashes ( str_replace ( '+', '%2B', urlencode ( $_GET [$param] ) ) ) )) : $default;
	}
	private function format_post($param, $default = "") {
		return (isset ( $_POST [$param] ) && $_POST [$param] != "") ? trim(urldecode ( addslashes ( str_replace ( '+', '%2B', urlencode ( $_POST [$param] ) ) ) )) : $default;
	}
	
	private function output_result($code, $message, $data) {
		$result = array ();
		$result ['code'] = $code;
		$result ['message'] = $message;
		$result ['data'] = $data;
		echo json_encode ( $result );

		exit ();
	}

}