# 🍺 Beer House Conveniência - Site Institucional com Painel Administrativo

Sistema completo de divulgação para conveniências com área administrativa protegida por login.
**Tema Premium: Dourado + Preto + Madeira** inspirado na Beer House.

## 📋 Características

✅ **Site Público Responsivo Premium**
- Design sofisticado com paleta Beer House (dourado, preto e madeira)
- Efeitos de texto gradiente dourado brilhante
- Animações suaves e elegantes
- Exibição de informações, produtos e promoções
- Links para redes sociais
- Totalmente responsivo (mobile-friendly)

✅ **Painel Administrativo Completo**
- Login seguro com sessões PHP
- Edição de todas as informações do site
- Interface intuitiva e moderna
- Atualização em tempo real

✅ **Segurança**
- Proteção por senha com hash MD5
- Validação de sessões
- Sanitização de dados de entrada
- Proteção contra SQL Injection

## 🚀 Instalação

### 1. Requisitos
- Servidor Web (Apache/Nginx)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- phpMyAdmin (recomendado)

### 2. Configuração do Banco de Dados

**Opção A: Usando phpMyAdmin**
1. Acesse o phpMyAdmin
2. Clique em "SQL" no menu superior
3. Cole todo o conteúdo do arquivo `database.sql`
4. Clique em "Executar"

**Opção B: Usando linha de comando**
```bash
mysql -u root -p < database.sql
```

### 3. Configuração da Conexão

Edite o arquivo `config.php` e ajuste as configurações do banco:

```php
define('DB_HOST', 'localhost');     // Host do banco
define('DB_USER', 'root');          // Seu usuário MySQL
define('DB_PASS', '');              // Sua senha MySQL
define('DB_NAME', 'conveniencia_db');
```

### 4. Upload dos Arquivos

Copie todos os arquivos para a pasta do seu servidor web:
- **XAMPP**: `C:/xampp/htdocs/conveniencia/`
- **WAMP**: `C:/wamp/www/conveniencia/`
- **Linux**: `/var/www/html/conveniencia/`

### 5. Permissões (Linux apenas)

```bash
chmod 755 /var/www/html/conveniencia/
chmod 644 /var/www/html/conveniencia/*.php
```

## 🔐 Acesso ao Sistema

### Site Público
```
http://localhost/conveniencia/index.php
```

### Área Administrativa
```
http://localhost/conveniencia/login.php
```

**Credenciais Padrão:**
- Usuário: `admin`
- Senha: `admin123`

⚠️ **IMPORTANTE**: Altere a senha padrão após o primeiro acesso!

## 📁 Estrutura de Arquivos

```
conveniencia/
│
├── config.php          # Configuração do banco de dados
├── database.sql        # Estrutura e dados iniciais do banco
├── index.php           # Página principal do site
├── login.php           # Página de login administrativo
├── admin.php           # Painel administrativo
├── update.php          # Script de atualização de dados
├── logout.php          # Script de logout
├── style.css           # Estilos do site
└── README.md           # Este arquivo
```

## 🗄️ Estrutura do Banco de Dados

### Tabela: `admin`
Armazena os usuários administrativos.

### Tabela: `informacoes`
Armazena todas as informações da conveniência:
- Nome da loja
- Slogan
- Sobre
- Endereço completo
- Telefones e e-mail
- Horários de funcionamento
- Redes sociais

### Tabela: `produtos_destaque`
Produtos em destaque no site:
- Nome
- Descrição
- Preço
- Categoria
- Status (ativo/inativo)

### Tabela: `promocoes`
Promoções ativas:
- Título
- Descrição
- Valores (antigo e novo)
- Data de validade
- Status (ativo/inativo)

## ⚙️ Funcionalidades do Painel Admin

### 📝 Informações Gerais
- Nome da loja
- Slogan
- Texto sobre a conveniência

### 📍 Localização
- Endereço completo
- Cidade e Estado
- CEP

### 📞 Contato
- Telefone fixo
- WhatsApp
- E-mail

### ⏰ Horários
- Horário de funcionamento (semana)
- Horário de funcionamento (fins de semana)

### 📱 Redes Sociais
- Facebook
- Instagram

### 🛒 Produtos e Promoções
- Visualização de produtos cadastrados
- Visualização de promoções ativas
- Gerenciamento via banco de dados

## 🔧 Como Adicionar Produtos

### Via phpMyAdmin:
1. Acesse a tabela `produtos_destaque`
2. Clique em "Inserir"
3. Preencha os campos:
   - `nome`: Nome do produto
   - `descricao`: Descrição breve
   - `preco`: Preço (ex: 12.90)
   - `categoria`: Categoria (ex: Lanches)
   - `ativo`: 1 (para exibir) ou 0 (para ocultar)
   - `ordem`: Ordem de exibição

