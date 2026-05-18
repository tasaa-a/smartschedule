# SmartSchedule - Cara Menjalankan

## 1. Download & Ekstrak
- Download ZIP dari https://github.com/tasaa-a/smartschedule
- Ekstrak ke `C:\laragon\www\smartschedule`

## 2. Buka di VS Code
- Buka folder `C:\laragon\www\smartschedule` di VS Code
- Buka terminal (Ctrl + `)

## 3. Jalankan Perintah di Terminal
```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```

4. Buat Database

· Buka http://localhost/phpmyadmin
· Buat database: smartschedule_db

5. Migrasi & Seeder

```bash
php artisan migrate --seed
```

6. Compile CSS/JS

```bash
npm run build
```

7. Jalankan Server

```bash
php artisan serve
```

8. Login

· Buka http://127.0.0.1:8000
· Email: admin@smartschedule.com
· Password: password123

```
