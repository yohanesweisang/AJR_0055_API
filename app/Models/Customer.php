<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $guarded = ['id_customer'];

    public function detail_jadwal()
    {
        return $this->hasMany(Detail_jadwal::class);
    }
}
