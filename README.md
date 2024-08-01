# Teste Desenvolvedor Full Stack – Pleno+

## Objetivo
Desenvolver uma aplicação web que inclui uma interface de usuário (frontend) conectada a uma API REST.

## Tecnologias Utilizadas
- PHP 8.3
- MySQL 8.0.32
- Laravel 11
- Vue 3.2
- Vuex 4.0
- Vue Router 4.0
- Axios
- Docker
- Docker Compose

## Estrutura do Projeto
```plaintext
project-root/
├── backend/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── tests/
│   ├── composer.json
│   ├── composer.lock
│   ├── ...
├── docker/
│   ├── php/
│   │   ├── Dockerfile
│   │   └── entrypoint.sh
│   ├── vue/
│   │   └── Dockerfile
│   ├── docker-compose.yml
├── frontend/
│   ├── public/
│   ├── src/
│   │   ├── components/
│   │   ├── router/
│   │   ├── store/
│   │   ├── views/
│   │   ├── App.vue
│   │   ├── apiClient.js
│   │   ├── main.js
│   ├── babel.config.js
│   ├── package.json
│   ├── package-lock.json
│   ├── vue.config.js
│   ├── .eslintrc.js
├── setup.sh
└── README.md
```

## Requisitos
- Docker
- Docker Compose
- Bash shell (para rodar o script de setup)

## Configuração do Ambiente

### 1. Clonar o Repositório
```bash
git clone https://github.com/vitormeloa/teste-grupo-plan.git
cd teste-grupo-plan
```

### 2. Executar o Script de Setup
```bash
chmod +x setup.sh
./setup.sh
```

### 3. Acessar a Aplicação
- O frontend estará acessível em http://localhost:8080
- A API backend estará acessível em http://localhost:9000/api

## Instruções Adicionais

### Rodar Migrations
Para rodar as migrations, execute o comando abaixo:
```bash
docker exec -it backend php artisan migrate
```

### Popular o Banco de Dados
Para popular o banco de dados com dados de teste, execute o comando abaixo:
```bash
docker exec -it backend php artisan db:seed
```

## Estrutura do Código
### Backend
- A API foi construída usando o framework Laravel. A estrutura segue as convenções padrão do Laravel.
- O código fonte da API está localizado na pasta `backend`.
- As rotas da API estão definidas no arquivo `routes/api.php`.
- Os controllers estão localizados na pasta `app/Http/Controllers`.
- Os models estão localizados na pasta `app/Models`.
- As migrations estão localizadas na pasta `database/migrations`.
- Os seeds estão localizados na pasta `database/seeders`.
- Os testes estão localizados na pasta `tests`.
- A configuração do banco de dados está no arquivo `.env`.

### Frontend
- O frontend foi construído usando o framework Vue.js. A estrutura segue as convenções padrão do Vue.js.
- O código fonte do frontend está localizado na pasta `frontend`.
- Os componentes estão localizados na pasta `src/components`.
- As rotas estão definidas na pasta `src/router`.
- O estado global da aplicação é gerenciado pelo Vuex, localizado na pasta `src/store`.
- As chamadas à API são feitas pelo Axios, através do arquivo `src/apiClient.js`.
- O arquivo `src/main.js` é o ponto de entrada da aplicação.
- O arquivo `vue.config.js` contém a configuração do Vue CLI.