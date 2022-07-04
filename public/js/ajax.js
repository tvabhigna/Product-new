//   *  Insert Product data

$("body").on("click", "#createNewProduct", function (e) {
    e.preventDefault;
    $("#productForm").attr("action", store_product);
    $("#productTitleID").html("Create product");
    $("#submit").val("Create product");
    $("#productFormMethod").val("post");
    $("#productModal").modal("show");
    $("#product_id").val("");
    $("#productForm").trigger("reset");
 });
 

// //Save data into database

$("#productForm").submit(function (event) {
    event.preventDefault();
    var id = $("#product_id").val();
    let form = $(this);
    let url = form.attr("action");
    let formData = new FormData(this);
    let method = $(this).attr("method");
    if (method == "put") {
        formData.append("_method", "PATCH");
    }
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (category) {
            console.log('hi');
            $("#productModal").modal("hide");
            location.reload();

        },
        error: function (err) {
            // console.log(err);
            var data = jQuery.parseJSON(err.responseText);
            $.each(data.errors, function(key, value) {
                $("." + key + "").css('display', 'block');
                $("." + key + "").html(value[0]);
            });
           
          
        },
    });

});

// show modal window

$("body").on("click", ".modal-popup-view", function () {
    var view_url = $(this).data("url");
    $.ajax({
        url: view_url,
        type: "GET", // products.show

        success: function (data) {
            var view_html = "";
            $.each(data, function (k, v) {
                view_html += "<tr><td>" + k + "</td><th>" + v + "</th></tr>";
            });
            $("#modal-table-data_product").html(view_html);
            $("#productView").show();
        },
    });
});
$("body").on("click", ".modal-close-btn-show", function () {
    $("#productView").hide();
});

//Edit modal window
$("body").on("click", "#editProduct", function (event) {
    event.preventDefault();
    $("#productdata").trigger("reset");
    var id = $(this).data("id");
    $.get(store_product + "/" + id + "/edit", function (data) {
        $("#productForm").attr("action", update_product + "/" + data.data.id);
        $("#productFormMethod").val("put");
        $("#productTitleID").html("Edit product");
        $("#submit").val("Edit product");
        $("#productModal").modal("show");
        $("#product_id").val(data.data.id);
        $("#name").val(data.data.name);
        $("#price").val(data.data.price);
        $("#category_id").val(data.data.category_id);
        $("#image").val(data.data.image);
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

// delete record from database
$("body").on("click", ".modal-delete-confirm", function () {
    var id = $(this).attr("data-url");
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: id,
        type: "DELETE", // products.destroy
        dataType: "json",

        success: function (result) {
            $("#modal_delete_warning").modal("hide");
            location.reload();
        },
    });
});
