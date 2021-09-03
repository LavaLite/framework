<div>
@forelse ($options as $key => $option)
    <div class="form-check {{$inline ? 'form-check-inline' : '' }}">
        <input class="form-check-input" type="checkbox" id="{{$name}}_{{$key}}" value="{{$option[$check_value]}}" name="{{$name}}[]">
        <label class="form-check-label" for="{{$name}}_{{$key}}">{{$option[$check_text]}}</label>
    </div>
@empty
<div class="form-field">
{{__('No values')}}
</div>
@endforelse
</div>