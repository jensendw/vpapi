<?php
$cluster="HASPCluster";
$specification="Autodeploy";
$vmname="dantestwoot";
$ipaddr="192.168.1.2";
$subnet="255.255.255.0";
$gateway="192.168.1.1";
$pdns="8.8.8.8";
$sdns="4.4.4.4";
$vlan="VLAN126";
$owner="djensen@homeaway.com";
$backup="N";
$purpose="this is a purpose with a space";
$support="hosting";
$template="W2K8R2_current";

$command="powershell -ExecutionPolicy Unrestricted c:\powershell\provision_new_vm.ps1 $cluster $specification $vmname $ipaddr $subnet $gateway $pdns $sdns $vlan $owner $backup" .  ' "' . $purpose . '" ' . "$support $template";
exec($command, $out);
echo $command;
echo $out;
?>
