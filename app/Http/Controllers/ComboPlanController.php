<?php

namespace App\Http\Controllers;

use App\Models\ComboPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class ComboPlanController extends Controller
{
    public function index()
    {
        
        return view('combo_plans.index');
    }

    public function getData()
    {
        $comboPlans = ComboPlan::with('plans')->select(['id', 'name', 'price']);
        return datatables()->of($comboPlans)
            ->addColumn('plans', function ($row) {
                return $row->plans->pluck('name')->implode(', ');
            })
            ->addColumn('actions', function ($row) {
                return '
                    <a href="' . route('combo-plans.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
                    <form action="' . route('combo-plans.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    
    public function create()
    {
        $plans = Plan::all();
        return view('combo_plans.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'plans' => 'required|array',
        ]);

        $comboPlan = ComboPlan::create($request->only(['name', 'price']));
        $comboPlan->plans()->attach($request->plans);

        return redirect()->route('combo-plans.index')->with('success', 'Combo Plan created successfully.');
    }

    public function edit(ComboPlan $comboPlan)
    {
        $comboPlan->load('plans');
        return view('combo_plans.edit', compact('comboPlan'));
    }

    public function update(Request $request, ComboPlan $comboPlan)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'plans' => 'required|array',
        ]);

        $comboPlan->update($request->only(['name', 'price']));
        $comboPlan->plans()->sync($request->plans);

        return redirect()->route('combo-plans.index')->with('success', 'Combo Plan updated successfully.');
    }

    public function destroy(ComboPlan $comboPlan)
    {
        $comboPlan->delete();
        return redirect()->route('combo-plans.index')->with('success', 'Combo Plan deleted successfully.');
    }
}
