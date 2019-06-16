<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	public $guarded = ['id'];
    public function purchase_line_items()
    {
        return $this->hasMany('App\PurchaseLineItems', 'invoice_id');
    }
	
	public function payment_line_items()
    {
        return $this->hasMany('App\PaymentLineItems', 'invoice_id');
    }
	
}
