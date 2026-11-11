<?php

declare(strict_types=1);

require_once(dirname(__DIR__) . '/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/db_credentials.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Bird.php';
require_once __DIR__ . '/classes/Member.php';

$pdo = Database::connect();
Bird::set_database($pdo);
Member::set_database($pdo);