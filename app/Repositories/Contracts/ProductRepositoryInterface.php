<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;
use App\Models\Product;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function searchProductByName($name);

    public function getSimilarProduct(Product $product, $take);
}
