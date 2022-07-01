//   *  Insert company data

$("body").on("click", "#createNewCategory", function (e) {
    e.preventDefault;
    $("#categoryForm").attr("action", store_category);
    $("#categoryTitleID").html("Add Category");
    $("#submit").val("Add");
    $("#categoryFormMethod").val("post");
    $("#categoryModal").modal("show");
    $("#category_id").val("");
    $("#categoryForm").trigger("reset");
});

// //Save data into database

$("#categoryForm").submit(function (event) {
    event.preventDefault();
    var id = $("#category_id").val();
    let form = $(this);
    let url = form.attr("action");
    let formData = new FormData(this);
    let method = $(this).attr("formMethod");
    console.log(method);
    if (method == "put") {
        formData.append("_method", "PATCH");
    }
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        url: url,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",

        success: function (data) {
            $("#categoryModal").modal("hide");

            Swal.fire({
                position: "top",
                icon: "success",
                title: "Success",
                showConfirmButton: false,
            });
            location.reload();
        },
        error: function (err) {
            // console.log(err);
            var data = jQuery.parseJSON(err.responseText);
            console.log(data.errors);
            $.each(data.errors, function(key, value) {
                $("." + key + "").css('display', 'block');
                $("." + key + "").html(value[0]);
            })
        }
    });
});

// show modal window

$("body").on("click", ".modal-popup-view", function () {
    var view_url = $(this).data("url");
    $.ajax({
        url: view_url,
        type: "GET", // category.show

        success: function (data) {
            var view_html = "";
            $.each(data, function (k, v) {
                view_html += "<tr><td>" + k + "</td><th>" + v + "</th></tr>";
            });
            $("#modal-table-data_category").html(view_html);
            $("#categoryView").show();
        },
    });
});
$("body").on("click", ".modal-close-btn-show", function () {
    $("#categoryView").hide();
});

//Edit modal window
$("body").on("click", "#editCategory", function (event) {
    event.preventDefault();
    $("#categoryForm").trigger("reset");
    var id = $(this).data("id");
    $.get(store_category + "/" + id + "/edit", function (data) {
        $("#categoryForm").attr("action", update_category + "/" + data.data.id);
        $("#categoryFormMethod").val("patch");
        $("#categoryTitleID").html("Edit category");
        $("#submit").val("Edit category");
        $("#categoryModal").modal("show");
        $("#category_id").val(data.data.id);
        $("#name").val(data.data.name);
    });
});

// / Delect Record popup->
$("body").on("click", ".modal-popup-delete", function (e) {
    var del_url = $(this).data("url");
    $(".modal-delete-confirm").attr("data-url", del_url);
    $("#modal_delete_warning").show();
});
$("body").on("click", ".modal-close-btn-delete", function () {
    $("#modal_delete_warning").hide();
});

//  delete record from database
$("body").on("click", ".modal-delete-confirm", function () {
    var id = $(this).attr("data-url");
    console.log(id);

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: id,
        type: "DELETE", // category.destroy
        dataType: "json",
        success: function (result) {
            $("#modal_delete_warning").modal("hide");
            location.reload();
        },
    });
});
