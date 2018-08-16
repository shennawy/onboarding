<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    //
    protected $fillable = [
        'CurrencyId', 'BankName', 'BankLocation', 'SwiftCode', 'user_id', 'HolderName', 'AccountNumber'
    ];

    public function User() {
        return $this->belongsTo('User');
    }

   
}
