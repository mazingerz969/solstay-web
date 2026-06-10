#!/usr/bin/env bash
# Despliegue de SolStay en producción (VPS compartido con Spring Boot Dojo)
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"

if [[ ! -f .env.production ]]; then
  echo "Crea .env.production desde .env.production.example"
  exit 1
fi

docker network create portfolio-net 2>/dev/null || true

docker compose -f docker-compose.prod.yml --env-file .env.production up -d --build "$@"

echo ""
echo "SolStay desplegado. Comprueba:"
echo "  docker compose -f docker-compose.prod.yml ps"
echo "  docker compose -f docker-compose.prod.yml logs -f app"
echo ""
echo "Recuerda: el nginx de Spring Boot Dojo debe enrutar ${SOLSTAY_DOMAIN:-solstay.tudominio.com} → solstay-app"
