<?php


namespace App\Services\Product;


use App\Models\Product;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class ProductService
{
    public function create(array $product):?Product
    {
        return Product::create($product);
    }

    public function get()
    {
        return Product::all();
    }

    public function update(array $product,int $id):?Product
    {
        $oldProduct = Product::find($id);
        $oldProduct->title = $product['title'];
        $oldProduct->description = $product['description'];
        $oldProduct->price = $product['price'];
        $oldProduct->availability = $product['availability'];
        $oldProduct->enable = $product['enable'];
        $oldProduct->save();

        return $oldProduct->fresh();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        return $product->delete();
    }
}
