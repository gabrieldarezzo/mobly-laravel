<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
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
            $row['address']['user_id'] = $row['id'];
            $row['address']['lat'] = $row['address']['geo']['lat'];
            $row['address']['lng'] = $row['address']['geo']['lat'];
            unset($row['address']['geo']);
            DB::table('address')->insert($row['address']);
        }
    }
}
