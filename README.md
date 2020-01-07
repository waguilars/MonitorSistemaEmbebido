# MonitorSistemaEmbebido
Proyecto integrador de Networking - Programacion Hipermedial - Sistemas embebidos

## Configuracion Servidor apache
Configurar el archivo apache2.conf localizado en `/etc/apache2/apach2.conf` y modificar lo siguiente.
```
<Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```

Cambiar el directorio raiz del servidor en el archivo 000-default.conf en la siguiente ruta /etc/apache2/sites-avaiable/000-default.conf
```
DocumentRoot /var/www/html/MonitorSistemaEmbebido

```
