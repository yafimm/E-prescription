<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if(!function_exists('HelperSetPrescriptionCode')) {
    function HelperSetPrescriptionCode() {
        $code = 'PSCT/'.date('ymd').'/';
        $lastCode = DB::table('prescriptions')->where('code','like', $code.'%')->orderBy('id', 'DESC')->first();
        if($lastCode){
            $count = substr($lastCode->code, 12);
            $count++;
            if(strlen($count) == 1){
                $count='00'.$count;
            }
            else if(strlen($count) == 2){
                $count='0'.$count;
            }
            else{
                $count = $count;
            }
            if($count)
                $code .= $count;
            }else{
                $code .= '001';
            }
        return $code;
    }
}

if(!function_exists('HelperRupiahFormat')) {
    function HelperRupiahFormat($value) {
        return 'Rp '. number_format($value, 0, ',', '.');
    }
}

if(!function_exists('HelperStringToFloat')) {
    // From string to float
    function HelperStringToFloat($value) {
        return $value != null ? (float) str_replace(',', '.', str_replace('.', '', $value)) : 0;
    }
}

if(!function_exists('HelperPhoneReadable')) {
    function HelperPhoneReadable($value) {
        return number_format($value, 0);
    }
}

if(!function_exists('HelperCollectionsAreEqual')) {
  function HelperCollectionsAreEqual($collection1, $collection2)
  {
      if ($collection1->count() != $collection2->count()) {
          return false;
      }
      //assuming that, from each id, you don't have more that one item:
      $collection2 = $collection2->keyBy('id');
      foreach ($collection1->keyBy('id') as $id => $item) {
          dd($collection2[$id], $item);
          if (!isset($collection2[$id])) {
              return false;
          }
          //your items in the collection are key value arrays
          // and can compare them with == operator
          if ($collection2[$id] != $item) {
              return false;
          }
      }
      return true;

  }
}
