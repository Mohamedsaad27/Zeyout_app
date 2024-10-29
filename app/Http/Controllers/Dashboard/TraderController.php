<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Trader;
use App\Models\Governate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreTraderRequest;

class TraderController extends Controller
{
    public function index()
    {
        $traders = Trader::with('user')->get();
        return view('admin.trader.index', compact('traders'));
    }

    public function create()
    {
        $governates = Governate::all();
        return view('admin.trader.create', compact('governates'));
    }
    public function show($id)
    {
        $trader = Trader::with('user','products','governate')->find($id);
        return view('admin.trader.show', compact('trader'));
    }
    public function store(StoreTraderRequest $request)
    {
        $validatedData = $request->validated();
        if($request->hasFile('profile_image')){
            $profile_image = $request->file('profile_image');
            $profile_image_name = time().'.'.$profile_image->getClientOriginalExtension();
            $profile_image_path = 'uploads/images/users';
            if (!File::isDirectory(public_path($profile_image_path))) {
                File::makeDirectory(public_path($profile_image_path), 0755, true, true);
            }
            $profile_image->move(public_path($profile_image_path), $profile_image_name);
            $validatedData['profile_image'] = env('URL') . '/' . $profile_image_path . '/' . $profile_image_name;
        }
       $user =  User::create([
            'user_name' => $validatedData['user_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['phone_number']),
            'birth_date' => $validatedData['birth_date'],
            'country' => $validatedData['country'],
            'profile_image' => $validatedData['profile_image'] ?? null,
            'type' => 'trader',

        ]);
           // Calculate expiration date
           $expirationDate = now()->addDays((int)$validatedData['number_of_days']);
           $trader = Trader::create([
            'user_id' => $user->id,
            'governate_id' => $validatedData['governate'],
            'description_ar' => $validatedData['description_ar'],
            'description_en' => $validatedData['description_en'],
            'facebook_url' => $validatedData['facebook_url'],
            'instagram_url' => $validatedData['instagram_url'],
            'number_of_days' => $validatedData['number_of_days'],
            'is_active' => true,
            'expires_at' => $expirationDate,
        ]);
        return redirect()->route('traders.index')->with('successCreate','Trader created successfully');
    }

    public function edit($id)
    {
        $trader = Trader::with('user')->find($id);
        $governates = Governate::all();
        return view('admin.trader.edit', compact('trader', 'governates'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|',
            'phone_number' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'country' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255|url',
            'instagram_url' => 'nullable|string|max:255|url',
            'governate' => 'required|exists:governates,id',
        ]);
        $trader = Trader::find($id);
        $user = User::find($trader->user_id);
        if($request->hasFile('profile_image')){
            $profile_image = $request->file('profile_image');
            $profile_image_name = time().'.'.$profile_image->getClientOriginalExtension();
            $profile_image_path = 'uploads/images/users';
            if (!File::isDirectory(public_path($profile_image_path))) {
                File::makeDirectory(public_path($profile_image_path), 0755, true, true);
            }
            $profile_image->move(public_path($profile_image_path), $profile_image_name);
            $validatedData['profile_image'] = env('URL') . '/' . $profile_image_path . '/' . $profile_image_name;
        }
        $user->update([
            'user_name' => $validatedData['user_name'],
            'email' => $validatedData['email'] ?? $user->email,
            'phone_number' => $validatedData['phone_number'] ?? $user->phone_number,
            'birth_date' => $validatedData['birth_date'] ?? $user->birth_date,
            'country' => $validatedData['country'] ?? $user->country,
            'profile_image' => $validatedData['profile_image'] ?? $user->profile_image,
        ]);
        $trader->update([
            'description_ar' => $validatedData['description_ar'],
            'description_en' => $validatedData['description_en'],
            'facebook_url' => $validatedData['facebook_url'],
            'instagram_url' => $validatedData['instagram_url'],
            'governate_id' => $validatedData['governate'],
        ]);
        return redirect()->route('traders.index')->with('successUpdate','Trader updated successfully');
    }

    public function destroy($id)
    {
        $trader = Trader::find($id);
        $user = User::find($trader->user_id);
        if($user->profile_image){
            $imagePath = $user->profile_image;
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
        }
        $user->delete();
        $trader->delete();
        return redirect()->route('traders.index')->with('successDelete','Trader deleted successfully');
    }
}
