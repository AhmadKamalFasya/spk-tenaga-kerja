<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class KriteriaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $kriteria = Kriteria::orderBy('id_peserta', 'DESC')->get();

    $response = [
      'message' => 'Daftar Kriteria',
      'data' => $kriteria
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
      'id_kriteria' => ['required'],
      'id_peserta' => ['required'],
      'kriteria' => ['required'],
      'nilai' => ['required'],
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    try {
      $kriteria = Kriteria::create([
        'id_kriteria' => $request->id_kriteria,
        'id_peserta' => $request->id_peserta,
        'kriteria' => $request->kriteria,
        'nilai' => $request->nilai
      ]);
      $response = [
        'message' => 'Kriteria Created',
        'data' => $kriteria
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
   * @param  int  $id_kriteria
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $peserta = Kriteria::where('id_kriteria', $id)->get();
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
    $kriteria = Kriteria::findOrFail($id);
    $validator = Validator::make($request->all(), [
      'id_kriteria' => ['required'],
      'id_peserta' => ['required'],
      'kriteria' => ['required'],
      'nilai' => ['required'],
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    try {
      $kriteria->update($request->all());
      $response = [
        'message' => 'Kriteria berhasil diupdate',
        'data' => $kriteria
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
    $kriteria = Kriteria::findOrFail($id);
    try {
      $kriteria->delete();
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
