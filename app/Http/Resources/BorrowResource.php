<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'f_id' => $this->f_id,
            'f_buku' => $this->detailPeminjaman->detailBook->book->f_judul,
            'f_admin' => $this->admin->f_nama,
            'f_tanggalpeminjaman' => $this->f_tanggalpeminjaman
        ];
    }
}
