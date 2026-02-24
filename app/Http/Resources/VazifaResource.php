<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VazifaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vazifa_id' => $this->id,
            'nomi' => strtoupper($this->nomi),
            'holati' => $this->bajarildi ? 'Tugallangan' : 'Jarayonda',
             "yaratilgan_vaqti" => $this->created_at->format('d.m.Y H:i'),
        ];
    }
}
