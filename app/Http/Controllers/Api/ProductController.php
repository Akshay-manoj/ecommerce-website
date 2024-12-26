<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $products = Product::categoryId($request->category)
            ->productName($request->name)
            ->priceRange($request->min_price, $request->max_price)
            ->status(Product::STATUS_ACTIVE)
            ->sortBy($request->sort_by)
            ->paginate(10);

        return $this->success('', $products, Response::HTTP_OK);
    }

    public function show(Request $request, $slug): JsonResponse
    {
        $product = Product::where('slug', $slug)->first();

        if (! $product) {
            return $this->error('Product not found.', null, Response::HTTP_NOT_FOUND);
        }

        return $this->success('', $product, Response::HTTP_OK);
    }
}
