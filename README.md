# Tp-Web-API-REST

*Formato json de los campos de la tabla*

Vuelo = 
{
  "salida" : "[valor-1]",
  "destino" : "[valor-2]",
  "avion" : "[valor-3]",
  "hs_salida" : "[valor-4]",
  "hs_llegada" : "[valor-5]",
  "fecha" : "[valor-6]",
  "precio" : "[valor-7]",
  "capacidad" : "[valor-8]",
  "url_Imagen" : "[valor-9]"
}



**Navegacion**

*EndPoints*:

    - GET:  /api/vuelo =     Retorna todos los vuelos almacenados en la base de datos.
    - GET:  /api/vuelo/:id = Retorna el vuelo especifico segun su id.
    - POST: /api/vuelo =     Agregar un vuelo con los elemnto json del cuerpo.
    - PUT:  /api/vuelo/:id : Modifica un vuelo con elementos json del cuerpo.


*Ordenamiento*:

    - GET: /api/vuelo
    - Query: 
        - filtroPor: darle un valor de cualquier campo que tiene la tabla.
        - asc: valor true o false, indica si lo quiere de forma ascendente o descendente. 

*Agregar*

    Puede agregar un elemento ingresando en el body un objeto json como el formato del inicio. Si un valor es vacio retorna un error de que falta ese campo.

*Modificar*

    Se puede modificar un vuelo. Para hacerlo ingresa los valores utilize el mismo formato que para agregar un vuelo(Con un json). Tenga encuenta que pueden haber campos sin llenar, osea vacios, o incluso campos sin definir. Ejemplo:

        {
        "salida" : "",
        "destino" : "california",
        "avion" : "planeador",
        }

    En este caso va a modificar destino y avion

