<?php
require_once 'config.php';

$erro = '';
$sucesso = '';

// Processar login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = limparEntrada($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    if (empty($usuario) || empty($senha)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        // Verificar credenciais
        $senha_hash = md5($senha . '_salt');
        $sql = "SELECT * FROM admin WHERE usuario = ? AND senha = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $senha_hash);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nome'] = $admin['nome'];
            $_SESSION['admin_usuario'] = $admin['usuario'];
            
            header("Location: admin.php");
            exit;
        } else {
            $erro = 'Usuário ou senha incorretos.';
        }
    }
}

// Se já está logado, redireciona
if (isset($_SESSION['admin_logado']) && $_SESSION['admin_logado'] === true) {
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Área Administrativa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div style="text-align: center; margin-bottom: 2rem;">
                <i class="fas fa-user-shield" style="font-size: 4rem; color: var(--cor-principal);"></i>
            </div>
            
            <h2>Área Administrativa</h2>
            
            <?php if ($erro): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $erro; ?>
            </div>
            <?php endif; ?>
            
            <?php if ($sucesso): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $sucesso; ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="usuario">
                        <i class="fas fa-user"></i> Usuário
                    </label>
                    <input 
                        type="text" 
                        id="usuario" 
                        name="usuario" 
                        placeholder="Digite seu usuário"
                        required
                        autofocus
                        value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>"
                    >
                </div>
                
                <div class="form-group">
                    <label for="senha">
                        <i class="fas fa-lock"></i> Senha
                    </label>
                    <input 
                        type="password" 
                        id="senha" 
                        name="senha" 
                        placeholder="Digite sua senha"
                        required
                    >
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
            </form>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="index.php" style="color: var(--cor-principal); text-decoration: none; font-weight: 600;">
                    <i class="fas fa-arrow-left"></i> Voltar ao Site
                </a>
            </div>
            
            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 2px solid #f0f0f0; text-align: center; font-size: 0.85rem; color: #999;">
                <i class="fas fa-info-circle"></i> Usuário padrão: <strong>admin</strong> | Senha: <strong>admin123</strong>
            </div>
        </div>
    </div>

    <script>
        // Animação de shake quando há erro
        <?php if ($erro): ?>
        const loginBox = document.querySelector('.login-box');
        loginBox.style.animation = 'shake 0.5s';
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-10px); }
                75% { transform: translateX(10px); }
            }
        `;
        document.head.appendChild(style);
        <?php endif; ?>
    </script>
</body>
</html>
