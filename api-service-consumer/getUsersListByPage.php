<?php
require_once __DIR__ . '/vendor/autoload.php';

use Chema\ApiService\UserService;

const PAGE = 1;	// valid values: 1,2

try {
	$service = new UserService();
	$usersList = $service->getUsersListByPage(PAGE);
	print_r($usersList);
	echo json_encode($usersList);
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
