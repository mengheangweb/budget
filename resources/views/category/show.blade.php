
@extends('layout.app')

@section('content')

    @include('component.message')
    @include('component.error')

    <h1 class="display-6m">Category Detail</h1>
    <a href="/category" class="btn btn-primary">List</a>

    <div class="row">
      <div class="col-md-6">
        <table class="table">
            <tr>
              <th scope="col">#</th>
              <td>{{ $category->id }}</td>
            </tr>
            <tr>
              <th scope="col">Name</th>
              <td>{{ $category->name }}</td>
            </tr>
            <tr>
              <th scope="col">Created Date</th>
              <td>{{ $category->created_at }}</td>
            </tr>
        </table>
      </div>
      <h1 class="display-6m">Transactions ({{ $category->transaction->count() }})</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
          </tr>
        </thead>
        <tbody>
          @foreach($category->transaction as $transaction)
          <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $transaction->date }}</td>
            <td>{{ $transaction->description }}</td>
            <td>{{ $transaction->amount }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection