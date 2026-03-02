#!/bin/bash
# =============================================================
# Foresight CGC - Deployment Script for Namecheap Shared Hosting
# =============================================================
# Usage:
#   1. Upload foresight.zip to /home/foredogn/
#   2. Upload this script to /home/foredogn/
#   3. In cPanel Terminal or SSH, run:
#        chmod +x deploy.sh && ./deploy.sh
# =============================================================

set -e

# --- Configuration (auto-detect paths) ---
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
HOME_DIR="$(eval echo ~)"
APP_DIR="$HOME_DIR/foresight"
PUBLIC_HTML="$HOME_DIR/public_html"

# Find the zip - check next to script first, then home dir
if [ -f "$SCRIPT_DIR/foresight.zip" ]; then
    ZIP_FILE="$SCRIPT_DIR/foresight.zip"
elif [ -f "$HOME_DIR/foresight.zip" ]; then
    ZIP_FILE="$HOME_DIR/foresight.zip"
else
    ZIP_FILE="$HOME_DIR/foresight.zip"
fi

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

step() { echo -e "\n${GREEN}[STEP $1]${NC} $2"; }
warn() { echo -e "${YELLOW}[WARNING]${NC} $1"; }
fail() { echo -e "${RED}[ERROR]${NC} $1"; exit 1; }

echo ""
echo "====================================="
echo "  Foresight CGC Deployment Script"
echo "====================================="
echo ""

# --- Step 1: Check zip exists ---
step 1 "Checking for foresight.zip..."
echo "  Home directory: $HOME_DIR"
if [ ! -f "$ZIP_FILE" ]; then
    fail "foresight.zip not found. Looked in:\n  - $SCRIPT_DIR/foresight.zip\n  - $HOME_DIR/foresight.zip\n  Upload it to your home directory first."
fi
echo "  Found: $ZIP_FILE"

# --- Step 2: Extract ---
step 2 "Extracting files..."
if [ -d "$APP_DIR" ]; then
    warn "Existing $APP_DIR found. Backing up .env if present..."
    if [ -f "$APP_DIR/.env" ]; then
        cp "$APP_DIR/.env" "$HOME_DIR/.env.backup"
        echo "  Backed up .env to $HOME_DIR/.env.backup"
    fi
    rm -rf "$APP_DIR"
fi
cd "$HOME_DIR"
unzip -q "$ZIP_FILE"
echo "  Extracted to $APP_DIR"

# Create required storage directories (zip excludes empty dirs)
mkdir -p "$APP_DIR/storage/framework/cache/data"
mkdir -p "$APP_DIR/storage/framework/sessions"
mkdir -p "$APP_DIR/storage/framework/views"
mkdir -p "$APP_DIR/storage/logs"
echo "  Created storage directories"

# --- Step 3: Setup .env ---
step 3 "Setting up environment..."
if [ -f "$HOME_DIR/.env.backup" ]; then
    cp "$HOME_DIR/.env.backup" "$APP_DIR/.env"
    echo "  Restored previous .env (preserving APP_KEY)"
elif [ -f "$APP_DIR/.env.production" ]; then
    cp "$APP_DIR/.env.production" "$APP_DIR/.env"
    echo "  Copied .env.production to .env"
    cd "$APP_DIR"
    php artisan key:generate --force
    echo "  Generated new APP_KEY"
else
    fail "No .env.production found and no previous .env backup. Create .env manually."
fi

# --- Step 4: Permissions ---
step 4 "Setting permissions..."
cd "$APP_DIR"
chmod -R 775 storage
chmod -R 775 bootstrap/cache
echo "  storage/ and bootstrap/cache/ set to 775"

# --- Step 5: Link public_html ---
step 5 "Linking public_html to Laravel public/..."
if [ -L "$PUBLIC_HTML" ]; then
    rm "$PUBLIC_HTML"
    echo "  Removed existing symlink"
elif [ -d "$PUBLIC_HTML" ]; then
    if [ -d "$HOME_DIR/public_html_original" ]; then
        rm -rf "$PUBLIC_HTML"
    else
        mv "$PUBLIC_HTML" "$HOME_DIR/public_html_original"
        echo "  Backed up original public_html to public_html_original/"
    fi
fi

# Try symlink first
ln -s "$APP_DIR/public" "$PUBLIC_HTML" 2>/dev/null

if [ -L "$PUBLIC_HTML" ]; then
    echo "  Symlink created: public_html -> foresight/public"
else
    # Symlink failed, copy files instead
    warn "Symlink not supported. Copying public/ to public_html/..."
    mkdir -p "$PUBLIC_HTML"
    cp -r "$APP_DIR/public/." "$PUBLIC_HTML/"

    # Update index.php to use absolute paths
    cat > "$PUBLIC_HTML/index.php" << 'INDEXPHP'
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

INDEXPHP

    # Append with variable expansion
    cat >> "$PUBLIC_HTML/index.php" << INDEXPHP
if (file_exists(\$maintenance = '$APP_DIR/storage/framework/maintenance.php')) {
    require \$maintenance;
}

require '$APP_DIR/vendor/autoload.php';

(require_once '$APP_DIR/bootstrap/app.php')
    ->handleRequest(Request::capture());
INDEXPHP

    echo "  Files copied and index.php updated with absolute paths"
fi

# --- Step 6: Storage link ---
step 6 "Creating storage symlink..."
cd "$APP_DIR"
php artisan storage:link --force 2>/dev/null || true

# If public_html is a copy (not symlink), also link storage there
if [ ! -L "$PUBLIC_HTML" ] && [ -d "$PUBLIC_HTML" ]; then
    ln -sf "$APP_DIR/storage/app/public" "$PUBLIC_HTML/storage" 2>/dev/null || true
fi
echo "  Storage link created"

# --- Step 7: Run migrations ---
step 7 "Running database migrations..."
cd "$APP_DIR"
php artisan migrate --force
echo "  Migrations complete"

# --- Step 8: Seed database ---
step 8 "Seeding database..."
cd "$APP_DIR"
php artisan db:seed --force
echo "  Database seeded"

# --- Step 9: Optimize for production ---
step 9 "Optimizing for production..."
cd "$APP_DIR"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components
echo "  All caches built"

# --- Step 10: Cleanup ---
step 10 "Cleaning up..."
rm -f "$ZIP_FILE"
rm -f "$HOME_DIR/.env.backup"
echo "  Removed zip file"

# --- Done ---
echo ""
echo "====================================="
echo -e "  ${GREEN}DEPLOYMENT COMPLETE${NC}"
echo "====================================="
echo ""
echo "  Site:  https://foresightcosec.com"
echo "  Admin: https://foresightcosec.com/admin"
echo ""
echo "  Admin login:"
echo "    Email:    admin@foresightcgc.com"
echo "    Password: password"
echo ""
echo "  Next steps:"
echo "    1. Enable SSL in cPanel (AutoSSL)"
echo "    2. Visit the site to verify"
echo "    3. Change admin password after first login"
echo ""
