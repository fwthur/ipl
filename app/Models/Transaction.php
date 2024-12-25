<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $tables = 'transactions';

    public $dates = [
        'created_at',
        'updated_at',
    ];

    public $fillable = [
        'uuid',
        'wisata_id',
        'pembeli_id',
        'jumlah_tiket',
        'tanggal',
        'jumlah_pembayaran',
        'metode_pembayaran',
        'status_pembayaran',
        'author_id',
        'kode_unik',
        'image',
        'created_at',
        'updated_at',
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id');
    }
    public function pembeli()
    {
        return $this->belongsTo(User::class, 'pembeli_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
