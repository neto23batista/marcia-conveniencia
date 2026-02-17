-- Banco de Dados para Sistema de Conveniência
-- Execute este script no seu MySQL/phpMyAdmin

CREATE DATABASE IF NOT EXISTS conveniencia_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE conveniencia_db;

-- Tabela de administradores
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir usuário padrão (usuário: admin, senha: admin123)
INSERT INTO admin (usuario, senha, nome) VALUES 
('admin', MD5('admin123_salt'), 'Administrador');

-- Tabela de informações da conveniência
CREATE TABLE IF NOT EXISTS informacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_loja VARCHAR(200) NOT NULL DEFAULT 'Minha Conveniência',
    slogan TEXT,
    endereco TEXT,
    cidade VARCHAR(100),
    estado VARCHAR(2),
    cep VARCHAR(10),
    telefone VARCHAR(20),
    whatsapp VARCHAR(20),
    email VARCHAR(100),
    horario_semana VARCHAR(100),
    horario_fds VARCHAR(100),
    sobre TEXT,
    facebook VARCHAR(200),
    instagram VARCHAR(200),
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserir dados iniciais
INSERT INTO informacoes (
    nome_loja, 
    slogan, 
    endereco, 
    cidade, 
    estado, 
    cep, 
    telefone, 
    whatsapp, 
    email,
    horario_semana, 
    horario_fds, 
    sobre,
    instagram
) VALUES (
    'Conveniência Central',
    'Sempre aberto para você!',
    'Rua das Flores, 123',
    'São José do Rio Preto',
    'SP',
    '15000-000',
    '(17) 3333-4444',
    '(17) 99999-8888',
    'contato@convenienciacentral.com.br',
    'Segunda a Sexta: 6h às 23h',
    'Sábado e Domingo: 7h às 22h',
    'Somos uma conveniência completa, oferecendo produtos de qualidade e atendimento diferenciado. Venha nos visitar!',
    '@convenienciacentral'
);

-- Tabela de produtos em destaque
CREATE TABLE IF NOT EXISTS produtos_destaque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2),
    categoria VARCHAR(50),
    imagem_url VARCHAR(500),
    ativo BOOLEAN DEFAULT TRUE,
    ordem INT DEFAULT 0,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Produtos de exemplo
INSERT INTO produtos_destaque (nome, descricao, preco, categoria, ordem) VALUES
('Combo Café da Manhã', 'Café + Pão na Chapa + Suco', 12.90, 'Combos', 1),
('Cerveja Gelada', 'Diversas marcas sempre geladas', 5.50, 'Bebidas', 2),
('Lanche Artesanal', 'Hambúrguer artesanal com batata', 18.90, 'Lanches', 3),
('Açaí Tradicional', 'Açaí cremoso com frutas', 15.00, 'Sobremesas', 4);

-- Tabela de promoções
CREATE TABLE IF NOT EXISTS promocoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT,
    valor_antigo DECIMAL(10,2),
    valor_novo DECIMAL(10,2),
    validade DATE,
    ativo BOOLEAN DEFAULT TRUE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Promoções de exemplo
INSERT INTO promocoes (titulo, descricao, valor_antigo, valor_novo, validade, ativo) VALUES
('Super Combo', 'Refrigerante 2L + Salgado', 15.00, 10.90, DATE_ADD(CURDATE(), INTERVAL 30 DAY), TRUE),
('Happy Hour', 'Cerveja em dobro das 17h às 19h', 8.00, 6.00, DATE_ADD(CURDATE(), INTERVAL 7 DAY), TRUE);
