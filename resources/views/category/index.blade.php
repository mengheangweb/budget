
@extends('layout.app')

@section('content')

    @include('component.message')
    @include('component.error')

    <h1 class="display-6m">Category List</h1>
    <a href="/category/create" class="btn btn-primary">Add New</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $category->name }}</td>
            <td>
              <a class="btn btn-primary btn-sm" href="/category/view/{{ $category->id }}?page={{request()->page}}">Details</a>
              <a class="btn btn-primary btn-sm" href="/category/edit/{{ $category->id }}?page={{request()->page}}">Edit</a>
              <form action="/category/delete/{{ $category->id }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                @method('DELETE')
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $categories->links() }}
@endsection