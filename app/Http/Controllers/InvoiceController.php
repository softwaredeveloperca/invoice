<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::paginate();
    	return $invoices;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
		$request->validate([
			'title' => 'bail|required|unique:posts|max:255',
			'body' => 'required',
		]);
        Invoice::create($request->all());
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
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'address' => 'required|max:255',
			'address2' => 'required|max:255',
			'city' => 'required|max:255',
			'state' => 'required|max:255',
			'zip_code' => 'required|max:10',
			'date_due' => 'required|date',
			'date_issued' => 'required|date',
		]);
		
		$id=$request['edit_id'];
		unset($request['edit_id']);
		
		$invoice=Invoice::updateOrCreate(
         ['id' => $id],
       	  $request->all()
		);
		return $invoice->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
        return Invoice::where('id', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($request)
    {
        $request->validate([
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'address' => 'required|max:255',
			'address2' => 'required|max:255',
			'city' => 'required|max:255',
			'state' => 'required|max:255',
			'zip_code' => 'required|max:10',
			'date_due' => 'required|date',
			'date_issued' => 'required|date',
		]);
		
		$invoice=Invoice::firstOrCreate(
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
		return Invoice::destroy($id);
    }
	
}
