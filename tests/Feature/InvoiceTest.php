<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
	
	public function testProducts()
    {
        $response = $this->get('/lara/icepick/api/products');
		
		$response->assertStatus(200);
		
		$this->assertEquals(15, count(json_decode($response->content()), true));
    }
	/*
	public function testInvoices()
    {
        $response = $this->get('/api/invoices');
		
		$response->assertStatus(200);
		
		$this->assertEquals(10, count(json_decode($response->content()), true));
    }
	
	public function testCreateInvoice()
    {
		
        $response = $this->json('POST', '/api/invoice', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
	
	public function testUpdateInvoice()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('PUT', '/api/invoice', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
	
	public function testCreatePurchaseLineItem()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/api/purchaselineitem', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
	
	public function testCreatePaymentLineItem()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/api/paymentlineitem', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
	
	public function testEditPurchaseLineItem()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/api/purchaselineitem', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
	
	public function testEditPaymentLineItem()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/api/paymentlineitem', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
	*/
}
