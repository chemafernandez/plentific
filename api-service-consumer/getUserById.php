<?php
require_once __DIR__ . '/vendor/autoload.php';

use Chema\ApiService\UserService;

const USER_ID = 1;	// valid values between 1 and 12

try {
	$service = new UserService();
	$userDetails = $service->getUserById(USER_ID);
	print_r($userDetails->toArray());
	echo json_encode($userDetails);
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
