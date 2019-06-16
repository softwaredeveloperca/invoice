<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseLineItems;

class PurchaseLineItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id=null)
    {
		$request->validate([
			'cost' => 'required',
			'invoice_id' => 'required',
			'product_id' => 'required',
			'tax_rate' => 'required',
			'amount' => 'required',
			'qty' => 'required',
		]);
		
		$id=$request['edit_id'];
		unset($request['edit_id']);
		
		$payment=PurchaseLineItems::updateOrCreate(
         ['id' => $id],
       	  $request->all()
		);
		return $payment->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		return PurchaseLineItems::where('invoice_id', $id)->get()->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
