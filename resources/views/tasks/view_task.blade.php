<style>
div.form-control{
    height:auto;
}
form.comment-form{
    padding-bottom:100px;
}
textarea#text{
    max-height:100px!important;
}
div.comment-el{
    border-bottom: 1px solid #ddd;
    padding: 20px 15px;
}
select.change_status{
    width: 133px;
    right: 74px;
    top:10px;
    position: absolute;
}
button.edit{
    width: 70px;
    top:10px;
    position: absolute;
    right: 227px;
}

</style>
<div class="col-md-4 side-col shadow" id="side-col-view-task">

    <div class="modal-header">
        <h5 class="modal-title" id ="header_task"></h5>
        @role('admin')
        <button class="btn btn-primary edit" type="button" onclick="open_edit()" >Edit</button>
        @endrole
        <select class="form-control change_status " required="required" id="change_status">
            <option value="toDo">To Do</option>  
            <option value="inProgress">In Progress</option> 
            <option value="done">Done</option>
        </select>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#side-col-view-task').removeClass('active')">
            <span aria-hidden="true">×</span>
        </button>
    </div>     
    <div class="modal-body pb-5">
        <div class="form-group">
            <label for="assignedTo" class="control-label"><b>Description</b></label>
            <div class="form-control description">
            Why do we use it?
    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
            </div>
        </div>
        <div class="form-group">
            <label for="assignedTo" class="control-label"><b>Status</b></label>
            <div class="form-control status">
            </div>
        </div>
        <div class="form-group">
            <label for="assignedTo" class="control-label"><b>Assigned To </b></label>
            <div class="form-control assignedTo">
            </div>
        </div>
            <div class="form-group">
                <label for="assignedTo" class="control-label"><b>Project Name</b></label>
                <div class="form-control project">
            </div>
        </div>
        <div class ="row comment-section">
            <div class=col-md-12>
                <h3>Comments</h3>
            </div>
            <div class="comments-container w-100">
            </div>
        </div>
        <form method="POST" class="needs-validation comment-form" action="{{ route('comments.store') }}">
            @csrf
                <input type ="hidden" id="task_id" class="form-control" name="task_id"> 
                <div class="form-group">
                    {{ Form::label('text', 'Comment', ['class' => 'control-label']) }}
                    {{ Form::textarea('text', '',   ['class' => 'form-control','placeholder' => 'Write a comment','required' => 'required']) }}
                    <div class="d-block float-right mt-2 ">
                
                    {{ Form::submit('Comment' , ['class' => 'btn btn-primary ']) }}
                    </div>
                </div>   
        </form>

    </div>
</div>
@role('admin')

<div class="col-md-4 side-col shadow" id="side-col-edit-task">
        <div class="modal-header">
            <h5 class="modal-title" id="updateTask">Update Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="$('#side-col-edit-task').removeClass('active')">
                <span aria-hidden="true">×</span>
            </button>
        </div>     
        <form method="POST" class="needs-validation" id="update_task_form" action="{{ route('tasks.update',1) }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('name_edit', 'Name', ['class' => 'control-label']) }}
                    {{ Form::text('name_edit', '',   ['class' => 'form-control header_task','placeholder' => 'Name','required' => 'required' ]) }}
                </div>   
                <div class="form-group">
                    {{ Form::label('description_edit', 'Description', ['class' => 'control-label']) }}
                    {{ Form::textarea('description_edit', '',   ['class' => 'form-control','placeholder' => 'Description','required' => 'required']) }}
                </div>   
                <div class="form-group">
                    {{ Form::label('attachaments_edit', 'Attachaments', ['class' => 'control-label']) }}
                    {{ Form::file('attachaments_edit',['class' => 'form-control','accept' => 'application/pdf,image/*']) }}
                </div>  
                <div class="form-group">
                    {{ Form::label('status_edit', 'Status', ['class' => 'control-label']) }}
                    {{ Form::select('status_edit', ['toDo' => 'To Do', 'inProgress' => 'In Progress', 'done' => 'Done'], 'toDo' , ['class' => 'form-control','required' => 'required'])}}
                </div> 
                <div class="form-group">
                    <label for="project" class="control-label">Project</label>
                    <select class="form-control" required="required" id="project_edit" name="project_id" placeholder="Please select a project">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name}}</option>  
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="assignedTo" class="control-label">Assigned To</label>
                    <select class="form-control" required="required" id="assignedTo_edit" name="assignedTo" placeholder="Please select a project">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email}}</option>  
                    @endforeach
                    </select>
                </div>
            </div> 
            <div class="modal-footer" style="flex-direction: column-reverse;">
                <button type="button" class="btn btn-secondary rounded-pill px-5 my-3" data-dismiss="modal" aria-label="Close">Dismiss</button>
                {{Form::hidden('_method','PUT')}}
                {{ Form::submit('Create' , ['class' => 'btn btn-primary rounded-pill px-5 my-3']) }}
            </div>
        </form>
</div>

<script>

function open_edit(){
    $("#side-col-view-task").removeClass("active");
    $("#side-col-edit-task").addClass("active");
}

</script>
@endrole