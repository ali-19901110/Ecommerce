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
                });
                $("#createModal").modal("hide");
                $("#category-table").DataTable().ajax.reload();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Laravel validation errors
                    let errors = xhr.responseJSON.errors;
                    let messages = "";
                    $.each(errors, function (key, value) {
                        messages += value + "\n";
                    });
                    alert(messages);
                } else {
                    alert("Something went wrong.");
                }
            },
        });
    });

    // Handle delete button click
    $(document).on("click", ".delete-btn", function () {
        let id = $(this).data("id");
        let name = $(this).data("name");

        if (confirm(`Are you sure you want to delete "${name}"?`)) {
            $.ajax({
                url: "/admin/categories/" + id,
                type: "DELETE",
                success: function (response) {
                    $("#category-table").DataTable().ajax.reload();
                },
                error: function (xhr) {
                    alert("Error deleting category");
                },
            });
        }
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
                });
                $("#editModal").modal("hide");
                $("#category-table").DataTable().ajax.reload();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    alert(
                        "Validation failed:\n" +
                            JSON.stringify(xhr.responseJSON.errors)
                    );
                } else {
                    alert("Something went wrong");
                }
            },
        });
    });
});
