<div class="form-group my-2">
    <label for="state" class="col-sm-3 control-label">TaskState</label>
    {!! Form::select('state', $data['states'] , 5 , ['class' => 'form-select form-select-lg mb-3']) !!}
</div>
