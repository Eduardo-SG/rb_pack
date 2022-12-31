<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = ["order_num", "user_id", "client_id", "part_id", 'process_id', 'due_date'];
    protected $hidden = ["id"];
}
