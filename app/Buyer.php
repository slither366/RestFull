<?php

namespace App;
namespace App\Transaction;

use Illuminate\Database\Eloquent\Model;

class Buyer extends User
{
    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }
}
