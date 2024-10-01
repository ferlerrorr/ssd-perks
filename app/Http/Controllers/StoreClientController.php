<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreClientController extends Controller
{
    public function cardIDSearch($card_id)
    {
        return response($card_id);
    }
}
