<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    protected $fillable = ['nama', 'tempat_tgl_lahir', 'alamat', 'jenis_kelamin', 'no_hp', 'pendidikan', 'no_ktp'];
}
