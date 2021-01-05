<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Tag;
use Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('timeRestrict');
    }

    public function index(Request $request)
    {
        $auth = Auth::user();

        $search = $request->search;

        $query = Transaction::query();

        if($search)
        {
            $query->where('description','like',"%{$search}%");
            $query->OrWhere('amount','like',"%{$search}%");
        }

        $transactions = $query->paginate(5);

        $trashed = Transaction::onlyTrashed()->get();

        return view('transaction.index', compact('transactions', 'trashed'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('transaction.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required',
            'amount' => 'required|numeric|max:2000',
            'tag' => 'required'
        ]);

        $transaction = Transaction::create([
                        'category_id' => $request->category,
                        'date' => $request->date,
                        'description' => $request->description,
                        'amount' => $request->amount
                    ]);

        $transaction->tag()->attach($request->tag);

        return redirect('/transaction/create')->with('message', "Added successfully");
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $checked = $transaction->tag->pluck('id')->toArray();

        return view('transaction.edit', compact('transaction', 'categories', 'tags','checked'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $this->validate($request,[
            'category' => 'required',
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required',
            'amount' => 'required|numeric|max:2000'
        ]);

       Transaction::whereId($id)->update([
            'category_id' => $request->category,
            'date' => $request->date,
            'description' => $request->description,
            'amount' => $request->amount
        ]);

        $transaction->tag()->sync($request->tag);

        return redirect('/transaction?page='. $request->page)->with('message', "Edited successfully");
    }

    public function delete($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect('/transaction')->with('message', "Deleted successfully");
    }

    public function restore($id)
    {
        $transaction = Transaction::withTrashed()->whereId($id)->first();

        $transaction->restore();

        return redirect('/transaction')->with('message', "Restored successfully");
    }
}