### Via SQL:
```sql
INSERT INTO produtos_destaque (nome, descricao, preco, categoria, ativo, ordem) 
VALUES ('Suco Natural', 'Suco de laranja fresco', 8.50, 'Bebidas', TRUE, 1);
```

## 🎉 Como Adicionar Promoções

### Via phpMyAdmin:
1. Acesse a tabela `promocoes`
2. Clique em "Inserir"
3. Preencha os campos:
   - `titulo`: Título da promoção
   - `descricao`: Descrição
   - `valor_antigo`: Preço antigo
   - `valor_novo`: Preço promocional
   - `validade`: Data de validade (AAAA-MM-DD)
   - `ativo`: 1 (ativa) ou 0 (inativa)

### Via SQL:
```sql
INSERT INTO promocoes (titulo, descricao, valor_antigo, valor_novo, validade, ativo) 
VALUES ('Combo Especial', 'Lanche + Bebida', 25.00, 18.90, '2026-03-31', TRUE);
```

## 🔒 Alterando a Senha do Administrador

### Via phpMyAdmin:
1. Acesse a tabela `admin`
2. Edite o registro do usuário `admin`
3. No campo `senha`, insira: `MD5('sua_nova_senha_salt')`
4. Substitua `sua_nova_senha` pela senha desejada

### Via SQL:
```sql
UPDATE admin 
SET senha = MD5('minhasenha123_salt') 
WHERE usuario = 'admin';
```

## 🎨 Personalização do Design

### Paleta de Cores Beer House (em `style.css`):
```css
:root {
    --cor-principal: #D4A017;      /* Dourado elegante */
    --cor-secundaria: #FFD700;     /* Dourado brilho */
    --cor-destaque: #F4C430;       /* Dourado destaque */
    --cor-escura: #1a1a1a;         /* Preto elegante */
    --cor-madeira: #8B4513;        /* Tom de madeira */
    --cor-madeira-clara: #D2691E;  /* Madeira clara */
    --cor-sucesso: #4CAF50;        /* Verde sucesso */
    --cor-alerta: #FF6B35;         /* Laranja alerta */
    --dourado-brilho: linear-gradient(135deg, #D4A017 0%, #FFD700 50%, #F4C430 100%);
}
```

### Características do Design:
- **Fundo escuro sofisticado** (#1a1a1a e #2a2a2a)
- **Títulos com gradiente dourado** usando efeito de text-clip
- **Bordas e detalhes dourados** em todos os cards
- **Promoções em tons de madeira** para destaque
- **Sombras com brilho dourado** para profundidade
- **Efeitos hover elegantes** com transformações suaves

### Fontes:
- **Títulos**: Righteous (Google Fonts)
- **Texto**: Poppins (Google Fonts)

## 🐛 Solução de Problemas

### Erro de Conexão com Banco de Dados
- Verifique se o MySQL está rodando
- Confirme usuário e senha em `config.php`
- Verifique se o banco `conveniencia_db` foi criado

### Página em Branco
- Ative a exibição de erros no PHP:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### Login Não Funciona
- Verifique se a tabela `admin` foi criada
- Confirme que a senha está usando o formato `MD5('senha_salt')`
- Verifique as permissões de sessão do PHP

### Alterações Não Aparecem
- Limpe o cache do navegador (Ctrl + F5)
- Verifique se salvou corretamente no banco
- Confirme que o registro `id = 1` existe na tabela `informacoes`

## 📊 Recursos Avançados

### Backup do Banco de Dados
```bash
mysqldump -u root -p conveniencia_db > backup.sql
```

### Restauração
```bash
mysql -u root -p conveniencia_db < backup.sql
```

## 🌐 Deploy em Produção

1. **Altere as credenciais padrão**
2. **Use HTTPS** (certificado SSL)
3. **Configure permissões restritas**
4. **Habilite proteção CSRF**
5. **Faça backups regulares**
6. **Use senhas fortes** (mínimo 12 caracteres)

## 📞 Suporte

Para dúvidas ou problemas:
1. Verifique este README
2. Consulte a documentação do PHP/MySQL
3. Revise os logs de erro do servidor

## 📄 Licença

Este sistema foi desenvolvido para uso em conveniências e estabelecimentos similares.
Sinta-se livre para modificar e adaptar conforme suas necessidades.

---

**Desenvolvido com ❤️ para facilitar a divulgação de conveniências brasileiras!**

🇧🇷 **Versão 1.0** - Fevereiro 2026
