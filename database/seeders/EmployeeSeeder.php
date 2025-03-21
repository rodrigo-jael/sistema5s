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
        Employee::updateOrCreate([
            'name' => 'Daniel Midel Avila',
            'cumplio' => true,
            'foto' => 'images/imagen7.jpg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Francisco Gutierrez Chavez',
            'cumplio' => true,
            'foto' => 'images/imagen4.jpeg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Ricardo Cervantes Escarrega',
            'cumplio' => true,
            'foto' => 'images/imagen6.jpg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Osvaldo Martínez Gómez',
            'cumplio' => true,
            'foto' => 'images/imagen9.jpg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Victor Manuel Garcia Rojas',
            'cumplio' => true,
            'foto' => 'images/imagen5.jpeg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Jaime Muñoz Ruiz',
            'cumplio' => false,
            'foto' => 'images/imagen8.jpg'
        ]);

        Employee::updateOrCreate([
            'name' => 'María De Jesus Gutierrez Morales',
            'cumplio' => true,
            'foto' => 'images/imagen2.jpeg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Rodrigo Jael Romero Melendez',
            'cumplio' => false,
            'foto' => 'images/imagen3.jpeg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Emmanuel Guadarrama Contreras',
            'cumplio' => true,
            'foto' => 'images/imagen10.jpg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Jaime Mercado Osorio',
            'cumplio' => true,
            'foto' => 'images/imagen11.jpg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Jose Alberto Ortiz Gonzales',
            'cumplio' => true,
            'foto' => 'images/imagen12.jpg'
        ]);

        Employee::updateOrCreate([
            'name' => 'Luis Clodualdo Montesinos Keb',
            'cumplio' => true,
            'foto' => 'images/imagen13.jpg'
        ]);

        
    }
}
