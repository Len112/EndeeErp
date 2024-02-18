<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'client_id',
        'nama_item',
        'harga_item',
        'tanggal_order'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
