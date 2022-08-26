@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')

		{{-- <h4 class="secondary"><strong>{{$email['title']}}</strong></h4> --}}
		{{-- <p>{{$email['content']}}</p> --}}

	@include('beautymail::templates.widgets.articleEnd')

	@include('beautymail::templates.widgets.newfeatureStart')

		<h4 class="secondary"><strong>{{$email['email']}}</strong></h4>
		{{-- <p>{{$email['content']}}</p> --}}

	@include('beautymail::templates.widgets.newfeatureEnd')

@stop