<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PembelianResource extends JsonResource
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
            // 'tanggal' => date("D, J F Y", $this->created_at),
            'tanggal' => Carbon::parse($this->created_at)->format("l, d F Y"),
            'supplier' => $this->supplier->nama_supplier,
            'total_bayar' => $this->total_bayar
        ];
    }
}
