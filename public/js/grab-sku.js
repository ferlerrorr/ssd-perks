var baseUrl = "{{ url('/') }}";

$(document).ready(function () {
    function a() {
        $("#GrabSKUTable").DataTable({
            ajax: {
                // url: "http://localhost:8802/api/ssd/sftp/grab-sku-pack",
                url: "/api/ssd/sftp/grab-sku-pack",
                dataSrc: "",
            },
            columns: [
                { data: "SKU_Number" },
                { data: "grab_pack" },
                { data: null, render: e },
            ],
            paging: !0,
            searching: !0,
        });
    }
    function e(a, e, t) {
        // console.log(a);
        var n;
        return `
      <button type="button" class="btn btn-primary"
        data-toggle="modal" data-target="#GrabEditSKUModal"
        data-sku_number="${a.SKU_Number}" data-grab_pack="${a.grab_pack}">Edit
      </button>
      <button type="button" class="btn btn-danger"
        data-toggle="modal" data-target="#GrabDeleteSKUConfirmationModal"
        data-sku-number="${a.SKU_Number}">Delete
      </button>`;
    }
    a(), //! // Call the function to initialize the sku table
        $("#GrabSKUTable tbody").on("click", "button.btn-primary", function () {
            var a = $(this).data("sku_number"),
                e = $(this).data("grab_pack");
            $("#GrabEditSKUNumber").val(a),
                $("#GrabEditPiecetoPack").val(e),
                $("#GrabSaveEditSKUButton").val(a);
        }),
        $("#GrabSaveEditSKUButton").click(function () {
            var e = Number($("#GrabEditSKUNumber").val()),
                t = Number($("#GrabEditPiecetoPack").val()),
                n = $(this).attr("value");
            let o = {
                async: true,
                crossDomain: true,
                url: "/api/ssd/sftp/grab-update-sku/" + e,
                // url: "http://localhost:8802/api/ssd/sftp/grab-update-sku/" + e,
                method: "PUT",
                headers: { Accept: "*/*", "Content-Type": "application/json" },
                processData: false,
                data: JSON.stringify({ SKU_Number: e, grab_pack: t }),
            };

            $("#GrabEditSKUModal").modal("hide");

            $("#GrabSKUTable").fadeOut(420, function () {
                $.fn.DataTable.isDataTable("#GrabSKUTable") &&
                    $("#GrabSKUTable").DataTable().destroy(),
                    a(),
                    $(this).fadeIn(480);
            });

            $.ajax(o)
                .done(function (a) {
                    console.log(a);
                    $("#GrabEditSKUModal").modal("hide");
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status === 405) {
                        console.error(
                            "Method Not Allowed: PUT method not supported by the server."
                        );
                    } else {
                        console.error(textStatus);
                    }
                })
                .always(function () {
                    $("#GrabEditSKUModal").modal("hide");
                });
        }),
        $("#GrabDeleteSKUConfirmationModal").on("show.bs.modal", function (a) {
            var e = $(a.relatedTarget);
            e.data("sku-number");
            var t = e.data("sku-number");
            $("#GrabConfirmDeleteSKU").val(t);
        }),
        $(document).on("click", "#GrabConfirmDeleteSKU", function () {
            var e = $(this).attr("value");
            $("#GrabDeleteSKUConfirmationModal").modal("hide"),
                $("#GrabSKUTable").fadeOut(420, function () {
                    $.fn.DataTable.isDataTable("#GrabSKUTable") &&
                        $("#GrabSKUTable").DataTable().destroy(),
                        a(),
                        $(this).fadeIn(480);
                }),
                $.ajax({
                    async: !0,
                    crossDomain: !0,
                    url: "/api/ssd/sftp/grab-delete-sku/" + e,
                    // url:
                    //     "http://localhost:8802/api/ssd/sftp/grab-delete-sku/" +
                    //     e,
                    method: "GET",
                    headers: { Accept: "*/*" },
                })
                    .done(function (a) {
                        console.log(a);
                    })
                    .fail(function (a) {
                        console.error(a);
                    });
        }),
        $(document).ready(function () {
            $("#GrabAddSKUModalButton").click(function () {
                var e = $("#GrabAddSKUNumber").val();
                var t = $("#GrabAddPiecetoPack").val();

                var isEInteger = /^[0-9]+$/.test(e);
                var isTInteger = /^[0-9]+$/.test(t);

                let skus = [];

                if (isEInteger && isTInteger) {
                    skus.push({
                        SKU_Number: parseInt(e, 10),
                        grab_pack: parseInt(t, 10),
                    });
                } else {
                    $("#addSKUNotif").text(
                        "One or both values are not valid integers. Please enter valid integer values."
                    );
                    return;
                }
                let result = JSON.stringify(skus, null, 2);
                $("#GrabAddSKUModal").modal("hide"),
                    $("#GrabSKUTable").fadeOut(420, function () {
                        $.fn.DataTable.isDataTable("#GrabSKUTable") &&
                            $("#GrabSKUTable").DataTable().destroy(),
                            a(),
                            $(this).fadeIn(480);
                    }),
                    $.ajax({
                        type: "POST",
                        url: "/api/ssd/sftp/grab-add-sku",
                        // url: "http://localhost:8802/api/ssd/sftp/grab-add-sku",

                        contentType: "application/json",
                        data: result,
                        success: function (response) {
                            $("#addSKUNotif").text(response["message"]);
                            console.log(response);
                        },
                        error: function (error) {
                            $("#addSKUNotif").text(response["message"]);
                            console.log(response);
                        },
                    });
                console.log(result);
            });
        });
});
