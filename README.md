# 📦 Laravel 11 API & Blade Frontend Example

This project demonstrates how to create a basic API using Laravel 11 and display the data in a frontend using Blade. This setup is perfect for building simple applications that require backend API data rendering with Blade views.

---

## 🛠 Features

- **RESTful API** for CRUD operations on `Product` data.
- **Blade-based Frontend** to display data fetched from the API.
- **Easy-to-follow structure** for creating an API and rendering it on the frontend in Laravel.

---

## 📋 Table of Contents

1. [Installation](#-installation)
2. [Setting up the API](#-setting-up-the-api)
3. [Displaying API Data in Blade](#-displaying-api-data-in-blade)
4. [Testing the Application](#-testing-the-application)

---

## 🚀 Installation

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd <repository-name>
   ```

2. **Install Laravel dependencies**:
   ```bash
   composer install
   ```

3. **Environment Configuration**:
   - Duplicate `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Set up your database connection in `.env` and generate an application key:
     ```bash
     php artisan key:generate
     ```

---

## ⚙️ Setting up the API

Follow these steps to set up the backend API:

### 1. **Create the `Product` Model and Migration**

   ```bash
   php artisan make:model Product -m
   ```

   Update the migration file in `database/migrations/` with the following fields:

   ```php
   Schema::create('products', function (Blueprint $table) {
       $table->id();
       $table->string('name');
       $table->decimal('price', 8, 2);
       $table->integer('quantity');
       $table->timestamps();
   });
   ```

   Run the migration:

   ```bash
   php artisan migrate
   ```

### 2. **Create API Controller for Product CRUD**

   Create a new controller for handling API requests:

   ```bash
   php artisan make:controller API/ProductController
   ```

   Add CRUD methods in the `ProductController`:

   ```php
   use App\Models\Product;

   class ProductController extends Controller
   {
       public function index() { /* code here */ }
       public function show($id) { /* code here */ }
       public function store(Request $request) { /* code here */ }
       public function update(Request $request, $id) { /* code here */ }
       public function destroy($id) { /* code here */ }
   }
   ```

### 3. **Define API Routes**

   Add the following routes in `routes/api.php`:

   ```php
   use App\Http\Controllers\API\ProductController;

   Route::get('/products', [ProductController::class, 'index']);
   Route::get('/products/{id}', [ProductController::class, 'show']);
   Route::post('/products', [ProductController::class, 'store']);
   Route::put('/products/{id}', [ProductController::class, 'update']);
   Route::delete('/products/{id}', [ProductController::class, 'destroy']);
   ```

---

## 🌐 Displaying API Data in Blade

### 1. **Create Controller for Frontend Display**

   Create a new controller `ProductPageController`:

   ```bash
   php artisan make:controller ProductPageController
   ```

   Add code to call the API and send data to Blade:

   ```php
   use Illuminate\Support\Facades\Http;

   class ProductPageController extends Controller
   {
       public function index()
       {
           $response = Http::get('http://localhost:8000/api/products');
           $products = $response->json();
           return view('products.index', compact('products'));
       }
   }
   ```

### 2. **Define Frontend Route**

   Add the frontend route in `routes/web.php`:

   ```php
   use App\Http\Controllers\ProductPageController;

   Route::get('/products', [ProductPageController::class, 'index']);
   ```

### 3. **Create Blade View**

   Create a view file in `resources/views/products/index.blade.php`:

   ```html
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Product List</title>
   </head>
   <body>
       <h1>Product List</h1>
       <table border="1">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Name</th>
                   <th>Price</th>
                   <th>Quantity</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($products as $product)
                   <tr>
                       <td>{{ $product['id'] }}</td>
                       <td>{{ $product['name'] }}</td>
                       <td>{{ $product['price'] }}</td>
                       <td>{{ $product['quantity'] }}</td>
                   </tr>
               @endforeach
           </tbody>
       </table>
   </body>
   </html>
   ```

---

## ✅ Testing the Application

1. **Run the Laravel server**:
   ```bash
   php artisan serve
   ```

2. **Access the application**:
   - Open a browser and navigate to [http://localhost:8000/products](http://localhost:8000/products) to see the product list fetched from the API.

---

## 📜 License

This project is open-source and available under the [MIT License](LICENSE).

---

With this guide, you should be able to easily set up a Laravel API and display data in a Blade view. Happy coding! 😊

