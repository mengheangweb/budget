
@extends('layout.app')

@section('content')

    @include('component.message')
    @include('component.error')

    <h1 class="display-6m">Transaction List</h1>
    <a href="/transaction/create" class="btn btn-primary">Add New</a>

    <div class="row mt-3">
      <form action="/transaction" method="get">
        <div class="input-group mb-3">
          <input name="search" type="text" class="form-control" placeholder="Type to search" aria-label="Recipient's username" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
          </div>
        </div>
      </form>
    </div>

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
            <td>
              {{ $transaction->description }}
              <br>
              @foreach($transaction->tag as $tag)
                <span class="badge badge-success bg-success" >{{ $tag->name }}</span>
              @endforeach
            </td>
            <td>{{ $transaction->amount }}</td>
            <td>
              <a class="btn btn-primary btn-sm" href="/transaction/edit/{{ $transaction->id }}?page={{request()->page}}">Edit</a>
              <form action="/transaction/delete/{{ $transaction->id }}" method="POST">
                @csrf
                <button  onclick="return confirm('Are you sure?') " type="submit" class="btn btn-danger btn-sm">Delete</button>
                @method('DELETE')
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $transactions->links() }}

      <h6>Deleted</h6>
      <ul>
        @foreach($trashed as $trash)
        <li>{{ $trash->description }} - {{ $trash->amount }} <a href="/transaction/restore/{{ $trash->id }}">restore</a></li>
        @endforeach
      </ul>
@endsection