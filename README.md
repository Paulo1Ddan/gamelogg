# 🎮 Gamelogg - Gerenciador de Jogos Simples com IGDB

Este projeto é uma versão simplificada e personalizada inspirada no **Backloggd**, permitindo que você gerencie sua lista de jogos com integração à API do [IGDB](https://www.igdb.com/). A plataforma foi desenvolvida com foco em simplicidade e usabilidade.

---

## 🚀 Tecnologias Utilizadas

- **PHP** 8+
- **Laravel** (Framework Backend)
- **IGDB Laravel Package** ([igdb-laravel](https://github.com/mitchellvanw/igdb-laravel))
- **MySQL** (Banco de Dados Relacional)
- **Tailwind CSS** (Estilização Responsiva e Moderna)
- **JavaScript**
- **Jetstream** (Autenticação com Laravel)
- **Laradock** (Ambiente de Desenvolvimento em Docker)

---

## 📦 Requisitos

Antes de começar, você precisará ter instalado:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/)
- [Laradock](https://laradock.io/)
- Conta e chave de API do [IGDB](https://api-docs.igdb.com/)

---

## ⚙️ Instalação e Configuração

```bash
# Clone o repositório
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio

# Copie o arquivo de ambiente
cp .env.example .env

# Configure as variáveis de ambiente no .env, incluindo a chave da API IGDB

# Instale as dependências do Laravel
composer install

# Gere a chave da aplicação
php artisan key:generate

# Suba os containers com o Laradock
cd laradock

# ⚠️ Importante: Configure o Nginx para HTTPS ⚠️
# Edite o arquivo: nginx/sites/default.conf
# Exemplo de trecho necessário:
#
# server {
#     listen 443 ssl;
#     server_name localhost;
#     ssl_certificate /etc/nginx/ssl/laradock.crt;
#     ssl_certificate_key /etc/nginx/ssl/laradock.key;
#     root /var/www/public;
#     ...
# }
#
# Após a configuração, rode:

docker-compose up -d nginx mysql workspace

# Acesse o container de workspace
docker-compose exec workspace bash

# Rode as migrations
php artisan migrate

# Compile os assets (opcional)
npm install
npm run dev
```

---

## 🗄️ Configuração do IGDB

Este projeto utiliza a biblioteca **IGDB Laravel**, que facilita a integração com a API IGDB.

1. Obtenha uma **Client ID** e um **Access Token** do IGDB/Twitch:

   - Acesse [https://dev.twitch.tv/console/apps](https://dev.twitch.tv/console/apps) e crie um aplicativo.

2. Configure as variáveis no `.env`:

```env
IGDB_CLIENT_ID=seu_client_id
IGDB_ACCESS_TOKEN=seu_access_token
```

3. A biblioteca **igdb-laravel** já está incluída e configurada no projeto. Consulte a documentação oficial caso deseje ajustes adicionais.

---

## ✨ Funcionalidades

✔️ Autenticação de usuários com Jetstream\
✔️ Criação e gerenciamento de listas de jogos\
✔️ Busca de jogos diretamente na API do IGDB\
✔️ Integração facilitada via **IGDB Laravel Package**\
✔️ Interface simples e responsiva com Tailwind CSS\
✔️ Ambiente de desenvolvimento completo com Docker/Laradock e HTTPS configurado

---

<!-- ## 📸 Screenshots

*(Adicione aqui prints do projeto em funcionamento caso desejar)*

---

## 🛠️ Estrutura do Projeto

```
├── app
├── bootstrap
├── config
├── database
├── laradock
├── public
├── resources
│   ├── css
│   ├── js
│   └── views
├── routes
├── storage
└── tests
```

---

## 🧑‍💻 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para abrir *Issues* ou enviar *Pull Requests*.

---

## 📝 Licença

Este projeto está sob a licença **MIT**. Consulte o arquivo [LICENSE](LICENSE) para mais detalhes.

 -->