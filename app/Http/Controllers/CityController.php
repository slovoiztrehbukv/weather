<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class CityController extends Controller
{
    /**
    * @urlParam q The search query. Example: moscow
    */
    public function list(Request $request)
    {
        $q = $request->get('q') ?? '';
        $cities = \App\Models\City::where('city', 'ILIKE', "%$q%")
            ->take(6)
            ->get();

        return $this->transformCitiesToDropdownList($cities);
    }

    private function transformCitiesToDropdownList(Collection $cities) // TODO TO HELPER SERVICE
    {
        return $cities->map(fn($c)=>[
            'value' => $c['latitude'] . '|' . $c['longitude'],
            'label' => $c['city'] . ', ' . $c['country'],
        ]);
    }
}
