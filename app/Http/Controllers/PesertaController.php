<?php

namespace App\Http\Controllers;

use App\Models\Peserta;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class PesertaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $peserta = Peserta::orderBy('nama', 'DESC')->get();

    $response = [
      'message' => 'Daftar Peserta',
      'data' => $peserta
    ];

    return response()->json($response, Response::HTTP_OK);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      "nama" => ['required'],
      "tempat_tgl_lahir" => ['required'],
      'alamat' => ['required'],
      'jenis_kelamin' => ['required'],
      'no_hp' => ['required'],
      'pendidikan' => ['required'],
      'no_ktp' => ['required']
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    try {
      $peserta = Peserta::create($request->all());
      $response = [
        'message' => 'Peserta Created',
        'data' => $peserta
      ];
      return response()->json($response, Response::HTTP_CREATED);
    } catch (QueryException $e) {
      return response()->json([
        'message' => 'Failed ' . $e->errorInfo
      ]);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $peserta = Peserta::findOrFail($id);

    $response = [
      'message' => 'Detail Peserta',
      'peserta' => $peserta
    ];

    return response()->json($response, Response::HTTP_OK);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $peserta = Peserta::findOrFail($id);
    $validator = Validator::make($request->all(), [
      'nama' => ['required'],
      'tempat_tgl_lahir' => ['required'],
      'alamat' => ['required'],
      'jenis_kelamin' => ['required'],
      'no_hp' => ['required'],
      'pendidikan' => ['required'],
      'no_ktp' => ['required']
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    try {
      $peserta->update($request->all());
      $response = [
        'message' => 'Peserta berhasil diupdate',
        'data' => $peserta
      ];
      return response()->json($response, Response::HTTP_OK);
    } catch (QueryException $e) {
      return response()->json([
        'message' => 'Failed ' . $e->errorInfo
      ]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $peserta = Peserta::findOrFail($id);
    try {
      $peserta->delete();
      $response = [
        'message' => 'Data berhasil dihapus.'
      ];
      return response()->json($response, Response::HTTP_OK);
    } catch (QueryException $e) {
      return response()->json([
        'message' => 'Failed ' . $e->errorInfo
      ]);
    }
  }
}
