# SolStay — Plataforma de alquiler vacacional

MVP de alquiler vacacional (estilo Airbnb simplificado) para practicar Laravel en un caso real: reservas, disponibilidad, panel admin y confirmación en PDF.

**Demo en vivo:** http://solstay.duckdns.org  
**Repositorio:** https://github.com/mazingerz969/solstay-web

**Acceso demo:** `admin@solstay.test` / `password` (admin) · `guest@solstay.test` / `password` (huésped)

## Autoría

| Parte | Quién |
|-------|--------|
| **Backend** | Desarrollo propio — Laravel, modelos, migraciones, services, policies, seeders, PDF, i18n |
| **Frontend** | Maquetación asistida con IA (Blade, Alpine.js, Tailwind); integrada y adaptada al backend |

El flujo de negocio, la API interna, la base de datos y la lógica de reservas son trabajo manual. Las vistas parten de un diseño generado con herramientas de IA y se conectaron al backend real.

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
| Fuentes | Inter, Poppins, Fraunces (auth) |

## Backend (desarrollo propio)

- Modelos Eloquent y relaciones: `User`, `Property`, `PropertyPhoto`, `Booking`, `BlockedDate`, `Review`
- Enums: `BookingStatus`, `PropertyType`
- Services: `AvailabilityService`, `BookingService`, `PricingService`, `CalendarService`
- PDF de confirmación vía DomPDF en `BookingController`
- Controllers por rol (público, huésped, admin), policies y middleware `admin`
- Seeders con datos demo (propiedades en Málaga y Granada)

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

MVP funcional y navegable de principio a fin. Roadmap: pasarela de pagos (Stripe), API REST con Sanctum, tests (PHPUnit/Pest).

## Despliegue en producción

Mismo VPS que [Spring Boot Dojo](https://github.com/mazingerz969/spring-boot-dojo), enrutado por subdominio. Guía completa: **[DEPLOY.md](./DEPLOY.md)**.

```bash
cp .env.production.example .env.production
# Rellena APP_KEY, DB_PASSWORD, DB_ROOT_PASSWORD
bash deploy/deploy.sh
```

**Demo:** http://solstay.duckdns.org (mismo VPS que Spring Boot Dojo, ver `DEPLOY.md`).

## Licencia

MIT
