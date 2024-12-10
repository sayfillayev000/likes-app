<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'content' => $request->content
        ]);

        return back()->with('success', 'kamentingiz muvofiqatli qabul qilindi');
    }


    public function destroy(Comment $comment)
    {
        if (Auth::id() === $comment->user_id || Auth::user()->hasRole('admin')) {
            $comment->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }
        return redirect()->route('product.show', $comment->product_id)->with('success', "Komentingiz muvofaqqiyatli o'chirildi");
    }
}
