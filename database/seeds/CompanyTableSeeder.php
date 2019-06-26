<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // http://jsonplaceholder.typicode.com/users
        $usersData = json_decode(\Illuminate\Support\Facades\Storage::get('json/users.json'), true);

        $address = [];
        foreach($usersData as $row) {
            $row['company']['user_id'] = $row['id'];
            DB::table('company')->insert($row['company']);
        }
    }
}
