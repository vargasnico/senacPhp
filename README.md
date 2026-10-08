# Site Senac — PHP

Site institucional de uma escola técnica, com páginas de cursos, cadastro e login de usuários e formulário de contato. Foi desenvolvido em 2024, nas aulas do curso técnico em Tecnologia da Informação do Senac Tech, com PHP, HTML, CSS e MySQL.

## Funcionalidades

- Páginas de apresentação da instituição, dos cursos técnicos e de localização
- Cadastro de usuários e login com sessão
- Formulário "Fale Conosco" com as mensagens salvas no banco

## Revisão em 2026

Já na graduação em Engenharia de Software, revisei o projeto e corrigi problemas que eu não conhecia quando o escrevi:

| Problema | Correção |
| --- | --- |
| **SQL injection:** valores do formulário concatenados direto nas queries | Prepared statements em todas as consultas |
| **Senhas com MD5**, um hash rápido e sem salt | `password_hash` / `password_verify` (bcrypt) |
| **XSS:** nome do usuário impresso na página sem escape | `htmlspecialchars` na saudação |
| Erros do banco exibiam a query SQL na página | Detalhes vão para o log do servidor |
| A mensagem do "Fale Conosco" nunca era salva (variável não lida do formulário) | Campo lido e validado, e confirmação de e-mail checada |
| Logout falhava: redirecionamento depois do HTML já enviado | `logout.php` dedicado |
| Bloco de sessão copiado em 11 páginas | Um único include em `includes/saudacao.php` |
| Páginas `.html` duplicando as `.php` e sem script do banco | Duplicatas removidas e `database/schema.sql` criado |

Cada correção está em um commit separado, para facilitar a leitura do histórico.

## Como rodar

Com [Docker](https://www.docker.com/):

```sh
docker compose up --build
```

O site fica em http://localhost:8080. O banco é criado automaticamente a partir de `database/schema.sql`.

Também funciona no XAMPP: copie a pasta para `htdocs` e importe `database/schema.sql` no phpMyAdmin.

## Estrutura

| Caminho | Conteúdo |
| --- | --- |
| `index.php` | Página inicial |
| `paginas/` | Páginas do site, formulários e scripts que processam cadastro, login e contato |
| `cursos/` | Páginas de detalhe dos cursos técnicos |
| `includes/` | Trechos compartilhados entre as páginas |
| `database/schema.sql` | Criação do banco e das tabelas |
| `css/`, `imagens/` | Estilos e imagens |
