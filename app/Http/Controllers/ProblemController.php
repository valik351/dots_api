<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Returns a problem's archive
     * 
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function getArchive(Request $request, $id)
    {
        return response()->download(Problem::findOrFail($id)->getArchivePath());
    }
}
 