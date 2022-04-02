@extends('companies.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Company List</h2>
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
                    <a class="btn btn-info" href="{{ route('companies.active',$c->id) }}">Active</a>


                </td>
            </tr>
        @endforeach
    </table>

    {!! $companies->links() !!}

@endsection
