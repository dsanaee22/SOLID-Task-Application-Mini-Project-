<div class="tab-content px-2" id="{{$data['tab']}}">

    @if(!$data['tasks']->isEmpty())
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th colspan="3">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['tasks'] as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td class="centering">{{ $task->name }}</td>
                    <td class="centering">{{ $task->description }}</td>
                    <td class="centering">
                          <span class="badge badge-primary">
                                {!! ['Not Set !','Done !','Doing !','Failed !','Skipped !','Not Started!'][(int)TaskApp\DB\StoreTempState::getState($task)] !!}
                          </span>
                    </td>

                    <!-- Task Status Checkbox -->
                    <td>{!!$payload['at'] ?? '' !!}</td>

                    <td class="centering">
                        {!! Form::open(array('class' => 'form-inline pull-right', 'method' => 'DELETE', 'route' => array('task.destroy', $task->id))) !!}
                        @method('DELETE')
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary">Delete</button>
                            {!! Form::close() !!}
                            <button type="button" class="btn btn-warning">
                                <a class="text-white text-decoration-none" href="{{ route('task.edit', $task->id) }}">
                                    Edit Task
                                </a>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <br>
        <h4 class="text-center">No task has the state</h4>
    @endif
</div>
