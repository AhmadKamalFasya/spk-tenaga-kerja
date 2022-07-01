<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $table = 'peserta';
    protected $fillable = ['nama', 'email', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'pendidikan_terakhir', 'agama', 'status_perkawinan', 'tanggungan', 'alamat', 'mulai_bekerja', 'nomor', 'divisi'];
}
