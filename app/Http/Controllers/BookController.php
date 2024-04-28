<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookDetail;
use App\Models\BorrowBook;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.books.index', [
            'books' => Book::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.books.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedBook = $request->validate([
            'f_idkategori' => 'required|exists:t_kategori,f_id',
            'f_judul' => 'required',
            'f_pengarang' => 'required',
            'f_penerbit' => 'required',
            'f_deskripsi' => 'required',
        ]);

        $validatedDetail = $request->validate([
            'f_status' => 'required|in:Tersedia,Tidak Tersedia'
        ]);

        $book = Book::create($validatedBook);

        if (!$book) {
            return redirect('/dashboard/books')->with('notify', 'Gagal Menambahkan Buku');
        }

        $validatedDetail['f_idbuku'] = $book->f_id;
        $detailBook = BookDetail::create($validatedDetail);
        if (!$detailBook) {
            return redirect('/dashboard/books')->with('notify', 'Gagal Menambahkan Buku');
        }
        return redirect('/dashboard/books')->with('notify', 'Berhasil Menambahkan Buku ' . $book->f_judul);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('admins.books.edit', [
            'book' => $book,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validatedBook = $request->validate([
            'f_idkategori' => 'required|exists:t_kategori,f_id',
            'f_judul' => 'required',
            'f_pengarang' => 'required',
            'f_penerbit' => 'required',
            'f_deskripsi' => 'required',
        ]);

        $validatedDetail = $request->validate([
            'f_status' => 'required|in:Tersedia,Tidak Tersedia'
        ]);

        $updatedBook = $book->update($validatedBook);
        if (!$updatedBook) {
            return redirect('/dashboard/books')->with('notify', 'Gagal Edit Buku');
        }
        $validatedDetail['f_id'] = $book->f_id;
        $detailBook = BookDetail::where("f_idbuku", $book->f_id)->first();
        if (!$detailBook) {
            BookDetail::create($validatedDetail);
        }
        $updatedDetailBook = $detailBook->update($validatedDetail);
        if (!$updatedDetailBook) {
            return redirect('/dashboard/books')->with('notify', 'Gagal Edit Buku');
        }
        return redirect('/dashboard/books')->with('notify', 'Berhasil Edit Buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $deletedBook = $book->delete();
        $deleteB = BorrowBook::whereDoesntHave('detailPeminjaman')->orderBy('f_tanggalpeminjaman', 'desc')->delete();
        if ($deletedBook) {
            return redirect('/dashboard/books')->with('notify', 'Berhasil Menghapus Buku ' . $book->f_judul);
        } else {
            return redirect('/dashboard/books')->with('notify', 'Gagal Menghapus Buku');
        }
    }
}
