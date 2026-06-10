# Despliegue online — SolStay (opción A: mismo VPS que Spring Boot Dojo)

## Despliegue rápido (esta noche)

En **tu PC** (commits ya hechos; falta push si GitHub pide login):

```bash
cd ~/solstay-web && git push origin main
cd ~/proyectos/spring-boot-dojo && git push origin main
# Si falla: gh auth login
```

En **duckdns.org**: crea `solstay` → misma IP que `spring-dojo`.

En el **VPS** (SSH):

```bash
# 1) Actualizar Dojo (nginx gateway)
cd ~/proyectos/spring-boot-dojo && git pull && bash deploy/deploy.sh

# 2) SolStay
cd ~/proyectos
git clone https://github.com/mazingerz969/solstay-web.git 2>/dev/null || (cd solstay-web && git pull)
cd solstay-web
cp .env.production.example .env.production

# Genera y pega en .env.production:
echo "APP_KEY=base64:$(openssl rand -base64 32)"
echo "DB_PASSWORD=$(openssl rand -base64 24)"
echo "DB_ROOT_PASSWORD=$(openssl rand -base64 24)"

bash deploy/deploy.sh
docker compose -f docker-compose.prod.yml logs -f app
```

Prueba: **http://solstay.duckdns.org** · Login admin: `admin@solstay.test` / `password`

---

Guía para publicar **SolStay** en el mismo servidor donde ya corre [Spring Boot Dojo](https://github.com/mazingerz969/spring-boot-dojo).

## Arquitectura

```
                         portfolio-net (Docker)
┌────────────────────────────────────────────────────────────┐
│  nginx (Dojo) :80                                          │
│    dojo.tudominio.com    → frontend + backend              │
│    solstay.tudominio.com → solstay-app:80                  │
└────────────────────────────────────────────────────────────┘
         │                              │
   Spring Boot Dojo                 SolStay
   (Postgres + Java + Next)         (MySQL + Laravel)
```

| Qué | Dónde |
|-----|--------|
| Código SolStay | [GitHub — solstay-web](https://github.com/mazingerz969/solstay-web) |
| Código Dojo | [GitHub — spring-boot-dojo](https://github.com/mazingerz969/spring-boot-dojo) |
| Apps en marcha | Tu VPS (Oracle, Hetzner, etc.) |

---

## Requisitos previos

- VPS con Docker ya funcionando (el mismo de Dojo).
- Spring Boot Dojo desplegado o listo para redesplegar con el nginx actualizado.
- Dominio con dos subdominios (o dos registros A):

```
dojo.tudominio.com     →  IP_DEL_VPS
solstay.tudominio.com  →  IP_DEL_VPS
```

---

## Paso 1 — Actualizar Spring Boot Dojo (gateway nginx)

En el servidor, actualiza el repo de Dojo para traer el nginx que enruta ambos subdominios:

```bash
cd ~/proyectos/spring-boot-dojo
git pull origin main
```

Edita `deploy/nginx.conf` en el repo de Dojo y sustituye los dominios si usas otros. Con DuckDNS (mismo VPS que Dojo):

- `spring-dojo.duckdns.org` → Spring Boot Dojo
- `solstay.duckdns.org` → SolStay (crea el registro en duckdns.org apuntando a la **misma IP**)

Reinicia el stack de Dojo:

```bash
bash deploy/deploy.sh
```

Esto crea la red Docker `portfolio-net` si no existe.

---

## Paso 2 — Clonar SolStay en el servidor

```bash
cd ~/proyectos
git clone https://github.com/mazingerz969/solstay-web.git
cd solstay-web
```

---

## Paso 3 — Configurar secretos

```bash
cp .env.production.example .env.production
```

Genera valores únicos:

```bash
echo "APP_KEY=base64:$(openssl rand -base64 32)"
echo "DB_PASSWORD=$(openssl rand -base64 24)"
echo "DB_ROOT_PASSWORD=$(openssl rand -base64 24)"
```

Edita `.env.production`:

```env
APP_KEY=base64:...
DB_PASSWORD=...
DB_ROOT_PASSWORD=...
APP_URL=http://solstay.duckdns.org
RUN_SEEDER=true
SOLSTAY_DOMAIN=solstay.duckdns.org
DOJO_DOMAIN=spring-dojo.duckdns.org
```

> `RUN_SEEDER=true` solo la **primera vez** (crea propiedades demo y usuarios). Después ponlo en `false`.

Usuarios demo tras el seed:

- Admin: `admin@solstay.test` / `password`
- Huésped: `guest@solstay.test` / `password`

---

## Paso 4 — Desplegar SolStay

```bash
bash deploy/deploy.sh
```

Comprueba:

```bash
docker compose -f docker-compose.prod.yml ps
docker compose -f docker-compose.prod.yml logs -f app
```

La primera build tarda varios minutos (Composer + npm + imagen PHP).

---

## Paso 5 — Probar

Desde el navegador:

- `http://solstay.tudominio.com` → landing de SolStay
- `http://dojo.tudominio.com` → Spring Boot Dojo (sin cambios)

Si accedes por IP sin dominio, Dojo sigue respondiendo en el puerto 80 (bloque `server_name _`).

---

## Paso 6 — HTTPS

Igual que en Dojo: **Certbot** en el host o **Cloudflare** (proxy naranja + SSL Flexible/Full).

Con Certbot, incluye **ambos** subdominios:

```bash
sudo certbot certonly --standalone -d dojo.tudominio.com -d solstay.tudominio.com
```

Monta los certificados en el nginx gateway o usa un reverse proxy TLS en el host.

---

## Comandos útiles

```bash
# Logs SolStay
docker compose -f docker-compose.prod.yml logs -f app

# Actualizar tras git pull
docker compose -f docker-compose.prod.yml --env-file .env.production up -d --build

# Parar SolStay (Dojo sigue corriendo)
docker compose -f docker-compose.prod.yml down

# Migraciones manuales
docker compose -f docker-compose.prod.yml exec app php artisan migrate --force
```

---

## Problemas frecuentes

| Error | Solución |
|-------|----------|
| 502 en solstay.tudominio.com | `docker logs solstay-app` — espera a que MySQL esté healthy |
| Dojo funciona, SolStay no | ¿Está `solstay-app` en `portfolio-net`? `docker network inspect portfolio-net` |
| Dominio incorrecto | Revisa `server_name` en `spring-boot-dojo/deploy/nginx.conf` y reinicia Dojo |
| APP_KEY missing | Rellena `APP_KEY` en `.env.production` y redeploy |
| Out of memory | 2 GB RAM + MySQL + Java puede ir justo — añade swap o sube de plan |

---

## Publicar cambios en GitHub

Desde tu PC:

```bash
cd ~/solstay-web
git check-ignore .env.production
git add Dockerfile docker-compose.prod.yml deploy/ .env.production.example DEPLOY.md .dockerignore .gitignore
git commit -m "Add production deployment for shared VPS with Spring Boot Dojo"
git push origin main
```

En el **servidor**, después de push:

```bash
cd ~/proyectos/solstay-web && git pull && bash deploy/deploy.sh
```
