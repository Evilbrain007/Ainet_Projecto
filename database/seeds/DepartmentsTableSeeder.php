<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
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
        //php artisan db:seed --class=~DepartmentsTableSeeder
        factory(App\Department::class, 10)->create()->each(function ($u) {
            $u->save();
        });
    }
}
