<?php

use Illuminate\Database\Seeder;

class TopicAndCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topic')->insert([
            'title' => 'Welcome to Webboard',
            'body' => 'Welcome to Webboard - Test test test',
            'user_id' => 1,
            'status' => 2,
        ]);

        DB::table('comment')->insert([
            'body' => 'Hello world',
            'user_id' => 1,
            'topic_id' => 1,
            'status' => 1,
        ]);
    }
}
