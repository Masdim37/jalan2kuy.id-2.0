<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBiasa extends Model {
    protected $table = 'user'; //nama tabel memakai huruf kecil
    protected $primaryKey = 'userID'; //primary key diawali dengan nama tabelnya + ID dan bertipe data string 
    protected $keyType = 'string'; //tipe data primary key selalu string
    public $incrementing = false; //incrementing false karena primary key bertipe data string
    public $timestamps = false; //timestamps false karena tidak ada kolom created_at, updated_at dalam tabel user

    protected $fillable = [ //atribut diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        'userID',
        'nameUser',
        'email',
        'phone',
        'gender',
        'birthDate',
        'username',
        'password',
    ];

    protected $casts = [
        'birthDate' => 'date',
        'gender'   => 'boolean',
    ];
}
