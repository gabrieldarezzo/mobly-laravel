@extends('layouts.app')

@section('content')

<div class="container">
    <h4>Detail of user: ({{$user->id}}) {{$user->name}}</h4>
    <ul class="card-panel hoverable collection">        
        <li class="collection-item">Id: {{$user->id}}</li>
        <li class="collection-item">Name: {{$user->name}}</li>        
        <li class="collection-item">Email: {{$user->email_verified_at}}</li>
        <li class="collection-item">Username: {{$user->username}}</li>
        <li class="collection-item">Phone: {{$user->phone}}</li>
        <li class="collection-item">Site: {{$user->website}}</li>        
        <li class="collection-item">Created At: {{$user->created_at}}</li>
        <li class="collection-item">Updated At: {{$user->updated_at}}</li>


        <li class="collection-item">

        <h5>Posts: </h5>
            <ul class="collection">

                @foreach ($user->posts as $post)
                    <li class="collection-item avatar">
                        <i class="material-icons circle green">insert_chart</i>
                        <span class="title"><strong>{{ucfirst($post->title)}}</strong></span>
                        <p>{{ucfirst($post->body)}}</p>


                        
                    </li>
                @endforeach
            </ul>
        </li>


    </ul>
    <hr>
    <a href="<?= url('/users')?>">Back</a>
</div>
@endsection
