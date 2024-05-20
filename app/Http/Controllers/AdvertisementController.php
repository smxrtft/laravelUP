<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('advertisements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,CategoryID', // Убедитесь, что поле существует в таблице категорий
            'ad_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Обработка загрузки фото объявления
        if ($request->hasFile('ad_photo')) {
            $image = $request->file('ad_photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $validatedData['AdPhoto'] = $filename;
        }

        $validatedData['Title'] = $request->input('title');
        $validatedData['Description'] = $request->input('description');
        $validatedData['CategoryID'] = $request->input('category_id');
        $validatedData['UserID'] = Auth::id();
        $validatedData['Status'] = 'На рассмотрении';

        Advertisement::create($validatedData);

        return redirect()->route('home')->with('success', 'Объявление успешно добавлено.');
    }

    public function addToCart(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        Cart::create([
            'UserID' => auth()->id(),
            'AdID' => $advertisement->AdID,
        ]);

        return redirect()->back()->with('success', 'Объявление добавлено в корзину.');
    }
    public function removeCart(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины.');
    }

    public function showCart()
    {
        $carts = Cart::where('UserID', auth()->id())->with('advertisement')->get();
        return view('category.cart', compact('carts'));
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    $advertisements = Advertisement::where('Title', 'like', "%{$query}%")
        ->orWhereHas('user', function ($q) use ($query) {
            $q->where('Username', $query)->where('Status', 'Одобрено')->with('user');
        })
        ->get();

    return view('search', compact('advertisements', 'query'));
}

}
