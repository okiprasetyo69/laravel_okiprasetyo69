<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface UserService.
 * 
 * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
 * @since   2024.06.28
 * 
 *
 * @package namespace App\Services\Interfaces;
 */

 interface HospitalService {
     /**
     * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
     * @since   2024.06.28
     * Function for handle requests get hospitals.
     * 
     * @param Illuminate\Support\Facades\Request
     */
    public function getHospital(Request $request);

     /**
     * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
     * @since   2024.06.28
     * Function for handle requests create or update hospitals.
     * 
     * @param Illuminate\Support\Facades\Request
     */
    public function create(Request $request);

    /**
    * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
    * @since   2024.06.28
    * Function for handle requests hospitals.
    * 
    * @param Illuminate\Support\Facades\Request
    */
   public function delete(Request $request);

    /**
    * @author Oki Prasetyo <oki.prasetyo45@gmail.com>
     * @since   2024.06.28
    * Function for handle requests hospitals.
    * 
    * @param Illuminate\Support\Facades\Request
    */
    public function detail(Request $request);

 }