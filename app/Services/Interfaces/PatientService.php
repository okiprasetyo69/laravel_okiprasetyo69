<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface PatientService.
 * 
 * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
 * @since   2024.06.28
 * 
 *
 * @package namespace App\Services\Interfaces;
 */

 interface PatientService {
     /**
     * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
     * @since   2024.06.28
     * Function for handle requests get patient.
     * 
     * @param Illuminate\Support\Facades\Request
     */
    public function getPatient(Request $request);

     /**
     * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
     * @since   2024.06.28
     * Function for handle requests create or update patient.
     * 
     * @param Illuminate\Support\Facades\Request
     */
    public function create(Request $request);

    /**
    * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
    * @since   2024.06.28
    * Function for handle requests patient.
    * 
    * @param Illuminate\Support\Facades\Request
    */
   public function delete(Request $request);

    /**
    * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
     * @since   2024.06.28
    * Function for handle requests patient.
    * 
    * @param Illuminate\Support\Facades\Request
    */
    public function detail(Request $request);
 }