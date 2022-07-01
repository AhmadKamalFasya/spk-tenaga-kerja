<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Passport\HasApiTokens;


class loginController extends Controller
{
  use HasApiTokens;

  public function __construct()
  {
    $this->middleware('auth:sanctum')->only('logout');
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    try {
      $user = User::where('email', $request->email)->first();
      if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
          'message' => 'email atau password yang anda masukan tidak sesuai.'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
      }
      return response()->json([
        'data' => [
          'user' => $user,
          'access_token' => $user->createToken($request->email)->plainTextToken
        ],
        'message' => 'login berhasil'
      ], Response::HTTP_OK);
    } catch (QueryException $e) {
      return response()->json([
        'message' => 'Failed ' . $e->errorInfo
      ]);
    }
  }

  public function logout(Request $request)
  {
    try {
      $request->user()->currentAccessToken()->delete();

      return response()->json([
        'message' => 'all token has been revoked from this user'
      ], Response::HTTP_OK);
    } catch (\Exception $e) {
      return response()->json([
        'message' => $e->getMessage()
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
