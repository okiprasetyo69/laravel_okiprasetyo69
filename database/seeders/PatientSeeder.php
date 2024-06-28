<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patient = [
            [
                'name'=>'Asep Somantri',
                'address'=>'Cicendo, Bandung',
                'phone' => '(022) 4248333',
                'hospital_id' => 1
            ],
            [
                'name'=>'Yudi Setiawan',
                'address'=> ' Jl. Pasteur No.100, Pasteur, Kec. Sukajadi, Kota Bandung,',
                'phone' => '(022) 2034953',
                'hospital_id' => 2
            ], 
            [
                'name'=>'Sukirman',
                'address'=> 'Jl. Rumah Sakit No.125, Pakemitan, Kec. Cinambo, Kota Bandung',
                'phone' => '(022) 7811794',
                'hospital_id' => 3
            ], 
            [
                'name'=>'Riman',
                'address'=> 'Jl. Ir. H. Juanda No.200, Lebakgede, Kecamatan Coblong, Kota Bandung,',
                'phone' => '(022) 2552000',
                'hospital_id' => 4
            ], 
            [
                'name'=>'Megawati',
                'address'=> 'Jl. Terusan Buah Batu No.100, Batununggal, Kec. Bandung Kidul, Kota Bandung',
                'phone' => '(022) 86023777',
                'hospital_id' => 5
            ], 
        ];
  
        foreach ($patient as $key => $value) {
            Patient::create($value);
        }
    }
}
