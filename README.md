<br/>

<div align="center">
<a href="https://filebeam.xyz">
<img src="https://files.filebeam.xyz/FH9IGy.png" height="80">
</a>
  <h3 align="center">
        <code>@filebeam/api</code>
    </h3>
<p align="center">
<strong>📝 Repositorio de la API de FileBeam</strong>
</p>
<p>
</p>
  <div>
  <strong>
  <a href="https://github.com/filebeam/web">Repositorio del frontend</a> • 
  <a href="https://docs.filebeam.xyz">Ver la documentacion</a>
  </strong>
  <h6>
  </div>
</div>

## Ejecutar de manera local

Para configurar rapidamente una version local de la API puedes seguir los siguientes pasos:

### Requisitos Previos

* **Algun editor de texto**
* **PHP (version 8.2 o posterior)**
* **Composer**
* **Sentido Comun**

### Instalacion

1. Clona el repositorio en alguna ruta accesible
   ```sh
   git clone https://github.com/filebeam/api.git
   ```
2. Instala las dependencias con Composer
   ```sh
   composer install
   ```
3. Renombra el archivo .env.example a .env (Recuerda añadir los datos de la base de datos en el .env)
   ```sh
   cp .env.example .env
   ```
5. Genera una API Key:
   ```sh
   php artisan key:generate
   ```
   
6. Ejecuta las migraciones
   ```sh
   php artisan migrate
   ``` 
7. Inicia el servidor de desarollo
   ```sh
   php artisan serve
   ```


# ¿Porque FileBeam?

FileBeam es un servicio que te permite compartir archivos facil y rapidamente a traves de enlaces directos, ademas, FileBeam es completamente codigo abierto, por lo que puedes hacer lo que desees con el siempre y cuando sigas los parámetros de la licencia GNU AGPL-v3.0, FileBeam provee una alternativa directa a sitios como catbox.moe para aquellos que deseen una segunda opcion.

## Roadmap

Una lista de caracteristicas pendientes o planeadas a futuro sujeta a cambios

- [ ] Subir desde URL
- [x] Subidas Temporales
- [ ] Cliente para Android
- [ ] Cliente para Linux/CLI
- [ ] Sistema de usuarios
- [ ] Panel de administración

## Contribuir

Todas las contribuciones a este repositorio son bienvenidas, si deseas contribuir a este proyecto, puedes contribuir de las siguientes formas

Si deseaas reportar algun error, o tienes alguna sugerencia, puedes abrir un issue explicando a detalle tu reporte o sugerencia. Tambien puedes contribuir directamente al proyecto creando un fork de este repositorio y haciendo un pull request con tus cambios

> *Tambien puedes apoyar este proyecto simplemente dandole una estrella a este repositorio si este te ha servido o lo consideras de utilidad* ✨

## Licencia

FileBeam es software de código abierto bajo la licencia [GNU AGPL-v3.0](https://github.com/filebeam/api/blob/main/LICENSE).
