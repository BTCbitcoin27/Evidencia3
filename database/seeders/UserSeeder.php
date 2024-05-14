<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Crear usuario para el rol de ventas
        User::create([
            'name' => 'Usuario de Ventas',
            'email' => 'sales@example.com',
            'password' => Hash::make('password'),
            'role' => 'sales',
        ]);

        // Crear usuario para el rol de compras
        User::create([
            'name' => 'Usuario de Compras',
            'email' => 'purchasing@example.com',
            'password' => Hash::make('password'),
            'role' => 'purchasing',
        ]);

        // Crear usuario para el rol de almacén
        User::create([
            'name' => 'Usuario de Almacén',
            'email' => 'warehouse@example.com',
            'password' => Hash::make('password'),
            'role' => 'warehouse',
        ]);

        // Crear usuario para el rol de ruta
        User::create([
            'name' => 'Usuario de Ruta',
            'email' => 'route@example.com',
            'password' => Hash::make('password'),
            'role' => 'route',
        ]);
    }
}
