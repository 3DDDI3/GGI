<?php

namespace App\Contracts;

use App\Models\Catalog\CatalogProducts;

interface Catalog
{
    public function getObject($param, $url);
    public function getProductsList($object, $skip);
    public function getCategoriesList();
    public function getCartList($cart);
    public function getQualitiesTypesList();
}
