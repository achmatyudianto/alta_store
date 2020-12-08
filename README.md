### Entity Relationship Diagram (ERD)

<img alt='erd' src='https://user-images.githubusercontent.com/30197099/101329770-65e17b00-38a4-11eb-89a7-b29df05a3da1.png' width='500' />

### Installasi
 1. Install [PostgreSQL](https://www.postgresql.org)
 2. Install [Composer](https://getcomposer.org/download)
 3. composer update
 4. php artisan migrate
 5. php artisan serve
 
### API Dokumentasi
* **Categori & Produk**
   * Daftar/List Kategori `GET /api/category`
        ##### Response
        ``` json
           {
                "data": [
                    {
                        "id": 1,
                        "category_name": "Kesehatan"
                    },
                    {
                        "id": 2,
                        "category_name": "Elektronik"
                    }
                ]
            }
       ```
   * Daftar/List Produk `GET /api/product?category_id={category_id}`
        ##### Response
        ``` json
            {
                "data": [
                    {
                        "id": 1,
                        "category_id": 2,
                        "product_name": "Mixer",
                        "note": "Hemat Listrik",
                        "price": 30000
                    },
                    {
                        "id": 2,
                        "category_id": 2,
                        "product_name": "Dispenser",
                        "note": "awet, kuat, tahan banting",
                        "price": 40000
                    }
                ]
            }
        ```
* **Autentikasi**

    Endpoint tertutup membutuhkan [Token](https://laravel.com/docs/5.8/api-authentication) yang valid untuk dimasukkan ke dalam header permintaan. [Token](https://laravel.com/docs/5.8/api-authentication) dapat diperoleh melalui Login.
    * Login `POST /api/auth/login`
    * Registrasi `POST /api/auth/register`
    
* **Keranjang/Cart**
    * Daftar Produk di Keranjang/Cart
    
        **url** : `/api/cart`

        **Method** : `GET`
        
        **Auth required** : YES

        **Response Success** : Contoh

        ```
        {
            "data": [
                {
                    "id": 1,
                    "product_id": 1,
                    "product_name": "Mixer",
                    "price": 30000,
                    "qty": 2,
                    "amount": 60000,
                    "created_at": "2 days ago"
                },
                {
                    "id": 2,
                    "product_id": 2,
                    "product_name": "Dispenser",
                    "price": 40000,
                    "qty": 2,
                    "amount": 80000,
                    "created_at": "2 days ago"
                }
            ]
        }
        ```
        
    * Tambah Produk ke Keranjang/Cart
    
        **url** : `/api/cart`

        **Method** : `POST`
        
        **Auth required** : YES

        **Body** : ``` {"product_id" : [id_product], "qty" : [qty]} ``` ex:``` {"product_id" : 2, "qty" : 3} ```

        **Response Success** : Contoh

        ```
        {
            "data": {
                "id": 3,
                "product_id": 2,
                "product_name": "Dispenser",
                "price": 40000,
                "qty": 3,
                "amount": 120000,
                "created_at": "1 second ago"
            }
        }
        ```
        
    * Edit Kuantitas Produk di Keranjang/Cart
    
        **url** : `/api/cart/{cart_id}`

        **Method** : `PUT`
        
        **Auth required** : YES

        **Body** : ``` {"qty" : [qty]} ``` ex:``` {"qty" : 4} ```

        **Response Success** : Contoh

        ```
        {
            "data": {
                "id": 3,
                "product_id": 2,
                "product_name": "Dispenser",
                "price": 40000,
                "qty": 4,
                "amount": 120000,
                "created_at": "1 second ago"
            }
        }
        ```
        
    * Hapus Produk di Keranjang/Cart
    
        **url** : `/api/cart/{cart_id}`

        **Method** : `DELETE`
        
        **Auth required** : YES

        **Response Success** : Contoh ``` {"message": "deleted"} ```
        
     * Checkout
    
        **url** : `/api/checkout`

        **Method** : `POST`
        
        **Auth required** : YES
        
        **Body** : Contoh
        
        ```
        {
            "data" : [
                {"id" : 1},
                {"id": 3}
            ]
        }
        ```

        **Response Success** : Contoh 
        
        ```
        {
            "data": {
                "id": 1,
                "paid": false,
                "created_at": "07/12/2020 07:06:26",
                "transaction_details": [
                    {
                        "id": 1,
                        "production_id": "1",
                        "product_name": "Mixer",
                        "price": 30000,
                        "qty": 2,
                        "amount": 60000
                    },
                    {
                        "id": 2,
                        "production_id": "2",
                        "product_name": "Dispenser",
                        "price": 40000,
                        "qty": 4,
                        "amount": 160000
                    }
                ]
            }
        }
        ```
     * Daftar/List Checkout
    
        **url** : `/api/checkout`

        **Method** : `GET`
        
        **Auth required** : YES

        **Response Success** : Contoh 
        
        ``` 
        {
            "data": [
                {
                    "id": 1,
                    "paid": false,
                    "created_at": "07/12/2020 07:06:26",
                    "transaction_details": [
                        {
                            "id": 1,
                            "production_id": "1",
                            "product_name": "Mixer",
                            "price": 30000,
                            "qty": 2,
                            "amount": 60000
                        },
                        {
                            "id": 2,
                            "production_id": "2",
                            "product_name": "Dispenser",
                            "price": 40000,
                            "qty": 4,
                            "amount": 160000
                        }
                    ]
                }
            ]
        }
        ```

    * Transaksi Pembayaran
    
        **url** : `/api/payment/{transaction_id}`

        **Method** : `PUT`
        
        **Auth required** : YES

        **Response Success** : Contoh

        ```
        {
            "data": {
                "id": 1,
                "paid": true,
                "created_at": "07/12/2020 07:06:26",
                "transaction_details": [
                    {
                        "id": 1,
                        "production_id": "1",
                        "product_name": "Mixer",
                        "price": 30000,
                        "qty": 2,
                        "amount": 60000
                    },
                    {
                        "id": 2,
                        "production_id": "2",
                        "product_name": "Dispenser",
                        "price": 40000,
                        "qty": 4,
                        "amount": 160000
                    }
                ]
            }
        }
        ```
### Deploy
* Daftar/List Kategori `GET https://altastore.mbiodo.com/api/category`
* Daftar/List Produk `GET https://altastore.mbiodo.com/api/product`
* Login `POST https://altastore.mbiodo.com/api/auth/login`
* Registrasi `POST https://altastore.mbiodo.com/api/auth/register`
* Tambah produk ke keranjang/cart `POST https://altastore.mbiodo.com/api/cart`
* Daftar/List produk di keranjang/cart `GET https://altastore.mbiodo.com/api/cart`
* Edit kuantitas produk di keranjang/cart `PUT https://altastore.mbiodo.com/api/cart/{cart}`
* Hapus produk di keranjang/cart `DELETE https://altastore.mbiodo.com/api/cart/{cart}`
* Checkout `POST https://altastore.mbiodo.com/api/checkout`
* Daftar/List Checkout `GET https://altastore.mbiodo.com/api/checkout`
* Payment/Pembayaran `PUT https://altastore.mbiodo.com/api/payment/{transaction_id}`
