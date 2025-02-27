<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Agregar empleados de ejemplo
        Employee::create([
            'name' => 'Daniel Midel Avila',
            'cumplio' => true,
            'foto' => 'images/imagen7.jpg'
        ]);

        Employee::create([
            'name' => 'Francisco Gutierrez Chavez',
            'cumplio' => true,
            'foto' => 'images/imagen4.jpeg'
        ]);

        Employee::create([
            'name' => 'Ricardo Cervantes Escarrega',
            'cumplio' => true,
            'foto' => 'images/imagen6.jpg'
        ]);

        Employee::create([
            'name' => 'Osvaldo',
            'cumplio' => true,
            'foto' => 'foto_carlos.jpg'
        ]);

        Employee::create([
            'name' => 'Victor Manuel Garcia Rojas',
            'cumplio' => true,
            'foto' => 'images/imagen5.jpeg'
        ]);

        Employee::create([
            'name' => 'Jaime Muñoz Ruiz',
            'cumplio' => false,
            'foto' => 'images/imagen8.jpg'
        ]);

        Employee::create([
            'name' => 'María De Jesus Gutierrez Morales',
            'cumplio' => true,
            'foto' => 'images/imagen2.jpeg'
        ]);

        Employee::create([
            'name' => 'Rodrigo Jael Romero Melendez',
            'cumplio' => false,
            'foto' => 'images/imagen3.jpeg'
        ]);

        Employee::create([
            'name' => 'Emmanuel Guadarrama Contreras',
            'cumplio' => true,
            'foto' => 'foto_carlos.jpg'
        ]);

        Employee::create([
            'name' => 'Jaime Mercado Osorio',
            'cumplio' => true,
            'foto' => 'foto_carlos.jpg'
        ]);

        Employee::create([
            'name' => 'Jose Alberto Ortiz Gonzales',
            'cumplio' => true,
            'foto' => 'foto_carlos.jpg'
        ]);

        Employee::create([
            'name' => 'Luis Clodualdo Montesinos Keb',
            'cumplio' => true,
            'foto' => 'foto_carlos.jpg'
        ]);

        
    }
}
