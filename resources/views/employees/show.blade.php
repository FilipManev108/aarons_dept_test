@extends('layouts.app')

@section('title', 'Aarons\'s Dept - Employee')

@section('menu-links')
    <li class="nav-item">
        <a class="nav-link disabled" aria-disabled="true" href=""></a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h1>Employee: <b>{{ $user->name }}</b></h1>
        <p>
            Pay/Hr (average): <b>&#163 {{ $average['pay_per_hour'] }}</b>
        </p>
        <p >
            Total Pay (average): <b>&#163 {{ $average['total_pay'] }}</b>
        </p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col">Date</th>
                    <th class="col">Company</th>
                    <th scope="col">Total Pay</th>
                    <th scope="col">Paid At</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($lastFive as $payment)
                <tr>
                    <th scope="row">{{ $payment->date }}</th>
                    <td>{{ $payment->company->name }}</td>
                    <td>&#163 {{ $payment->total_pay }}</td>
                    <td>{{ $payment->paid_at }}</td>
                </tr>
                @endforeach
              </tbody>
        </table>
    </div>
</div>
@endsection