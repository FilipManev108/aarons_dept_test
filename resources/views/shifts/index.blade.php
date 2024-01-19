@extends('layouts.app')

@section('title', 'Aarons\'s Dept - Shifts')

@section('menu-links')
    <li class="nav-item">
        <a class="nav-link disabled" aria-disabled="true" href=""></a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex flex-row justify-content-between align-items-center w-100">
            <h1>Shifts</h1>
            <form action="{{ route('shifts.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="number" min="1" class="form-control" placeholder="Total pay" aria-label="Total pay" name="total_pay" value="{{ request()->total_pay }}">
                </div>
            </form>
        </div>
        @session('success')
            <div class="alert alert-success" role="alert">{{$value}}</div>
        @endsession
        @session('error')
            <div class="alert alert-danger" role="alert">{{$value}}</div>
        @endsession
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Worker</th>
                    <th scope="col">Company</th>
                    <th scope="col">Hours</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Total Pay</th>
                    <th scope="col">Taxable</th>
                    <th scope="col">Status</th>
                    <th scope="col">Shift Type</th>
                    <th scope="col">Paid At</th>
                    <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($shifts as $shift)
                <tr>
                    <th scope="row">{{$shift->id}}</th>
                    <td>{{ $shift->date }}</td>
                    <td>{{ $shift->user->name }}</td>
                    <td>{{ $shift->company->name }}</td>
                    <td>{{ $shift->hours }}</td>
                    <td>&#163 {{ $shift->rate_per_hour }}</td>
                    <td>&#163 {{ $shift->total_pay }}</td>
                    <td>{{ $shift->taxable ? "Yes" : "No" }}</td>
                    <td>{{ $shift->status->name }}</td>
                    <td>{{ $shift->shiftType->name }}</td>
                    <td>{{ $shift->paid_at }}</td>
                    <td>
                        <a href="{{route('shifts.edit', $shift)}}" class="text-warning mx-2"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{route('shifts.destroy', $shift)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger border-0"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
        </table>
        <div class="mt-3">
            {{ $shifts->links() }}
          </div>
    </div>
</div>
@endsection