<?php
require_once 'config.php';
verificarLogin();

// Buscar dados atuais
$info = buscarInformacoes();
$produtos = buscarProdutos();
$promocoes = buscarPromocoes();

$sucesso = $_SESSION['sucesso'] ?? '';
unset($_SESSION['sucesso']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background: #f5f5f5;">
    <!-- HEADER ADMIN -->
    <header class="admin-header">
        <div class="container">
            <div class="admin-nav">
                <h1><i class="fas fa-tachometer-alt"></i> Painel Administrativo</h1>
                <div>
                    <span style="margin-right: 1.5rem; opacity: 0.9;">
                        <i class="fas fa-user"></i> Olá, <strong><?php echo htmlspecialchars($_SESSION['admin_nome']); ?></strong>
                    </span>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="admin-container">
        <?php if ($sucesso): ?>
        <div class="alert alert-success" style="animation: slideInDown 0.5s ease-out;">
            <i class="fas fa-check-circle"></i> <?php echo $sucesso; ?>
        </div>
        <?php endif; ?>

        <div style="text-align: center; margin: 2rem 0;">
            <a href="index.php" target="_blank" style="color: var(--cor-principal); text-decoration: none; font-size: 1.1rem; font-weight: 600;">
                <i class="fas fa-external-link-alt"></i> Visualizar Site Público
            </a>
        </div>

        <!-- INFORMAÇÕES GERAIS -->
        <div class="admin-card">
            <h3><i class="fas fa-store"></i> Informações Gerais da Loja</h3>
            <form method="POST" action="update.php">
                <input type="hidden" name="tipo" value="informacoes">
                
                <div class="form-group">
                    <label for="nome_loja">Nome da Loja</label>
                    <input type="text" id="nome_loja" name="nome_loja" 
                           value="<?php echo htmlspecialchars($info['nome_loja']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="slogan">Slogan</label>
                    <input type="text" id="slogan" name="slogan" 
                           value="<?php echo htmlspecialchars($info['slogan']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="sobre">Sobre a Conveniência</label>
                    <textarea id="sobre" name="sobre" rows="4"><?php echo htmlspecialchars($info['sobre']); ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-admin">
                    <i class="fas fa-save"></i> Salvar Informações Gerais
                </button>
            </form>
        </div>

        <div class="admin-grid">
            <!-- LOCALIZAÇÃO -->
            <div class="admin-card">
                <h3><i class="fas fa-map-marker-alt"></i> Localização</h3>
                <form method="POST" action="update.php">
                    <input type="hidden" name="tipo" value="localizacao">
                    
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" id="endereco" name="endereco" 
                               value="<?php echo htmlspecialchars($info['endereco']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" 
                               value="<?php echo htmlspecialchars($info['cidade']); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="estado">Estado (UF)</label>
                        <input type="text" id="estado" name="estado" maxlength="2"
                               value="<?php echo htmlspecialchars($info['estado']); ?>" 
                               style="text-transform: uppercase;">
                    </div>
                    
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep" 
                               value="<?php echo htmlspecialchars($info['cep']); ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-admin">
                        <i class="fas fa-save"></i> Salvar Localização
                    </button>
                </form>
            </div>

            <!-- CONTATO -->
            <div class="admin-card">
                <h3><i class="fas fa-phone"></i> Contato</h3>
                <form method="POST" action="update.php">
                    <input type="hidden" name="tipo" value="contato">
                    
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="telefone" 
                               value="<?php echo htmlspecialchars($info['telefone']); ?>"
                               placeholder="(17) 3333-4444">
                    </div>
                    
                    <div class="form-group">
                        <label for="whatsapp">WhatsApp</label>
                        <input type="text" id="whatsapp" name="whatsapp" 
                               value="<?php echo htmlspecialchars($info['whatsapp']); ?>"
                               placeholder="(17) 99999-8888">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo htmlspecialchars($info['email']); ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-admin">
                        <i class="fas fa-save"></i> Salvar Contato
                    </button>
                </form>
            </div>
        </div>

        <!-- HORÁRIOS -->
        <div class="admin-card">
            <h3><i class="fas fa-clock"></i> Horários de Funcionamento</h3>
            <form method="POST" action="update.php">
                <input type="hidden" name="tipo" value="horarios">
                
                <div class="form-group">
                    <label for="horario_semana">Horário de Segunda a Sexta</label>
                    <input type="text" id="horario_semana" name="horario_semana" 
                           value="<?php echo htmlspecialchars($info['horario_semana']); ?>"
                           placeholder="Ex: Segunda a Sexta: 6h às 23h">
                </div>
                
                <div class="form-group">
                    <label for="horario_fds">Horário de Finais de Semana</label>
                    <input type="text" id="horario_fds" name="horario_fds" 
                           value="<?php echo htmlspecialchars($info['horario_fds']); ?>"
                           placeholder="Ex: Sábado e Domingo: 7h às 22h">
                </div>
                
                <button type="submit" class="btn btn-admin">
                    <i class="fas fa-save"></i> Salvar Horários
                </button>
            </form>
        </div>

        <!-- REDES SOCIAIS -->
        <div class="admin-card">
            <h3><i class="fas fa-share-alt"></i> Redes Sociais</h3>
            <form method="POST" action="update.php">
                <input type="hidden" name="tipo" value="social">
                
                <div class="form-group">
                    <label for="facebook">Facebook (URL completa)</label>
                    <input type="url" id="facebook" name="facebook" 
                           value="<?php echo htmlspecialchars($info['facebook']); ?>"
                           placeholder="https://facebook.com/suapagina">
                </div>
                
                <div class="form-group">
                    <label for="instagram">Instagram (usuário)</label>
                    <input type="text" id="instagram" name="instagram" 
                           value="<?php echo htmlspecialchars($info['instagram']); ?>"
                           placeholder="@seuusuario">
                </div>
                
                <button type="submit" class="btn btn-admin">
                    <i class="fas fa-save"></i> Salvar Redes Sociais
                </button>
            </form>
        </div>

        <!-- PRODUTOS -->
        <div class="admin-card">
            <h3><i class="fas fa-shopping-basket"></i> Gerenciar Produtos</h3>
            
            <?php if (count($produtos) > 0): ?>
            <div style="max-height: 400px; overflow-y: auto; margin-bottom: 1.5rem; border: 2px solid #f0f0f0; border-radius: 12px; padding: 1rem;">
                <?php foreach ($produtos as $produto): ?>
                <div style="background: #f9f9f9; padding: 1rem; margin-bottom: 0.8rem; border-radius: 8px; border-left: 4px solid var(--cor-principal);">
                    <strong style="color: var(--cor-principal); font-size: 1.1rem;">
                        <?php echo htmlspecialchars($produto['nome']); ?>
                    </strong>
                    <?php if ($produto['categoria']): ?>
                    <span style="background: var(--cor-destaque); padding: 0.2rem 0.8rem; border-radius: 12px; font-size: 0.8rem; margin-left: 0.5rem;">
                        <?php echo htmlspecialchars($produto['categoria']); ?>
                    </span>
                    <?php endif; ?>
                    <br>
                    <span style="color: #666; font-size: 0.9rem;">
                        <?php echo htmlspecialchars($produto['descricao']); ?>
                    </span>
                    <?php if ($produto['preco']): ?>
                    <br>
                    <strong style="color: var(--cor-sucesso); font-size: 1.2rem;">
                        R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                    </strong>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p style="text-align: center; color: #999; padding: 2rem;">Nenhum produto cadastrado ainda.</p>
            <?php endif; ?>
            
            <p style="text-align: center; color: #666; font-size: 0.95rem; margin-top: 1rem;">
                <i class="fas fa-info-circle"></i> Para adicionar/editar produtos, acesse o banco de dados na tabela <code>produtos_destaque</code>
            </p>
        </div>

        <!-- PROMOÇÕES -->
        <div class="admin-card">
            <h3><i class="fas fa-tags"></i> Gerenciar Promoções</h3>
            
            <?php if (count($promocoes) > 0): ?>
            <div style="max-height: 400px; overflow-y: auto; margin-bottom: 1.5rem; border: 2px solid #f0f0f0; border-radius: 12px; padding: 1rem;">
                <?php foreach ($promocoes as $promo): ?>
                <div style="background: linear-gradient(135deg, #ffe5e5, #fff0f0); padding: 1rem; margin-bottom: 0.8rem; border-radius: 8px; border-left: 4px solid var(--cor-alerta);">
                    <strong style="color: var(--cor-alerta); font-size: 1.1rem;">
                        🔥 <?php echo htmlspecialchars($promo['titulo']); ?>
                    </strong>
                    <br>
                    <span style="color: #666; font-size: 0.9rem;">
                        <?php echo htmlspecialchars($promo['descricao']); ?>
                    </span>
                    <?php if ($promo['valor_antigo'] && $promo['valor_novo']): ?>
                    <br>
                    <span style="text-decoration: line-through; color: #999;">
                        R$ <?php echo number_format($promo['valor_antigo'], 2, ',', '.'); ?>
                    </span>
                    <strong style="color: var(--cor-alerta); font-size: 1.2rem; margin-left: 0.5rem;">
                        R$ <?php echo number_format($promo['valor_novo'], 2, ',', '.'); ?>
                    </strong>
                    <?php endif; ?>
                    <?php if ($promo['validade']): ?>
                    <br>
                    <span style="font-size: 0.85rem; color: #666;">
                        <i class="fas fa-calendar"></i> Válido até: <?php echo date('d/m/Y', strtotime($promo['validade'])); ?>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p style="text-align: center; color: #999; padding: 2rem;">Nenhuma promoção ativa no momento.</p>
            <?php endif; ?>
            
            <p style="text-align: center; color: #666; font-size: 0.95rem; margin-top: 1rem;">
                <i class="fas fa-info-circle"></i> Para adicionar/editar promoções, acesse o banco de dados na tabela <code>promocoes</code>
            </p>
        </div>
    </div>

    <footer style="background: var(--cor-escura); color: white; text-align: center; padding: 2rem; margin-top: 3rem;">
        <p>&copy; <?php echo date('Y'); ?> Painel Administrativo - Todos os direitos reservados</p>
    </footer>

    <script>
        // Auto-uppercase para campo Estado
        document.getElementById('estado').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });

        // Feedback visual ao salvar
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const btn = this.querySelector('button[type="submit"]');
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Salvando...';
                btn.disabled = true;
            });
        });

        // Auto-hide mensagem de sucesso após 5 segundos
        const alertSuccess = document.querySelector('.alert-success');
        if (alertSuccess) {
            setTimeout(() => {
                alertSuccess.style.opacity = '0';
                setTimeout(() => alertSuccess.remove(), 500);
            }, 5000);
        }
    </script>
</body>
</html>
