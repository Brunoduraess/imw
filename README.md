# IMW

Site institucional e painel administrativo de uma igreja, construído com Laravel 11 e Blade.

## Requisitos

- Docker com Docker Compose
- Node.js 22 e npm, para compilar os assets no host

O container da aplicação inclui PHP 8.3, Apache e Composer.

## Instalação

```bash
cp .env.example .env
docker compose -f docker/docker-compose.yml up -d --build
docker compose -f docker/docker-compose.yml exec app php artisan key:generate
docker compose -f docker/docker-compose.yml exec app php artisan migrate --seed
npm ci
npm run build
```

A aplicação fica disponível em `http://localhost:8001`.

## Desenvolvimento

```bash
docker compose -f docker/docker-compose.yml up -d
npm run dev
```

Comandos Laravel e Composer devem ser executados no container:

```bash
docker compose -f docker/docker-compose.yml exec app php artisan route:list
docker compose -f docker/docker-compose.yml exec app composer install
```

## Qualidade

Antes de abrir um pull request, execute:

```bash
docker compose -f docker/docker-compose.yml exec app composer check
npm run build
```

Os comandos de qualidade disponíveis são:

- `composer lint`: verifica o padrão de código com Laravel Pint;
- `composer lint:fix`: corrige automaticamente o padrão de código;
- `composer test`: executa os testes automatizados;
- `composer check`: executa lint e testes.

O workflow em `.github/workflows/quality.yml` executa as mesmas verificações e o build dos assets em pushes e pull requests.

## Estrutura principal

- `app/`: regras da aplicação, controllers, models e serviços;
- `resources/views/`: páginas Blade públicas e administrativas;
- `routes/web.php`: rotas web;
- `database/migrations/`: estrutura do banco de dados;
- `tests/`: testes unitários e de integração.

## Convenções

- Siga o padrão do Laravel Pint (`composer lint:fix`).
- Toda correção de bug deve incluir um teste que reproduza o problema.
- Novas regras de entrada devem usar Form Requests em vez de validação dentro de controllers.
- Operações que alteram dados devem usar `POST`, `PUT`, `PATCH` ou `DELETE`, nunca `GET`.
- Segredos e credenciais devem ficar no `.env` e nunca no repositório.
