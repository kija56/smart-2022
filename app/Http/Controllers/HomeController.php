<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Country::ageAverage();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('dashboard', ['q'=>$row->name]) . '" class="px-2 py-1 text-white text-xs bg-[#FF0D33] rounded-sm">View </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('welcome');
    }

    public function dashboard(){
        
        return view('dashboard');
    }
}
