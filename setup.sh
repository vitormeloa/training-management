#!/bin/bash

setup_frontend() {
  echo "Configurando o frontend..."
  cd frontend || exit
  npm install
  cd ..
}

setup_backend() {
  echo "Configurando o backend..."
  cd backend || exit
  composer install
  cp .env.example .env
  php artisan key:generate
  cd ..
}

setup_database() {
  echo "Preparando o banco de dados..."
  until docker exec mysql mysqladmin ping -p'password' --silent; do
    echo "Esperando o MySQL iniciar..."
    sleep 2
  done
  docker exec -it backend php artisan migrate
}

start_docker() {
  echo "Iniciando os contêineres Docker..."
  docker-compose up --build -d
}

if ! [ -x "$(command -v docker)" ]; then
  echo "Erro: Docker não está instalado." >&2
  exit 1
fi

if ! [ -x "$(command -v docker-compose)" ]; then
  echo "Erro: Docker Compose não está instalado." >&2
  exit 1
fi

start_docker
setup_frontend
setup_backend
setup_database

echo "Setup completo! Acesse o frontend em http://localhost:8080 e o backend em http://localhost:9000."
