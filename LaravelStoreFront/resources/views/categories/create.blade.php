@extends('layouts.app')
@section('title', 'Categories')

@section('content')
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<h1>Create Category</h1>

			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form action="{{ route('categories.store') }}" method="POST">
				@csrf

				<div class="mb-3">
					<label for="category_name" class="form-label">Category Name</label>
					<input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name') }}" required>
					@error('category_name')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>

				<div class="mb-3">
					<label for="category_description" class="form-label">Description</label>
					<textarea class="form-control @error('category_description') is-invalid @enderror" id="category_description" name="category_description" rows="4">{{ old('category_description') }}</textarea>
					@error('category_description')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>

				<div class="d-flex gap-2">
					<button type="submit" class="btn btn-primary">Create Category</button>
					<a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

