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
        <h1>Edit Shift</h1>
        <form action="{{ route('shifts.update', $shift) }}" method="POST" class="my-5">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select class="form-select" id="user" name="user">
                @foreach ($users as $user)
                    <option value="{{$user->id}}" {{ old('user', $shift->user_id) == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                @endforeach
                </select>
                @error('user')
                    <x-error-message :message="$message" />
                @enderror
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company</label>
                <select class="form-select" id="company" name="company">
                @foreach ($companies as $company)
                    <option value="{{$company->id}}" {{ old('company', $shift->company_id) == $company->id ? 'selected' : '' }}>{{$company->name}}</option>
                @endforeach
                </select>
                @error('company')
                    <x-error-message :message="$message" />
                @enderror
            </div>
            <div class="mb-3">
                <label for="hours" class="form-label">Hours</label>
                <input type="number" class="form-control" id="hours" name="hours" value="{{old('hours', $shift->hours)}}">
                @error('hours')
                    <x-error-message :message="$message" />
                @enderror
            </div>

            <div class="mb-3">
                <label for="rate_per_hour" class="form-label">Rate Per Hour</label>
                <input type="number" class="form-control" id="rate_per_hour" name="rate_per_hour" value="{{old('rate_per_hour', $shift->rate_per_hour)}}">
                @error('rate_per_hour')
                    <x-error-message :message="$message" />
                @enderror
            </div>
            <div>
                <label>Taxable</label>
                <div class="d-flex flex-row">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="taxable" id="taxable_yes" value="1" {{ (old('taxable') ?: $shift->taxable) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="taxable_yes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check mx-4">
                        <input class="form-check-input" type="radio" name="taxable" id="taxable_no" value="0" {{ (old('taxable') ?: $shift->taxable) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="taxable_no">
                            No
                        </label>
                    </div>
                </div>
                @error('taxable')
                    <x-error-message :message="$message" />
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                @foreach ($statuses as $status)
                    <option value="{{$status->id}}" {{old('status', $shift->status_id) == $status->id ? 'selected' : '' }}>{{$status->name}}</option>
                @endforeach
                </select>
                @error('status')
                    <x-error-message :message="$message" />
                @enderror
            </div>
            <div class="mb-3">
                <label for="shift_type" class="form-label">Shift Type</label>
                <select class="form-select" id="shift_type" name="shift_type">
                @foreach ($shiftTypes as $shiftType)
                    <option value="{{$shiftType->id}}" {{old('shift_type', $shift->shift_type_id) == $shiftType->id ? 'selected' : '' }}>{{$shiftType->name}}</option>
                @endforeach
                </select>
                @error('shift_type')
                    <x-error-message :message="$message" />
                @enderror
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{old('date', $shift->date)}}">
                @error('date')
                    <x-error-message :message="$message" />
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
@endsection