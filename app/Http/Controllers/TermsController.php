<?php

namespace App\Http\Controllers;

use App\Business\DataAccess;
use App\models\Term;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*
     * Display the list of clients
     */
    public function index()
    {
        $dataAccess = new DataAccess();
        $terms = $dataAccess->getTerms();

        if (\Request::has('search')) {
            $query = \Request::get('search');

            $results = Term::where('name', 'LIKE', '%'.$query.'%')
                ->get();

            return \View::make('termslist')->with('terms', $results);
        }

        return \View::make('termslist')->with('terms',$terms);
    }

    /*
     * Create new client record
     */
    public function create()
    {

    }
}