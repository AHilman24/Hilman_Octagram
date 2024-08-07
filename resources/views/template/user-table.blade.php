@extends('template2.template')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>User</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#mediumModal">
                            Add Data
                        </button>
                        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="modalinput" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="modalinput">Add Data User</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/form-user" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Name</label>
                                                <input type="text" name="name" class="form-control" id="recipient-name" required>
                                                @if ($errors->has('name'))
                                                    <div>{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="col-form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" required>
                                                @if ($errors->has('email'))
                                                    <div>{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="col-form-label">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" required>
                                                @if ($errors->has('password'))
                                                    <div>{{ $errors->first('password') }}</div>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <input type="submit" value="Add" class="btn btn-success">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email}}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $key }}">
                                                Edit
                                            </button>
                                            <div class="modal fade" id="edit{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modalinput" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="modalinput{{ $key }}">Edit Data User</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/update/{{ $item->id }}" method="post">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="recipient-name" class="col-form-label">Name</label>
                                                                    <input type="text" name="name" class="form-control" value="{{ $item->name }}" id="recipient-name" required>
                                                                    @if ($errors->has('name'))
                                                                        <div>{{ $errors->first('name') }}</div>
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="col-form-label">Email</label>
                                                                    <input type="email" name="email" class="form-control" value="{{ $item->email }}" id="email" required>
                                                                    @if ($errors->has('email'))
                                                                        <div>{{ $errors->first('email') }}</div>
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password" class="col-form-label">Password</label>
                                                                    <input type="password" name="password" class="form-control" id="password" required>
                                                                    @if ($errors->has('password'))
                                                                        <div>{{ $errors->first('password') }}</div>
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <input type="submit" value="Edit" class="btn btn-primary">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="/destroy/{{ $item->id }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->


<div class="clearfix"></div>

<footer class="site-footer">
    <div class="footer-inner bg-white">
        <div class="row">
            <div class="col-sm-6">
                Copyright &copy; 2018 Ela Admin
            </div>
            <div class="col-sm-6 text-right">
                Designed by <a href="https://colorlib.com">Colorlib</a>
            </div>
        </div>
    </div>
</footer>
@endsection