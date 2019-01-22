<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(User::class,10)->create();
    }
}
