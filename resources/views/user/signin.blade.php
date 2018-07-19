@extends('layouts.master')

@section('content')
    <div class="container" style="padding-top:50px">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <h1>登入</h1>
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('user.signin') }}" method="post">
                    <div class="form-group">
                        <label for="email">電子信箱</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">密碼</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">登入</button>
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
@endsection