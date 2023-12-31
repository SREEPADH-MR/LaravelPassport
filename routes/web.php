<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function (Request $request) {
    $credentials = [];
    $credentials['email'] = 'sree@gmail.com';
    $credentials['password'] = 'sree@gmail.com';

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        // dd(Auth::user());
        return redirect('/');
    }
})->name('login');

Route::get('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');


// Routes for 3rd party app

// Route::get('/redirect', function (Request $request) {
//     $request->session()->put('state', $state = Str::random(40));

//     $query = http_build_query([
//         'client_id' => '8',
//         'redirect_uri' => 'http://localhost:9000/callback',
//         'response_type' => 'code',
//         'scope' => '',
//         'state' => $state,
//         'prompt' => 'consent', // "none", "consent", or "login"
//     ]);

//     return redirect('http://localhost:8000/oauth/authorize?' . $query);
// });

// Route::get('/callback', function (Request $request) {
//     $state = $request->session()->pull('state');

//     throw_unless(
//         strlen($state) > 0 && $state === $request->state,
//         InvalidArgumentException::class,
//         'Invalid state value.'
//     );

//     $response = Http::asForm()->post('http://localhost:8000/oauth/token', [
//         'grant_type' => 'authorization_code',
//         'client_id' => '8',
//         'client_secret' => 'HyQAuOUpnFSQl7sBMS4qJTNY5VQ6ikgVYZsvVAeS',
//         'redirect_uri' => 'http://localhost:9000/callback',
//         'code' => $request->code,
//     ]);

//     // dd($response->json());

//     return $response->json();
// });