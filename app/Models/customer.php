<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = "customer";
    protected $primaryKey = "id_customer";
    public $timestamps = false;
    protected $fillable = [
        'id_kecamatan_customer',
        'nama_customer',
        'alamat_customer',
        'saldo_customer',
        'pin_customer',
        'no_hp_customer',
        
    ];
    public function transaksi()
    {
        return $this->hasMany(transaksi::class, "id_customer_transaksi","nik_customer");
    }
    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class, "id_kecamatan_customer","id_kecamatan");
    }
}
