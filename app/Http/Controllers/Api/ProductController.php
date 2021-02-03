<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Repository\ProductRepository;

class ProductController extends Controller
{
    /**
     * @var Product
     */

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $products = $this->product;
        $productsRepository = new ProductRepository($products);

        if($request->has('coditions')) {
            $productsRepository->selecCodition($request->get('coditions'));
        }

        if($request->has('fields')) {
            $productsRepository->selectFilter($request->get('fields'));
        }

        //return response()->json($products);

        return new ProductCollection($productsRepository->getResult()->paginate(10));
    }

    public function show($id)
    {
        $products = $this->product->find($id);

        //return response()->json($products);
        return new ProductResource($products);
    }

    public function save(ProductRequest $request)
    {
        $data = $request->all();

        $product = $this->product->create($data);

        return response()->json($product);
    }

    public function update(ProductRequest $request)
    {
        $data = $request->all();


        $id = $data['id'];

        $product = $this->product->find($id);
        $product->update($data);
        //return dd($product);

        return response()->json($product);
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();

        return response()->json(['data' => ['msg' => 'Produto foi removido com sucesso!!!']]);
    }
}
