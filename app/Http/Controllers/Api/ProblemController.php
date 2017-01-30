<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Problem;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Valentine
 * Date: 30.01.17
 * Time: 22:59
 */

class ProblemController extends Controller
{

    /**
     * @param Request $request
     * @param int $id
     * @return Problem
     */
    public function show(Request $request, $id) {

        return Problem::findOrFail($id);
    }
}