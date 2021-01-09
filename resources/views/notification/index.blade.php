
@extends('layouts.app')

@section('content')

    @include('component.message')
    @include('component.error')

    <h1 class="display-6m">Notification List</h1>
 
    <div class="row mt-3">
      <form action="/notification" method="get">
        <div class="input-group mb-3">
          <input name="search" type="text" class="form-control" placeholder="Type to search" aria-label="Recipient's username" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
          </div>
        </div>
      </form>
    </div>

    <table class="table border">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Content</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($notifications as $notify)
          <tr class="{{ ! $notify->read_at ? 'bg-primary text-light': '' }}">
            <th scope="row">{{ $loop->index + 1 }}</th>
            <th>
              @if($notify->type == "App\Notifications\TransactionCreated")
                <p class="m-0">New Transaction Created</p>
                <span class="badge badge-success bg-success" >{{ $notify->data['amount'] }}$</span>
              @endif
            </th>
            <td>{{ $notify->created_at }}</td>
            <td>
              @if(! $notify->read_at)
                <a class="btn btn-sm btn-info" href="/notification/read/{{ $notify->id }}">Read</a>
              @endif
                <a class="btn btn-sm btn-danger" href="/notification/delete/{{ $notify->id }}">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

@endsection