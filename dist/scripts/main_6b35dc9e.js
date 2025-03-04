!(function (e) {
  var t = {};
  function n(i) {
    if (t[i]) return t[i].exports;
    var o = (t[i] = { i: i, l: !1, exports: {} });
    return e[i].call(o.exports, o, o.exports, n), (o.l = !0), o.exports;
  }
  (n.m = e),
    (n.c = t),
    (n.d = function (e, t, i) {
      n.o(e, t) ||
        Object.defineProperty(e, t, {
          configurable: !1,
          enumerable: !0,
          get: i,
        });
    }),
    (n.n = function (e) {
      var t =
        e && e.__esModule
          ? function () {
              return e.default;
            }
          : function () {
              return e;
            };
      return n.d(t, "a", t), t;
    }),
    (n.o = function (e, t) {
      return Object.prototype.hasOwnProperty.call(e, t);
    }),
    (n.p = "/wp-content/themes/ihh/dist/"),
    n((n.s = 1));
})([
  function (e, t) {
    e.exports = jQuery;
  },
  function (e, t, n) {
    n(2), (e.exports = n(12));
  },
  function (e, t, n) {
    "use strict";
    Object.defineProperty(t, "__esModule", { value: !0 }),
      function (e) {
        var t = n(0),
          i = (n.n(t), n(3)),
          o = (n.n(i), n(4), n(8)),
          r = n(10),
          s = n(11),
          a = new o.a({ common: r.a, home: s.a });
        e(document).ready(function () {
          return a.loadEvents();
        });
      }.call(t, n(0));
  },
  function (e, t, n) {
    (function (e) {
      !(function (e) {
        "use strict";
        var t,
          n,
          i,
          o,
          r,
          s,
          a,
          l,
          c,
          u,
          d,
          h,
          f,
          p,
          m,
          g,
          v,
          _,
          b,
          y,
          E,
          w,
          T,
          C,
          S,
          I,
          D,
          k,
          A,
          O,
          N,
          x,
          L,
          P,
          M,
          H,
          R,
          j,
          F,
          W,
          U;
        e.fn.extend({
          venobox: function (B) {
            var q = this,
              V = e.extend(
                {
                  arrowsColor: "#B6B6B6",
                  autoplay: !1,
                  bgcolor: "#fff",
                  border: "0",
                  closeBackground: "#161617",
                  closeColor: "#d2d2d2",
                  framewidth: "",
                  frameheight: "",
                  gallItems: !1,
                  infinigall: !1,
                  htmlClose: "&times;",
                  htmlNext: "<span>Next</span>",
                  htmlPrev: "<span>Prev</span>",
                  numeratio: !1,
                  numerationBackground: "#161617",
                  numerationColor: "#d2d2d2",
                  numerationPosition: "top",
                  overlayClose: !0,
                  overlayColor: "rgba(23,23,23,0.85)",
                  spinner: "double-bounce",
                  spinColor: "#d2d2d2",
                  titleattr: "title",
                  titleBackground: "#161617",
                  titleColor: "#d2d2d2",
                  titlePosition: "top",
                  cb_pre_open: function () {
                    return !0;
                  },
                  cb_post_open: function () {},
                  cb_pre_close: function () {
                    return !0;
                  },
                  cb_post_close: function () {},
                  cb_post_resize: function () {},
                  cb_after_nav: function () {},
                  cb_content_loaded: function () {},
                  cb_init: function () {},
                },
                B
              );
            return (
              V.cb_init(q),
              this.each(function () {
                if ((A = e(this)).data("venobox")) return !0;
                function B() {
                  (E = A.data("gall")),
                    (v = A.data("numeratio")),
                    (h = A.data("gallItems")),
                    (f = A.data("infinigall")),
                    (p = h || e('.vbox-item[data-gall="' + E + '"]')),
                    (w = p.eq(p.index(A) + 1)),
                    (T = p.eq(p.index(A) - 1)),
                    w.length || !0 !== f || (w = p.eq(0)),
                    p.length >= 1
                      ? ((O = p.index(A) + 1), i.html(O + " / " + p.length))
                      : (O = 1),
                    !0 === v ? i.show() : i.hide(),
                    "" !== y ? o.show() : o.hide(),
                    w.length || !0 === f
                      ? (e(".vbox-next").css("display", "block"), (C = !0))
                      : (e(".vbox-next").css("display", "none"), (C = !1)),
                    p.index(A) > 0 || !0 === f
                      ? (e(".vbox-prev").css("display", "block"), (S = !0))
                      : (e(".vbox-prev").css("display", "none"), (S = !1)),
                    (!0 !== S && !0 !== C) ||
                      (a.on(Z.DOWN, X), a.on(Z.MOVE, G), a.on(Z.UP, $));
                }
                function K(e) {
                  return (
                    !(e.length < 1) &&
                    !m &&
                    ((m = !0),
                    (_ = e.data("overlay") || e.data("overlaycolor")),
                    (u = e.data("framewidth")),
                    (d = e.data("frameheight")),
                    (r = e.data("border")),
                    (n = e.data("bgcolor")),
                    (l = e.data("href") || e.attr("href")),
                    (t = e.data("autoplay")),
                    (y =
                      (e.data("titleattr") && e.attr(e.data("titleattr"))) ||
                      ""),
                    e === T &&
                      a.addClass("vbox-animated").addClass("swipe-right"),
                    e === w &&
                      a.addClass("vbox-animated").addClass("swipe-left"),
                    D.show(),
                    void a.animate({ opacity: 0 }, 500, function () {
                      b.css("background", _),
                        a
                          .removeClass("vbox-animated")
                          .removeClass("swipe-left")
                          .removeClass("swipe-right")
                          .css({ "margin-left": 0, "margin-right": 0 }),
                        "iframe" == e.data("vbtype")
                          ? ie()
                          : "inline" == e.data("vbtype")
                          ? re()
                          : "ajax" == e.data("vbtype")
                          ? ne()
                          : "video" == e.data("vbtype")
                          ? oe(t)
                          : (a.html('<img src="' + l + '">'), se()),
                        (A = e),
                        B(),
                        (m = !1),
                        V.cb_after_nav(A, O, w, T);
                    }))
                  );
                }
                function Q(e) {
                  27 === e.keyCode && Y(),
                    37 == e.keyCode && !0 === S && K(T),
                    39 == e.keyCode && !0 === C && K(w);
                }
                function Y() {
                  if (!1 === V.cb_pre_close(A, O, w, T)) return !1;
                  e("body").off("keydown", Q).removeClass("vbox-open"),
                    A.focus(),
                    b.animate({ opacity: 0 }, 500, function () {
                      b.remove(), (m = !1), V.cb_post_close();
                    });
                }
                (q.VBclose = function () {
                  Y();
                }),
                  A.addClass("vbox-item"),
                  A.data("framewidth", V.framewidth),
                  A.data("frameheight", V.frameheight),
                  A.data("border", V.border),
                  A.data("bgcolor", V.bgcolor),
                  A.data("numeratio", V.numeratio),
                  A.data("gallItems", V.gallItems),
                  A.data("infinigall", V.infinigall),
                  A.data("overlaycolor", V.overlayColor),
                  A.data("titleattr", V.titleattr),
                  A.data("venobox", !0),
                  A.on("click", function (h) {
                    if (
                      (h.preventDefault(),
                      (A = e(this)),
                      !1 === V.cb_pre_open(A))
                    )
                      return !1;
                    switch (
                      ((q.VBnext = function () {
                        K(w);
                      }),
                      (q.VBprev = function () {
                        K(T);
                      }),
                      (_ = A.data("overlay") || A.data("overlaycolor")),
                      (u = A.data("framewidth")),
                      (d = A.data("frameheight")),
                      (t = A.data("autoplay") || V.autoplay),
                      (r = A.data("border")),
                      (n = A.data("bgcolor")),
                      (C = !1),
                      (S = !1),
                      (m = !1),
                      (l = A.data("href") || A.attr("href")),
                      (c = A.data("css") || ""),
                      (y = A.attr(A.data("titleattr")) || ""),
                      (I = '<div class="vbox-preloader">'),
                      V.spinner)
                    ) {
                      case "rotating-plane":
                        I += '<div class="sk-rotating-plane"></div>';
                        break;
                      case "double-bounce":
                        I +=
                          '<div class="sk-double-bounce"><div class="sk-child sk-double-bounce1"></div><div class="sk-child sk-double-bounce2"></div></div>';
                        break;
                      case "wave":
                        I +=
                          '<div class="sk-wave"><div class="sk-rect sk-rect1"></div><div class="sk-rect sk-rect2"></div><div class="sk-rect sk-rect3"></div><div class="sk-rect sk-rect4"></div><div class="sk-rect sk-rect5"></div></div>';
                        break;
                      case "wandering-cubes":
                        I +=
                          '<div class="sk-wandering-cubes"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div></div>';
                        break;
                      case "spinner-pulse":
                        I += '<div class="sk-spinner sk-spinner-pulse"></div>';
                        break;
                      case "chasing-dots":
                        I +=
                          '<div class="sk-chasing-dots"><div class="sk-child sk-dot1"></div><div class="sk-child sk-dot2"></div></div>';
                        break;
                      case "three-bounce":
                        I +=
                          '<div class="sk-three-bounce"><div class="sk-child sk-bounce1"></div><div class="sk-child sk-bounce2"></div><div class="sk-child sk-bounce3"></div></div>';
                        break;
                      case "circle":
                        I +=
                          '<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>';
                        break;
                      case "cube-grid":
                        I +=
                          '<div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>';
                        break;
                      case "fading-circle":
                        I +=
                          '<div class="sk-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
                        break;
                      case "folding-cube":
                        I +=
                          '<div class="sk-folding-cube"><div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div>';
                    }
                    return (
                      (I += "</div>"),
                      (k =
                        '<a class="vbox-next">' +
                        V.htmlNext +
                        '</a><a class="vbox-prev">' +
                        V.htmlPrev +
                        "</a>"),
                      (x =
                        '<div class="vbox-title"></div><div class="vbox-num">0/0</div><div class="vbox-close">' +
                        V.htmlClose +
                        "</div>"),
                      (s =
                        '<div class="vbox-overlay ' +
                        c +
                        '" style="background:' +
                        _ +
                        '">' +
                        I +
                        '<div class="vbox-container"><div class="vbox-content"></div></div>' +
                        x +
                        k +
                        "</div>"),
                      e("body").append(s).addClass("vbox-open"),
                      e(
                        ".vbox-preloader div:not(.sk-circle) .sk-child, .vbox-preloader .sk-rotating-plane, .vbox-preloader .sk-rect, .vbox-preloader div:not(.sk-folding-cube) .sk-cube, .vbox-preloader .sk-spinner-pulse"
                      ).css("background-color", V.spinColor),
                      (b = e(".vbox-overlay")),
                      e(".vbox-container"),
                      (a = e(".vbox-content")),
                      (i = e(".vbox-num")),
                      (o = e(".vbox-title")),
                      (D = e(".vbox-preloader")).show(),
                      o.css(V.titlePosition, "-1px"),
                      o.css({
                        color: V.titleColor,
                        "background-color": V.titleBackground,
                      }),
                      e(".vbox-close").css({
                        color: V.closeColor,
                        "background-color": V.closeBackground,
                      }),
                      e(".vbox-num").css(V.numerationPosition, "-1px"),
                      e(".vbox-num").css({
                        color: V.numerationColor,
                        "background-color": V.numerationBackground,
                      }),
                      e(".vbox-next span, .vbox-prev span").css({
                        "border-top-color": V.arrowsColor,
                        "border-right-color": V.arrowsColor,
                      }),
                      a.html(""),
                      a.css("opacity", "0"),
                      b.css("opacity", "0"),
                      B(),
                      b.animate({ opacity: 1 }, 250, function () {
                        "iframe" == A.data("vbtype")
                          ? ie()
                          : "inline" == A.data("vbtype")
                          ? re()
                          : "ajax" == A.data("vbtype")
                          ? ne()
                          : "video" == A.data("vbtype")
                          ? oe(t)
                          : (a.html('<img src="' + l + '">'), se()),
                          V.cb_post_open(A, O, w, T);
                      }),
                      e("body").keydown(Q),
                      e(".vbox-prev").on("click", function () {
                        K(T);
                      }),
                      e(".vbox-next").on("click", function () {
                        K(w);
                      }),
                      !1
                    );
                  });
                var z = ".vbox-overlay";
                function X(e) {
                  a.addClass("vbox-animated"),
                    (P = H = e.pageY),
                    (M = R = e.pageX),
                    (N = !0);
                }
                function G(e) {
                  if (!0 === N) {
                    (R = e.pageX), (H = e.pageY), (F = R - M), (W = H - P);
                    var t = Math.abs(F);
                    t > Math.abs(W) &&
                      t <= 100 &&
                      (e.preventDefault(), a.css("margin-left", F));
                  }
                }
                function $(e) {
                  if (!0 === N) {
                    N = !1;
                    var t = A,
                      n = !1;
                    (j = R - M) < 0 && !0 === C && ((t = w), (n = !0)),
                      j > 0 && !0 === S && ((t = T), (n = !0)),
                      Math.abs(j) >= U && !0 === n
                        ? K(t)
                        : a.css({ "margin-left": 0, "margin-right": 0 });
                  }
                }
                V.overlayClose || (z = ".vbox-close"),
                  e("body").on("click touchstart", z, function (t) {
                    (e(t.target).is(".vbox-overlay") ||
                      e(t.target).is(".vbox-content") ||
                      e(t.target).is(".vbox-close") ||
                      e(t.target).is(".vbox-preloader") ||
                      e(t.target).is(".vbox-container")) &&
                      Y();
                  }),
                  (M = 0),
                  (R = 0),
                  (j = 0),
                  (U = 50),
                  (N = !1);
                var Z = {
                    DOWN: "touchmousedown",
                    UP: "touchmouseup",
                    MOVE: "touchmousemove",
                  },
                  J = function (t) {
                    var n;
                    switch (t.type) {
                      case "mousedown":
                        n = Z.DOWN;
                        break;
                      case "mouseup":
                      case "mouseout":
                        n = Z.UP;
                        break;
                      case "mousemove":
                        n = Z.MOVE;
                        break;
                      default:
                        return;
                    }
                    var i = te(n, t, t.pageX, t.pageY);
                    e(t.target).trigger(i);
                  },
                  ee = function (t) {
                    var n;
                    switch (t.type) {
                      case "touchstart":
                        n = Z.DOWN;
                        break;
                      case "touchend":
                        n = Z.UP;
                        break;
                      case "touchmove":
                        n = Z.MOVE;
                        break;
                      default:
                        return;
                    }
                    var i,
                      o = t.originalEvent.touches[0];
                    (i =
                      n == Z.UP
                        ? te(n, t, null, null)
                        : te(n, t, o.pageX, o.pageY)),
                      e(t.target).trigger(i);
                  },
                  te = function (t, n, i, o) {
                    return e.Event(t, { pageX: i, pageY: o, originalEvent: n });
                  };
                function ne() {
                  e.ajax({ url: l, cache: !1 })
                    .done(function (e) {
                      a.html('<div class="vbox-inline">' + e + "</div>"), se();
                    })
                    .fail(function () {
                      a.html(
                        '<div class="vbox-inline"><p>Error retrieving contents, please retry</div>'
                      ),
                        ae();
                    });
                }
                function ie() {
                  a.html('<iframe class="venoframe" src="' + l + '"></iframe>'),
                    ae();
                }
                function oe(e) {
                  var t,
                    n = (function (e) {
                      var t;
                      return (
                        l.match(
                          /(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/
                        ),
                        RegExp.$3.indexOf("youtu") > -1
                          ? (t = "youtube")
                          : RegExp.$3.indexOf("vimeo") > -1 && (t = "vimeo"),
                        { type: t, id: RegExp.$6 }
                      );
                    })(),
                    i =
                      (e ? "?rel=0&autoplay=1" : "?rel=0") +
                      (function (e) {
                        var t = "",
                          n = decodeURIComponent(l).split("?");
                        if (void 0 !== n[1]) {
                          var i,
                            o,
                            r = n[1].split("&");
                          for (o = 0; o < r.length; o++)
                            t = t + "&" + (i = r[o].split("="))[0] + "=" + i[1];
                        }
                        return encodeURI(t);
                      })();
                  "vimeo" == n.type
                    ? (t = "https://player.vimeo.com/video/")
                    : "youtube" == n.type &&
                      (t = "https://www.youtube.com/embed/"),
                    a.html(
                      '<iframe class="venoframe vbvid" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay" frameborder="0" src="' +
                        t +
                        n.id +
                        i +
                        '"></iframe>'
                    ),
                    ae();
                }
                function re() {
                  a.html('<div class="vbox-inline">' + e(l).html() + "</div>"),
                    ae();
                }
                function se() {
                  (L = a.find("img")).length
                    ? L.each(function () {
                        e(this).one("load", function () {
                          ae();
                        });
                      })
                    : ae();
                }
                function ae() {
                  o.html(y),
                    a
                      .find(">:first-child")
                      .addClass("vbox-figlio")
                      .css({ width: u, height: d, padding: r, background: n }),
                    e("img.vbox-figlio").on("dragstart", function (e) {
                      e.preventDefault();
                    }),
                    le(),
                    a.animate({ opacity: "1" }, "slow", function () {
                      D.hide();
                    }),
                    V.cb_content_loaded(A, O, w, T);
                }
                function le() {
                  var t = a.outerHeight(),
                    n = e(window).height();
                  (g = t + 60 < n ? (n - t) / 2 : "30px"),
                    a.css("margin-top", g),
                    a.css("margin-bottom", g),
                    V.cb_post_resize();
                }
                "ontouchstart" in window
                  ? (e(document).on("touchstart", ee),
                    e(document).on("touchmove", ee),
                    e(document).on("touchend", ee))
                  : (e(document).on("mousedown", J),
                    e(document).on("mouseup", J),
                    e(document).on("mouseout", J),
                    e(document).on("mousemove", J)),
                  e(window).resize(function () {
                    e(".vbox-content").length && setTimeout(le(), 800);
                  });
              })
            );
          },
        });
      })(e);
    }).call(t, n(0));
  },
  function (e, t, n) {
    "use strict";
    var i = n(5);
    n.n(i);
  },
  function (e, t, n) {
    (function (e, t, n) {
      "use strict";
      function i(e, t) {
        for (var n = 0; n < t.length; n++) {
          var i = t[n];
          (i.enumerable = i.enumerable || !1),
            (i.configurable = !0),
            "value" in i && (i.writable = !0),
            Object.defineProperty(e, i.key, i);
        }
      }
      function o(e, t, n) {
        return t && i(e.prototype, t), n && i(e, n), e;
      }
      function r(e, t, n) {
        return (
          t in e
            ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0,
              })
            : (e[t] = n),
          e
        );
      }
      function s(e) {
        for (var t = arguments, n = 1; n < arguments.length; n++) {
          var i = null != t[n] ? t[n] : {},
            o = Object.keys(i);
          "function" == typeof Object.getOwnPropertySymbols &&
            (o = o.concat(
              Object.getOwnPropertySymbols(i).filter(function (e) {
                return Object.getOwnPropertyDescriptor(i, e).enumerable;
              })
            )),
            o.forEach(function (t) {
              r(e, t, i[t]);
            });
        }
        return e;
      }
      (t = t && t.hasOwnProperty("default") ? t.default : t),
        (n = n && n.hasOwnProperty("default") ? n.default : n);
      var a = "transitionend";
      function l(e) {
        var n = this,
          i = !1;
        return (
          t(this).one(c.TRANSITION_END, function () {
            i = !0;
          }),
          setTimeout(function () {
            i || c.triggerTransitionEnd(n);
          }, e),
          this
        );
      }
      var c = {
        TRANSITION_END: "bsTransitionEnd",
        getUID: function (e) {
          do {
            e += ~~(1e6 * Math.random());
          } while (document.getElementById(e));
          return e;
        },
        getSelectorFromElement: function (e) {
          var t = e.getAttribute("data-target");
          if (!t || "#" === t) {
            var n = e.getAttribute("href");
            t = n && "#" !== n ? n.trim() : "";
          }
          try {
            return document.querySelector(t) ? t : null;
          } catch (e) {
            return null;
          }
        },
        getTransitionDurationFromElement: function (e) {
          if (!e) return 0;
          var n = t(e).css("transition-duration"),
            i = t(e).css("transition-delay"),
            o = parseFloat(n),
            r = parseFloat(i);
          return o || r
            ? ((n = n.split(",")[0]),
              (i = i.split(",")[0]),
              1e3 * (parseFloat(n) + parseFloat(i)))
            : 0;
        },
        reflow: function (e) {
          return e.offsetHeight;
        },
        triggerTransitionEnd: function (e) {
          t(e).trigger(a);
        },
        supportsTransitionEnd: function () {
          return Boolean(a);
        },
        isElement: function (e) {
          return (e[0] || e).nodeType;
        },
        typeCheckConfig: function (e, t, n) {
          for (var i in n)
            if (Object.prototype.hasOwnProperty.call(n, i)) {
              var o = n[i],
                r = t[i],
                s =
                  r && c.isElement(r)
                    ? "element"
                    : ((a = r),
                      {}.toString
                        .call(a)
                        .match(/\s([a-z]+)/i)[1]
                        .toLowerCase());
              if (!new RegExp(o).test(s))
                throw new Error(
                  e.toUpperCase() +
                    ': Option "' +
                    i +
                    '" provided type "' +
                    s +
                    '" but expected type "' +
                    o +
                    '".'
                );
            }
          var a;
        },
        findShadowRoot: function (e) {
          if (!document.documentElement.attachShadow) return null;
          if ("function" == typeof e.getRootNode) {
            var t = e.getRootNode();
            return t instanceof ShadowRoot ? t : null;
          }
          return e instanceof ShadowRoot
            ? e
            : e.parentNode
            ? c.findShadowRoot(e.parentNode)
            : null;
        },
      };
      (t.fn.emulateTransitionEnd = l),
        (t.event.special[c.TRANSITION_END] = {
          bindType: a,
          delegateType: a,
          handle: function (e) {
            if (t(e.target).is(this))
              return e.handleObj.handler.apply(this, arguments);
          },
        });
      var u = t.fn.alert,
        d = {
          CLOSE: "close.bs.alert",
          CLOSED: "closed.bs.alert",
          CLICK_DATA_API: "click.bs.alert.data-api",
        },
        h = "alert",
        f = "fade",
        p = "show",
        m = (function () {
          function e(e) {
            this._element = e;
          }
          var n = e.prototype;
          return (
            (n.close = function (e) {
              var t = this._element;
              e && (t = this._getRootElement(e)),
                this._triggerCloseEvent(t).isDefaultPrevented() ||
                  this._removeElement(t);
            }),
            (n.dispose = function () {
              t.removeData(this._element, "bs.alert"), (this._element = null);
            }),
            (n._getRootElement = function (e) {
              var n = c.getSelectorFromElement(e),
                i = !1;
              return (
                n && (i = document.querySelector(n)),
                i || (i = t(e).closest("." + h)[0]),
                i
              );
            }),
            (n._triggerCloseEvent = function (e) {
              var n = t.Event(d.CLOSE);
              return t(e).trigger(n), n;
            }),
            (n._removeElement = function (e) {
              var n = this;
              if ((t(e).removeClass(p), t(e).hasClass(f))) {
                var i = c.getTransitionDurationFromElement(e);
                t(e)
                  .one(c.TRANSITION_END, function (t) {
                    return n._destroyElement(e, t);
                  })
                  .emulateTransitionEnd(i);
              } else this._destroyElement(e);
            }),
            (n._destroyElement = function (e) {
              t(e).detach().trigger(d.CLOSED).remove();
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this),
                  o = i.data("bs.alert");
                o || ((o = new e(this)), i.data("bs.alert", o)),
                  "close" === n && o[n](this);
              });
            }),
            (e._handleDismiss = function (e) {
              return function (t) {
                t && t.preventDefault(), e.close(this);
              };
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
            ]),
            e
          );
        })();
      t(document).on(
        d.CLICK_DATA_API,
        '[data-dismiss="alert"]',
        m._handleDismiss(new m())
      ),
        (t.fn.alert = m._jQueryInterface),
        (t.fn.alert.Constructor = m),
        (t.fn.alert.noConflict = function () {
          return (t.fn.alert = u), m._jQueryInterface;
        });
      var g = t.fn.button,
        v = "active",
        _ = "btn",
        b = "focus",
        y = '[data-toggle^="button"]',
        E = '[data-toggle="buttons"]',
        w = 'input:not([type="hidden"])',
        T = ".active",
        C = ".btn",
        S = {
          CLICK_DATA_API: "click.bs.button.data-api",
          FOCUS_BLUR_DATA_API:
            "focus.bs.button.data-api blur.bs.button.data-api",
        },
        I = (function () {
          function e(e) {
            this._element = e;
          }
          var n = e.prototype;
          return (
            (n.toggle = function () {
              var e = !0,
                n = !0,
                i = t(this._element).closest(E)[0];
              if (i) {
                var o = this._element.querySelector(w);
                if (o) {
                  if ("radio" === o.type)
                    if (o.checked && this._element.classList.contains(v))
                      e = !1;
                    else {
                      var r = i.querySelector(T);
                      r && t(r).removeClass(v);
                    }
                  if (e) {
                    if (
                      o.hasAttribute("disabled") ||
                      i.hasAttribute("disabled") ||
                      o.classList.contains("disabled") ||
                      i.classList.contains("disabled")
                    )
                      return;
                    (o.checked = !this._element.classList.contains(v)),
                      t(o).trigger("change");
                  }
                  o.focus(), (n = !1);
                }
              }
              n &&
                this._element.setAttribute(
                  "aria-pressed",
                  !this._element.classList.contains(v)
                ),
                e && t(this._element).toggleClass(v);
            }),
            (n.dispose = function () {
              t.removeData(this._element, "bs.button"), (this._element = null);
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this).data("bs.button");
                i || ((i = new e(this)), t(this).data("bs.button", i)),
                  "toggle" === n && i[n]();
              });
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
            ]),
            e
          );
        })();
      t(document)
        .on(S.CLICK_DATA_API, y, function (e) {
          e.preventDefault();
          var n = e.target;
          t(n).hasClass(_) || (n = t(n).closest(C)),
            I._jQueryInterface.call(t(n), "toggle");
        })
        .on(S.FOCUS_BLUR_DATA_API, y, function (e) {
          var n = t(e.target).closest(C)[0];
          t(n).toggleClass(b, /^focus(in)?$/.test(e.type));
        }),
        (t.fn.button = I._jQueryInterface),
        (t.fn.button.Constructor = I),
        (t.fn.button.noConflict = function () {
          return (t.fn.button = g), I._jQueryInterface;
        });
      var D = "carousel",
        k = ".bs.carousel",
        A = t.fn[D],
        O = {
          interval: 5e3,
          keyboard: !0,
          slide: !1,
          pause: "hover",
          wrap: !0,
          touch: !0,
        },
        N = {
          interval: "(number|boolean)",
          keyboard: "boolean",
          slide: "(boolean|string)",
          pause: "(string|boolean)",
          wrap: "boolean",
          touch: "boolean",
        },
        x = "next",
        L = "prev",
        P = "left",
        M = "right",
        H = {
          SLIDE: "slide.bs.carousel",
          SLID: "slid.bs.carousel",
          KEYDOWN: "keydown.bs.carousel",
          MOUSEENTER: "mouseenter.bs.carousel",
          MOUSELEAVE: "mouseleave.bs.carousel",
          TOUCHSTART: "touchstart.bs.carousel",
          TOUCHMOVE: "touchmove.bs.carousel",
          TOUCHEND: "touchend.bs.carousel",
          POINTERDOWN: "pointerdown.bs.carousel",
          POINTERUP: "pointerup.bs.carousel",
          DRAG_START: "dragstart.bs.carousel",
          LOAD_DATA_API: "load.bs.carousel.data-api",
          CLICK_DATA_API: "click.bs.carousel.data-api",
        },
        R = "carousel",
        j = "active",
        F = "slide",
        W = "carousel-item-right",
        U = "carousel-item-left",
        B = "carousel-item-next",
        q = "carousel-item-prev",
        V = "pointer-event",
        K = {
          ACTIVE: ".active",
          ACTIVE_ITEM: ".active.carousel-item",
          ITEM: ".carousel-item",
          ITEM_IMG: ".carousel-item img",
          NEXT_PREV: ".carousel-item-next, .carousel-item-prev",
          INDICATORS: ".carousel-indicators",
          DATA_SLIDE: "[data-slide], [data-slide-to]",
          DATA_RIDE: '[data-ride="carousel"]',
        },
        Q = { TOUCH: "touch", PEN: "pen" },
        Y = (function () {
          function e(e, t) {
            (this._items = null),
              (this._interval = null),
              (this._activeElement = null),
              (this._isPaused = !1),
              (this._isSliding = !1),
              (this.touchTimeout = null),
              (this.touchStartX = 0),
              (this.touchDeltaX = 0),
              (this._config = this._getConfig(t)),
              (this._element = e),
              (this._indicatorsElement = this._element.querySelector(
                K.INDICATORS
              )),
              (this._touchSupported =
                "ontouchstart" in document.documentElement ||
                navigator.maxTouchPoints > 0),
              (this._pointerEvent = Boolean(
                window.PointerEvent || window.MSPointerEvent
              )),
              this._addEventListeners();
          }
          var n = e.prototype;
          return (
            (n.next = function () {
              this._isSliding || this._slide(x);
            }),
            (n.nextWhenVisible = function () {
              !document.hidden &&
                t(this._element).is(":visible") &&
                "hidden" !== t(this._element).css("visibility") &&
                this.next();
            }),
            (n.prev = function () {
              this._isSliding || this._slide(L);
            }),
            (n.pause = function (e) {
              e || (this._isPaused = !0),
                this._element.querySelector(K.NEXT_PREV) &&
                  (c.triggerTransitionEnd(this._element), this.cycle(!0)),
                clearInterval(this._interval),
                (this._interval = null);
            }),
            (n.cycle = function (e) {
              e || (this._isPaused = !1),
                this._interval &&
                  (clearInterval(this._interval), (this._interval = null)),
                this._config.interval &&
                  !this._isPaused &&
                  (this._interval = setInterval(
                    (document.visibilityState
                      ? this.nextWhenVisible
                      : this.next
                    ).bind(this),
                    this._config.interval
                  ));
            }),
            (n.to = function (e) {
              var n = this;
              this._activeElement = this._element.querySelector(K.ACTIVE_ITEM);
              var i = this._getItemIndex(this._activeElement);
              if (!(e > this._items.length - 1 || e < 0))
                if (this._isSliding)
                  t(this._element).one(H.SLID, function () {
                    return n.to(e);
                  });
                else {
                  if (i === e) return this.pause(), void this.cycle();
                  var o = e > i ? x : L;
                  this._slide(o, this._items[e]);
                }
            }),
            (n.dispose = function () {
              t(this._element).off(k),
                t.removeData(this._element, "bs.carousel"),
                (this._items = null),
                (this._config = null),
                (this._element = null),
                (this._interval = null),
                (this._isPaused = null),
                (this._isSliding = null),
                (this._activeElement = null),
                (this._indicatorsElement = null);
            }),
            (n._getConfig = function (e) {
              return (e = s({}, O, e)), c.typeCheckConfig(D, e, N), e;
            }),
            (n._handleSwipe = function () {
              var e = Math.abs(this.touchDeltaX);
              if (!(e <= 40)) {
                var t = e / this.touchDeltaX;
                t > 0 && this.prev(), t < 0 && this.next();
              }
            }),
            (n._addEventListeners = function () {
              var e = this;
              this._config.keyboard &&
                t(this._element).on(H.KEYDOWN, function (t) {
                  return e._keydown(t);
                }),
                "hover" === this._config.pause &&
                  t(this._element)
                    .on(H.MOUSEENTER, function (t) {
                      return e.pause(t);
                    })
                    .on(H.MOUSELEAVE, function (t) {
                      return e.cycle(t);
                    }),
                this._config.touch && this._addTouchEventListeners();
            }),
            (n._addTouchEventListeners = function () {
              var e = this;
              if (this._touchSupported) {
                var n = function (t) {
                    e._pointerEvent &&
                    Q[t.originalEvent.pointerType.toUpperCase()]
                      ? (e.touchStartX = t.originalEvent.clientX)
                      : e._pointerEvent ||
                        (e.touchStartX = t.originalEvent.touches[0].clientX);
                  },
                  i = function (t) {
                    e._pointerEvent &&
                      Q[t.originalEvent.pointerType.toUpperCase()] &&
                      (e.touchDeltaX = t.originalEvent.clientX - e.touchStartX),
                      e._handleSwipe(),
                      "hover" === e._config.pause &&
                        (e.pause(),
                        e.touchTimeout && clearTimeout(e.touchTimeout),
                        (e.touchTimeout = setTimeout(function (t) {
                          return e.cycle(t);
                        }, 500 + e._config.interval)));
                  };
                t(this._element.querySelectorAll(K.ITEM_IMG)).on(
                  H.DRAG_START,
                  function (e) {
                    return e.preventDefault();
                  }
                ),
                  this._pointerEvent
                    ? (t(this._element).on(H.POINTERDOWN, function (e) {
                        return n(e);
                      }),
                      t(this._element).on(H.POINTERUP, function (e) {
                        return i(e);
                      }),
                      this._element.classList.add(V))
                    : (t(this._element).on(H.TOUCHSTART, function (e) {
                        return n(e);
                      }),
                      t(this._element).on(H.TOUCHMOVE, function (t) {
                        return (function (t) {
                          t.originalEvent.touches &&
                          t.originalEvent.touches.length > 1
                            ? (e.touchDeltaX = 0)
                            : (e.touchDeltaX =
                                t.originalEvent.touches[0].clientX -
                                e.touchStartX);
                        })(t);
                      }),
                      t(this._element).on(H.TOUCHEND, function (e) {
                        return i(e);
                      }));
              }
            }),
            (n._keydown = function (e) {
              if (!/input|textarea/i.test(e.target.tagName))
                switch (e.which) {
                  case 37:
                    e.preventDefault(), this.prev();
                    break;
                  case 39:
                    e.preventDefault(), this.next();
                }
            }),
            (n._getItemIndex = function (e) {
              return (
                (this._items =
                  e && e.parentNode
                    ? [].slice.call(e.parentNode.querySelectorAll(K.ITEM))
                    : []),
                this._items.indexOf(e)
              );
            }),
            (n._getItemByDirection = function (e, t) {
              var n = e === x,
                i = e === L,
                o = this._getItemIndex(t),
                r = this._items.length - 1;
              if (((i && 0 === o) || (n && o === r)) && !this._config.wrap)
                return t;
              var s = (o + (e === L ? -1 : 1)) % this._items.length;
              return -1 === s
                ? this._items[this._items.length - 1]
                : this._items[s];
            }),
            (n._triggerSlideEvent = function (e, n) {
              var i = this._getItemIndex(e),
                o = this._getItemIndex(
                  this._element.querySelector(K.ACTIVE_ITEM)
                ),
                r = t.Event(H.SLIDE, {
                  relatedTarget: e,
                  direction: n,
                  from: o,
                  to: i,
                });
              return t(this._element).trigger(r), r;
            }),
            (n._setActiveIndicatorElement = function (e) {
              if (this._indicatorsElement) {
                var n = [].slice.call(
                  this._indicatorsElement.querySelectorAll(K.ACTIVE)
                );
                t(n).removeClass(j);
                var i = this._indicatorsElement.children[this._getItemIndex(e)];
                i && t(i).addClass(j);
              }
            }),
            (n._slide = function (e, n) {
              var i,
                o,
                r,
                s = this,
                a = this._element.querySelector(K.ACTIVE_ITEM),
                l = this._getItemIndex(a),
                u = n || (a && this._getItemByDirection(e, a)),
                d = this._getItemIndex(u),
                h = Boolean(this._interval);
              if (
                (e === x
                  ? ((i = U), (o = B), (r = P))
                  : ((i = W), (o = q), (r = M)),
                u && t(u).hasClass(j))
              )
                this._isSliding = !1;
              else if (
                !this._triggerSlideEvent(u, r).isDefaultPrevented() &&
                a &&
                u
              ) {
                (this._isSliding = !0),
                  h && this.pause(),
                  this._setActiveIndicatorElement(u);
                var f = t.Event(H.SLID, {
                  relatedTarget: u,
                  direction: r,
                  from: l,
                  to: d,
                });
                if (t(this._element).hasClass(F)) {
                  t(u).addClass(o),
                    c.reflow(u),
                    t(a).addClass(i),
                    t(u).addClass(i);
                  var p = parseInt(u.getAttribute("data-interval"), 10);
                  p
                    ? ((this._config.defaultInterval =
                        this._config.defaultInterval || this._config.interval),
                      (this._config.interval = p))
                    : (this._config.interval =
                        this._config.defaultInterval || this._config.interval);
                  var m = c.getTransitionDurationFromElement(a);
                  t(a)
                    .one(c.TRANSITION_END, function () {
                      t(u)
                        .removeClass(i + " " + o)
                        .addClass(j),
                        t(a).removeClass(j + " " + o + " " + i),
                        (s._isSliding = !1),
                        setTimeout(function () {
                          return t(s._element).trigger(f);
                        }, 0);
                    })
                    .emulateTransitionEnd(m);
                } else
                  t(a).removeClass(j),
                    t(u).addClass(j),
                    (this._isSliding = !1),
                    t(this._element).trigger(f);
                h && this.cycle();
              }
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this).data("bs.carousel"),
                  o = s({}, O, t(this).data());
                "object" == typeof n && (o = s({}, o, n));
                var r = "string" == typeof n ? n : o.slide;
                if (
                  (i || ((i = new e(this, o)), t(this).data("bs.carousel", i)),
                  "number" == typeof n)
                )
                  i.to(n);
                else if ("string" == typeof r) {
                  if (void 0 === i[r])
                    throw new TypeError('No method named "' + r + '"');
                  i[r]();
                } else o.interval && o.ride && (i.pause(), i.cycle());
              });
            }),
            (e._dataApiClickHandler = function (n) {
              var i = c.getSelectorFromElement(this);
              if (i) {
                var o = t(i)[0];
                if (o && t(o).hasClass(R)) {
                  var r = s({}, t(o).data(), t(this).data()),
                    a = this.getAttribute("data-slide-to");
                  a && (r.interval = !1),
                    e._jQueryInterface.call(t(o), r),
                    a && t(o).data("bs.carousel").to(a),
                    n.preventDefault();
                }
              }
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
              {
                key: "Default",
                get: function () {
                  return O;
                },
              },
            ]),
            e
          );
        })();
      t(document).on(H.CLICK_DATA_API, K.DATA_SLIDE, Y._dataApiClickHandler),
        t(window).on(H.LOAD_DATA_API, function () {
          for (
            var e = [].slice.call(document.querySelectorAll(K.DATA_RIDE)),
              n = 0,
              i = e.length;
            n < i;
            n++
          ) {
            var o = t(e[n]);
            Y._jQueryInterface.call(o, o.data());
          }
        }),
        (t.fn[D] = Y._jQueryInterface),
        (t.fn[D].Constructor = Y),
        (t.fn[D].noConflict = function () {
          return (t.fn[D] = A), Y._jQueryInterface;
        });
      var z = "collapse",
        X = t.fn[z],
        G = { toggle: !0, parent: "" },
        $ = { toggle: "boolean", parent: "(string|element)" },
        Z = {
          SHOW: "show.bs.collapse",
          SHOWN: "shown.bs.collapse",
          HIDE: "hide.bs.collapse",
          HIDDEN: "hidden.bs.collapse",
          CLICK_DATA_API: "click.bs.collapse.data-api",
        },
        J = "show",
        ee = "collapse",
        te = "collapsing",
        ne = "collapsed",
        ie = "width",
        oe = "height",
        re = {
          ACTIVES: ".show, .collapsing",
          DATA_TOGGLE: '[data-toggle="collapse"]',
        },
        se = (function () {
          function e(e, t) {
            (this._isTransitioning = !1),
              (this._element = e),
              (this._config = this._getConfig(t)),
              (this._triggerArray = [].slice.call(
                document.querySelectorAll(
                  '[data-toggle="collapse"][href="#' +
                    e.id +
                    '"],[data-toggle="collapse"][data-target="#' +
                    e.id +
                    '"]'
                )
              ));
            for (
              var n = [].slice.call(document.querySelectorAll(re.DATA_TOGGLE)),
                i = 0,
                o = n.length;
              i < o;
              i++
            ) {
              var r = n[i],
                s = c.getSelectorFromElement(r),
                a = [].slice
                  .call(document.querySelectorAll(s))
                  .filter(function (t) {
                    return t === e;
                  });
              null !== s &&
                a.length > 0 &&
                ((this._selector = s), this._triggerArray.push(r));
            }
            (this._parent = this._config.parent ? this._getParent() : null),
              this._config.parent ||
                this._addAriaAndCollapsedClass(
                  this._element,
                  this._triggerArray
                ),
              this._config.toggle && this.toggle();
          }
          var n = e.prototype;
          return (
            (n.toggle = function () {
              t(this._element).hasClass(J) ? this.hide() : this.show();
            }),
            (n.show = function () {
              var n,
                i,
                o = this;
              if (
                !this._isTransitioning &&
                !t(this._element).hasClass(J) &&
                (this._parent &&
                  0 ===
                    (n = [].slice
                      .call(this._parent.querySelectorAll(re.ACTIVES))
                      .filter(function (e) {
                        return "string" == typeof o._config.parent
                          ? e.getAttribute("data-parent") === o._config.parent
                          : e.classList.contains(ee);
                      })).length &&
                  (n = null),
                !(
                  n &&
                  (i = t(n).not(this._selector).data("bs.collapse")) &&
                  i._isTransitioning
                ))
              ) {
                var r = t.Event(Z.SHOW);
                if ((t(this._element).trigger(r), !r.isDefaultPrevented())) {
                  n &&
                    (e._jQueryInterface.call(t(n).not(this._selector), "hide"),
                    i || t(n).data("bs.collapse", null));
                  var s = this._getDimension();
                  t(this._element).removeClass(ee).addClass(te),
                    (this._element.style[s] = 0),
                    this._triggerArray.length &&
                      t(this._triggerArray)
                        .removeClass(ne)
                        .attr("aria-expanded", !0),
                    this.setTransitioning(!0);
                  var a = "scroll" + (s[0].toUpperCase() + s.slice(1)),
                    l = c.getTransitionDurationFromElement(this._element);
                  t(this._element)
                    .one(c.TRANSITION_END, function () {
                      t(o._element).removeClass(te).addClass(ee).addClass(J),
                        (o._element.style[s] = ""),
                        o.setTransitioning(!1),
                        t(o._element).trigger(Z.SHOWN);
                    })
                    .emulateTransitionEnd(l),
                    (this._element.style[s] = this._element[a] + "px");
                }
              }
            }),
            (n.hide = function () {
              var e = this;
              if (!this._isTransitioning && t(this._element).hasClass(J)) {
                var n = t.Event(Z.HIDE);
                if ((t(this._element).trigger(n), !n.isDefaultPrevented())) {
                  var i = this._getDimension();
                  (this._element.style[i] =
                    this._element.getBoundingClientRect()[i] + "px"),
                    c.reflow(this._element),
                    t(this._element)
                      .addClass(te)
                      .removeClass(ee)
                      .removeClass(J);
                  var o = this._triggerArray.length;
                  if (o > 0)
                    for (var r = 0; r < o; r++) {
                      var s = this._triggerArray[r],
                        a = c.getSelectorFromElement(s);
                      if (null !== a)
                        t([].slice.call(document.querySelectorAll(a))).hasClass(
                          J
                        ) || t(s).addClass(ne).attr("aria-expanded", !1);
                    }
                  this.setTransitioning(!0);
                  this._element.style[i] = "";
                  var l = c.getTransitionDurationFromElement(this._element);
                  t(this._element)
                    .one(c.TRANSITION_END, function () {
                      e.setTransitioning(!1),
                        t(e._element)
                          .removeClass(te)
                          .addClass(ee)
                          .trigger(Z.HIDDEN);
                    })
                    .emulateTransitionEnd(l);
                }
              }
            }),
            (n.setTransitioning = function (e) {
              this._isTransitioning = e;
            }),
            (n.dispose = function () {
              t.removeData(this._element, "bs.collapse"),
                (this._config = null),
                (this._parent = null),
                (this._element = null),
                (this._triggerArray = null),
                (this._isTransitioning = null);
            }),
            (n._getConfig = function (e) {
              return (
                ((e = s({}, G, e)).toggle = Boolean(e.toggle)),
                c.typeCheckConfig(z, e, $),
                e
              );
            }),
            (n._getDimension = function () {
              return t(this._element).hasClass(ie) ? ie : oe;
            }),
            (n._getParent = function () {
              var n,
                i = this;
              c.isElement(this._config.parent)
                ? ((n = this._config.parent),
                  void 0 !== this._config.parent.jquery &&
                    (n = this._config.parent[0]))
                : (n = document.querySelector(this._config.parent));
              var o =
                  '[data-toggle="collapse"][data-parent="' +
                  this._config.parent +
                  '"]',
                r = [].slice.call(n.querySelectorAll(o));
              return (
                t(r).each(function (t, n) {
                  i._addAriaAndCollapsedClass(e._getTargetFromElement(n), [n]);
                }),
                n
              );
            }),
            (n._addAriaAndCollapsedClass = function (e, n) {
              var i = t(e).hasClass(J);
              n.length && t(n).toggleClass(ne, !i).attr("aria-expanded", i);
            }),
            (e._getTargetFromElement = function (e) {
              var t = c.getSelectorFromElement(e);
              return t ? document.querySelector(t) : null;
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this),
                  o = i.data("bs.collapse"),
                  r = s({}, G, i.data(), "object" == typeof n && n ? n : {});
                if (
                  (!o && r.toggle && /show|hide/.test(n) && (r.toggle = !1),
                  o || ((o = new e(this, r)), i.data("bs.collapse", o)),
                  "string" == typeof n)
                ) {
                  if (void 0 === o[n])
                    throw new TypeError('No method named "' + n + '"');
                  o[n]();
                }
              });
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
              {
                key: "Default",
                get: function () {
                  return G;
                },
              },
            ]),
            e
          );
        })();
      t(document).on(Z.CLICK_DATA_API, re.DATA_TOGGLE, function (e) {
        "A" === e.currentTarget.tagName && e.preventDefault();
        var n = t(this),
          i = c.getSelectorFromElement(this),
          o = [].slice.call(document.querySelectorAll(i));
        t(o).each(function () {
          var e = t(this),
            i = e.data("bs.collapse") ? "toggle" : n.data();
          se._jQueryInterface.call(e, i);
        });
      }),
        (t.fn[z] = se._jQueryInterface),
        (t.fn[z].Constructor = se),
        (t.fn[z].noConflict = function () {
          return (t.fn[z] = X), se._jQueryInterface;
        });
      var ae = "dropdown",
        le = t.fn[ae],
        ce = new RegExp("38|40|27"),
        ue = {
          HIDE: "hide.bs.dropdown",
          HIDDEN: "hidden.bs.dropdown",
          SHOW: "show.bs.dropdown",
          SHOWN: "shown.bs.dropdown",
          CLICK: "click.bs.dropdown",
          CLICK_DATA_API: "click.bs.dropdown.data-api",
          KEYDOWN_DATA_API: "keydown.bs.dropdown.data-api",
          KEYUP_DATA_API: "keyup.bs.dropdown.data-api",
        },
        de = "disabled",
        he = "show",
        fe = "dropup",
        pe = "dropright",
        me = "dropleft",
        ge = "dropdown-menu-right",
        ve = "position-static",
        _e = '[data-toggle="dropdown"]',
        be = ".dropdown form",
        ye = ".dropdown-menu",
        Ee = ".navbar-nav",
        we = ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
        Te = "top-start",
        Ce = "top-end",
        Se = "bottom-start",
        Ie = "bottom-end",
        De = "right-start",
        ke = "left-start",
        Ae = {
          offset: 0,
          flip: !0,
          boundary: "scrollParent",
          reference: "toggle",
          display: "dynamic",
        },
        Oe = {
          offset: "(number|string|function)",
          flip: "boolean",
          boundary: "(string|element)",
          reference: "(string|element)",
          display: "string",
        },
        Ne = (function () {
          function e(e, t) {
            (this._element = e),
              (this._popper = null),
              (this._config = this._getConfig(t)),
              (this._menu = this._getMenuElement()),
              (this._inNavbar = this._detectNavbar()),
              this._addEventListeners();
          }
          var i = e.prototype;
          return (
            (i.toggle = function () {
              if (!this._element.disabled && !t(this._element).hasClass(de)) {
                var i = e._getParentFromElement(this._element),
                  o = t(this._menu).hasClass(he);
                if ((e._clearMenus(), !o)) {
                  var r = { relatedTarget: this._element },
                    s = t.Event(ue.SHOW, r);
                  if ((t(i).trigger(s), !s.isDefaultPrevented())) {
                    if (!this._inNavbar) {
                      if (void 0 === n)
                        throw new TypeError(
                          "Bootstrap's dropdowns require Popper.js (https://popper.js.org/)"
                        );
                      var a = this._element;
                      "parent" === this._config.reference
                        ? (a = i)
                        : c.isElement(this._config.reference) &&
                          ((a = this._config.reference),
                          void 0 !== this._config.reference.jquery &&
                            (a = this._config.reference[0])),
                        "scrollParent" !== this._config.boundary &&
                          t(i).addClass(ve),
                        (this._popper = new n(
                          a,
                          this._menu,
                          this._getPopperConfig()
                        ));
                    }
                    "ontouchstart" in document.documentElement &&
                      0 === t(i).closest(Ee).length &&
                      t(document.body).children().on("mouseover", null, t.noop),
                      this._element.focus(),
                      this._element.setAttribute("aria-expanded", !0),
                      t(this._menu).toggleClass(he),
                      t(i).toggleClass(he).trigger(t.Event(ue.SHOWN, r));
                  }
                }
              }
            }),
            (i.show = function () {
              if (
                !(
                  this._element.disabled ||
                  t(this._element).hasClass(de) ||
                  t(this._menu).hasClass(he)
                )
              ) {
                var n = { relatedTarget: this._element },
                  i = t.Event(ue.SHOW, n),
                  o = e._getParentFromElement(this._element);
                t(o).trigger(i),
                  i.isDefaultPrevented() ||
                    (t(this._menu).toggleClass(he),
                    t(o).toggleClass(he).trigger(t.Event(ue.SHOWN, n)));
              }
            }),
            (i.hide = function () {
              if (
                !this._element.disabled &&
                !t(this._element).hasClass(de) &&
                t(this._menu).hasClass(he)
              ) {
                var n = { relatedTarget: this._element },
                  i = t.Event(ue.HIDE, n),
                  o = e._getParentFromElement(this._element);
                t(o).trigger(i),
                  i.isDefaultPrevented() ||
                    (t(this._menu).toggleClass(he),
                    t(o).toggleClass(he).trigger(t.Event(ue.HIDDEN, n)));
              }
            }),
            (i.dispose = function () {
              t.removeData(this._element, "bs.dropdown"),
                t(this._element).off(".bs.dropdown"),
                (this._element = null),
                (this._menu = null),
                null !== this._popper &&
                  (this._popper.destroy(), (this._popper = null));
            }),
            (i.update = function () {
              (this._inNavbar = this._detectNavbar()),
                null !== this._popper && this._popper.scheduleUpdate();
            }),
            (i._addEventListeners = function () {
              var e = this;
              t(this._element).on(ue.CLICK, function (t) {
                t.preventDefault(), t.stopPropagation(), e.toggle();
              });
            }),
            (i._getConfig = function (e) {
              return (
                (e = s(
                  {},
                  this.constructor.Default,
                  t(this._element).data(),
                  e
                )),
                c.typeCheckConfig(ae, e, this.constructor.DefaultType),
                e
              );
            }),
            (i._getMenuElement = function () {
              if (!this._menu) {
                var t = e._getParentFromElement(this._element);
                t && (this._menu = t.querySelector(ye));
              }
              return this._menu;
            }),
            (i._getPlacement = function () {
              var e = t(this._element.parentNode),
                n = Se;
              return (
                e.hasClass(fe)
                  ? ((n = Te), t(this._menu).hasClass(ge) && (n = Ce))
                  : e.hasClass(pe)
                  ? (n = De)
                  : e.hasClass(me)
                  ? (n = ke)
                  : t(this._menu).hasClass(ge) && (n = Ie),
                n
              );
            }),
            (i._detectNavbar = function () {
              return t(this._element).closest(".navbar").length > 0;
            }),
            (i._getOffset = function () {
              var e = this,
                t = {};
              return (
                "function" == typeof this._config.offset
                  ? (t.fn = function (t) {
                      return (
                        (t.offsets = s(
                          {},
                          t.offsets,
                          e._config.offset(t.offsets, e._element) || {}
                        )),
                        t
                      );
                    })
                  : (t.offset = this._config.offset),
                t
              );
            }),
            (i._getPopperConfig = function () {
              var e = {
                placement: this._getPlacement(),
                modifiers: {
                  offset: this._getOffset(),
                  flip: { enabled: this._config.flip },
                  preventOverflow: { boundariesElement: this._config.boundary },
                },
              };
              return (
                "static" === this._config.display &&
                  (e.modifiers.applyStyle = { enabled: !1 }),
                e
              );
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this).data("bs.dropdown");
                if (
                  (i ||
                    ((i = new e(this, "object" == typeof n ? n : null)),
                    t(this).data("bs.dropdown", i)),
                  "string" == typeof n)
                ) {
                  if (void 0 === i[n])
                    throw new TypeError('No method named "' + n + '"');
                  i[n]();
                }
              });
            }),
            (e._clearMenus = function (n) {
              if (
                !n ||
                (3 !== n.which && ("keyup" !== n.type || 9 === n.which))
              )
                for (
                  var i = [].slice.call(document.querySelectorAll(_e)),
                    o = 0,
                    r = i.length;
                  o < r;
                  o++
                ) {
                  var s = e._getParentFromElement(i[o]),
                    a = t(i[o]).data("bs.dropdown"),
                    l = { relatedTarget: i[o] };
                  if ((n && "click" === n.type && (l.clickEvent = n), a)) {
                    var c = a._menu;
                    if (
                      t(s).hasClass(he) &&
                      !(
                        n &&
                        (("click" === n.type &&
                          /input|textarea/i.test(n.target.tagName)) ||
                          ("keyup" === n.type && 9 === n.which)) &&
                        t.contains(s, n.target)
                      )
                    ) {
                      var u = t.Event(ue.HIDE, l);
                      t(s).trigger(u),
                        u.isDefaultPrevented() ||
                          ("ontouchstart" in document.documentElement &&
                            t(document.body)
                              .children()
                              .off("mouseover", null, t.noop),
                          i[o].setAttribute("aria-expanded", "false"),
                          t(c).removeClass(he),
                          t(s).removeClass(he).trigger(t.Event(ue.HIDDEN, l)));
                    }
                  }
                }
            }),
            (e._getParentFromElement = function (e) {
              var t,
                n = c.getSelectorFromElement(e);
              return n && (t = document.querySelector(n)), t || e.parentNode;
            }),
            (e._dataApiKeydownHandler = function (n) {
              if (
                (/input|textarea/i.test(n.target.tagName)
                  ? !(
                      32 === n.which ||
                      (27 !== n.which &&
                        ((40 !== n.which && 38 !== n.which) ||
                          t(n.target).closest(ye).length))
                    )
                  : ce.test(n.which)) &&
                (n.preventDefault(),
                n.stopPropagation(),
                !this.disabled && !t(this).hasClass(de))
              ) {
                var i = e._getParentFromElement(this),
                  o = t(i).hasClass(he);
                if (o && (!o || (27 !== n.which && 32 !== n.which))) {
                  var r = [].slice.call(i.querySelectorAll(we));
                  if (0 !== r.length) {
                    var s = r.indexOf(n.target);
                    38 === n.which && s > 0 && s--,
                      40 === n.which && s < r.length - 1 && s++,
                      s < 0 && (s = 0),
                      r[s].focus();
                  }
                } else {
                  if (27 === n.which) {
                    var a = i.querySelector(_e);
                    t(a).trigger("focus");
                  }
                  t(this).trigger("click");
                }
              }
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
              {
                key: "Default",
                get: function () {
                  return Ae;
                },
              },
              {
                key: "DefaultType",
                get: function () {
                  return Oe;
                },
              },
            ]),
            e
          );
        })();
      t(document)
        .on(ue.KEYDOWN_DATA_API, _e, Ne._dataApiKeydownHandler)
        .on(ue.KEYDOWN_DATA_API, ye, Ne._dataApiKeydownHandler)
        .on(ue.CLICK_DATA_API + " " + ue.KEYUP_DATA_API, Ne._clearMenus)
        .on(ue.CLICK_DATA_API, _e, function (e) {
          e.preventDefault(),
            e.stopPropagation(),
            Ne._jQueryInterface.call(t(this), "toggle");
        })
        .on(ue.CLICK_DATA_API, be, function (e) {
          e.stopPropagation();
        }),
        (t.fn[ae] = Ne._jQueryInterface),
        (t.fn[ae].Constructor = Ne),
        (t.fn[ae].noConflict = function () {
          return (t.fn[ae] = le), Ne._jQueryInterface;
        });
      var xe = t.fn.modal,
        Le = { backdrop: !0, keyboard: !0, focus: !0, show: !0 },
        Pe = {
          backdrop: "(boolean|string)",
          keyboard: "boolean",
          focus: "boolean",
          show: "boolean",
        },
        Me = {
          HIDE: "hide.bs.modal",
          HIDDEN: "hidden.bs.modal",
          SHOW: "show.bs.modal",
          SHOWN: "shown.bs.modal",
          FOCUSIN: "focusin.bs.modal",
          RESIZE: "resize.bs.modal",
          CLICK_DISMISS: "click.dismiss.bs.modal",
          KEYDOWN_DISMISS: "keydown.dismiss.bs.modal",
          MOUSEUP_DISMISS: "mouseup.dismiss.bs.modal",
          MOUSEDOWN_DISMISS: "mousedown.dismiss.bs.modal",
          CLICK_DATA_API: "click.bs.modal.data-api",
        },
        He = "modal-dialog-scrollable",
        Re = "modal-scrollbar-measure",
        je = "modal-backdrop",
        Fe = "modal-open",
        We = "fade",
        Ue = "show",
        Be = {
          DIALOG: ".modal-dialog",
          MODAL_BODY: ".modal-body",
          DATA_TOGGLE: '[data-toggle="modal"]',
          DATA_DISMISS: '[data-dismiss="modal"]',
          FIXED_CONTENT: ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
          STICKY_CONTENT: ".sticky-top",
        },
        qe = (function () {
          function e(e, t) {
            (this._config = this._getConfig(t)),
              (this._element = e),
              (this._dialog = e.querySelector(Be.DIALOG)),
              (this._backdrop = null),
              (this._isShown = !1),
              (this._isBodyOverflowing = !1),
              (this._ignoreBackdropClick = !1),
              (this._isTransitioning = !1),
              (this._scrollbarWidth = 0);
          }
          var n = e.prototype;
          return (
            (n.toggle = function (e) {
              return this._isShown ? this.hide() : this.show(e);
            }),
            (n.show = function (e) {
              var n = this;
              if (!this._isShown && !this._isTransitioning) {
                t(this._element).hasClass(We) && (this._isTransitioning = !0);
                var i = t.Event(Me.SHOW, { relatedTarget: e });
                t(this._element).trigger(i),
                  this._isShown ||
                    i.isDefaultPrevented() ||
                    ((this._isShown = !0),
                    this._checkScrollbar(),
                    this._setScrollbar(),
                    this._adjustDialog(),
                    this._setEscapeEvent(),
                    this._setResizeEvent(),
                    t(this._element).on(
                      Me.CLICK_DISMISS,
                      Be.DATA_DISMISS,
                      function (e) {
                        return n.hide(e);
                      }
                    ),
                    t(this._dialog).on(Me.MOUSEDOWN_DISMISS, function () {
                      t(n._element).one(Me.MOUSEUP_DISMISS, function (e) {
                        t(e.target).is(n._element) &&
                          (n._ignoreBackdropClick = !0);
                      });
                    }),
                    this._showBackdrop(function () {
                      return n._showElement(e);
                    }));
              }
            }),
            (n.hide = function (e) {
              var n = this;
              if (
                (e && e.preventDefault(),
                this._isShown && !this._isTransitioning)
              ) {
                var i = t.Event(Me.HIDE);
                if (
                  (t(this._element).trigger(i),
                  this._isShown && !i.isDefaultPrevented())
                ) {
                  this._isShown = !1;
                  var o = t(this._element).hasClass(We);
                  if (
                    (o && (this._isTransitioning = !0),
                    this._setEscapeEvent(),
                    this._setResizeEvent(),
                    t(document).off(Me.FOCUSIN),
                    t(this._element).removeClass(Ue),
                    t(this._element).off(Me.CLICK_DISMISS),
                    t(this._dialog).off(Me.MOUSEDOWN_DISMISS),
                    o)
                  ) {
                    var r = c.getTransitionDurationFromElement(this._element);
                    t(this._element)
                      .one(c.TRANSITION_END, function (e) {
                        return n._hideModal(e);
                      })
                      .emulateTransitionEnd(r);
                  } else this._hideModal();
                }
              }
            }),
            (n.dispose = function () {
              [window, this._element, this._dialog].forEach(function (e) {
                return t(e).off(".bs.modal");
              }),
                t(document).off(Me.FOCUSIN),
                t.removeData(this._element, "bs.modal"),
                (this._config = null),
                (this._element = null),
                (this._dialog = null),
                (this._backdrop = null),
                (this._isShown = null),
                (this._isBodyOverflowing = null),
                (this._ignoreBackdropClick = null),
                (this._isTransitioning = null),
                (this._scrollbarWidth = null);
            }),
            (n.handleUpdate = function () {
              this._adjustDialog();
            }),
            (n._getConfig = function (e) {
              return (e = s({}, Le, e)), c.typeCheckConfig("modal", e, Pe), e;
            }),
            (n._showElement = function (e) {
              var n = this,
                i = t(this._element).hasClass(We);
              (this._element.parentNode &&
                this._element.parentNode.nodeType === Node.ELEMENT_NODE) ||
                document.body.appendChild(this._element),
                (this._element.style.display = "block"),
                this._element.removeAttribute("aria-hidden"),
                this._element.setAttribute("aria-modal", !0),
                t(this._dialog).hasClass(He)
                  ? (this._dialog.querySelector(Be.MODAL_BODY).scrollTop = 0)
                  : (this._element.scrollTop = 0),
                i && c.reflow(this._element),
                t(this._element).addClass(Ue),
                this._config.focus && this._enforceFocus();
              var o = t.Event(Me.SHOWN, { relatedTarget: e }),
                r = function () {
                  n._config.focus && n._element.focus(),
                    (n._isTransitioning = !1),
                    t(n._element).trigger(o);
                };
              if (i) {
                var s = c.getTransitionDurationFromElement(this._dialog);
                t(this._dialog)
                  .one(c.TRANSITION_END, r)
                  .emulateTransitionEnd(s);
              } else r();
            }),
            (n._enforceFocus = function () {
              var e = this;
              t(document)
                .off(Me.FOCUSIN)
                .on(Me.FOCUSIN, function (n) {
                  document !== n.target &&
                    e._element !== n.target &&
                    0 === t(e._element).has(n.target).length &&
                    e._element.focus();
                });
            }),
            (n._setEscapeEvent = function () {
              var e = this;
              this._isShown && this._config.keyboard
                ? t(this._element).on(Me.KEYDOWN_DISMISS, function (t) {
                    27 === t.which && (t.preventDefault(), e.hide());
                  })
                : this._isShown || t(this._element).off(Me.KEYDOWN_DISMISS);
            }),
            (n._setResizeEvent = function () {
              var e = this;
              this._isShown
                ? t(window).on(Me.RESIZE, function (t) {
                    return e.handleUpdate(t);
                  })
                : t(window).off(Me.RESIZE);
            }),
            (n._hideModal = function () {
              var e = this;
              (this._element.style.display = "none"),
                this._element.setAttribute("aria-hidden", !0),
                this._element.removeAttribute("aria-modal"),
                (this._isTransitioning = !1),
                this._showBackdrop(function () {
                  t(document.body).removeClass(Fe),
                    e._resetAdjustments(),
                    e._resetScrollbar(),
                    t(e._element).trigger(Me.HIDDEN);
                });
            }),
            (n._removeBackdrop = function () {
              this._backdrop &&
                (t(this._backdrop).remove(), (this._backdrop = null));
            }),
            (n._showBackdrop = function (e) {
              var n = this,
                i = t(this._element).hasClass(We) ? We : "";
              if (this._isShown && this._config.backdrop) {
                if (
                  ((this._backdrop = document.createElement("div")),
                  (this._backdrop.className = je),
                  i && this._backdrop.classList.add(i),
                  t(this._backdrop).appendTo(document.body),
                  t(this._element).on(Me.CLICK_DISMISS, function (e) {
                    n._ignoreBackdropClick
                      ? (n._ignoreBackdropClick = !1)
                      : e.target === e.currentTarget &&
                        ("static" === n._config.backdrop
                          ? n._element.focus()
                          : n.hide());
                  }),
                  i && c.reflow(this._backdrop),
                  t(this._backdrop).addClass(Ue),
                  !e)
                )
                  return;
                if (!i) return void e();
                var o = c.getTransitionDurationFromElement(this._backdrop);
                t(this._backdrop)
                  .one(c.TRANSITION_END, e)
                  .emulateTransitionEnd(o);
              } else if (!this._isShown && this._backdrop) {
                t(this._backdrop).removeClass(Ue);
                var r = function () {
                  n._removeBackdrop(), e && e();
                };
                if (t(this._element).hasClass(We)) {
                  var s = c.getTransitionDurationFromElement(this._backdrop);
                  t(this._backdrop)
                    .one(c.TRANSITION_END, r)
                    .emulateTransitionEnd(s);
                } else r();
              } else e && e();
            }),
            (n._adjustDialog = function () {
              var e =
                this._element.scrollHeight >
                document.documentElement.clientHeight;
              !this._isBodyOverflowing &&
                e &&
                (this._element.style.paddingLeft = this._scrollbarWidth + "px"),
                this._isBodyOverflowing &&
                  !e &&
                  (this._element.style.paddingRight =
                    this._scrollbarWidth + "px");
            }),
            (n._resetAdjustments = function () {
              (this._element.style.paddingLeft = ""),
                (this._element.style.paddingRight = "");
            }),
            (n._checkScrollbar = function () {
              var e = document.body.getBoundingClientRect();
              (this._isBodyOverflowing = e.left + e.right < window.innerWidth),
                (this._scrollbarWidth = this._getScrollbarWidth());
            }),
            (n._setScrollbar = function () {
              var e = this;
              if (this._isBodyOverflowing) {
                var n = [].slice.call(
                    document.querySelectorAll(Be.FIXED_CONTENT)
                  ),
                  i = [].slice.call(
                    document.querySelectorAll(Be.STICKY_CONTENT)
                  );
                t(n).each(function (n, i) {
                  var o = i.style.paddingRight,
                    r = t(i).css("padding-right");
                  t(i)
                    .data("padding-right", o)
                    .css(
                      "padding-right",
                      parseFloat(r) + e._scrollbarWidth + "px"
                    );
                }),
                  t(i).each(function (n, i) {
                    var o = i.style.marginRight,
                      r = t(i).css("margin-right");
                    t(i)
                      .data("margin-right", o)
                      .css(
                        "margin-right",
                        parseFloat(r) - e._scrollbarWidth + "px"
                      );
                  });
                var o = document.body.style.paddingRight,
                  r = t(document.body).css("padding-right");
                t(document.body)
                  .data("padding-right", o)
                  .css(
                    "padding-right",
                    parseFloat(r) + this._scrollbarWidth + "px"
                  );
              }
              t(document.body).addClass(Fe);
            }),
            (n._resetScrollbar = function () {
              var e = [].slice.call(
                document.querySelectorAll(Be.FIXED_CONTENT)
              );
              t(e).each(function (e, n) {
                var i = t(n).data("padding-right");
                t(n).removeData("padding-right"),
                  (n.style.paddingRight = i || "");
              });
              var n = [].slice.call(
                document.querySelectorAll("" + Be.STICKY_CONTENT)
              );
              t(n).each(function (e, n) {
                var i = t(n).data("margin-right");
                void 0 !== i &&
                  t(n).css("margin-right", i).removeData("margin-right");
              });
              var i = t(document.body).data("padding-right");
              t(document.body).removeData("padding-right"),
                (document.body.style.paddingRight = i || "");
            }),
            (n._getScrollbarWidth = function () {
              var e = document.createElement("div");
              (e.className = Re), document.body.appendChild(e);
              var t = e.getBoundingClientRect().width - e.clientWidth;
              return document.body.removeChild(e), t;
            }),
            (e._jQueryInterface = function (n, i) {
              return this.each(function () {
                var o = t(this).data("bs.modal"),
                  r = s(
                    {},
                    Le,
                    t(this).data(),
                    "object" == typeof n && n ? n : {}
                  );
                if (
                  (o || ((o = new e(this, r)), t(this).data("bs.modal", o)),
                  "string" == typeof n)
                ) {
                  if (void 0 === o[n])
                    throw new TypeError('No method named "' + n + '"');
                  o[n](i);
                } else r.show && o.show(i);
              });
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
              {
                key: "Default",
                get: function () {
                  return Le;
                },
              },
            ]),
            e
          );
        })();
      t(document).on(Me.CLICK_DATA_API, Be.DATA_TOGGLE, function (e) {
        var n,
          i = this,
          o = c.getSelectorFromElement(this);
        o && (n = document.querySelector(o));
        var r = t(n).data("bs.modal")
          ? "toggle"
          : s({}, t(n).data(), t(this).data());
        ("A" !== this.tagName && "AREA" !== this.tagName) || e.preventDefault();
        var a = t(n).one(Me.SHOW, function (e) {
          e.isDefaultPrevented() ||
            a.one(Me.HIDDEN, function () {
              t(i).is(":visible") && i.focus();
            });
        });
        qe._jQueryInterface.call(t(n), r, this);
      }),
        (t.fn.modal = qe._jQueryInterface),
        (t.fn.modal.Constructor = qe),
        (t.fn.modal.noConflict = function () {
          return (t.fn.modal = xe), qe._jQueryInterface;
        });
      var Ve = [
          "background",
          "cite",
          "href",
          "itemtype",
          "longdesc",
          "poster",
          "src",
          "xlink:href",
        ],
        Ke = {
          "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
          a: ["target", "href", "title", "rel"],
          area: [],
          b: [],
          br: [],
          col: [],
          code: [],
          div: [],
          em: [],
          hr: [],
          h1: [],
          h2: [],
          h3: [],
          h4: [],
          h5: [],
          h6: [],
          i: [],
          img: ["src", "alt", "title", "width", "height"],
          li: [],
          ol: [],
          p: [],
          pre: [],
          s: [],
          small: [],
          span: [],
          sub: [],
          sup: [],
          strong: [],
          u: [],
          ul: [],
        },
        Qe = /^(?:(?:https?|mailto|ftp|tel|file):|[^&:/?#]*(?:[/?#]|$))/gi,
        Ye =
          /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+/]+=*$/i;
      function ze(e, t, n) {
        if (0 === e.length) return e;
        if (n && "function" == typeof n) return n(e);
        for (
          var i = new window.DOMParser().parseFromString(e, "text/html"),
            o = Object.keys(t),
            r = [].slice.call(i.body.querySelectorAll("*")),
            s = function (e, n) {
              var i = r[e],
                s = i.nodeName.toLowerCase();
              if (-1 === o.indexOf(i.nodeName.toLowerCase()))
                return i.parentNode.removeChild(i), "continue";
              var a = [].slice.call(i.attributes),
                l = [].concat(t["*"] || [], t[s] || []);
              a.forEach(function (e) {
                (function (e, t) {
                  var n = e.nodeName.toLowerCase();
                  if (-1 !== t.indexOf(n))
                    return (
                      -1 === Ve.indexOf(n) ||
                      Boolean(e.nodeValue.match(Qe) || e.nodeValue.match(Ye))
                    );
                  for (
                    var i = t.filter(function (e) {
                        return e instanceof RegExp;
                      }),
                      o = 0,
                      r = i.length;
                    o < r;
                    o++
                  )
                    if (n.match(i[o])) return !0;
                  return !1;
                })(e, l) || i.removeAttribute(e.nodeName);
              });
            },
            a = 0,
            l = r.length;
          a < l;
          a++
        )
          s(a);
        return i.body.innerHTML;
      }
      var Xe = "tooltip",
        Ge = t.fn.tooltip,
        $e = new RegExp("(^|\\s)bs-tooltip\\S+", "g"),
        Ze = ["sanitize", "whiteList", "sanitizeFn"],
        Je = {
          animation: "boolean",
          template: "string",
          title: "(string|element|function)",
          trigger: "string",
          delay: "(number|object)",
          html: "boolean",
          selector: "(string|boolean)",
          placement: "(string|function)",
          offset: "(number|string|function)",
          container: "(string|element|boolean)",
          fallbackPlacement: "(string|array)",
          boundary: "(string|element)",
          sanitize: "boolean",
          sanitizeFn: "(null|function)",
          whiteList: "object",
        },
        et = {
          AUTO: "auto",
          TOP: "top",
          RIGHT: "right",
          BOTTOM: "bottom",
          LEFT: "left",
        },
        tt = {
          animation: !0,
          template:
            '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
          trigger: "hover focus",
          title: "",
          delay: 0,
          html: !1,
          selector: !1,
          placement: "top",
          offset: 0,
          container: !1,
          fallbackPlacement: "flip",
          boundary: "scrollParent",
          sanitize: !0,
          sanitizeFn: null,
          whiteList: Ke,
        },
        nt = "show",
        it = "out",
        ot = {
          HIDE: "hide.bs.tooltip",
          HIDDEN: "hidden.bs.tooltip",
          SHOW: "show.bs.tooltip",
          SHOWN: "shown.bs.tooltip",
          INSERTED: "inserted.bs.tooltip",
          CLICK: "click.bs.tooltip",
          FOCUSIN: "focusin.bs.tooltip",
          FOCUSOUT: "focusout.bs.tooltip",
          MOUSEENTER: "mouseenter.bs.tooltip",
          MOUSELEAVE: "mouseleave.bs.tooltip",
        },
        rt = "fade",
        st = "show",
        at = ".tooltip-inner",
        lt = ".arrow",
        ct = "hover",
        ut = "focus",
        dt = "click",
        ht = "manual",
        ft = (function () {
          function e(e, t) {
            if (void 0 === n)
              throw new TypeError(
                "Bootstrap's tooltips require Popper.js (https://popper.js.org/)"
              );
            (this._isEnabled = !0),
              (this._timeout = 0),
              (this._hoverState = ""),
              (this._activeTrigger = {}),
              (this._popper = null),
              (this.element = e),
              (this.config = this._getConfig(t)),
              (this.tip = null),
              this._setListeners();
          }
          var i = e.prototype;
          return (
            (i.enable = function () {
              this._isEnabled = !0;
            }),
            (i.disable = function () {
              this._isEnabled = !1;
            }),
            (i.toggleEnabled = function () {
              this._isEnabled = !this._isEnabled;
            }),
            (i.toggle = function (e) {
              if (this._isEnabled)
                if (e) {
                  var n = this.constructor.DATA_KEY,
                    i = t(e.currentTarget).data(n);
                  i ||
                    ((i = new this.constructor(
                      e.currentTarget,
                      this._getDelegateConfig()
                    )),
                    t(e.currentTarget).data(n, i)),
                    (i._activeTrigger.click = !i._activeTrigger.click),
                    i._isWithActiveTrigger()
                      ? i._enter(null, i)
                      : i._leave(null, i);
                } else {
                  if (t(this.getTipElement()).hasClass(st))
                    return void this._leave(null, this);
                  this._enter(null, this);
                }
            }),
            (i.dispose = function () {
              clearTimeout(this._timeout),
                t.removeData(this.element, this.constructor.DATA_KEY),
                t(this.element).off(this.constructor.EVENT_KEY),
                t(this.element).closest(".modal").off("hide.bs.modal"),
                this.tip && t(this.tip).remove(),
                (this._isEnabled = null),
                (this._timeout = null),
                (this._hoverState = null),
                (this._activeTrigger = null),
                null !== this._popper && this._popper.destroy(),
                (this._popper = null),
                (this.element = null),
                (this.config = null),
                (this.tip = null);
            }),
            (i.show = function () {
              var e = this;
              if ("none" === t(this.element).css("display"))
                throw new Error("Please use show on visible elements");
              var i = t.Event(this.constructor.Event.SHOW);
              if (this.isWithContent() && this._isEnabled) {
                t(this.element).trigger(i);
                var o = c.findShadowRoot(this.element),
                  r = t.contains(
                    null !== o ? o : this.element.ownerDocument.documentElement,
                    this.element
                  );
                if (i.isDefaultPrevented() || !r) return;
                var s = this.getTipElement(),
                  a = c.getUID(this.constructor.NAME);
                s.setAttribute("id", a),
                  this.element.setAttribute("aria-describedby", a),
                  this.setContent(),
                  this.config.animation && t(s).addClass(rt);
                var l =
                    "function" == typeof this.config.placement
                      ? this.config.placement.call(this, s, this.element)
                      : this.config.placement,
                  u = this._getAttachment(l);
                this.addAttachmentClass(u);
                var d = this._getContainer();
                t(s).data(this.constructor.DATA_KEY, this),
                  t.contains(
                    this.element.ownerDocument.documentElement,
                    this.tip
                  ) || t(s).appendTo(d),
                  t(this.element).trigger(this.constructor.Event.INSERTED),
                  (this._popper = new n(this.element, s, {
                    placement: u,
                    modifiers: {
                      offset: this._getOffset(),
                      flip: { behavior: this.config.fallbackPlacement },
                      arrow: { element: lt },
                      preventOverflow: {
                        boundariesElement: this.config.boundary,
                      },
                    },
                    onCreate: function (t) {
                      t.originalPlacement !== t.placement &&
                        e._handlePopperPlacementChange(t);
                    },
                    onUpdate: function (t) {
                      return e._handlePopperPlacementChange(t);
                    },
                  })),
                  t(s).addClass(st),
                  "ontouchstart" in document.documentElement &&
                    t(document.body).children().on("mouseover", null, t.noop);
                var h = function () {
                  e.config.animation && e._fixTransition();
                  var n = e._hoverState;
                  (e._hoverState = null),
                    t(e.element).trigger(e.constructor.Event.SHOWN),
                    n === it && e._leave(null, e);
                };
                if (t(this.tip).hasClass(rt)) {
                  var f = c.getTransitionDurationFromElement(this.tip);
                  t(this.tip).one(c.TRANSITION_END, h).emulateTransitionEnd(f);
                } else h();
              }
            }),
            (i.hide = function (e) {
              var n = this,
                i = this.getTipElement(),
                o = t.Event(this.constructor.Event.HIDE),
                r = function () {
                  n._hoverState !== nt &&
                    i.parentNode &&
                    i.parentNode.removeChild(i),
                    n._cleanTipClass(),
                    n.element.removeAttribute("aria-describedby"),
                    t(n.element).trigger(n.constructor.Event.HIDDEN),
                    null !== n._popper && n._popper.destroy(),
                    e && e();
                };
              if ((t(this.element).trigger(o), !o.isDefaultPrevented())) {
                if (
                  (t(i).removeClass(st),
                  "ontouchstart" in document.documentElement &&
                    t(document.body).children().off("mouseover", null, t.noop),
                  (this._activeTrigger[dt] = !1),
                  (this._activeTrigger[ut] = !1),
                  (this._activeTrigger[ct] = !1),
                  t(this.tip).hasClass(rt))
                ) {
                  var s = c.getTransitionDurationFromElement(i);
                  t(i).one(c.TRANSITION_END, r).emulateTransitionEnd(s);
                } else r();
                this._hoverState = "";
              }
            }),
            (i.update = function () {
              null !== this._popper && this._popper.scheduleUpdate();
            }),
            (i.isWithContent = function () {
              return Boolean(this.getTitle());
            }),
            (i.addAttachmentClass = function (e) {
              t(this.getTipElement()).addClass("bs-tooltip-" + e);
            }),
            (i.getTipElement = function () {
              return (
                (this.tip = this.tip || t(this.config.template)[0]), this.tip
              );
            }),
            (i.setContent = function () {
              var e = this.getTipElement();
              this.setElementContent(
                t(e.querySelectorAll(at)),
                this.getTitle()
              ),
                t(e).removeClass(rt + " " + st);
            }),
            (i.setElementContent = function (e, n) {
              "object" != typeof n || (!n.nodeType && !n.jquery)
                ? this.config.html
                  ? (this.config.sanitize &&
                      (n = ze(
                        n,
                        this.config.whiteList,
                        this.config.sanitizeFn
                      )),
                    e.html(n))
                  : e.text(n)
                : this.config.html
                ? t(n).parent().is(e) || e.empty().append(n)
                : e.text(t(n).text());
            }),
            (i.getTitle = function () {
              var e = this.element.getAttribute("data-original-title");
              return (
                e ||
                  (e =
                    "function" == typeof this.config.title
                      ? this.config.title.call(this.element)
                      : this.config.title),
                e
              );
            }),
            (i._getOffset = function () {
              var e = this,
                t = {};
              return (
                "function" == typeof this.config.offset
                  ? (t.fn = function (t) {
                      return (
                        (t.offsets = s(
                          {},
                          t.offsets,
                          e.config.offset(t.offsets, e.element) || {}
                        )),
                        t
                      );
                    })
                  : (t.offset = this.config.offset),
                t
              );
            }),
            (i._getContainer = function () {
              return !1 === this.config.container
                ? document.body
                : c.isElement(this.config.container)
                ? t(this.config.container)
                : t(document).find(this.config.container);
            }),
            (i._getAttachment = function (e) {
              return et[e.toUpperCase()];
            }),
            (i._setListeners = function () {
              var e = this;
              this.config.trigger.split(" ").forEach(function (n) {
                if ("click" === n)
                  t(e.element).on(
                    e.constructor.Event.CLICK,
                    e.config.selector,
                    function (t) {
                      return e.toggle(t);
                    }
                  );
                else if (n !== ht) {
                  var i =
                      n === ct
                        ? e.constructor.Event.MOUSEENTER
                        : e.constructor.Event.FOCUSIN,
                    o =
                      n === ct
                        ? e.constructor.Event.MOUSELEAVE
                        : e.constructor.Event.FOCUSOUT;
                  t(e.element)
                    .on(i, e.config.selector, function (t) {
                      return e._enter(t);
                    })
                    .on(o, e.config.selector, function (t) {
                      return e._leave(t);
                    });
                }
              }),
                t(this.element)
                  .closest(".modal")
                  .on("hide.bs.modal", function () {
                    e.element && e.hide();
                  }),
                this.config.selector
                  ? (this.config = s({}, this.config, {
                      trigger: "manual",
                      selector: "",
                    }))
                  : this._fixTitle();
            }),
            (i._fixTitle = function () {
              var e = typeof this.element.getAttribute("data-original-title");
              (this.element.getAttribute("title") || "string" !== e) &&
                (this.element.setAttribute(
                  "data-original-title",
                  this.element.getAttribute("title") || ""
                ),
                this.element.setAttribute("title", ""));
            }),
            (i._enter = function (e, n) {
              var i = this.constructor.DATA_KEY;
              (n = n || t(e.currentTarget).data(i)) ||
                ((n = new this.constructor(
                  e.currentTarget,
                  this._getDelegateConfig()
                )),
                t(e.currentTarget).data(i, n)),
                e && (n._activeTrigger["focusin" === e.type ? ut : ct] = !0),
                t(n.getTipElement()).hasClass(st) || n._hoverState === nt
                  ? (n._hoverState = nt)
                  : (clearTimeout(n._timeout),
                    (n._hoverState = nt),
                    n.config.delay && n.config.delay.show
                      ? (n._timeout = setTimeout(function () {
                          n._hoverState === nt && n.show();
                        }, n.config.delay.show))
                      : n.show());
            }),
            (i._leave = function (e, n) {
              var i = this.constructor.DATA_KEY;
              (n = n || t(e.currentTarget).data(i)) ||
                ((n = new this.constructor(
                  e.currentTarget,
                  this._getDelegateConfig()
                )),
                t(e.currentTarget).data(i, n)),
                e && (n._activeTrigger["focusout" === e.type ? ut : ct] = !1),
                n._isWithActiveTrigger() ||
                  (clearTimeout(n._timeout),
                  (n._hoverState = it),
                  n.config.delay && n.config.delay.hide
                    ? (n._timeout = setTimeout(function () {
                        n._hoverState === it && n.hide();
                      }, n.config.delay.hide))
                    : n.hide());
            }),
            (i._isWithActiveTrigger = function () {
              for (var e in this._activeTrigger)
                if (this._activeTrigger[e]) return !0;
              return !1;
            }),
            (i._getConfig = function (e) {
              var n = t(this.element).data();
              return (
                Object.keys(n).forEach(function (e) {
                  -1 !== Ze.indexOf(e) && delete n[e];
                }),
                "number" ==
                  typeof (e = s(
                    {},
                    this.constructor.Default,
                    n,
                    "object" == typeof e && e ? e : {}
                  )).delay && (e.delay = { show: e.delay, hide: e.delay }),
                "number" == typeof e.title && (e.title = e.title.toString()),
                "number" == typeof e.content &&
                  (e.content = e.content.toString()),
                c.typeCheckConfig(Xe, e, this.constructor.DefaultType),
                e.sanitize &&
                  (e.template = ze(e.template, e.whiteList, e.sanitizeFn)),
                e
              );
            }),
            (i._getDelegateConfig = function () {
              var e = {};
              if (this.config)
                for (var t in this.config)
                  this.constructor.Default[t] !== this.config[t] &&
                    (e[t] = this.config[t]);
              return e;
            }),
            (i._cleanTipClass = function () {
              var e = t(this.getTipElement()),
                n = e.attr("class").match($e);
              null !== n && n.length && e.removeClass(n.join(""));
            }),
            (i._handlePopperPlacementChange = function (e) {
              var t = e.instance;
              (this.tip = t.popper),
                this._cleanTipClass(),
                this.addAttachmentClass(this._getAttachment(e.placement));
            }),
            (i._fixTransition = function () {
              var e = this.getTipElement(),
                n = this.config.animation;
              null === e.getAttribute("x-placement") &&
                (t(e).removeClass(rt),
                (this.config.animation = !1),
                this.hide(),
                this.show(),
                (this.config.animation = n));
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this).data("bs.tooltip"),
                  o = "object" == typeof n && n;
                if (
                  (i || !/dispose|hide/.test(n)) &&
                  (i || ((i = new e(this, o)), t(this).data("bs.tooltip", i)),
                  "string" == typeof n)
                ) {
                  if (void 0 === i[n])
                    throw new TypeError('No method named "' + n + '"');
                  i[n]();
                }
              });
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
              {
                key: "Default",
                get: function () {
                  return tt;
                },
              },
              {
                key: "NAME",
                get: function () {
                  return Xe;
                },
              },
              {
                key: "DATA_KEY",
                get: function () {
                  return "bs.tooltip";
                },
              },
              {
                key: "Event",
                get: function () {
                  return ot;
                },
              },
              {
                key: "EVENT_KEY",
                get: function () {
                  return ".bs.tooltip";
                },
              },
              {
                key: "DefaultType",
                get: function () {
                  return Je;
                },
              },
            ]),
            e
          );
        })();
      (t.fn.tooltip = ft._jQueryInterface),
        (t.fn.tooltip.Constructor = ft),
        (t.fn.tooltip.noConflict = function () {
          return (t.fn.tooltip = Ge), ft._jQueryInterface;
        });
      var pt = "popover",
        mt = t.fn.popover,
        gt = new RegExp("(^|\\s)bs-popover\\S+", "g"),
        vt = s({}, ft.Default, {
          placement: "right",
          trigger: "click",
          content: "",
          template:
            '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
        }),
        _t = s({}, ft.DefaultType, { content: "(string|element|function)" }),
        bt = "fade",
        yt = "show",
        Et = ".popover-header",
        wt = ".popover-body",
        Tt = {
          HIDE: "hide.bs.popover",
          HIDDEN: "hidden.bs.popover",
          SHOW: "show.bs.popover",
          SHOWN: "shown.bs.popover",
          INSERTED: "inserted.bs.popover",
          CLICK: "click.bs.popover",
          FOCUSIN: "focusin.bs.popover",
          FOCUSOUT: "focusout.bs.popover",
          MOUSEENTER: "mouseenter.bs.popover",
          MOUSELEAVE: "mouseleave.bs.popover",
        },
        Ct = (function (e) {
          var n, i;
          function r() {
            return e.apply(this, arguments) || this;
          }
          (i = e),
            ((n = r).prototype = Object.create(i.prototype)),
            (n.prototype.constructor = n),
            (n.__proto__ = i);
          var s = r.prototype;
          return (
            (s.isWithContent = function () {
              return this.getTitle() || this._getContent();
            }),
            (s.addAttachmentClass = function (e) {
              t(this.getTipElement()).addClass("bs-popover-" + e);
            }),
            (s.getTipElement = function () {
              return (
                (this.tip = this.tip || t(this.config.template)[0]), this.tip
              );
            }),
            (s.setContent = function () {
              var e = t(this.getTipElement());
              this.setElementContent(e.find(Et), this.getTitle());
              var n = this._getContent();
              "function" == typeof n && (n = n.call(this.element)),
                this.setElementContent(e.find(wt), n),
                e.removeClass(bt + " " + yt);
            }),
            (s._getContent = function () {
              return (
                this.element.getAttribute("data-content") || this.config.content
              );
            }),
            (s._cleanTipClass = function () {
              var e = t(this.getTipElement()),
                n = e.attr("class").match(gt);
              null !== n && n.length > 0 && e.removeClass(n.join(""));
            }),
            (r._jQueryInterface = function (e) {
              return this.each(function () {
                var n = t(this).data("bs.popover"),
                  i = "object" == typeof e ? e : null;
                if (
                  (n || !/dispose|hide/.test(e)) &&
                  (n || ((n = new r(this, i)), t(this).data("bs.popover", n)),
                  "string" == typeof e)
                ) {
                  if (void 0 === n[e])
                    throw new TypeError('No method named "' + e + '"');
                  n[e]();
                }
              });
            }),
            o(r, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
              {
                key: "Default",
                get: function () {
                  return vt;
                },
              },
              {
                key: "NAME",
                get: function () {
                  return pt;
                },
              },
              {
                key: "DATA_KEY",
                get: function () {
                  return "bs.popover";
                },
              },
              {
                key: "Event",
                get: function () {
                  return Tt;
                },
              },
              {
                key: "EVENT_KEY",
                get: function () {
                  return ".bs.popover";
                },
              },
              {
                key: "DefaultType",
                get: function () {
                  return _t;
                },
              },
            ]),
            r
          );
        })(ft);
      (t.fn.popover = Ct._jQueryInterface),
        (t.fn.popover.Constructor = Ct),
        (t.fn.popover.noConflict = function () {
          return (t.fn.popover = mt), Ct._jQueryInterface;
        });
      var St = "scrollspy",
        It = t.fn[St],
        Dt = { offset: 10, method: "auto", target: "" },
        kt = { offset: "number", method: "string", target: "(string|element)" },
        At = {
          ACTIVATE: "activate.bs.scrollspy",
          SCROLL: "scroll.bs.scrollspy",
          LOAD_DATA_API: "load.bs.scrollspy.data-api",
        },
        Ot = "dropdown-item",
        Nt = "active",
        xt = {
          DATA_SPY: '[data-spy="scroll"]',
          ACTIVE: ".active",
          NAV_LIST_GROUP: ".nav, .list-group",
          NAV_LINKS: ".nav-link",
          NAV_ITEMS: ".nav-item",
          LIST_ITEMS: ".list-group-item",
          DROPDOWN: ".dropdown",
          DROPDOWN_ITEMS: ".dropdown-item",
          DROPDOWN_TOGGLE: ".dropdown-toggle",
        },
        Lt = "offset",
        Pt = "position",
        Mt = (function () {
          function e(e, n) {
            var i = this;
            (this._element = e),
              (this._scrollElement = "BODY" === e.tagName ? window : e),
              (this._config = this._getConfig(n)),
              (this._selector =
                this._config.target +
                " " +
                xt.NAV_LINKS +
                "," +
                this._config.target +
                " " +
                xt.LIST_ITEMS +
                "," +
                this._config.target +
                " " +
                xt.DROPDOWN_ITEMS),
              (this._offsets = []),
              (this._targets = []),
              (this._activeTarget = null),
              (this._scrollHeight = 0),
              t(this._scrollElement).on(At.SCROLL, function (e) {
                return i._process(e);
              }),
              this.refresh(),
              this._process();
          }
          var n = e.prototype;
          return (
            (n.refresh = function () {
              var e = this,
                n =
                  this._scrollElement === this._scrollElement.window ? Lt : Pt,
                i = "auto" === this._config.method ? n : this._config.method,
                o = i === Pt ? this._getScrollTop() : 0;
              (this._offsets = []),
                (this._targets = []),
                (this._scrollHeight = this._getScrollHeight()),
                [].slice
                  .call(document.querySelectorAll(this._selector))
                  .map(function (e) {
                    var n,
                      r = c.getSelectorFromElement(e);
                    if ((r && (n = document.querySelector(r)), n)) {
                      var s = n.getBoundingClientRect();
                      if (s.width || s.height) return [t(n)[i]().top + o, r];
                    }
                    return null;
                  })
                  .filter(function (e) {
                    return e;
                  })
                  .sort(function (e, t) {
                    return e[0] - t[0];
                  })
                  .forEach(function (t) {
                    e._offsets.push(t[0]), e._targets.push(t[1]);
                  });
            }),
            (n.dispose = function () {
              t.removeData(this._element, "bs.scrollspy"),
                t(this._scrollElement).off(".bs.scrollspy"),
                (this._element = null),
                (this._scrollElement = null),
                (this._config = null),
                (this._selector = null),
                (this._offsets = null),
                (this._targets = null),
                (this._activeTarget = null),
                (this._scrollHeight = null);
            }),
            (n._getConfig = function (e) {
              if (
                "string" !=
                typeof (e = s({}, Dt, "object" == typeof e && e ? e : {}))
                  .target
              ) {
                var n = t(e.target).attr("id");
                n || ((n = c.getUID(St)), t(e.target).attr("id", n)),
                  (e.target = "#" + n);
              }
              return c.typeCheckConfig(St, e, kt), e;
            }),
            (n._getScrollTop = function () {
              return this._scrollElement === window
                ? this._scrollElement.pageYOffset
                : this._scrollElement.scrollTop;
            }),
            (n._getScrollHeight = function () {
              return (
                this._scrollElement.scrollHeight ||
                Math.max(
                  document.body.scrollHeight,
                  document.documentElement.scrollHeight
                )
              );
            }),
            (n._getOffsetHeight = function () {
              return this._scrollElement === window
                ? window.innerHeight
                : this._scrollElement.getBoundingClientRect().height;
            }),
            (n._process = function () {
              var e = this._getScrollTop() + this._config.offset,
                t = this._getScrollHeight(),
                n = this._config.offset + t - this._getOffsetHeight();
              if ((this._scrollHeight !== t && this.refresh(), e >= n)) {
                var i = this._targets[this._targets.length - 1];
                this._activeTarget !== i && this._activate(i);
              } else {
                if (
                  this._activeTarget &&
                  e < this._offsets[0] &&
                  this._offsets[0] > 0
                )
                  return (this._activeTarget = null), void this._clear();
                for (var o = this._offsets.length; o--; ) {
                  this._activeTarget !== this._targets[o] &&
                    e >= this._offsets[o] &&
                    (void 0 === this._offsets[o + 1] ||
                      e < this._offsets[o + 1]) &&
                    this._activate(this._targets[o]);
                }
              }
            }),
            (n._activate = function (e) {
              (this._activeTarget = e), this._clear();
              var n = this._selector.split(",").map(function (t) {
                  return (
                    t + '[data-target="' + e + '"],' + t + '[href="' + e + '"]'
                  );
                }),
                i = t([].slice.call(document.querySelectorAll(n.join(","))));
              i.hasClass(Ot)
                ? (i.closest(xt.DROPDOWN).find(xt.DROPDOWN_TOGGLE).addClass(Nt),
                  i.addClass(Nt))
                : (i.addClass(Nt),
                  i
                    .parents(xt.NAV_LIST_GROUP)
                    .prev(xt.NAV_LINKS + ", " + xt.LIST_ITEMS)
                    .addClass(Nt),
                  i
                    .parents(xt.NAV_LIST_GROUP)
                    .prev(xt.NAV_ITEMS)
                    .children(xt.NAV_LINKS)
                    .addClass(Nt)),
                t(this._scrollElement).trigger(At.ACTIVATE, {
                  relatedTarget: e,
                });
            }),
            (n._clear = function () {
              [].slice
                .call(document.querySelectorAll(this._selector))
                .filter(function (e) {
                  return e.classList.contains(Nt);
                })
                .forEach(function (e) {
                  return e.classList.remove(Nt);
                });
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this).data("bs.scrollspy");
                if (
                  (i ||
                    ((i = new e(this, "object" == typeof n && n)),
                    t(this).data("bs.scrollspy", i)),
                  "string" == typeof n)
                ) {
                  if (void 0 === i[n])
                    throw new TypeError('No method named "' + n + '"');
                  i[n]();
                }
              });
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
              {
                key: "Default",
                get: function () {
                  return Dt;
                },
              },
            ]),
            e
          );
        })();
      t(window).on(At.LOAD_DATA_API, function () {
        for (
          var e = [].slice.call(document.querySelectorAll(xt.DATA_SPY)),
            n = e.length;
          n--;

        ) {
          var i = t(e[n]);
          Mt._jQueryInterface.call(i, i.data());
        }
      }),
        (t.fn[St] = Mt._jQueryInterface),
        (t.fn[St].Constructor = Mt),
        (t.fn[St].noConflict = function () {
          return (t.fn[St] = It), Mt._jQueryInterface;
        });
      var Ht = t.fn.tab,
        Rt = {
          HIDE: "hide.bs.tab",
          HIDDEN: "hidden.bs.tab",
          SHOW: "show.bs.tab",
          SHOWN: "shown.bs.tab",
          CLICK_DATA_API: "click.bs.tab.data-api",
        },
        jt = "dropdown-menu",
        Ft = "active",
        Wt = "disabled",
        Ut = "fade",
        Bt = "show",
        qt = ".dropdown",
        Vt = ".nav, .list-group",
        Kt = ".active",
        Qt = "> li > .active",
        Yt = '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
        zt = ".dropdown-toggle",
        Xt = "> .dropdown-menu .active",
        Gt = (function () {
          function e(e) {
            this._element = e;
          }
          var n = e.prototype;
          return (
            (n.show = function () {
              var e = this;
              if (
                !(
                  (this._element.parentNode &&
                    this._element.parentNode.nodeType === Node.ELEMENT_NODE &&
                    t(this._element).hasClass(Ft)) ||
                  t(this._element).hasClass(Wt)
                )
              ) {
                var n,
                  i,
                  o = t(this._element).closest(Vt)[0],
                  r = c.getSelectorFromElement(this._element);
                if (o) {
                  var s = "UL" === o.nodeName || "OL" === o.nodeName ? Qt : Kt;
                  i = (i = t.makeArray(t(o).find(s)))[i.length - 1];
                }
                var a = t.Event(Rt.HIDE, { relatedTarget: this._element }),
                  l = t.Event(Rt.SHOW, { relatedTarget: i });
                if (
                  (i && t(i).trigger(a),
                  t(this._element).trigger(l),
                  !l.isDefaultPrevented() && !a.isDefaultPrevented())
                ) {
                  r && (n = document.querySelector(r)),
                    this._activate(this._element, o);
                  var u = function () {
                    var n = t.Event(Rt.HIDDEN, { relatedTarget: e._element }),
                      o = t.Event(Rt.SHOWN, { relatedTarget: i });
                    t(i).trigger(n), t(e._element).trigger(o);
                  };
                  n ? this._activate(n, n.parentNode, u) : u();
                }
              }
            }),
            (n.dispose = function () {
              t.removeData(this._element, "bs.tab"), (this._element = null);
            }),
            (n._activate = function (e, n, i) {
              var o = this,
                r = (
                  !n || ("UL" !== n.nodeName && "OL" !== n.nodeName)
                    ? t(n).children(Kt)
                    : t(n).find(Qt)
                )[0],
                s = i && r && t(r).hasClass(Ut),
                a = function () {
                  return o._transitionComplete(e, r, i);
                };
              if (r && s) {
                var l = c.getTransitionDurationFromElement(r);
                t(r)
                  .removeClass(Bt)
                  .one(c.TRANSITION_END, a)
                  .emulateTransitionEnd(l);
              } else a();
            }),
            (n._transitionComplete = function (e, n, i) {
              if (n) {
                t(n).removeClass(Ft);
                var o = t(n.parentNode).find(Xt)[0];
                o && t(o).removeClass(Ft),
                  "tab" === n.getAttribute("role") &&
                    n.setAttribute("aria-selected", !1);
              }
              if (
                (t(e).addClass(Ft),
                "tab" === e.getAttribute("role") &&
                  e.setAttribute("aria-selected", !0),
                c.reflow(e),
                e.classList.contains(Ut) && e.classList.add(Bt),
                e.parentNode && t(e.parentNode).hasClass(jt))
              ) {
                var r = t(e).closest(qt)[0];
                if (r) {
                  var s = [].slice.call(r.querySelectorAll(zt));
                  t(s).addClass(Ft);
                }
                e.setAttribute("aria-expanded", !0);
              }
              i && i();
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this),
                  o = i.data("bs.tab");
                if (
                  (o || ((o = new e(this)), i.data("bs.tab", o)),
                  "string" == typeof n)
                ) {
                  if (void 0 === o[n])
                    throw new TypeError('No method named "' + n + '"');
                  o[n]();
                }
              });
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
            ]),
            e
          );
        })();
      t(document).on(Rt.CLICK_DATA_API, Yt, function (e) {
        e.preventDefault(), Gt._jQueryInterface.call(t(this), "show");
      }),
        (t.fn.tab = Gt._jQueryInterface),
        (t.fn.tab.Constructor = Gt),
        (t.fn.tab.noConflict = function () {
          return (t.fn.tab = Ht), Gt._jQueryInterface;
        });
      var $t = t.fn.toast,
        Zt = {
          CLICK_DISMISS: "click.dismiss.bs.toast",
          HIDE: "hide.bs.toast",
          HIDDEN: "hidden.bs.toast",
          SHOW: "show.bs.toast",
          SHOWN: "shown.bs.toast",
        },
        Jt = "fade",
        en = "hide",
        tn = "show",
        nn = "showing",
        on = { animation: "boolean", autohide: "boolean", delay: "number" },
        rn = { animation: !0, autohide: !0, delay: 500 },
        sn = '[data-dismiss="toast"]',
        an = (function () {
          function e(e, t) {
            (this._element = e),
              (this._config = this._getConfig(t)),
              (this._timeout = null),
              this._setListeners();
          }
          var n = e.prototype;
          return (
            (n.show = function () {
              var e = this;
              t(this._element).trigger(Zt.SHOW),
                this._config.animation && this._element.classList.add(Jt);
              var n = function () {
                e._element.classList.remove(nn),
                  e._element.classList.add(tn),
                  t(e._element).trigger(Zt.SHOWN),
                  e._config.autohide && e.hide();
              };
              if (
                (this._element.classList.remove(en),
                this._element.classList.add(nn),
                this._config.animation)
              ) {
                var i = c.getTransitionDurationFromElement(this._element);
                t(this._element)
                  .one(c.TRANSITION_END, n)
                  .emulateTransitionEnd(i);
              } else n();
            }),
            (n.hide = function (e) {
              var n = this;
              this._element.classList.contains(tn) &&
                (t(this._element).trigger(Zt.HIDE),
                e
                  ? this._close()
                  : (this._timeout = setTimeout(function () {
                      n._close();
                    }, this._config.delay)));
            }),
            (n.dispose = function () {
              clearTimeout(this._timeout),
                (this._timeout = null),
                this._element.classList.contains(tn) &&
                  this._element.classList.remove(tn),
                t(this._element).off(Zt.CLICK_DISMISS),
                t.removeData(this._element, "bs.toast"),
                (this._element = null),
                (this._config = null);
            }),
            (n._getConfig = function (e) {
              return (
                (e = s(
                  {},
                  rn,
                  t(this._element).data(),
                  "object" == typeof e && e ? e : {}
                )),
                c.typeCheckConfig("toast", e, this.constructor.DefaultType),
                e
              );
            }),
            (n._setListeners = function () {
              var e = this;
              t(this._element).on(Zt.CLICK_DISMISS, sn, function () {
                return e.hide(!0);
              });
            }),
            (n._close = function () {
              var e = this,
                n = function () {
                  e._element.classList.add(en),
                    t(e._element).trigger(Zt.HIDDEN);
                };
              if (
                (this._element.classList.remove(tn), this._config.animation)
              ) {
                var i = c.getTransitionDurationFromElement(this._element);
                t(this._element)
                  .one(c.TRANSITION_END, n)
                  .emulateTransitionEnd(i);
              } else n();
            }),
            (e._jQueryInterface = function (n) {
              return this.each(function () {
                var i = t(this),
                  o = i.data("bs.toast");
                if (
                  (o ||
                    ((o = new e(this, "object" == typeof n && n)),
                    i.data("bs.toast", o)),
                  "string" == typeof n)
                ) {
                  if (void 0 === o[n])
                    throw new TypeError('No method named "' + n + '"');
                  o[n](this);
                }
              });
            }),
            o(e, null, [
              {
                key: "VERSION",
                get: function () {
                  return "4.3.1";
                },
              },
              {
                key: "DefaultType",
                get: function () {
                  return on;
                },
              },
              {
                key: "Default",
                get: function () {
                  return rn;
                },
              },
            ]),
            e
          );
        })();
      (t.fn.toast = an._jQueryInterface),
        (t.fn.toast.Constructor = an),
        (t.fn.toast.noConflict = function () {
          return (t.fn.toast = $t), an._jQueryInterface;
        }),
        (function () {
          if (void 0 === t)
            throw new TypeError(
              "Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript."
            );
          var e = t.fn.jquery.split(" ")[0].split(".");
          if (
            (e[0] < 2 && e[1] < 9) ||
            (1 === e[0] && 9 === e[1] && e[2] < 1) ||
            e[0] >= 4
          )
            throw new Error(
              "Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0"
            );
        })(),
        (e.Util = c),
        (e.Alert = m),
        (e.Button = I),
        (e.Carousel = Y),
        (e.Collapse = se),
        (e.Dropdown = Ne),
        (e.Modal = qe),
        (e.Popover = Ct),
        (e.Scrollspy = Mt),
        (e.Tab = Gt),
        (e.Toast = an),
        (e.Tooltip = ft),
        Object.defineProperty(e, "__esModule", { value: !0 });
    })(t, n(0), n(6));
  },
  function (e, t, n) {
    "use strict";
    Object.defineProperty(t, "__esModule", { value: !0 }),
      function (e) {
        /**!
         * @fileOverview Kickass library to create and place poppers near their reference elements.
         * @version 1.16.0
         * @license
         * Copyright (c) 2016 Federico Zivolo and contributors
         *
         * Permission is hereby granted, free of charge, to any person obtaining a copy
         * of this software and associated documentation files (the "Software"), to deal
         * in the Software without restriction, including without limitation the rights
         * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
         * copies of the Software, and to permit persons to whom the Software is
         * furnished to do so, subject to the following conditions:
         *
         * The above copyright notice and this permission notice shall be included in all
         * copies or substantial portions of the Software.
         *
         * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
         * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
         * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
         * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
         * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
         * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
         * SOFTWARE.
         */
        var n =
            "undefined" != typeof window &&
            "undefined" != typeof document &&
            "undefined" != typeof navigator,
          i = (function () {
            for (
              var e = ["Edge", "Trident", "Firefox"], t = 0;
              t < e.length;
              t += 1
            )
              if (n && navigator.userAgent.indexOf(e[t]) >= 0) return 1;
            return 0;
          })();
        var o =
          n && window.Promise
            ? function (e) {
                var t = !1;
                return function () {
                  t ||
                    ((t = !0),
                    window.Promise.resolve().then(function () {
                      (t = !1), e();
                    }));
                };
              }
            : function (e) {
                var t = !1;
                return function () {
                  t ||
                    ((t = !0),
                    setTimeout(function () {
                      (t = !1), e();
                    }, i));
                };
              };
        function r(e) {
          return e && "[object Function]" === {}.toString.call(e);
        }
        function s(e, t) {
          if (1 !== e.nodeType) return [];
          var n = e.ownerDocument.defaultView.getComputedStyle(e, null);
          return t ? n[t] : n;
        }
        function a(e) {
          return "HTML" === e.nodeName ? e : e.parentNode || e.host;
        }
        function l(e) {
          if (!e) return document.body;
          switch (e.nodeName) {
            case "HTML":
            case "BODY":
              return e.ownerDocument.body;
            case "#document":
              return e.body;
          }
          var t = s(e),
            n = t.overflow,
            i = t.overflowX,
            o = t.overflowY;
          return /(auto|scroll|overlay)/.test(n + o + i) ? e : l(a(e));
        }
        function c(e) {
          return e && e.referenceNode ? e.referenceNode : e;
        }
        var u = n && !(!window.MSInputMethodContext || !document.documentMode),
          d = n && /MSIE 10/.test(navigator.userAgent);
        function h(e) {
          return 11 === e ? u : 10 === e ? d : u || d;
        }
        function f(e) {
          if (!e) return document.documentElement;
          for (
            var t = h(10) ? document.body : null, n = e.offsetParent || null;
            n === t && e.nextElementSibling;

          )
            n = (e = e.nextElementSibling).offsetParent;
          var i = n && n.nodeName;
          return i && "BODY" !== i && "HTML" !== i
            ? -1 !== ["TH", "TD", "TABLE"].indexOf(n.nodeName) &&
              "static" === s(n, "position")
              ? f(n)
              : n
            : e
            ? e.ownerDocument.documentElement
            : document.documentElement;
        }
        function p(e) {
          return null !== e.parentNode ? p(e.parentNode) : e;
        }
        function m(e, t) {
          if (!(e && e.nodeType && t && t.nodeType))
            return document.documentElement;
          var n =
              e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            i = n ? e : t,
            o = n ? t : e,
            r = document.createRange();
          r.setStart(i, 0), r.setEnd(o, 0);
          var s,
            a,
            l = r.commonAncestorContainer;
          if ((e !== l && t !== l) || i.contains(o))
            return "BODY" === (a = (s = l).nodeName) ||
              ("HTML" !== a && f(s.firstElementChild) !== s)
              ? f(l)
              : l;
          var c = p(e);
          return c.host ? m(c.host, t) : m(e, p(t).host);
        }
        function g(e) {
          var t =
              "top" ===
              (arguments.length > 1 && void 0 !== arguments[1]
                ? arguments[1]
                : "top")
                ? "scrollTop"
                : "scrollLeft",
            n = e.nodeName;
          if ("BODY" === n || "HTML" === n) {
            var i = e.ownerDocument.documentElement;
            return (e.ownerDocument.scrollingElement || i)[t];
          }
          return e[t];
        }
        function v(e, t) {
          var n = "x" === t ? "Left" : "Top",
            i = "Left" === n ? "Right" : "Bottom";
          return (
            parseFloat(e["border" + n + "Width"], 10) +
            parseFloat(e["border" + i + "Width"], 10)
          );
        }
        function _(e, t, n, i) {
          return Math.max(
            t["offset" + e],
            t["scroll" + e],
            n["client" + e],
            n["offset" + e],
            n["scroll" + e],
            h(10)
              ? parseInt(n["offset" + e]) +
                  parseInt(i["margin" + ("Height" === e ? "Top" : "Left")]) +
                  parseInt(i["margin" + ("Height" === e ? "Bottom" : "Right")])
              : 0
          );
        }
        function b(e) {
          var t = e.body,
            n = e.documentElement,
            i = h(10) && getComputedStyle(n);
          return { height: _("Height", t, n, i), width: _("Width", t, n, i) };
        }
        var y = function (e, t) {
            if (!(e instanceof t))
              throw new TypeError("Cannot call a class as a function");
          },
          E = (function () {
            function e(e, t) {
              for (var n = 0; n < t.length; n++) {
                var i = t[n];
                (i.enumerable = i.enumerable || !1),
                  (i.configurable = !0),
                  "value" in i && (i.writable = !0),
                  Object.defineProperty(e, i.key, i);
              }
            }
            return function (t, n, i) {
              return n && e(t.prototype, n), i && e(t, i), t;
            };
          })(),
          w = function (e, t, n) {
            return (
              t in e
                ? Object.defineProperty(e, t, {
                    value: n,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0,
                  })
                : (e[t] = n),
              e
            );
          },
          T =
            Object.assign ||
            function (e) {
              for (var t = 1; t < arguments.length; t++) {
                var n = arguments[t];
                for (var i in n)
                  Object.prototype.hasOwnProperty.call(n, i) && (e[i] = n[i]);
              }
              return e;
            };
        function C(e) {
          return T({}, e, {
            right: e.left + e.width,
            bottom: e.top + e.height,
          });
        }
        function S(e) {
          var t = {};
          try {
            if (h(10)) {
              t = e.getBoundingClientRect();
              var n = g(e, "top"),
                i = g(e, "left");
              (t.top += n), (t.left += i), (t.bottom += n), (t.right += i);
            } else t = e.getBoundingClientRect();
          } catch (e) {}
          var o = {
              left: t.left,
              top: t.top,
              width: t.right - t.left,
              height: t.bottom - t.top,
            },
            r = "HTML" === e.nodeName ? b(e.ownerDocument) : {},
            a = r.width || e.clientWidth || o.width,
            l = r.height || e.clientHeight || o.height,
            c = e.offsetWidth - a,
            u = e.offsetHeight - l;
          if (c || u) {
            var d = s(e);
            (c -= v(d, "x")), (u -= v(d, "y")), (o.width -= c), (o.height -= u);
          }
          return C(o);
        }
        function I(e, t) {
          var n =
              arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
            i = h(10),
            o = "HTML" === t.nodeName,
            r = S(e),
            a = S(t),
            c = l(e),
            u = s(t),
            d = parseFloat(u.borderTopWidth, 10),
            f = parseFloat(u.borderLeftWidth, 10);
          n &&
            o &&
            ((a.top = Math.max(a.top, 0)), (a.left = Math.max(a.left, 0)));
          var p = C({
            top: r.top - a.top - d,
            left: r.left - a.left - f,
            width: r.width,
            height: r.height,
          });
          if (((p.marginTop = 0), (p.marginLeft = 0), !i && o)) {
            var m = parseFloat(u.marginTop, 10),
              v = parseFloat(u.marginLeft, 10);
            (p.top -= d - m),
              (p.bottom -= d - m),
              (p.left -= f - v),
              (p.right -= f - v),
              (p.marginTop = m),
              (p.marginLeft = v);
          }
          return (
            (i && !n ? t.contains(c) : t === c && "BODY" !== c.nodeName) &&
              (p = (function (e, t) {
                var n =
                    arguments.length > 2 &&
                    void 0 !== arguments[2] &&
                    arguments[2],
                  i = g(t, "top"),
                  o = g(t, "left"),
                  r = n ? -1 : 1;
                return (
                  (e.top += i * r),
                  (e.bottom += i * r),
                  (e.left += o * r),
                  (e.right += o * r),
                  e
                );
              })(p, t)),
            p
          );
        }
        function D(e) {
          if (!e || !e.parentElement || h()) return document.documentElement;
          for (var t = e.parentElement; t && "none" === s(t, "transform"); )
            t = t.parentElement;
          return t || document.documentElement;
        }
        function k(e, t, n, i) {
          var o =
              arguments.length > 4 && void 0 !== arguments[4] && arguments[4],
            r = { top: 0, left: 0 },
            u = o ? D(e) : m(e, c(t));
          if ("viewport" === i)
            r = (function (e) {
              var t =
                  arguments.length > 1 &&
                  void 0 !== arguments[1] &&
                  arguments[1],
                n = e.ownerDocument.documentElement,
                i = I(e, n),
                o = Math.max(n.clientWidth, window.innerWidth || 0),
                r = Math.max(n.clientHeight, window.innerHeight || 0),
                s = t ? 0 : g(n),
                a = t ? 0 : g(n, "left");
              return C({
                top: s - i.top + i.marginTop,
                left: a - i.left + i.marginLeft,
                width: o,
                height: r,
              });
            })(u, o);
          else {
            var d = void 0;
            "scrollParent" === i
              ? "BODY" === (d = l(a(t))).nodeName &&
                (d = e.ownerDocument.documentElement)
              : (d = "window" === i ? e.ownerDocument.documentElement : i);
            var h = I(d, u, o);
            if (
              "HTML" !== d.nodeName ||
              (function e(t) {
                var n = t.nodeName;
                if ("BODY" === n || "HTML" === n) return !1;
                if ("fixed" === s(t, "position")) return !0;
                var i = a(t);
                return !!i && e(i);
              })(u)
            )
              r = h;
            else {
              var f = b(e.ownerDocument),
                p = f.height,
                v = f.width;
              (r.top += h.top - h.marginTop),
                (r.bottom = p + h.top),
                (r.left += h.left - h.marginLeft),
                (r.right = v + h.left);
            }
          }
          var _ = "number" == typeof (n = n || 0);
          return (
            (r.left += _ ? n : n.left || 0),
            (r.top += _ ? n : n.top || 0),
            (r.right -= _ ? n : n.right || 0),
            (r.bottom -= _ ? n : n.bottom || 0),
            r
          );
        }
        function A(e, t, n, i, o) {
          var r =
            arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : 0;
          if (-1 === e.indexOf("auto")) return e;
          var s = k(n, i, r, o),
            a = {
              top: { width: s.width, height: t.top - s.top },
              right: { width: s.right - t.right, height: s.height },
              bottom: { width: s.width, height: s.bottom - t.bottom },
              left: { width: t.left - s.left, height: s.height },
            },
            l = Object.keys(a)
              .map(function (e) {
                return T({ key: e }, a[e], {
                  area: ((t = a[e]), t.width * t.height),
                });
                var t;
              })
              .sort(function (e, t) {
                return t.area - e.area;
              }),
            c = l.filter(function (e) {
              var t = e.width,
                i = e.height;
              return t >= n.clientWidth && i >= n.clientHeight;
            }),
            u = c.length > 0 ? c[0].key : l[0].key,
            d = e.split("-")[1];
          return u + (d ? "-" + d : "");
        }
        function O(e, t, n) {
          var i =
            arguments.length > 3 && void 0 !== arguments[3]
              ? arguments[3]
              : null;
          return I(n, i ? D(t) : m(t, c(n)), i);
        }
        function N(e) {
          var t = e.ownerDocument.defaultView.getComputedStyle(e),
            n = parseFloat(t.marginTop || 0) + parseFloat(t.marginBottom || 0),
            i = parseFloat(t.marginLeft || 0) + parseFloat(t.marginRight || 0);
          return { width: e.offsetWidth + i, height: e.offsetHeight + n };
        }
        function x(e) {
          var t = {
            left: "right",
            right: "left",
            bottom: "top",
            top: "bottom",
          };
          return e.replace(/left|right|bottom|top/g, function (e) {
            return t[e];
          });
        }
        function L(e, t, n) {
          n = n.split("-")[0];
          var i = N(e),
            o = { width: i.width, height: i.height },
            r = -1 !== ["right", "left"].indexOf(n),
            s = r ? "top" : "left",
            a = r ? "left" : "top",
            l = r ? "height" : "width",
            c = r ? "width" : "height";
          return (
            (o[s] = t[s] + t[l] / 2 - i[l] / 2),
            (o[a] = n === a ? t[a] - i[c] : t[x(a)]),
            o
          );
        }
        function P(e, t) {
          return Array.prototype.find ? e.find(t) : e.filter(t)[0];
        }
        function M(e, t, n) {
          return (
            (void 0 === n
              ? e
              : e.slice(
                  0,
                  (function (e, t, n) {
                    if (Array.prototype.findIndex)
                      return e.findIndex(function (e) {
                        return e[t] === n;
                      });
                    var i = P(e, function (e) {
                      return e[t] === n;
                    });
                    return e.indexOf(i);
                  })(e, "name", n)
                )
            ).forEach(function (e) {
              e.function;
              var n = e.function || e.fn;
              e.enabled &&
                r(n) &&
                ((t.offsets.popper = C(t.offsets.popper)),
                (t.offsets.reference = C(t.offsets.reference)),
                (t = n(t, e)));
            }),
            t
          );
        }
        function H(e, t) {
          return e.some(function (e) {
            var n = e.name;
            return e.enabled && n === t;
          });
        }
        function R(e) {
          for (
            var t = [!1, "ms", "Webkit", "Moz", "O"],
              n = e.charAt(0).toUpperCase() + e.slice(1),
              i = 0;
            i < t.length;
            i++
          ) {
            var o = t[i],
              r = o ? "" + o + n : e;
            if (void 0 !== document.body.style[r]) return r;
          }
          return null;
        }
        function j(e) {
          var t = e.ownerDocument;
          return t ? t.defaultView : window;
        }
        function F(e, t, n, i) {
          (n.updateBound = i),
            j(e).addEventListener("resize", n.updateBound, { passive: !0 });
          var o = l(e);
          return (
            (function e(t, n, i, o) {
              var r = "BODY" === t.nodeName,
                s = r ? t.ownerDocument.defaultView : t;
              s.addEventListener(n, i, { passive: !0 }),
                r || e(l(s.parentNode), n, i, o),
                o.push(s);
            })(o, "scroll", n.updateBound, n.scrollParents),
            (n.scrollElement = o),
            (n.eventsEnabled = !0),
            n
          );
        }
        function W() {
          var e, t;
          this.state.eventsEnabled &&
            (cancelAnimationFrame(this.scheduleUpdate),
            (this.state =
              ((e = this.reference),
              (t = this.state),
              j(e).removeEventListener("resize", t.updateBound),
              t.scrollParents.forEach(function (e) {
                e.removeEventListener("scroll", t.updateBound);
              }),
              (t.updateBound = null),
              (t.scrollParents = []),
              (t.scrollElement = null),
              (t.eventsEnabled = !1),
              t)));
        }
        function U(e) {
          return "" !== e && !isNaN(parseFloat(e)) && isFinite(e);
        }
        function B(e, t) {
          Object.keys(t).forEach(function (n) {
            var i = "";
            -1 !==
              ["width", "height", "top", "right", "bottom", "left"].indexOf(
                n
              ) &&
              U(t[n]) &&
              (i = "px"),
              (e.style[n] = t[n] + i);
          });
        }
        var q = n && /Firefox/i.test(navigator.userAgent);
        function V(e, t, n) {
          var i = P(e, function (e) {
              return e.name === t;
            }),
            o =
              !!i &&
              e.some(function (e) {
                return e.name === n && e.enabled && e.order < i.order;
              });
          if (!o);
          return o;
        }
        var K = [
            "auto-start",
            "auto",
            "auto-end",
            "top-start",
            "top",
            "top-end",
            "right-start",
            "right",
            "right-end",
            "bottom-end",
            "bottom",
            "bottom-start",
            "left-end",
            "left",
            "left-start",
          ],
          Q = K.slice(3);
        function Y(e) {
          var t =
              arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
            n = Q.indexOf(e),
            i = Q.slice(n + 1).concat(Q.slice(0, n));
          return t ? i.reverse() : i;
        }
        var z = {
          FLIP: "flip",
          CLOCKWISE: "clockwise",
          COUNTERCLOCKWISE: "counterclockwise",
        };
        function X(e, t, n, i) {
          var o = [0, 0],
            r = -1 !== ["right", "left"].indexOf(i),
            s = e.split(/(\+|\-)/).map(function (e) {
              return e.trim();
            }),
            a = s.indexOf(
              P(s, function (e) {
                return -1 !== e.search(/,|\s/);
              })
            );
          s[a] && s[a].indexOf(",");
          var l = /\s*,\s*|\s+/,
            c =
              -1 !== a
                ? [
                    s.slice(0, a).concat([s[a].split(l)[0]]),
                    [s[a].split(l)[1]].concat(s.slice(a + 1)),
                  ]
                : [s];
          return (
            (c = c.map(function (e, i) {
              var o = (1 === i ? !r : r) ? "height" : "width",
                s = !1;
              return e
                .reduce(function (e, t) {
                  return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t)
                    ? ((e[e.length - 1] = t), (s = !0), e)
                    : s
                    ? ((e[e.length - 1] += t), (s = !1), e)
                    : e.concat(t);
                }, [])
                .map(function (e) {
                  return (function (e, t, n, i) {
                    var o = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                      r = +o[1],
                      s = o[2];
                    if (!r) return e;
                    if (0 === s.indexOf("%")) {
                      var a = void 0;
                      switch (s) {
                        case "%p":
                          a = n;
                          break;
                        case "%":
                        case "%r":
                        default:
                          a = i;
                      }
                      return (C(a)[t] / 100) * r;
                    }
                    if ("vh" === s || "vw" === s)
                      return (
                        (("vh" === s
                          ? Math.max(
                              document.documentElement.clientHeight,
                              window.innerHeight || 0
                            )
                          : Math.max(
                              document.documentElement.clientWidth,
                              window.innerWidth || 0
                            )) /
                          100) *
                        r
                      );
                    return r;
                  })(e, o, t, n);
                });
            })).forEach(function (e, t) {
              e.forEach(function (n, i) {
                U(n) && (o[t] += n * ("-" === e[i - 1] ? -1 : 1));
              });
            }),
            o
          );
        }
        var G = {
            placement: "bottom",
            positionFixed: !1,
            eventsEnabled: !0,
            removeOnDestroy: !1,
            onCreate: function () {},
            onUpdate: function () {},
            modifiers: {
              shift: {
                order: 100,
                enabled: !0,
                fn: function (e) {
                  var t = e.placement,
                    n = t.split("-")[0],
                    i = t.split("-")[1];
                  if (i) {
                    var o = e.offsets,
                      r = o.reference,
                      s = o.popper,
                      a = -1 !== ["bottom", "top"].indexOf(n),
                      l = a ? "left" : "top",
                      c = a ? "width" : "height",
                      u = {
                        start: w({}, l, r[l]),
                        end: w({}, l, r[l] + r[c] - s[c]),
                      };
                    e.offsets.popper = T({}, s, u[i]);
                  }
                  return e;
                },
              },
              offset: {
                order: 200,
                enabled: !0,
                fn: function (e, t) {
                  var n = t.offset,
                    i = e.placement,
                    o = e.offsets,
                    r = o.popper,
                    s = o.reference,
                    a = i.split("-")[0],
                    l = void 0;
                  return (
                    (l = U(+n) ? [+n, 0] : X(n, r, s, a)),
                    "left" === a
                      ? ((r.top += l[0]), (r.left -= l[1]))
                      : "right" === a
                      ? ((r.top += l[0]), (r.left += l[1]))
                      : "top" === a
                      ? ((r.left += l[0]), (r.top -= l[1]))
                      : "bottom" === a && ((r.left += l[0]), (r.top += l[1])),
                    (e.popper = r),
                    e
                  );
                },
                offset: 0,
              },
              preventOverflow: {
                order: 300,
                enabled: !0,
                fn: function (e, t) {
                  var n = t.boundariesElement || f(e.instance.popper);
                  e.instance.reference === n && (n = f(n));
                  var i = R("transform"),
                    o = e.instance.popper.style,
                    r = o.top,
                    s = o.left,
                    a = o[i];
                  (o.top = ""), (o.left = ""), (o[i] = "");
                  var l = k(
                    e.instance.popper,
                    e.instance.reference,
                    t.padding,
                    n,
                    e.positionFixed
                  );
                  (o.top = r), (o.left = s), (o[i] = a), (t.boundaries = l);
                  var c = t.priority,
                    u = e.offsets.popper,
                    d = {
                      primary: function (e) {
                        var n = u[e];
                        return (
                          u[e] < l[e] &&
                            !t.escapeWithReference &&
                            (n = Math.max(u[e], l[e])),
                          w({}, e, n)
                        );
                      },
                      secondary: function (e) {
                        var n = "right" === e ? "left" : "top",
                          i = u[n];
                        return (
                          u[e] > l[e] &&
                            !t.escapeWithReference &&
                            (i = Math.min(
                              u[n],
                              l[e] - ("right" === e ? u.width : u.height)
                            )),
                          w({}, n, i)
                        );
                      },
                    };
                  return (
                    c.forEach(function (e) {
                      var t =
                        -1 !== ["left", "top"].indexOf(e)
                          ? "primary"
                          : "secondary";
                      u = T({}, u, d[t](e));
                    }),
                    (e.offsets.popper = u),
                    e
                  );
                },
                priority: ["left", "right", "top", "bottom"],
                padding: 5,
                boundariesElement: "scrollParent",
              },
              keepTogether: {
                order: 400,
                enabled: !0,
                fn: function (e) {
                  var t = e.offsets,
                    n = t.popper,
                    i = t.reference,
                    o = e.placement.split("-")[0],
                    r = Math.floor,
                    s = -1 !== ["top", "bottom"].indexOf(o),
                    a = s ? "right" : "bottom",
                    l = s ? "left" : "top",
                    c = s ? "width" : "height";
                  return (
                    n[a] < r(i[l]) && (e.offsets.popper[l] = r(i[l]) - n[c]),
                    n[l] > r(i[a]) && (e.offsets.popper[l] = r(i[a])),
                    e
                  );
                },
              },
              arrow: {
                order: 500,
                enabled: !0,
                fn: function (e, t) {
                  var n;
                  if (!V(e.instance.modifiers, "arrow", "keepTogether"))
                    return e;
                  var i = t.element;
                  if ("string" == typeof i) {
                    if (!(i = e.instance.popper.querySelector(i))) return e;
                  } else if (!e.instance.popper.contains(i)) return e;
                  var o = e.placement.split("-")[0],
                    r = e.offsets,
                    a = r.popper,
                    l = r.reference,
                    c = -1 !== ["left", "right"].indexOf(o),
                    u = c ? "height" : "width",
                    d = c ? "Top" : "Left",
                    h = d.toLowerCase(),
                    f = c ? "left" : "top",
                    p = c ? "bottom" : "right",
                    m = N(i)[u];
                  l[p] - m < a[h] && (e.offsets.popper[h] -= a[h] - (l[p] - m)),
                    l[h] + m > a[p] && (e.offsets.popper[h] += l[h] + m - a[p]),
                    (e.offsets.popper = C(e.offsets.popper));
                  var g = l[h] + l[u] / 2 - m / 2,
                    v = s(e.instance.popper),
                    _ = parseFloat(v["margin" + d], 10),
                    b = parseFloat(v["border" + d + "Width"], 10),
                    y = g - e.offsets.popper[h] - _ - b;
                  return (
                    (y = Math.max(Math.min(a[u] - m, y), 0)),
                    (e.arrowElement = i),
                    (e.offsets.arrow =
                      (w((n = {}), h, Math.round(y)), w(n, f, ""), n)),
                    e
                  );
                },
                element: "[x-arrow]",
              },
              flip: {
                order: 600,
                enabled: !0,
                fn: function (e, t) {
                  if (H(e.instance.modifiers, "inner")) return e;
                  if (e.flipped && e.placement === e.originalPlacement)
                    return e;
                  var n = k(
                      e.instance.popper,
                      e.instance.reference,
                      t.padding,
                      t.boundariesElement,
                      e.positionFixed
                    ),
                    i = e.placement.split("-")[0],
                    o = x(i),
                    r = e.placement.split("-")[1] || "",
                    s = [];
                  switch (t.behavior) {
                    case z.FLIP:
                      s = [i, o];
                      break;
                    case z.CLOCKWISE:
                      s = Y(i);
                      break;
                    case z.COUNTERCLOCKWISE:
                      s = Y(i, !0);
                      break;
                    default:
                      s = t.behavior;
                  }
                  return (
                    s.forEach(function (a, l) {
                      if (i !== a || s.length === l + 1) return e;
                      (i = e.placement.split("-")[0]), (o = x(i));
                      var c = e.offsets.popper,
                        u = e.offsets.reference,
                        d = Math.floor,
                        h =
                          ("left" === i && d(c.right) > d(u.left)) ||
                          ("right" === i && d(c.left) < d(u.right)) ||
                          ("top" === i && d(c.bottom) > d(u.top)) ||
                          ("bottom" === i && d(c.top) < d(u.bottom)),
                        f = d(c.left) < d(n.left),
                        p = d(c.right) > d(n.right),
                        m = d(c.top) < d(n.top),
                        g = d(c.bottom) > d(n.bottom),
                        v =
                          ("left" === i && f) ||
                          ("right" === i && p) ||
                          ("top" === i && m) ||
                          ("bottom" === i && g),
                        _ = -1 !== ["top", "bottom"].indexOf(i),
                        b =
                          !!t.flipVariations &&
                          ((_ && "start" === r && f) ||
                            (_ && "end" === r && p) ||
                            (!_ && "start" === r && m) ||
                            (!_ && "end" === r && g)),
                        y =
                          !!t.flipVariationsByContent &&
                          ((_ && "start" === r && p) ||
                            (_ && "end" === r && f) ||
                            (!_ && "start" === r && g) ||
                            (!_ && "end" === r && m)),
                        E = b || y;
                      (h || v || E) &&
                        ((e.flipped = !0),
                        (h || v) && (i = s[l + 1]),
                        E &&
                          (r = (function (e) {
                            return "end" === e
                              ? "start"
                              : "start" === e
                              ? "end"
                              : e;
                          })(r)),
                        (e.placement = i + (r ? "-" + r : "")),
                        (e.offsets.popper = T(
                          {},
                          e.offsets.popper,
                          L(e.instance.popper, e.offsets.reference, e.placement)
                        )),
                        (e = M(e.instance.modifiers, e, "flip")));
                    }),
                    e
                  );
                },
                behavior: "flip",
                padding: 5,
                boundariesElement: "viewport",
                flipVariations: !1,
                flipVariationsByContent: !1,
              },
              inner: {
                order: 700,
                enabled: !1,
                fn: function (e) {
                  var t = e.placement,
                    n = t.split("-")[0],
                    i = e.offsets,
                    o = i.popper,
                    r = i.reference,
                    s = -1 !== ["left", "right"].indexOf(n),
                    a = -1 === ["top", "left"].indexOf(n);
                  return (
                    (o[s ? "left" : "top"] =
                      r[n] - (a ? o[s ? "width" : "height"] : 0)),
                    (e.placement = x(t)),
                    (e.offsets.popper = C(o)),
                    e
                  );
                },
              },
              hide: {
                order: 800,
                enabled: !0,
                fn: function (e) {
                  if (!V(e.instance.modifiers, "hide", "preventOverflow"))
                    return e;
                  var t = e.offsets.reference,
                    n = P(e.instance.modifiers, function (e) {
                      return "preventOverflow" === e.name;
                    }).boundaries;
                  if (
                    t.bottom < n.top ||
                    t.left > n.right ||
                    t.top > n.bottom ||
                    t.right < n.left
                  ) {
                    if (!0 === e.hide) return e;
                    (e.hide = !0), (e.attributes["x-out-of-boundaries"] = "");
                  } else {
                    if (!1 === e.hide) return e;
                    (e.hide = !1), (e.attributes["x-out-of-boundaries"] = !1);
                  }
                  return e;
                },
              },
              computeStyle: {
                order: 850,
                enabled: !0,
                fn: function (e, t) {
                  var n = t.x,
                    i = t.y,
                    o = e.offsets.popper,
                    r = P(e.instance.modifiers, function (e) {
                      return "applyStyle" === e.name;
                    }).gpuAcceleration,
                    s = void 0 !== r ? r : t.gpuAcceleration,
                    a = f(e.instance.popper),
                    l = S(a),
                    c = { position: o.position },
                    u = (function (e, t) {
                      var n = e.offsets,
                        i = n.popper,
                        o = n.reference,
                        r = Math.round,
                        s = Math.floor,
                        a = function (e) {
                          return e;
                        },
                        l = r(o.width),
                        c = r(i.width),
                        u = -1 !== ["left", "right"].indexOf(e.placement),
                        d = -1 !== e.placement.indexOf("-"),
                        h = t ? (u || d || l % 2 == c % 2 ? r : s) : a,
                        f = t ? r : a;
                      return {
                        left: h(
                          l % 2 == 1 && c % 2 == 1 && !d && t
                            ? i.left - 1
                            : i.left
                        ),
                        top: f(i.top),
                        bottom: f(i.bottom),
                        right: h(i.right),
                      };
                    })(e, window.devicePixelRatio < 2 || !q),
                    d = "bottom" === n ? "top" : "bottom",
                    h = "right" === i ? "left" : "right",
                    p = R("transform"),
                    m = void 0,
                    g = void 0;
                  if (
                    ((g =
                      "bottom" === d
                        ? "HTML" === a.nodeName
                          ? -a.clientHeight + u.bottom
                          : -l.height + u.bottom
                        : u.top),
                    (m =
                      "right" === h
                        ? "HTML" === a.nodeName
                          ? -a.clientWidth + u.right
                          : -l.width + u.right
                        : u.left),
                    s && p)
                  )
                    (c[p] = "translate3d(" + m + "px, " + g + "px, 0)"),
                      (c[d] = 0),
                      (c[h] = 0),
                      (c.willChange = "transform");
                  else {
                    var v = "bottom" === d ? -1 : 1,
                      _ = "right" === h ? -1 : 1;
                    (c[d] = g * v),
                      (c[h] = m * _),
                      (c.willChange = d + ", " + h);
                  }
                  var b = { "x-placement": e.placement };
                  return (
                    (e.attributes = T({}, b, e.attributes)),
                    (e.styles = T({}, c, e.styles)),
                    (e.arrowStyles = T({}, e.offsets.arrow, e.arrowStyles)),
                    e
                  );
                },
                gpuAcceleration: !0,
                x: "bottom",
                y: "right",
              },
              applyStyle: {
                order: 900,
                enabled: !0,
                fn: function (e) {
                  var t, n;
                  return (
                    B(e.instance.popper, e.styles),
                    (t = e.instance.popper),
                    (n = e.attributes),
                    Object.keys(n).forEach(function (e) {
                      !1 !== n[e]
                        ? t.setAttribute(e, n[e])
                        : t.removeAttribute(e);
                    }),
                    e.arrowElement &&
                      Object.keys(e.arrowStyles).length &&
                      B(e.arrowElement, e.arrowStyles),
                    e
                  );
                },
                onLoad: function (e, t, n, i, o) {
                  var r = O(o, t, e, n.positionFixed),
                    s = A(
                      n.placement,
                      r,
                      t,
                      e,
                      n.modifiers.flip.boundariesElement,
                      n.modifiers.flip.padding
                    );
                  return (
                    t.setAttribute("x-placement", s),
                    B(t, { position: n.positionFixed ? "fixed" : "absolute" }),
                    n
                  );
                },
                gpuAcceleration: void 0,
              },
            },
          },
          $ = (function () {
            function e(t, n) {
              var i = this,
                s =
                  arguments.length > 2 && void 0 !== arguments[2]
                    ? arguments[2]
                    : {};
              y(this, e),
                (this.scheduleUpdate = function () {
                  return requestAnimationFrame(i.update);
                }),
                (this.update = o(this.update.bind(this))),
                (this.options = T({}, e.Defaults, s)),
                (this.state = {
                  isDestroyed: !1,
                  isCreated: !1,
                  scrollParents: [],
                }),
                (this.reference = t && t.jquery ? t[0] : t),
                (this.popper = n && n.jquery ? n[0] : n),
                (this.options.modifiers = {}),
                Object.keys(T({}, e.Defaults.modifiers, s.modifiers)).forEach(
                  function (t) {
                    i.options.modifiers[t] = T(
                      {},
                      e.Defaults.modifiers[t] || {},
                      s.modifiers ? s.modifiers[t] : {}
                    );
                  }
                ),
                (this.modifiers = Object.keys(this.options.modifiers)
                  .map(function (e) {
                    return T({ name: e }, i.options.modifiers[e]);
                  })
                  .sort(function (e, t) {
                    return e.order - t.order;
                  })),
                this.modifiers.forEach(function (e) {
                  e.enabled &&
                    r(e.onLoad) &&
                    e.onLoad(i.reference, i.popper, i.options, e, i.state);
                }),
                this.update();
              var a = this.options.eventsEnabled;
              a && this.enableEventListeners(), (this.state.eventsEnabled = a);
            }
            return (
              E(e, [
                {
                  key: "update",
                  value: function () {
                    return function () {
                      if (!this.state.isDestroyed) {
                        var e = {
                          instance: this,
                          styles: {},
                          arrowStyles: {},
                          attributes: {},
                          flipped: !1,
                          offsets: {},
                        };
                        (e.offsets.reference = O(
                          this.state,
                          this.popper,
                          this.reference,
                          this.options.positionFixed
                        )),
                          (e.placement = A(
                            this.options.placement,
                            e.offsets.reference,
                            this.popper,
                            this.reference,
                            this.options.modifiers.flip.boundariesElement,
                            this.options.modifiers.flip.padding
                          )),
                          (e.originalPlacement = e.placement),
                          (e.positionFixed = this.options.positionFixed),
                          (e.offsets.popper = L(
                            this.popper,
                            e.offsets.reference,
                            e.placement
                          )),
                          (e.offsets.popper.position = this.options
                            .positionFixed
                            ? "fixed"
                            : "absolute"),
                          (e = M(this.modifiers, e)),
                          this.state.isCreated
                            ? this.options.onUpdate(e)
                            : ((this.state.isCreated = !0),
                              this.options.onCreate(e));
                      }
                    }.call(this);
                  },
                },
                {
                  key: "destroy",
                  value: function () {
                    return function () {
                      return (
                        (this.state.isDestroyed = !0),
                        H(this.modifiers, "applyStyle") &&
                          (this.popper.removeAttribute("x-placement"),
                          (this.popper.style.position = ""),
                          (this.popper.style.top = ""),
                          (this.popper.style.left = ""),
                          (this.popper.style.right = ""),
                          (this.popper.style.bottom = ""),
                          (this.popper.style.willChange = ""),
                          (this.popper.style[R("transform")] = "")),
                        this.disableEventListeners(),
                        this.options.removeOnDestroy &&
                          this.popper.parentNode.removeChild(this.popper),
                        this
                      );
                    }.call(this);
                  },
                },
                {
                  key: "enableEventListeners",
                  value: function () {
                    return function () {
                      this.state.eventsEnabled ||
                        (this.state = F(
                          this.reference,
                          this.options,
                          this.state,
                          this.scheduleUpdate
                        ));
                    }.call(this);
                  },
                },
                {
                  key: "disableEventListeners",
                  value: function () {
                    return W.call(this);
                  },
                },
              ]),
              e
            );
          })();
        ($.Utils = ("undefined" != typeof window ? window : e).PopperUtils),
          ($.placements = K),
          ($.Defaults = G),
          (t.default = $);
      }.call(t, n(7));
  },
  function (e, t) {
    var n;
    n = (function () {
      return this;
    })();
    try {
      n = n || Function("return this")() || (0, eval)("this");
    } catch (e) {
      "object" == typeof window && (n = window);
    }
    e.exports = n;
  },
  function (e, t, n) {
    "use strict";
    var i = n(9),
      o = function (e) {
        this.routes = e;
      };
    (o.prototype.fire = function (e, t, n) {
      void 0 === t && (t = "init"),
        document.dispatchEvent(
          new CustomEvent("routed", {
            bubbles: !0,
            detail: { route: e, fn: t },
          })
        );
      var i =
        "" !== e && this.routes[e] && "function" == typeof this.routes[e][t];
      i && this.routes[e][t](n);
    }),
      (o.prototype.loadEvents = function () {
        var e = this;
        this.fire("common"),
          document.body.className
            .toLowerCase()
            .replace(/-/g, "_")
            .split(/\s+/)
            .map(i.a)
            .forEach(function (t) {
              e.fire(t), e.fire(t, "finalize");
            }),
          this.fire("common", "finalize");
      }),
      (t.a = o);
  },
  function (e, t, n) {
    "use strict";
    t.a = function (e) {
      return (
        "" +
        e.charAt(0).toLowerCase() +
        e
          .replace(/[\W_]/g, "|")
          .split("|")
          .map(function (e) {
            return "" + e.charAt(0).toUpperCase() + e.slice(1);
          })
          .join("")
          .slice(1)
      );
    };
  },
  function (e, t, n) {
    "use strict";
    (function (e, n) {
      t.a = {
        init: function () {
          var t,
            i =
              '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg>';
          function o(e) {
            try {
              new URL(e);
            } catch (e) {
              return !1;
            }
            return !0;
          }
          function r(e) {
            0 === n(e).parents(".share, .service-link").length &&
              (e.classList.add("external-link"),
              (function (e) {
                var t = '<span class="inline-svg rotate-45">' + i + "</span>";
                null === e.querySelector(".inline-svg") && n(e).prepend(t);
              })(e));
          }
          function s(e) {
            var t = '<span class="inline-svg rotate-0">' + i + "</span>";
            null === e.querySelector(".inline-svg") && n(e).prepend(t);
          }
          e(".venobox").venobox({ spinner: "wave", bgcolor: "#000" }),
            e("#services-select").change(function (e) {
              window.location.href = e.target.value;
            }),
            e("#skip-to-main").click(function (t) {
              e("#ihh-site-notification").length &&
                (t.preventDefault(), e("#ihh-site-notification").focus());
            }),
            e(document).ready(function () {
              e("a[target=_blank]").each(function () {
                e(this).append(
                  ' <span class="ihh-visually-hidden">opens in new tab</span>'
                );
              }),
                (function (e) {
                  for (
                    var t = window.location.hostname,
                      n = document.querySelectorAll(e),
                      i = 0;
                    i < n.length;
                    i++
                  )
                    if (o(n[i])) {
                      var a = new URL(n[i]),
                        l = a.hostname.replace("www.", "");
                      l &&
                      t !== l &&
                      !n[i].classList.contains("venobox") &&
                      !n[i].classList.contains("fancybox-youtube")
                        ? r(n[i])
                        : n[i].classList.contains("arrow") && s(n[i]);
                    }
                })(".main a"),
                (function (e, t) {
                  var i = document.querySelector(e),
                    o = document.querySelectorAll(t);
                  if (o && i) {
                    var r = document.createElement("ul"),
                      s = document.querySelector(
                        ".anchorlink-container.position_at_top"
                      );
                    if (s) {
                      var a = document.querySelector(".content-block"),
                        l = a.querySelectorAll("h1"),
                        c = a.querySelector("p.ingress");
                      c
                        ? n(".anchorlink-container").insertAfter(c)
                        : l && n(".anchorlink-container").insertAfter(l[0]);
                    }
                    for (var u = 0; u < o.length; u++) {
                      var d = o[u].innerText,
                        h = i.compareDocumentPosition(o[u]);
                      if (
                        "" !== d &&
                        4 === h &&
                        0 ===
                          n(o[u]).parents(
                            ".question, .sidebar, .cmplz-cookiebanner"
                          ).length
                      ) {
                        var f = d.match(/^\d/) ? "to-" + d : d,
                          p = f
                            .toLowerCase()
                            .replace(/\s+/g, "-")
                            .replace(/[^a-z0-9-]+/gi, ""),
                          m = "#" + p,
                          g = document.createElement("span");
                        g.setAttribute("id", p),
                          o[u].append(g),
                          o[u].classList.add("anchor-target");
                        var v = document.createElement("li"),
                          _ = document.createElement("a");
                        _.setAttribute("href", m),
                          _.append(d),
                          _.insertAdjacentHTML(
                            "afterbegin",
                            '<span class="inline-svg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg></span>'
                          ),
                          v.append(_),
                          r.append(v),
                          _.addEventListener("click", function (e) {
                            e.preventDefault(),
                              document
                                .querySelector(this.getAttribute("href"))
                                .scrollIntoView({ behavior: "smooth" });
                          });
                      }
                    }
                    i.appendChild(r);
                  }
                })(".anchorlink-navigation", "#main h2"),
                window.CXBus.configure({
                  pluginsPath:
                    "https://apps.mypurecloud.ie/widgets/9.0/plugins/",
                }),
                window.CXBus.loadPlugin("widgets-core"),
                e("a[target=_blank]").each(function () {
                  e(this).append(
                    ' <span class="ihh-visually-hidden">opens in new tab</span>'
                  );
                }),
                window.location.hash &&
                  setTimeout(function () {
                    var e = n("body").find(window.location.hash);
                    n("html, body").animate({ scrollTop: e.offset().top });
                  }, 1e3);
            }),
            (t = ".accordion-filters button"),
            document.querySelectorAll(t).forEach(function (e) {
              e.addEventListener("click", function () {
                var t = e.dataset.tagid,
                  i = e.classList.contains("selected"),
                  o = e.closest(".ihh-accordion");
                o.querySelectorAll("[data-tags]").forEach(function (e) {
                  var o = e.dataset.tags,
                    r = e.closest("li");
                  i
                    ? n(r).fadeIn("fast")
                    : o.includes(t)
                    ? n(r).fadeIn("fast")
                    : n(r).fadeOut("fast");
                }),
                  i
                    ? (e.classList.remove("selected"),
                      e.setAttribute("aria-pressed", "false"))
                    : (o
                        .querySelectorAll(".accordion-filters button")
                        .forEach(function (e) {
                          e.classList.remove("selected"),
                            e.setAttribute("aria-pressed", "false");
                        }),
                      e.classList.add("selected"),
                      e.setAttribute("aria-pressed", "true")),
                  setTimeout(function () {
                    var e = o
                      .querySelectorAll(
                        '.accordion-with-description--accordions li:not([style="display: none;"])'
                      )[0]
                      .querySelector(".question-header");
                    e && e.focus();
                  }, 400);
              });
            });
        },
        finalize: function () {},
      };
    }).call(t, n(0), n(0));
  },
  function (e, t, n) {
    "use strict";
    t.a = { init: function () {}, finalize: function () {} };
  },
  function (e, t) {},
]);
