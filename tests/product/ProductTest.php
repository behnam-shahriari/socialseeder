<?php

use App\Models\Actor;
use App\Models\Product;

class ProductTest extends TestCase
{
    // Adding, updating, listing and deleting products
    // Adding, updating, listing and deleting products

    /**
     * @test
     */
    public function it_can_add_product()
    {
        $product = Product::factory()->raw();
        $this->actingAs($this->user())->post($this->url(), $product)->seeStatusCode(201);
        $this->seeInDatabase('products', ['title' => $product['title']]);
    }

    /**
     * @test
     */
    public function it_must_have_valid_title()
    {
        $product = Product::factory(['title' => ''])->raw();
        $this->actingAs($this->user())->post($this->url(), $product)->seeStatusCode(422);
        $this->notSeeInDatabase('products', ['title' => $product['title']]);
    }

    /**
     * @test
     */
    public function it_must_have_valid_price()
    {
        $product = Product::factory(['price' => -100])->raw();
        $this->actingAs($this->user())->post($this->url(), $product)->seeStatusCode(422);
    }


    /**
     * @test
     */
    public function it_can_update_product()
    {
        $this->withoutExceptionHandling();
        $product = Product::factory(['id'=>1])->create()->toArray();
        $product['title'] = 'newTitle';
        $this->actingAs($this->user())->put($this->url(), $product)->seeStatusCode(201);
        $this->seeInDatabase('products', [
            'id'=>1,
            'title'=>'newTitle'
        ]);
    }

    /**
     * @test
     */
    public function it_can_list_products()
    {
        Product::factory()->count(50)->create();
        $response = $this->get($this->url())->seeStatusCode(200);
        $content = $this->getContent($response);
        $this->assertNotEmpty($content->data);
        $this->assertSame(50, $content->extra->count);
    }

    /**
     * @test
     */
    public function it_can_delete_product()
    {
        $product = Product::factory()->create();
        $this->actingAs($this->user())->delete($this->url().'/'.$product->id)->seeStatusCode(200);
        $this->notSeeInDatabase('products', ['id'=> 1]);
    }


    /**
    * @test
    */
    public function it_can_add_one_product_to_store() {
        $product = Product::factory()->create(['availability'=>2]);
        $product->addToStore(5);
        $this->seeInDatabase('products', [
            'id'=>$product->id,
            'availability'=>5+2
        ]);
    }

    /**
     * @test
     */
    public function it_can_deduct_one_product_from_store() {
        $product = Product::factory()->create(['availability'=>5]);
        $product->removeFromStore(2);
        $this->seeInDatabase('products', [
            'id'=>$product->id,
            'availability'=>5-2
        ]);
    }

    /**
    * @test
    */
    public function it_can_not_take_more_than_availability() {
        $this->expectException(Exception::class);
        $product = Product::factory()->create(['availability'=>5]);
        $product->removeFromStore(6);
    }




    public function user(): Actor
    {
        return Actor::factory(['permission' => 'user'])->create();
    }

    private function url()
    {
        return 'api/v1/product';
    }
}
