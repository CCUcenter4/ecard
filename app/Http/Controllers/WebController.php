<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Card;
use App\Ecard\Person;


/*
 **/

use Mail;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index(Request $request){
      return view('web.index');
    }

    public function festival(){
      return view('web.festival');
    }

    public function complex($group){
      return view('web.complex')
        ->with('group', $group);
    }

    public function school($group){
      $school_list = Card::getGroupList(1);
      for($i=0; $i<count($school_list); $i++){
        if($school_list[$i]->group==$group){
          $now_year = $i+20;
          break;
        }
      }

      $popular = Card::getPopularList(1, $group);

      return view('web.school')
        ->with('group', $group)
        ->with('now_year', $now_year)
        ->with('school_list', $school_list)
        ->with('popular', $popular);
    }


    public function edit($id){
      $card = Card::getCardDetail($id);

      $exist = false;
      if($card===null){
        return view('errors.cardIDError');
      }

      $exist = true;
      if($card->file_type===null)
        $exist = false;

      if(Auth::check()){
        $person = Person::getPersonInfo();

        return view('web.edit')
          ->with('exist',     $exist)
          ->with('id',        $card->id)
          ->with('category',  $card->category)
          ->with('group',     $card->group)
          ->with('file_type', $card->file_type)
          ->with('name',      $card->name)
          ->with('use_times', $card->use_times)
          ->with('person',    $person);
      }else{
        return view('web.edit')
          ->with('exist',     $exist)
          ->with('id',        $card->id)
          ->with('category',  $card->category)
          ->with('group',     $card->group)
          ->with('file_type', $card->file_type)
          ->with('name',      $card->name)
          ->with('use_times', $card->use_times);
      }
    }

    public function goBack($category, $group){

      if($category==0)
        return $this->festival($group);
      else if($category==1)
        return $this->school($group);
      else if($category==4)
        return $this->complex($group);

      /*
      else if($category==2)
        return $this->self();
      else if($category==3)
        return $this->user();
      */
    }

    public function person(){
      if(Auth::check()){
        $personal_info = Person::getPersonInfo();
        return view('web.person')
          ->with('personal_info', $personal_info);
      }else{
        return view('web.person');
      }
    }

    public function authRegister(Request $request){
      return view('web.authRegister')
        ->with('token', $request->input('auth'));
    }

    public function viewFlashCard(Request $request){
      return view('web.viewFlashCard')
        ->with('from_name', $request->input('from_name'))
        ->with('from_email', $request->input('from_email'))
        ->with('to_name', $request->input('to_name'))
        ->with('to_email', $request->input('to_email'))
        ->with('id', $request->input('id'))
        ->with('content', $request->input('content'));
    }

    public function questionnaire(){
      return view('web.questionnaire');
    }
}
