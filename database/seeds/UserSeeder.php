<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //check if table users is empty
        if(DB::table('users')->get()->count() == 0){

            DB::table('users')->insert([
                [
                    'id'                   => 1,
                    'document_type_id'     => 1,
                    'document_number'      => '1144056571',
                    'country_id_origin'    => 49,
                    'department_id_origin' => 1277,
                    'city_id_origin'       => 2259,
                    'rol_id'               => 1,
                    'user_id_otros'        => 3,
                    'nit'                  => '900467785',
                    'license_id'           => 999,
                    'username'             => 'wilson.majin',
                    'name_1'               => 'Wilson',
                    'name_2'               => 'Andres',
                    'surname_1'            => 'Majin',
                    'surname_2'            => 'Montenegro',
                    'birthdate'            => '1992-10-26',
                    'password'             => bcrypt('123'),
                    'email'                => 'andresmajin7@gmail.com',
                    'support'              => 1,
                    'app_id'               => 0,
                    'active'               => 1,
                    'validated'            => 1,
                    'remember_token'       => NULL,
                    'api_token'            => NULL,
                    'created_at'           => NULL,
                    'updated_at'           => NULL,
                ]

            ]);

        } else { echo "Error, la tabla contiene datos"; }
    }
}
