<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function purchase_line_items()
    {
        return $this->hasMany('App\PurchaseLineItems', 'invoice_id');
    }
	
	public function payment_line_items()
    {
        return $this->hasMany('App\PaymentLineItems', 'invoice_id');
    }
	
	public function store()
    {
        return $this->hasOne('App\Store', 'id', 'store_id');
    }
}
