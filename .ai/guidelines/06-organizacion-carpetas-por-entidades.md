## Organización de carpetas por entidades

La estructura del proyecto se organiza por entidades para mantener el código cohesionado y facilitar la navegación.

### Controladores

Los controladores se agrupan en ramilletes por entidad, colocados dentro de una carpeta con el nombre de esa entidad:

```
app/Http/Controllers/
├── Users/
│   ├── CreateUserController.php
│   ├── UpdateUserController.php
│   ├── DeleteUserController.php
│   └── ListUsersController.php
├── Galleries/
│   ├── CreateGalleryController.php
│   ├── UpdateGalleryController.php
│   ├── DeleteGalleryController.php
│   └── ListGalleriesController.php
```

Cada controlador debe ser invokable y responsable de una única acción.

### Tests

Los tests se colocan en la carpeta de la entidad que está siendo testeada, manteniendo la misma estructura jerárquica:

```
tests/
├── Feature/
│   ├── Users/
│   │   ├── CreateUserTest.php
│   │   ├── UpdateUserTest.php
│   │   ├── DeleteUserTest.php
│   │   └── ListUsersTest.php
│   ├── Galleries/
│   │   ├── CreateGalleryTest.php
│   │   ├── UpdateGalleryTest.php
│   │   ├── DeleteGalleryTest.php
│   │   └── ListGalleriesTest.php
└── Unit/
    ├── Users/
    │   └── UserTest.php
    ├── Galleries/
    │   └── GalleryTest.php
    └── Photos/
        └── PhotoTest.php
```
