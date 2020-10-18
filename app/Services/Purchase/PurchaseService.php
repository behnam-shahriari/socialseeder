<?php


namespace App\Services\Purchase;


use App\Models\Purchase;

class PurchaseService
{

    public function get()
    {
        return Purchase::all();
    }
}
