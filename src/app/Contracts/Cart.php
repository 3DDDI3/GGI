<?php

namespace App\Contracts;

use App\Models\Catalog\CatalogProducts;

interface Cart
{
    public function add($id);
    public function update($id, $value);
    public function delete($id);
    public function setQuantity(CatalogProducts &$product);
}
