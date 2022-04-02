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
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employeerecycle') }}">Recycle Data</a>
                <a class="btn btn-success" href="{{ route('employees.create') }}"> Create New Employee</a>
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
                    <form action="{{ route('employees.destroy',$c->id) }}" method="POST">

{{--                        <a class="btn btn-info" href="{{ route('employees.show',$c->id) }}">Show</a>--}}

                        <a class="btn btn-primary" href="{{ route('employees.edit',$c->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

{{--    {!! $employees->links() !!}--}}

@endsection
