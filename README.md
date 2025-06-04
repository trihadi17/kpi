### **Petunjuk Penggunaan**
Proyek ini menggunakan Laravel 10, proyek ini berisikan sistem untuk melakukan perhitungan KPI Marketing

### **Software pendukung yang perlu disiapkan sebelum memulai**
- PHP
- Composer
- NodeJs
- Git

### **Panduan Instalasi**

- Download code pada github, setelah itu extract
- Buka terminal atau command line, kemudian arahkan ke folder ***kpi***
- Jalankan perintah:
  ```
  composer install
  ```
- Langkah selanjutnya, jalankan perintah:
  ```
  php -r "copy('.env.example', '.env');";
  ```
- Kemudian membuat application key baru, dengan cara jalankan perintah:
  ```
  php artisan key:generate
  ```
- Buat database dengan nama ***kpi***
- Buka folder kpi pada VScode atau editor lainnya, kemudian sesuaikan parameter pada file **.env**, seperti berikut:
  ```
  APP_URL=http://localhost

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=kpi
  DB_USERNAME=root
  DB_PASSWORD=
  ```
- Selanjutnya melakukan table migration beserta seeder (data dummy) dengan jalankan perintah:
  ```
  php artisan migrate --seed
  ```
- Buka command line yang baru, jalankan perintah:
  ```
  php artisan serve
  ```

- Selanjutnya, buka browser dengan url [http://localhost:8000](http://localhost:8000)
