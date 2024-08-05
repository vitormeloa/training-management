#!/bin/bash

error_exit() {
    echo -e "\033[31m$1\033[0m" 1>&2
    exit 1
}

info_message() {
    echo -e "\033[34m$1\033[0m"
}

success_message() {
    echo -e "\033[32m$1\033[0m"
}

if ! [ -x "$(command -v composer)" ]; then
    info_message "Composer não encontrado. Instalando Composer..."
    EXPECTED_SIGNATURE="$(curl -s https://composer.github.io/installer.sig)"
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

    if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then
        error_exit "Assinatura do instalador do Composer inválida."
    fi

    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    RESULT=$?
    rm composer-setup.php
    if [ $RESULT -ne 0 ]; then
        error_exit "Erro ao instalar o Composer."
    fi
    success_message "Composer instalado com sucesso."
else
    success_message "Composer já está instalado."
fi

if ! [ -x "$(command -v docker)" ]; then
    info_message "Docker não encontrado. Instalando Docker..."
    curl -fsSL https://get.docker.com -o get-docker.sh
    sh get-docker.sh || error_exit "Erro ao instalar o Docker."
    rm get-docker.sh
    success_message "Docker instalado com sucesso."
else
    success_message "Docker já está instalado."
fi

if ! [ -x "$(command -v docker-compose)" ]; then
    info_message "Docker Compose não encontrado. Instalando Docker Compose..."
    sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
    success_message "Docker Compose instalado com sucesso."
else
    success_message "Docker Compose já está instalado."
fi

if ! [ -x "$(command -v node)" ]; then
    info_message "Node.js não encontrado. Instalando Node.js e npm..."
    curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
    sudo apt-get install -y nodejs || error_exit "Erro ao instalar o Node.js e npm."
    success_message "Node.js e npm instalados com sucesso."
else
    success_message "Node.js já está instalado."
fi

info_message "Iniciando a configuração do backend..."

cd backend || error_exit "Erro ao acessar o diretório do backend."

info_message "Instalando dependências do backend..."
composer install || error_exit "Erro ao instalar as dependências do backend."

info_message "Iniciando o Sail..."
./vendor/bin/sail up -d || error_exit "Erro ao iniciar o Sail."

info_message "Executando migrações..."
./vendor/bin/sail artisan migrate:fresh || error_exit "Erro ao executar as migrações."

info_message "Executando seeders..."
./vendor/bin/sail artisan db:seed || error_exit "Erro ao executar os seeders."

success_message "Backend configurado com sucesso."

info_message "Iniciando a configuração do frontend..."

cd ../frontend || error_exit "Erro ao acessar o diretório do frontend."

info_message "Instalando dependências do frontend..."
npm install || error_exit "Erro ao instalar as dependências do frontend."

info_message "Executando ESLint..."
npx eslint --fix src/**/*.vue src/**/*.js || error_exit "Erro ao executar o ESLint."

info_message "Iniciando o servidor de desenvolvimento do frontend..."
npm run serve || error_exit "Erro ao iniciar o servidor de desenvolvimento do frontend."

success_message "Frontend configurado com sucesso."

success_message "Setup completo do projeto realizado com sucesso."
