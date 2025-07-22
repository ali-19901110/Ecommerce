$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // $("#subcategory-table").DataTable({
    //     ajax: {
    //         url: "/admin/subcategories/get",
    //         type: "GET",
    //     },
    //     columns: [
    //         { data: "name" },
    //         { data: "slug" },
    //         { data: "description" },
    //         { data: "category.name", name: "category.name" },
    //         { data: "Date" },
    //         { data: "Action" },
    //     ],
    // });
    // Create new Category

    // Get all categories
    function loadCategories() {
        $.ajax({
            url: "/admin/categories/list",
            type: "GET",
            success: function (data) {
                $("#inputState")
                    .empty()
                    .append('<option value="">Select Category</option>');
                $.each(data, function (key, category) {
                    $("#inputState").append(
                        '<option value="' +
                            category.id +
                            '">' +
                            category.name +
                            "</option>"
                    );
                });
            },
            error: function () {
                alert("Failed to load categories.");
            },
        });
    }
   
    // Craete new Subcategory
    $("#create-subcategory-form").on("submit", function (e) {
        e.preventDefault();
        loadCategories();
        let formData = $(this).serialize();

        $("#create-subcategory-form .is-invalid").removeClass("is-invalid");
        $("#create-subcategory-form .invalid-feedback").text("");

        $.ajax({
            url: "/admin/subcategories",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                Swal.fire({
                    title: " Created !",
                    text: res.message,
                    icon: "success",
                    timer: 1000,
                    showConfirmButton: false,
                });
                $("#subcategoryModal").modal("hide");
                $("#subcategory-table").DataTable().ajax.reload();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Laravel validation errors
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        let input = $('[name="' + key + '"]');
                        console.log("Testing");
                        input.addClass("is-invalid");
                        input.next(".invalid-feedback").text(value[0]);
                    });
                } else {
                    alert("Something went wrong.");
                }
            },
        });
    });

     // Delete subcategory
    $(document).on("click", ".delete-btn", function () {
        const id = $(this).data("id");
        const name = $(this).data("name");

        Swal.fire({
            title: `Are you sure?`,
            text: `Do you really want to delete "${name}"?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with delete AJAX
                $.ajax({
                    url: `/admin/subcategories/${id}`,
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message,
                            icon: "success",
                            timer: 1000, 
                            showConfirmButton: false, 
                        });
                        $("#subcategory-table").DataTable().ajax.reload();
                    },
                    error: function () {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong while deleting.",
                            icon: "error",
                        });
                    },
                });
            }
        });
    });

    // Get data for specific subcategory by id
    $(document).on("click", ".edit-btn", function () {
        //const subcategoryId = $(this).data("id");
        // $.ajax({
        //     url: `/admin/subcategories/${subcategoryId}/edit`,
        //     type: "GET",
        //     success: function (category) {
        //         $("#edit_category_id").val(category.id);
        //         $("#inputName").val(category.name);
        //         $("#inputSlug").val(category.sluge);
        //         $("#desc").val(category.description);
        //         $("#inputSlug").val(category.slug);
        //         $("#image").val(category.image);
        //         $('input[name="is_active"]:checked').val();
        //         $("#sort_order").val(category.sort_order);
        //         $("#meta_title").val(category.meta_title);
        //         $("#inputAddress").val(category.meta_description);
        //     },
        //     error: function () {
        //         alert("Error");
        //     },
        // });
    });
});
