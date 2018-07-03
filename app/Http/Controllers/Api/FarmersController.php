<?php

namespace App\Http\Controllers\Api;

use App\Farmer;
use App\Http\Resources\FarmersCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FarmersController extends Controller
{
    public function index()
    {
        return new FarmersCollection(Farmer::get());
    }
}