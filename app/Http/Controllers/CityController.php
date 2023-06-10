<?php

namespace App\Http\Controllers;

use App\Services\Weather\Table\Helper;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
    * @urlParam q The search query. Example: moscow
    */
    public function list(Request $request)
    {
        // TODO to repository service
        $q = $request->get('q') ?? '';
        $cities = \App\Models\City::where('name', 'ILIKE', "%$q%")
            ->take(6)
            ->get();

        return Helper::transformCitiesToDropdownList($cities);
    }
}
