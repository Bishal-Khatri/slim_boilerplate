<?php
namespace App\Controllers;

use App\Models\LetzgoApplication;
//use http\Env\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Helpers\ResponseHelper;

class TestController
{

    public function index()
    {
        $data = LetzgoApplication::all();
        dd($data);
    }

    public function store(Request $request)
    {
        // get GET params
        dd($request->getQueryParams());

        // get POST/PUT params
        dd($request->getParsedBody());
    }

    public function test(Request $request, Response $response)
    {
        $data = LetzgoApplication::first();
        $responseData = ResponseHelper::setResponse('success','Listing Successful',$data,date('Y-m-d H:i:s'));

        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write($responseData);
    }
}