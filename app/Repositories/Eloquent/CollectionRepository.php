<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CollectionRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Collection;
use Lang;

class CollectionRepository extends BaseRepository implements CollectionRepositoryInterface
{
    public function model()
    {
        return Collection::class;
    }

    public function validate($data, $ruleName)
    {
        return $this->model->validate($data, $ruleName);
    }

    public function valid()
    {
        return $this->model->valid();
    }

    public function getProducts($id, $from, $to)
    {
        $collection = $this->model->find($id);
        if ($collection) {
            return $collection->products()
                ->whereBetween('price', [$from, $to])->get();
        }

        return null;
    }
}
