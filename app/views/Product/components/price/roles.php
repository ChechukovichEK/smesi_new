<?php
$status = $_SESSION['user']['status'] ?? 'guest';

switch ($status) {
	case 'master':
		require __DIR__ . '/role_master.php';
		break;
	
	case 'opt':
		require __DIR__ . '/role_opt.php';
		break;
	
	case 'client':
		require __DIR__ . '/role_client.php';
		break;
	
	default:
		require __DIR__ . '/role_client.php';
}
