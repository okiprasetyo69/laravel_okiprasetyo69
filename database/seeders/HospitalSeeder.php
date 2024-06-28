<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospital;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospital = [
            [
                'name'=>'Santosa Hospital Bandung Central',
                'address'=>'Jl. Kebon Jati No.38',
                'phone' => '(022) 4248333',
                'email'=>'humas@santosa-hospital.com',
            ],
            [
                'name'=>' RSUP Dr. Hasan Sadikin Bandung',
                'address'=> ' Jl. Pasteur No.38, Pasteur, Kec. Sukajadi, Kota Bandung,',
                'phone' => '(022) 2034953',
                'email'=>'humas@rshs-hospital.com',
            ], 
            [
                'name'=>'RSUD Kota Bandung',
                'address'=> 'Jl. Rumah Sakit No.22, Pakemitan, Kec. Cinambo, Kota Bandung',
                'phone' => '(022) 7811794',
                'email'=>'humas@rsudkota-bandung.com',
            ], 
            [
                'name'=>' Rumah Sakit Santo Borromeus Bandung',
                'address'=> 'Jl. Ir. H. Juanda No.100, Lebakgede, Kecamatan Coblong, Kota Bandung,',
                'phone' => '(022) 2552000',
                'email'=>'humas@borromeus-hospital.com',
            ], 
            [
                'name'=>'Mayapada Hospital Bandung',
                'address'=> 'Jl. Terusan Buah Batu No.5, Batununggal, Kec. Bandung Kidul, Kota Bandung',
                'phone' => '(022) 86023777',
                'email'=>'humas@mayapada-hospital.com',
            ], 
        ];
  
        foreach ($hospital as $key => $value) {
            Hospital::create($value);
        }
    }
}
