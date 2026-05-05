<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tiket extends Model {
    protected $table = 'tiket';
    protected $primaryKey = 'tiketID'; 
    protected $keyType = 'string'; 
    public $incrementing = false; 
    public $timestamps = false; 

    protected $fillable = [
        'tiketID',
        'price',
        'tiketStatus',
        'eventID',
        'orderID',
    ];

    protected $casts = [
        'tiketStatus' => 'boolean',
    ];

    // Relasi ke tabel Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'eventID', 'eventID');
    }

    // Relasi ke tabel order
    public function order()
    {
        return $this->belongsTo(order::class, 'orderID', 'orderID');
    }
}