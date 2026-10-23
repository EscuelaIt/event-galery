## Frontend: Inertia para la estructura, Web Components con Lit para la funcionalidad

El frontend se divide en dos responsabilidades claramente separadas.

### Inertia (Svelte): layout, páginas y rutas

Inertia se usa únicamente para la estructura de la aplicación del dashboard:

- Layouts (`resources/js/layouts`).
- Páginas (`resources/js/pages`) renderizadas desde Laravel con `Inertia::render()`.
- Rutas y navegación entre las secciones del dashboard.

Las páginas de Inertia deben ser finas: se limitan a componer el layout y a colocar los web components que aportan la funcionalidad.

Inertia no se usa para pasar datos a los componentes. Los componentes deberán recibir ellos mismos los datos que necesiten vía API REST, que es stateful con sanctum.

### Web Components con Lit: la funcionalidad

Toda la funcionalidad (listados, formularios, acciones sobre recursos, subida de fotos, interacción con la API, etc.) se desarrolla siempre como componentes independientes basados en web components con Lit y las bibliotecas @dile/*.

- No implementar lógica funcional directamente en las páginas o componentes Svelte; extraerla a un web component.
- Cada componente debe ser autónomo y reutilizable, sin depender de Inertia ni de Svelte.
- Los componentes se comunican con el backend a través de la API, no mediante props de Inertia.
- Antes de crear un componente nuevo, comprobar si ya existe uno reutilizable en `@dile/*` que están instalados en el proyecto.
- La comunicación hacia la página se hace mediante eventos personalizados (`CustomEvent`). En principio no existe comunicación desde la página hacia el componente.
