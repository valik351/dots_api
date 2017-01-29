@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a class="btn btn-primary" href="{{ route('testing_servers::add') }}" role="button">Add
                    Server</a>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                @include('helpers.grid-search', ['action' => action('TestingServerController@index')])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Testing Servers</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@include('helpers.grid-header', ['name' => 'ID',            'order' => 'id'])</th>
                                <th>@include('helpers.grid-header', ['name' => 'Server name',   'order' => 'name'])</th>
                                <th>@include('helpers.grid-header', ['name' => 'Login',         'order' => 'login'])</th>
                                <th>@include('helpers.grid-header', ['name' => 'Token created', 'order' => 'token_created_at'])</th>
                                <th>@include('helpers.grid-header', ['name' => 'Deleted Date',  'order' => 'deleted_at'])</th>
                                <th>Actions</th>
                                <th>Token</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($servers as $server)
                                <tr>
                                    <td>{{ $server->id }}</td>
                                    <td class="wrap-text">{{ $server->name }}</td>
                                    <td>{{ $server->login }}</td>
                                    <td>{{ $server->token_created_at }}</td>
                                    <td>{{ $server->deleted_at }}</td>
                                    <td>
                                        <a title="Edit"
                                           href="{{ action('TestingServerController@edit',['id'=> $server->id]) }}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        @if (!$server->deleted_at)
                                            <a title="Delete" href="" data-toggle="confirmation"
                                               data-message="Are you sure you want to delete this server from the system?"
                                               data-btn-ok-href="{{ action('TestingServerController@delete', ['id'=> $server->id]) }}"
                                               data-btn-ok-label="Delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <a title="Restore" href="" data-toggle="confirmation"
                                               data-message="Are you sure you want to restore this server?"
                                               data-btn-ok-href="{{ action('TestingServerController@restore', ['id'=> $server->id]) }}"
                                               data-btn-ok-label="Restore">
                                                <i class="fa fa-repeat" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="wrap-text">{{ $server->api_token }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="custom-pager">
                            {{ $servers->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
