# Deploying Foresight CGC to Namecheap Shared Hosting (cPanel)

## Prerequisites

- Namecheap shared hosting with cPanel access
- Domain: foresightcosec.com (already pointed to Namecheap nameservers)
- PHP 8.2+ (check in cPanel > Select PHP Version)
- MySQL database already created: `foredogn_foresightcosec`

---

## Step 1: Set PHP Version in cPanel

1. Log into cPanel
2. Go to **Select PHP Version** (under Software)
3. Set PHP version to **8.2** or higher
4. Enable these extensions (if not already enabled):
   - `pdo_mysql`
   - `mbstring`
   - `openssl`
   - `tokenizer`
   - `xml`
   - `ctype`
   - `json`
   - `bcmath`
   - `fileinfo`
   - `gd` or `imagick`
5. Click **Save**

---

## Step 2: Upload Files

### Option A: Using File Manager (easiest)

1. On your local machine, create a zip of the project:
   ```
   cd /Users/abrahambossey/web_projects
   zip -r foresight.zip foresight/ -x "foresight/node_modules/*" "foresight/.git/*" "foresight/.env" "foresight/.env.production"
   ```
2. In cPanel, open **File Manager**
3. Navigate to `/home/foredogn/` (your home directory)
4. Click **Upload** and upload `foresight.zip`
5. Right-click the zip and select **Extract**
6. You should now have `/home/foredogn/foresight/` with all files

### Option B: Using SSH/Terminal (if available)

1. In cPanel, go to **Terminal** (under Advanced)
2. Or enable SSH Access in cPanel and connect via terminal:
   ```
   ssh foredogn@foresightcosec.com
   ```

---

## Step 3: Move Public Files to public_html

The key to shared hosting: Laravel's `public/` folder contents must go in `public_html/`.

### In cPanel Terminal or SSH:

```bash
# Backup the default public_html (optional)
mv /home/foredogn/public_html /home/foredogn/public_html_backup

# Create symlink from public_html to Laravel's public folder
ln -s /home/foredogn/foresight/public /home/foredogn/public_html
```

### If symlinks don't work (some hosts block them):

1. Move Laravel's public/ contents into public_html/:
   ```bash
   rm -rf /home/foredogn/public_html
   mkdir /home/foredogn/public_html
   cp -r /home/foredogn/foresight/public/* /home/foredogn/public_html/
   cp /home/foredogn/foresight/public/.htaccess /home/foredogn/public_html/
   ```

2. Edit `/home/foredogn/public_html/index.php` to point to the app:
   ```php
   <?php

   use Illuminate\Http\Request;

   define('LARAVEL_START', microtime(true));

   // Determine if the application is in maintenance mode...
   if (file_exists($maintenance = '/home/foredogn/foresight/storage/framework/maintenance.php')) {
       require $maintenance;
   }

   // Register the Composer autoloader...
   require '/home/foredogn/foresight/vendor/autoload.php';

   // Bootstrap Laravel and handle the request...
   (require_once '/home/foredogn/foresight/bootstrap/app.php')
       ->handleRequest(Request::capture());
   ```

---

## Step 4: Configure Environment

### In cPanel Terminal or SSH:

```bash
cd /home/foredogn/foresight

# Copy the production env file
cp .env.production .env

# Generate a new app key
php artisan key:generate
```

### If you uploaded without .env.production:

Create `/home/foredogn/foresight/.env` manually via File Manager with this content:

```
APP_NAME="Foresight CGC"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=America/Edmonton
APP_URL=https://foresightcosec.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en

APP_MAINTENANCE_DRIVER=file

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foredogn_foresightcosec
DB_USERNAME=foredogn_foresightcosec
DB_PASSWORD="$500@foresightcosec"

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=foresightcosec.com
MAIL_PORT=465
MAIL_USERNAME=admin@foresightcosec.com
MAIL_PASSWORD="$500@foresightcosec"
MAIL_FROM_ADDRESS="admin@foresightcosec.com"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"
```

Then run: `php artisan key:generate`

---

## Step 5: Set Permissions

```bash
cd /home/foredogn/foresight

chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## Step 6: Run Migrations & Seed

```bash
cd /home/foredogn/foresight

# Run database migrations
php artisan migrate --force

# Seed the database with content
php artisan db:seed --force
```

---

## Step 7: Create Storage Symlink

```bash
cd /home/foredogn/foresight

php artisan storage:link
```

If public_html is a symlink (Option A from Step 3), this works automatically.

If you copied files (Option B), create the link manually:
```bash
ln -s /home/foredogn/foresight/storage/app/public /home/foredogn/public_html/storage
```

---

## Step 8: Optimize for Production

```bash
cd /home/foredogn/foresight

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components
```

---

## Step 9: Enable SSL

1. In cPanel, go to **SSL/TLS Status** or **AutoSSL**
2. Run AutoSSL to get a free Let's Encrypt certificate for foresightcosec.com
3. Or in Namecheap dashboard, enable the free PositiveSSL if included with hosting

Once SSL is active, force HTTPS by confirming this exists in `/home/foredogn/public_html/.htaccess` (it should already be there from the upload):

```apache
# Force HTTPS (add at the top, inside the IfModule block, before other rules)
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Step 10: Verify

1. Visit https://foresightcosec.com - should show the home page
2. Visit https://foresightcosec.com/about - about page
3. Visit https://foresightcosec.com/services - services page
4. Visit https://foresightcosec.com/contact - contact page with captcha
5. Visit https://foresightcosec.com/admin - Filament admin login
6. Visit https://foresightcosec.com/sitemap.xml - XML sitemap
7. Submit the contact form to test emails

### Admin Login:
- Email: admin@foresightcgc.com
- Password: password

---

## Troubleshooting

### 500 Internal Server Error
```bash
# Check Laravel logs
cat /home/foredogn/foresight/storage/logs/laravel.log

# Check permissions
chmod -R 775 storage bootstrap/cache

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Blank White Page
- Set `APP_DEBUG=true` temporarily in `.env` to see errors
- Check PHP version is 8.2+
- Check all PHP extensions are enabled

### Database Connection Error
- Verify DB credentials in `.env`
- On Namecheap, DB host is usually `127.0.0.1` or `localhost`
- Make sure the DB user has full permissions on the database

### Emails Not Sending
- Verify the email account admin@foresightcosec.com exists in cPanel > Email Accounts
- Test with `php artisan tinker` then: `Mail::raw('Test', fn($m) => $m->to('your@email.com')->subject('Test'));`

### Assets Not Loading (CSS/JS broken)
- Make sure `public/build/` folder was uploaded with the manifest.json and assets
- Check APP_URL in .env matches your domain exactly

### Admin Panel Not Loading
- Run `php artisan filament:cache-components`
- Clear all caches and try again

---

## Updating the Site Later

When you make changes locally and need to redeploy:

1. Build assets locally: `npm run build`
2. Upload changed files via File Manager or FTP
3. If you changed public/ files and used the copy method (Step 3 Option B), re-copy them to public_html
4. SSH in and run:
   ```bash
   cd /home/foredogn/foresight
   php artisan migrate --force    # if DB changes
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
