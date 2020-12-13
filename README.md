# pruebasf
## Prueba para el empleador

Generamos la base de datos<br/>
```bash
php bin/console doctrine:migrations:migrate
```
<br/>
Creamos los registros de prueba incluido el usuario admin<br/>

```bash
php bin/console doctrine:fixtures:load
```
<br/>
<b>Usuario:</b> admin<br/>
<b>Password:</b> admin<br/>
<br/>
<ul>
<li>Me imagine que cuando alguien entra a la pagina web se le crea un carrito vacio listo para llenar de articulos.</li>
<li>Si un administrador se loguea puede gestionar esos articulos</li>
<li>El visitante no esta obligado a registrarse en el sistema para poder ver su carrito, pero si visualizara el contenido segun las condiciones requeridas previamente.</li>
</ul>
