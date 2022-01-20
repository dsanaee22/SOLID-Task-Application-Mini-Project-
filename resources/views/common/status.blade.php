<div class="Alerts">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="p-1 font-small-3"
                        style="list-style: none">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@if (session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{session()->get('message')}}
    </div>
@endif
