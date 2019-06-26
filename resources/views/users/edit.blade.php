@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Edit - {{$user->id or ''}}</h1>

    @foreach($errors->all() as $error)
        @if($errors->all())
        <div class="row card-panel red lighten-3">
            <ul class="col s12 text-darken-2">
                <li>{{$error}}</li>
            </ul>	
        </div>
        @endif
    @endforeach
    
    
    <form action="" method="post" class="col s12">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        
        <input type="hidden" name="id" value="{{$user->id}}">

        <div class="row">
            <div class="input-field col s12">
                <input id="name" name="name" type="text" value="{{$user->name}}" autofocus/>
                <label for="name" class="active">Name</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="email" name="email" type="email" value="{{$user->email}}"/>
                <label for="email" class="active">E-mail</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="username" name="username" type="text" value="{{$user->username}}"/>
                <label for="username" class="active">UserName</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="phone" name="phone" type="text" value="{{$user->phone}}" placeholder="(775)976-6794 x41206" />
                <label for="phone" class="active">Phone</label>
            </div>
        </div>


        <div class="row">
            <div class="input-field col s12">
                <input id="website" name="website" type="text" value="{{$user->website}}"/>
                <label for="website" class="active">Site</label>
            </div>
        </div>
        

        <div class="row">
            <div class="input-field col s12">			
                <a href="/users" class="col s5 waves-effect waves-light red btn-large">Cancel</a>
                <button id="btn-send" type="submit" class="offset-s2 col s5 waves-effect waves-light green darken-2 btn-large">Update</button>
            </div>
        </div>
    </form>   
</div>

@endsection