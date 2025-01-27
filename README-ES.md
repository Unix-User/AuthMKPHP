<p align="center"><a href="https://github.com/Unix-User/AuthMKPHP" target="_blank"><img src="https://user-images.githubusercontent.com/38821945/192930836-6be0ee28-7206-4651-a18c-da7e8ab99a11.svg" width="400" alt="Logotipo AuthMKPHP"></a></p>

<p align="center">
  [Português](README-PT.md) | [English](README.md)
</p>

## Acerca de AuthMKPHP

AuthMKPHP es una aplicación web construida con Laravel y Vue.js, diseñada para optimizar la gestión de usuarios y perfiles en servidores PPPoE de dispositivos Mikrotik. Proporciona una interfaz amigable para gestionar usuarios y sus dispositivos asociados, mejorando la eficiencia y centralizando la administración.

## Instalación y Configuración

Esta sección le guía a través de la configuración de AuthMKPHP en su sistema.

### Prerrequisitos

Antes de comenzar, asegúrese de tener lo siguiente instalado y configurado en su sistema:

* **PHP:** Versión 8.2 o superior. Además, asegúrese de que las siguientes extensiones de PHP estén habilitadas: BCrypt, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML y sockets. El archivo `composer.json` especifica `^8.2.0`, así que asegúrese de tener al menos PHP 8.2 instalado.
* **Composer:** El gestor de dependencias de PHP. Puede descargarlo desde [https://getcomposer.org/](https://getcomposer.org/).
* **Node.js y npm:** Node.js y npm son necesarios para gestionar las dependencias de JavaScript y compilar los assets del frontend. Descárguelos desde [https://nodejs.org/](https://nodejs.org/).


### Configuración para Desarrollo

Estos pasos configurarán AuthMKPHP para el desarrollo local.

1. **Clonar el repositorio:** Clone el repositorio AuthMKPHP a su máquina local usando Git:
   ```bash
   git clone https://github.com/Unix-User/AuthMKPHP.git
   cd AuthMKPHP
   ```

2. **Instalar dependencias:** Instale las dependencias PHP y JavaScript necesarias usando Composer y npm:
   ```bash
   composer install
   npm install
   ```

3. **Configurar variables de entorno:** Cree un archivo `.env` copiando el archivo `.env.example`. Este archivo contiene varias configuraciones para su aplicación. Necesitará configurar lo siguiente:

    * **Credenciales de la Base de Datos:** Especifique los detalles de conexión de su base de datos, incluyendo el hostname, nombre de la base de datos, nombre de usuario y contraseña. Para el desarrollo local, puede usar SQLite para simplificar.
    * **Claves API:** Si la aplicación utiliza alguna API externa (por ejemplo, pasarelas de pago, servicios de mensajería), necesitará proporcionar las claves API necesarias aquí.
    * **Otras Configuraciones:** Otras configuraciones pueden incluir URLs de la aplicación, configuraciones de correo electrónico y otros parámetros específicos de la aplicación. Consulte el archivo `.env.example` para obtener una lista completa de variables y sus descripciones.

4. **Generar clave de aplicación:** Genere una clave de aplicación única para seguridad:
   ```bash
   php artisan key:generate
   ```

5. **Ejecutar las migraciones de la base de datos:** Aplique las migraciones de la base de datos para crear las tablas necesarias:
   ```bash
   php artisan migrate
   ```

6. **Iniciar el servidor de desarrollo:** Inicie el servidor de desarrollo para ejecutar la aplicación:
   ```bash
   npm run dev
   ```

### Configuración para Producción

Para desplegar AuthMKPHP en un entorno de producción, siga estos pasos:

1. **Siga los pasos 1-3 de la sección Configuración para Desarrollo.**

2. **Ejecutar las migraciones de la base de datos con seeding:** Ejecute las migraciones de la base de datos y llene la base de datos con datos iniciales (si es necesario):
   ```bash
   php artisan migrate:fresh
   php artisan db:seed
   ```

3. **Compilar assets para producción:** Compile los assets frontend para un rendimiento optimizado en producción:
   ```bash
   npm run build
   ```

4. **Desplegar:** Despliegue la aplicación en su servidor web elegido. El proceso de despliegue variará dependiendo de su proveedor de hosting e infraestructura. Consulte la documentación de su proveedor de hosting para obtener instrucciones específicas.


## Funcionalidades

AuthMKPHP ofrece las siguientes funcionalidades (algunas aún en desarrollo):

- [x] **Despliegue Automatizado:** El despliegue automatizado está configurado usando GitHub Actions.
- [ ] **Documentación Completa:** Documentación detallada está planeada para futuras versiones.
- [x] **Operaciones CRUD Básicas:** Proporciona funcionalidades básicas de Crear, Leer, Actualizar y Eliminar (CRUD) para gestionar usuarios y dispositivos.
- [ ] **Integración con Chat de Telegram:** La integración con Telegram para notificaciones y comunicación está planeada.
- [ ] **Integración con la API de PagSeguro:** La integración con la pasarela de pago PagSeguro está planeada.
- [ ] **Integración con la API de Mercado Pago:** La integración con la pasarela de pago Mercado Pago está planeada.
- [x] **Integración con la API de Mikrotik:** Integración robusta con la API de Mikrotik para la gestión de dispositivos.


## Patrocinadores

Estamos buscando activamente patrocinadores para apoyar el desarrollo continuo y la mejora de AuthMKPHP. Su contribución nos ayudará a entregar una aplicación más robusta y rica en funcionalidades.

### Socios

Agradecemos las asociaciones para colaborar en el desarrollo y expansión de AuthMKPHP. Si está interesado en convertirse en socio, visite [udianix.com.br](udianix.com.br).


## Contribuyendo

¡Animamos las contribuciones a AuthMKPHP! Por favor, revise nuestras directrices de contribución antes de enviar un pull request.


## Vulnerabilidades de Seguridad

Si descubre una vulnerabilidad de seguridad, por favor, repórtela de manera responsable creando un issue.
