<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model{
    protected $table = 'payment'; //nama tabel memakai huruf kecil
    protected $primaryKey = 'paymentID'; //primary key diawali dengan nama tabelnya + ID dan bertipe data string 
    protected $keyType = 'string'; //tipe data primary key selalu string
    public $incrementing = false; //incrementing false karena primary key bertipe data string
    public $timestamps = false; //timestamps false karena tidak ada kolom created_at, updated_at dalam tabel user

    protected $fillable = [
        'paymentID',
        'paymentDate',
        'paymentStatus',
        'orderID',
    ];

    protected $casts = [
        'paymentDate' => 'date',
    ];
}
