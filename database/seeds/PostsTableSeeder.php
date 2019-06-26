<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // http://jsonplaceholder.typicode.com/posts
        $postsData = json_decode(\Illuminate\Support\Facades\Storage::get('json/posts.json'), true);

        $address = [];
        foreach($postsData as $row) {
            $row['user_id'] = $row['userId'];
            unset($row['userId']);

            DB::table('posts')->insert($row);
        }
    }
}
