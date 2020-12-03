<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SizeController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::all();
        // dd($productCategories);

        return Inertia::render('AddNewSize');
    }

    public function store(Request $request)
    {
        $messages = [
            'unique' => 'Size Exists',
            'regex' => 'Invalid Size. The size should not have spaces in between the characters.
                         Small letter x should be used instead of *. 
                         The unit should be in inches written as (in)'
        ];

        $this->validate($request, ([
            'name' => ['required', 'unique:sizes', 
                        'regex:/^[0-9]{1,2}[in]+[x]+[0-9]{1,2}[in]+[x]+[0-9]{1,2}[in]{2}/m'],
        ]), $messages);

        Auth::user()->sizes()->create([
            'name' => $request->name
        ]);

        return redirect('/addNewSize');
    }
}
