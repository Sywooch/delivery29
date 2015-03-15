<?php
$j = [
	'status'=>true,
	'response'=>array(),
];

if (isset($success))
{
	$j['status'] = true;
	$j['response'] = $success;
}

if (isset($error))
{
	$j['status'] = false;
	$j['response'] = $error;
}

echo json_encode($j);
?>