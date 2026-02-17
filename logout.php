<?php
/**
 * Script de Logout
 * Arquivo: logout.php
 */

session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Redirecionar para página de login
header("Location: login.php");
exit;
?>
