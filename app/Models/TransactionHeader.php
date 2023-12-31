<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'location_id',
        'date',
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    public function electrics()
    {
        return $this->hasMany(ElectricTransactionDetail::class, 'transaction_id', 'id');
    }

    public function electric()
    {
        return $this->electrics->where('created_at', $this->created_at)->first();
    }
}
