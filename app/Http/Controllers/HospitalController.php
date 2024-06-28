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

use App\Models\Hospital;
use App\Services\Interfaces\HospitalService;

class HospitalController extends Controller
{
    /**
    * @var Hospital
    */
    
    private HospitalService $service;

    public function __construct(HospitalService $service) 
    {
        $this->service = $service;
    }


    // WEB
    public function index(Request $request){
        try{
            return view("hospital.index");
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    // API
    public function getHospitals(Request $request){
        try{
            $hospitals = $this->service->getHospital($request);
            if($hospitals != null){
                return $hospitals;
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
                'email' => 'required|email',
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required'
            ]);

            if($validator->fails()){
                return response()->json([
                    'data' => null,
                    'message' => $validator->errors(),
                    'status' => 422
                ]);
            }

            $hospital = $this->service->create($request);
            if($hospital){
                return $hospital;
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
