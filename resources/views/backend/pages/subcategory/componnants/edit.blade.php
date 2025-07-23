<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Subcategory</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit_category_id" name="id">

                    <div class="col-md-6">
                        <label for="edit_inputName" class="form-label">Subcategory Name</label>
                        <input type="text" name="name" class="form-control" id="edit_inputName">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select id="edit_inputState" name="category_id" class="form-select category-select" data-target="edit">
                            {{-- <select class="form-select category-select" data-target="edit"></select> --}}
                            <option value="">Loading categories...</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="edit_slug" name="slug">
                    </div>

                    <div class="col-md-6">
                        <label for="edit_desc" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="edit_desc">
                    </div>

                    <div class="col-md-6">
                        <label for="edit_image" class="form-label">Image</label>
                        <input type="text" class="form-control" id="edit_image" name="image">
                    </div>

                    <div class="mb-3">
                        <label>Status:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="edit_active" value="1">
                            <label class="form-check-label" for="edit_active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" id="edit_inactive" value="0">
                            <label class="form-check-label" for="edit_inactive">Inactive</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_sort_order" class="form-label">Display Order</label>
                        <input type="number" name="sort_order" id="edit_sort_order" class="form-control" min="0"
                            step="1">
                    </div>

                    <div class="col-12">
                        <label for="edit_meta_title" class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" id="edit_meta_title">
                    </div>

                    <div class="col-12">
                        <label for="edit_meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="edit_meta_description" name="meta_description"
                            rows="3"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>