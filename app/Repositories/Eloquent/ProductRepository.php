<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Container\Container as Application;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface 
{
    public function model()
    {
        return Product::class;
    }

    public function searchProductByName($name)
    {
        return $this->model->where('name', 'like', '%' . $name . '%');
    }

    public function getSimilarProduct(Product $product, $take)
    {
        return $this->model->where('category_id', $product->category_id)
            ->where('id', '<>', $product->id)
            ->orderBy('created_at', 'desc')->limit($take);
    }
}
