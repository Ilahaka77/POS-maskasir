<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'id' => $this->id,
            'kode_member' => $this->member->kode_member,
            'foto_profil' => $this->foto_profil,
            'name' => $this->name,
            'email' => $this->email,
            'email_verification' => $this->email_verified_at,
            'umur' => Carbon::parse($this->tgl_lahir)->diff(Carbon::now())->format('%y'),
            'role' => $this->role,
            'alamat' => $this->alamat,
            'saldo' => $this->member->saldo
        ];
    }
}
