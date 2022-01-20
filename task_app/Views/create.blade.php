@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-7">

            <!-- Display Validation Errors -->
            @include('common.status')

            <div class="card panel-default">
                <div class="card-header">
                    <div class="card-title">
                        Create New Task
                    </div>
                </div>
                <!-- New Task Form -->
                {!! Form::open(['url' => route('task.store',['client' => 'web']) , 'method' => 'post']) !!}
                <div class="card-body">

                    <!-- Task Name -->
                    <div class="form-group my-2">
                        <label for="task-name" class="col-sm-3 control-label">Task Name</label>
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>

                    <!-- Task Description -->
                    <div class="form-group my-2">
                        <label for="task-description" class="col-sm-3 control-label">Description</label>
                        <textarea name="description" id="task-description" class="form-control"
                                  maxlength="155"></textarea>
                    </div>

                    <!-- Task State -->
                    @widget('\TaskApp\Widgets\StateWidget')

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">Submit Task</button>
                    </div>
                    <div class="form-group mt-2">
                        <a href="{{ route('tasks.index') }}" class="w-100 btn btn-sm btn-warning text-white p-2"
                           type="button">
                            <span class="fa fa-reply" aria-hidden="true"></span> Back to Tasks
                        </a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
