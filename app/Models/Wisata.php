<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Wisata extends Model
{
    use HasFactory;

    public $tables = 'wisatas';

    public $dates = [
        'created_at',
        'updated_at',
    ];

    public $fillable = [
        'uuid',
        'category_id',
        'name',
        'description',
        'alamat',
        'no_telp',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'longitude',
        'latitude',
        'harga',
        'jam_buka',
        'jam_tutup',
        'hari',
        'image',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeFilterByRequest($query, Request $request)
    {
        if($request->input('name') || $request->input('category_id'))
        {
            $query->where('name', $request->input('name'))->orWhere('category_id', $request->input('category_id'));
        }
        if($request->input('wisata'))
        {
            $query->where('name', 'LIKE', '%'.$request->input('wisata').'%');
        }
    }
}
