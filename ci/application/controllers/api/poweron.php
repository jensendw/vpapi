<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class poweron extends REST_Controller
{

	function prov_post()
	{
		$jsond = json_decode(file_get_contents('php://input'),TRUE);
		$vmname = $jsond['vmname'];
		exec("powershell -ExecutionPolicy Unrestricted c:\powershell\poweron.ps1 $vmname", $out);
		//$retArr = array('status' => 'success', 'vmname' => $vmname);	
                $retArr = array('status' => 'success', 'vmname' => $out);
                $ret = json_encode($retArr);
		$this->response($ret, 200);
	}


}
?>