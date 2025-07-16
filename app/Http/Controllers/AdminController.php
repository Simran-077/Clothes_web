<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\Inquiries;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    // Dashboard
    public function AdminHome()
    {
        return view('admin.home');
    }

    public function dashboard()
    {
        $totalusers = User::count();
        $approvedusers = User::where('status', 'approved')->count();
        $pendingusers = User::where('status', 'pending')->count();

        $pieChartData = [
            'approved' => $approvedusers,
            'pending' => $pendingusers,
        ];

        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $ordersByMonth = [];

        for ($i = 1; $i <= 12; $i++) {
            $ordersByMonth[] = User::whereMonth('created_at', $i)
                ->whereYear('created_at', now()->year)
                ->count();
        }

        return view('admin.home', compact(
            'totalusers',
            'approvedusers',
            'pendingusers',
            'pieChartData',
            'ordersByMonth',
            'monthNames'
        ));
    }

    public function Homeshow()
    {
        return view('admin.home2');
    }

    public function tableshow()
    {
        return view('admin.table');
    }

    public function AdminSignout()
    {
        return redirect()->route('signin');
    }

    // Inquiries
    public function Iquiryadmin()
    {
        $inquiries = Inquiries::all();
        return view('admin.inquiry_list', compact('inquiries'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $inquiry = Inquiries::findOrFail($id);
        $inquiry->reply = $request->reply;
        $inquiry->save();

        return redirect()->back()->with('success', 'Reply sent successfully!');
    }

    // User Management
    public function userlist()
    {
        $users = User::where('type', 1)->where('status', 'approved')->get();
        return view('user.user-list', compact('users'));
    }

    public function pendingUsers()
    {
        $users = User::where('status', 'pending')->get();
        return view('admin.pending-users', compact('users'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->back()->with('success', 'User approved successfully!');
    }

    public function approvedUsers()
    {
        $users = User::where('status', 'approved')->get();
        return view('admin.approved-users', compact('users'));
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'pending';
        $user->save();

        return redirect()->back()->with('success', 'User status updated!');
    }

    public function showPendingUsers()
    {
        $users = User::where('type', 1)->where('status', 'pending')->get();
        return view('user.user-list', compact('users'))->with('status', 'pending');
    }

    public function showApprovedUsers()
    {
        $users = User::where('type', 1)->where('status', 'approved')->get();
        return view('user.user-list', compact('users'))->with('status', 'approved');
    }

    public function updateallstatus(Request $request)
    {
        $status = $request->status;
        $userIds = $request->user_ids;

        if ($userIds && count($userIds)) {
            User::whereIn('id', $userIds)->update(['status' => $status]);
            return back()->with('success', 'Selected users marked as ' . $status . '.');
        }

        User::where('type', 1)->where('status', $status === 'approved' ? 'pending' : 'approved')
            ->update(['status' => $status]);

        return back()->with('success', 'All users marked as ' . $status . '.');
    }

    public function JsStatusUpdate(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            $user->status = $user->status === 'approved' ? 'pending' : 'approved';
            $user->save();

            return response()->json(['success' => true, 'new_status' => $user->status]);
        }

        return response()->json(['success' => false], 404);
    }

    // Product CRUD
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'brand' => 'nullable|string',
            'category' => 'nullable|string',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $data['image'] = 'uploads/products/' . $imageName;
        }

        $data['status'] = 0;

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'brand' => 'nullable|string',
            'category' => 'nullable|string',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $data['image'] = 'uploads/products/' . $imageName;
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }

    public function InactiveUsers()
    {
        $products = Product::where('status', 0)->get();
        return view('admin.products.index', compact('products'));
    }

    public function activetheuser($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->save();

        return redirect()->back()->with('success', 'Product activated successfully!');
    }

    // Multiple Image Upload
    public function show(Product $product)
    {
        return view('product-images', compact('product'));
    }


    public function uploadImages(Request $request, $productId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        $product = Product::findOrFail($productId);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products/images'), $filename);

                Image::create([
                    'product_id' => $product->id,
                    'image' => 'products/images/' . $filename,
                ]);
            }
        }

        // Return JSON with fresh image list
        return response()->json([
            'images' => $product->images()->get()
        ]);
    }

    public function destroyImage($id)
    {
        $image = Image::findOrFail($id);

   
        $filePath = public_path('uploads/' . $image->image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete DB record
        $image->delete();

        return response()->json(['success' => true]);
    }

public function bulkDelete(Request $request)
{
    $ids = $request->ids;

    if (!empty($ids)) {
        \App\Models\Product::whereIn('id', $ids)->delete();
    }

    return response()->json(['success' => true]);
}

public function bulkActivate(Request $request)
{
    $ids = $request->ids;

    if (!empty($ids)) {
        \App\Models\Product::whereIn('id', $ids)->update(['status' => 1]);
    }

    return response()->json(['success' => true]);
}

// Bulk Deactivate
public function bulkDeactivate(Request $request)
{
    $ids = $request->ids;

    if (!empty($ids)) {
        \App\Models\Product::whereIn('id', $ids)->update(['status' => 0]);
    }

    return response()->json(['success' => true]);
}

public function category()
{
    $categories_data = Category::all(); // ✅ all, active & inactive

   // dd($categories);
    return view('categories.index', compact('categories_data'));
}
    public function createe()
    {
        return view('categories.create');
    }

    public function stored(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('image')) {
            $filename = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/categories'), $filename);
        }

        Category::create([
            'name' => $request->name,
            'image' => $filename,
            'status' => true,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully.');
    }

    public function updated(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('uploads/categories/'.$category->image))) {
                unlink(public_path('uploads/categories/'.$category->image));
            }

            $filename = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/categories'), $filename);
            $category->image = $filename;
        }

        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroyed(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    
public function Delete(Request $request)
{
    $ids = $request->ids;

    if (!empty($ids)) {
        \App\Models\Category::whereIn('id', $ids)->delete();
    }

    return response()->json(['success' => true]);
}

public function ActivateBulk(Request $request)
{
    $ids = $request->ids;

    if (!empty($ids)) {
        \App\Models\Category::whereIn('id', $ids)->update(['status' => 1]);
    }

    return response()->json(['success' => true]);
}

// Bulk Deactivate
public function DeactivateBulk(Request $request)
{
    $ids = $request->ids;

    if (!empty($ids)) {
        Category::whereIn('id', $ids)->update(['status' => 0]); 
    }

    return response()->json(['success' => true]);
}

    public function order()
    {
        $orders = Order::with('items')->get();
        return view('admin.orders.index', compact('orders'));
    }

   public function invoice($orderId)
{
    $order = Order::findOrFail($orderId);
    $order_items = Order_Items::where('order_id', $orderId)->get();

    return view('invoice', compact('order', 'order_items'));
}

public function invoicePDF($orderId)
{
    $order = Order::findOrFail($orderId);
    $order_items = Order_Items::where('order_id', $orderId)->get();

    $pdf = Pdf::loadView('invoice_pdf', compact('order', 'order_items'));
    return $pdf->download('invoice_order_' . $order->id . '.pdf');
}

public function downloadInvoice($orderId)
{
    $order = Order::with('items')->findOrFail($orderId);

    $pdf = Pdf::loadView('admin.invoice_pdf', [
        'order' => $order,
        'order_items' => $order->items
    ]);

    return $pdf->download('invoice.pdf');
}

}
