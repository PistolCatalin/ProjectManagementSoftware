@role('admin')
<div class="col-md-4 side-col shadow" id="side-col">
        <div class="modal-header">
            <h5 class="modal-title" id="loginModal">Create Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('.side-col').removeClass('active')">
                <span aria-hidden="true">×</span>
            </button>
        </div>     
        <form method="POST" class="needs-validation" action="{{ route('tasks.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                    {{ Form::text('name', '',   ['class' => 'form-control','placeholder' => 'Name','required' => 'required' ]) }}
                </div>   
                <div class="form-group">
                    {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
                    {{ Form::textarea('description', '',   ['class' => 'form-control','placeholder' => 'Description','required' => 'required']) }}
                </div>   
                <div class="form-group">
                    {{ Form::label('attachaments', 'Attachaments', ['class' => 'control-label']) }}
                    {{ Form::file('attachaments',['class' => 'form-control','accept' => 'application/pdf,image/*']) }}
                </div>  
                <div class="form-group">
                    {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                    {{ Form::select('status', ['toDo' => 'To Do', 'inProgress' => 'In Progress', 'done' => 'Done'], 'toDo' , ['class' => 'form-control','required' => 'required'])}}
                </div> 
                <div class="form-group">
                    <label for="project" class="control-label">Project</label>
                    <select class="form-control" required="required" id="project" name="project_id" placeholder="Please select a project">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name}}</option>  
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="assignedTo" class="control-label">Assigned To</label>
                    <select class="form-control" required="required" id="assignedTo" name="assignedTo" placeholder="Please select a project">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->email}}</option>  
                    @endforeach
                    </select>
                </div>
            </div> 
            <div class="modal-footer" style="flex-direction: column-reverse;">
                <button type="button" class="btn btn-secondary rounded-pill px-5 my-3" data-dismiss="modal" aria-label="Close">Dismiss</button>
                {{ Form::submit('Create' , ['class' => 'btn btn-primary rounded-pill px-5 my-3']) }}
            </div>
        </form>
</div>
@endrole