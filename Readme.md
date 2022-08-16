Setup laravel

cd web

cp .env.example .env  // Then config the .env content

chmod 777 -R storage

-----

cd .docker

cp local-docker-compose.yml local-docker-compose.yml

cp env/default.conf.local.example env/default.conf.local

// Edit the content (change the domain to domain.local)
// Note: this local domain need also be configured in the host file
// Linux: /etc/hosts - Window: C:\Windows\System32\drivers\etc\hosts

docker-compose up -d