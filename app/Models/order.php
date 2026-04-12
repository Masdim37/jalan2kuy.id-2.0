<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model {
    protected $table = 'order'; //nama tabel memakai huruf kecil
    protected $primaryKey = 'orderID'; //primary key diawali dengan nama tabelnya + ID dan bertipe data string 
    protected $keyType = 'string'; //tipe data primary key selalu string
    public $incrementing = false; //incrementing false karena primary key bertipe data string
    public $timestamps = false; //timestamps false karena tidak ada kolom created_at, updated_at dalam tabel user

    protected $fillable = [
        'orderID',
        'orderDate',
        'userID',
        'totalPrice',
    ];

    protected $casts = [
        'orderDate' => 'date',
    ];
}
