<?php

$fn = dirname(__FILE__).DIRECTORY_SEPARATOR."params.json";

if (file_exists($fn))
{
	$customParams = json_decode( file_get_contents($fn), true );
}
else
{
	$customParams = array();
}

return array_merge( $customParams,  [
    'adminEmail' => 'admin@example.com',
    'mediaPath' => dirname(__FILE__). DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'media',
    'mediaUrl' => '/media',
] );
