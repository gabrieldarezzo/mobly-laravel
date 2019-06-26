<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('users')->insert([
            'name' => 'Darezzo',
            'username' => 'gabrieldarezzo',
            'phone' => '+55 (11) 94707-4677',
            'website' => 'https://inwork.com.br',
            'email' => 'darezzo.gabriel@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        */

        // http://jsonplaceholder.typicode.com/users
        $json = json_decode(\Illuminate\Support\Facades\Storage::get('json/users.json'), true);
        foreach($json as $row) {
            unset($row['address']);
            unset($row['company']);
            $row['email_verified_at'] = now();
            $row['remember_token'] = Str::random(10);
            DB::table('users')->insert($row);
        }

    }
}
