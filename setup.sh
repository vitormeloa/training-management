#!/bin/bash

error_exit() {
    echo "$1" 1>&2
    exit 1
}

if ! [ -x "$(command -v composer)" ]; then
    echo "Composer não encontrado. Instalando Composer..."
    EXPECTED_SIGNATURE="$(curl -s https://composer.github.io/installer.sig)"
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

    if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then
        echo "Assinatura do instalador do Composer inválida." >&2
        rm composer-setup.php
        exit 1
    fi

    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    RESULT=$?
    rm composer-setup.php
    if [ $RESULT -ne 0 ]; then
        error_exit "Erro ao instalar o Composer."
    fi
    echo "Composer instalado com sucesso."
else
    echo "Composer já está instalado."
fi

if ! [ -x "$(command -v docker)" ]; then
    echo "Docker não encontrado. Instalando Docker..."
    curl -fsSL https://get.docker.com -o get-docker.sh
    sh get-docker.sh || error_exit "Erro ao instalar o Docker."
    rm get-docker.sh
    echo "Docker instalado com sucesso."
else
    echo "Docker já está instalado."
fi

if ! [ -x "$(command -v docker-compose)" ]; then
    echo "Docker Compose não encontrado. Instalando Docker Compose..."
    sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
    echo "Docker Compose instalado com sucesso."
else
    echo "Docker Compose já está instalado."
fi

if ! [ -x "$(command -v node)" ]; then
    echo "Node.js não encontrado. Instalando Node.js e npm..."
    curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
    sudo apt-get install -y nodejs || error_exit "Erro ao instalar o Node.js e npm."
    echo "Node.js e npm instalados com sucesso."
else
    echo "Node.js já está instalado."
fi

echo "Iniciando a configuração do backend..."

cd backend || error_exit "Erro ao acessar o diretório do backend."

echo "Instalando dependências do backend..."
composer install || error_exit "Erro ao instalar as dependências do backend."

echo "Iniciando o Sail..."
./vendor/bin/sail up -d || error_exit "Erro ao iniciar o Sail."

echo "Executando migrações..."
./vendor/bin/sail artisan migrate:fresh || error_exit "Erro ao executar as migrações."

echo "Executando seeders..."
./vendor/bin/sail artisan db:seed || error_exit "Erro ao executar os seeders."

echo "Backend configurado com sucesso."

echo "Iniciando a configuração do frontend..."

cd ../frontend || error_exit "Erro ao acessar o diretório do frontend."

echo "Instalando dependências do frontend..."
npm install || error_exit "Erro ao instalar as dependências do frontend."

echo "Executando ESLint..."
npx eslint --fix src/**/*.vue src/**/*.js || error_exit "Erro ao executar o ESLint."

echo "Iniciando o servidor de desenvolvimento do frontend..."
npm run serve || error_exit "Erro ao iniciar o servidor de desenvolvimento do frontend."

echo "Frontend configurado com sucesso."

echo "Setup completo do projeto realizado com sucesso."