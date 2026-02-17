<?php
require_once 'config.php';
verificarLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    
    try {
        switch ($tipo) {
            case 'informacoes':
                $nome_loja = limparEntrada($_POST['nome_loja']);
                $slogan = limparEntrada($_POST['slogan']);
                $sobre = limparEntrada($_POST['sobre']);
                
                $sql = "UPDATE informacoes SET 
                        nome_loja = ?, 
                        slogan = ?, 
                        sobre = ? 
                        WHERE id = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $nome_loja, $slogan, $sobre);
                $stmt->execute();
                
                $_SESSION['sucesso'] = 'Informações gerais atualizadas com sucesso!';
                break;
                
            case 'localizacao':
                $endereco = limparEntrada($_POST['endereco']);
                $cidade = limparEntrada($_POST['cidade']);
                $estado = strtoupper(limparEntrada($_POST['estado']));
                $cep = limparEntrada($_POST['cep']);
                
                $sql = "UPDATE informacoes SET 
                        endereco = ?, 
                        cidade = ?, 
                        estado = ?, 
                        cep = ? 
                        WHERE id = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $endereco, $cidade, $estado, $cep);
                $stmt->execute();
                
                $_SESSION['sucesso'] = 'Localização atualizada com sucesso!';
                break;
                
            case 'contato':
                $telefone = limparEntrada($_POST['telefone']);
                $whatsapp = limparEntrada($_POST['whatsapp']);
                $email = limparEntrada($_POST['email']);
                
                $sql = "UPDATE informacoes SET 
                        telefone = ?, 
                        whatsapp = ?, 
                        email = ? 
                        WHERE id = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $telefone, $whatsapp, $email);
                $stmt->execute();
                
                $_SESSION['sucesso'] = 'Informações de contato atualizadas com sucesso!';
                break;
                
            case 'horarios':
                $horario_semana = limparEntrada($_POST['horario_semana']);
                $horario_fds = limparEntrada($_POST['horario_fds']);
                
                $sql = "UPDATE informacoes SET 
                        horario_semana = ?, 
                        horario_fds = ? 
                        WHERE id = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $horario_semana, $horario_fds);
                $stmt->execute();
                
                $_SESSION['sucesso'] = 'Horários de funcionamento atualizados com sucesso!';
                break;
                
            case 'social':
                $facebook = limparEntrada($_POST['facebook']);
                $instagram = limparEntrada($_POST['instagram']);
                
                $sql = "UPDATE informacoes SET 
                        facebook = ?, 
                        instagram = ? 
                        WHERE id = 1";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $facebook, $instagram);
                $stmt->execute();
                
                $_SESSION['sucesso'] = 'Redes sociais atualizadas com sucesso!';
                break;
                
            default:
                $_SESSION['sucesso'] = 'Tipo de atualização não reconhecido.';
        }
        
    } catch (Exception $e) {
        $_SESSION['sucesso'] = 'Erro ao atualizar: ' . $e->getMessage();
    }
    
    header("Location: admin.php");
    exit;
    
} else {
    header("Location: admin.php");
    exit;
}
?>
