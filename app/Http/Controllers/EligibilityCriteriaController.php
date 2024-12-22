<?php

namespace App\Http\Controllers;

use App\Models\EligibilityCriteria;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EligibilityCriteriaController extends Controller
{
    public function index()
    {
        $criteria = EligibilityCriteria::all();
        return view('eligibility_criteria.index', compact('criteria'));
    }

    public function getData()
    {
        $criteria = EligibilityCriteria::select([
            'id', 
            'name', 
            'age_less_than', 
            'age_greater_than', 
            'last_login_days_ago', 
            'income_less_than', 
            'income_greater_than'
        ])->get();
    
       
        return datatables()->of($criteria)
            ->addColumn('actions', function ($row) {
                return '
                    <a href="' . route('eligibility-criteria.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                    <form action="' . route('eligibility-criteria.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function create()
    {
        return view('eligibility_criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age_less_than' => 'nullable|integer|min:0',
            'age_greater_than' => 'nullable|integer|min:0',
            'last_login' => 'nullable|date|min:0',
            'income_less_than' => 'nullable|numeric|min:0',
            'income_greater_than' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();

        if (!empty($data['last_login'])) {
            $data['last_login_days_ago'] = Carbon::createFromFormat('Y-m-d\TH:i', $data['last_login'])->format('Y-m-d');
        }
    
        $addData = EligibilityCriteria::create($data);
        if($addData){
            return redirect()->route('eligibility-criteria.index')->with('success', 'Eligibility Criteria created successfully.');

        }else{
            return redirect()->route('eligibility-criteria.index')->with('error', 'something went wrong.');

        }
    }

    public function edit(EligibilityCriteria $eligibilityCriteria)
    {
        return view('eligibility_criteria.edit', compact('eligibilityCriteria'));
    }

    public function update(Request $request,$id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'age_less_than' => 'nullable|integer|min:0',
            'age_greater_than' => 'nullable|integer|min:0',
            'last_login' => 'nullable|date|min:0',
            'income_less_than' => 'nullable|numeric|min:0',
            'income_greater_than' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();

        if (!empty($data['last_login'])) {
            $data['last_login_days_ago'] = Carbon::createFromFormat('Y-m-d\TH:i', $data['last_login'])->format('Y-m-d');
        }

        $existsData  = $eligibilityCriteria = EligibilityCriteria::findOrFail($id);
        if(!$existsData){
            
            return redirect()->route('eligibility-criteria.index')->with('error', 'something went wrong.');

        }
        $addData = $eligibilityCriteria->update($data);

        if($addData){
            return redirect()->route('eligibility-criteria.index')->with('success', 'Eligibility Criteria updated successfully.');

        }else{
            return redirect()->route('eligibility-criteria.index')->with('error', 'something went wrong.');

        }

    }

    public function destroy(EligibilityCriteria $eligibilityCriteria)
    {
        $eligibilityCriteria->delete();
        return redirect()->route('eligibility-criteria.index')->with('success', 'Eligibility Criteria deleted successfully.');
    }
}

