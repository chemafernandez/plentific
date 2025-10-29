<?php
require_once __DIR__ . '/vendor/autoload.php';

use Chema\ApiService\Exceptions\ApiException;
use Chema\ApiService\UserService;

const USER_ID = 1;	// valid values between 1 and 12

$service = new UserService();

try {
	$userDetails = $service->getUserById(USER_ID);
	print_r($userDetails->toArray());
	echo json_encode($userDetails);
} catch (ApiException $e) {
	echo $e->getMessage();
}
?>
