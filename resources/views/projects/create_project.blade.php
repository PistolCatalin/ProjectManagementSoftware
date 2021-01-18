<div class="modal fade" id="create_project" tabindex="-1" role="dialog" aria-labelledby="create_project" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">Create Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
         
            
            <form method="POST" class="needs-validation" action="{{ route('projects.store') }}">
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
                        {{ Form::label('dateStart', 'Date Start', ['class' => 'control-label']) }}
                        {{ Form::date('dateStart', '',   ['class' => 'form-control','placeholder' => 'Date Start','required' => 'required'] )}}
                    </div>   
                    <div class="form-group">
                        {{ Form::label('duration', 'Duration', ['class' => 'control-label']) }}
                        {{ Form::number('duration', '',   ['class' => 'form-control','placeholder' => 'Please insert duration of project in days','required' => 'required']) }}
                    </div>  
                </div> 
                <div class="modal-footer" style="flex-direction: column-reverse;">
                    <button type="button" class="btn btn-secondary rounded-pill px-5 my-3" data-dismiss="modal" aria-label="Close">Dismiss</button>
                    {{ Form::submit('Create' , ['class' => 'btn btn-primary rounded-pill px-5 my-3']) }}
                </div>
            </form>
        </div>
    </div>
</div>

