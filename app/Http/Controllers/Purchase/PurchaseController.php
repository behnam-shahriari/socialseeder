<?php


namespace App\Http\Controllers\Purchase;


use App\Http\Controllers\AppController;
use App\Models\Product;
use App\Services\Purchase\PurchaseService;
use Illuminate\Http\Request;

class PurchaseController extends AppController
{


    /**
     * @var PurchaseService
     */
    private $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {

        $this->purchaseService = $purchaseService;
    }


    public function get()
    {
        $purchase = $this->purchaseService->get();
        return $this->success($purchase, '', [
            'count' => sizeof($purchase)
        ], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:100'
        ]);
        $product = Product::find($request['product_id']);
        if (!$product->availableFor($request['quantity'])) {
            return $this->error('Not enough product', 406);
        }
        return [];
    }
}
