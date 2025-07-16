<?php

namespace App\Http\Controllers;
use App\Models\Inquiries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WebUserController extends Controller
{
    public function Inquiry()
    {
        return view('user.inquiry');
    }

public function Inquirylist()
{
    $inquiries = Inquiries::all();
    return view('user.inquiry-list', compact('inquiries'));
}

public function pending()
{
    $inquiries = Inquiries::where('status', 'pending')->get();
    return view('admin.pending-users', compact('inquiries'));
}

public function approve($id)
{
    $inquiry = Inquiries::findOrFail($id);
    $inquiry->status = 'approved';
    $inquiry->save();

    return redirect()->back()->with('success', 'User approved successfully!');
}

public function approved()
{
    $inquiries = Inquiries::where('status', 'approved')->get();
    return view('admin.approved-users', compact('inquiries'));
}

public function deactive($id)
{
    $inquiry = Inquiries::findOrFail($id);
    $inquiry->status = 'pending';  // lowercase 'pending'
    $inquiry->save();

    return redirect()->back()->with('success', 'User Update successfully!');
}

    public function Form(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:inquiries',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $inquiries = Inquiries::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending',
        ]);
    
        return redirect()->route('user.inquiry')->with('success', 'Inquiry successful!');
    }

     public function Userhome()
    {
        return view('user.home');
    }


     public function Home_show()
    {
        return view('user.home2');
    }
    public function table_show()
    {
        return view('user.table');
    }
      
//user dashboard
public function index()
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

    return view('user.home', compact(
        'totalusers',
        'approvedusers',
        'pendingusers',
        'pieChartData',
        'ordersByMonth',
        'monthNames'
    ));
}

public function Signout()
{
    return redirect()->route('signin');
}

 public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

   public function Profileupdate(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:10',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;

    // Handle profile image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/profile'), $imageName);
        $user->image = 'uploads/profile/' . $imageName;
    }

    $user->save();

    return redirect()->route('user.profile.show')->with('success', 'Profile updated successfully!');
}


    // Show edit form
public function edit($id)
{
    $inquiry = Inquiries::findOrFail($id);
    return view('user.inquiry-edit', compact('inquiry'));
}

// Update inquiry
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'subject' => 'required|string',
        'message' => 'required|string',
    ]);

    $inquiry = Inquiries::findOrFail($id);

    if ($inquiry->status === 'approved') {
        return redirect()->back()->with('error', 'Approved inquiries cannot be edited.');
    }

    $inquiry->update([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    return redirect()->route('user.inquiry-list')->with('success', 'Inquiry updated successfully!');
}

// Delete inquiry
public function destroy($id)
{
    $inquiry = Inquiries::findOrFail($id);

    if ($inquiry->status === 'approved') {
        return redirect()->back()->with('error', 'Approved inquiries cannot be deleted.');
    }

    $inquiry->delete();

    return redirect()->back()->with('success', 'Inquiry deleted successfully!');
}


public function password($id)
{
    $data = User::findOrFail($id);
    return view('dashboard.pass', compact('data'));
}

public function ChangePass(Request $request, $id)
{
    $user = User::findOrFail($id);

    if (!Hash::check($request->old_password, $user->password)) {
        return back()->withErrors(['old_password' => 'Old password is incorrect']);
    }

    $validator = Validator::make($request->all(), [
        'password' => 'required|string|min:6|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('user.change-pass')->with('success', 'Password updated successfully!');
}

public function change()
{
    $data = Auth::user(); 
    return view('dashboard.pass', compact('data'));
}

}
