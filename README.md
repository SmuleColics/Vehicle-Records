# Garahe — Vehicle Records Management

**Live demo: [garahe-theta.vercel.app](https://garahe-theta.vercel.app)** — use "Explore as admin" or "Explore as client" to look around without signing up.

A Laravel 12 web app for managing vehicle records, with two sides:

- **Admin console**: fleet-wide dashboard, every vehicle and its owner, user management with admin/client roles.
- **Client portal**: a personal dashboard and the owner's own vehicles only.

Built with Laravel 12, PHP 8, MySQL, Blade, Bootstrap 5, Chart.js and DataTables. Originally an ITEC 106 final project.

## Run locally (XAMPP)

```bash
composer install
cp .env.example .env        # set DB_CONNECTION=mysql and your DB_ values
php artisan key:generate
php artisan migrate --seed  # --seed adds the demo accounts and sample vehicles
php artisan serve
```

Forgot a password? Reset any account (add `--admin` to also make it an admin):

```bash
php artisan user:reset-password you@example.com --admin
```

## Deploy to Vercel

Vercel runs PHP through the community [`vercel-php`](https://github.com/vercel-community/php) runtime (`api/index.php` + `vercel.json`).
It has no database of its own, so the app uses a free MySQL-compatible [TiDB Cloud](https://tidbcloud.com) cluster.

1. **Database**: create a free TiDB Cloud Starter cluster (region: Singapore), then a database named `garahe`.
2. **Settings**: fill in the `DB_` values in `.env.production` (git-ignored).
3. **Tables + demo data**: run from your PC (Windows needs a CA file for TLS, Git for Windows ships one):

   ```bash
   MYSQL_ATTR_SSL_CA="C:/vscode/Git/mingw64/etc/ssl/certs/ca-bundle.crt" php artisan migrate --seed --env=production --force
   ```

4. **Vercel**: Add New → Project → import this GitHub repo, paste the contents of `.env.production` into
   Environment Variables, and deploy. Leave the framework preset as "Other".

Profile photos are saved in the database because Vercel's filesystem is read-only.
