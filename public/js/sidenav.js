$("#leftside-navigation .parent > a").click(function (e) {
    e.preventDefault();
    var i = $("#leftside-navigation ul").not($(this).parents("ul"));
    if (
        (i.slideUp(),
        i.parent().removeClass("open"),
        !$(this).next().is(":visible"))
    ) {
        var a = $(this).next();
        a.slideDown(), a.parent().not(".open").addClass("open");
    }
    e.stopPropagation();
}),
    $("#GrabSku").click(function (e) {
        $("#toast-container")
            .removeClass("view-visible")
            .addClass("view-hidden"),
            $("#sftpGrab").removeClass("view-hidden").addClass("view-visible"),
            $("#sftpGrabStore")
                .removeClass("view-visible")
                .addClass("view-hidden");
    }),
    $("#ssd-logo").click(function (e) {
        $("#sftpGrab").removeClass("view-visible").addClass("view-hidden"),
            $("#toast-container")
                .removeClass("view-hidden")
                .addClass("view-visible"),
            $("#sftpGrabStore")
                .removeClass("view-visible")
                .addClass("view-hidden");
    }),
    $("#GrabStore").click(function (e) {
        $("#sftpGrab").removeClass("view-visible").addClass("view-hidden"),
            $("#toast-container")
                .removeClass("view-visible")
                .addClass("view-hidden"),
            $("#sftpGrabStore")
                .removeClass("view-hidden")
                .addClass("view-visible");
    });
//
//   }), //! // Call the function to initialize the vendor table
