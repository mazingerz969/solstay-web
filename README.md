# SolStay — Plataforma de alquiler vacacional

Plataforma web full-stack estilo Airbnb/Holidu para alquilar propiedades vacacionales. Construida con **Laravel 13 + Alpine.js + Tailwind**, tema claro mediterráneo.

## Características

- Landing page con buscador por destino, fechas y huéspedes
- Listado y detalle de propiedades con carrusel de fotos y calendario de disponibilidad
- Flujo de reserva multi-paso (5 pasos) con validación en tiempo real
- Dashboard para huéspedes (historial de reservas, cancelación, descarga de PDF)
- Panel de administración (CRUD de propiedades, fotos, gestión de reservas, fechas bloqueadas, estadísticas)
- Generación de PDF de confirmación de reserva
- Multi-idioma (ES/EN) con middleware de locale
- Autenticación completa (login, registro, recuperación de contraseña, verificación email)
- Autorización con Policies (BookingPolicy) y middleware Admin

## Stack

| Capa | Tecnología |
|------|------------|
| Backend | Laravel 13, PHP 8.4 |
| Frontend | Blade, Alpine.js, Tailwind CSS |
| Auth | Laravel Breeze |
| PDF | DomPDF |
| Base de datos | MySQL / SQLite (dev) |
| Fuentes | Inter + Poppins (Bunny Fonts) |

## Arquitectura

- **6 migraciones** + modelos Eloquent con relaciones (`User`, `Property`, `PropertyPhoto`, `Booking`, `BlockedDate`, `Review`)
- **2 enums** tipados (`BookingStatus`, `PropertyType`)
- **4 services** con lógica de negocio (`AvailabilityService`, `BookingService`, `PriceService`, `PdfService`)
- **10 controllers** separados por rol (público, guest, admin)
- **57 rutas** con middlewares (`auth`, `admin`, `locale`)

## Instalación

```bash
git clone https://github.com/mazingerz969/solstay-web.git
cd solstay-web
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

Usuarios demo creados por el seeder:
- Admin: `admin@solstay.test` / `password`
- Huésped: `guest@solstay.test` / `password`

## Estado del proyecto

MVP funcional y navegable de principio a fin. Roadmap: pasarela de pagos (Stripe), API REST con Sanctum, tests (PHPUnit/Pest), deploy a producción.

## Licencia

MIT
