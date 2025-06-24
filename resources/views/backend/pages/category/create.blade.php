@extends('backend.layout.master')

@section('content')

<div class="row">
    <div class="col-xl-7 mx-auto">
        <div class="card border-top  border-primary">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-file-plus me-1 font-50 text-primary"></i>
                    </div>
                    <h5 class="mb-0 text-primary">Create Category</h5>
                </div>
                <hr>
                <form class="row g-3" method="POST" action="{{route('categories.store')}}">
                    @csrf
                    <div class="col-md-6">
                        <label for="inputName" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" value="{{old('name')}}">
                        @error('name')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputLastName" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}">
                        @error('slug')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="desc" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="desc" value="{{old('desc')}}">
                        @error('Description')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label"> Image</label>
                        <input type="text" class="form-control" id="image" name="image" value="{{old('image')}}">
                        @error('image')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Status:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="active" value="1" {{
                                old('is_active', $category->is_active ?? 1) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0" {{
                                old('is_active', $category->is_active ?? 1) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
                        @error('is_active')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Display Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control"
                            value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0" step="1">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" id="inputName"
                            value="{{old('meta_title')}}">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="inputAddress2" name="meta_description"
                            rows="3">{{old('meta_description')}}</textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection