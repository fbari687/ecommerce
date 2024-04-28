<?php

namespace App\Http\Controllers;

use App\Http\Resources\BorrowResource;
use App\Models\BookDetail;
use App\Models\BorrowBook;
use App\Models\BorrowBookDetail;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        return view("admins.returns.index", [
            'members' => Member::orderBy('f_nama', 'asc')->get()
        ]);
    }

    public function returns(Request $request)
    {
        if (!$request->f_id) {
            return redirect('/dashboard/returns')->with('notify', 'Gagal Melakukan Pengembalian');
        }
        $validated = $request->validate([
            'f_id' => 'array',
            'f_id.*' => 'exists:t_peminjaman,f_id'
        ]);

        for ($i = 0; $i < count($request->f_id); $i++) {
            $borrowBookDetail = BorrowBookDetail::where("f_idpeminjaman", $request->f_id[$i])->first();
            if (!$borrowBookDetail) {
                return redirect('/dashboard/returns')->with('notify', 'Gagal Melakukan Pengembalian');
            }
            $updatedBorrowBookDetail = $borrowBookDetail->update([
                'f_idpeminjaman' => $borrowBookDetail->f_idpeminjaman,
                'f_iddetailbuku' => $borrowBookDetail->f_iddetailbuku,
                'f_tanggalkembali' => Carbon::now()->toDateString()
            ]);
            if (!$updatedBorrowBookDetail) {
                return redirect('/dashboard/returns')->with('notify', 'Gagal Melakukan Pengembalian');
            }
            $detailBook = BookDetail::where('f_id', $borrowBookDetail->f_iddetailbuku)->first();
            if (!$detailBook) {
                return redirect('/dashboard/returns')->with('notify', 'Gagal Melakukan Pengembalian');
            }
            $newDetailBook = $detailBook->update([
                'f_id' => $detailBook->f_id,
                'f_idbuku' => $detailBook->f_idbuku,
                'f_status' => "Tersedia"
            ]);
            if (!$newDetailBook) {
                return redirect('/dashboard/returns')->with('notify', 'Gagal Melakukan Pengembalian');
            }
        }

        return redirect('/dashboard/returns')->with('notify', 'Berhasil Melakukan Pengembalian');
    }

    public function search(string $f_idanggota)
    {
        $f_idanggota = (int)$f_idanggota;
        $peminjaman = BorrowBook::where('f_idanggota', $f_idanggota)->whereHas('detailPeminjaman', function ($q) {
            $q->where('f_tanggalkembali', null);
        })->get();
        if ($peminjaman->isNotEmpty()) {
            $response = [
                'status' => 'success',
                'data' => BorrowResource::collection($peminjaman)
            ];
            return response()->json($response, 200);
            // return BorrowResource::collection($peminjaman);
        } else {
            $response = [
                'status' => 'error',
            ];
            return response()->json($response, 200);
        }
    }
}
