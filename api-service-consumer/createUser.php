<?php
require_once __DIR__ . '/vendor/autoload.php';

use Chema\ApiService\Exceptions\ApiException;
use Chema\ApiService\UserService;

$userData = [
	'first_name'	=> 'Chema',
	'last_name' 	=> 'Fernandez',
	'job'			=> 'Senior Developer',
];

$service = new UserService();

try {
	$userId = $service->createUser($userData);
	print_r($userId);
} catch (ApiException $e) {
	echo $e->getMessage();
}
?>
