@php
	$configuration = icommercefreeshipping_get_configuration();
	$options = array('required' =>'required','step' => '0.01','min' => 0);

	if($configuration==NULL)
		$cStatus = 0;
	else
		$cStatus = $configuration->status;

	$status = icommerce_get_status();

	$formID = uniqid("form_id");

@endphp


{!! Form::open(['route' => ['admin.icommercefreeshipping.configuration.update'], 'method' => 'put','name' => $formID]) !!}


<div class="col-xs-12">

	{!! Form::normalInputOfType('number','minimum', trans('icommercefreeshipping::configurations.table.minimum'), $errors,$configuration,$options) !!}

    <div class="form-group">
	    <div>
		    <label class="checkbox-inline">
		    	<input name="status" type="checkbox" @if($cStatus==1) checked @endif>{{trans('icommercefreeshipping::configurations.table.activate')}}
		    </label>
		</div>   
	</div>
   
    {{--
    <div class="form-group">
			<label for="status">Status</label>
		   	<select class="form-control" id="status" name="status">
		    	@foreach ($status->lists() as $index => $ts)
		    		<option value="{{$index}}" @if($index==$cStatus) selected @endif >{{$ts}}</option>
		    	@endforeach
		    </select>
	</div>
	--}}

    <div class="box-footer">
    <button type="submit" class="btn btn-primary btn-flat">{{ trans('icommercefreeshipping::configurations.button.save configuration') }}</button>
    </div>

</div>

{!! Form::close() !!}