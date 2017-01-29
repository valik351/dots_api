<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\ProgrammingLanguage;
use Illuminate\Http\Request;

class ProgrammingLanguagesController extends Controller
{
    /**
     * Returns all programming languages
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        return ProgrammingLanguage::all();
    }
}
