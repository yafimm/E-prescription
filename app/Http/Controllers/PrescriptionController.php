<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\PrescriptionItemDetail;
use App\Models\Patient;
use App\Models\Medicine;

//Facades
use DB;
use Log;
use Auth;

class PrescriptionController extends Controller
{

    public function index()
    {
        $prescriptions = Prescription::paginate(20);
        return view('prescription.index', compact('prescriptions'));
    }


    public function create()
    {
        $prescription = new Prescription;
        return view('prescription.create', compact('prescription'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
          $prescription = Prescription::create();
          $patient      = Patient::create([
                            'name' => $request->patient_name,
                            'age'  => $request->patient_age,
                            'gender' => $request->patient_gender,
                            'prescription_id' => $prescription->id,
                          ]);

          foreach ($request->prescription_items as $key => $item) {
            $prescription_item = PrescriptionItem::create([
                                    'prescription_id' => $prescription->id,
                                    'signa_id'        => $item['signa']['id'],
                                    'name'            => $item['name'],
                                    'qty'             => $item['qty'],
                                    'type'            => $item['type'],
                                ]);

            foreach ($item['medicines'] as $key => $medicine) {
              $prescription_item_detail = PrescriptionItemDetail::create([
                                            'prescription_item_id' => $prescription_item->id,
                                            'obatalkes_id'         => $medicine['id'],
                                            'qty'                  => $medicine['qty'],
                                          ]);

              //Pengeurangan stok
              $medicine = Medicine::find($medicine['id']);
              $medicine->update(['stok' => $medicine->stok - ($item['qty'] - $medicine['qty'])]);
            }
          }
          DB::commit();
          return response()->json(['message' => 'Success, Data stored', 'status' => true]);

        } catch (\Exception $e) {
          DB::rollback();
          Log::error('Error Sistem :'.$e->getMessage());
          return response()->json(['message' => 'Failed, Something wrong', 'status' => false], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
