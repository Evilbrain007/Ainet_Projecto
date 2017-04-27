<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //PARA CORRER:
        //DENTRO DE VAGRANT SSH, ROOT DO PROJECTO:
        //php artisan db:seed
        $this->call(DepartamentsTableSeeder::class);
        $this->call(PrintersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RequestsTableSeeder::class);
    }
}
