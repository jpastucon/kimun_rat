# RAT - REGISTRO DE ATENCIÓN TÉCNICA

_Plataforma a medida para la operación, administración y gestión de RATs a los clientes actuales y grupos de interés de medianas y grandes empresas del país (🇨🇱) para la empresa MADEIN._

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

Mira **Deployment** para conocer como desplegar el proyecto.


### Pre-requisitos 📋

_LAMP STACK, Composer, NodeJS_

```
▪ Linux
▪ Apache
▪ Mysql
▪ PHP
```

### Instalación 🔧

```
▪ Copia el archivo ENV: cp .env.example .env
▪ Generar nuevas credenciales Laravel: php artisan key:generate
▪ Configurar/validar archivo .env (base de datos, mail, google, entre otros).
▪ Publicar los componentes Tailwind, Livewire: 
    php artisan vendor:publish --tag=jetstream-views
    php artisan livewire:publish --config
    php artisan livewire:publish --assets
    php artisan vendor:publish --provider="LaravelLang\Publisher\ServiceProvider"
    php artisan vendor:publish --tag=datatables
▪ Gestión de paquetes y dependencias: npm install && npm run dev
▪ Cambiar permisos de carpetas Storage y Bootstrap: chmod -R ugo+rw storage bootstrap/cache
▪ Limpiar cache, rutas, entre otros: php artisan optimize:clear
```

## Ejecutando las pruebas ⚙️

_Explica como ejecutar las pruebas automatizadas para este sistema_

### Analice las pruebas end-to-end 🔩

_Explica que verifican estas pruebas y por qué_

```
Da un ejemplo
```

### Y las pruebas de estilo de codificación ⌨️

_Explica que verifican estas pruebas y por qué_

```
Da un ejemplo
```

## Despliegue 📦

_Agrega notas adicionales sobre como hacer deploy_

## Construido con 🛠️

_Menciona las herramientas que utilizaste para crear tu proyecto_

* [LARAVEL 8.83.15](https://laravel.com/docs/8.x) - El framework web usado
* [NPM 8.3.2](https://docs.npmjs.com) - Manejador de paquetes
* [COMPOSER 2.1.14](https://getcomposer.org/doc/) - Manejador de dependencias

## Versionado 📌

Usamos [SemVer](http://semver.org/) para el versionado. Para todas las versiones disponibles, mira los [tags en este repositorio](https://github.com/tu/proyecto/tags).

## Autores ✒️

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **Jean Paul Astudillo** - *Documentación* - [jpastudillo](jpastudillo@datrix.cl)


## Licencia 📄

Este proyecto está bajo la Licencia (KIMÜN) - mira el archivo [LICENSE.md](LICENSE.md) para detalles


---
⌨️ con ❤️ por [DATRIX](https://datrix.cl) 😊