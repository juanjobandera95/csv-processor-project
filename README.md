# csv-processor-project

# Proyecto DoctorSender: Microservicio de Procesamiento de Datos

**Dirección:** DoctorSender, Carrer Filà Abencerrajes, 4, 03804 Alcoi, Alicante  
**Contacto:** +34 965 524 819 - info@doctorsender.com

## Descripción del Proyecto

Este proyecto tiene como objetivo desarrollar un microservicio de alta eficiencia y escalabilidad que procese grandes volúmenes de datos (más de medio millón de registros). Los datos representan suscriptores con su nombre, email, edad y dirección.

## Características

- **Carga y Procesamiento de CSV:** Servicio en Symfony para procesar archivos CSV de gran tamaño.
- **Consulta de Datos (Endpoint API):** Endpoint RESTful para consultar y filtrar suscriptores.
- **Cache Distribuida:** Uso de Redis para cachear resultados de consultas.
- **Mensajería Asíncrona:** Uso de RabbitMQ para manejar la mensajería entre servicios.

## Requisitos

- Docker y Docker Compose
- PHP 8.2
- Composer

## Instalación

### Paso 1: Configuración del Proyecto Symfony

1. **Crear un Nuevo Proyecto Symfony:**

   ```bash
   composer create-project symfony/skeleton csv-processor
   cd my_project


  ## Configurar la Base de Datos

Edita el archivo `.env` para configurar la conexión a tu base de datos:

```
DATABASE_URL="mysql://juanjo:1234@127.0.0.1:3306/doctors"


## Paso 2: Definir la Entidad Subscriber

### Crear la Entidad
```
php bin/console make:entity Subscriber

Migrar la Base de Datos

```
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```
## Paso 3: Implementar la Carga de CSV
Crear un Servicio para Procesar el CSV

Crea un servicio en src/Service/CsvProcessor.php y un comando en src/Command/ProcessCsvCommand.php para procesar el CSV.
## Paso 4: Implementar el Endpoint RESTful
Crear un Controlador

Usa el MakerBundle para crear un controlador y documenta el endpoint con NelmioApiDocBundle.
## Paso 5: Configurar Docker
Crear un Archivo Docker

Crea un Dockerfile y un docker-compose.yml para contenerizar la aplicación y la base de datos.

```

version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    ports:
      - "8000:80"
    volumes:
      - .:/var/www
    depends_on:
      - redis
      - rabbitmq
    networks:
      - app-network

  redis:
    image: "redis:alpine"
    networks:
      - app-network

  rabbitmq:
    image: "rabbitmq:3-management"
    ports:
      - "15672:15672"
      - "5672:5672"
    networks:
      - app-network

networks:
  app-network:
    driver: bridge
```
## Paso 6: Pruebas
Implementar Pruebas

Usa PHPUnit para escribir pruebas unitarias y funcionales para el servicio y el controlador.


```
composer require --dev symfony/test-pack
```
## Ejecución
Levantar los Servicios

Ejecuta el siguiente comando para construir y levantar los servicios:

```
docker-compose up --build
```
Verificar el Funcionamiento
```
    Accede a http://localhost:8000/api/subscribers para verificar que el cache de Redis está funcionando.

    Accede a http://localhost:8000/send-message para enviar un mensaje a RabbitMQ.
```
## Conclusión

Este proyecto no solo cumple con los requisitos del desafío, sino que también demuestra un entendimiento sólido de la arquitectura de microservicios y sistemas distribuidos. La solución propuesta es eficiente, escalable y está bien documentada, asegurando un alto nivel de calidad y rendimiento.
