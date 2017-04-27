<?php

use Illuminate\Database\Seeder;

class DepartamentsTableSeeder extends Seeder
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
        //php artisan db:seed --class=~PrintersTableSeeder
        factory(App\Departament::class, 10)->create()->each(function ($u) {
            $u->save();
        });
    }
}
