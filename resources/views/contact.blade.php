<form method="POST"
action="/mail">
    @csrf
    <input name="email" type="text">
    @error('email')
<div>{{$message}}</div>
@enderror
    <button>submit</button>
    @if(session('message'))
    <div>
        {{session('message')}}
    </div>
    @endif
</form>

