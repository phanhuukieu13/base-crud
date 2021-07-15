<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1000)->create();
    }
}
