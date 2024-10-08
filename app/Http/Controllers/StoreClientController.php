<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreClientController extends Controller
{
    public function cardIDSearch($card_id)
    {

        $response = Hash::make($card_id);


        return response($response);
    }
}
