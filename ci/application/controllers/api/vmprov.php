<?php defined('BASEPATH') OR exit('No direct script access allowed');



// set the PHP timelimit to 10 minutes
set_time_limit(0);

require APPPATH.'/libraries/REST_Controller.php';

class vmprov extends REST_Controller
{

	function prov_post()
	{
		$jsond = json_decode(file_get_contents('php://input'),TRUE);
		$vmname = $jsond['vmname'];
                $ipaddr = $jsond['ipaddr'];
                $subnet = $jsond['subnet'];
                $gateway = $jsond['gateway'];
                $pdns = $jsond['pdns'];
                $sdns = $jsond['sdns'];
                $vlan = $jsond['vlan'];
                $cluster = $jsond['cluster'];
                $specification = $jsond['specification'];
                $template = $jsond['template'];
                $owner = $jsond['owner'];
                $backup = $jsond['backup'];
                $purpose = $jsond['purpose'];
                $support = $jsond['support'];
                
                $command="powershell -ExecutionPolicy Unrestricted c:\powershell\provision_new_vm.ps1 $cluster $specification $vmname $ipaddr $subnet $gateway $pdns $sdns $vlan $owner $backup" .  ' """' . $purpose . '""" ' . "$support $template";
		exec($command, $out);
                /* some troubleshooting
                $fp = fopen('c:\users\dadjensen\desktop\phpdebug.log', 'w');
                fwrite($fp, $command);
                fclose($fp);
                end troubleshooting */	
                //SQL connection stuff
                include 'sql.php';
                $result = mysql_query("insert into provvm values ('$vmname','$cluster','$specification','$owner','$backup','$template',CURRENT_TIMESTAMP)");
                mysql_close();
                //output
                $retArr = array('status' => 'success', 'vmname' => $out);
                $ret = json_encode($retArr);
		$this->response($ret, 200);
                
	}


}
?>
