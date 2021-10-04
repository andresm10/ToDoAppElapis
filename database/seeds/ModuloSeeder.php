<?php

use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('modulos')->insert([
	                [
						'description' =>'Usuarios',
						'min_icon'    =>'people',
						'big_icon'    =>'',
						'link'        =>'users',
						'active'      => 1
	                ],
	                [
						'description' =>'Categorias',
						'min_icon'    =>'star',
						'big_icon'    =>'',
						'link'        =>'categorias',
						'active'      => 1
	                ],
	                [
						'description' =>'Actividades',
						'min_icon'    =>'checklist',
						'big_icon'    =>'',
						'link'        =>'actividades',
						'active'      => 1
	                ]
	            ]);

    }
}
