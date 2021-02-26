@component('mail::message')
# Mail poslao {{request('firstAndLastName')}}




{{request('message')}}


### Hvala,<br>
### {{ config('app.name') }}
@endcomponent
