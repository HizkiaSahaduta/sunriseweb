!(function (e) {
    var t = {};
    function s(r) {
        if (t[r]) return t[r].exports;
        var a = (t[r] = { i: r, l: !1, exports: {} });
        return e[r].call(a.exports, a, a.exports, s), (a.l = !0), a.exports;
    }
    (s.m = e),
        (s.c = t),
        (s.d = function (e, t, r) {
            s.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: r });
        }),
        (s.r = function (e) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
        }),
        (s.t = function (e, t) {
            if ((1 & t && (e = s(e)), 8 & t)) return e;
            if (4 & t && "object" == typeof e && e && e.__esModule) return e;
            var r = Object.create(null);
            if ((s.r(r), Object.defineProperty(r, "default", { enumerable: !0, value: e }), 2 & t && "string" != typeof e))
                for (var a in e)
                    s.d(
                        r,
                        a,
                        function (t) {
                            return e[t];
                        }.bind(null, a)
                    );
            return r;
        }),
        (s.n = function (e) {
            var t =
                e && e.__esModule
                    ? function () {
                          return e.default;
                      }
                    : function () {
                          return e;
                      };
            return s.d(t, "a", t), t;
        }),
        (s.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (s.p = "/materialize-material-design-admin-template/laravel/demo-1/"),
        s((s.s = 2));
})({
    2: function (e, t, s) {
        e.exports = s("z01h");
    },
    z01h: function (e, t) {
        var s = $(".search-list li"),
            r = $(".search-list"),
            a = $(".content-overlay"),
            n = $(".search-sm"),
            i = $(".search-input-sm .search-box-sm"),
            l = $(".search-list-sm");
        $(function () {
            "use strict";
            if (
                ($(".header-search-input")
                    .focus(function () {
                        $(this).parent("div").addClass("header-search-wrapper-focus");
                    })
                    .blur(function () {
                        $(this).parent("div").removeClass("header-search-wrapper-focus");
                    }),
                $(".search-button").click(function (e) {
                    n.is(":hidden") ? (n.show(), i.focus()) : (n.hide(), i.val(""));
                }),
                $(".search-input-sm").on("click", function () {
                    i.focus();
                }),
                $(".search-sm-close").click(function (e) {
                    n.hide(), i.val("");
                }),
                $(".search-list").length > 0)
            )
                var e = new PerfectScrollbar(".search-list", { wheelSpeed: 2, wheelPropagation: !1, minScrollbarLength: 20 });
            if (l.length > 0) var t = new PerfectScrollbar(".search-list-sm", { wheelSpeed: 2, wheelPropagation: !1, minScrollbarLength: 20 });
            var o = $(".header-search-wrapper .header-search-input,.search-input-sm .search-box-sm").data("search");
            $(".search-sm-close").on("click", function () {
                i.val(""), i.blur(), s.remove(), r.addClass("display-none"), a.hasClass("show") && a.removeClass("show");
            }),
                a.on("click", function () {
                    s.remove(), a.removeClass("show"), n.hide(), i.val(""), r.addClass("display-none"), $(".search-input-sm .search-box-sm, .header-search-input").val("");
                }),
                $(".header-search-wrapper .header-search-input, .search-input-sm .search-box-sm").on("keyup", function (e) {
                    a.addClass("show"), r.removeClass("display-none");
                    var t = $(this);
                    if (38 !== e.keyCode && 40 !== e.keyCode && 13 !== e.keyCode) {
                        27 == e.keyCode && (a.removeClass("show"), t.val(""), t.blur());
                        var s = $(this).val().toLowerCase();
                        if (($("ul.search-list li").remove(), "" != s)) {
                            var n = "",
                                i = "",
                                c = "",
                                h = 0;
                            $.getJSON("json/" + o + ".json", function (e) {
                                for (var t = 0; t < e.listItems.length; t++)
                                    ((0 == e.listItems[t].name.toLowerCase().indexOf(s) && h < 4) || (0 != e.listItems[t].name.toLowerCase().indexOf(s) && e.listItems[t].name.toLowerCase().indexOf(s) > -1 && h < 4)) &&
                                        ((n +=
                                            '<li class="auto-suggestion ' +
                                            (0 === h ? "current_item" : "") +
                                            '"><a class="collection-item" href=' +
                                            e.listItems[t].url +
                                            '><div class="display-flex"><div class="display-flex align-item-center flex-grow-1"><span class="material-icons" data-icon="' +
                                            e.listItems[t].icon +
                                            '">' +
                                            e.listItems[t].icon +
                                            '</span><div class="member-info display-flex flex-column"><span class="black-text">' +
                                            e.listItems[t].name +
                                            '</span><small class="grey-text">' +
                                            e.listItems[t].category +
                                            "</small></div></div></div></a></li>"),
                                        h++);
                                "" == n && "" == i && (i = $("#search-not-found").html());
                                var r = $("#page-search-title").html(),
                                    a = $("#default-search-main").html();
                                (c = r.concat(n, i, a)), $("ul.search-list").html(c);
                            });
                        } else a.hasClass("show") && (a.removeClass("show"), r.addClass("display-none"));
                    }
                    $(".header-search-wrapper .current_item").length && (r.scrollTop(0), r.scrollTop($(".search-list .current_item:first").offset().top - r.height())),
                        $(".search-input-sm .current_item").length && (l.scrollTop(0), l.scrollTop($(".search-list-sm .current_item:first").offset().top - l.height()));
                }),
                $("#navbarForm").on("submit", function (e) {
                    e.preventDefault();
                }),
                $(window).on("keydown", function (e) {
                    var t,
                        s,
                        r = $(".search-list li.current_item");
                    if (
                        (40 === e.keyCode ? ((t = r.next()), r.removeClass("current_item"), (r = t.addClass("current_item"))) : 38 === e.keyCode && ((s = r.prev()), r.removeClass("current_item"), (r = s.addClass("current_item"))),
                        13 === e.keyCode && $(".search-list li.current_item").length > 0)
                    ) {
                        var a = $("li.current_item a");
                        (window.location = $("li.current_item a").attr("href")), $(a).trigger("click");
                    }
                }),
                r.mouseenter(function () {
                    $(".search-list").length > 0 && e.update(), l.length > 0 && t.update();
                }),
                $(document).on("mouseenter", ".search-list li", function (e) {
                    $(this).siblings().removeClass("current_item"), $(this).addClass("current_item");
                }),
                $(document).on("click", ".search-list li", function (e) {
                    e.stopPropagation();
                });
        }),
            $(window).on("resize", function () {
                $(window).width() < 992 && ($(".header-search-input").val(""), $(".header-search-input").closest(".search-list li").remove()), $(window).width() > 993 && (n.hide(), i.val(""), $(".search-input-sm .search-box-sm").val(""));
            });
    },
});
