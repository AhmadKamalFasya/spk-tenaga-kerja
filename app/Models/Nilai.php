<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
  use HasFactory;
  protected $table = 'Nilai';
  protected $primaryKey = 'id_daftar';
  public $incrementing = false;
  protected $keyType = 'string';
  protected $fillable = ['id_daftar', 'id_kriteria'];
}
