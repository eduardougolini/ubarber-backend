ubarber
=======

clone o repositório na pasta */var/www*, de um cd para esta pasta e rode os seguintes comando:

`composer install`

`chmod 777 -R` na pasta app/

de um cd para dentro de *web* e clone o repositório https://gitlab.com/uBarber/uBarber-frontend.git

de um cd para dentro de *uBarber-frontend/vue* e rode os seguintes comandos:

`npm install`

`npm run build`

crie o arquivo de configuração *uBarber.conf*, como o exemplo abaixo:

    <VirtualHost *:80>
    
          ServerName ubarber.com
          DocumentRoot /var/www/ubarber/web
          ServerAlias *.ubarber.com
          DirectoryIndex index.php
          
          <Directory /var/www/ubarber/web>
                  Options +Indexes +FollowSymLinks +MultiViews
                  AllowOverride All
                  Allow from All
                  Require all granted
          </Directory>
    
    </VirtualHost>

configure o host para responder à uBarber.com 