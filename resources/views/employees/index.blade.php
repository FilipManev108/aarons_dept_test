@extends('layouts.app')

@section('title', 'Aarons\'s Dept - Home')

@section('menu-links')
    <li class="nav-item">
        <a class="nav-link disabled" aria-disabled="true" href=""></a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col">
        @if($users) 
        <h1>Employees</h1> 
        @else 
        <h1>Welcome</h1>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Shift Count</th>
                  <th scope="col">Sum Hours</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->shifts_count}}</td>
                    <td>{{$user->shifts_sum_hours}}</td>
                    <td><a href="{{route('employees.show', $user)}}" class="text-primary"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                </tr>
                @endforeach
              </tbody>
        </table>
        <div class="mt-3">
            {{ $users->links() }}
          </div>
    </div>
</div>
@endsection