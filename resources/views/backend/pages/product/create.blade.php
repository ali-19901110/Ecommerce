@extends('backend.layout.master')

@section('content')

<div class="row">
    <div class="col-xl-7 mx-auto">
        <div class="card border-top  border-primary">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-file-plus me-1 font-50 text-primary"></i>
                    </div>
                    <h5 class="mb-0 text-primary">Create Product</h5>
                </div>
                <hr>
                <form class="row g-3" method="POST" action="{{route('products.store')}}">
                    @csrf
                    <div class="col-md-6">
                        <label for="inputName" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" value="{{old('name')}}">
                        @error('name')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Category</label>
                        <select id="inputState" name='category_id' class="form-select">
                            @foreach ($allcategories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Subategory</label>
                        <select id="inputState" name='subcategory_id' class="form-select">
                            @foreach ($allsubcategories as $subcategory)
                            <option value="{{$subcategory->id}}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>{{$subcategory->name}}</option>
                            @endforeach
                        </select>
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
                        <input type="text" name="description" class="form-control" id="desc"
                            value="{{old('description')}}">
                        @error('Description')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Short Description</label>
                        <textarea class="form-control" id="inputAddress2" name="short_description"
                            rows="3">{{old('short_description')}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="Sku" class="form-label"> Sku</label>
                        <input type="text" class="form-control" id="Sku" name="sku" value="{{old('sku')}}">
                        @error('sku')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="gallery" class="form-label">Gallery Images</label>
                        <input type="file" name="gallery[]" id="gallery" class="form-control" multiple>
                        @error('gallery')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        @if ($errors->has('gallery.*'))
                        @foreach ($errors->get('gallery.*') as $messages)
                        @foreach ($messages as $msg)
                        <p class="text-danger">{{ $msg }}</p>
                        @endforeach
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Price</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="price"
                            value="{{ old('price', $product->price ?? '') }}">
                        @error('price')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Sale price</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="sale_price"
                            value="{{ old('sale_price', $product->sale_price ?? '') }}">
                        @error('sale_price')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Cost Price</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="cost_price"
                            value="{{ old('cost_price', $product->cost_price ?? '') }}">
                        @error('cost_price')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Stock Quantity</label>
                        <input type="number" min="0" step="1" class="form-control" name="stock_quantity"
                            value="{{ old('stock_quantity', $product->stock_quantity ?? '') }}">
                        @error('stock_quantity')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Min Quantity</label>
                        <input type="number" min="0" step="1" class="form-control" name="min_quantity"
                            value="{{ old('min_quantity', $product->min_quantity ?? '') }}">
                        @error('min_quantity')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Weight</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="weight"
                            value="{{ old('weight', $product->weight ?? '') }}">
                        @error('weight')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Dimensions</label>
                        <input type="text" name="dimensions" id="dimensions" class="form-control"
                            value="{{ old('dimensions', $product->dimensions ?? '') }}">
                        @error('dimensions')
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
                                old('is_active', $product->is_active ?? 1) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0" {{
                                old('is_active', $product->is_active ?? 1) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
                        @error('is_active')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Status of Featured:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_featured" id="featured" value="1" {{
                                old('is_featured', $product->is_featured ?? 1) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">Featured</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_featured" id="infeatured" value="0" {{
                                old('is_featured', $product->is_featured ?? 1) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="infeatured">Infeatured</label>
                        </div>
                        @error('is_featured')
                        <p style="color: #f00">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" name="manage_stock" id="manage_stock" {{
                            old('manage_stock', $product->manage_stock ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="manage_stock">
                            Manage Stock
                        </label>
                        @error('manage_stock')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock_status" class="form-label">Stock Status</label>
                        <select name="stock_status" id="stock_status" class="form-select">
                            <option value="in_stock" {{ old('stock_status', $product->stock_status ?? '') == 'in_stock'
                                ? 'selected' : '' }}>In Stock</option>
                            <option value="out_of_stock" {{ old('stock_status', $product->stock_status ?? '') ==
                                'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            <option value="on_backorder" {{ old('stock_status', $product->stock_status ?? '') ==
                                'on_backorder' ? 'selected' : '' }}>On Backorder</option>
                        </select>
                        @error('stock_status')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="sort_order" class="form-label">Display Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control"
                            value="{{ old('sort_order', $subcategory->sort_order ?? 0) }}" min="0" step="1">
                    </div> --}}
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
                        <label for="rating_average" class="form-label">Average Rating</label>
                        <input type="number" name="rating_average" id="rating_average" class="form-control" step="0.1"
                            min="0" max="5" value="{{ old('rating_average', $product->rating_average ?? 0.0) }}">
                        @error('rating_average')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="rating_count" class="form-label">Rating Count</label>
                        <input type="number" name="rating_count" id="rating_count" class="form-control" step="1" min="0"
                            value="{{ old('rating_count', $product->rating_count ?? 0) }}">
                        @error('rating_count')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
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