<?php
/**
 * Created by PhpStorm.
 * User: johnlarmie
 * Date: 2016-03-18
 * Time: 9:46 AM
 */

namespace app\Business;

use Hash;
use Auth;
use App\models\ClientList;
use App\models\users;
use App\models\calendar;
use App\models\visits;
use App\models\requests;
use App\models\Note;
use App\models\Term;
use App\models\Medication;
use App\User;
use DB;

class MedMng
{
    function requestSave($list)
    {
        requests::create($list);
    }

    function requestUpdate($list, $id)
    {
        try {

            $requestCheck = requests::where('id', '=', $id)->firstOrFail();
            requests::where('id', $id)
                ->update($list);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            //create new request
            $request = requests::firstOrCreate($list);
        }
    }

    function getRequests($email)
    {
        $data = null;
        if ($email) {
            $data = requests::where('email', '=', $email)->orderBy('created_at', 'desc')->get();
        }
        else{
            $data = requests::where('status', '=', "pending")->orderBy('created_at', 'desc')->get();
        }
        return $data;
    }

    function getTerms()
    {
        $terms = Term::all()->sortBy('name');
        return $terms;
    }

    function getMedications()
    {
        return Medication::all()->sortBy('name');
    }

    function saveMedications($name,$quantity)
    {
        $list = [
            'name' => $name,
            'quantity' => $quantity
        ];
        try{
            $medication = Medication::where('name','=',$name)->firstOrFail();
            $medication->quantity += $quantity;
            $medication->save();
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $medication = Medication::firstOrCreate($list);
        }

    }

    function search($query)
    {
        return Medication::where('name', 'LIKE', '%'.$query.'%')
            ->get();
    }
}