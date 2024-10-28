<?php

namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Models\Agent;

class CartController extends Controller
{
    public function index(){
        $user = Auth::guard('agent')->user();
        $userId = $user->id;
        $userEmail =  $user->email;
        $cartItems = Cart::content();
        $cartCounts = Cart::count();
      
        return view('agent.pages.cart', ['user'=>$user], ['cartContent' => $cartItems], ['cartCount' => $cartCounts]);
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
