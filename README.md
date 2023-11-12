## Kurulum

Proje'yi başlatmak için aşağıdaki adımları izleyin.

1. Composer paketlerini yükleyin:

    ```bash
    composer install
    ```

2. `.env.example` dosyasını kopyalayarak `.env` dosyasını oluşturun:

    ```bash
    cp .env.example .env
    ```

3. `.env` dosyasını açarak veritabanı ayarlarınızı düzenleyin:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

4. Uygulama anahtarını oluşturun:

    ```bash
    php artisan key:generate
    ```

5. Veritabanını oluşturun:
    ```bash
    php artisan migrate
    ```
6. Projeyi 9000 portunda başlatın:
   ```bash
    php artisan serve --port=9000
    ```
