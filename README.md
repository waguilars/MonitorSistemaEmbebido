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

## Migrar Base de datos
Dirigirse al archivo Migrate.php que se encuentra en la ruta del proyecto: `/application/config/migration.php`
editar la opcion `migrate_version` a la ultima disponible en el proyecto.

```
/*
|--------------------------------------------------------------------------
| Migrations version
|--------------------------------------------------------------------------
|
| This is used to set migration version that the file system should be on.
| If you run $this->migration->current() this is the version that schema will
| be upgraded / downgraded to.
|
*/
$config['migration_version'] = 3;
```
Las versiones disponibles se encuentran en el directorio `/application/migrations`

Ejecutar en el navegador el controlador Migrate.php `http://localhost/migrate`
