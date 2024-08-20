# Training Management Project

## Objective
Develop a web application that includes a user interface (frontend) connected to a REST API.

## Context
The manager at XYZ company needs a system to track whether their subordinates are completing the corporate training programs available on the platform.

## Technologies
- PHP 8.3
- MySQL 8.0
- Laravel 11
- Vue 2.6
- Vuex 3.6
- Vue Router 3.5
- Axios
- Docker
- Docker Compose

## Project Structure
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
├── frontend/
│   ├── public/
│   ├── src/
│   │   ├── components/
│   │   ├── router/
│   │   ├── store/
│   │   ├── views/
│   │   ├── App.vue
│   │   ├── main.js
│   ├── babel.config.js
│   ├── package.json
│   ├── package-lock.json
│   ├── vue.config.js
│   ├── .eslintrc.js
│   ├── ...
├── setup.sh
└── README.md
└── .gitignore
└── LICENSE
```

## Requirements
- Bash shell (to run the setup script)

## Environment Setup

### 1. Clone the Repository
```bash
git clone https://github.com/vitormeloa/training-management.git
cd training-management
```

### 2. Run the Setup Script
```bash
chmod +x setup.sh
./setup.sh
```

### 3. Access the Application
- The frontend will be accessible at http://localhost:8080
- The backend API will be accessible at http://localhost/api

## Additional Commands (Optional)

The following commands are optional and are not required to run the application as they are already applied in the project setup script.

### 1. Run Tests
```bash
cd backend
./vendor/bin/sail pest
```

### 2. Run Migrations
```bash
cd backend
./vendor/bin/sail artisan db:seed
```

### 3. Rodar os Migrations
```bash
cd backend
./vendor/bin/sail artisan migrate:fresh
```

## Code Structure
### Backend
- The API is built using the Laravel framework. The structure follows Laravel's standard conventions.
- The API source code is located in the backend folder.
- The API routes are defined in the routes/api.php file.
- The controllers are located in the app/Http/Controllers folder.
- The models are located in the app/Models folder.
- The migrations are located in the database/migrations folder.
- The seeds are located in the database/seeders folder.
- The tests are located in the tests folder.
- The database configuration is in the .env file.

### Frontend
- The frontend is built using the Vue.js framework. The structure follows Vue.js standard conventions.
- The frontend source code is located in the frontend folder.
- The components are located in the src/components folder.
- The routes are defined in the src/router folder.
- The global application state is managed by Vuex, located in the src/store folder.
- API calls are made using Axios, through the src/apiClient.js file.
- The src/main.js file is the entry point of the application.
- The vue.config.js file contains the Vue CLI configuration.
