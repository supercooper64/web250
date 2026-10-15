<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/db_credentials.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Bird.php';
require_once __DIR__ . '/classes/SandboxBird.php';

// Do not connect here. index.php connects inside its try/catch block.