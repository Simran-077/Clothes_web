<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class WebController extends Controller
{
  public function homepage()
{
    $paginatedCategories = Product::select('category')
        ->where('status', 1)
        ->distinct()
        ->paginate(4);

    $allCategories = Product::select('category')
        ->where('status', 1)
        ->distinct()
        ->get(); 

    $products = Product::with('images')
        ->where('status', 1)
        ->latest()
        ->paginate(4);

    return view('website.home', [
        'paginatedCategories' => $paginatedCategories,
        'allCategories' => $allCategories,
        'products' => $products
    ]);
}
    // Cart view
    public function View()
    {
        return view('website.cart');
    }

    // Wishlist view
    public function wishlist()
    {
        return view('website.wishlist');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('website.auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials!',
        ])->onlyInput('email');
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('website.auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|min:10|max:10',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? '',
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('login')->with('success', 'Account created and logged in!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }

    // Search products
    public function search(Request $request)
    {
        $query = $request->input('search');

        $products = Product::when($query, function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('price', 'like', "%{$query}%")
              ->orWhere('offer_price', 'like', "%{$query}%");
        })->paginate(12);

        return view('website.search-results', compact('products', 'query'));
    }

    // Products filtered by category
    public function productsByCategory($category)
    {
        $products = Product::with('images')
            ->where('category', $category)
            ->where('status', 1)
            ->paginate(12);

        return view('website.products_by_category', compact('products', 'category'));
    }
public function filter(Request $request)
{
    $query = Product::query();

    // Search
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Category Filter
    if ($request->filled('category')) {
        $query->whereIn('category', $request->category);
    }

    // Price Filter
    if ($request->filled('min_price')) {
        $query->where('offer_price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('offer_price', '<=', $request->max_price);
    }

    // Sorting Logic
    if ($request->sort == 'low_to_high') {
        $query->orderBy('offer_price', 'asc');
    } elseif ($request->sort == 'high_to_low') {
        $query->orderBy('offer_price', 'desc');
    }

    $products = $query->paginate(6)->appends($request->all());

    $allCategories = Product::select('category')->distinct()->pluck('category')->toArray();
    $minPrice = Product::min('offer_price') ?? 0;
    $maxPrice = Product::max('offer_price') ?? 0;

    return view('website.products_by_category', compact(
        'products', 'allCategories', 'minPrice', 'maxPrice'
    ));
}

public function checkout(){
    return view ('website.checkout');
}

public function store(Request $request)
{
    $cart = json_decode($request->input('cart_data'), true);

    if (!$cart || empty($cart)) {
        return back()->with('error', 'Cart is empty!');
    }

    $subTotal = 0;
    foreach ($cart as $item) {
        $subTotal += $item['price'] * $item['quantity'];
    }
    $shipping = 50;
    $grandTotal = $subTotal + $shipping;

    
    $order = Order::create([
        'first_name' => $request->firstname,
        'last_name' => $request->lastname,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'address' => $request->address,
        'city' => $request->city,
        'country' => $request->country,
        'state' => $request->state,
        'comment' => $request->comment,
        'total_amount' => $grandTotal,
    ]);

    // 2. Save Order Items
    foreach ($cart as $item) {
        Order_items::create([
            'product_name' => $item['name'],
            'image' => $item['image'],
            'quantity' => $item['quantity'],
            'unit_price' => $item['price'],
            'total' => $item['price'] * $item['quantity'],
            'order_id' => $order->id,
        ]);
    }

    // 3. Generate PDF Invoice
    $order->load('items');
    $pdf = Pdf::loadView('admin.invoice_pdf', [
        'order' => $order,
        'order_items' => $order->items,
    ])->output();

    // 4. Send Invoice Email with Attachment
    Mail::to($order->email)->send(new InvoiceMail($order, $pdf));

    return redirect('/')->with('success', 'Order placed and invoice sent to your email!');
}
}