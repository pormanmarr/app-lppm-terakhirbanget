<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiModel extends Model
{
    use HasFactory;

    protected $table = 't_notifikasi'; 
    protected $keyType = 'string';
    public $incrementing = false;

    // 1. Sesuaikan Fillable dengan nama kolom di Database (url_target)
    protected $fillable = [
        'id',
        'user_id',
        'judul',
        'pesan',
        'tipe',
        'url_target', // <--- GANTI 'link' JADI INI
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // 2. Tambahkan ini agar Frontend yang minta 'link' tetap jalan
    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return $this->url_target;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}