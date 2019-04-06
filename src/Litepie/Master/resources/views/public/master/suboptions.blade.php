<option value="">Select an option</option>
@foreach ($options as $option) 
<option value="{{$option->name}}">{{$option->name}}</option>
@endforeach


