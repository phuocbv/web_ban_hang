<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CollectionRepositoryInterface extends RepositoryInterface
{
    public function getProducts($id, $from, $to);
}
