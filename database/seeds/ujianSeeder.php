<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ujianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 10; $i++){
            DB::table('ujian')->insert([
                "dosen" => $faker->name(),
                "nama_mk" => "Matakul " . $i,
                "jumlah_soal" => $faker->randomNumber(2),
                "keterangan" => $faker->text(100),               

            ]);
        }

    }
}
