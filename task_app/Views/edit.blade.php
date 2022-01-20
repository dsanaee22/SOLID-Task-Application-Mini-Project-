@extends('layouts.app')

@section('content')

    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-7">

            <!-- Display Validation Errors -->
            @include('common.status')

            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Editing Task <strong>{{$task->name}}</strong>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{route('task.update',['task' => $task->id])}}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group my-2">
                            {!! Form::label('name', 'Task Name', array('class' => 'col-sm-3 col-sm-offset-1 control-label text-right')) !!}
                            {!! Form::text('name', $task->name, ['class' => 'form-control']) !!}
                        </div>


                        <div class="form-group my-2">
                            {!! Form::label('description', 'Task Description', array('class' => 'col-sm-3 col-sm-offset-1 control-label text-right')) !!}
                            {!! Form::textarea('description', $task->description, array('class' => 'form-control')) !!}
                        </div>

                        <div class="form-group my-2">
                        @php
                            use TaskApp\DB\StoreTempState;
                            $state = StoreTempState::getState($task);
                            $states = [
                                '1' => 'Done :)',
                                '2' => 'Doing...',
                                '3' => 'Failed :(',
                                '4' => 'Skipped :|',
                                '5' => 'NotStarted :|',
                            ];
                        @endphp
                        <!-- Task State -->
                            <label for="status" class="col-sm-3 col-sm-offset-1 control-label text-right">Change
                                Status from "{!! $states[$state] ?? 'Not Started' !!}" to:</label>
                            <div class="select">
                                <label for="status">
                                    {!! Form::select('state', $states, $state, ['class' => 'form-control w-100 ']) !!}
                                </label>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            {{Form::button('<span class="fa fa-save fa-fw" aria-hidden="true"></span> <span class="hidden-xxs">Save</span> <span class="hidden-xs">Changes</span>', array('type' => 'submit', 'class' => 'btn btn-success btn-block w-100'))}}
                        </div>

                        <div class="form-group mt-2">
                            <a href="{{ route('tasks.index') }}" class="w-100 btn btn-sm btn-warning text-white p-2"
                               type="button">
                                <span class="fa fa-reply" aria-hidden="true"></span> Back to Tasks
                            </a>
                        </div>

                    {!! Form::close() !!}

                    {!! Form::open(array('class' => 'form-inline pull-right', 'method' => 'DELETE', 'route' => array('task.destroy', $task->id))) !!}
                    @method('DELETE')
                    {{Form::button('<span class="fa fa-trash fa-fw" aria-hidden="true"></span> <span class="hidden-xxs">Delete</span> <span class="hidden-sm hidden-xs">Task</span>', array('type' => 'submit', 'class' => 'btn btn-danger w-100 mt-2'))}}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
