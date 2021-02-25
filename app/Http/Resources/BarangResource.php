<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'barcode' => $this->barcode,
            'nama_barang' => $this->nama_barang,
            'kategori' => $this->kategori->kategori,
            'merek' => $this->merek,
            'stok' => $this->stok,
            'diskon' => (float) $this->diskon,
            'harga_beli' => $this->harga_beli,
            'harga_jual' => $this->harga_jual
        ];
    }
}
