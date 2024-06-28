<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Closure;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Models\Patient;
use App\Services\Interfaces\PatientService;

class PatientController extends Controller
{
    /**
    * @var Patient
    */
    
    private PatientService $service;

    public function __construct(PatientService $service) 
    {
        $this->service = $service;
    }

    // WEB
    public function index(Request $request){
        try{
            return view("patient.index");
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    // API
    public function getPatients(Request $request){
        try{
            $patient = $this->service->getPatient($request);
            if($patient != null){
                return $patient;
            }
            return false;
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function create(Request $request){
        try{
            $validator = Validator::make($request->all(), [ 
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'hospital_id' => 'required'
            ]);

            if($validator->fails()){
                return response()->json([
                    'data' => null,
                    'message' => $validator->errors(),
                    'status' => 422
                ]);
            }

            $patient = $this->service->create($request);
            if($patient){
                return $patient;
            }

        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function detail(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'data' => null,
                    'message' => $validator->errors(),
                    'status' => 422
                ]);
            }

            return $this->service->detail($request);
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function delete(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

            if($validator->fails()){
                return response()->json([
                    'data' => null,
                    'message' => $validator->errors(),
                    'status' => 422
                ]);
            }

            return $this->service->delete($request);
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }
}
