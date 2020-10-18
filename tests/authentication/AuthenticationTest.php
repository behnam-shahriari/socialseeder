<?php



class AuthenticationTest extends TestCase
{
    /**
    * @test
    */
    public function authentication_for_product_stock_management_routes() {
        $this->withoutExceptionHandling();
        $this->post($this->stockManagementUrl())->seeStatusCode(401);
        $this->put($this->stockManagementUrl())->seeStatusCode(401);
        $this->delete($this->stockManagementUrl().'/1')->seeStatusCode(401);
    }

    private function stockManagementUrl() {
        return 'api/v1/product';
    }
}
