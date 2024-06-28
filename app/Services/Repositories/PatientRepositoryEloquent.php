<?php

namespace App\Services\Repositories;

use App\Models\Patient;
use App\Services\Interfaces\PatientService;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PatientRepositoryEloquent.
 * 
 * @author  Oki Prasetyo  <oki.prasetyo45@gmail.com>
 * @since   2024.06.28
 * 
 *
 * @package namespace App\Services\Repositories;
 */

 class PatientRepositoryEloquent implements PatientService {

     /**
     * @var Patient
     */
    private Patient $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function getPatient(Request $request){
        try{
            
            $patient = $this->patient::with("hospital")->orderBy('name', 'ASC');

            if($request->name != null){
                $patient = $patient->where("name", "like", "%" . $request->name. "%");
            }

            if($request->hospital_id != null){
                $patient = $patient->where("hospital_id", $request->hospital_id);
            }

            $patient = $patient->get();

            $datatables = Datatables::of($patient);
            return $datatables->make( true );

          
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
         }
    }

    public function create(Request $request){
        try{
            $patient = $this->patient;
            $patient->fill($request->all());

            if($request->id != null){
                $patient = $patient::find($request->id);
            }

            $patient->name = $request->name;
            $patient->address = $request->address;
            $patient->phone = $request->phone;
            $patient->hospital_id = $request->hospital_id;

            $patient->save();

            return response()->json([
                'status' => 200,
                'message' => true,
                'data' => $patient
            ]); 
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function delete(Request $request){
        try{
            
            $patient = $this->patient::where("id", $request->id)->first();
            if($patient == null){
                return response()->json([
                    'data' => null,
                    'message' => 'Data not found',
                    'status' => 400
                ]);
            }

            $patient->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Success delete patient.',
            ]);

        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function detail(Request $request){
        try{
            $patient = $this->patient::where("id", $request->id)->first();
            return response()->json([
                'status' => 200,
                'message' => true,
                'data' => $patient
            ]);
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

 }  