<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Customer;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "order_id";

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
