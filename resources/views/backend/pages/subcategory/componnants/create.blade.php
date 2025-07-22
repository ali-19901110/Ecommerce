<!-- Modal -->
<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="subcategoryModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="create-subcategory-form">
          @csrf
          <div class="col-md-6">
            <label for="inputName" class="form-label">Subcategory Name</label>
            <input type="text" name="name" class="form-control" id="inputName" value="{{old('name')}}">
            <div class="invalid-feedback"></div>
          </div>
          <div class="col-md-4">
            <label for="inputState" class="form-label">Category</label>
            <select id="inputState" name="category_id" class="form-select">
              <option value="">-- Select Category --</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="inputLastName" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}">
            <div class="invalid-feedback"></div>
          </div>
          <div class="col-md-6">
            <label for="desc" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" id="desc" value="{{old('description')}}">
            <div class="invalid-feedback"></div>
          </div>
          <div class="col-md-6">
            <label for="image" class="form-label"> Image</label>
            <input type="text" class="form-control" id="image" name="image" value="{{old('image')}}">
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label>Status:</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_active" id="active" value="1" {{ old('is_active',
                $subcategory->is_active ?? 1) == 1 ? 'checked' : '' }}>
              <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0" {{ old('is_active',
                $subcategory->is_active ?? 1) == 0 ? 'checked' : '' }}>
              <label class="form-check-label" for="inactive">Inactive</label>
            </div>
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="sort_order" class="form-label">Display Order</label>
            <input type="number" name="sort_order" id="sort_order" class="form-control"
              value="{{ old('sort_order', $subcategory->sort_order ?? 0) }}" min="0" step="1">
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" id="inputName" value="{{old('meta_title')}}">
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Meta Description</label>
            <textarea class="form-control" id="inputAddress2" name="meta_description"
              rows="3">{{old('meta_description')}}</textarea>
          </div>
          {{-- <div class="col-12">
            <button type="submit" class="btn btn-primary px-5">Register</button>
          </div> --}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>