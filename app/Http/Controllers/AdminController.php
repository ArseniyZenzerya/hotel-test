<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Models\Book;

class AdminController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    /**
     * @param AdminLoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(AdminLoginRequest $request)
    {
        $data = $request->except('_token');

        if (auth('admin')->attempt($data)) {
            return redirect(route('admin.dashboard'));
        }

        return redirect(route('admin.login'))
            ->withErrors(['email' => 'Пользователь не найден, либо данные введены неправильно']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showDashboard()
    {
        $books = Book::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('admin.dashboard', compact('books'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        auth('admin')->logout();
        return redirect(route('admin.login'));
    }
}
