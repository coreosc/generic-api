<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert(array_map(function($value) {
        	return array_merge(['id' => \Ramsey\Uuid\Uuid::uuid4()], $value);
		}, json_decode(file_get_contents(dirname(__FILE__) . '/data/countries.json'), true)));
    }
}
