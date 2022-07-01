<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
  public function __invoke(Request $request)
  {
    // try {
    // $validator = Validator::make($request->all(), [
    // 'name' => 'required|string|max:255',
    // 'email' => 'required|email|unique:users,email',
    // 'password' => 'required|min:6|confirmed'
    // ]);

    // if ($validator->fails()) {
    // return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    // }

    // $request['password'] = Hash::make($request['password']);

    // $user = User::create($request->except('password_confirmed'));

    // return response()->json([
    // 'message' => 'Data user berhasil dibuat',
    // 'data' => $user
    // ],  Response::HTTP_CREATED);
    // } catch (\Exception $e) {
    // return response()->json([
    // 'message' => $e->getMessage()
    // ], Response::HTTP_INTERNAL_SERVER_ERROR);
    // }

    $validator = Validator::make($request->all(), [
      'name' => ['required', 'string', 'max:255'],
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|confirmed'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    try {
      $request['password'] = Hash::make($request['password']);
      $user = User::create($request->except('password_confirmed'));
      $response = [
        "message" => "Data user telah berhasil dibuat.",
        "data" => $user,
      ];

      return response()->json($response, Response::HTTP_CREATED);
    } catch (QueryException $e) {
      return response()->json([
        'message' => 'Failed ' . $e->errorInfo
      ]);
    }
  }
}
