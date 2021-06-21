@extends('base')
@section('main')
	<div class="m-b-md">
		@if ($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				<div>{{ $error }}</div>
			@endforeach
		</div>
		@endif
		<form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="row">
				<div class="col-25">
					<label for="video">Title: <font color='#f00'>*</font></label>
				</div>
				<div class="col-75">
					<input type="text" name="title" placeholder="Video Title" >

				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="video">Video: <font color='#f00'>*</font></label>
				</div>
				<div class="col-75">
					<input type="file" name="video"  placeholder="Browse for a video" >

				</div>
			</div>

			<div class="row">
				<button type="submit" class="btn btn-submit">Upload</button>
			</div>
		</form>
	</div>
@endsection
