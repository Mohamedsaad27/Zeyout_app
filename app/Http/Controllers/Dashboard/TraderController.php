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
        return view('admin.trader.show', compact('id'));
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
        $trader = Trader::create([
            'user_id' => $user->id,
            'governate_id' => $validatedData['governate'],
            'description_ar' => $validatedData['description_ar'],
            'description_en' => $validatedData['description_en'],
            'facebook_url' => $validatedData['facebook_url'],
            'instagram_url' => $validatedData['instagram_url'],
        ]);
        return redirect()->route('traders.index')->with('successCreate','Trader created successfully');
    }

    public function edit($id)
    {
        return view('admin.trader.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        return $request->all();
    }

    public function destroy($id)
    {
        return $id;
    }
}
