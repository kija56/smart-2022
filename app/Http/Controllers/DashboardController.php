<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q ?? 'Tanzania';
        $data = $this->countryData($q);
        $countries = $this->getCountries();
        return view('dashboard', \compact('data', 'countries', 'q'));
    }

    
    public function countryData($country)
    {
        $data = Country::join('records', 'records.country_id', 'countries.id')
            ->when(!is_null($country), function ($q) use ($country) {
                $q->where('name', $country);
            })
            ->orderBy('year', 'asc')
            ->get()
            ->map(function ($record) {

                return [
                    $record->year,
                    $record->life_expectancy
                ];
            })
            ->values()
            ->toArray();

        return json_encode($data);
    }

    public function getCountries()
    {
        return Country::orderBy('name', 'asc')->pluck('name');
    }


}
