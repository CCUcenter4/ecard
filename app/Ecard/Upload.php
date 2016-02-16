<?php namespace App\Ecard;

use Illuminate\Http\Request;
use DB;
use Storage;


class Upload{
    static public function thumbFile($id, $tmpname){
        $from = $tmpname;
        $to   = public_path().'/card/thumb/'.$id;
        $result = move_uploaded_file($from, $to);

        return $result;
    }

    static public function webFile($id, $tmpname){
        $from = $tmpname;
        $to   = public_path().'/card/web/'.$id;
        $result = move_uploaded_file($from, $to);

        return $result;
    }
}
