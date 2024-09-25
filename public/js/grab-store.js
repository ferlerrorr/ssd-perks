$(document).ready(function () {
    function a() {
        $("#GrabStoreTable").DataTable({
            ajax: {
                url: "/api/ssd/sftp/grab-stores",
                // url: "http://localhost:8802/api/ssd/sftp/grab-stores",
                dataSrc: "",
            },
            columns: [
                { data: "istore" },
                {
                    data: null,
                    render: function (data, type, row) {
                        // Assuming "grab" is the property name containing the grab value
                        var grabValue = row.grab;
                        var store = row.istore;

                        // Set the checkbox value based on the grab value
                        var isChecked = grabValue === 1;

                        // Check if grabValue is null or 0, and update isChecked accordingly
                        if (grabValue === null || grabValue === 0) {
                            isChecked = false;
                        }

                        // Generate the checkbox HTML
                        return `
            <div class="toggle-body">
                <div class="can-toggle" id="${store}">
                    <input id="${store}" type="checkbox" data-store-id="${store}"  onchange="logCheckboxId(this)" ${
                            isChecked ? "checked" : ""
                        }>
                </div>
            </div>
        `;
                    },
                },
                { data: null, render: e },
            ],
            paging: true,
            searching: true,
        });
    }
    function e(a, e, t) {
        return `

      <button type="button" class="btn btn-danger"
        data-toggle="modal" data-target="#GrabDeleteStoreConfirmationModal"
        data-store-id="${a.istore}">Delete
      </button>`;
    }

    a(), //! // Call the function to initialize the store table
        $("#GrabDeleteStoreConfirmationModal").on(
            "show.bs.modal",
            function (a) {
                var e = $(a.relatedTarget);
                t = e.data("store-id");
                $("#GrabConfirmDeleteStore").val(t);
            }
        ),
        $(document).on("click", "#GrabConfirmDeleteStore", function () {
            var e = $(this).attr("value");
            $("#GrabDeleteStoreConfirmationModal").modal("hide"),
                $("#GrabStoreTable").fadeOut(420, function () {
                    $.fn.DataTable.isDataTable("#GrabStoreTable") &&
                        $("#GrabStoreTable").DataTable().destroy(),
                        a(),
                        $(this).fadeIn(480);
                }),
                $.ajax({
                    async: !0,
                    crossDomain: !0,
                    url: "/api/ssd/sftp/grab-delete-store-maintenance/" + e,
                    // url:
                    //     "http://localhost:8802/api/ssd/sftp/grab-delete-store-maintenance/" +
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
        $("#GrabAddStoreModalButton").click(function () {
            var storeId = parseInt($("#GrabAddStoreId").val(), 10);

            if (isNaN(storeId)) {
                console.log("Store Id must be a number");
            } else {
                var ajaxOptions = {
                    async: true,
                    crossDomain: true,
                    url: "/api/ssd/sftp/create-grab-store",
                    // url: "http://localhost:8802/api/ssd/sftp/create-grab-store",
                    method: "POST",
                    headers: {
                        Accept: "*/*",
                        "Content-Type": "application/json",
                    },
                    processData: false,
                    data: JSON.stringify([storeId]),
                };
                $.ajax(ajaxOptions).done(function (response) {
                    console.log(response);
                });
            }

            $("#GrabStoreTable").fadeOut(420, function () {
                if ($.fn.DataTable.isDataTable("#GrabStoreTable")) {
                    $("#GrabStoreTable").DataTable().destroy();
                }
                a();
                $(this).fadeIn(480);
                $("#GrabAddStoreModal").modal("hide");
            });
        });
});
//!------------------->
function logCheckboxId(checkbox) {
    if ($(checkbox).prop("checked")) {
        let e = $(checkbox).attr("id");
        $.ajax({
            async: !0,
            crossDomain: !0,
            url: "/api/ssd/sftp/grab-update-store-maintenance/" + e,
            // url:
            //     "http://localhost:8802/api/ssd/sftp/grab-update-store-maintenance/" +
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
    } else {
        e = $(checkbox).attr("id");
        $.ajax({
            async: !0,
            crossDomain: !0,
            url: "/api/ssd/sftp/grab-update-store-maintenance/" + e,
            // url:
            //     "http://localhost:8802/api/ssd/sftp/grab-update-store-maintenance/" +
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
    }
}
