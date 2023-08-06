<?php

namespace App\Http\Controllers;

use App\Models\Book;

class IndexController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $books = Book::orderBy('created_at', 'DESC')->get();
        return view('home', ['books' => $books]);
    }
}
