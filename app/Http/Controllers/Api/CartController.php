<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function addProductToCart(Request $request, $productId)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            // Find the product and check if it is active and in stock
            $product = Product::where('status', Product::STATUS_ACTIVE)->findOrFail($productId);

            if (! $product->stock) {
                return $this->error('Product is out of stock.', Response::HTTP_OK);
            }

            // Determine whether the user is authenticated or not
            $userId = auth()->check() ? auth()->user()->id : null;
            $sessionId = ! $userId ? Session::getId() : null;

            // If no user is logged in and no session ID is available, return an error
            if (! $userId && ! $sessionId) {
                return $this->error('Unable to identify the user or session.', Response::HTTP_BAD_REQUEST);
            }

            // Check if the cart item already exists
            $cartItem = Cart::where('product_id', $product->id)
                ->where(function ($query) use ($userId, $sessionId) {
                    $query->where('user_id', $userId)
                        ->orWhere('session_id', $sessionId);
                })
                ->first();

            if ($cartItem) {
                // If the product is already in the cart, update the quantity
                $cartItem->increment('quantity', $validated['quantity']);
            } else {
                // Create a new cart item
                $cartItem = Cart::create([
                    'product_id' => $product->id,
                    'quantity' => $validated['quantity'],
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                ]);
            }

            // Return success response
            return $this->success('Product added to cart successfully', $cartItem, Response::HTTP_OK);
        } catch (\Exception $exception) {
            // Handle errors
            return $this->error('Something went wrong.', Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getMessage());
        }
    }
}
