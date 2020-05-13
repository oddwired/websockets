@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('info'))
                <div class="alert alert-info">
                    {{session('info')}}
                </div>
            @endif
            @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">My Apps</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($socket_apps as $socket_app)
                            <tr onclick="viewAppDetails('{{$socket_app->name}}', '{{$socket_app->id}}',
                                    '{{$socket_app->key}}', '{{$socket_app->secret}}')">
                                <td>{{$socket_app->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create App</div>

                <div class="card-body">
                    <form action="{{url('create-app')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('App Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-primary">Create</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="appDetails" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">App Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnclose">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div >
                    <h6 class="row justify-content-center">App Name:</h6>
                    <code class="row justify-content-center" id="appName"></code>
                </div>
                <div >
                    <h6 class="row justify-content-center">App ID:</h6>
                    <code class="row justify-content-center" id="appID"></code>
                </div>
                <div>
                    <div class="row justify-content-center">App Key:</div>
                    <code class="row justify-content-center" id="appKey"></code>
                </div>
                <div>
                    <div class="row justify-content-center">App Secret:</div>
                    <code class="row justify-content-center" id="appSecret"></code>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('jscontent')
    <script>
        function viewAppDetails(name, id, key, secret) {
            $("#appName").html(name);
            $('#appID').html(id);
            $("#appKey").html(key);
            $("#appSecret").html(secret);

            $("#appDetails").modal("show");
        }
    </script>
@endsection
