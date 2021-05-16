# BusTec
Tcc


##Instalar projeto ##

- Clonar projeto
- Para baixar as dependências é necessário fazer o download do composer
- Abrir a pasta API e utilizar o comando composer install
- Criar uma pasta dentro de /var chamada data com o seguinte arquivo data.db (to usando sqlite por enquanto)
- Execute o comando php bin/console doctrine:migrations:migrate
- Já pode fazer as requisições
- Dica: Use o app Postman para fazer as requisições

___

 - Para iniciar o projeto digite:
    - cd API
    - php -S 127.0.0.1 -t public