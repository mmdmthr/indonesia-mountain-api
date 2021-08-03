<?php

use App\Models\Mountain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/mountains', function (Request $request) {
  
 if ($request->name) {
    $mountains = Mountain::where(DB::raw('LOWER(name)'), 'like', '%'.$request->name.'%')->get();
  } else if ($request->province) {
    $mountains = Mountain::where(DB::raw('LOWER(province)'), 'like', '%'.$request->province.'%')->get();
  } else if ($request->island) {
    $mountains = Mountain::where(DB::raw('LOWER(island)'), 'like', '%'.$request->island.'%')->get();
  } else if ($request->maxElev || $request->minElev) {
    $max = $request->maxElev ?: 5000;
    $min = $request->minElev ?: 0;

    $mountains = Mountain::where('elevation', '<=', $max)->where('elevation', '>=', $min)->get();
  } else {
    $mountains = Mountain::all();
  }

  return json_encode($mountains);
});