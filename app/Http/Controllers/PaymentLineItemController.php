<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentLineItems;

class PaymentLineItemController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		return PaymentLineItems::where('invoice_id', $id)->get()->toArray();
	}
		
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
			'amount' => 'required',
			'invoice_id' => 'required',
			'payment_type' => 'required|max:255',
		]);
		
		$id=$request['edit_id'];
		unset($request['edit_id']);
		
		$invoice=PaymentLineItems::updateOrCreate(
         ['id' => $id],
       	  $request->all()
		);
		return $invoice->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return PaymentLineItems::destroy($id);
    }
}
