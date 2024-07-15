<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_user = new User;
        $admin_user->name = 'Safae Bouziani';
        $admin_user->email = 'safima234@gmail.com';
        $admin_user->password = Hash::make('safae2004');
        $admin_user->save();

        $admin_user->assignRole('admin');
    }
}
