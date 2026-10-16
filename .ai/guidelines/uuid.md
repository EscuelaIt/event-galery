## UUID

Las tablas tienen identificadores autonuméricos (bigint) como clave primaria, pero se expone un UUID como identificador público. El propósito es ofuscar el ID interno real y evitar que se revele información sobre la cantidad de registros o patrones de la base de datos.

**Patrón:**
- Clave primaria: `id` (bigint, interno)
- Identificador público: `uuid` (string, expuesto en APIs y URLs)

**En API:** Siempre devolver el UUID como `id`, nunca el bigint interno.
