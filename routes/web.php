    <?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view(ProductController::class);
// });

// Resource route for products
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route for storing ratings
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// Sorting routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/sort/highest-ratings', [ProductController::class, 'index'])->name('products.sort.highest-ratings');
Route::get('/products/sort/lowest-ratings', [ProductController::class, 'index'])->name('products.sort.lowest-ratings');
Route::get('/products/sort/date', [ProductController::class, 'index'])->name('products.sort.date');

//search route

Route::get('/products/search', [ProductController::class, 'performSearch'])->name('products.search');

// report route
// Route for generating the report
Route::get('/reports', [ReportController::class, 'generateReport'])->name('reports.generate');





