@extends('layouts.app')
@section('content')
@include('users.create_user')
@include('users.edit_user')
<style>
    .filter-form{
        right: 15px;
        position: absolute;
        top: 177px;
    }
</style>
<div class = "container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="px-1 py-3">Users</h1>
            <button type="button" class="btn btn-primary rounded-pill px-5 my-3" data-toggle="modal"  data-target="#create_user" data-backdrop="static" data-keyboard="false">NEW ENTRY</button>
        </div>
        <form class="form-inline filter-form" method="GET" >
            <div class="form-group mb-2">
                <label for="filter" class="col-sm-2 col-form-label">Role</label>
                <input type="text" class="form-control rounded-pill" id="filter" name="filter" placeholder="Type role name..." value="">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
        </form>
    </div>
    <table class="table table-bordered table-hover">
    <thead>
        <th>First Name</th>
        <th>Last Name </th>
        <th>Role</th>
        <th>Email</th>
        <th>Created At</th>
    </thead>
    <tbody>
        @if ($users->count() == 0)
        <tr>
            <td colspan="5">No users to display.</td>
        </tr>
        @endif

        @foreach ($users as $user)
        <tr onclick="edit_user({{$user->id}})" data-toggle="modal"  data-target="#edit_user" data-backdrop="static" data-keyboard="false">
            <td>{{ $user->firstName}}</td>
            <td>{{ $user->lastName }}</td>
            <td>{{ $user->roles[0]->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div class="row">
        <div class="col-md-4">
            <p >
                Displaying {{$users->count()}} of {{ $users->total() }} user(s).
            </p>
        </div>
        <div class="col-md-8">
        {{ $users->links("pagination::bootstrap-4") }}
        </div>
    <div>
</div>

<script>
function edit_user(id){
    $.ajax({
        url: "/user/" + id, 
        success: function(data){
            console.log(data);
            $('#edit_user .form-control').each(function(){
                $(this).val(data[$(this).attr('name')]);
            });
            var paths = $('#update_user_form').attr('action').split('/');
            paths[ paths.length-1 ] = data['id']; // new value
            paths = paths.join('/');
            $('#update_user_form').attr('action', paths)
            $('#display_current_img').attr('src','storage/avatars/'+data['avatar'])
        }
    });
    
}
function readURL(input,img_id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $(img_id).attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}



</script>
@endsection