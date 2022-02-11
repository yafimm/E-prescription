<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Signa;

// Facade
use DB;

class SignaController extends Controller
{

    public function ind ex()
    {
        $signas = Signa::active()->paginate(20);
        return view('signa.index', compact('signas'));
    }


    public function create()
    {

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
            $data = DB::table('signa_m')->select('signa_m.signa_id', 'signa_m.signa_nama', 'signa_m.signa_kode')
                                        ->where(DB::raw("CONCAT(signa_kode, ' - ',signa_nama)"), 'LIKE', '%'.$search.'%');


            $data = $data->take(10)->get();
            return response()->json($data);
       }
   }


   public function getSigna(Request $request)
   {
        $product = Product::with('product_sizes', 'product_sizes.size:id,name', 'product_sizes.product_child:id,name', 'category:id,name', 'productImage')->find($request->product_id);
        if($product){
            return response()->json($product);
        }
        return response()->json(['message' => 'Failed, Data not found', 'status' => false]);
   }
}
