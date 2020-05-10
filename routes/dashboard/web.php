<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){


        Route::get('index', 'Dashboardcontroller@index')->name('index');

        //users Route
        Route::resource('users', 'UserController')->except(['show','destroy']);
        Route::get('delete/{user}','Usercontroller@delete')->name('delete');


        //categories Routs
        Route::resource('categories', 'Categorycontroller')->except(['show']);

        //products Routs
        Route::resource('products', 'Productcontroller')->except(['show']);

         //clients Routs
         Route::resource('clients', 'ClientController')->except(['show']);
         Route::resource('clients.orders', 'Client\OrderController')->except(['show']);

         //Oreders Route
         Route::resource('orders', 'OrderController');
         Route::get('orders/{order}/products', 'OrderController@products')->name('orders.products');
});

Route::get('/logout', function(){
    Auth::logout();
    return $redirectTo = view('/home');
 });

 //php artisan migrate:refresh --seed
?>






