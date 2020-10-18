<?php


namespace App\Http\Controllers\Product;


use App\Http\Controllers\AppController;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends AppController
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|min:2|max:100',
            'price' => 'required|integer|min:0',
        ]);
        $product = $this->productService->create($request->input());
        return $this->success($product, '', [], 201);
    }

    public function get()
    {
        $products = $this->productService->get();
        return $this->success($products, '', [
            'count'=>sizeof($products)
        ], 200);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $updated = $this->productService->update($request->input(), $id);
        return $this->success($updated, '', [], 201);
    }

    public function delete($id)
    {
        return $this->productService->delete($id);
    }
}
