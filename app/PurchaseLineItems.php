<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseLineItems extends Model
{
	public $guarded=['id'];
    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
