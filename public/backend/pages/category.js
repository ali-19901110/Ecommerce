$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Get All Categories
    $("#category_table").DataTable({
        ajax: {
            url: "/admin/categories/get",
            type: "GET",
        },
        columns: [
            { data: "Category_id" },
            { data: "Category" },
            { data: "Slug" },
            { data: "Date" },
            { data: "Action" },
        ],
    });

    // Create new Category
    $("#create-category-form").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $("#create-category-form .is-invalid").removeClass("is-invalid");
        $("#create-category-form .invalid-feedback").text("");

        $.ajax({
            url: "/admin/categories",
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
                $("#createModal").modal("hide");
                $("#category-table").DataTable().ajax.reload();
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
                    url: `/admin/categories/${id}`,
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
                        $("#category-table").DataTable().ajax.reload();
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

    // Get data for specific category by id
    $(document).on("click", ".edit-btn", function () {
        const categoryId = $(this).data("id");
        $.ajax({
            url: `/admin/categories/${categoryId}/edit`,
            type: "GET",
            success: function (category) {
                $("#edit_category_id").val(category.id);
                $("#inputName").val(category.name);
                $("#inputSlug").val(category.sluge);
                $("#desc").val(category.description);
                $("#inputSlug").val(category.slug);
                $("#image").val(category.image);
                $('input[name="is_active"]:checked').val();
                $("#sort_order").val(category.sort_order);
                $("#meta_title").val(category.meta_title);
                $("#inputAddress").val(category.meta_description);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    // update
    $("#editCategoryForm").on("submit", function (e) {
        e.preventDefault();
        let category = $("#edit_category_id").val();
        console.log(category);
        let formData = $(this).serialize();
        $("#editCategoryForm .is-invalid").removeClass("is-invalid");
        $("#editCategoryForm .invalid-feedback").text("");

        $.ajax({
            url: "/admin/categories/" + category,
            type: "POST",
            data: formData,
            headers: {
                "X-HTTP-Method-Override": "PUT", // Laravel understands this
            },
            success: function (response) {
                Swal.fire({
                    title: " Updated !",
                    text: response.message,
                    icon: "success",
                    timer: 1000, 
                    showConfirmButton: false, 
                });
                $("#editModal").modal("hide");
                $("#category-table").DataTable().ajax.reload();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                     let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        let input = $('[name="' + key + '"]');
                        console.log("Testing");
                        input.addClass("is-invalid");
                        input.next(".invalid-feedback").text(value[0]); 
                    });
                } else {
                    alert("Something went wrong");
                }
            },
        });
    });
});
