@extends('companies.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Company List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('companyrecycle') }}">Recycle Data</a>
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Company</a>
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
            <th>Logo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Website</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($companies as $c)
            <tr>
                <td>{{ ++$i }}</td>
                <td><img src="{{ storage_path('app/public/').$c->logo }}" style="height: 100px;width:100px;"></img></td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->website }}</td>

                <td>
                    <form action="{{ route('companies.destroy',$c->id) }}" method="POST">

{{--                        <a class="btn btn-info" href="{{ route('companies.show',$c->id) }}">Show</a>--}}

                        <a class="btn btn-primary" href="{{ route('companies.edit',$c->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $companies->links() !!}

@endsection
