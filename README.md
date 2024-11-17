# Trebol muebleria API

Trebol api es una api rest diseñada para que los usuarios puedan interactuar con la página de trébol muebleria, pudiendo calificar y comentar sobre los productos allí ofrecidos, para que otros usuarios o sitios web puedan leerlos y obtener información que ayude en la decisión de adquirir un nuevo producto.
Esta documentación tiene como objetivo explicar paso a paso la implementación de la api, facilitando así su uso y entendimiento.

## Token
Para generar un token de autorización básica dentro del URL “Generar token” se debe cargar el nombre de usuario y la contraseña en la pestaña de “Authorization” seleccionando en “Auth Type” la opción “Basic Auth” y en cada input rellenar respectivamente y enviar la petición. Una vez obtenida la respuesta en el body response copiar la cadena de caracteres de “token” (sin las comillas), para posteriormente ser usado en las peticiones POST, PUT Y DELETE. Este "Token" obtenido debe ser ingresado en el input llamado "Token" dentro de la pestaña "Headers", teniendo en cuenta que el mismo tiene tiempo de validez. A continuación se agregan imagenes ilustrativas para la utilización en Postman.

![Generar Token](https://github.com/juanpedroz/capturasMD_tpe_api_web2/blob/main/generarToken.png)

## Validación usuario
Para validar el usuario con el token obtenido me ubico en el URL a utilizar (solo para métodos POST y PUT) y en la pestaña superior “Headers” en el header llamado “Token” en el campo para rellenar pego el token obtenido y posteriormente enviar la petición.

![Aplicacón Token](https://github.com/juanpedroz/capturasMD_tpe_api_web2/blob/main/aplicacionToken.png)

## Orden
Los ítem de las tablas se ordenan de manera ascendente por campo y por orden ascendente o descendente, a través de parámetro GET. 

## Paginación
Para la paginación se recibe por parámetro GET el número de página a la que se quiere acceder, estando como constante definida la cantidad de 4 elementos por página.



## Productos
### - GET
- Para obtener todos los productos:
Obtiene toda la colección de productos disponibles en la base de datos, de forma desordenada y paginada.
	-  **endpoint:** productos/:page
	- **códigos de respuesta:**
		-  200: si la petición fue realizada con éxito
    			![GET productos 200](https://github.com/juanpedroz/capturasMD_tpe_api_web2/blob/main/GETproductos200.jpg)
		-  404:  si la pagina no existe
    			![GET productos 404](https://github.com/juanpedroz/capturasMD_tpe_api_web2/blob/main/GETproductos404.jpg)


- Para obtener solo un producto
Obtiene el producto con el id especificado en el endpoint.
	- **endpoint**: producto/:id
	- **códigos de respuesta:**
		- 200: si la peticion fue realizada correctamente
		- 404: si el producto con el id no existe

- Para obtener productos ordenados:
Se muestran todos los productos ordenados de forma ascendente o descendente y según el campo de la tabla especificado.Primero se necesita especificar el campo de la tabla (?campo=nombre_campo) y luego el sentido(&sentido=asc) (**desc** para orden descendente y **asc** para ascendente).
	- **endpoint:** productosOrd
	- **códigos de respuestas:**
		- 200: si la petición fue realizada correctamente
	- **ejempo de implementación:**
```
http://localhost/trebol_tpe_api/api/productosOrd?campo=id_producto&sentido=asc
```
### - POST
- Para crear un producto
Crea un producto obteniendo los datos del body con el formato:
```
{
	"nombre": "aaa",
	"precio": 0000,
	"descripcion": "aaaaa",
	"imagen": "img/aaa.jpg",
	"id_material" : 0
}
```
- **endpoint:** producto
- **códigos de respuesta:**
	- 201: si el producto fue creado existosamente
	- 404: si el material especificado no existe
	- 401: si faltan completar campos

### - DELETE
- Para eliminar un producto
Elimina un producto con el id especificado.
	- **endpoint:** producto/:id
	- **códigos de respuesta:** 
		- 200: si el producto fue eliminado correctamente
		- 404: si el producto con el id no existe

### - PUT
- Para modificar un producto.
Modifica un producto con el id especificado, obteniendo los datos del body, con el formato:
```
	{
		"nombre": "aaa",
		"precio": 0000,
		"descripcion": "aaaaa",
		"imagen": "img/aaa.jpg",
		"id_material" : 0
	}
```

- **endpoint:** producto/:id
- **códigos de respuesta:**
 	- 200: si el producto fue modificado correctamente
	- 404: si el producto con el id no existe
	- 401: si faltan completar campos

## Opiniones
### - GET
- Para obtener todas las opiniones:
Obtiene toda la colección deopiniones disponibles en la base de datos, de forma desordenada y paginada.
	-  **endpoint:** opiniones/:page
	- **códigos de respuesta:**
		-  200: si la petición fue realizada con éxito
		-  404: si la pagina no existe

- Para obtener solo una opinion
Obtiene la opinion con el id especificado en el endpoint.
	- **endpoint**: opinion/:id
	- **códigos de respuesta:**
		- 200: si la peticion fue realizada correctamente
		- 404: si la opinion con el id no existe

- Para obtener opiniones ordenadas:
Se muestran todas las opiniones ordenadas de forma ascendente o descendente y según el campo de la tabla especificado.Primero se necesita especificar el campo de la tabla (?campo=nombre_campo) y luego el sentido(&sentido=asc) (**desc** para orden descendente y **asc** para ascendente).
	- **endpoint:** opinionesOrd
	- **códigos de respuestas:**
		- 200: si la petición fue realizada correctamente
	- **ejempo de implementación:**
```
http://localhost/trebol_tpe_api/api/opinionesOrd?campo=calificacion&sentido=asc
```
### - POST
- Para crear una opinion
Crea una opinion obteniendo los datos del body con el formato:
```
{
    "calificacion": 0,
    "comentario": "aaaa"
}
```
- **endpoint:** producto
- **códigos de respuesta:**
	- 201: si la opinion fue creada existosamente
	- 401: si faltan completar campos

### - DELETE
- Para eliminar una opinion
Elimina una opinion con el id especificado.
	- **endpoint:** opinion/:id
	- **códigos de respuesta:** 
		- 200: si la opinion fue eliminada correctamente
		- 404: si la opinion con el id no existe

### - PUT
- Para modificar una opinion
Modifica una opinion con el id especificado, obteniendo los datos del body, con el formato:
```
{
    "calificacion": 0,
    "comentario": "aaaa"
}
```

- **endpoint:** opinion/:id
- **códigos de respuesta:**
 	- 200: si la opinion fue modificada correctamente
	- 404: si la opinion con el id no existe
	- 401: si faltan completar campos

## Materiales
### - GET
- Para obtener todos los materiales:
Obtiene toda la colección de materiales disponibles en la base de datos, de forma desordenada y paginada.
	-  **endpoint:** materiales/:page
	- **códigos de respuesta:**
		-  200: si la petición fue realizada con éxito
		-  404:  si la pagina no existe

- Para obtener solo un material
Obtiene el material con el id especificado en el endpoint.
	- **endpoint**: material/:id
	- **códigos de respuesta:**
		- 200: si la peticion fue realizada correctamente
		- 404: si el material con el id no existe

- Para obtener materiales ordenados:
Se muestran todos los materiales ordenados de forma ascendente o descendente y según el campo de la tabla especificado.Primero se necesita especificar el campo de la tabla (?campo=nombre_campo) y luego el sentido(&sentido=asc) (**desc** para orden descendente y **asc** para ascendente).
	- **endpoint:** materialesOrd
	- **códigos de respuestas:**
		- 200: si la petición fue realizada correctamente
	- **ejempo de implementación:**
```
http://localhost/trebol_tpe_api/api/materialesOrd?campo=proveedor&sentido=desc
```
### - POST
- Para crear un material
Crea un material obteniendo los datos del body con el formato:
```
{
    "material": "algarrobo",
    "proveedor": 3
}
```
	- **endpoint:** material
	- **códigos de respuesta:**
		- 201: si el material fue creado existosamente
		- 404: si el material especificado no existe
		- 401: si faltan completar campos


### - DELETE
- Para eliminar un material
Elimina un material con el id especificado.
	- **endpoint:** material/:id
	- **códigos de respuesta:** 
		- 200: si el material fue eliminado correctamente
		- 404: si el material con el id no existe
		- 500: si el material tiene productos asociados

### - PUT
- Para modificar un material.
Modifica un material con el id especificado, obteniendo los datos del body, con el formato:
```
{
    "material": "algarrobo",
    "proveedor": 3
}
```

- **endpoint:** material/:id
- **códigos de respuesta:**
 	- 200: si el material fue modificado correctamente
	- 404: si el material con el id no existe
	- 401: si faltan completar campos
