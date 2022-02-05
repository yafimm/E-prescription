<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Medicine;

//Facades
use DB;
use Log;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::active()->paginate(20);
        return view('medicine.index', compact('medicines'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function loadData(Request $request)
    {
        if ($request->has('q') && $request->q != '') {
          $search = $request->q;
          $data = DB::table('obatalkes_m')
                      ->select('obatalkes_m.obatalkes_id', 'obatalkes_m.obatalkes_nama', 'obatalkes_m.obatalkes_kode')
                      ->where(DB::raw("CONCAT(obatalkes_kode, ' - ',obatalkes_nama)"), 'LIKE', '%'.$search.'%');

          $data = $data->take(10)->get();
          return response()->json($data);
        }
    }


    public function getMedicine(Request $request)
    {
        try {
          $medicine = Medicine::where('stok', '>', 0)->find($request->medicine_id);
          if($medicine){
            if($medicine->stok > 0){
              return response()->json(['message' => 'Success, Data found', 'status' => true, 'data' => $medicine]);
            }
            return response()->json(['message' => 'Failed, Stock is out', 'status' => false]);
          }
          return response()->json(['message' => 'Failed, Data not found', 'status' => false]);
        } catch (\Exception $e) {
          Log::error($e->getMessage());
          return response()->json(['message' => 'Failed, Something wrong and please contact admin~', 'status' => false]);
        }
    }
}
