@extends('employees.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('logout') }}">

                    {{ __('Logout') }}
                </a>
            </div>
        </div>

    </div>
  <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employee List</h2>
            </div>
        </div>
    </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Company</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>PhoneNo</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($employees as $c)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $c->companyname }}</td>
                <td>{{ $c->firstname }}</td>
                <td>{{ $c->lastname }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->phoneno }}</td>

                <td>


                        <a class="btn btn-info" href="{{ route('employees.active',$c->id) }}">Active</a>

                </td>
            </tr>
        @endforeach
    </table>

{{--    {!! $employees->links() !!}--}}

@endsection
