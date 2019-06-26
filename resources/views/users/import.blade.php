@extends('layouts.app')

@section('content')

<div class="container">

    @foreach($errors->all() as $error)
        @if($errors->all())
        <div class="row card-panel red lighten-3">
            <ul class="col s12 text-darken-2">
                <li>{{$error}}</li>
            </ul>	
        </div>
        @endif
    @endforeach
    
    <form action="<?php echo url("/import/");?>" method="post" class="col s12"  enctype="multipart/form-data">
        
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="row">
            <div class="file-field input-field">
                <div class="btn green darken-2">
                    <span>File</span>
                    <input type="file" name="file" class="green" />
                </div>                
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">			
                <a href="/products" class="col s5 waves-effect waves-light red btn-large">Cancel</a>
                <button id="btn-send" type="submit" class="offset-s2 col s5 waves-effect waves-light green darken-2 btn-large">Add</button>
            </div>
        </div>

    </form>   
</div>

@endsection