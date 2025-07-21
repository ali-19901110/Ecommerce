<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="create-category-form">
          @csrf
          <div class="col-md-6">
            <label for="inputCreateName" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" id="inputCreateName" value="{{old('name')}}">
            @error('name')
            <p style="color: red;">{{ $message }}</p>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="inputCreateSlug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="inputCreateSlug" name="slug" value="{{old('slug')}}">
            @error('slug')
            <p style="color: red;">{{ $message }}</p>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="inputCraetedesc" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="inputCraetedesc" value="{{old('desc')}}">
            @error('Description')
            <p style="color: #f00">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="inputCreateimage" class="form-label"> Image</label>
            <input type="text" class="form-control" id="inputCreateimage" name="image" value="{{old('image')}}">
            @error('image')
            <p style="color: #f00">{{$message}}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label>Status:</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_active" id="checkCreateactive" value="1" {{ old('is_active',
                $category->is_active ?? 1) == 1 ?
              'checked' : '' }}>
              <label class="form-check-label" for="checkCreateactive">Active</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_active" id="checkCreateinactive" value="0" {{ old('is_active',
                $category->is_active ?? 1) == 0 ?
              'checked' : '' }}>
              <label class="form-check-label" for="checkCreateinactive">Inactive</label>
            </div>
            @error('is_active')
            <p style="color: #f00">{{$message}}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="inputCreatesort_order" class="form-label">Display Order</label>
            <input type="number" name="sort_order" id="inputCreatesort_order" class="form-control"
              value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0" step="1">
          </div>
          <div class="col-12">
            <label for="inputCreateAddress" class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" id="inputCreateAddress" value="{{old('meta_title')}}">
          </div>
          <div class="col-12">
            <label for="inputCreateAddress2" class="form-label">Meta Description</label>
            <textarea class="form-control" id="inputCreateAddress2" name="meta_description"
              rows="3">{{old('meta_description')}}</textarea>
          </div>
         
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary px-5">Register</button>
      </div>
      </form>
    </div>
  </div>
</div>