@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:500px;">
                <div class="card-header">Reset Password</div>                
                <div class="card-body">
                    <form method="POST" action="{{route('update.password')}}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') }}" autocomplete autofocus>
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                            @if(Session::has('InvalidEmail'))
                                <span class="text-danger" role="alert">
                                    <strong>{{Session::get('InvalidEmail')}}</strong>
                                </span>
                            @endif                              
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete>
                            @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="col-md-6">
                                <input name="password_confirmation" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
