<?php
require_once __DIR__ . '/vendor/autoload.php';

use Chema\ApiService\UserService;

$userData = [
	'first_name'	=> 'Chema',
	'last_name' 	=> 'Fernandez',
	'job'			=> 'Senior Developer',
];

try {
	$service = new UserService();
	$userId = $service->createUser($userData);
	print_r($userId);
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
