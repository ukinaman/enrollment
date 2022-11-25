<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('backend.accounting.discount.index', compact('discounts'));
    }

    public function create()
    {
        return view('backend.accounting.discount.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'percentage' => 'required|numeric'
        ]);

        Discount::create($data);

        return redirect()->route('discount.index')->with('success', 'Discount saved successfully!');
    }

    public function edit($id)
    {
        $discount = Discount::find($id);
        return view('backend.accounting.discount.edit', compact('discount'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'percentage' => 'required|numeric'
        ]);

        Discount::where('id','=',$id)->update($data);

        return redirect()->route('discount.index')->with('success', 'Discount saved successfully!');
    }

    public function destroy($id)
    {
        $discount = Discount::find($id);
        $discount->delete();
        return redirect()->route('discount.index')->with('delete', 'Data deleted successfully!');
    }
}
