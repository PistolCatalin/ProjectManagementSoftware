@extends('layouts.app')
@section('content')
<style>
div.side-col{
    background: #fff;
    min-height: calc(100vh - 59px);
    position: fixed;
    right: 0;
    transform: translateX(100%);
    transition: 0.4s;
    z-index: 600;
}
div.side-col.active{
    transform: translateX(0%);
    overflow: auto;
    height: 100%;
}
form{
    max-height: calc(100vh - 150px);
    overflow: auto;
}
.toDo{
    background: red;
}
.inProgress{
    background: orange;
}
.done{
    background: #1ad41a;
}
</style>
<div class = "container-fluid">
    @include('tasks.create_task')
    @include('tasks.view_task')
    <div class="row">
        <div class="col-md-12">
            <h1 class="px-1 py-3">Tasks</h1>
            @role('admin')
            <button type="button" class="btn btn-primary rounded-pill px-5 my-3" onclick="openSideCol()">NEW ENTRY</button>
            @endrole
        </div>
    </div>
    <table class="table table-bordered table-hover">
    <thead>
        <th>Name</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Assigned To</th>
    </thead>
    <tbody>
        @if ($tasks->count() == 0)
        <tr>
            <td colspan="5">No task to display. You are free for momenet:)</td>
        </tr>
        @endif

        @foreach ($tasks as $task)
        <tr onclick="openDetails('{{$task->id}}')" class="{{ $task->status}}">
            <td>{{ $task->name}}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->created_at }}</td>
            <td>{{ $task->user->username }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div class="row">
        <div class="col-md-4">
            <p >
                Displaying {{$tasks->count()}} of {{ $tasks->total() }} task(s).
            </p>
        </div>
        <div class="col-md-8">
        {{ $tasks->links("pagination::bootstrap-4") }}
        </div>
    <div>
</div>

<script>
@role('admin')
function openSideCol(){
    $('.side-col').removeClass('active');
    $('#side-col').addClass('active');
}
@endrole
function openDetails(id){
    $('.side-col').removeClass('active');
    $('#side-col-view-task').addClass('active');

    $.ajax({
        url: "/tasks/" + id, 
        success: function(data){
            @role('admin')
            $('input.header_task').val(data['name']);
            $('#description_edit').val(data['description']);
            $('#status_edit').val(data['status']);
            $('#project_edit').val(data['project_id']);
            $('#assignedTo_edit').val(data['assignedTo']);
            
            var paths = $('#update_task_form').attr('action').split('/');
            paths[ paths.length-1 ] = data['id']; // new value
            paths = paths.join('/');
            $('#update_task_form').attr('action', paths)
            @endrole

            $('input#task_id').val(data['id']);
            $('h5#header_task').html(data['name']);
            $('.description').html(data['description']);
            $('.status').html(data['status']);
            $('#change_status').removeClass('toDo inProgress done');
            $('#change_status').val(data['status']);
            $('#change_status').addClass(data['status']);
            $('.assignedTo').html(data['username']);
            $('.project').html(data['project_name']);




            let comments = [];
            for (let i = 0 ; i< data['comments'].length; ++i){
                comments += '<div class="col-md-12 comment-el">'+
                    '<div class="pb-3"><b>Written by  '+data['comments'][i]['username']+' </b></div>'+
                    '<div>'+data['comments'][i]['text'] +'</div>'+
                    '<div class="comment-post-date"><b>Posted at '+data['comments'][i]['created_at']+'</b></div>'+  
                    '</div>';
            }

            $('div.comments-container').html(comments);
        }
    });

  
}

</script>

@endsection