<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeachersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Mapeamos los campos exactos de tu base de datos para la API
        return [
            'id_profesor' => $this->id_profesor,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'especialidad' => $this->especialidad,
        ];
    }
}