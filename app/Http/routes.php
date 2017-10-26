<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {

    return $app->welcome();
});


$app->get('/key', function() {
    return str_random(32);
});


$app->get('/payment', function() use ($app) {
    return view('payment');
});

$app->post('/payment/sucess', 'paymentController@userPaymentSuccess');

$app->post('/payment/failure', 'paymentController@userPaymentFail');

$app->post('/payment/cancel', 'paymentController@userPaymentCancel');

$app->post('/payment', 'paymentController@userPaymentDetails');

