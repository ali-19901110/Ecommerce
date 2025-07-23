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
        return $.ajax({
            url: "/admin/categories/list",
            type: "GET",
            success: function (data) {
                $(".category-select").each(function () {
                    const $select = $(this);
                    const target = $select.data("target"); // "create" or "edit"

                    $select
                        .empty()
                        .append('<option value="">Select Category</option>');
                    $.each(data, function (i, category) {
                        $select.append(
                            `<option value="${category.id}">${category.name}</option>`
                        );
                    });
                });
            },
            error: function () {
                alert("Faild to load categories");
            },
        });
    }

    //loadCategories();
    $("#subcategoryModal").on("show.bs.modal", function () {
        loadCategories();
    });
    // Craete new Subcategory
    $("#create-subcategory-form").on("submit", function (e) {
        e.preventDefault();
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

    //
    $(document).on("click", ".edit-btn", function () {
        const subcategoryId = $(this).data("id");

        loadCategories()
            .then(function (data) {
                $.ajax({
                    url: `/admin/subcategories/${subcategoryId}/edit`,
                    type: "GET",
                    success: function (subcategory) {
                        $("#edit_category_id").val(subcategory.id);
                        $("#edit_inputName").val(subcategory.name);
                        $("#edit_slug").val(subcategory.slug);
                        $("#edit_desc").val(subcategory.description);
                        $("#edit_image").val(subcategory.image);
                        $("#edit_sort_order").val(subcategory.sort_order);
                        $("#edit_meta_title").val(subcategory.meta_title);
                        $("#edit_meta_description").val(
                            subcategory.meta_description
                        );

                        $("#inputState").val(subcategory.category_id);

                        if (subcategory.is_active == 1) {
                            $("#edit_active").prop("checked", true);
                        } else {
                            $("#edit_inactive").prop("checked", true);
                        }
                        $("#editModal").modal("show");
                    },
                    error: function () {
                        alert("Faild to laod subcategory");
                    },
                });
            })
            .catch(function () {
                alert("fail to load categories");
            });
    });

    // Update subcategory
    $("#editModal form").on("submit", function (e) {
        e.preventDefault();

        const subcategoryId = $("#edit_category_id").val();
        const form = $(this);
        const formData = new FormData(this);

        $.ajax({
            url: `/admin/subcategories/${subcategoryId}`,
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').val(),
                "X-HTTP-Method-Override": "PUT", // Laravel expects PUT for update
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
                $("#subcategory-table").DataTable().ajax.reload();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = "";
                    $.each(errors, function (key, messages) {
                        errorMessage += messages[0] + "\n";
                    });
                    alert(errorMessage);
                } else {
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
                }
            },
        });
    });
});
