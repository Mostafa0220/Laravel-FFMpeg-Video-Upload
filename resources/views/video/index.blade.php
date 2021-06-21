@extends('base')
@section('main')
	<div class="m-b-md">
		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
		@endif
		@if ($message = Session::get('error'))
			<div class="alert alert-danger">
				<p>{{ $message }}</p>
			</div>
		@endif

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>View</th>

				</tr>
			</thead>
			<tbody>
				@if(count($videos) > 0)
					@php ($sl 	=	1)
					@foreach ($videos as $key)
						<tr>
							<td>{{ $sl }}</td>
							<td>{{ ucwords($key->title) }}</td>
							<td>
								<a href='{{ url("/stream/$key->id") }}'>view</a>
							</td>
						</tr>
						@php ($sl++)
					@endforeach
				@else
					<tr>
						<td colspan="6" style="text-color:red;">No record(s) found</td>
					</tr>
				@endif
			</tbody>
		</table>
		{{ $videos->links() }}
	</div>
@endsection
