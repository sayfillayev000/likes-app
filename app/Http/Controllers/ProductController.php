<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->only(['create', 'store', 'destroy']);
    }
    public function index()
    {
        return view('product.index')->with(['products' => Product::latest()->get()]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductRequest $request)
    {
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $name = $file->getClientOriginalName();

            $path = basename($file->storeAs('/', $name,));
        } else {
            $path = null;
        }

        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $path,
        ]);

        return redirect()->back()->with('success', 'Mahsulot muvaffaqiyatli qo\'shildi!');
    }

    public function show(Product $product)
    {
        return view('product.show')->with(['product' => $product]);
    }


    public function destroy(Product $product)
    {
        if (Auth::id() === $product->user_id || Auth::user()->hasRole('admin')) {
            $product->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }

        return redirect()->route('product.index')->with('success', "Savolingiz Muvoffaqqiyatli o'chirli");
    }
}
