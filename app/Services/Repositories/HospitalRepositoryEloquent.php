<?php

namespace App\Services\Repositories;

use App\Models\Hospital;
use App\Services\Interfaces\HospitalService;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class HospitalRepositoryEloquent.
 * 
 * @author  Oki Prasetyo  <oki.prasetyo45@gmail.com>
 * @since   2024.06.28
 * 
 *
 * @package namespace App\Services\Repositories;
 */

 class HospitalRepositoryEloquent implements HospitalService {

     /**
     * @var Hospital
     */
    private Hospital $hospital;

    public function __construct(Hospital $hospital)
    {
        $this->hospital = $hospital;
    }

    public function getHospital(Request $request){
        try{
            
            $hospital = $this->hospital::orderBy('name', 'ASC');

            if($request->name != null){
                $hospital->where("name", "like", "%" . $request->name. "%");
            }

            $hospital = $hospital->get();

            $datatables = Datatables::of($hospital);
            return $datatables->make( true );

          
        }
        catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
         }
    }

    public function create(Request $request){
        try{
            $hospital = $this->hospital;
            $hospital->fill($request->all());

            if($request->id != null){
                $hospital = $hospital::find($request->id);
            }

            $hospital->name = $request->name;
            $hospital->address = $request->address;
            $hospital->phone = $request->phone;
            $hospital->email = $request->email;

            $hospital->save();

            return response()->json([
                'status' => 200,
                'message' => true,
                'data' => $hospital
            ]); 
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function delete(Request $request){
        try{
            $hospital = $this->hospital::where("id", $request->id)->first();
            if($hospital == null){
                return response()->json([
                    'data' => null,
                    'message' => 'Data not found',
                    'status' => 400
                ]);
            }

            $hospital->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Success delete hospital.',
            ]);

        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function detail(Request $request){
        try{
            $hospital = $this->hospital::where("id", $request->id)->first();
            return response()->json([
                'status' => 200,
                'message' => true,
                'data' => $hospital
            ]);
        }catch(Exception $ex){
            Log::error($ex->getMessage());
            return false;
        }
    }

 }  