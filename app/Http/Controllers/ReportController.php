<?php

namespace App\Http\Controllers;

use App\Models\BorrowBook;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {

        $deleteB = BorrowBook::whereDoesntHave('detailPeminjaman')->orderBy('f_tanggalpeminjaman', 'desc')->delete();

        return view('admins.reports.index', [
            'reports' => BorrowBook::orderBy('f_tanggalpeminjaman', 'desc')->get()
        ]);
    }

    public function printToPdfMenu()
    {
        return view('admins.reports.pdfmenu');
    }

    public function pdfTemplate()
    {
        return view('admins.reports.pdftemplate');
    }

    public function cetakPdf(Request $request)
    {
        $request->validate([
            'printMode' => 'required|in:seluruhnya,sebagian',
            'notReturn' => 'required'
        ]);

        if ($request->printMode == 'sebagian') {
            $request->validate([
                'fromDate' => 'required|date',
                'endDate' => 'required|date'
            ]);

            if ($request->notReturn == '1') {
                $borrowBooks = BorrowBook::where('f_tanggalpeminjaman', '>=', $request->fromDate)->where('f_tanggalpeminjaman', '<=', $request->endDate)->orderBy('f_tanggalpeminjaman', 'asc')->get();
            } else if ($request->notReturn == '0') {
                $borrowBooks = BorrowBook::whereHas('detailPeminjaman', function ($q) {
                    $q->where('f_tanggalkembali', '!=', null);
                })->where('f_tanggalpeminjaman', '>=', $request->fromDate)->where('f_tanggalpeminjaman', '<=', $request->endDate)->orderBy('f_tanggalpeminjaman', 'asc')->get();
            } else if ($request->notReturn == '2') {
                $borrowBooks = BorrowBook::whereHas('detailPeminjaman', function ($q) {
                    $q->where('f_tanggalkembali', null);
                })->where('f_tanggalpeminjaman', '>=', $request->fromDate)->where('f_tanggalpeminjaman', '<=', $request->endDate)->orderBy('f_tanggalpeminjaman', 'asc')->get();
            }
        } else {
            if ($request->notReturn == '1') {
                $borrowBooks = BorrowBook::orderBy('f_tanggalpeminjaman', 'asc')->get();
            } else if ($request->notReturn == '0') {
                $borrowBooks = BorrowBook::whereHas('detailPeminjaman', function ($q) {
                    $q->where('f_tanggalkembali', '!=', null);
                })->orderBy('f_tanggalpeminjaman', 'asc')->get();
            } else if ($request->notReturn == '2') {
                $borrowBooks = BorrowBook::whereHas('detailPeminjaman', function ($q) {
                    $q->where('f_tanggalkembali', null);
                })->orderBy('f_tanggalpeminjaman', 'asc')->get();
            }
        }
        $dateNow = Carbon::now()->toDateTimeLocalString();

        if ($request->fromDate && $request->endDate) {
            $pdf = Pdf::loadview('admins.reports.pdftemplate', [
                'borrowBooks' => $borrowBooks,
                'fromDate' => $request->fromDate,
                'endDate' => $request->endDate
            ]);
        } else {
            $pdf = Pdf::loadview('admins.reports.pdftemplate', [
                'borrowBooks' => $borrowBooks,
                'fromDate' => null,
                'endDate' => null
            ]);
        }
        return $pdf->download('laporan-perpustakaan-' . $dateNow . '.pdf');
    }
}
