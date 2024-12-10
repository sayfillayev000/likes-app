<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        if (Product::find($request->product_id)->likes()->where('user_id', Auth::id())->exists()) {
            Auth::user()->likes()->where('product_id', $request->product_id)->delete();
            return back()->with('success', 'like muvofiqatli olib tashlandi');
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ]);
            return back()->with('success', 'like muvofiqatli qabul qilindi');
        }
    }

    public function destroy(Like $answer)
    {
        if (Auth::id() === $answer->user_id || Auth::user()->hasRole('admin')) {
            $answer->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }
        return redirect()->route('question.show', $answer->question_id)->with('success', "Javobingiz muvofaqqiyatli o'chirildi");
    }
}
