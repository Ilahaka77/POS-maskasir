<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'email_verification' => $this->email_verified_at,
            'umur' => Carbon::parse($this->tgl_lahir)->diff(Carbon::now())->format('%y'),
            'alamat' => $this->alamat,
            'role' => $this->role
        ];
    }
}
