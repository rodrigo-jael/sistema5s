<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;

class EquipoSeeder extends Seeder
{
    public function run()
    {
        $equipos = [
            [
                'nombre' => 'Monitor de 17 pulg',
                'ubicacion' => 'Oficina',
                'imagen' => 'images/Monitor1.png',
                'consumo_promedio' => 0.315, // kWh por 9 horas
                'lunes' => false,
                'martes' => false,
                'miercoles' => false,
                'jueves' => false,
                'viernes' => false,
                'sabado' => false,
                'domingo' => false,
            ],
            [
                'nombre' => 'CPU Hp Mini torre fuente de 500',
                'ubicacion' => 'Oficina',
                'imagen' => 'equipos/CPUHpminitorre.jpeg',
                'consumo_promedio' => 1.35,
                'lunes' => false,
                'martes' => false,
                'miercoles' => false,
                'jueves' => false,
                'viernes' => false,
                'sabado' => false,
                'domingo' => false,
            ]
            

        ];

        foreach ($equipos as &$equipo) {
            $equipo['dias_utilizados'] = 0; // Inicialmente en 0 porque se marcarán manualmente
            $equipo['consumo_total'] = 0; // Se calculará después según los días marcados
        }

        Equipo::insert($equipos);
    }
}
