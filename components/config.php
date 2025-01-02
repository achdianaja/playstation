<?php
$rootPath = 'playstation/';
$currentPage = $_SERVER['SCRIPT_NAME'];

$currentDepth = substr_count($_SERVER['SCRIPT_NAME'], '/') - 1;

$baseLink = str_repeat('../', $currentDepth) . $rootPath;

$logoPath = $baseLink . "public/assets/logo-ps.png";

// $trashIcon = $baseLink . 'public/images/assets/trash.png';
// $pencilIcon = $baseLink . 'public/images/assets/pencil.png';
// $resetPassIcon = $baseLink . 'public/images/assets/reset-password.png';
