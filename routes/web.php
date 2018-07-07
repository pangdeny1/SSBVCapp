<?php


use Olifolkerd\Convertor\Convertor;
use PragmaRX\Countries\Package\Countries;
Auth::routes();

Route::view("/", "welcome");

Route::view("template", "template");

Route::get("test", function (){
    return response(
        Sms::send(
            "+255762764819",
            "Hello David Pella, This is the test message from homeverge"
        ),
        200
    )->header('Content-Type', 'text/xml');
});

Route::get('home', [
    "as" => "home",
    "uses" => "HomeController@index"
]);

Route::get("accounts/{user}/activations", [
    "as" => "accounts.activate",
    "uses" => "AccountActivationsController@create",
]);
Route::patch("purchases/{purchase}/weights", [
    "as" => "purchases.weights.update",
    "uses" => "PurchasesWeightsController@update",
]);
Route::post("purchases/{purchase}/status", [
    "as" => "purchases.acceptances",
    "uses" => "PurchaseStatusesController@store"
]);
Route::delete("purchases/{purchase}/status", [
    "as" => "purchases.rejections",
    "uses" => "PurchaseStatusesController@destroy"
]);
Route::post("purchases/{purchase}/remarks", [
    "as" => "purchases.remarks.store",
    "uses" => "PurchaseRemarksController@store",
]);

Route::post("remarks/{remark}/replays", [
    "as" => "remarks.replays.store",
    "uses" => "RemarkReplaysController@store",
]);

Route::prefix('reports')->group(function () {
    Route::get("purchases", [
        "as" => "purchases.reports",
        "uses" => "PurchasesReportsController@index",
    ]);
    Route::get("products", [
        "as" => "products.reports",
        "uses" => "ProductsReportsController@index",
    ]);
});


Route::get("farmers/{farmer}/farms", [
    "as" => "farmers.farms.index",
    "uses" => "FarmerFarmsController@index",
]);
Route::get("farmers/{farmer}/farms/create", [
    "as" => "farmers.farms.create",
    "uses" => "FarmerFarmsController@create",
]);
Route::post("farmers/{farmer}/farms", [
    "as" => "farmers.farms.store",
    "uses" => "FarmerFarmsController@store",
]);

Route::get("farmers/{farmer}/blocks", [
    "as" => "farmers.blocks.index",
    "uses" => "FarmerBlocksController@index",
]);
Route::get("farmers/{farmer}/blocks/create", [
    "as" => "farmers.blocks.create",
    "uses" => "FarmerBlocksController@create",
]);
Route::post("farmers/{farmer}/blocks", [
    "as" => "farmers.blocks.store",
    "uses" => "FarmerBlocksController@store",
]);

Route::get("farmers/{farmer}/harvests", [
    "as" => "farmers.harvests.index",
    "uses" => "FarmerHarvestsController@index",
]);
Route::get("farmers/{farmer}/harvests/create", [
    "as" => "farmers.harvests.create",
    "uses" => "FarmerHarvestsController@create",
]);
Route::post("farmers/{farmer}/harvests", [
    "as" => "farmers.harvests.store",
    "uses" => "FarmerHarvestsController@store",
]);

Route::get("farmers/{farmer}/sales", [
    "as" => "farmers.sales.index",
    "uses" => "FarmerSalesController@index",
]);
Route::get("farmers/{farmer}/batches", [
    "as" => "farmers.batches.index",
    "uses" => "FarmerBatchesController@index",
]);
Route::get("farmers/{farmer}/settings", [
    "as" => "farmers.settings.index",
    "uses" => "FarmerSettingsController@index",
]);

Route::resource("farmers", "FarmersController");

Route::resource("purchases", "PurchasesController");
Route::resource("users", "UsersController");
Route::resource("roles", "RolesController");
Route::resource("products", "ProductsController");
Route::resource("blocks", "BlocksController");
Route::resource("batches", "BatchesController");
Route::resource("product_categories", "ProductCategoriesController");


