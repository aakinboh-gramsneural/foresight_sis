#!/bin/bash
# =============================================================
# Foresight CGC - Package for Deployment
# =============================================================
# Run this locally to create foresight.zip ready for upload.
# Usage: ./package.sh
# =============================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$SCRIPT_DIR"

echo ""
echo "====================================="
echo "  Packaging Foresight CGC"
echo "====================================="
echo ""

# Build production assets
echo "[1/3] Building production assets..."
npm run build
echo "  Assets built"

# Install production-only composer deps
echo "[2/3] Installing production dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction
echo "  Dependencies installed (no dev)"

# Create zip
echo "[3/3] Creating foresight.zip..."
cd ..
rm -f foresight.zip

zip -r foresight.zip foresight/ \
    -x "foresight/node_modules/*" \
    -x "foresight/.git/*" \
    -x "foresight/.env" \
    -x "foresight/tests/*" \
    -x "foresight/storage/logs/*.log" \
    -x "foresight/storage/framework/cache/data/*" \
    -x "foresight/storage/framework/sessions/*" \
    -x "foresight/storage/framework/views/*" \
    -x "foresight/package.sh" \
    -x "foresight/DEPLOY.md" \
    -x "foresight/.phpunit.cache/*"

SIZE=$(du -h foresight.zip | cut -f1)
echo ""
echo "====================================="
echo "  Package ready: foresight.zip ($SIZE)"
echo "====================================="
echo ""
echo "  Upload these 2 files to /home/foredogn/:"
echo "    1. foresight.zip"
echo "    2. foresight/deploy.sh"
echo ""
echo "  Then in cPanel Terminal run:"
echo "    chmod +x deploy.sh && ./deploy.sh"
echo ""

# Restore dev dependencies
cd foresight
composer install --no-interaction
