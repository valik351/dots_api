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
        $response = [];

        foreach (ProgrammingLanguage::all() as $language) {
            $response[] = [
                'id'             => $language->id,
                'title'          => $language->name,
                'compiler_image' => $language->compiler_image,
                'executor_image' => $language->executor_image,
            ];
        }

        return $response;
    }
}
