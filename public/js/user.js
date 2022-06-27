//   *  Insert company data

$("body").on("click", "#createNewuser", function (e) {
    e.preventDefault;
    console.log('hi');
    $("#userForm").attr("action", store_user);
    $("#userTitleID").html("Add user");
    $("#submit").val("Add");
    $("#userFormMethod").val("post");
    $("#userModal").modal("show");
    $("#user_id").val("");
    $("#userForm").trigger("reset");
});

// //Save data into database

$("#userForm").submit(function (event) {
    event.preventDefault();
    var id = $("#user_id").val();
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
            $("#userModal").modal("hide");

            location.reload();
        },
        error: function (data) {
            console.log("Error......");
        },
    });
});

// show modal window

$("body").on("click", ".modal-popup-view", function () {
    var view_url = $(this).data("url");
    $.ajax({
        url: view_url,
        type: "GET", // user.show

        success: function (data) {
            var view_html = "";
            $.each(data, function (k, v) {
                view_html += "<tr><td>" + k + "</td><th>" + v + "</th></tr>";
            });
            $("#modal-table-data_user").html(view_html);
            $("#userView").show();
        },
    });
});
$("body").on("click", ".modal-close-btn-show", function () {
    $("#userView").hide();
});

//Edit modal window
$("body").on("click", "#editUser", function (event) {
    event.preventDefault();
    $("#categoryForm").trigger("reset");
    var id = $(this).data("id");
    $.get(store_user + "/" + id + "/edit", function (data) {
        $("#userForm").attr("action", update_user + "/" + data.data.id);
        $("#userFormMethod").val("patch");
        $("#userTitleID").html("Edit user");
        $("#submit").val("Edit category");
        $("#userModal").modal("show");
        $("#user_id").val(data.data.id);
        $("#name").val(data.data.name);
        $("#email").val(data.data.email);
        $("#password").val(data.data.password);
        $("#type").val(data.data.type);
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