### API Dokumentasi
* **Categori & Produk**
   * Daftar Kategori `GET /api/category`
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
   * Daftar Produk `GET /api/product?category_id={category_id}`
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

    Endpoint tertutup membutuhkan Token yang valid untuk dimasukkan ke dalam header permintaan. Token dapat diperoleh melalui Login.
    * Login `POST /api/auth/login`
    * Registrasi `POST /api/auth/register`
    
* **Keranjang/Cart**
    * Tambah Produk ke Keranjang/Cart
    
        **url** : `/api/cart`

        **Method** : `POST`
        
        **Auth required** : YES

        **Body** : ``` { "product_id" : [id_product], "qty" : [qty] } ``` ex:``` { "product_id" : 2, "qty" : 3 } ```

        **Response** : Contoh

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

        **Response** : Contoh

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

