<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class ApiController extends Controller
{
    public function index()
    {
        // the logic of your page will be here


        // as response we will return an array of data
        return [
            'success' => true,
            'message' => 'Response successfully returned.',
            'errors' => [],
            'data' => [
                'class name' => self::class
            ]
        ];
    }
}