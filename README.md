

## How to run Project
 Project ini merupakan teknikal test dari perusahaan Fanatech.

 untuk menjalankan project ini, berikut step by step nya : 

 1. clone project :
    ```bash
        git clone https://github.com/yusril86/fanatech-test.git
     ```
2. Install composer : 
 ```bash
        composer install
 ```

3. set file .env :
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_fanatech
    DB_USERNAME=root
    DB_PASSWORD=
    ```
4. install npm for auth :
```bash
        npm install
 ```

 and run 
 ```bash
        npm run build
 ```

 5. Silahkan inject data dari seeder :
 ```bash
        php artisan migrate:fresh --seed
 ```
