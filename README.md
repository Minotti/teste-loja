## Instalação

- Faça o clone do projeto
- Acesse a pasta e rode `composer install`
- Configure o .env ou apenas copie `cp .env.example .env`
- Execute `php artisan key:generate`
- Configure seu banco de dados conforme o `.env`
- Execute `php artisan migrate --seed`
- E finalize com `php artisan serve` para rodar a aplicação em localhost:8000


## Se você tiver Docker
- Se você tiver o Docker rodando execute `docker-composer build` e aguarde finalizar
- Após finalizado execute `docker-compose up -d` e aguarde levantar os containers

## Para rodar as migrations com Docker
- Execute `docker exec -it connectplug-teste-app /var/www/artisan migrate --seed`
- Ou acesse o container `docker exec -it connectplug-teste-app /bin/bash` e execute o artisan lá dentro
- Acesse `locahost:8000`
