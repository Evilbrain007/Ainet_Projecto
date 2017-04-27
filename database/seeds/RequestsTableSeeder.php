<?php

use Illuminate\Database\Seeder;

class RequestsTableSeeder extends Seeder
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
        //php artisan db:seed --class=RequestsTableSeeder
        factory(App\PrintRequest::class, 10)->create()->each(function ($u) {
            $u->save();
        });
    }
}
