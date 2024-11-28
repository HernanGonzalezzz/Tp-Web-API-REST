# Tp-Web-API-REST

## Descripción

Este proyecto forma parte de la tercera entrega del Trabajo Práctico Especial (TPE) de la carrera TUDAI. Es un servicio web de tipo RESTFul de una base de datos con las tablas de Vuelos y Usuarios las cuales tienen una relacion de 1 a N 
que es representada con un vuelo que tiene varios usuarios. En este trabajo solo vamos a trabajar con la tabla Vuelos.


Se cumplen los siguientes requerimientos obligatorios y opcionales:

- La API Rest es RESTful
- tiene un servicios que listan (GET) una colección entera de entidades (obtener() que lista todos los vuelos). El servicios pueden ordenarse por cualquiera de sus campos tanto ascencente como descendente.
- La lista tienen un servicio que liste (GET) por ID una entidad determinada.
- Tiene un servicios para agregar, modificar y eliminar datos (POST PUT y DELETE) de la tabla mencionada.
- La API Rest maneja de manera adecuada los siguientes códigos de error (200, 201, 400 y 404).
- Todo el sistema usa el patrón MVC.
- Se incluye el SQL para la instalación de la base de datos.


## Tablas

### La tabla `vuelos` contiene:
- `id`: clave primaria (autoincremental)
- `salida`: ciudad de salida
- `destino`: ciudad destino
- `avion`: modelo del avion
- `fecha_salida`: fecha en la que sale el vuelo
- `fecha_llegada`: fecha en la que llega el vuelo
- `precio`: precio del vuelo
- `capacidad`: capacidad de pasajeros del vuelo
- `url_Imagen`: imagen del destino

### La tabla `usuarios` contiene:
- `id`: clave primaria (autoincremental)
- `email`: email del usuario (estado unico)
- `id_vuelo`: clave foranea que referencia la tabla vuelos



# Endpoints

## Vuelos

- GET: `<<BaseUrl>>/api/vuelo` =     Retorna todos los vuelos almacenados en la base de datos.
- GET:  `<<BaseUrl>>/api/vuelo/:id` = Retorna el vuelo especifico segun su id.
- POST: `<<BaseUrl>>/api/vuelo` =     Agregar un vuelo en la tabla.
- PUT:  `<<BaseUrl>>/api/vuelo/:id` : Modifica un vuelo determinada por un id.


- ### GET: `<<BaseUrl>>/api/vuelo`

  -  ### Descripción:
Lista la coleccion entera "vuelos" disponibles en la base de datos, permitiendo aplicar tanto ordenamiento por cualquiera de sus campos.

  - ### Query Params:

### Ordenamiento:

  - **clasificar**: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:
    - `id`: ordena por su clave primaria 
    - `salida`: ordena por ciudad de salida
    - `destino`: ordena por ciudad destino
    - `avion`: ordena por modelo del avion
    - `fecha_salida`: ordena por fecha en la que sale el vuelo
    - `fecha_llegada`: ordena por fecha en la que llega el vuelo
    - `precio`: ordena por precio del vuelo
    - `capacidad`: ordena por capacidad de pasajeros del vuelo
    - `url_Imagen`: ordena por imagen del destino

  - **order**: Dirección de ordenamiento para el campo especificado en **clasificar**. Puede ser:
    - **asc** : Orden ascendente (por defecto).
    - **desc** : Orden descendente.

#### Ejemplo de Ordenamiento:
Para obtener todos los vuelos ordenados por destino en orden descendente:

```http
GET <<BaseUrl>>/api/vuelo?clasificar=destino&order=desc
```


- ## GET `<<BaseUrl>>/api/vuelo/:id`

Muestra una entidad determinada por id solicitado.

- ## Post `<<BaseUrl>>/api/vuelo`

### Crear un nuevo vuelo

```http
POST <<BaseUrl>>/api/vuelo
```

Crea un nuevo vuelo con la información proporcionada en formato JSON en el body de la petición. Luego de insertar se devuelve UN JSON con los datos de la cancion desde la base de datos.

#### Campos Requeridos:

- `salida`: ciudad de salida
- `destino`: ciudad destino
- `avion`: modelo del avion
- `fecha_salida`: fecha en la que sale el vuelo
- `fecha_llegada`: fecha en la que llega el vuelo
- `precio`: precio del vuelo
- `capacidad`: capacidad de pasajeros del vuelo
- `url_Imagen`: imagen del destino

#### Ejemplo de JSON:

```json
 {
    "salida": "California",
    "destino": "Texas",
    "avion": "boing 707",
    "fecha_salida": "2024-11-28 15:45:00",
    "fecha_llegada": "2024-11-28 15:45:00",
    "precio": 2000,
    "capacidad": 45
}

```

#### Nota Importante:

El campo `id` se genera automáticamente y no debe incluirse en el JSON.
El campo `url_Imagen` no es necesario completarlo.

- ## PUT `<<BaseUrl>>/api/vuelo/:id`

Modifica una entidad determinada por id solicitado, los datos a solicitar son los mismos que para agregar un vuelo. Tenga encuenta que pueden haber campos sin llenar, vacios, o incluso campos sin definir.

#### Ejemplo de JSON:

```json
 {
    "salida": "",
    "destino": "florida",
    "avion": "planeador",
}

    En este caso va a modificar destino y avion

```

- ## DELETE `<<BaseUrl>>/api/vuelo/:id`

Elimina una entidad determinada por id solicitado.