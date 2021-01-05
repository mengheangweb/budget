
@extends('layouts.app')

@section('content')
    <h1 class="display-6m">Transaction Edit</h1>
    <a href="/transaction" class="btn btn-primary mb-5">List</a>

    <div class="row">
        <div class="col-sm-6">

            @include('component.message')
            @include('component.error')

            <form action="/transaction/update/{{ $transaction->id }}?page={{ request()->page }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="date">Category</label>
                    <select name="category" class="form-control">
                        <option>--Choose--</option>
                        @foreach($categories as $category)
                            @if(old('category', $transaction->category_id) == $category->id)
                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                <label for="date">Date</label>
                <input value="{{ old('date', $transaction->date) }}" type="date" name="date" class="form-control" id="date" placeholder="Enter Date">
                </div>
                <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" placeholder="Input Description">{{ old('description', $transaction->description) }}</textarea>
                </div>
                <div class="form-group  mb-3">
                    <label for="amount">Amount</label>
                    <input value="{{ old('amount', $transaction->amount) }}" type="amount" name="amount" class="form-control" id="amount" placeholder="Enter Amount">
                </div>
                <div class="form-group  mb-3">
                    <label for="amount">Tag</label>
                    @foreach($tags as $tag)
                    <div class="form-check">
                        <input name="tag[]" @if(in_array($tag->id, $checked)) checked @endif class="form-check-input" type="checkbox" value="{{ $tag->id }}">
                        <label class="form-check-label">{{ $tag->name }}</label>
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
    </div>
@endsection