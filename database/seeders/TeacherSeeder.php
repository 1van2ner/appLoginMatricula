<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Línea obligatoria para usar DB

class TeacherSeeder extends Seeder // <-- EN SINGULAR (SIN "S")
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->insert([
            [
                'id_profesor' => 1,
                'nombre' => 'Nombre del Profesor',
                'apellidos' => 'Apellidos del Profesor',
                'especialidad' => 'Especialidad Aquí'
            ]
        ]);
    }
}