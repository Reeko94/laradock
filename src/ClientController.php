<?php

namespace Scolabs\Docker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $result = 4;
        return view('docker::index',compact('result'));
    }
}
