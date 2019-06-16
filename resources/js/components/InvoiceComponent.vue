<template>
    <div class="container">
        <div class="row justify-content-center">
			<div class="col-md-4">
                <div class="card">
                    <div class="card-header">Actions</div>

                    <div class="card-body">
                        <button type="button" v-if="stage === 'list'"  v-on:click="createInvoice()" class="btn btn-primary">Create Invoice</button>
						<button type="button" v-on:click="showInvoices()" class="btn btn-primary">Show Invoices</button>				
						<hr>
						<form class="form-inline">
						<input class="form-control mr-sm-2" type="search" v-model="search_term" placeholder="Search by Invoice ID" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" v-on:click="searchInvoice()" type="button">Search</button>
					  </form>
                    </div>
                </div>
				
				
            </div>
            <div class="col-md-8">
				<div v-if="error_msg !== ''" class="alert alert-danger" role="alert">
				  {{error_msg}}
				</div>
                <div v-if="stage === 'list'" class="card">
                    <div class="card-header">Invoices</div>

                    <div class="card-body">
                        <table class="table table-striped">
						<thead>
						  <tr>
							<th>ID</th>
							<th>Name</th>
							<th>City</th>
							<th>Date Issued</th>
							<th>Date Due</th>
							<th></th>
						  </tr>
						</thead>
						<tbody>
	
						  <tr v-for="invoice in invoices.data" v-if="invoice !== null">
						  	<td>{{invoice.invoice_num}}</td>
							<td>{{invoice.first_name}} {{invoice.last_name}}</td>
							<td>{{invoice.city}}</td>
							<td>{{invoice.date_issued}}</td>
							<td>{{invoice.date_due}}</td>
							<td>
								<div class="btn-group" role="group" aria-label="">
								  <button type="button" v-on:click="editInvoice(invoice.id)" class="btn btn-primary">Edit</button>
								  <button type="button" v-on:click="deleteInvoice(invoice.id)" class="btn btn-danger">Delete</button>
								</div>
							</td>
						  </tr> 
						</tbody>
					  </table>
					 
                    </div>
                </div>
				
				<div v-if="stage === 'create'" class="card">
                    <div class="card-header">Create</div>

                    <div class="card-body">
                       <form>
						  <div class="form-row">
							<div class="col">
							  <label for="inputFirstName">First Name</label>
							  <input type="text" id="inputFirstDate" v-model="new_invoice.first_name" class="form-control" placeholder="First name">
							</div>
							<div class="col">
							  <label for="inputLastName">Last Name</label>
							  <input type="text" v-model="new_invoice.last_name" class="form-control" placeholder="Last name">
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputAddress">Address</label>
							<input type="text" v-model="new_invoice.address" class="form-control" id="inputAddress" placeholder="1234 Main St">
						  </div>
						  <div class="form-group">
							<label for="inputAddress2">Address 2</label>
							<input type="text" v-model="new_invoice.address2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
						  </div>
						  <div class="form-row">
							<div class="form-group col-md-6">
							  <label for="inputCity">City</label>
							  <input v-model="new_invoice.city" type="text" class="form-control" id="inputCity">
							</div>
							<div class="form-group col-md-4">
							  <label for="inputState">State</label>
							  <select id="inputState" v-model="new_invoice.state" class="form-control">
								<option value="CA" selected>CA</option>
							  </select>
							</div>
							<div class="form-group col-md-2">
							  <label for="inputZip">Zip</label>
							  <input type="text" v-model="new_invoice.zip_code" class="form-control" id="inputZip">
							</div>
						  </div>
						  <div class="form-row">
							<div class="form-group col-md-4">
							  <label for="inputInvoiceID">InvoiceID</label>
							  <input v-model="new_invoice.invoice_num" type="text" class="form-control" id="inputInvoiceID">
							</div>
							<div class="form-group col-md-4">
							  <label for="inputInvoiceDate">Invoice Date</label>
							  <input v-model="new_invoice.date_issued" type="date" class="form-control" id="inputInvoiceDate">
							</div>
							<div class="form-group col-md-4">
							  <label for="inputInvoiceDueDate">Due Date</label>
							  <input v-model="new_invoice.date_due" type="date" class="form-control" id="inputInvoiceDueDate">
							</div>
						  </div>
						  <div class="form-row">
							  <div class="form-group col-md-12">
								<label for="inputInvoiceNote">Note</label>
								<textarea class="form-control" v-model="new_invoice.note" id="inputInvoiceNote" rows="3"></textarea>
							  </div>
						  </div>
						  <button type="button" v-if="edit_invoice_id === null" v-on:click="saveInvoice()" class="btn btn-primary">Save</button>
						  <button type="button" v-if="edit_invoice_id !== null" v-on:click="updateInvoice()" class="btn btn-primary">Update</button>
						  <button type="button" v-if="edit_invoice_id !== null" v-on:click="loadLineItems()" class="btn btn-primary">Edit LineItems</button>
						</form>
                    </div>
                </div>
				
				<div v-if="stage === 'create2'" class="card">
                    <div class="card-header">Create Payment / Purchase LineItems</div>
					
                  
					
					<br>
				
					 <button type="submit" v-if="edit_invoice_id" v-on:click="addPurchaseLineItems = true" class="btn btn-primary">Create Purchase LineItem</button><div class="card-header">Purchase LineItems</div>
				<br>
						<div v-if="addPurchaseLineItems"> 
                      
					   <div class="form-row p-2">
					   	<div class="form-group col-md-6">
							  <label for="inputProduct">Product</label>
							  <select id="inputProduct" class="form-control" v-model="selectedProduct">
							    <option value="">Select a Product</option>
								 
								<option v-for="product in products" v-on:click="selectProduct(product)" v-bind:value="product.id">{{product.name}} ({{product.cost}})</option>
								
							  </select>
							</div>
					    </div>
					   	<div class="form-row p-2">
							
							
							<div class="form-group col-md-3">
							  <label for="inputQty">Qty</label>
							  <input v-model="new_purchase_lineitems.qty" type="text" class="form-control" id="inputQty">
							</div>
							<div class="form-group col-md-3">
							  <label for="inputPrice">Price</label>
							  <input v-model="new_purchase_lineitems.cost" type="text" class="form-control" id="inputPrice">
							</div>
							<div class="form-group col-md-3">
							  <label for="inputTax">Tax</label>
							  <input v-model="new_purchase_lineitems.tax_rate" type="text" class="form-control" id="inputTax">
							</div>
							<div class="form-group col-md-3">
							<label for="inputAddPurchaseLineItem">Add</label>
							  <button v-on:click="addPurchaseLineItem()" type="submit" id="inputAddPurchaseLineItem" v-if="edit_invoice_id"  class="btn btn-primary btn-sm form-control">Add</button>
							</div>
						  </div>
						  
						  
					
						</div>
						
						
				
                    <div class="card-body">
                        <table class="table table-striped">
						<thead>
						  <tr>
							<th>Product</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Tax</th>
							<th>Amount</th>
							<th> </th>
						  </tr>
						</thead>
						<tbody>
						  <tr v-for="purchase in purchase_lineitems" v-if="purchase !== null">
							<td>{{purchase.product.name}}</td>
							<td>{{purchase.cost}}</td>
							<td>{{purchase.qty}}</td>
							<td>{{purchase.tax_rate}}</td>
							<td>{{purchase.amount}}</td>
							<td>
								<div class="btn-group" role="group" aria-label="">
								  <button type="button" v-on:click="deletePurchaseLineItem(purchase.id)" class="btn btn-danger">Delete</button>
								</div>
							</td>
						  </tr>			  
						</tbody>
					  </table>
                    </div>
					<button type="submit" v-if="edit_invoice_id" v-on:click="addPaymentLineItems = true" class="btn btn-sm btn-primary">Create Payment LineItem</button>
					
					<div v-if="addPaymentLineItems"> 
                      
					 
					   	<div class="form-row p-2">
							
							
							<div class="form-group col-md-4">
							  <label for="inputAmount">Amount</label>
							  <input v-model="new_payment_lineitems.amount" type="text" class="form-control" id="inputAmount">
							</div>
							<div class="form-group col-md-4">
							  <label for="inputPaymentType">Payment Type</label>
							  <select id="inputPaymentType" v-model="new_payment_lineitems.payment_type" class="form-control">
								<option value="Cash">Cash</option>
								<option value="Cheque">Cheque</option>
								<option value="Credit">Credit</option>
							  </select>
							</div>
							<div class="form-group col-md-3">
							<label for="inputAddPaymentLineItem">Add</label>
							  <button v-on:click="addPaymentLineItem()" type="submit" id="inputAddPaymentLineItem" v-if="edit_invoice_id"  class="btn btn-primary form-control">Add</button>
							</div>
						  </div>
						  
						  
					
						</div>
					
					
					
					<div class="card-body">
                        <table class="table table-striped">
						<thead>
						  <tr>
							<th>ID</th>
							<th>Amount</th>
							<th>Payment Type</th>
						  </tr>
						</thead>
						<tbody>
						  <tr v-for="payment in payment_lineitems" v-if="payment !== null">
							<td>{{payment.id}}</td>
							<td>{{payment.amount}}</td>
							<td>{{payment.payment_type}}</td>
							<td>
								<div class="btn-group" role="group" aria-label="">
								  <button type="button" v-on:click="deletePaymentLineItem(payment.id)" class="btn btn-danger">Delete</button>
								</div>
							</td>
						  </tr>			  
						</tbody>
					  </table>
                    </div>
                    </div>
					
					
                </div>
				
						
           
				</div>
				
            
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
			this.showInvoices();
			let that=this;
			axios.get('/lara/icepick/public/api/products')
                    .then(res => {
                    console.log(res.data);
					that.products=res.data;
                }).catch(err => {
                console.log(err)
            })
		
        },
		methods: {
			selectProduct: function (product) {
				this.new_purchase_lineitems.cost=product.cost;
				this.new_purchase_lineitems.qty=1; 
				this.new_purchase_lineitems.tax_rate=.13; 
				this.new_purchase_lineitems.product_id=product.id; 
			},
			searchInvoice: function() {
				this.stage = 'list';
				let that=this;
				this.error_msg='';
				if(this.search_term.length > 1)
				{
					axios.post('/lara/icepick/public/api/search', {'term': encodeURIComponent(this.search_term)})
							.then(res => {
							that.invoices=res.data;
						}).catch(err => {
						that.error_msg=err;
					});
				} 
				else 
				{
				   that.error_msg="Search term must be at least 2 characters long";
				}
			}, 
			loadLineItems: function () {
			   this.stage = 'create2';
			   this.loadPurchaseLineItem();
			}, 
			addPurchaseLineItem: function () {	
			    
				let that=this;
				this.new_purchase_lineitems.invoice_id=this.edit_invoice_id;
				this.new_purchase_lineitems.amount=parseFloat(this.new_purchase_lineitems.cost) * parseInt(this.new_purchase_lineitems.qty);  
				this.new_purchase_lineitems.amount=this.new_purchase_lineitems.amount + (parseFloat(this.new_purchase_lineitems.tax_rate * this.new_purchase_lineitems.amount));
							
				axios.post('/lara/icepick/public/api/purchase_lineitems', this.new_purchase_lineitems)
                    .then(res => {
					that.addPurchaseLineItems=false;
                    that.new_purchase_lineitems.qty=1; 
					that.new_purchase_lineitems.cost='';
					that.new_purchase_lineitems.tax_rate='.13';
					that.new_purchase_lineitems.product_id=null;
					that.new_purchase_lineitems.amount=null;
					this.loadPurchaseLineItem();
                }).catch(err => {
               	that.error_msg=err;
           	 });
			  
				
			}, 
			addPaymentLineItem: function () {	
			    
				let that=this;
				this.new_payment_lineitems.invoice_id=this.edit_invoice_id;
							
				axios.post('/lara/icepick/public/api/payment_lineitems', this.new_payment_lineitems)
                    .then(res => {
					that.addPurchaseLineItems=false;
                    that.new_payment_lineitems.amount=''; 
					that.new_payment_lineitems.payment_type='';
					this.loadPurchaseLineItem();
                }).catch(err => {
               	that.error_msg=err;
           	 });
			  
				
			}, 
			showInvoices: function () {
				this.stage = 'list';
				let that=this;
				this.error_msg='';
				this.search_term='';
				axios.get('/lara/icepick/public/api/invoice')
						.then(res => {
						that.invoices=res.data;
					}).catch(err => {
					console.log(err)
					that.error_msg=err;
            	});
				
			},  
			createInvoice: function () {
				this.stage = 'create';
				this.error_msg='';
				this.edit_invoice_id=null;
				this.new_invoice = {
					 invoice_num: null,
					 first_name: null,
					 last_name: null,
					 address: null,
					 address2: null,
					 city: null,
					 state: null, 
					 zip_code: null, 
					 note: null, 
					 date_due: null, 
					 date_issued: null,				
				  }
			}, 
			editInvoice: function (id) {
				this.stage = 'create';
				this.error_msg='';
				this.edit_invoice_id=id;
				let that=this;
				
				axios.get('/lara/icepick/public/api/invoice/' + id)
						.then(res => {
						console.log(res.data);
						that.new_invoice=res.data;
					}).catch(err => {
					console.log(err)
					that.error_msg=err;
            	});
				
			}, 
			deleteInvoice: function (id) {
				let that=this;
				that.error_msg='';
				if(confirm("Do you really want to delete?")){
			
							axios.delete('/lara/icepick/public/api/invoice/' + id)
							.then(resp => {
								that.showInvoices();
							})
							.catch(error => {
								that.error_msg=error;
							});
			   }
			},
			deletePurchaseLineItem: function (id) {
				let that=this;
				that.error_msg='';
				if(confirm("Do you really want to delete?")){
			
							axios.delete('/lara/icepick/public/api/purchase_lineitems/' + id)
							.then(resp => {
								this.loadPurchaseLineItem();
							})
							.catch(error => {
								that.error_msg=error;
							});
			   }
			},
			deletePaymentLineItem: function (id) {
				let that=this;
				that.error_msg='';
				if(confirm("Do you really want to delete?")){
			
							axios.delete('/lara/icepick/public/api/payment_lineitems/' + id)
							.then(resp => {
								this.loadPaymentLineItem();
							})
							.catch(error => {
								that.error_msg=error;
							});
			   }
			}, 
			updateInvoice: function (event) {
				let that = this;

				this.new_invoice.edit_id=this.edit_invoice_id;
			    axios.post('/lara/icepick/public/api/invoice', this.new_invoice)
                .then(function (response) {
				   that.edit_invoice_id=response.data;
				   that.stage='create2';
				   that.new_invoice = {
					 invoice_num: null,
					 first_name: null,
					 last_name: null,
					 address: null,
					 address2: null,
					 city: null,
					 state: null, 
					 zip_code: null, 
					 note: null, 
					 date_due: null, 
					 date_issued: null,
					
				  }
				  that.error_msg='';
				  this.loadPurchaseLineItem();
                })
                .catch(function (error) {
					that.error_msg=error;
					 console.log(error);
                });
				
				
			},
			saveInvoice: function (event) {
				let that = this;
			    axios.post('/lara/icepick/public/api/invoice', this.new_invoice)
                .then(function (response) {
				   that.edit_invoice_id=response.data;
				   that.stage='create2';
				   that.new_invoice = {
					 invoice_num: null,
					 first_name: null,
					 last_name: null,
					 address: null,
					 address2: null,
					 city: null,
					 state: null, 
					 zip_code: null, 
					 note: null, 
					 date_due: null, 
					 date_issued: null,
				  }
				  that.error_msg='';
				  this.loadPurchaseLineItem();
                })
                .catch(function (error) {
					that.error_msg=error;
					 console.log(error);
                });
				
				
			}, 
			loadPurchaseLineItem: function () {
			    let that=this;
				this.loadPaymentLineItem();
			    axios.get('/lara/icepick/public/api/purchase_lineitems/' + this.edit_invoice_id)
						.then(res => {
						console.log(res.data);
						that.purchase_lineitems=res.data;
					}).catch(error => {
					that.error_msg=error;
				})
			},
			loadPaymentLineItem: function () {
			    let that=this;
			    axios.get('/lara/icepick/public/api/payment_lineitems/' + this.edit_invoice_id)
						.then(res => {
						console.log(res.data);
						that.payment_lineitems=res.data;
					}).catch(error => {
					that.error_msg=error;
				})
			}
		},
		data: function () {
			return {
			  stage: 'list', 
			  products: [],
			  invoices: [], 
			  error_msg: '', 
			  payment_lineitems: [],
			  purchase_lineitems: [], 
			  addPurchaseLineItems: false, 
			  addPaymentLineItems: false, 
			  selectedProduct: false,
			  edit_invoice_id: null, 
			  search_term: null, 
			  new_purchase_lineitems: {
			    'product_id': null, 
			    'qty': null, 
				'cost': null, 
				'tax_rate': null,
				'amount': null,
				'invoice_id': null
			  }, 
			  new_payment_lineitems: {
			    'amount': null, 
				'payment_type': null, 
				'invoice_id': null
			  }, 							
			  new_invoice: {
			     invoice_num: null,
			     first_name: null,
				 last_name: null,
				 address: null,
				 address2: null,
				 city: null,
				 state: null, 
				 zip_code: null, 
				 note: null, 
				 date_due: null, 
				 date_issued: null, 
			  }
			}
		}
    }
</script>
