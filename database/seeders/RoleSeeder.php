<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // ← IMPORTANTE: Agrega esta línea

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
     
         public function run()
         {
             Role::create(['name' => 'admin']);
             Role::create(['name' => 'employee']);
         }
     
     
}
