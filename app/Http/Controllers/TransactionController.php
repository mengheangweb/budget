<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::paginate(5);

        return view('transaction.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('transaction.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required',
            'amount' => 'required|numeric|max:2000'
        ]);

       Transaction::create([
            'category_id' => $request->category,
            'date' => $request->date,
            'description' => $request->description,
            'amount' => $request->amount
        ]);

        return redirect('/transaction/create')->with('message', "Added successfully");
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('transaction.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $this->validate($request,[
            'category_id' => $request->category,
            'category' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required',
            'amount' => 'required|numeric|max:2000'
        ]);

       Transaction::whereId($id)->update([
            'date' => $request->date,
            'description' => $request->description,
            'amount' => $request->amount
        ]);

        return redirect('/transaction')->with('message', "Edited successfully");
    }

    public function delete($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect('/transaction')->with('message', "Deleted successfully");
    }
}
