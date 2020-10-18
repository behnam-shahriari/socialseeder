<?php

use App\Models\Actor;
use App\Models\Product;
use App\Models\Purchase;

class PurchaseTest extends TestCase
{


    /**
     * @test
     */
    public function it_can_list_all_purchases()
    {
        $this->withoutExceptionHandling();
        Purchase::factory()->count(50)->create();
        $response = $this->get($this->url())->seeStatusCode(200);
        $content = $this->getContent($response);
        $this->assertNotEmpty($content->data);
        $this->assertSame(50, $content->extra->count);
    }

    /**
    * @test
    */
    public function it_can_accept_requests_for_the_pending_products() {
        $purchase = Purchase::factory()->create(['status'=>'pending']);
        $purchase->acceptIt();
        $this->seeInDatabase('purchases', [
            'id'=>$purchase->id,
            'status'=>'accepted'
        ]);

        $wrongPurchase = Purchase::factory()->create(['status'=>'cancelled']);
        $wrongPurchase->acceptIt();
        $this->seeInDatabase('purchases', [
            'id'=>$wrongPurchase->id,
            'status'=>'cancelled'
        ]);
    }

    /**
    * @test
    */
    public function it_is_accepted_if_the_stock_is_available_for_all_requested_products() {
        $product = Product::factory()->create([
            'availability' => 5
        ]);
        $this->post($this->url(), [
            'product_id'=>$product->id,
            'quantity'=>6
        ])->seeStatusCode(406);
    }

    public function user(): Actor
    {
        return Actor::factory(['permission' => 'user'])->create();

    }

    private function url()
    {
        return 'api/v1/purchase';
    }
}
