@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding: 20px;">

    <a class="btn-floating btn-large waves-effect waves-light green right" href="<?php echo url('/user') . '/new'; ?>"><i class="material-icons">add</i></a>
    
    <table class="table responsive-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>User Name</th>
                <th>Phone</th>
                <th>Site</th>
                <th>Created At</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) == 0)
                <tr>
                    <td colspan="8">No users <a href="">reload page</a></td>
                </tr>
            @else
                @foreach($users as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>                                
                        <td>{{$row->email}}</td>
                        <td>{{$row->username}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{$row->website}}</td>
                        <td>{{$row->created_at}}</td>
                        
                        <td>
                            <a title="View" href="<?php echo url('/users') . '/' . $row->id; ?>">
                                <button type="button" class="btn-floating btn-small waves-effect waves-light green">
                                    <i class="material-icons">remove_red_eye</i>					
                                </button>								 
                            </a>
                        </td>
                        <td>
                            <a title="Editar" href="<?php echo url("/users/$row->id/edit"); ?>">
                                <button type="button" class="btn-floating btn-small waves-effect waves-light blue">
                                    <i class="material-icons">mode_edit</i>					
                                </button>								 
                            </a>					
                        </td>
                        <td>
                            <button title="Excluir" type="button" data-idx="{{$row->id}}" class="btn-delete btn-floating btn-small waves-effect waves-light red">
                                <i class="material-icons">delete</i>					
                            </button>
                        </td>
                    </tr>
               @endforeach
            @endif
        </tbody>
    </table>
</div>

@push('scripts')
<script type="text/javascript">
    var BASE_URL = "<?php echo url('/') . '/';?>";
    $(document).ready(function() {
        $( ".btn-delete" ).bind( "click", function() {
            var vm = $(this); // I'know, arrow-functions can switch resolve, but...
            // https://www.magicalquote.com/wp-content/uploads/2015/06/Old-habits-they-die-hard.jpg

            var id = $(this).data('idx');
            
            if(confirm('Are you sure delete this row?!')){

                $.ajax({		 
                    url: BASE_URL + 'users/' + id					
                    ,type:'DELETE'                    
                    ,headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    ,success: function(json){
                        vm.parent().parent().remove();							
                    }
                    ,error: function(json){
                        console.log(json);
                    }
                });
            }
        });
    });
</script>
@endpush
@endsection
