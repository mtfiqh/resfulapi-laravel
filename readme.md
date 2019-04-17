
  

# BACKEND RESTFUL API WITH LARAVEL 5.8

Backend dengan laravel ini dibuat untuk mengikuti **pre-test internship backend developer** di *privy identity ID* , berikut skema database yang diberikan :

  

**Category**

  
| index | Datatype | Mandatory | Remarks |
|------------|:------------:|----------:|---------|
| id | Integer | Y | indexed |
| name | String | Y | |
| enable | Boolean | Y |

  
  

**Product**

  

| index | Datatype | Mandatory | Remarks |
|------------|:------------:|----------:|---------|
| id | Integer | Y | indexed |
| name | String | Y | |
| Description| String | Y | |
| enable | Boolean | Y | |

  
  

**Category_Product**

  

| index | Datatype | Mandatory | Remarks |
|------------|:------------:|----------:|---------|
| product_id | Integer | Y | indexed |
| category_id| Integer | Y | indexed |

  
  

**Image**

  
| index | Datatype | Mandatory | Remarks |
|------------|:------------:|----------:|---------|
| id | Integer | Y | indexed |
| name | String | Y | |
| file | String | Y | |
| enable | Boolean | Y | |

  
  

**Image Product**

  

| index | Datatype | Mandatory | Remarks |
|------------|:------------:|----------:|---------|
| product_id | Integer | Y | indexed |
| image_id | Integer | Y | indexed |

---

Yang dapat kita tahu dari skema diatas adalah :

  

1. Hubungan antara *Category* dan *Product* adalah Many To Many

2.  *Category Product* merupakan Table **pivot** untuk *category* dan *product*

3. Hubungan antara *Image* dan *Product* adalah Many To Many

4.  *Image* dan *Product* merupakan table **pivot** untuk *Image* dan *Product*

  

---

