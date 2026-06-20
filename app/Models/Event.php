<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Event extends Model {
    use SoftDeletes;

    protected $table = 'event'; //nama tabel memakai huruf kecil
    protected $primaryKey = 'eventID'; //primary key diawali dengan nama tabelnya + ID dan bertipe data string 
    protected $keyType = 'string'; //tipe data primary key selalu string
    public $incrementing = false; //incrementing false karena primary key bertipe data string
    public $timestamps = false; //timestamps false karena tidak ada kolom created_at, updated_at dalam tabel event

    //atribut atau kolom yang ada pada tabel event
    protected $fillable = [ //atribut diawali huruf kecil pada kata pertama dan diawali huruf besar pada kata kedua dan selanjutnya (jika ada)
        'eventID',
        'name',
        'location',
        'entranceFee',
        'description',
        'startDate',
        'endDate',
        'startTime',
        'endTime',
        'imagePath',
        'socialMedia',
    ];

    //casting tipe data agar sesuai kebutuhan
    protected $casts = [
        'entranceFee' => 'integer',
        'deleted_at'  => 'datetime',
    ];

    // Accessor untuk memformat startDate dari UTC ke WIB lalu mengambil Y-m-d
    public function getStartDateAttribute($value)
    {
        if (!$value) return null;
        return Carbon::parse($value)->timezone('Asia/Jakarta')->format('Y-m-d');
    }

    // Accessor untuk memformat endDate dari UTC ke WIB lalu mengambil Y-m-d
    public function getEndDateAttribute($value)
    {
        if (!$value) return null;
        return Carbon::parse($value)->timezone('Asia/Jakarta')->format('Y-m-d');
    }
}