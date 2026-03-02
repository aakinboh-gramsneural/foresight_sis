# Vercel Setup Instructions

## After Deployment

Since the SQLite database won't persist on Vercel, you need to either:

### Option 1: Use Vercel Postgres (Recommended)

1. In Vercel Dashboard → Storage → Create Database → Postgres
2. Connect it to your project
3. Update environment variables:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=<from vercel>
   DB_PORT=5432
   DB_DATABASE=<from vercel>
   DB_USERNAME=<from vercel>
   DB_PASSWORD=<from vercel>
   ```
4. Run migrations and seeders via Vercel CLI:
   ```bash
   vercel env pull
   php artisan migrate --force
   php artisan db:seed --force
   ```

### Option 2: Use External Database

Connect to PlanetScale, Supabase, or any PostgreSQL/MySQL database.

## Admin Credentials (from seeder)

- Email: admin@foresightcgc.com
- Password: password

**IMPORTANT**: Change the password after first login!

## Local Development

Database is already seeded locally with:
- 2 users
- 3 hero slides
- 4 services
- 4 stats
- Sample content

To reset local database:
```bash
php artisan migrate:fresh --seed
```
