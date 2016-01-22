<?php
function unserialize_handler($errno, $errstr){
	restore_error_handler();
	echo "Invalid serialized value.\n";
}
$serialized = 'foo';
set_error_handler('unserialize_handler');
$original = unserialize($serialized);
?>
