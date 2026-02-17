<?php
/**
 * Configuração de Conexão com Banco de Dados
 * Arquivo: config.php
 */

// Configurações do banco de dados
define('DB_HOST', 'localhost:3306');
define('DB_USER', 'root');           // Altere conforme seu usuário MySQL
define('DB_PASS', '');                // Altere conforme sua senha MySQL
define('DB_NAME', 'conveniencia_db');

// Cria conexão
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Define charset UTF-8
$conn->set_charset("utf8mb4");

// Inicia sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Função para verificar se usuário está logado
 */
function verificarLogin() {
    if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
        header("Location: login.php");
        exit;
    }
}

/**
 * Função para limpar entrada de dados
 */
function limparEntrada($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

/**
 * Função para buscar informações da loja
 */
function buscarInformacoes() {
    global $conn;
    $sql = "SELECT * FROM informacoes LIMIT 1";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

/**
 * Função para buscar produtos em destaque
 */
function buscarProdutos() {
    global $conn;
    $sql = "SELECT * FROM produtos_destaque WHERE ativo = TRUE ORDER BY ordem ASC, id DESC";
    $result = $conn->query($sql);
    $produtos = [];
    while($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
    return $produtos;
}

/**
 * Função para buscar promoções ativas
 */
function buscarPromocoes() {
    global $conn;
    $sql = "SELECT * FROM promocoes WHERE ativo = TRUE AND (validade >= CURDATE() OR validade IS NULL) ORDER BY id DESC";
    $result = $conn->query($sql);
    $promocoes = [];
    while($row = $result->fetch_assoc()) {
        $promocoes[] = $row;
    }
    return $promocoes;
}
?>
