<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{

  public function create(Request $request)
  {
    $validation = Validator::make($request->all(), [
      'nama_kelas' => 'required|string',
      'jurusan' => 'required|string'
    ]);

    if ($validation->fails()) {
      $errors = $validation->errors();
      return [
        'status' => 'error',
        'message' => $errors,
        'result' => null
      ];
    }

    $result = \App\Kelas::create($request->all());
    if ($result) {
      return [
        'status' => 'success',
        'message' => 'Data Berhasil Ditambahkan',
        'result' => $result
      ];
    } else{
      return [
        'status' => 'error',
        'message' => 'Data Gagal Ditambahkan',
        'result' => null
      ];
    }
  }

  public function read(Request $request)
  {
    $result = \App\Kelas::all();
    return [
      'status' => 'success',
      'message' => '',
      'result' => $result
    ];
  }

  public function update(Request $request, $id)
  {
    $validation = Validator::make($request->all(), [
      'nama_kelas' => 'required|string',
      'jurusan' => 'required|string'
    ]);

    if ($validation->fails()) {
      $errors = $validation->errors();
      return [
        'status' => 'error',
        'message' => $errors,
        'result' => null
      ];
    }

    $siswa = \App\Kelas::find($id);
    if (empty($siswa)) {
      return [
        'status' => 'error',
        'message' => 'Data Tidak Ditemukan',
        'result' => null
      ];
    }

    $result = $siswa->update($request->all());
    if ($result) {
      return [
        'status' => 'success',
        'message' => 'Data Berhasil Diubah',
        'result' => $result
      ];
    } else{
      return [
        'status' => 'error',
        'message' => 'Data Gagal Diubah',
        'result' => null
      ];
    }
  }

  public function delete(Request $request, $id)
  {
    $siswa = \App\Kelas::find($id);
    if (empty($siswa)) {
      return [
        'status' => 'error',
        'message' => 'Data Tidak Ditemukan',
        'result' => null
      ];
    }

    $result = $siswa->delete($request->all());
    if ($result) {
      return [
        'status' => 'success',
        'message' => 'Data Berhasil Dihapus',
        'result' => $result
      ];
    } else{
      return [
        'status' => 'error',
        'message' => 'Data Gagal Dihapus',
        'result' => null
      ];
    }
  }
}
