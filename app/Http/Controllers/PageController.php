<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Book;
use App\Models\BorrowBook;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function login()
    {
        return view('login');
    }

    public function dashboard()
    {
        return view('admins.dashboard', [
            'bookCount' => Book::count(),
            'memberCount' => Member::count(),
            'librarianCount' => Admin::count()
        ]);
    }

    public function book()
    {
        return view('book', [
            'books' => Book::orderBy('f_judul', 'asc')->get()
        ]);
    }

    public function history()
    {
        return view('history', [
            'reports' => BorrowBook::where('f_idanggota', Auth::user()->f_id)->get()
        ]);
    }

    public function bookCreate()
    {
        return view('admins.books.create');
    }

    public function member()
    {
        return view('admins.members.index');
    }

    public function librarian()
    {
        return view('admins.librarians.index');
    }
}
