@extends('employees.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('employees.update',$Employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company:</strong>
                    <select class="form-control" name="company_id" id="company_id">
                        <option hidden>Choose Company</option>
                        @foreach ($company as $item)
                            <option value="{{ $item->id }}" {{ ($item->id == $Employee->company_id)?'selected':'' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="firstname" class="form-control" value="{{ $Employee->firstname }}" placeholder="FirstName">
                    {!! $errors->first('firstname','<span class="text-danger">:message</span>') !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="lastname" class="form-control" value="{{ $Employee->lastname }}" placeholder="lastName">
                    {!! $errors->first('lastname','<span class="text-danger">:message</span>') !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" value="{{ $Employee->email }}" placeholder="Email">
                    {!! $errors->first('email','<span class="text-danger">:message</span>') !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone No:</strong>
                    <input type="number" name="phoneno" class="form-control" value="{{ $Employee->phoneno }}" placeholder="Phone No">
                    {!! $errors->first('phoneno','<span class="text-danger">:message</span>') !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
