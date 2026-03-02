# Vercel Environment Variables

Add these in Vercel Dashboard → Settings → Environment Variables:

## Required Variables

```bash
APP_KEY=base64:CKwlLwhfLsDbm5lLwuOuNWQoY+PHOQMbtAadMQWN0Dc=
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.vercel.app
DB_CONNECTION=sqlite
CACHE_DRIVER=array
SESSION_DRIVER=cookie
LOG_CHANNEL=stderr
VIEW_COMPILED_PATH=/tmp
APP_STORAGE=/tmp
```

## Optional (for email functionality)

```bash
MAIL_MAILER=smtp
MAIL_HOST=foresightcosec.com
MAIL_PORT=465
MAIL_USERNAME=admin@foresightcosec.com
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=admin@foresightcosec.com
MAIL_FROM_NAME="Foresight CGC"
```

## After Adding Variables

1. Click "Redeploy" in Vercel
2. Wait for deployment to complete
3. Visit your site

## Admin Panel

- URL: https://your-app.vercel.app/panel
- Email: admin@foresightcgc.com
- Password: password

**IMPORTANT**: Change password after first login!

## Database Note

SQLite won't persist on Vercel. For production, use:
- Vercel Postgres (recommended)
- PlanetScale
- Supabase
