## Bibliotecas @dile/*

El autor de este proyecto es también el creador y mantenedor de las bibliotecas `@dile/*` (`@dile/ui`, `@dile/crud`, etc.). Por tanto, estas bibliotecas pueden evolucionar según las necesidades del proyecto.

### Carencias en @dile/*

Si se detecta que alguna biblioteca `@dile/*` no cubre una necesidad (falta un componente, una propiedad, un evento, un slot, un estilo personalizable, un comportamiento, etc.):

- No suplir la carencia con código propio de este proyecto: ni componentes alternativos, ni extensiones, ni parches, ni workarounds.
- Detenerse e informar al usuario de la carencia encontrada.
- Indicar los nuevos requisitos que debería cumplir la biblioteca `@dile/*` afectada, detallando:
  - Biblioteca y componente (o módulo) implicado.
  - Funcionalidad que falta y caso de uso en este proyecto que la necesita.
  - Propuesta de API: propiedades, atributos, eventos, slots, métodos o custom properties CSS.
