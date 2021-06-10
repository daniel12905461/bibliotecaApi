<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    //
    /**
   * Login API
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request){
    // if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    if(Auth::attempt(['user' => $request->user, 'password' => $request->password])){
      $user = Auth::user();
      $success['token'] =  $user->createToken('LaraPassport')->accessToken;
      return response()->json([
        'status' => 'success',
        'data' => $success
      ]);
    } 
    else {
      return response()->json('Usuario o Contraseña incorrectos', 404);
    }
  }

  /**
   * Register API
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'user' => 'required',
      'rol_id' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'c_password' => 'required|same:password',
    ]);
    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()]);
    }
    $postArray = $request->all();
    $postArray['password'] = bcrypt($postArray['password']);
    $user = User::create($postArray);
    $success['token'] =  $user->createToken('LaraPassport')->accessToken;
    $success['name'] =  $user->name;
    return response()->json([
      'status' => 'success',
      'data' => $success,
    ]);
  }

  public function logout()
  {
    if (Auth::check()) {
        Auth::user()->AauthAcessToken()->delete();
    }
  }
}
