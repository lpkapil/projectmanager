@extends('base')
@section('title', 'Admin - View User')
@section('main')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes text-gray-300"></i> {{ $project->project_name }} <small>(<?php echo ($project->project_status == '1') ? 'In-Progress' : 'Completed'; ?>)</small></h1>
</div>
<div class="mb-4">
   <a href="{{ url('projects') }}" style="text-decoration:none;">&#8592; Go Back</a>
</div>
<div class="row">
   <div class="col-lg-12">
      @if(session()->get('success'))
      <div class="alert alert-success">
         {{ session()->get('success') }}
      </div>
      @endif
      @if(session()->get('errors'))
      <div class="alert alert-danger">
         @foreach ($errors->all() as $error)
         {{ $error }}<br/>
         @endforeach
      </div>
      @endif
   </div>
   <div class="col-lg-6">
      <div class="card shadow mb-4">
         <!-- Card Header - Accordion -->
         <a href="#project_details" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Project Details</h6>
         </a>
         <!-- Card Content - Collapse -->
         <div class="collapse show" id="project_details" style="">
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="mb-1" for="inputUsername"><strong>Name:</strong> {{ $project->project_name }}</label>
                     </div>
                     <div class="form-group">
                        <label class="mb-1" for="inputUsername"><strong>Status:</strong> 
                        <?php if($project->project_status == 1): ?>
                        <label class="btn btn-info active">In-Progress</label>
                        <?php endif; ?>
                        <?php if($project->project_status == 0): ?>
                        <label class="btn btn-success">Completed</label>
                        <?php endif; ?>
                        </label>
                     </div>
                     <div class="form-group">
                        <label class="mb-1" for="inputUsername"><strong>Type:</strong> <?php echo ($project->project_type == '1') ? 'Fixed Price' : 'Hourly Price'; ?></label>
                     </div>
                     <div class="form-group">
                        <label class="mb-1" for="inputUsername"><strong>Price:</strong> {{ $project->project_price }} &#8377; </label>
                     </div>
                     <div class="form-group">
                        <label class="mb-0" for="inputUsername"><strong>Start Date:</strong> {{  \Carbon\Carbon::parse($project->project_start_date)->format('F j, Y') }}</label>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="mb-1" for="inputUsername"><strong>End Date:</strong> {{ $project->project_end_date }}</label>
                     </div>
                     <?php if (in_array('admin', Auth::user()->roles->pluck('slug')->toArray())): ?>
                     <div class="form-group">
                        <label class="mb-1" for="inputUsername"><strong>Client:</strong> <a href="{{ route('users.show',$project->client_user_id)}}">{{ $project->client()->first()->toArray()['name'] }} - {{ $project->client()->first()->toArray()['email'] }}</a></label>
                     </div>
                     <?php endif;?>
                     <div class="form-group">
                        <label class="mb-1" for="inputUsername"><strong>Description:</strong> {{ $project->project_description }}</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-6">
      <div class="row">
         <div class="col-lg-6">
            <div class="card mb-4 border-left-primary">
               <div class="card-body">
                  <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All Tasks</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all }}</div>
                     </div>
                     <div class="col-auto">
                        <i class="fas fa-fw fa-list-ul fa text-gray-300"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="card mb-4 border-left-secondary">
               <div class="card-body">
                  <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">To-do Tasks</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $todo }}</div>
                     </div>
                     <div class="col-auto">
                        <i class="fas fa-fw fa-list-ul fa text-gray-300"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="card mb-4 border-left-success">
               <div class="card-body">
                  <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Completed Tasks</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completed }}</div>
                     </div>
                     <div class="col-auto">
                        <i class="fas fa-fw fa-list-ul fa text-gray-300"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="card mb-4 border-left-warning">
               <div class="card-body">
                  <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">In-Progress Tasks</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inprogress }}</div>
                     </div>
                     <div class="col-auto">
                        <i class="fas fa-fw fa-list-ul fa text-gray-300"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-12">
            <div class="card mb-4 border-left-primary">
               <div class="card-body">
                  <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Project Documents</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alldocuments }}</div>
                     </div>
                     <div class="col-auto">
                        <i class="fas fa-file fa-2x text-gray-300"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card shadow mb-4">
         <!-- Card Header - Accordion -->
         <a href="#project_tasks" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Project Tasks ({{ $all }})</h6>
         </a>
         <!-- Card Content - Collapse -->
         <div class="collapse show" id="project_tasks" style="">
            <div class="card-body">
               <div>
                  <button class="btn btn-primary mb-3" type="button" data-toggle="collapse" data-target="#addtaskform" aria-expanded="false" aria-controls="addtaskform">
                  <i class="fa fa-plus" aria-hidden="true"></i> Add Task
                  </button>
                  <div class="collapse" id="addtaskform">
                     <form method="post" action="{{ route('tasks.store') }}">
                        @csrf
                        <div class="row">
                           <div class="col">
                              <div class="form-group">
                                 <label for="title">Title:</label>
                                 <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ old('title') }}" tabindex="1" autofocus/>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-group">
                                 <label for="status">Status: </label></br>
                                 <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" id="status" name="status" tabindex="2">
                                    <option value="0">To-Do</option>
                                    <option value="1">In-Progress</option>
                                    <option value="2">Completed</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="description">Description:</label>
                           <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="5" tabindex="3">{{ old('description') }}</textarea>
                        </div>
                        <input type="hidden" name="project_id" value="<?php echo $project->id; ?>" />
                        <button type="submit" class="btn btn-primary float-right mb-4" tabindex="4">Save</button>
                     </form>
                  </div>
               </div>
               <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Title</th>
                           <th>Status</th>
                           <th>Created By</th>
                           <th colspan="3">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($tasks as $task)
                        <tr>
                           <td>{{$task->id}}</td>
                           <td>{{$task->title}}</td>
                           <td>
                              <?php if($task->status == 0): ?>
                              <label class="btn btn-secondary active">To-Do</label>
                              <?php endif; ?>
                              <?php if($task->status == 1): ?>
                              <label class="btn btn-info active">In-Progress</label>
                              <?php endif; ?>
                              <?php if($task->status == 2): ?>
                              <label class="btn btn-success">Completed</label>
                              <?php endif; ?>
                           </td>
                           <td>{{ $task->user()->first()->toArray()['name'] }}</td>
                           <?php if (Auth::user()->id === $task->user_id): ?>
                           <td>
                              <a href="{{ route('tasks.show',$task->id)}}" class="btn btn-primary">Manage</a>
                           </td>
                           <td>
                              <a href="{{ route('tasks.edit',$task->id)}}" class="btn btn-primary">Edit Details</a>
                           </td>
                           <td>
                              <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                                 @csrf
                                 @method('DELETE')
                                 <button class="btn btn-danger" type="submit">Delete</button>
                              </form>
                           </td>
                           <?php else: ?>
                           <td colspan="3">
                              <a href="{{ route('tasks.show',$task->id)}}" class="btn btn-primary">Manage</a>
                           </td>
                           <?php endif;?>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  {{ $tasks->appends(request()->except('taskpage'))->links() }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Project Documents ({{ $alldocuments }})</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('documents.store') }}" enctype="multipart/form-data">
               @csrf
               <div class="input-group mb-4">
                  <div class="custom-file">
                     <input type="file" class="custom-file-input  {{ $errors->has('file') ? 'is-invalid' : '' }}" name="file" value="{{ old('file') }}" id="inputGroupFile04">
                     <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                  </div>
                  <div class="input-group-append">
                     <button class="btn btn-primary" type="submit">Upload</button>
                  </div>
               </div>
               <input type="hidden" name="project_id" value="<?php echo $project->id; ?>" />
            </form>
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Uploaded By</th>
                        <th colspan="2">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($documents as $document)
                     <tr>
                        <td>{{$document->id}}</td>
                        <td>{{$document->name}}</td>
                        <td>{{ $document->user()->first()->toArray()['name'] }}</td>
                        <?php if (Auth::user()->id === $document->user_id): ?>
                        <td>
                           <a href="{{ '/storage/documents/'.$document->url }}" class="btn btn-primary" target="_blank">Download</a>
                        </td>
                        <td>
                           <form action="{{ route('documents.destroy', $document->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit">Delete</button>
                           </form>
                        </td>
                        <?php else: ?>
                        <td colspan="2">
                           <a href="{{ '/storage/documents/'.$document->url }}" class="btn btn-primary" target="_blank">Download</a>
                        </td>
                        <?php endif;?>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               {{ $documents->appends(request()->except('documentpage'))->links() }}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection