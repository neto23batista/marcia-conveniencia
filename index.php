<?php
require_once 'config.php';

// Buscar dados do banco
$info = buscarInformacoes();
$produtos = buscarProdutos();
$promocoes = buscarPromocoes();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($info['slogan'] ?? ''); ?>">
    <meta name="keywords" content="conveniência, produtos, lanches, bebidas">
    <title><?php echo htmlspecialchars($info['nome_loja'] ?? 'Conveniência'); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="header-content">
            <h1><?php echo htmlspecialchars($info['nome_loja'] ?? 'Minha Conveniência'); ?></h1>
            <p class="slogan"><?php echo htmlspecialchars($info['slogan'] ?? 'Sempre aberto para você!'); ?></p>
        </div>
    </header>

    <!-- SOBRE -->
    <section id="sobre">
        <div class="container">
            <h2>Sobre Nós</h2>
            <div class="info-box">
                <p style="font-size: 1.1rem; line-height: 1.8; text-align: center; color: #555;">
                    <?php echo nl2br(htmlspecialchars($info['sobre'] ?? 'Bem-vindo à nossa conveniência!')); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- INFORMAÇÕES -->
    <section id="informacoes">
        <div class="container">
            <h2>Como nos Encontrar</h2>
            <div class="info-box">
                <h3><i class="fas fa-map-marker-alt"></i> Localização</h3>
                <div class="info-item">
                    <strong>Endereço:</strong> 
                    <?php 
                    echo htmlspecialchars($info['endereco'] ?? '');
                    if ($info['cidade']) echo ', ' . htmlspecialchars($info['cidade']);
                    if ($info['estado']) echo ' - ' . htmlspecialchars($info['estado']);
                    if ($info['cep']) echo ' | CEP: ' . htmlspecialchars($info['cep']);
                    ?>
                </div>
                
                <?php if ($info['telefone']): ?>
                <div class="info-item">
                    <strong>Telefone:</strong> 
                    <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $info['telefone']); ?>" 
                       style="color: var(--cor-principal); text-decoration: none;">
                        <?php echo htmlspecialchars($info['telefone']); ?>
                    </a>
                </div>
                <?php endif; ?>
                
                <?php if ($info['whatsapp']): ?>
                <div class="info-item">
                    <strong>WhatsApp:</strong> 
                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $info['whatsapp']); ?>" 
                       target="_blank"
                       style="color: var(--cor-sucesso); text-decoration: none;">
                        <?php echo htmlspecialchars($info['whatsapp']); ?> 
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
                <?php endif; ?>
                
                <?php if ($info['email']): ?>
                <div class="info-item">
                    <strong>E-mail:</strong> 
                    <a href="mailto:<?php echo htmlspecialchars($info['email']); ?>" 
                       style="color: var(--cor-principal); text-decoration: none;">
                        <?php echo htmlspecialchars($info['email']); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <div class="info-box">
                <h3><i class="fas fa-clock"></i> Horário de Funcionamento</h3>
                <div class="info-item">
                    <strong>Dias de Semana:</strong> 
                    <?php echo htmlspecialchars($info['horario_semana'] ?? 'Consulte-nos'); ?>
                </div>
                <div class="info-item">
                    <strong>Finais de Semana:</strong> 
                    <?php echo htmlspecialchars($info['horario_fds'] ?? 'Consulte-nos'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUTOS EM DESTAQUE -->
    <?php if (count($produtos) > 0): ?>
    <section id="produtos">
        <div class="container">
            <h2>Produtos em Destaque</h2>
            <div class="produtos-grid">
                <?php foreach ($produtos as $produto): ?>
                <div class="produto-card">
                    <div class="produto-header">
                        <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                        <?php if ($produto['categoria']): ?>
                        <span class="categoria-badge"><?php echo htmlspecialchars($produto['categoria']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="produto-body">
                        <?php if ($produto['descricao']): ?>
                        <p><?php echo htmlspecialchars($produto['descricao']); ?></p>
                        <?php endif; ?>
                        <?php if ($produto['preco']): ?>
                        <div class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- PROMOÇÕES -->
    <?php if (count($promocoes) > 0): ?>
    <section id="promocoes">
        <div class="container">
            <h2>Promoções Imperdíveis</h2>
            <div class="promocoes-container">
                <?php foreach ($promocoes as $promo): ?>
                <div class="promocao-card pulse-animation">
                    <h3><?php echo htmlspecialchars($promo['titulo']); ?></h3>
                    <?php if ($promo['descricao']): ?>
                    <p><?php echo htmlspecialchars($promo['descricao']); ?></p>
                    <?php endif; ?>
                    
                    <?php if ($promo['valor_antigo'] && $promo['valor_novo']): ?>
                    <div class="preco-promocao">
                        <span class="preco-antigo">R$ <?php echo number_format($promo['valor_antigo'], 2, ',', '.'); ?></span>
                        <span class="preco-novo">R$ <?php echo number_format($promo['valor_novo'], 2, ',', '.'); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($promo['validade']): ?>
                    <div class="validade">
                        <i class="fas fa-calendar-alt"></i> 
                        Válido até: <?php echo date('d/m/Y', strtotime($promo['validade'])); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <p style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">
                <?php echo htmlspecialchars($info['nome_loja'] ?? 'Conveniência'); ?>
            </p>
            <p style="opacity: 0.8;">
                <?php echo htmlspecialchars($info['slogan'] ?? ''); ?>
            </p>
            
            <div class="social-links">
                <?php if ($info['facebook']): ?>
                <a href="<?php echo htmlspecialchars($info['facebook']); ?>" target="_blank" title="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <?php endif; ?>
                
                <?php if ($info['instagram']): ?>
                <a href="https://instagram.com/<?php echo ltrim(htmlspecialchars($info['instagram']), '@'); ?>" 
                   target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <?php endif; ?>
                
                <?php if ($info['whatsapp']): ?>
                <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $info['whatsapp']); ?>" 
                   target="_blank" title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <?php endif; ?>
            </div>
            
            <p style="margin-top: 2rem; opacity: 0.6; font-size: 0.9rem;">
                &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($info['nome_loja'] ?? ''); ?>. Todos os direitos reservados.
            </p>
            
            <p style="margin-top: 0.5rem; opacity: 0.4; font-size: 0.8rem;">
                <a href="login.php" style="color: white; text-decoration: none;">Área Administrativa</a>
            </p>
        </div>
    </footer>

    <script>
        // Animação de scroll suave
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Animação de entrada dos elementos
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.info-box, .produto-card, .promocao-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>
