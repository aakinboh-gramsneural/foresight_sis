# Vercel Deployment Guide

## Required Environment Variables

Add these in your Vercel project settings (Settings > Environment Variables):

```
APP_NAME="Foresight CGC"
APP_ENV=production
APP_KEY=base64:CKwlLwhfLsDbm5lLwuOuNWQoY+PHOQMbtAadMQWN0Dc=
APP_DEBUG=false
APP_URL=https://your-vercel-url.vercel.app

DB_CONNECTION=sqlite

CACHE_DRIVER=array
SESSION_DRIVER=cookie
LOG_CHANNEL=stderr

MAIL_MAILER=smtp
MAIL_HOST=foresightcosec.com
MAIL_PORT=465
MAIL_USERNAME=admin@foresightcosec.com
MAIL_PASSWORD=your-mail-password
MAIL_FROM_ADDRESS=admin@foresightcosec.com
MAIL_FROM_NAME="Foresight CGC"
```

## Important Notes

1. **Database**: SQLite won't persist on Vercel serverless. You need to use:
   - Vercel Postgres
   - PlanetScale (MySQL)
   - Supabase (PostgreSQL)
   - Any external database

2. **File Storage**: Use Vercel Blob or external storage (S3, Cloudinary) for uploads

3. **Sessions**: Using cookie driver since file sessions won't work on serverless

## Deployment Steps

1. Push code to GitHub
2. Import project in Vercel
3. Add environment variables above
4. Deploy

## Troubleshooting

If you get 500 errors:
- Check Vercel function logs
- Ensure APP_KEY is set
- Verify all environment variables are added
- Check that composer dependencies are installed during build
