<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFees extends Model
{
    public function get_service_name()
    {
        return $this->hasOne(TransactionType::class, 'type_id', 'transaction_type');
    }
    use HasFactory;
}
