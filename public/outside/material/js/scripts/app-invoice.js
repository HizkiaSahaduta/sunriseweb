$(document).ready(function () {
    if ($(".invoice-data-table").length) {
        $(".invoice-data-table").DataTable({
            columnDefs: [
                { targets: 0, className: "control" },
                { orderable: !0, targets: 1, checkboxes: { selectRow: !0 } },
                { targets: [0, 1], orderable: !1 },
                { orderable: !1, targets: 8 },
            ],
            order: [2, "asc"],
            dom: '<"top display-flex  mb-2"<"action-filters"f><"actions action-btns display-flex align-items-center">><"clear">rt<"bottom"p>',
            language: { search: "", searchPlaceholder: "Search Invoice" },
            select: { style: "multi", selector: "td:first-child>", items: "row" },
            responsive: { details: { type: "column", target: 0 } },
        });
        var e = $(".invoice-filter-action"),
            t = $(".invoice-create-btn"),
            i = $(".filter-btn");
        $(".action-btns").append(e, t), $(".dataTables_filter label").append(i);
    }
    var n = 1;
    $(".invoice-item-repeater").length &&
        $(".invoice-item-repeater").repeater({
            show: function () {
                $(this)
                    .find(".dropdown-button")
                    .attr("data-target", "dropdown-discount" + n),
                    $(this)
                        .find(".dropdown-content")
                        .attr("id", "dropdown-discount" + n),
                    n++,
                    $(this).slideDown();
            },
            hide: function (e) {
                $(this).slideUp(e);
            },
        }),
        $(document).on("click", ".invoice-apply-btn", function () {
            var e = $(this),
                t = e.closest(".dropdown-content").find("#discount").val(),
                i = e.closest(".dropdown-content").find("#Tax1 option:selected").val(),
                n = e.closest(".dropdown-content").find("#Tax2 option:selected").val();
            e
                .parents()
                .eq(4)
                .find(".discount-value")
                .html(t + "%"),
                e.parents().eq(4).find(".tax1").html(i),
                e.parents().eq(4).find(".tax2").html(n),
                $(".dropdown-button").dropdown("close");
        }),
        $(document).on("click", ".invoice-cancel-btn", function () {
            $(".dropdown-button").dropdown("close");
        }),
        $(document).on("change", ".invoice-item-select", function (e) {
            switch (this.options[e.target.selectedIndex].text) {
                case "Frest Admin Template":
                    $(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("The most developer friendly & highly customisable HTML5 Admin");
                    break;
                case "Stack Admin Template":
                    $(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("Ultimate Bootstrap 4 Admin Template for Next Generation Applications.");
                    break;
                case "Robust Admin Template":
                    $(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("Robust admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities");
                    break;
                case "Apex Admin Template":
                    $(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("Developer friendly and highly customizable Angular 7+ jQuery Free Bootstrap 4 gradient ui admin template. ");
                    break;
                case "Modern Admin Template":
                    $(e.target).closest(".invoice-item-filed").find(".invoice-item-desc").val("The most complete & feature packed bootstrap 4 admin template of 2019!");
            }
        }),
        $(".dropdown-button").dropdown({ constrainWidth: !1, closeOnClick: !1 }),
        $(document).on("click", ".invoice-repeat-btn", function (e) {
            $(".dropdown-button").dropdown({ constrainWidth: !1, closeOnClick: !1 });
        }),
        $(".invoice-print").length > 0 &&
            $(".invoice-print").on("click", function () {
                window.print();
            });
});
