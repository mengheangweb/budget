
@extends('layout.app')

@section('content')

    @include('component.message')
    @include('component.error')

    <h1 class="display-6m">Transaction List</h1>
    <a href="/transaction/create" class="btn btn-primary">Add New</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Date</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transactions as $transaction)
          <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $transaction->category ? $transaction->category->name : '--' }}</td>
            <td>{{ $transaction->date }}</td>
            <td>{{ $transaction->description }}</td>
            <td>{{ $transaction->amount }}</td>
            <td>
              <a class="btn btn-primary btn-sm" href="/transaction/edit/{{ $transaction->id }}">Edit</a>
              <form action="/transaction/delete/{{ $transaction->id }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                @method('DELETE')
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $transactions->links() }}
@endsection