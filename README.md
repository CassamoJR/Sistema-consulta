# Sistema ANAPRO (PHP MVC)

Plataforma institucional da ANAPRO com cadastro de membros, validação administrativa e gestão financeira.

## Requisitos

- PHP 8.1+
- MySQL 8+

## Configuração

1. Copie o ambiente:
   ```bash
   cp .env.example .env
   ```
2. Crie a base de dados e execute o schema:
   ```bash
   mysql -u root -p anapro < database/schema.sql
   ```
3. (Opcional) carregar admin padrão:
   ```bash
   mysql -u root -p anapro < database/seed.sql
   ```
4. Inicie o servidor:
   ```bash
   php -S 0.0.0.0:8000 -t public
   ```

## Login administrativo padrão

- **Email:** admin@anapro.org
- **Senha:** Admin@123

> Altere a senha após o primeiro acesso.