# Cara Menjalankan Laravel
## Installing requirement Laravel 5.8
- Membutuhkan requirements yang sudah terdapat di dokumentasi nya [Server-Requirement Laravel 5.8](https://laravel.com/docs/5.8#server-requirements)
- Setelah menginstall semua requirement, lakukan instalisasi [Composer](https://getcomposer.org/)
- Setelah itu untuk database silahkan install MySql

> Atau untuk pengguna windows 10 dengan WSL ubuntu silahkan baca artikel medium yang telah saya buat tentang [Cara termudah install & development laravel 5.8 di windows 10 dengan WSL bash ubuntu 18.04](https://medium.com/@taufiq28101998/cara-termudah-install-development-laravel-5-8-di-windows-10-dengan-wsl-bash-ubuntu-18-04-6b95c9a276f0) *lakukan sampai **Merubah Permission Composer***
> atau bisa juga menggunakan docker dengan [Laradock](https://laradock.io/)

## Menjalankan Project Restful Api 
Jalankan perintah untuk clone project (lewatkan jika sudah).

    $ git clone https://github.com/taufiq2810/resfulapi-laravel.git

Berikutnya, pindah ke directory project yang sudah di clone.
Buat file

    .env (pada root directory project)

> .../resfulapi-laravel/.env

Lalu, copy code dibawah ini ke dalam file *.env* tadi

    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:0HVtSYKBNS0E6YsX3azcEMWnGI2F7EpGhf3CgOfPcC0=
    APP_DEBUG=true
    APP_URL=http://localhost:8000
    
    LOG_CHANNEL=stack
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=privy-test
    DB_USERNAME=root
    DB_PASSWORD=
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    
    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_APP_CLUSTER=mt1
    
    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

   

> **Note** Pada bagian DB_HOST, sampai dengan DB_PASSWORD, sesuaikan dengan settingan mysql, dan **DB_DATABASE** merupakan nama database nya

Jalankan perintah :

    $ composer update
Lalu, jalankan perintah dibawah ini pada CMD / untuk menjalankan laravel

    $ php artisan serve
Pada default nya, laravel akan terbuka dengan localhost port 8000 [http://localhost:8000
](http://localhost:8000)
Jika berhasil dijalankan seperti :

![Laravel berhasil dibuka](https://lh3.googleusercontent.com/fxtSchqssKNLWYW2qVqVY62ibwCuzUfrQCDe606SFEJBywbBVvh2cH57MF5W76wVvmLWL4g3yWCY)

---
# Migration and seeding database
### Migration
Setelah laravel berhasil dijalankan, jangan lupa untuk menghidupkan *mysql*, buat databse dengan nama yang sama seperti **DB_DATABASE** pada file **.env** (*privy-test*), setelah itu jalankan perintah

    $ php artisan migrate
perintah tersebut akan menjalankan migrasi database dan secara otomatis membuat table nya.

### Seeding
disini saya membuat 3 seeding antara lain :
- Category :
	- 6 Isi : category 1-6
- Image :
	- 15 isi : menggunakan faker bawaan laravel
- Product
	- 30 isi : menggunakan faker bawaan laravel
	- mengisi table pivot many to many secara random antara
		- image_product 
		- category_product

cara menjalankan seed jalankan perintah, maka secara otomatis akan mengisi table

    $ php artisan db:seed

# Link API


| Domain | Method    | URI                  | Name             | Action                                          | Middleware |
|---|---|---|---|---|---|
|        | GET/HEAD  | /|          |                             Closure  |                                        web        
|        | GET/HEAD  | api/v1/category      | category.index   | App\Http\Controllers\CategoryController@index   | api        |
|        | POST      | api/v1/category      | category.store   | App\Http\Controllers\CategoryController@store   | api        |
|        | GET/HEAD  | api/v1/category/{id} | category.show    | App\Http\Controllers\CategoryController@show    | api        |
|        | PUT/PATCH | api/v1/category/{id} | category.update  | App\Http\Controllers\CategoryController@update  | api        |
|        | DELETE    | api/v1/category/{id} | category.destroy | App\Http\Controllers\CategoryController@destroy | api        |
|        | GET/HEAD  | api/v1/image         | image.index      | App\Http\Controllers\ImageController@index      | api        |
|        | POST      | api/v1/image         | image.store      | App\Http\Controllers\ImageController@store      | api        |
|        | GET/HEAD  | api/v1/image/{id}    | image.show       | App\Http\Controllers\ImageController@show       | api        |
|        | PUT/PATCH | api/v1/image/{id}    | image.update     | App\Http\Controllers\ImageController@update     | api        |
|        | DELETE    | api/v1/image/{id}    | image.destroy    | App\Http\Controllers\ImageController@destroy    | api        |
|        | GET/HEAD  | api/v1/product       | product.index    | App\Http\Controllers\ProductController@index    | api        |
|        | POST      | api/v1/product       | product.store    | App\Http\Controllers\ProductController@store    | api        |
|        | GET/HEAD  | api/v1/product/{id}  | product.show     | App\Http\Controllers\ProductController@show     | api        |
|        | PUT/PATCH | api/v1/product/{id}  | product.update   | App\Http\Controllers\ProductController@update   | api        |
|        | DELETE    | api/v1/product/{id}  | product.destroy  | App\Http\Controllers\ProductController@destroy  | api        |

> Secara default base url nya adalah : [http://localhost:8000
](http://localhost:8000), jadi pemakaiannya adalah *base_url+uri*

# Atribute

### Product
- name -> nama product
- description -> deskripsi product
- Images[] -> array files images
- imagesId[] -> array id images (dari database image)
- enable -> true or false

### Category
- name -> nama category
- enable -> true or false

### Image
- name -> nama gambar (title)
- file -> path ke file nya
- enable ->true or false

### Pivot Table
- image_product
	- product_id -> id dari data product
	- image_id -> id dari data image
- category_product
	- category_id -> id dari data category
	- product_id -> id data dari product
# Test API

## Product CRUD
### Create data product
![Create data product](https://lh3.googleusercontent.com/WkTr79ERECjU2-IeNGTBmdtPF7YQSOkjiNsJw7skAcAfwmkapIS8TsPGFL4S7exeznmMeY6ZRjyl)

> **images[]** jika mengirimkan files image, **imagesId[]** jika mengirimkan id image, dari image yang sudah ada

### Read data product
![Read data product](https://lh3.googleusercontent.com/xV6TItKzDnZ5EFshyGTToJ8zS60j7rP6OeoxC4qiLp7FQuWiIWO2bgKfSDE3T5eYyjWNCGG_16Pk "Read data product")
![](https://lh3.googleusercontent.com/GxPhaqTNqb2OEy2ZBy2swvqc89EvluQsWgEY9vVxhrNntBK5kMdaxYW8O2XqwgLUKzRkJwgzsHNe)
### Update data product
![Update data product](https://lh3.googleusercontent.com/qi-z6pW1CLFkDMpj9LirgheiFjjGdre2QiC0OUk41KgTtseBlKwwCcaudR0FoCAC-4usvij6FJlN)

> Untuk update diperlukan _method "PUT"

### Delete data product
![Delete product](https://lh3.googleusercontent.com/o7iM5RmQ3Avs99HwO25kJrQcocS_yc7Ygg-bIrutQ67ACERcmueo3ixgtGr1dNwP3993Yk8gX5RW)

## Category CRUD
### Create category
![Create Category](https://lh3.googleusercontent.com/4rhYSbYcCii6a1VYLZ5RzRMEv4VHm1xII-l5qQmDxocP4nq8fm4xXfkUvbTyfpy64PZGm-KPxJap)

### Read Category
![Read Category](https://lh3.googleusercontent.com/cgTxoX-cXSsyXJ95XjU6CNHyLGBC49nVb1M267KhwDf7qF129rv8XCrvI9nABY-sGAbvz_gEBJwo)

![Read Category](https://lh3.googleusercontent.com/0jbX3Bjxe5EWJRyp07NnOB6H3lK9G7LklvF7T6ekMdlpbhOETWalLRtCnxrEylGGvgJjacMtTdd9)

### Update Category
![Update Category](https://lh3.googleusercontent.com/UAod-wZOMFdBmnEji9zzgre9eO6edjsFsrkZVoF2t92wHaVSRm5RlMiUNLKbUStTszczrR0WlORa)

### Delete Category
![enter image description here](https://lh3.googleusercontent.com/YcNhkIt4vdL6MR6eBpGvuMsRrO6YqBFyqeXJGydace_kTPAb22_RSrMteiVFYrTHk-y9gUFA-cNA)

## Image CRUD
### Create Image
![Create Image](https://lh3.googleusercontent.com/Ljy6WskVDg5E5yOCUSk3F7UUh_pSxMChEwyWwWT78MdRUEzptV1XzAozsBPQw_1X4YiWea5i2LXQ)

### Read Image
![](https://lh3.googleusercontent.com/b4rmL_krbnDMOCfZIfDIF8He45cbhS5c-5pP3NeLPL26HhjuGVPHxZ5MwmCQlB5sjgBqfgQIULhO)

![](https://lh3.googleusercontent.com/Cbr473V9djB5SUUb88PJ00By_sDKlw4c1RQa4iBbFvu5SULt28xuMgwPZXDgMaFOU7pwlL6847x-)

### Update Image
![update image](https://lh3.googleusercontent.com/V6joXi0pb3S8YqLWYcgYihMx2xb-dzhDDBMdDe3GBgzhpzLepfTDCGaqU9DvkkVSGuq1Vroxv8jy)

### Delete Image
![Delete Image](https://lh3.googleusercontent.com/GRR4Z8i99fbgLhKj4LIOcse8X0rVkraCs57IuLKm8-DrgPZEqPd1JaxkQt5kB9klcU8QaZukZ2R2)