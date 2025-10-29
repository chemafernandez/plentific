<?php
require_once __DIR__ . '/vendor/autoload.php';

use Chema\ApiService\Exceptions\ApiException;
use Chema\ApiService\UserService;

const PAGE = 1;	// valid values: 1,2

$service = new UserService();

try {
	$usersList = $service->getUsersListByPage(PAGE);
	print_r($usersList);
	echo json_encode($usersList);
} catch (ApiException $e) {
	echo $e->getMessage();
}
?>
