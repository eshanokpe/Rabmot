<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $userId = Auth::id();
        $userEmail = Auth::user()->email;
        $cartItems = Cart::content();
        $cartCounts = Cart::count();
        // return response()->json([
        //     'success' => true,
        //     'cartItems' => $cartItems,
        // ]);
        return view('user.pages.cart', ['cartContent' => $cartItems], ['cartCount' => $cartCounts]);
    }

    public function getCartContents()
    { 
        // Get all items from the cart
        $cartItems = Cart::content();

        return response()->json([
            'success' => true,
            'cartItems' => $cartItems,
        ]);
    }
    // public function destroy(Request $request){
    //     $id =  $request->itemId;
    //     Cart::remove($id);
    //     return response()->json([
    //         'message' => 'Item deleted successfully', 
    //     ]);
    // }

    public function destroy(Request $request)
    {
        try {
            $itemId = $request->input('itemId');
            Cart::remove($itemId);
            
            return response()->json(['message' => 'Item deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the item.'], 500);
        }
    }

}
