## Prefijo de los componentes Lit

Todos los web components con Lit creados en este proyecto deben llevar el prefijo `gfe` en el nombre de la etiqueta (custom element).

- Etiqueta: `gfe-<nombre>`, por ejemplo `gfe-gallery-list`.
- Archivo: con el mismo nombre que la etiqueta, por ejemplo `gfe-gallery-list.js`.
- Clase: en PascalCase con el prefijo, por ejemplo `GfeGalleryList`.

El prefijo evita colisiones con los componentes de las bibliotecas `@dile/*` (prefijo `dile`) y con cualquier otro custom element de terceros.
