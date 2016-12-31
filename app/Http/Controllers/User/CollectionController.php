<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CollectionRepositoryInterface as CollectionRepositoryInterface;
use App\Repositories\Contracts\ShopRepositoryInterface as ShopRepositoryInterface;
use App\Repositories\Contracts\ProductCollectionRepositoryInterface as ProductCollectionInterface;
use App\ProductCollectionValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

use Auth;
use Lang;

class CollectionController extends Controller
{
    private $collectionRepository;
    private $shopRepository;
    private $productCollectionRepository;
    protected $productCollectionValidator;

    public function __construct(
        ShopRepositoryInterface $shopRepository,
        CollectionRepositoryInterface $collectionRepository,
        ProductCollectionInterface $productCollectionInterface,
        ProductCollectionValidator $productCollectionValidator
    )
    {
        $this->shopRepository = $shopRepository;
        $this->collectionRepository = $collectionRepository;
        $this->productCollectionRepository = $productCollectionInterface;
        $this->productCollectionValidator = $productCollectionValidator;
    }

    public function index()
    {
        $collections = $this->collectionRepository->findByField('shop_id', Auth::user()->shop->id);

        return view('user.collection.index', compact('collections'));
    }

    public function create()
    {
        return view('user.collection.index');
    }

    public function store(Request $request)
    {
        $data = $request->only('name');
        if (!Auth::user()->shop()) {
            return redirect()->to('/');
        }

        $data['shop_id'] = Auth::user()->shop->id;
        if ($this->collectionRepository->validate($data, 'create')) {
            $this->collectionRepository->create($data);

            return redirect()->route('user.collection.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.add_success', ['name' => 'Collection'])
            ]);
        }

        return redirect()->back()->withErrors($this->collectionRepository->valid());
    }

    public function postUpdateAjax(Request $request)
    {
        $data = $request->only('name');
        if (!$request->id) {
            return response()->json(['sms' => Lang::get('user.sms.not_found')]);
        }
        $this->collectionRepository->update($data, $request->id);
        
        return response()->json(['sms' => Lang::get('user.sms.update')]);
    }

    public function postDeleteAjax(Request $request)
    {
        if (!$request->id) {
            return response()->json(['sms' => Lang::get('user.sms.not_found')]);
        }
        $this->collectionRepository->delete($request->id);

        return response()->json(['sms' => Lang::get('user.sms.delete')]);
    }

    public function show($id)
    {   
        $collection = $this->collectionRepository->find($id);
        $shop = $this->shopRepository->findByField('user_id', Auth::id())->first();
            
        return view('user.collection.show', compact('collection', 'shop'));
    }

    public function addProduct(Request $request)
    {
        $data = $request->only('product_id', 'collection_id');
        $productCollection = ['product_id' => $data['product_id'], 'collection_id' => $data['collection_id']];
        if ($this->productCollectionValidator->with($productCollection)->passesOrFail()) {
            $count = $this->productCollectionRepository->findWhere($productCollection)->count();
            if ($count == 0) {
                    $this->productCollectionRepository->create($productCollection);
                    $collection = $this->collectionRepository->find($data['collection_id']);
                    $shop = $this->shopRepository->findByField('user_id', Auth::id())->first();

                    return view('user.collection.collection', compact('collection', 'shop'));
            } else {

                return Lang::get('user.collection.add-warning');
            }
        }

        return Lang::get('user.collection.add-error');
    }

    public function removeProduct(Request $request)
    {
        $data = $request->only('product_id', 'collection_id');
        $where = ['product_id' => $data['product_id'], 'collection_id' => $data['collection_id']];
        $productCollection = $this->productCollectionRepository->findWhere($where)->first();
        if ($productCollection) {
            $productCollection->delete();
            $collection = $this->collectionRepository->find($data['collection_id']);
            $shop = $this->shopRepository->findByField('user_id', Auth::id())->first();

            return view('user.collection.collection', compact('collection', 'shop'));
        }
        
        return Lang::get('remove-error');
    }

    public function myCollections()
    {
        if (Auth::user()) {
            $data['collections'] = $this->collectionRepository->findByField('shop_id', Auth::user()->shop->id);

            return view('user.collection.index', $data);
        }
      
        return redirect()->route('/');
    }
}
