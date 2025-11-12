<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            ['user_id' => 1, 'first_name' => 'Example1', 'last_name' => 'Example2', 'email' => 'example@gmail.com', 'phone'=>'123456789','company'=>'maxcom','note'=>'example example'],
            ['user_id' => 1, 'first_name' => 'lol', 'last_name' => 'exa', 'email' => 'example321@gmail.com', 'phone'=>'0923789','company'=>'maxcom','note'=>'example example'],
        ]);
    }
}
