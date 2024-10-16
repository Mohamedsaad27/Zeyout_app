<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Trader;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $brandsCount = Brand::count();
        $recentCategories = Category::latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();
        $recentBrands = Brand::latest()->take(5)->get();
        $recentTraders = Trader::latest()->take(5)->get();
        return view('admin.index', compact('categoriesCount', 'productsCount', 'brandsCount', 'recentCategories', 'recentProducts', 'recentBrands', 'recentTraders'));
    }
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index');
        }
        return back()->withErrors(['email' => 'These Credentials do not match our records.  ']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
