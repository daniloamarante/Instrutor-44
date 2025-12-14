<?php
// Arquivo de exemplo de configuração
// Copie este arquivo para config.php e ajuste as credenciais

define('DB_HOST', 'localhost:3306');  // ou localhost:3307 se usar porta diferente
define('DB_USER', 'root');            // seu usuário do MySQL
define('DB_PASS', '');                // sua senha do MySQL
define('DB_NAME', 'instrutor44');     // nome do banco de dados

define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/instrutor44');
define('SITE_NAME', 'Encontre Instrutor');

define('UPLOAD_PATH', APP_ROOT . '/public/uploads/');
define('UPLOAD_URL', URL_ROOT . '/public/uploads/');

session_start();
