# Trebol muebleria API

Trebol api es una api rest diseñada para que los usuarios puedan interactuar con la página de trébol muebleria, pudiendo calificar y comentar sobre los productos allí ofrecidos, para que otros usuarios o sitios web puedan leerlos y obtener información que ayude en la decisión de adquirir un nuevo producto.
Esta documentación tiene como objetivo explicar paso a paso la implementación de la api, facilitando así su uso y entendimiento.


## Productos
### - GET
- Para obtener todos los productos:
Obtiene toda la colección de productos disponibles en la base de datos, de forma desordenada. 
	-  **endpoint:** productos
	- **códigos de respuesta:**
		-  200: si la petición fue realizada con éxito
		-  404: si el producto con el id no existe

- Para obtener solo un producto
Obtiene el producto con el id especificado en el endpoint.
	- **endpoint**: producto/:id
	- **códigos de respuesta:**
		- 200: si la peticion fue realizada correctamente
		- 404: si el producto con el id no existe

- Para obtener productos ordenados:
Se muestran todos los productos ordenados de forma ascendente o descendente y según el campo de la tabla especificado.Primero se necesita especificar el campo de la tabla y luego el sentido (**des** para orden descendente y **asc** para ascendente).
	- **endpoint:** productosOrd
	- **códigos de respuestasr:**
		- 200: si la petición fue realizada correctamente
	- **ejempo de implementación:**
```
trebol_tpe_api/api/producto/3/material/desc
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
		 	- 200: si el producto fue eliminado correctamente
			- 404: si el producto con el id no existe
