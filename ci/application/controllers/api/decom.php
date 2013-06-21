<?php defined('BASEPATH') OR exit('No direct script access allowed');



// set the PHP timelimit to 2 hours
set_time_limit(7200);

require APPPATH.'/libraries/REST_Controller.php';

class decom extends REST_Controller
{

	function prov_post()
	{
		$jsond = json_decode(file_get_contents('php://input'),TRUE);
		$vmname = $jsond['vmname'];
                $deletedate = $jsond['deletedate'];
                $decomby = $jsond['decomby'];
                $ticket = $jsond['ticket'];
                $command="powershell -ExecutionPolicy Unrestricted c:\powershell\poweroff.ps1 $vmname $decomby $deletedate";
		exec($command, $out);
                
                /*some troubleshooting
                $fp = fopen('c:\users\dadjensen\desktop\phpdebug.log', 'w');
                fwrite($fp, $command);
                fwrite($fp, $decomby);
                fwrite($fp, $deletedate);
                fclose($fp);
                //end troubleshooting */
                
                //SQL connection stuff
                include 'sql.php';
                $result = mysql_query("insert into decom values ('$vmname',CURRENT_TIMESTAMP,'$deletedate','$decomby','$ticket')");
                mysql_close();
                //output
                $retArr = array('status' => 'success', 'vmname' => $out);
                $ret = json_encode($retArr);
		$this->response($ret, 200);
                
	}


}
?>
