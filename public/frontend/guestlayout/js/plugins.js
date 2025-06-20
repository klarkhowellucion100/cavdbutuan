!(function (e, t) {
  "object" == typeof exports && "undefined" != typeof module
    ? t(exports, require("jquery"))
    : "function" == typeof define && define.amd
    ? define(["exports", "jquery"], t)
    : t(((e = e || self).bootstrap = {}), e.jQuery);
})(this, function (e, p) {
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
  function s(e, t, n) {
    return t && i(e.prototype, t), n && i(e, n), e;
  }
  function t(t, e) {
    var n = Object.keys(t);
    if (Object.getOwnPropertySymbols) {
      var i = Object.getOwnPropertySymbols(t);
      e &&
        (i = i.filter(function (e) {
          return Object.getOwnPropertyDescriptor(t, e).enumerable;
        })),
        n.push.apply(n, i);
    }
    return n;
  }
  function l(o) {
    for (var e = 1; e < arguments.length; e++) {
      var r = null != arguments[e] ? arguments[e] : {};
      e % 2
        ? t(Object(r), !0).forEach(function (e) {
            var t, n, i;
            (t = o),
              (i = r[(n = e)]),
              n in t
                ? Object.defineProperty(t, n, {
                    value: i,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0,
                  })
                : (t[n] = i);
          })
        : Object.getOwnPropertyDescriptors
        ? Object.defineProperties(o, Object.getOwnPropertyDescriptors(r))
        : t(Object(r)).forEach(function (e) {
            Object.defineProperty(o, e, Object.getOwnPropertyDescriptor(r, e));
          });
    }
    return o;
  }
  p = p && p.hasOwnProperty("default") ? p.default : p;
  var n = "transitionend";
  function o(e) {
    var t = this,
      n = !1;
    return (
      p(this).one(m.TRANSITION_END, function () {
        n = !0;
      }),
      setTimeout(function () {
        n || m.triggerTransitionEnd(t);
      }, e),
      this
    );
  }
  var m = {
    TRANSITION_END: "bsTransitionEnd",
    getUID: function (e) {
      for (; (e += ~~(1e6 * Math.random())), document.getElementById(e); );
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
      var t = p(e).css("transition-duration"),
        n = p(e).css("transition-delay"),
        i = parseFloat(t),
        o = parseFloat(n);
      return i || o
        ? ((t = t.split(",")[0]),
          (n = n.split(",")[0]),
          1e3 * (parseFloat(t) + parseFloat(n)))
        : 0;
    },
    reflow: function (e) {
      return e.offsetHeight;
    },
    triggerTransitionEnd: function (e) {
      p(e).trigger(n);
    },
    supportsTransitionEnd: function () {
      return Boolean(n);
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
              r && m.isElement(r)
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
      if ("function" != typeof e.getRootNode)
        return e instanceof ShadowRoot
          ? e
          : e.parentNode
          ? m.findShadowRoot(e.parentNode)
          : null;
      var t = e.getRootNode();
      return t instanceof ShadowRoot ? t : null;
    },
    jQueryDetection: function () {
      if ("undefined" == typeof p)
        throw new TypeError(
          "Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript."
        );
      var e = p.fn.jquery.split(" ")[0].split(".");
      if (
        (e[0] < 2 && e[1] < 9) ||
        (1 === e[0] && 9 === e[1] && e[2] < 1) ||
        4 <= e[0]
      )
        throw new Error(
          "Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0"
        );
    },
  };
  m.jQueryDetection(),
    (p.fn.emulateTransitionEnd = o),
    (p.event.special[m.TRANSITION_END] = {
      bindType: n,
      delegateType: n,
      handle: function (e) {
        if (p(e.target).is(this))
          return e.handleObj.handler.apply(this, arguments);
      },
    });
  var r = "alert",
    a = "bs.alert",
    c = "." + a,
    h = p.fn[r],
    u = {
      CLOSE: "close" + c,
      CLOSED: "closed" + c,
      CLICK_DATA_API: "click" + c + ".data-api",
    },
    f = "alert",
    d = "fade",
    g = "show",
    _ = (function () {
      function i(e) {
        this._element = e;
      }
      var e = i.prototype;
      return (
        (e.close = function (e) {
          var t = this._element;
          e && (t = this._getRootElement(e)),
            this._triggerCloseEvent(t).isDefaultPrevented() ||
              this._removeElement(t);
        }),
        (e.dispose = function () {
          p.removeData(this._element, a), (this._element = null);
        }),
        (e._getRootElement = function (e) {
          var t = m.getSelectorFromElement(e),
            n = !1;
          return (
            t && (n = document.querySelector(t)),
            (n = n || p(e).closest("." + f)[0])
          );
        }),
        (e._triggerCloseEvent = function (e) {
          var t = p.Event(u.CLOSE);
          return p(e).trigger(t), t;
        }),
        (e._removeElement = function (t) {
          var n = this;
          if ((p(t).removeClass(g), p(t).hasClass(d))) {
            var e = m.getTransitionDurationFromElement(t);
            p(t)
              .one(m.TRANSITION_END, function (e) {
                return n._destroyElement(t, e);
              })
              .emulateTransitionEnd(e);
          } else this._destroyElement(t);
        }),
        (e._destroyElement = function (e) {
          p(e).detach().trigger(u.CLOSED).remove();
        }),
        (i._jQueryInterface = function (n) {
          return this.each(function () {
            var e = p(this),
              t = e.data(a);
            t || ((t = new i(this)), e.data(a, t)), "close" === n && t[n](this);
          });
        }),
        (i._handleDismiss = function (t) {
          return function (e) {
            e && e.preventDefault(), t.close(this);
          };
        }),
        s(i, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
        ]),
        i
      );
    })();
  p(document).on(
    u.CLICK_DATA_API,
    '[data-dismiss="alert"]',
    _._handleDismiss(new _())
  ),
    (p.fn[r] = _._jQueryInterface),
    (p.fn[r].Constructor = _),
    (p.fn[r].noConflict = function () {
      return (p.fn[r] = h), _._jQueryInterface;
    });
  var v = "button",
    y = "bs.button",
    E = "." + y,
    b = ".data-api",
    w = p.fn[v],
    T = "active",
    C = "btn",
    S = "focus",
    D = '[data-toggle^="button"]',
    I = '[data-toggle="buttons"]',
    A = '[data-toggle="button"]',
    O = '[data-toggle="buttons"] .btn',
    N = 'input:not([type="hidden"])',
    k = ".active",
    L = ".btn",
    P = {
      CLICK_DATA_API: "click" + E + b,
      FOCUS_BLUR_DATA_API: "focus" + E + b + " blur" + E + b,
      LOAD_DATA_API: "load" + E + b,
    },
    x = (function () {
      function n(e) {
        this._element = e;
      }
      var e = n.prototype;
      return (
        (e.toggle = function () {
          var e = !0,
            t = !0,
            n = p(this._element).closest(I)[0];
          if (n) {
            var i = this._element.querySelector(N);
            if (i) {
              if ("radio" === i.type)
                if (i.checked && this._element.classList.contains(T)) e = !1;
                else {
                  var o = n.querySelector(k);
                  o && p(o).removeClass(T);
                }
              else
                "checkbox" === i.type
                  ? "LABEL" === this._element.tagName &&
                    i.checked === this._element.classList.contains(T) &&
                    (e = !1)
                  : (e = !1);
              e &&
                ((i.checked = !this._element.classList.contains(T)),
                p(i).trigger("change")),
                i.focus(),
                (t = !1);
            }
          }
          this._element.hasAttribute("disabled") ||
            this._element.classList.contains("disabled") ||
            (t &&
              this._element.setAttribute(
                "aria-pressed",
                !this._element.classList.contains(T)
              ),
            e && p(this._element).toggleClass(T));
        }),
        (e.dispose = function () {
          p.removeData(this._element, y), (this._element = null);
        }),
        (n._jQueryInterface = function (t) {
          return this.each(function () {
            var e = p(this).data(y);
            e || ((e = new n(this)), p(this).data(y, e)),
              "toggle" === t && e[t]();
          });
        }),
        s(n, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
        ]),
        n
      );
    })();
  p(document)
    .on(P.CLICK_DATA_API, D, function (e) {
      var t = e.target;
      if (
        (p(t).hasClass(C) || (t = p(t).closest(L)[0]),
        !t || t.hasAttribute("disabled") || t.classList.contains("disabled"))
      )
        e.preventDefault();
      else {
        var n = t.querySelector(N);
        if (
          n &&
          (n.hasAttribute("disabled") || n.classList.contains("disabled"))
        )
          return void e.preventDefault();
        x._jQueryInterface.call(p(t), "toggle");
      }
    })
    .on(P.FOCUS_BLUR_DATA_API, D, function (e) {
      var t = p(e.target).closest(L)[0];
      p(t).toggleClass(S, /^focus(in)?$/.test(e.type));
    }),
    p(window).on(P.LOAD_DATA_API, function () {
      for (
        var e = [].slice.call(document.querySelectorAll(O)),
          t = 0,
          n = e.length;
        t < n;
        t++
      ) {
        var i = e[t],
          o = i.querySelector(N);
        o.checked || o.hasAttribute("checked")
          ? i.classList.add(T)
          : i.classList.remove(T);
      }
      for (
        var r = 0, s = (e = [].slice.call(document.querySelectorAll(A))).length;
        r < s;
        r++
      ) {
        var a = e[r];
        "true" === a.getAttribute("aria-pressed")
          ? a.classList.add(T)
          : a.classList.remove(T);
      }
    }),
    (p.fn[v] = x._jQueryInterface),
    (p.fn[v].Constructor = x),
    (p.fn[v].noConflict = function () {
      return (p.fn[v] = w), x._jQueryInterface;
    });
  var j = "carousel",
    H = "bs.carousel",
    R = "." + H,
    F = ".data-api",
    M = p.fn[j],
    W = {
      interval: 5e3,
      keyboard: !0,
      slide: !1,
      pause: "hover",
      wrap: !0,
      touch: !0,
    },
    U = {
      interval: "(number|boolean)",
      keyboard: "boolean",
      slide: "(boolean|string)",
      pause: "(string|boolean)",
      wrap: "boolean",
      touch: "boolean",
    },
    B = "next",
    q = "prev",
    K = "left",
    Q = "right",
    V = {
      SLIDE: "slide" + R,
      SLID: "slid" + R,
      KEYDOWN: "keydown" + R,
      MOUSEENTER: "mouseenter" + R,
      MOUSELEAVE: "mouseleave" + R,
      TOUCHSTART: "touchstart" + R,
      TOUCHMOVE: "touchmove" + R,
      TOUCHEND: "touchend" + R,
      POINTERDOWN: "pointerdown" + R,
      POINTERUP: "pointerup" + R,
      DRAG_START: "dragstart" + R,
      LOAD_DATA_API: "load" + R + F,
      CLICK_DATA_API: "click" + R + F,
    },
    Y = "carousel",
    z = "active",
    X = "slide",
    G = "carousel-item-right",
    $ = "carousel-item-left",
    J = "carousel-item-next",
    Z = "carousel-item-prev",
    ee = "pointer-event",
    te = ".active",
    ne = ".active.carousel-item",
    ie = ".carousel-item",
    oe = ".carousel-item img",
    re = ".carousel-item-next, .carousel-item-prev",
    se = ".carousel-indicators",
    ae = "[data-slide], [data-slide-to]",
    le = '[data-ride="carousel"]',
    ce = { TOUCH: "touch", PEN: "pen" },
    he = (function () {
      function r(e, t) {
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
          (this._indicatorsElement = this._element.querySelector(se)),
          (this._touchSupported =
            "ontouchstart" in document.documentElement ||
            0 < navigator.maxTouchPoints),
          (this._pointerEvent = Boolean(
            window.PointerEvent || window.MSPointerEvent
          )),
          this._addEventListeners();
      }
      var e = r.prototype;
      return (
        (e.next = function () {
          this._isSliding || this._slide(B);
        }),
        (e.nextWhenVisible = function () {
          !document.hidden &&
            p(this._element).is(":visible") &&
            "hidden" !== p(this._element).css("visibility") &&
            this.next();
        }),
        (e.prev = function () {
          this._isSliding || this._slide(q);
        }),
        (e.pause = function (e) {
          e || (this._isPaused = !0),
            this._element.querySelector(re) &&
              (m.triggerTransitionEnd(this._element), this.cycle(!0)),
            clearInterval(this._interval),
            (this._interval = null);
        }),
        (e.cycle = function (e) {
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
        (e.to = function (e) {
          var t = this;
          this._activeElement = this._element.querySelector(ne);
          var n = this._getItemIndex(this._activeElement);
          if (!(e > this._items.length - 1 || e < 0))
            if (this._isSliding)
              p(this._element).one(V.SLID, function () {
                return t.to(e);
              });
            else {
              if (n === e) return this.pause(), void this.cycle();
              var i = n < e ? B : q;
              this._slide(i, this._items[e]);
            }
        }),
        (e.dispose = function () {
          p(this._element).off(R),
            p.removeData(this._element, H),
            (this._items = null),
            (this._config = null),
            (this._element = null),
            (this._interval = null),
            (this._isPaused = null),
            (this._isSliding = null),
            (this._activeElement = null),
            (this._indicatorsElement = null);
        }),
        (e._getConfig = function (e) {
          return (e = l({}, W, {}, e)), m.typeCheckConfig(j, e, U), e;
        }),
        (e._handleSwipe = function () {
          var e = Math.abs(this.touchDeltaX);
          if (!(e <= 40)) {
            var t = e / this.touchDeltaX;
            (this.touchDeltaX = 0) < t && this.prev(), t < 0 && this.next();
          }
        }),
        (e._addEventListeners = function () {
          var t = this;
          this._config.keyboard &&
            p(this._element).on(V.KEYDOWN, function (e) {
              return t._keydown(e);
            }),
            "hover" === this._config.pause &&
              p(this._element)
                .on(V.MOUSEENTER, function (e) {
                  return t.pause(e);
                })
                .on(V.MOUSELEAVE, function (e) {
                  return t.cycle(e);
                }),
            this._config.touch && this._addTouchEventListeners();
        }),
        (e._addTouchEventListeners = function () {
          var t = this;
          if (this._touchSupported) {
            var n = function (e) {
                t._pointerEvent && ce[e.originalEvent.pointerType.toUpperCase()]
                  ? (t.touchStartX = e.originalEvent.clientX)
                  : t._pointerEvent ||
                    (t.touchStartX = e.originalEvent.touches[0].clientX);
              },
              i = function (e) {
                t._pointerEvent &&
                  ce[e.originalEvent.pointerType.toUpperCase()] &&
                  (t.touchDeltaX = e.originalEvent.clientX - t.touchStartX),
                  t._handleSwipe(),
                  "hover" === t._config.pause &&
                    (t.pause(),
                    t.touchTimeout && clearTimeout(t.touchTimeout),
                    (t.touchTimeout = setTimeout(function (e) {
                      return t.cycle(e);
                    }, 500 + t._config.interval)));
              };
            p(this._element.querySelectorAll(oe)).on(
              V.DRAG_START,
              function (e) {
                return e.preventDefault();
              }
            ),
              this._pointerEvent
                ? (p(this._element).on(V.POINTERDOWN, function (e) {
                    return n(e);
                  }),
                  p(this._element).on(V.POINTERUP, function (e) {
                    return i(e);
                  }),
                  this._element.classList.add(ee))
                : (p(this._element).on(V.TOUCHSTART, function (e) {
                    return n(e);
                  }),
                  p(this._element).on(V.TOUCHMOVE, function (e) {
                    return (function (e) {
                      e.originalEvent.touches &&
                      1 < e.originalEvent.touches.length
                        ? (t.touchDeltaX = 0)
                        : (t.touchDeltaX =
                            e.originalEvent.touches[0].clientX - t.touchStartX);
                    })(e);
                  }),
                  p(this._element).on(V.TOUCHEND, function (e) {
                    return i(e);
                  }));
          }
        }),
        (e._keydown = function (e) {
          if (!/input|textarea/i.test(e.target.tagName))
            switch (e.which) {
              case 37:
                e.preventDefault(), this.prev();
                break;
              case 39:
                e.preventDefault(), this.next();
            }
        }),
        (e._getItemIndex = function (e) {
          return (
            (this._items =
              e && e.parentNode
                ? [].slice.call(e.parentNode.querySelectorAll(ie))
                : []),
            this._items.indexOf(e)
          );
        }),
        (e._getItemByDirection = function (e, t) {
          var n = e === B,
            i = e === q,
            o = this._getItemIndex(t),
            r = this._items.length - 1;
          if (((i && 0 === o) || (n && o === r)) && !this._config.wrap)
            return t;
          var s = (o + (e === q ? -1 : 1)) % this._items.length;
          return -1 == s ? this._items[this._items.length - 1] : this._items[s];
        }),
        (e._triggerSlideEvent = function (e, t) {
          var n = this._getItemIndex(e),
            i = this._getItemIndex(this._element.querySelector(ne)),
            o = p.Event(V.SLIDE, {
              relatedTarget: e,
              direction: t,
              from: i,
              to: n,
            });
          return p(this._element).trigger(o), o;
        }),
        (e._setActiveIndicatorElement = function (e) {
          if (this._indicatorsElement) {
            var t = [].slice.call(this._indicatorsElement.querySelectorAll(te));
            p(t).removeClass(z);
            var n = this._indicatorsElement.children[this._getItemIndex(e)];
            n && p(n).addClass(z);
          }
        }),
        (e._slide = function (e, t) {
          var n,
            i,
            o,
            r = this,
            s = this._element.querySelector(ne),
            a = this._getItemIndex(s),
            l = t || (s && this._getItemByDirection(e, s)),
            c = this._getItemIndex(l),
            h = Boolean(this._interval);
          if (
            ((o = e === B ? ((n = $), (i = J), K) : ((n = G), (i = Z), Q)),
            l && p(l).hasClass(z))
          )
            this._isSliding = !1;
          else if (
            !this._triggerSlideEvent(l, o).isDefaultPrevented() &&
            s &&
            l
          ) {
            (this._isSliding = !0),
              h && this.pause(),
              this._setActiveIndicatorElement(l);
            var u = p.Event(V.SLID, {
              relatedTarget: l,
              direction: o,
              from: a,
              to: c,
            });
            if (p(this._element).hasClass(X)) {
              p(l).addClass(i), m.reflow(l), p(s).addClass(n), p(l).addClass(n);
              var f = parseInt(l.getAttribute("data-interval"), 10);
              f
                ? ((this._config.defaultInterval =
                    this._config.defaultInterval || this._config.interval),
                  (this._config.interval = f))
                : (this._config.interval =
                    this._config.defaultInterval || this._config.interval);
              var d = m.getTransitionDurationFromElement(s);
              p(s)
                .one(m.TRANSITION_END, function () {
                  p(l)
                    .removeClass(n + " " + i)
                    .addClass(z),
                    p(s).removeClass(z + " " + i + " " + n),
                    (r._isSliding = !1),
                    setTimeout(function () {
                      return p(r._element).trigger(u);
                    }, 0);
                })
                .emulateTransitionEnd(d);
            } else
              p(s).removeClass(z),
                p(l).addClass(z),
                (this._isSliding = !1),
                p(this._element).trigger(u);
            h && this.cycle();
          }
        }),
        (r._jQueryInterface = function (i) {
          return this.each(function () {
            var e = p(this).data(H),
              t = l({}, W, {}, p(this).data());
            "object" == typeof i && (t = l({}, t, {}, i));
            var n = "string" == typeof i ? i : t.slide;
            if (
              (e || ((e = new r(this, t)), p(this).data(H, e)),
              "number" == typeof i)
            )
              e.to(i);
            else if ("string" == typeof n) {
              if ("undefined" == typeof e[n])
                throw new TypeError('No method named "' + n + '"');
              e[n]();
            } else t.interval && t.ride && (e.pause(), e.cycle());
          });
        }),
        (r._dataApiClickHandler = function (e) {
          var t = m.getSelectorFromElement(this);
          if (t) {
            var n = p(t)[0];
            if (n && p(n).hasClass(Y)) {
              var i = l({}, p(n).data(), {}, p(this).data()),
                o = this.getAttribute("data-slide-to");
              o && (i.interval = !1),
                r._jQueryInterface.call(p(n), i),
                o && p(n).data(H).to(o),
                e.preventDefault();
            }
          }
        }),
        s(r, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
          {
            key: "Default",
            get: function () {
              return W;
            },
          },
        ]),
        r
      );
    })();
  p(document).on(V.CLICK_DATA_API, ae, he._dataApiClickHandler),
    p(window).on(V.LOAD_DATA_API, function () {
      for (
        var e = [].slice.call(document.querySelectorAll(le)),
          t = 0,
          n = e.length;
        t < n;
        t++
      ) {
        var i = p(e[t]);
        he._jQueryInterface.call(i, i.data());
      }
    }),
    (p.fn[j] = he._jQueryInterface),
    (p.fn[j].Constructor = he),
    (p.fn[j].noConflict = function () {
      return (p.fn[j] = M), he._jQueryInterface;
    });
  var ue = "collapse",
    fe = "bs.collapse",
    de = "." + fe,
    pe = p.fn[ue],
    me = { toggle: !0, parent: "" },
    ge = { toggle: "boolean", parent: "(string|element)" },
    _e = {
      SHOW: "show" + de,
      SHOWN: "shown" + de,
      HIDE: "hide" + de,
      HIDDEN: "hidden" + de,
      CLICK_DATA_API: "click" + de + ".data-api",
    },
    ve = "show",
    ye = "collapse",
    Ee = "collapsing",
    be = "collapsed",
    we = "width",
    Te = "height",
    Ce = ".show, .collapsing",
    Se = '[data-toggle="collapse"]',
    De = (function () {
      function a(t, e) {
        (this._isTransitioning = !1),
          (this._element = t),
          (this._config = this._getConfig(e)),
          (this._triggerArray = [].slice.call(
            document.querySelectorAll(
              '[data-toggle="collapse"][href="#' +
                t.id +
                '"],[data-toggle="collapse"][data-target="#' +
                t.id +
                '"]'
            )
          ));
        for (
          var n = [].slice.call(document.querySelectorAll(Se)),
            i = 0,
            o = n.length;
          i < o;
          i++
        ) {
          var r = n[i],
            s = m.getSelectorFromElement(r),
            a = [].slice
              .call(document.querySelectorAll(s))
              .filter(function (e) {
                return e === t;
              });
          null !== s &&
            0 < a.length &&
            ((this._selector = s), this._triggerArray.push(r));
        }
        (this._parent = this._config.parent ? this._getParent() : null),
          this._config.parent ||
            this._addAriaAndCollapsedClass(this._element, this._triggerArray),
          this._config.toggle && this.toggle();
      }
      var e = a.prototype;
      return (
        (e.toggle = function () {
          p(this._element).hasClass(ve) ? this.hide() : this.show();
        }),
        (e.show = function () {
          var e,
            t,
            n = this;
          if (
            !this._isTransitioning &&
            !p(this._element).hasClass(ve) &&
            (this._parent &&
              0 ===
                (e = [].slice
                  .call(this._parent.querySelectorAll(Ce))
                  .filter(function (e) {
                    return "string" == typeof n._config.parent
                      ? e.getAttribute("data-parent") === n._config.parent
                      : e.classList.contains(ye);
                  })).length &&
              (e = null),
            !(
              e &&
              (t = p(e).not(this._selector).data(fe)) &&
              t._isTransitioning
            ))
          ) {
            var i = p.Event(_e.SHOW);
            if ((p(this._element).trigger(i), !i.isDefaultPrevented())) {
              e &&
                (a._jQueryInterface.call(p(e).not(this._selector), "hide"),
                t || p(e).data(fe, null));
              var o = this._getDimension();
              p(this._element).removeClass(ye).addClass(Ee),
                (this._element.style[o] = 0),
                this._triggerArray.length &&
                  p(this._triggerArray)
                    .removeClass(be)
                    .attr("aria-expanded", !0),
                this.setTransitioning(!0);
              var r = "scroll" + (o[0].toUpperCase() + o.slice(1)),
                s = m.getTransitionDurationFromElement(this._element);
              p(this._element)
                .one(m.TRANSITION_END, function () {
                  p(n._element).removeClass(Ee).addClass(ye).addClass(ve),
                    (n._element.style[o] = ""),
                    n.setTransitioning(!1),
                    p(n._element).trigger(_e.SHOWN);
                })
                .emulateTransitionEnd(s),
                (this._element.style[o] = this._element[r] + "px");
            }
          }
        }),
        (e.hide = function () {
          var e = this;
          if (!this._isTransitioning && p(this._element).hasClass(ve)) {
            var t = p.Event(_e.HIDE);
            if ((p(this._element).trigger(t), !t.isDefaultPrevented())) {
              var n = this._getDimension();
              (this._element.style[n] =
                this._element.getBoundingClientRect()[n] + "px"),
                m.reflow(this._element),
                p(this._element).addClass(Ee).removeClass(ye).removeClass(ve);
              var i = this._triggerArray.length;
              if (0 < i)
                for (var o = 0; o < i; o++) {
                  var r = this._triggerArray[o],
                    s = m.getSelectorFromElement(r);
                  if (null !== s)
                    p([].slice.call(document.querySelectorAll(s))).hasClass(
                      ve
                    ) || p(r).addClass(be).attr("aria-expanded", !1);
                }
              this.setTransitioning(!0);
              this._element.style[n] = "";
              var a = m.getTransitionDurationFromElement(this._element);
              p(this._element)
                .one(m.TRANSITION_END, function () {
                  e.setTransitioning(!1),
                    p(e._element)
                      .removeClass(Ee)
                      .addClass(ye)
                      .trigger(_e.HIDDEN);
                })
                .emulateTransitionEnd(a);
            }
          }
        }),
        (e.setTransitioning = function (e) {
          this._isTransitioning = e;
        }),
        (e.dispose = function () {
          p.removeData(this._element, fe),
            (this._config = null),
            (this._parent = null),
            (this._element = null),
            (this._triggerArray = null),
            (this._isTransitioning = null);
        }),
        (e._getConfig = function (e) {
          return (
            ((e = l({}, me, {}, e)).toggle = Boolean(e.toggle)),
            m.typeCheckConfig(ue, e, ge),
            e
          );
        }),
        (e._getDimension = function () {
          return p(this._element).hasClass(we) ? we : Te;
        }),
        (e._getParent = function () {
          var e,
            n = this;
          m.isElement(this._config.parent)
            ? ((e = this._config.parent),
              "undefined" != typeof this._config.parent.jquery &&
                (e = this._config.parent[0]))
            : (e = document.querySelector(this._config.parent));
          var t =
              '[data-toggle="collapse"][data-parent="' +
              this._config.parent +
              '"]',
            i = [].slice.call(e.querySelectorAll(t));
          return (
            p(i).each(function (e, t) {
              n._addAriaAndCollapsedClass(a._getTargetFromElement(t), [t]);
            }),
            e
          );
        }),
        (e._addAriaAndCollapsedClass = function (e, t) {
          var n = p(e).hasClass(ve);
          t.length && p(t).toggleClass(be, !n).attr("aria-expanded", n);
        }),
        (a._getTargetFromElement = function (e) {
          var t = m.getSelectorFromElement(e);
          return t ? document.querySelector(t) : null;
        }),
        (a._jQueryInterface = function (i) {
          return this.each(function () {
            var e = p(this),
              t = e.data(fe),
              n = l(
                {},
                me,
                {},
                e.data(),
                {},
                "object" == typeof i && i ? i : {}
              );
            if (
              (!t && n.toggle && /show|hide/.test(i) && (n.toggle = !1),
              t || ((t = new a(this, n)), e.data(fe, t)),
              "string" == typeof i)
            ) {
              if ("undefined" == typeof t[i])
                throw new TypeError('No method named "' + i + '"');
              t[i]();
            }
          });
        }),
        s(a, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
          {
            key: "Default",
            get: function () {
              return me;
            },
          },
        ]),
        a
      );
    })();
  p(document).on(_e.CLICK_DATA_API, Se, function (e) {
    "A" === e.currentTarget.tagName && e.preventDefault();
    var n = p(this),
      t = m.getSelectorFromElement(this),
      i = [].slice.call(document.querySelectorAll(t));
    p(i).each(function () {
      var e = p(this),
        t = e.data(fe) ? "toggle" : n.data();
      De._jQueryInterface.call(e, t);
    });
  }),
    (p.fn[ue] = De._jQueryInterface),
    (p.fn[ue].Constructor = De),
    (p.fn[ue].noConflict = function () {
      return (p.fn[ue] = pe), De._jQueryInterface;
    });
  var Ie =
      "undefined" != typeof window &&
      "undefined" != typeof document &&
      "undefined" != typeof navigator,
    Ae = (function () {
      for (var e = ["Edge", "Trident", "Firefox"], t = 0; t < e.length; t += 1)
        if (Ie && 0 <= navigator.userAgent.indexOf(e[t])) return 1;
      return 0;
    })();
  var Oe =
    Ie && window.Promise
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
              }, Ae));
          };
        };
  function Ne(e) {
    return e && "[object Function]" === {}.toString.call(e);
  }
  function ke(e, t) {
    if (1 !== e.nodeType) return [];
    var n = e.ownerDocument.defaultView.getComputedStyle(e, null);
    return t ? n[t] : n;
  }
  function Le(e) {
    return "HTML" === e.nodeName ? e : e.parentNode || e.host;
  }
  function Pe(e) {
    if (!e) return document.body;
    switch (e.nodeName) {
      case "HTML":
      case "BODY":
        return e.ownerDocument.body;
      case "#document":
        return e.body;
    }
    var t = ke(e),
      n = t.overflow,
      i = t.overflowX,
      o = t.overflowY;
    return /(auto|scroll|overlay)/.test(n + o + i) ? e : Pe(Le(e));
  }
  function xe(e) {
    return e && e.referenceNode ? e.referenceNode : e;
  }
  var je = Ie && !(!window.MSInputMethodContext || !document.documentMode),
    He = Ie && /MSIE 10/.test(navigator.userAgent);
  function Re(e) {
    return 11 === e ? je : 10 === e ? He : je || He;
  }
  function Fe(e) {
    if (!e) return document.documentElement;
    for (
      var t = Re(10) ? document.body : null, n = e.offsetParent || null;
      n === t && e.nextElementSibling;

    )
      n = (e = e.nextElementSibling).offsetParent;
    var i = n && n.nodeName;
    return i && "BODY" !== i && "HTML" !== i
      ? -1 !== ["TH", "TD", "TABLE"].indexOf(n.nodeName) &&
        "static" === ke(n, "position")
        ? Fe(n)
        : n
      : e
      ? e.ownerDocument.documentElement
      : document.documentElement;
  }
  function Me(e) {
    return null !== e.parentNode ? Me(e.parentNode) : e;
  }
  function We(e, t) {
    if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;
    var n = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
      i = n ? e : t,
      o = n ? t : e,
      r = document.createRange();
    r.setStart(i, 0), r.setEnd(o, 0);
    var s = r.commonAncestorContainer;
    if ((e !== s && t !== s) || i.contains(o))
      return (function (e) {
        var t = e.nodeName;
        return "BODY" !== t && ("HTML" === t || Fe(e.firstElementChild) === e);
      })(s)
        ? s
        : Fe(s);
    var a = Me(e);
    return a.host ? We(a.host, t) : We(e, Me(t).host);
  }
  function Ue(e, t) {
    var n =
        "top" === (1 < arguments.length && void 0 !== t ? t : "top")
          ? "scrollTop"
          : "scrollLeft",
      i = e.nodeName;
    if ("BODY" !== i && "HTML" !== i) return e[n];
    var o = e.ownerDocument.documentElement;
    return (e.ownerDocument.scrollingElement || o)[n];
  }
  function Be(e, t) {
    var n = "x" === t ? "Left" : "Top",
      i = "Left" == n ? "Right" : "Bottom";
    return (
      parseFloat(e["border" + n + "Width"], 10) +
      parseFloat(e["border" + i + "Width"], 10)
    );
  }
  function qe(e, t, n, i) {
    return Math.max(
      t["offset" + e],
      t["scroll" + e],
      n["client" + e],
      n["offset" + e],
      n["scroll" + e],
      Re(10)
        ? parseInt(n["offset" + e]) +
            parseInt(i["margin" + ("Height" === e ? "Top" : "Left")]) +
            parseInt(i["margin" + ("Height" === e ? "Bottom" : "Right")])
        : 0
    );
  }
  function Ke(e) {
    var t = e.body,
      n = e.documentElement,
      i = Re(10) && getComputedStyle(n);
    return { height: qe("Height", t, n, i), width: qe("Width", t, n, i) };
  }
  var Qe = function (e, t, n) {
    return t && Ve(e.prototype, t), n && Ve(e, n), e;
  };
  function Ve(e, t) {
    for (var n = 0; n < t.length; n++) {
      var i = t[n];
      (i.enumerable = i.enumerable || !1),
        (i.configurable = !0),
        "value" in i && (i.writable = !0),
        Object.defineProperty(e, i.key, i);
    }
  }
  function Ye(e, t, n) {
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
  var ze =
    Object.assign ||
    function (e) {
      for (var t = 1; t < arguments.length; t++) {
        var n = arguments[t];
        for (var i in n)
          Object.prototype.hasOwnProperty.call(n, i) && (e[i] = n[i]);
      }
      return e;
    };
  function Xe(e) {
    return ze({}, e, { right: e.left + e.width, bottom: e.top + e.height });
  }
  function Ge(e) {
    var t = {};
    try {
      if (Re(10)) {
        t = e.getBoundingClientRect();
        var n = Ue(e, "top"),
          i = Ue(e, "left");
        (t.top += n), (t.left += i), (t.bottom += n), (t.right += i);
      } else t = e.getBoundingClientRect();
    } catch (e) {}
    var o = {
        left: t.left,
        top: t.top,
        width: t.right - t.left,
        height: t.bottom - t.top,
      },
      r = "HTML" === e.nodeName ? Ke(e.ownerDocument) : {},
      s = r.width || e.clientWidth || o.width,
      a = r.height || e.clientHeight || o.height,
      l = e.offsetWidth - s,
      c = e.offsetHeight - a;
    if (l || c) {
      var h = ke(e);
      (l -= Be(h, "x")), (c -= Be(h, "y")), (o.width -= l), (o.height -= c);
    }
    return Xe(o);
  }
  function $e(e, t, n) {
    var i = 2 < arguments.length && void 0 !== n && n,
      o = Re(10),
      r = "HTML" === t.nodeName,
      s = Ge(e),
      a = Ge(t),
      l = Pe(e),
      c = ke(t),
      h = parseFloat(c.borderTopWidth, 10),
      u = parseFloat(c.borderLeftWidth, 10);
    i && r && ((a.top = Math.max(a.top, 0)), (a.left = Math.max(a.left, 0)));
    var f = Xe({
      top: s.top - a.top - h,
      left: s.left - a.left - u,
      width: s.width,
      height: s.height,
    });
    if (((f.marginTop = 0), (f.marginLeft = 0), !o && r)) {
      var d = parseFloat(c.marginTop, 10),
        p = parseFloat(c.marginLeft, 10);
      (f.top -= h - d),
        (f.bottom -= h - d),
        (f.left -= u - p),
        (f.right -= u - p),
        (f.marginTop = d),
        (f.marginLeft = p);
    }
    return (
      (o && !i ? t.contains(l) : t === l && "BODY" !== l.nodeName) &&
        (f = (function (e, t, n) {
          var i = 2 < arguments.length && void 0 !== n && n,
            o = Ue(t, "top"),
            r = Ue(t, "left"),
            s = i ? -1 : 1;
          return (
            (e.top += o * s),
            (e.bottom += o * s),
            (e.left += r * s),
            (e.right += r * s),
            e
          );
        })(f, t)),
      f
    );
  }
  function Je(e) {
    if (!e || !e.parentElement || Re()) return document.documentElement;
    for (var t = e.parentElement; t && "none" === ke(t, "transform"); )
      t = t.parentElement;
    return t || document.documentElement;
  }
  function Ze(e, t, n, i, o) {
    var r = 4 < arguments.length && void 0 !== o && o,
      s = { top: 0, left: 0 },
      a = r ? Je(e) : We(e, xe(t));
    if ("viewport" === i)
      s = (function (e, t) {
        var n = 1 < arguments.length && void 0 !== t && t,
          i = e.ownerDocument.documentElement,
          o = $e(e, i),
          r = Math.max(i.clientWidth, window.innerWidth || 0),
          s = Math.max(i.clientHeight, window.innerHeight || 0),
          a = n ? 0 : Ue(i),
          l = n ? 0 : Ue(i, "left");
        return Xe({
          top: a - o.top + o.marginTop,
          left: l - o.left + o.marginLeft,
          width: r,
          height: s,
        });
      })(a, r);
    else {
      var l = void 0;
      "scrollParent" === i
        ? "BODY" === (l = Pe(Le(t))).nodeName &&
          (l = e.ownerDocument.documentElement)
        : (l = "window" === i ? e.ownerDocument.documentElement : i);
      var c = $e(l, a, r);
      if (
        "HTML" !== l.nodeName ||
        (function e(t) {
          var n = t.nodeName;
          if ("BODY" === n || "HTML" === n) return !1;
          if ("fixed" === ke(t, "position")) return !0;
          var i = Le(t);
          return !!i && e(i);
        })(a)
      )
        s = c;
      else {
        var h = Ke(e.ownerDocument),
          u = h.height,
          f = h.width;
        (s.top += c.top - c.marginTop),
          (s.bottom = u + c.top),
          (s.left += c.left - c.marginLeft),
          (s.right = f + c.left);
      }
    }
    var d = "number" == typeof (n = n || 0);
    return (
      (s.left += d ? n : n.left || 0),
      (s.top += d ? n : n.top || 0),
      (s.right -= d ? n : n.right || 0),
      (s.bottom -= d ? n : n.bottom || 0),
      s
    );
  }
  function et(e, t, i, n, o, r) {
    var s = 5 < arguments.length && void 0 !== r ? r : 0;
    if (-1 === e.indexOf("auto")) return e;
    var a = Ze(i, n, s, o),
      l = {
        top: { width: a.width, height: t.top - a.top },
        right: { width: a.right - t.right, height: a.height },
        bottom: { width: a.width, height: a.bottom - t.bottom },
        left: { width: t.left - a.left, height: a.height },
      },
      c = Object.keys(l)
        .map(function (e) {
          return ze({ key: e }, l[e], {
            area: (function (e) {
              return e.width * e.height;
            })(l[e]),
          });
        })
        .sort(function (e, t) {
          return t.area - e.area;
        }),
      h = c.filter(function (e) {
        var t = e.width,
          n = e.height;
        return t >= i.clientWidth && n >= i.clientHeight;
      }),
      u = 0 < h.length ? h[0].key : c[0].key,
      f = e.split("-")[1];
    return u + (f ? "-" + f : "");
  }
  function tt(e, t, n, i) {
    var o = 3 < arguments.length && void 0 !== i ? i : null;
    return $e(n, o ? Je(t) : We(t, xe(n)), o);
  }
  function nt(e) {
    var t = e.ownerDocument.defaultView.getComputedStyle(e),
      n = parseFloat(t.marginTop || 0) + parseFloat(t.marginBottom || 0),
      i = parseFloat(t.marginLeft || 0) + parseFloat(t.marginRight || 0);
    return { width: e.offsetWidth + i, height: e.offsetHeight + n };
  }
  function it(e) {
    var t = { left: "right", right: "left", bottom: "top", top: "bottom" };
    return e.replace(/left|right|bottom|top/g, function (e) {
      return t[e];
    });
  }
  function ot(e, t, n) {
    n = n.split("-")[0];
    var i = nt(e),
      o = { width: i.width, height: i.height },
      r = -1 !== ["right", "left"].indexOf(n),
      s = r ? "top" : "left",
      a = r ? "left" : "top",
      l = r ? "height" : "width",
      c = r ? "width" : "height";
    return (
      (o[s] = t[s] + t[l] / 2 - i[l] / 2),
      (o[a] = n === a ? t[a] - i[c] : t[it(a)]),
      o
    );
  }
  function rt(e, t) {
    return Array.prototype.find ? e.find(t) : e.filter(t)[0];
  }
  function st(e, n, t) {
    return (
      (void 0 === t
        ? e
        : e.slice(
            0,
            (function (e, t, n) {
              if (Array.prototype.findIndex)
                return e.findIndex(function (e) {
                  return e[t] === n;
                });
              var i = rt(e, function (e) {
                return e[t] === n;
              });
              return e.indexOf(i);
            })(e, "name", t)
          )
      ).forEach(function (e) {
        e.function &&
          console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
        var t = e.function || e.fn;
        e.enabled &&
          Ne(t) &&
          ((n.offsets.popper = Xe(n.offsets.popper)),
          (n.offsets.reference = Xe(n.offsets.reference)),
          (n = t(n, e)));
      }),
      n
    );
  }
  function at(e, n) {
    return e.some(function (e) {
      var t = e.name;
      return e.enabled && t === n;
    });
  }
  function lt(e) {
    for (
      var t = [!1, "ms", "Webkit", "Moz", "O"],
        n = e.charAt(0).toUpperCase() + e.slice(1),
        i = 0;
      i < t.length;
      i++
    ) {
      var o = t[i],
        r = o ? "" + o + n : e;
      if ("undefined" != typeof document.body.style[r]) return r;
    }
    return null;
  }
  function ct(e) {
    var t = e.ownerDocument;
    return t ? t.defaultView : window;
  }
  function ht(e, t, n, i) {
    (n.updateBound = i),
      ct(e).addEventListener("resize", n.updateBound, { passive: !0 });
    var o = Pe(e);
    return (
      (function e(t, n, i, o) {
        var r = "BODY" === t.nodeName,
          s = r ? t.ownerDocument.defaultView : t;
        s.addEventListener(n, i, { passive: !0 }),
          r || e(Pe(s.parentNode), n, i, o),
          o.push(s);
      })(o, "scroll", n.updateBound, n.scrollParents),
      (n.scrollElement = o),
      (n.eventsEnabled = !0),
      n
    );
  }
  function ut() {
    this.state.eventsEnabled &&
      (cancelAnimationFrame(this.scheduleUpdate),
      (this.state = (function (e, t) {
        return (
          ct(e).removeEventListener("resize", t.updateBound),
          t.scrollParents.forEach(function (e) {
            e.removeEventListener("scroll", t.updateBound);
          }),
          (t.updateBound = null),
          (t.scrollParents = []),
          (t.scrollElement = null),
          (t.eventsEnabled = !1),
          t
        );
      })(this.reference, this.state)));
  }
  function ft(e) {
    return "" !== e && !isNaN(parseFloat(e)) && isFinite(e);
  }
  function dt(n, i) {
    Object.keys(i).forEach(function (e) {
      var t = "";
      -1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(e) &&
        ft(i[e]) &&
        (t = "px"),
        (n.style[e] = i[e] + t);
    });
  }
  function pt(e, t) {
    function n(e) {
      return e;
    }
    var i = e.offsets,
      o = i.popper,
      r = i.reference,
      s = Math.round,
      a = Math.floor,
      l = s(r.width),
      c = s(o.width),
      h = -1 !== ["left", "right"].indexOf(e.placement),
      u = -1 !== e.placement.indexOf("-"),
      f = t ? (h || u || l % 2 == c % 2 ? s : a) : n,
      d = t ? s : n;
    return {
      left: f(l % 2 == 1 && c % 2 == 1 && !u && t ? o.left - 1 : o.left),
      top: d(o.top),
      bottom: d(o.bottom),
      right: f(o.right),
    };
  }
  var mt = Ie && /Firefox/i.test(navigator.userAgent);
  function gt(e, t, n) {
    var i = rt(e, function (e) {
        return e.name === t;
      }),
      o =
        !!i &&
        e.some(function (e) {
          return e.name === n && e.enabled && e.order < i.order;
        });
    if (!o) {
      var r = "`" + t + "`",
        s = "`" + n + "`";
      console.warn(
        s +
          " modifier is required by " +
          r +
          " modifier in order to work, be sure to include it before " +
          r +
          "!"
      );
    }
    return o;
  }
  var _t = [
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
    vt = _t.slice(3);
  function yt(e, t) {
    var n = 1 < arguments.length && void 0 !== t && t,
      i = vt.indexOf(e),
      o = vt.slice(i + 1).concat(vt.slice(0, i));
    return n ? o.reverse() : o;
  }
  var Et = "flip",
    bt = "clockwise",
    wt = "counterclockwise";
  function Tt(e, o, r, t) {
    var s = [0, 0],
      a = -1 !== ["right", "left"].indexOf(t),
      n = e.split(/(\+|\-)/).map(function (e) {
        return e.trim();
      }),
      i = n.indexOf(
        rt(n, function (e) {
          return -1 !== e.search(/,|\s/);
        })
      );
    n[i] &&
      -1 === n[i].indexOf(",") &&
      console.warn(
        "Offsets separated by white space(s) are deprecated, use a comma (,) instead."
      );
    var l = /\s*,\s*|\s+/,
      c =
        -1 !== i
          ? [
              n.slice(0, i).concat([n[i].split(l)[0]]),
              [n[i].split(l)[1]].concat(n.slice(i + 1)),
            ]
          : [n];
    return (
      (c = c.map(function (e, t) {
        var n = (1 === t ? !a : a) ? "height" : "width",
          i = !1;
        return e
          .reduce(function (e, t) {
            return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t)
              ? ((e[e.length - 1] = t), (i = !0), e)
              : i
              ? ((e[e.length - 1] += t), (i = !1), e)
              : e.concat(t);
          }, [])
          .map(function (e) {
            return (function (e, t, n, i) {
              var o = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                r = +o[1],
                s = o[2];
              if (!r) return e;
              if (0 !== s.indexOf("%"))
                return "vh" !== s && "vw" !== s
                  ? r
                  : (("vh" === s
                      ? Math.max(
                          document.documentElement.clientHeight,
                          window.innerHeight || 0
                        )
                      : Math.max(
                          document.documentElement.clientWidth,
                          window.innerWidth || 0
                        )) /
                      100) *
                      r;
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
              return (Xe(a)[t] / 100) * r;
            })(e, n, o, r);
          });
      })).forEach(function (n, i) {
        n.forEach(function (e, t) {
          ft(e) && (s[i] += e * ("-" === n[t - 1] ? -1 : 1));
        });
      }),
      s
    );
  }
  var Ct = {
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
                h = {
                  start: Ye({}, l, r[l]),
                  end: Ye({}, l, r[l] + r[c] - s[c]),
                };
              e.offsets.popper = ze({}, s, h[i]);
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
              (l = ft(+n) ? [+n, 0] : Tt(n, r, s, a)),
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
          fn: function (e, i) {
            var t = i.boundariesElement || Fe(e.instance.popper);
            e.instance.reference === t && (t = Fe(t));
            var n = lt("transform"),
              o = e.instance.popper.style,
              r = o.top,
              s = o.left,
              a = o[n];
            (o.top = ""), (o.left = ""), (o[n] = "");
            var l = Ze(
              e.instance.popper,
              e.instance.reference,
              i.padding,
              t,
              e.positionFixed
            );
            (o.top = r), (o.left = s), (o[n] = a), (i.boundaries = l);
            var c = i.priority,
              h = e.offsets.popper,
              u = {
                primary: function (e) {
                  var t = h[e];
                  return (
                    h[e] < l[e] &&
                      !i.escapeWithReference &&
                      (t = Math.max(h[e], l[e])),
                    Ye({}, e, t)
                  );
                },
                secondary: function (e) {
                  var t = "right" === e ? "left" : "top",
                    n = h[t];
                  return (
                    h[e] > l[e] &&
                      !i.escapeWithReference &&
                      (n = Math.min(
                        h[t],
                        l[e] - ("right" === e ? h.width : h.height)
                      )),
                    Ye({}, t, n)
                  );
                },
              };
            return (
              c.forEach(function (e) {
                var t =
                  -1 !== ["left", "top"].indexOf(e) ? "primary" : "secondary";
                h = ze({}, h, u[t](e));
              }),
              (e.offsets.popper = h),
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
            if (!gt(e.instance.modifiers, "arrow", "keepTogether")) return e;
            var i = t.element;
            if ("string" == typeof i) {
              if (!(i = e.instance.popper.querySelector(i))) return e;
            } else if (!e.instance.popper.contains(i))
              return (
                console.warn(
                  "WARNING: `arrow.element` must be child of its popper element!"
                ),
                e
              );
            var o = e.placement.split("-")[0],
              r = e.offsets,
              s = r.popper,
              a = r.reference,
              l = -1 !== ["left", "right"].indexOf(o),
              c = l ? "height" : "width",
              h = l ? "Top" : "Left",
              u = h.toLowerCase(),
              f = l ? "left" : "top",
              d = l ? "bottom" : "right",
              p = nt(i)[c];
            a[d] - p < s[u] && (e.offsets.popper[u] -= s[u] - (a[d] - p)),
              a[u] + p > s[d] && (e.offsets.popper[u] += a[u] + p - s[d]),
              (e.offsets.popper = Xe(e.offsets.popper));
            var m = a[u] + a[c] / 2 - p / 2,
              g = ke(e.instance.popper),
              _ = parseFloat(g["margin" + h], 10),
              v = parseFloat(g["border" + h + "Width"], 10),
              y = m - e.offsets.popper[u] - _ - v;
            return (
              (y = Math.max(Math.min(s[c] - p, y), 0)),
              (e.arrowElement = i),
              (e.offsets.arrow =
                (Ye((n = {}), u, Math.round(y)), Ye(n, f, ""), n)),
              e
            );
          },
          element: "[x-arrow]",
        },
        flip: {
          order: 600,
          enabled: !0,
          fn: function (m, g) {
            if (at(m.instance.modifiers, "inner")) return m;
            if (m.flipped && m.placement === m.originalPlacement) return m;
            var _ = Ze(
                m.instance.popper,
                m.instance.reference,
                g.padding,
                g.boundariesElement,
                m.positionFixed
              ),
              v = m.placement.split("-")[0],
              y = it(v),
              E = m.placement.split("-")[1] || "",
              b = [];
            switch (g.behavior) {
              case Et:
                b = [v, y];
                break;
              case bt:
                b = yt(v);
                break;
              case wt:
                b = yt(v, !0);
                break;
              default:
                b = g.behavior;
            }
            return (
              b.forEach(function (e, t) {
                if (v !== e || b.length === t + 1) return m;
                (v = m.placement.split("-")[0]), (y = it(v));
                var n = m.offsets.popper,
                  i = m.offsets.reference,
                  o = Math.floor,
                  r =
                    ("left" === v && o(n.right) > o(i.left)) ||
                    ("right" === v && o(n.left) < o(i.right)) ||
                    ("top" === v && o(n.bottom) > o(i.top)) ||
                    ("bottom" === v && o(n.top) < o(i.bottom)),
                  s = o(n.left) < o(_.left),
                  a = o(n.right) > o(_.right),
                  l = o(n.top) < o(_.top),
                  c = o(n.bottom) > o(_.bottom),
                  h =
                    ("left" === v && s) ||
                    ("right" === v && a) ||
                    ("top" === v && l) ||
                    ("bottom" === v && c),
                  u = -1 !== ["top", "bottom"].indexOf(v),
                  f =
                    !!g.flipVariations &&
                    ((u && "start" === E && s) ||
                      (u && "end" === E && a) ||
                      (!u && "start" === E && l) ||
                      (!u && "end" === E && c)),
                  d =
                    !!g.flipVariationsByContent &&
                    ((u && "start" === E && a) ||
                      (u && "end" === E && s) ||
                      (!u && "start" === E && c) ||
                      (!u && "end" === E && l)),
                  p = f || d;
                (r || h || p) &&
                  ((m.flipped = !0),
                  (r || h) && (v = b[t + 1]),
                  p &&
                    (E = (function (e) {
                      return "end" === e ? "start" : "start" === e ? "end" : e;
                    })(E)),
                  (m.placement = v + (E ? "-" + E : "")),
                  (m.offsets.popper = ze(
                    {},
                    m.offsets.popper,
                    ot(m.instance.popper, m.offsets.reference, m.placement)
                  )),
                  (m = st(m.instance.modifiers, m, "flip")));
              }),
              m
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
              (e.placement = it(t)),
              (e.offsets.popper = Xe(o)),
              e
            );
          },
        },
        hide: {
          order: 800,
          enabled: !0,
          fn: function (e) {
            if (!gt(e.instance.modifiers, "hide", "preventOverflow")) return e;
            var t = e.offsets.reference,
              n = rt(e.instance.modifiers, function (e) {
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
              r = rt(e.instance.modifiers, function (e) {
                return "applyStyle" === e.name;
              }).gpuAcceleration;
            void 0 !== r &&
              console.warn(
                "WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!"
              );
            var s = void 0 !== r ? r : t.gpuAcceleration,
              a = Fe(e.instance.popper),
              l = Ge(a),
              c = { position: o.position },
              h = pt(e, window.devicePixelRatio < 2 || !mt),
              u = "bottom" === n ? "top" : "bottom",
              f = "right" === i ? "left" : "right",
              d = lt("transform"),
              p = void 0,
              m = void 0;
            if (
              ((m =
                "bottom" == u
                  ? "HTML" === a.nodeName
                    ? -a.clientHeight + h.bottom
                    : -l.height + h.bottom
                  : h.top),
              (p =
                "right" == f
                  ? "HTML" === a.nodeName
                    ? -a.clientWidth + h.right
                    : -l.width + h.right
                  : h.left),
              s && d)
            )
              (c[d] = "translate3d(" + p + "px, " + m + "px, 0)"),
                (c[u] = 0),
                (c[f] = 0),
                (c.willChange = "transform");
            else {
              var g = "bottom" == u ? -1 : 1,
                _ = "right" == f ? -1 : 1;
              (c[u] = m * g), (c[f] = p * _), (c.willChange = u + ", " + f);
            }
            var v = { "x-placement": e.placement };
            return (
              (e.attributes = ze({}, v, e.attributes)),
              (e.styles = ze({}, c, e.styles)),
              (e.arrowStyles = ze({}, e.offsets.arrow, e.arrowStyles)),
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
            return (
              dt(e.instance.popper, e.styles),
              (function (t, n) {
                Object.keys(n).forEach(function (e) {
                  !1 !== n[e] ? t.setAttribute(e, n[e]) : t.removeAttribute(e);
                });
              })(e.instance.popper, e.attributes),
              e.arrowElement &&
                Object.keys(e.arrowStyles).length &&
                dt(e.arrowElement, e.arrowStyles),
              e
            );
          },
          onLoad: function (e, t, n, i, o) {
            var r = tt(o, t, e, n.positionFixed),
              s = et(
                n.placement,
                r,
                t,
                e,
                n.modifiers.flip.boundariesElement,
                n.modifiers.flip.padding
              );
            return (
              t.setAttribute("x-placement", s),
              dt(t, { position: n.positionFixed ? "fixed" : "absolute" }),
              n
            );
          },
          gpuAcceleration: void 0,
        },
      },
    },
    St =
      (Qe(Dt, [
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
                (e.offsets.reference = tt(
                  this.state,
                  this.popper,
                  this.reference,
                  this.options.positionFixed
                )),
                  (e.placement = et(
                    this.options.placement,
                    e.offsets.reference,
                    this.popper,
                    this.reference,
                    this.options.modifiers.flip.boundariesElement,
                    this.options.modifiers.flip.padding
                  )),
                  (e.originalPlacement = e.placement),
                  (e.positionFixed = this.options.positionFixed),
                  (e.offsets.popper = ot(
                    this.popper,
                    e.offsets.reference,
                    e.placement
                  )),
                  (e.offsets.popper.position = this.options.positionFixed
                    ? "fixed"
                    : "absolute"),
                  (e = st(this.modifiers, e)),
                  this.state.isCreated
                    ? this.options.onUpdate(e)
                    : ((this.state.isCreated = !0), this.options.onCreate(e));
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
                at(this.modifiers, "applyStyle") &&
                  (this.popper.removeAttribute("x-placement"),
                  (this.popper.style.position = ""),
                  (this.popper.style.top = ""),
                  (this.popper.style.left = ""),
                  (this.popper.style.right = ""),
                  (this.popper.style.bottom = ""),
                  (this.popper.style.willChange = ""),
                  (this.popper.style[lt("transform")] = "")),
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
                (this.state = ht(
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
            return ut.call(this);
          },
        },
      ]),
      Dt);
  function Dt(e, t) {
    var n = this,
      i = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
    !(function (e, t) {
      if (!(e instanceof t))
        throw new TypeError("Cannot call a class as a function");
    })(this, Dt),
      (this.scheduleUpdate = function () {
        return requestAnimationFrame(n.update);
      }),
      (this.update = Oe(this.update.bind(this))),
      (this.options = ze({}, Dt.Defaults, i)),
      (this.state = { isDestroyed: !1, isCreated: !1, scrollParents: [] }),
      (this.reference = e && e.jquery ? e[0] : e),
      (this.popper = t && t.jquery ? t[0] : t),
      (this.options.modifiers = {}),
      Object.keys(ze({}, Dt.Defaults.modifiers, i.modifiers)).forEach(function (
        e
      ) {
        n.options.modifiers[e] = ze(
          {},
          Dt.Defaults.modifiers[e] || {},
          i.modifiers ? i.modifiers[e] : {}
        );
      }),
      (this.modifiers = Object.keys(this.options.modifiers)
        .map(function (e) {
          return ze({ name: e }, n.options.modifiers[e]);
        })
        .sort(function (e, t) {
          return e.order - t.order;
        })),
      this.modifiers.forEach(function (e) {
        e.enabled &&
          Ne(e.onLoad) &&
          e.onLoad(n.reference, n.popper, n.options, e, n.state);
      }),
      this.update();
    var o = this.options.eventsEnabled;
    o && this.enableEventListeners(), (this.state.eventsEnabled = o);
  }
  (St.Utils = ("undefined" != typeof window ? window : global).PopperUtils),
    (St.placements = _t),
    (St.Defaults = Ct);
  var It = "dropdown",
    At = "bs.dropdown",
    Ot = "." + At,
    Nt = ".data-api",
    kt = p.fn[It],
    Lt = new RegExp("38|40|27"),
    Pt = {
      HIDE: "hide" + Ot,
      HIDDEN: "hidden" + Ot,
      SHOW: "show" + Ot,
      SHOWN: "shown" + Ot,
      CLICK: "click" + Ot,
      CLICK_DATA_API: "click" + Ot + Nt,
      KEYDOWN_DATA_API: "keydown" + Ot + Nt,
      KEYUP_DATA_API: "keyup" + Ot + Nt,
    },
    xt = "disabled",
    jt = "show",
    Ht = "dropup",
    Rt = "dropright",
    Ft = "dropleft",
    Mt = "dropdown-menu-right",
    Wt = "position-static",
    Ut = '[data-toggle="dropdown"]',
    Bt = ".dropdown form",
    qt = ".dropdown-menu",
    Kt = ".navbar-nav",
    Qt = ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
    Vt = "top-start",
    Yt = "top-end",
    zt = "bottom-start",
    Xt = "bottom-end",
    Gt = "right-start",
    $t = "left-start",
    Jt = {
      offset: 0,
      flip: !0,
      boundary: "scrollParent",
      reference: "toggle",
      display: "dynamic",
      popperConfig: null,
    },
    Zt = {
      offset: "(number|string|function)",
      flip: "boolean",
      boundary: "(string|element)",
      reference: "(string|element)",
      display: "string",
      popperConfig: "(null|object)",
    },
    en = (function () {
      function c(e, t) {
        (this._element = e),
          (this._popper = null),
          (this._config = this._getConfig(t)),
          (this._menu = this._getMenuElement()),
          (this._inNavbar = this._detectNavbar()),
          this._addEventListeners();
      }
      var e = c.prototype;
      return (
        (e.toggle = function () {
          if (!this._element.disabled && !p(this._element).hasClass(xt)) {
            var e = p(this._menu).hasClass(jt);
            c._clearMenus(), e || this.show(!0);
          }
        }),
        (e.show = function (e) {
          if (
            (void 0 === e && (e = !1),
            !(
              this._element.disabled ||
              p(this._element).hasClass(xt) ||
              p(this._menu).hasClass(jt)
            ))
          ) {
            var t = { relatedTarget: this._element },
              n = p.Event(Pt.SHOW, t),
              i = c._getParentFromElement(this._element);
            if ((p(i).trigger(n), !n.isDefaultPrevented())) {
              if (!this._inNavbar && e) {
                if ("undefined" == typeof St)
                  throw new TypeError(
                    "Bootstrap's dropdowns require Popper.js (https://popper.js.org/)"
                  );
                var o = this._element;
                "parent" === this._config.reference
                  ? (o = i)
                  : m.isElement(this._config.reference) &&
                    ((o = this._config.reference),
                    "undefined" != typeof this._config.reference.jquery &&
                      (o = this._config.reference[0])),
                  "scrollParent" !== this._config.boundary && p(i).addClass(Wt),
                  (this._popper = new St(
                    o,
                    this._menu,
                    this._getPopperConfig()
                  ));
              }
              "ontouchstart" in document.documentElement &&
                0 === p(i).closest(Kt).length &&
                p(document.body).children().on("mouseover", null, p.noop),
                this._element.focus(),
                this._element.setAttribute("aria-expanded", !0),
                p(this._menu).toggleClass(jt),
                p(i).toggleClass(jt).trigger(p.Event(Pt.SHOWN, t));
            }
          }
        }),
        (e.hide = function () {
          if (
            !this._element.disabled &&
            !p(this._element).hasClass(xt) &&
            p(this._menu).hasClass(jt)
          ) {
            var e = { relatedTarget: this._element },
              t = p.Event(Pt.HIDE, e),
              n = c._getParentFromElement(this._element);
            p(n).trigger(t),
              t.isDefaultPrevented() ||
                (this._popper && this._popper.destroy(),
                p(this._menu).toggleClass(jt),
                p(n).toggleClass(jt).trigger(p.Event(Pt.HIDDEN, e)));
          }
        }),
        (e.dispose = function () {
          p.removeData(this._element, At),
            p(this._element).off(Ot),
            (this._element = null),
            (this._menu = null) !== this._popper &&
              (this._popper.destroy(), (this._popper = null));
        }),
        (e.update = function () {
          (this._inNavbar = this._detectNavbar()),
            null !== this._popper && this._popper.scheduleUpdate();
        }),
        (e._addEventListeners = function () {
          var t = this;
          p(this._element).on(Pt.CLICK, function (e) {
            e.preventDefault(), e.stopPropagation(), t.toggle();
          });
        }),
        (e._getConfig = function (e) {
          return (
            (e = l(
              {},
              this.constructor.Default,
              {},
              p(this._element).data(),
              {},
              e
            )),
            m.typeCheckConfig(It, e, this.constructor.DefaultType),
            e
          );
        }),
        (e._getMenuElement = function () {
          if (!this._menu) {
            var e = c._getParentFromElement(this._element);
            e && (this._menu = e.querySelector(qt));
          }
          return this._menu;
        }),
        (e._getPlacement = function () {
          var e = p(this._element.parentNode),
            t = zt;
          return (
            e.hasClass(Ht)
              ? ((t = Vt), p(this._menu).hasClass(Mt) && (t = Yt))
              : e.hasClass(Rt)
              ? (t = Gt)
              : e.hasClass(Ft)
              ? (t = $t)
              : p(this._menu).hasClass(Mt) && (t = Xt),
            t
          );
        }),
        (e._detectNavbar = function () {
          return 0 < p(this._element).closest(".navbar").length;
        }),
        (e._getOffset = function () {
          var t = this,
            e = {};
          return (
            "function" == typeof this._config.offset
              ? (e.fn = function (e) {
                  return (
                    (e.offsets = l(
                      {},
                      e.offsets,
                      {},
                      t._config.offset(e.offsets, t._element) || {}
                    )),
                    e
                  );
                })
              : (e.offset = this._config.offset),
            e
          );
        }),
        (e._getPopperConfig = function () {
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
            l({}, e, {}, this._config.popperConfig)
          );
        }),
        (c._jQueryInterface = function (t) {
          return this.each(function () {
            var e = p(this).data(At);
            if (
              (e ||
                ((e = new c(this, "object" == typeof t ? t : null)),
                p(this).data(At, e)),
              "string" == typeof t)
            ) {
              if ("undefined" == typeof e[t])
                throw new TypeError('No method named "' + t + '"');
              e[t]();
            }
          });
        }),
        (c._clearMenus = function (e) {
          if (!e || (3 !== e.which && ("keyup" !== e.type || 9 === e.which)))
            for (
              var t = [].slice.call(document.querySelectorAll(Ut)),
                n = 0,
                i = t.length;
              n < i;
              n++
            ) {
              var o = c._getParentFromElement(t[n]),
                r = p(t[n]).data(At),
                s = { relatedTarget: t[n] };
              if ((e && "click" === e.type && (s.clickEvent = e), r)) {
                var a = r._menu;
                if (
                  p(o).hasClass(jt) &&
                  !(
                    e &&
                    (("click" === e.type &&
                      /input|textarea/i.test(e.target.tagName)) ||
                      ("keyup" === e.type && 9 === e.which)) &&
                    p.contains(o, e.target)
                  )
                ) {
                  var l = p.Event(Pt.HIDE, s);
                  p(o).trigger(l),
                    l.isDefaultPrevented() ||
                      ("ontouchstart" in document.documentElement &&
                        p(document.body)
                          .children()
                          .off("mouseover", null, p.noop),
                      t[n].setAttribute("aria-expanded", "false"),
                      r._popper && r._popper.destroy(),
                      p(a).removeClass(jt),
                      p(o).removeClass(jt).trigger(p.Event(Pt.HIDDEN, s)));
                }
              }
            }
        }),
        (c._getParentFromElement = function (e) {
          var t,
            n = m.getSelectorFromElement(e);
          return n && (t = document.querySelector(n)), t || e.parentNode;
        }),
        (c._dataApiKeydownHandler = function (e) {
          if (
            (/input|textarea/i.test(e.target.tagName)
              ? !(
                  32 === e.which ||
                  (27 !== e.which &&
                    ((40 !== e.which && 38 !== e.which) ||
                      p(e.target).closest(qt).length))
                )
              : Lt.test(e.which)) &&
            (e.preventDefault(),
            e.stopPropagation(),
            !this.disabled && !p(this).hasClass(xt))
          ) {
            var t = c._getParentFromElement(this),
              n = p(t).hasClass(jt);
            if (n || 27 !== e.which)
              if (n && (!n || (27 !== e.which && 32 !== e.which))) {
                var i = [].slice
                  .call(t.querySelectorAll(Qt))
                  .filter(function (e) {
                    return p(e).is(":visible");
                  });
                if (0 !== i.length) {
                  var o = i.indexOf(e.target);
                  38 === e.which && 0 < o && o--,
                    40 === e.which && o < i.length - 1 && o++,
                    o < 0 && (o = 0),
                    i[o].focus();
                }
              } else {
                if (27 === e.which) {
                  var r = t.querySelector(Ut);
                  p(r).trigger("focus");
                }
                p(this).trigger("click");
              }
          }
        }),
        s(c, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
          {
            key: "Default",
            get: function () {
              return Jt;
            },
          },
          {
            key: "DefaultType",
            get: function () {
              return Zt;
            },
          },
        ]),
        c
      );
    })();
  p(document)
    .on(Pt.KEYDOWN_DATA_API, Ut, en._dataApiKeydownHandler)
    .on(Pt.KEYDOWN_DATA_API, qt, en._dataApiKeydownHandler)
    .on(Pt.CLICK_DATA_API + " " + Pt.KEYUP_DATA_API, en._clearMenus)
    .on(Pt.CLICK_DATA_API, Ut, function (e) {
      e.preventDefault(),
        e.stopPropagation(),
        en._jQueryInterface.call(p(this), "toggle");
    })
    .on(Pt.CLICK_DATA_API, Bt, function (e) {
      e.stopPropagation();
    }),
    (p.fn[It] = en._jQueryInterface),
    (p.fn[It].Constructor = en),
    (p.fn[It].noConflict = function () {
      return (p.fn[It] = kt), en._jQueryInterface;
    });
  var tn = "modal",
    nn = "bs.modal",
    on = "." + nn,
    rn = p.fn[tn],
    sn = { backdrop: !0, keyboard: !0, focus: !0, show: !0 },
    an = {
      backdrop: "(boolean|string)",
      keyboard: "boolean",
      focus: "boolean",
      show: "boolean",
    },
    ln = {
      HIDE: "hide" + on,
      HIDE_PREVENTED: "hidePrevented" + on,
      HIDDEN: "hidden" + on,
      SHOW: "show" + on,
      SHOWN: "shown" + on,
      FOCUSIN: "focusin" + on,
      RESIZE: "resize" + on,
      CLICK_DISMISS: "click.dismiss" + on,
      KEYDOWN_DISMISS: "keydown.dismiss" + on,
      MOUSEUP_DISMISS: "mouseup.dismiss" + on,
      MOUSEDOWN_DISMISS: "mousedown.dismiss" + on,
      CLICK_DATA_API: "click" + on + ".data-api",
    },
    cn = "modal-dialog-scrollable",
    hn = "modal-scrollbar-measure",
    un = "modal-backdrop",
    fn = "modal-open",
    dn = "fade",
    pn = "show",
    mn = "modal-static",
    gn = ".modal-dialog",
    _n = ".modal-body",
    vn = '[data-toggle="modal"]',
    yn = '[data-dismiss="modal"]',
    En = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
    bn = ".sticky-top",
    wn = (function () {
      function o(e, t) {
        (this._config = this._getConfig(t)),
          (this._element = e),
          (this._dialog = e.querySelector(gn)),
          (this._backdrop = null),
          (this._isShown = !1),
          (this._isBodyOverflowing = !1),
          (this._ignoreBackdropClick = !1),
          (this._isTransitioning = !1),
          (this._scrollbarWidth = 0);
      }
      var e = o.prototype;
      return (
        (e.toggle = function (e) {
          return this._isShown ? this.hide() : this.show(e);
        }),
        (e.show = function (e) {
          var t = this;
          if (!this._isShown && !this._isTransitioning) {
            p(this._element).hasClass(dn) && (this._isTransitioning = !0);
            var n = p.Event(ln.SHOW, { relatedTarget: e });
            p(this._element).trigger(n),
              this._isShown ||
                n.isDefaultPrevented() ||
                ((this._isShown = !0),
                this._checkScrollbar(),
                this._setScrollbar(),
                this._adjustDialog(),
                this._setEscapeEvent(),
                this._setResizeEvent(),
                p(this._element).on(ln.CLICK_DISMISS, yn, function (e) {
                  return t.hide(e);
                }),
                p(this._dialog).on(ln.MOUSEDOWN_DISMISS, function () {
                  p(t._element).one(ln.MOUSEUP_DISMISS, function (e) {
                    p(e.target).is(t._element) && (t._ignoreBackdropClick = !0);
                  });
                }),
                this._showBackdrop(function () {
                  return t._showElement(e);
                }));
          }
        }),
        (e.hide = function (e) {
          var t = this;
          if (
            (e && e.preventDefault(), this._isShown && !this._isTransitioning)
          ) {
            var n = p.Event(ln.HIDE);
            if (
              (p(this._element).trigger(n),
              this._isShown && !n.isDefaultPrevented())
            ) {
              this._isShown = !1;
              var i = p(this._element).hasClass(dn);
              if (
                (i && (this._isTransitioning = !0),
                this._setEscapeEvent(),
                this._setResizeEvent(),
                p(document).off(ln.FOCUSIN),
                p(this._element).removeClass(pn),
                p(this._element).off(ln.CLICK_DISMISS),
                p(this._dialog).off(ln.MOUSEDOWN_DISMISS),
                i)
              ) {
                var o = m.getTransitionDurationFromElement(this._element);
                p(this._element)
                  .one(m.TRANSITION_END, function (e) {
                    return t._hideModal(e);
                  })
                  .emulateTransitionEnd(o);
              } else this._hideModal();
            }
          }
        }),
        (e.dispose = function () {
          [window, this._element, this._dialog].forEach(function (e) {
            return p(e).off(on);
          }),
            p(document).off(ln.FOCUSIN),
            p.removeData(this._element, nn),
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
        (e.handleUpdate = function () {
          this._adjustDialog();
        }),
        (e._getConfig = function (e) {
          return (e = l({}, sn, {}, e)), m.typeCheckConfig(tn, e, an), e;
        }),
        (e._triggerBackdropTransition = function () {
          var e = this;
          if ("static" === this._config.backdrop) {
            var t = p.Event(ln.HIDE_PREVENTED);
            if ((p(this._element).trigger(t), t.defaultPrevented)) return;
            this._element.classList.add(mn);
            var n = m.getTransitionDurationFromElement(this._element);
            p(this._element)
              .one(m.TRANSITION_END, function () {
                e._element.classList.remove(mn);
              })
              .emulateTransitionEnd(n),
              this._element.focus();
          } else this.hide();
        }),
        (e._showElement = function (e) {
          var t = this,
            n = p(this._element).hasClass(dn),
            i = this._dialog ? this._dialog.querySelector(_n) : null;
          (this._element.parentNode &&
            this._element.parentNode.nodeType === Node.ELEMENT_NODE) ||
            document.body.appendChild(this._element),
            (this._element.style.display = "block"),
            this._element.removeAttribute("aria-hidden"),
            this._element.setAttribute("aria-modal", !0),
            p(this._dialog).hasClass(cn) && i
              ? (i.scrollTop = 0)
              : (this._element.scrollTop = 0),
            n && m.reflow(this._element),
            p(this._element).addClass(pn),
            this._config.focus && this._enforceFocus();
          function o() {
            t._config.focus && t._element.focus(),
              (t._isTransitioning = !1),
              p(t._element).trigger(r);
          }
          var r = p.Event(ln.SHOWN, { relatedTarget: e });
          if (n) {
            var s = m.getTransitionDurationFromElement(this._dialog);
            p(this._dialog).one(m.TRANSITION_END, o).emulateTransitionEnd(s);
          } else o();
        }),
        (e._enforceFocus = function () {
          var t = this;
          p(document)
            .off(ln.FOCUSIN)
            .on(ln.FOCUSIN, function (e) {
              document !== e.target &&
                t._element !== e.target &&
                0 === p(t._element).has(e.target).length &&
                t._element.focus();
            });
        }),
        (e._setEscapeEvent = function () {
          var t = this;
          this._isShown && this._config.keyboard
            ? p(this._element).on(ln.KEYDOWN_DISMISS, function (e) {
                27 === e.which && t._triggerBackdropTransition();
              })
            : this._isShown || p(this._element).off(ln.KEYDOWN_DISMISS);
        }),
        (e._setResizeEvent = function () {
          var t = this;
          this._isShown
            ? p(window).on(ln.RESIZE, function (e) {
                return t.handleUpdate(e);
              })
            : p(window).off(ln.RESIZE);
        }),
        (e._hideModal = function () {
          var e = this;
          (this._element.style.display = "none"),
            this._element.setAttribute("aria-hidden", !0),
            this._element.removeAttribute("aria-modal"),
            (this._isTransitioning = !1),
            this._showBackdrop(function () {
              p(document.body).removeClass(fn),
                e._resetAdjustments(),
                e._resetScrollbar(),
                p(e._element).trigger(ln.HIDDEN);
            });
        }),
        (e._removeBackdrop = function () {
          this._backdrop &&
            (p(this._backdrop).remove(), (this._backdrop = null));
        }),
        (e._showBackdrop = function (e) {
          var t = this,
            n = p(this._element).hasClass(dn) ? dn : "";
          if (this._isShown && this._config.backdrop) {
            if (
              ((this._backdrop = document.createElement("div")),
              (this._backdrop.className = un),
              n && this._backdrop.classList.add(n),
              p(this._backdrop).appendTo(document.body),
              p(this._element).on(ln.CLICK_DISMISS, function (e) {
                t._ignoreBackdropClick
                  ? (t._ignoreBackdropClick = !1)
                  : e.target === e.currentTarget &&
                    t._triggerBackdropTransition();
              }),
              n && m.reflow(this._backdrop),
              p(this._backdrop).addClass(pn),
              !e)
            )
              return;
            if (!n) return void e();
            var i = m.getTransitionDurationFromElement(this._backdrop);
            p(this._backdrop).one(m.TRANSITION_END, e).emulateTransitionEnd(i);
          } else if (!this._isShown && this._backdrop) {
            p(this._backdrop).removeClass(pn);
            var o = function () {
              t._removeBackdrop(), e && e();
            };
            if (p(this._element).hasClass(dn)) {
              var r = m.getTransitionDurationFromElement(this._backdrop);
              p(this._backdrop)
                .one(m.TRANSITION_END, o)
                .emulateTransitionEnd(r);
            } else o();
          } else e && e();
        }),
        (e._adjustDialog = function () {
          var e =
            this._element.scrollHeight > document.documentElement.clientHeight;
          !this._isBodyOverflowing &&
            e &&
            (this._element.style.paddingLeft = this._scrollbarWidth + "px"),
            this._isBodyOverflowing &&
              !e &&
              (this._element.style.paddingRight = this._scrollbarWidth + "px");
        }),
        (e._resetAdjustments = function () {
          (this._element.style.paddingLeft = ""),
            (this._element.style.paddingRight = "");
        }),
        (e._checkScrollbar = function () {
          var e = document.body.getBoundingClientRect();
          (this._isBodyOverflowing = e.left + e.right < window.innerWidth),
            (this._scrollbarWidth = this._getScrollbarWidth());
        }),
        (e._setScrollbar = function () {
          var o = this;
          if (this._isBodyOverflowing) {
            var e = [].slice.call(document.querySelectorAll(En)),
              t = [].slice.call(document.querySelectorAll(bn));
            p(e).each(function (e, t) {
              var n = t.style.paddingRight,
                i = p(t).css("padding-right");
              p(t)
                .data("padding-right", n)
                .css("padding-right", parseFloat(i) + o._scrollbarWidth + "px");
            }),
              p(t).each(function (e, t) {
                var n = t.style.marginRight,
                  i = p(t).css("margin-right");
                p(t)
                  .data("margin-right", n)
                  .css(
                    "margin-right",
                    parseFloat(i) - o._scrollbarWidth + "px"
                  );
              });
            var n = document.body.style.paddingRight,
              i = p(document.body).css("padding-right");
            p(document.body)
              .data("padding-right", n)
              .css(
                "padding-right",
                parseFloat(i) + this._scrollbarWidth + "px"
              );
          }
          p(document.body).addClass(fn);
        }),
        (e._resetScrollbar = function () {
          var e = [].slice.call(document.querySelectorAll(En));
          p(e).each(function (e, t) {
            var n = p(t).data("padding-right");
            p(t).removeData("padding-right"), (t.style.paddingRight = n || "");
          });
          var t = [].slice.call(document.querySelectorAll("" + bn));
          p(t).each(function (e, t) {
            var n = p(t).data("margin-right");
            "undefined" != typeof n &&
              p(t).css("margin-right", n).removeData("margin-right");
          });
          var n = p(document.body).data("padding-right");
          p(document.body).removeData("padding-right"),
            (document.body.style.paddingRight = n || "");
        }),
        (e._getScrollbarWidth = function () {
          var e = document.createElement("div");
          (e.className = hn), document.body.appendChild(e);
          var t = e.getBoundingClientRect().width - e.clientWidth;
          return document.body.removeChild(e), t;
        }),
        (o._jQueryInterface = function (n, i) {
          return this.each(function () {
            var e = p(this).data(nn),
              t = l(
                {},
                sn,
                {},
                p(this).data(),
                {},
                "object" == typeof n && n ? n : {}
              );
            if (
              (e || ((e = new o(this, t)), p(this).data(nn, e)),
              "string" == typeof n)
            ) {
              if ("undefined" == typeof e[n])
                throw new TypeError('No method named "' + n + '"');
              e[n](i);
            } else t.show && e.show(i);
          });
        }),
        s(o, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
          {
            key: "Default",
            get: function () {
              return sn;
            },
          },
        ]),
        o
      );
    })();
  p(document).on(ln.CLICK_DATA_API, vn, function (e) {
    var t,
      n = this,
      i = m.getSelectorFromElement(this);
    i && (t = document.querySelector(i));
    var o = p(t).data(nn) ? "toggle" : l({}, p(t).data(), {}, p(this).data());
    ("A" !== this.tagName && "AREA" !== this.tagName) || e.preventDefault();
    var r = p(t).one(ln.SHOW, function (e) {
      e.isDefaultPrevented() ||
        r.one(ln.HIDDEN, function () {
          p(n).is(":visible") && n.focus();
        });
    });
    wn._jQueryInterface.call(p(t), o, this);
  }),
    (p.fn[tn] = wn._jQueryInterface),
    (p.fn[tn].Constructor = wn),
    (p.fn[tn].noConflict = function () {
      return (p.fn[tn] = rn), wn._jQueryInterface;
    });
  var Tn = [
      "background",
      "cite",
      "href",
      "itemtype",
      "longdesc",
      "poster",
      "src",
      "xlink:href",
    ],
    Cn = {
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
    Sn = /^(?:(?:https?|mailto|ftp|tel|file):|[^&:/?#]*(?:[/?#]|$))/gi,
    Dn =
      /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+/]+=*$/i;
  function In(e, r, t) {
    if (0 === e.length) return e;
    if (t && "function" == typeof t) return t(e);
    for (
      var n = new window.DOMParser().parseFromString(e, "text/html"),
        s = Object.keys(r),
        a = [].slice.call(n.body.querySelectorAll("*")),
        i = function (e) {
          var t = a[e],
            n = t.nodeName.toLowerCase();
          if (-1 === s.indexOf(t.nodeName.toLowerCase()))
            return t.parentNode.removeChild(t), "continue";
          var i = [].slice.call(t.attributes),
            o = [].concat(r["*"] || [], r[n] || []);
          i.forEach(function (e) {
            !(function (e, t) {
              var n = e.nodeName.toLowerCase();
              if (-1 !== t.indexOf(n))
                return (
                  -1 === Tn.indexOf(n) ||
                  Boolean(e.nodeValue.match(Sn) || e.nodeValue.match(Dn))
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
            })(e, o) && t.removeAttribute(e.nodeName);
          });
        },
        o = 0,
        l = a.length;
      o < l;
      o++
    )
      i(o);
    return n.body.innerHTML;
  }
  var An = "tooltip",
    On = "bs.tooltip",
    Nn = "." + On,
    kn = p.fn[An],
    Ln = "bs-tooltip",
    Pn = new RegExp("(^|\\s)" + Ln + "\\S+", "g"),
    xn = ["sanitize", "whiteList", "sanitizeFn"],
    jn = {
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
      popperConfig: "(null|object)",
    },
    Hn = {
      AUTO: "auto",
      TOP: "top",
      RIGHT: "right",
      BOTTOM: "bottom",
      LEFT: "left",
    },
    Rn = {
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
      whiteList: Cn,
      popperConfig: null,
    },
    Fn = "show",
    Mn = "out",
    Wn = {
      HIDE: "hide" + Nn,
      HIDDEN: "hidden" + Nn,
      SHOW: "show" + Nn,
      SHOWN: "shown" + Nn,
      INSERTED: "inserted" + Nn,
      CLICK: "click" + Nn,
      FOCUSIN: "focusin" + Nn,
      FOCUSOUT: "focusout" + Nn,
      MOUSEENTER: "mouseenter" + Nn,
      MOUSELEAVE: "mouseleave" + Nn,
    },
    Un = "fade",
    Bn = "show",
    qn = ".tooltip-inner",
    Kn = ".arrow",
    Qn = "hover",
    Vn = "focus",
    Yn = "click",
    zn = "manual",
    Xn = (function () {
      function i(e, t) {
        if ("undefined" == typeof St)
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
      var e = i.prototype;
      return (
        (e.enable = function () {
          this._isEnabled = !0;
        }),
        (e.disable = function () {
          this._isEnabled = !1;
        }),
        (e.toggleEnabled = function () {
          this._isEnabled = !this._isEnabled;
        }),
        (e.toggle = function (e) {
          if (this._isEnabled)
            if (e) {
              var t = this.constructor.DATA_KEY,
                n = p(e.currentTarget).data(t);
              n ||
                ((n = new this.constructor(
                  e.currentTarget,
                  this._getDelegateConfig()
                )),
                p(e.currentTarget).data(t, n)),
                (n._activeTrigger.click = !n._activeTrigger.click),
                n._isWithActiveTrigger()
                  ? n._enter(null, n)
                  : n._leave(null, n);
            } else {
              if (p(this.getTipElement()).hasClass(Bn))
                return void this._leave(null, this);
              this._enter(null, this);
            }
        }),
        (e.dispose = function () {
          clearTimeout(this._timeout),
            p.removeData(this.element, this.constructor.DATA_KEY),
            p(this.element).off(this.constructor.EVENT_KEY),
            p(this.element)
              .closest(".modal")
              .off("hide.bs.modal", this._hideModalHandler),
            this.tip && p(this.tip).remove(),
            (this._isEnabled = null),
            (this._timeout = null),
            (this._hoverState = null),
            (this._activeTrigger = null),
            this._popper && this._popper.destroy(),
            (this._popper = null),
            (this.element = null),
            (this.config = null),
            (this.tip = null);
        }),
        (e.show = function () {
          var t = this;
          if ("none" === p(this.element).css("display"))
            throw new Error("Please use show on visible elements");
          var e = p.Event(this.constructor.Event.SHOW);
          if (this.isWithContent() && this._isEnabled) {
            p(this.element).trigger(e);
            var n = m.findShadowRoot(this.element),
              i = p.contains(
                null !== n ? n : this.element.ownerDocument.documentElement,
                this.element
              );
            if (e.isDefaultPrevented() || !i) return;
            var o = this.getTipElement(),
              r = m.getUID(this.constructor.NAME);
            o.setAttribute("id", r),
              this.element.setAttribute("aria-describedby", r),
              this.setContent(),
              this.config.animation && p(o).addClass(Un);
            var s =
                "function" == typeof this.config.placement
                  ? this.config.placement.call(this, o, this.element)
                  : this.config.placement,
              a = this._getAttachment(s);
            this.addAttachmentClass(a);
            var l = this._getContainer();
            p(o).data(this.constructor.DATA_KEY, this),
              p.contains(
                this.element.ownerDocument.documentElement,
                this.tip
              ) || p(o).appendTo(l),
              p(this.element).trigger(this.constructor.Event.INSERTED),
              (this._popper = new St(
                this.element,
                o,
                this._getPopperConfig(a)
              )),
              p(o).addClass(Bn),
              "ontouchstart" in document.documentElement &&
                p(document.body).children().on("mouseover", null, p.noop);
            var c = function () {
              t.config.animation && t._fixTransition();
              var e = t._hoverState;
              (t._hoverState = null),
                p(t.element).trigger(t.constructor.Event.SHOWN),
                e === Mn && t._leave(null, t);
            };
            if (p(this.tip).hasClass(Un)) {
              var h = m.getTransitionDurationFromElement(this.tip);
              p(this.tip).one(m.TRANSITION_END, c).emulateTransitionEnd(h);
            } else c();
          }
        }),
        (e.hide = function (e) {
          function t() {
            n._hoverState !== Fn && i.parentNode && i.parentNode.removeChild(i),
              n._cleanTipClass(),
              n.element.removeAttribute("aria-describedby"),
              p(n.element).trigger(n.constructor.Event.HIDDEN),
              null !== n._popper && n._popper.destroy(),
              e && e();
          }
          var n = this,
            i = this.getTipElement(),
            o = p.Event(this.constructor.Event.HIDE);
          if ((p(this.element).trigger(o), !o.isDefaultPrevented())) {
            if (
              (p(i).removeClass(Bn),
              "ontouchstart" in document.documentElement &&
                p(document.body).children().off("mouseover", null, p.noop),
              (this._activeTrigger[Yn] = !1),
              (this._activeTrigger[Vn] = !1),
              (this._activeTrigger[Qn] = !1),
              p(this.tip).hasClass(Un))
            ) {
              var r = m.getTransitionDurationFromElement(i);
              p(i).one(m.TRANSITION_END, t).emulateTransitionEnd(r);
            } else t();
            this._hoverState = "";
          }
        }),
        (e.update = function () {
          null !== this._popper && this._popper.scheduleUpdate();
        }),
        (e.isWithContent = function () {
          return Boolean(this.getTitle());
        }),
        (e.addAttachmentClass = function (e) {
          p(this.getTipElement()).addClass(Ln + "-" + e);
        }),
        (e.getTipElement = function () {
          return (this.tip = this.tip || p(this.config.template)[0]), this.tip;
        }),
        (e.setContent = function () {
          var e = this.getTipElement();
          this.setElementContent(p(e.querySelectorAll(qn)), this.getTitle()),
            p(e).removeClass(Un + " " + Bn);
        }),
        (e.setElementContent = function (e, t) {
          "object" != typeof t || (!t.nodeType && !t.jquery)
            ? this.config.html
              ? (this.config.sanitize &&
                  (t = In(t, this.config.whiteList, this.config.sanitizeFn)),
                e.html(t))
              : e.text(t)
            : this.config.html
            ? p(t).parent().is(e) || e.empty().append(t)
            : e.text(p(t).text());
        }),
        (e.getTitle = function () {
          var e = this.element.getAttribute("data-original-title");
          return (e =
            e ||
            ("function" == typeof this.config.title
              ? this.config.title.call(this.element)
              : this.config.title));
        }),
        (e._getPopperConfig = function (e) {
          var t = this;
          return l(
            {},
            {
              placement: e,
              modifiers: {
                offset: this._getOffset(),
                flip: { behavior: this.config.fallbackPlacement },
                arrow: { element: Kn },
                preventOverflow: { boundariesElement: this.config.boundary },
              },
              onCreate: function (e) {
                e.originalPlacement !== e.placement &&
                  t._handlePopperPlacementChange(e);
              },
              onUpdate: function (e) {
                return t._handlePopperPlacementChange(e);
              },
            },
            {},
            this.config.popperConfig
          );
        }),
        (e._getOffset = function () {
          var t = this,
            e = {};
          return (
            "function" == typeof this.config.offset
              ? (e.fn = function (e) {
                  return (
                    (e.offsets = l(
                      {},
                      e.offsets,
                      {},
                      t.config.offset(e.offsets, t.element) || {}
                    )),
                    e
                  );
                })
              : (e.offset = this.config.offset),
            e
          );
        }),
        (e._getContainer = function () {
          return !1 === this.config.container
            ? document.body
            : m.isElement(this.config.container)
            ? p(this.config.container)
            : p(document).find(this.config.container);
        }),
        (e._getAttachment = function (e) {
          return Hn[e.toUpperCase()];
        }),
        (e._setListeners = function () {
          var i = this;
          this.config.trigger.split(" ").forEach(function (e) {
            if ("click" === e)
              p(i.element).on(
                i.constructor.Event.CLICK,
                i.config.selector,
                function (e) {
                  return i.toggle(e);
                }
              );
            else if (e !== zn) {
              var t =
                  e === Qn
                    ? i.constructor.Event.MOUSEENTER
                    : i.constructor.Event.FOCUSIN,
                n =
                  e === Qn
                    ? i.constructor.Event.MOUSELEAVE
                    : i.constructor.Event.FOCUSOUT;
              p(i.element)
                .on(t, i.config.selector, function (e) {
                  return i._enter(e);
                })
                .on(n, i.config.selector, function (e) {
                  return i._leave(e);
                });
            }
          }),
            (this._hideModalHandler = function () {
              i.element && i.hide();
            }),
            p(this.element)
              .closest(".modal")
              .on("hide.bs.modal", this._hideModalHandler),
            this.config.selector
              ? (this.config = l({}, this.config, {
                  trigger: "manual",
                  selector: "",
                }))
              : this._fixTitle();
        }),
        (e._fixTitle = function () {
          var e = typeof this.element.getAttribute("data-original-title");
          (!this.element.getAttribute("title") && "string" == e) ||
            (this.element.setAttribute(
              "data-original-title",
              this.element.getAttribute("title") || ""
            ),
            this.element.setAttribute("title", ""));
        }),
        (e._enter = function (e, t) {
          var n = this.constructor.DATA_KEY;
          (t = t || p(e.currentTarget).data(n)) ||
            ((t = new this.constructor(
              e.currentTarget,
              this._getDelegateConfig()
            )),
            p(e.currentTarget).data(n, t)),
            e && (t._activeTrigger["focusin" === e.type ? Vn : Qn] = !0),
            p(t.getTipElement()).hasClass(Bn) || t._hoverState === Fn
              ? (t._hoverState = Fn)
              : (clearTimeout(t._timeout),
                (t._hoverState = Fn),
                t.config.delay && t.config.delay.show
                  ? (t._timeout = setTimeout(function () {
                      t._hoverState === Fn && t.show();
                    }, t.config.delay.show))
                  : t.show());
        }),
        (e._leave = function (e, t) {
          var n = this.constructor.DATA_KEY;
          (t = t || p(e.currentTarget).data(n)) ||
            ((t = new this.constructor(
              e.currentTarget,
              this._getDelegateConfig()
            )),
            p(e.currentTarget).data(n, t)),
            e && (t._activeTrigger["focusout" === e.type ? Vn : Qn] = !1),
            t._isWithActiveTrigger() ||
              (clearTimeout(t._timeout),
              (t._hoverState = Mn),
              t.config.delay && t.config.delay.hide
                ? (t._timeout = setTimeout(function () {
                    t._hoverState === Mn && t.hide();
                  }, t.config.delay.hide))
                : t.hide());
        }),
        (e._isWithActiveTrigger = function () {
          for (var e in this._activeTrigger)
            if (this._activeTrigger[e]) return !0;
          return !1;
        }),
        (e._getConfig = function (e) {
          var t = p(this.element).data();
          return (
            Object.keys(t).forEach(function (e) {
              -1 !== xn.indexOf(e) && delete t[e];
            }),
            "number" ==
              typeof (e = l(
                {},
                this.constructor.Default,
                {},
                t,
                {},
                "object" == typeof e && e ? e : {}
              )).delay && (e.delay = { show: e.delay, hide: e.delay }),
            "number" == typeof e.title && (e.title = e.title.toString()),
            "number" == typeof e.content && (e.content = e.content.toString()),
            m.typeCheckConfig(An, e, this.constructor.DefaultType),
            e.sanitize &&
              (e.template = In(e.template, e.whiteList, e.sanitizeFn)),
            e
          );
        }),
        (e._getDelegateConfig = function () {
          var e = {};
          if (this.config)
            for (var t in this.config)
              this.constructor.Default[t] !== this.config[t] &&
                (e[t] = this.config[t]);
          return e;
        }),
        (e._cleanTipClass = function () {
          var e = p(this.getTipElement()),
            t = e.attr("class").match(Pn);
          null !== t && t.length && e.removeClass(t.join(""));
        }),
        (e._handlePopperPlacementChange = function (e) {
          var t = e.instance;
          (this.tip = t.popper),
            this._cleanTipClass(),
            this.addAttachmentClass(this._getAttachment(e.placement));
        }),
        (e._fixTransition = function () {
          var e = this.getTipElement(),
            t = this.config.animation;
          null === e.getAttribute("x-placement") &&
            (p(e).removeClass(Un),
            (this.config.animation = !1),
            this.hide(),
            this.show(),
            (this.config.animation = t));
        }),
        (i._jQueryInterface = function (n) {
          return this.each(function () {
            var e = p(this).data(On),
              t = "object" == typeof n && n;
            if (
              (e || !/dispose|hide/.test(n)) &&
              (e || ((e = new i(this, t)), p(this).data(On, e)),
              "string" == typeof n)
            ) {
              if ("undefined" == typeof e[n])
                throw new TypeError('No method named "' + n + '"');
              e[n]();
            }
          });
        }),
        s(i, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
          {
            key: "Default",
            get: function () {
              return Rn;
            },
          },
          {
            key: "NAME",
            get: function () {
              return An;
            },
          },
          {
            key: "DATA_KEY",
            get: function () {
              return On;
            },
          },
          {
            key: "Event",
            get: function () {
              return Wn;
            },
          },
          {
            key: "EVENT_KEY",
            get: function () {
              return Nn;
            },
          },
          {
            key: "DefaultType",
            get: function () {
              return jn;
            },
          },
        ]),
        i
      );
    })();
  (p.fn[An] = Xn._jQueryInterface),
    (p.fn[An].Constructor = Xn),
    (p.fn[An].noConflict = function () {
      return (p.fn[An] = kn), Xn._jQueryInterface;
    });
  var Gn = "popover",
    $n = "bs.popover",
    Jn = "." + $n,
    Zn = p.fn[Gn],
    ei = "bs-popover",
    ti = new RegExp("(^|\\s)" + ei + "\\S+", "g"),
    ni = l({}, Xn.Default, {
      placement: "right",
      trigger: "click",
      content: "",
      template:
        '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
    }),
    ii = l({}, Xn.DefaultType, { content: "(string|element|function)" }),
    oi = "fade",
    ri = "show",
    si = ".popover-header",
    ai = ".popover-body",
    li = {
      HIDE: "hide" + Jn,
      HIDDEN: "hidden" + Jn,
      SHOW: "show" + Jn,
      SHOWN: "shown" + Jn,
      INSERTED: "inserted" + Jn,
      CLICK: "click" + Jn,
      FOCUSIN: "focusin" + Jn,
      FOCUSOUT: "focusout" + Jn,
      MOUSEENTER: "mouseenter" + Jn,
      MOUSELEAVE: "mouseleave" + Jn,
    },
    ci = (function (e) {
      function i() {
        return e.apply(this, arguments) || this;
      }
      !(function (e, t) {
        (e.prototype = Object.create(t.prototype)),
          ((e.prototype.constructor = e).__proto__ = t);
      })(i, e);
      var t = i.prototype;
      return (
        (t.isWithContent = function () {
          return this.getTitle() || this._getContent();
        }),
        (t.addAttachmentClass = function (e) {
          p(this.getTipElement()).addClass(ei + "-" + e);
        }),
        (t.getTipElement = function () {
          return (this.tip = this.tip || p(this.config.template)[0]), this.tip;
        }),
        (t.setContent = function () {
          var e = p(this.getTipElement());
          this.setElementContent(e.find(si), this.getTitle());
          var t = this._getContent();
          "function" == typeof t && (t = t.call(this.element)),
            this.setElementContent(e.find(ai), t),
            e.removeClass(oi + " " + ri);
        }),
        (t._getContent = function () {
          return (
            this.element.getAttribute("data-content") || this.config.content
          );
        }),
        (t._cleanTipClass = function () {
          var e = p(this.getTipElement()),
            t = e.attr("class").match(ti);
          null !== t && 0 < t.length && e.removeClass(t.join(""));
        }),
        (i._jQueryInterface = function (n) {
          return this.each(function () {
            var e = p(this).data($n),
              t = "object" == typeof n ? n : null;
            if (
              (e || !/dispose|hide/.test(n)) &&
              (e || ((e = new i(this, t)), p(this).data($n, e)),
              "string" == typeof n)
            ) {
              if ("undefined" == typeof e[n])
                throw new TypeError('No method named "' + n + '"');
              e[n]();
            }
          });
        }),
        s(i, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
          {
            key: "Default",
            get: function () {
              return ni;
            },
          },
          {
            key: "NAME",
            get: function () {
              return Gn;
            },
          },
          {
            key: "DATA_KEY",
            get: function () {
              return $n;
            },
          },
          {
            key: "Event",
            get: function () {
              return li;
            },
          },
          {
            key: "EVENT_KEY",
            get: function () {
              return Jn;
            },
          },
          {
            key: "DefaultType",
            get: function () {
              return ii;
            },
          },
        ]),
        i
      );
    })(Xn);
  (p.fn[Gn] = ci._jQueryInterface),
    (p.fn[Gn].Constructor = ci),
    (p.fn[Gn].noConflict = function () {
      return (p.fn[Gn] = Zn), ci._jQueryInterface;
    });
  var hi = "scrollspy",
    ui = "bs.scrollspy",
    fi = "." + ui,
    di = p.fn[hi],
    pi = { offset: 10, method: "auto", target: "" },
    mi = { offset: "number", method: "string", target: "(string|element)" },
    gi = {
      ACTIVATE: "activate" + fi,
      SCROLL: "scroll" + fi,
      LOAD_DATA_API: "load" + fi + ".data-api",
    },
    _i = "dropdown-item",
    vi = "active",
    yi = '[data-spy="scroll"]',
    Ei = ".nav, .list-group",
    bi = ".nav-link",
    wi = ".nav-item",
    Ti = ".list-group-item",
    Ci = ".dropdown",
    Si = ".dropdown-item",
    Di = ".dropdown-toggle",
    Ii = "offset",
    Ai = "position",
    Oi = (function () {
      function n(e, t) {
        var n = this;
        (this._element = e),
          (this._scrollElement = "BODY" === e.tagName ? window : e),
          (this._config = this._getConfig(t)),
          (this._selector =
            this._config.target +
            " " +
            bi +
            "," +
            this._config.target +
            " " +
            Ti +
            "," +
            this._config.target +
            " " +
            Si),
          (this._offsets = []),
          (this._targets = []),
          (this._activeTarget = null),
          (this._scrollHeight = 0),
          p(this._scrollElement).on(gi.SCROLL, function (e) {
            return n._process(e);
          }),
          this.refresh(),
          this._process();
      }
      var e = n.prototype;
      return (
        (e.refresh = function () {
          var t = this,
            e = this._scrollElement === this._scrollElement.window ? Ii : Ai,
            o = "auto" === this._config.method ? e : this._config.method,
            r = o === Ai ? this._getScrollTop() : 0;
          (this._offsets = []),
            (this._targets = []),
            (this._scrollHeight = this._getScrollHeight()),
            [].slice
              .call(document.querySelectorAll(this._selector))
              .map(function (e) {
                var t,
                  n = m.getSelectorFromElement(e);
                if ((n && (t = document.querySelector(n)), t)) {
                  var i = t.getBoundingClientRect();
                  if (i.width || i.height) return [p(t)[o]().top + r, n];
                }
                return null;
              })
              .filter(function (e) {
                return e;
              })
              .sort(function (e, t) {
                return e[0] - t[0];
              })
              .forEach(function (e) {
                t._offsets.push(e[0]), t._targets.push(e[1]);
              });
        }),
        (e.dispose = function () {
          p.removeData(this._element, ui),
            p(this._scrollElement).off(fi),
            (this._element = null),
            (this._scrollElement = null),
            (this._config = null),
            (this._selector = null),
            (this._offsets = null),
            (this._targets = null),
            (this._activeTarget = null),
            (this._scrollHeight = null);
        }),
        (e._getConfig = function (e) {
          if (
            "string" !=
            typeof (e = l({}, pi, {}, "object" == typeof e && e ? e : {}))
              .target
          ) {
            var t = p(e.target).attr("id");
            t || ((t = m.getUID(hi)), p(e.target).attr("id", t)),
              (e.target = "#" + t);
          }
          return m.typeCheckConfig(hi, e, mi), e;
        }),
        (e._getScrollTop = function () {
          return this._scrollElement === window
            ? this._scrollElement.pageYOffset
            : this._scrollElement.scrollTop;
        }),
        (e._getScrollHeight = function () {
          return (
            this._scrollElement.scrollHeight ||
            Math.max(
              document.body.scrollHeight,
              document.documentElement.scrollHeight
            )
          );
        }),
        (e._getOffsetHeight = function () {
          return this._scrollElement === window
            ? window.innerHeight
            : this._scrollElement.getBoundingClientRect().height;
        }),
        (e._process = function () {
          var e = this._getScrollTop() + this._config.offset,
            t = this._getScrollHeight(),
            n = this._config.offset + t - this._getOffsetHeight();
          if ((this._scrollHeight !== t && this.refresh(), n <= e)) {
            var i = this._targets[this._targets.length - 1];
            this._activeTarget !== i && this._activate(i);
          } else {
            if (
              this._activeTarget &&
              e < this._offsets[0] &&
              0 < this._offsets[0]
            )
              return (this._activeTarget = null), void this._clear();
            for (var o = this._offsets.length; o--; ) {
              this._activeTarget !== this._targets[o] &&
                e >= this._offsets[o] &&
                ("undefined" == typeof this._offsets[o + 1] ||
                  e < this._offsets[o + 1]) &&
                this._activate(this._targets[o]);
            }
          }
        }),
        (e._activate = function (t) {
          (this._activeTarget = t), this._clear();
          var e = this._selector.split(",").map(function (e) {
              return (
                e + '[data-target="' + t + '"],' + e + '[href="' + t + '"]'
              );
            }),
            n = p([].slice.call(document.querySelectorAll(e.join(","))));
          n.hasClass(_i)
            ? (n.closest(Ci).find(Di).addClass(vi), n.addClass(vi))
            : (n.addClass(vi),
              n
                .parents(Ei)
                .prev(bi + ", " + Ti)
                .addClass(vi),
              n.parents(Ei).prev(wi).children(bi).addClass(vi)),
            p(this._scrollElement).trigger(gi.ACTIVATE, { relatedTarget: t });
        }),
        (e._clear = function () {
          [].slice
            .call(document.querySelectorAll(this._selector))
            .filter(function (e) {
              return e.classList.contains(vi);
            })
            .forEach(function (e) {
              return e.classList.remove(vi);
            });
        }),
        (n._jQueryInterface = function (t) {
          return this.each(function () {
            var e = p(this).data(ui);
            if (
              (e ||
                ((e = new n(this, "object" == typeof t && t)),
                p(this).data(ui, e)),
              "string" == typeof t)
            ) {
              if ("undefined" == typeof e[t])
                throw new TypeError('No method named "' + t + '"');
              e[t]();
            }
          });
        }),
        s(n, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
          {
            key: "Default",
            get: function () {
              return pi;
            },
          },
        ]),
        n
      );
    })();
  p(window).on(gi.LOAD_DATA_API, function () {
    for (
      var e = [].slice.call(document.querySelectorAll(yi)), t = e.length;
      t--;

    ) {
      var n = p(e[t]);
      Oi._jQueryInterface.call(n, n.data());
    }
  }),
    (p.fn[hi] = Oi._jQueryInterface),
    (p.fn[hi].Constructor = Oi),
    (p.fn[hi].noConflict = function () {
      return (p.fn[hi] = di), Oi._jQueryInterface;
    });
  var Ni = "bs.tab",
    ki = "." + Ni,
    Li = p.fn.tab,
    Pi = {
      HIDE: "hide" + ki,
      HIDDEN: "hidden" + ki,
      SHOW: "show" + ki,
      SHOWN: "shown" + ki,
      CLICK_DATA_API: "click" + ki + ".data-api",
    },
    xi = "dropdown-menu",
    ji = "active",
    Hi = "disabled",
    Ri = "fade",
    Fi = "show",
    Mi = ".dropdown",
    Wi = ".nav, .list-group",
    Ui = ".active",
    Bi = "> li > .active",
    qi = '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
    Ki = ".dropdown-toggle",
    Qi = "> .dropdown-menu .active",
    Vi = (function () {
      function i(e) {
        this._element = e;
      }
      var e = i.prototype;
      return (
        (e.show = function () {
          var n = this;
          if (
            !(
              (this._element.parentNode &&
                this._element.parentNode.nodeType === Node.ELEMENT_NODE &&
                p(this._element).hasClass(ji)) ||
              p(this._element).hasClass(Hi)
            )
          ) {
            var e,
              i,
              t = p(this._element).closest(Wi)[0],
              o = m.getSelectorFromElement(this._element);
            if (t) {
              var r = "UL" === t.nodeName || "OL" === t.nodeName ? Bi : Ui;
              i = (i = p.makeArray(p(t).find(r)))[i.length - 1];
            }
            var s = p.Event(Pi.HIDE, { relatedTarget: this._element }),
              a = p.Event(Pi.SHOW, { relatedTarget: i });
            if (
              (i && p(i).trigger(s),
              p(this._element).trigger(a),
              !a.isDefaultPrevented() && !s.isDefaultPrevented())
            ) {
              o && (e = document.querySelector(o)),
                this._activate(this._element, t);
              var l = function () {
                var e = p.Event(Pi.HIDDEN, { relatedTarget: n._element }),
                  t = p.Event(Pi.SHOWN, { relatedTarget: i });
                p(i).trigger(e), p(n._element).trigger(t);
              };
              e ? this._activate(e, e.parentNode, l) : l();
            }
          }
        }),
        (e.dispose = function () {
          p.removeData(this._element, Ni), (this._element = null);
        }),
        (e._activate = function (e, t, n) {
          function i() {
            return o._transitionComplete(e, r, n);
          }
          var o = this,
            r = (
              !t || ("UL" !== t.nodeName && "OL" !== t.nodeName)
                ? p(t).children(Ui)
                : p(t).find(Bi)
            )[0],
            s = n && r && p(r).hasClass(Ri);
          if (r && s) {
            var a = m.getTransitionDurationFromElement(r);
            p(r)
              .removeClass(Fi)
              .one(m.TRANSITION_END, i)
              .emulateTransitionEnd(a);
          } else i();
        }),
        (e._transitionComplete = function (e, t, n) {
          if (t) {
            p(t).removeClass(ji);
            var i = p(t.parentNode).find(Qi)[0];
            i && p(i).removeClass(ji),
              "tab" === t.getAttribute("role") &&
                t.setAttribute("aria-selected", !1);
          }
          if (
            (p(e).addClass(ji),
            "tab" === e.getAttribute("role") &&
              e.setAttribute("aria-selected", !0),
            m.reflow(e),
            e.classList.contains(Ri) && e.classList.add(Fi),
            e.parentNode && p(e.parentNode).hasClass(xi))
          ) {
            var o = p(e).closest(Mi)[0];
            if (o) {
              var r = [].slice.call(o.querySelectorAll(Ki));
              p(r).addClass(ji);
            }
            e.setAttribute("aria-expanded", !0);
          }
          n && n();
        }),
        (i._jQueryInterface = function (n) {
          return this.each(function () {
            var e = p(this),
              t = e.data(Ni);
            if (
              (t || ((t = new i(this)), e.data(Ni, t)), "string" == typeof n)
            ) {
              if ("undefined" == typeof t[n])
                throw new TypeError('No method named "' + n + '"');
              t[n]();
            }
          });
        }),
        s(i, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
        ]),
        i
      );
    })();
  p(document).on(Pi.CLICK_DATA_API, qi, function (e) {
    e.preventDefault(), Vi._jQueryInterface.call(p(this), "show");
  }),
    (p.fn.tab = Vi._jQueryInterface),
    (p.fn.tab.Constructor = Vi),
    (p.fn.tab.noConflict = function () {
      return (p.fn.tab = Li), Vi._jQueryInterface;
    });
  var Yi = "toast",
    zi = "bs.toast",
    Xi = "." + zi,
    Gi = p.fn[Yi],
    $i = {
      CLICK_DISMISS: "click.dismiss" + Xi,
      HIDE: "hide" + Xi,
      HIDDEN: "hidden" + Xi,
      SHOW: "show" + Xi,
      SHOWN: "shown" + Xi,
    },
    Ji = "fade",
    Zi = "hide",
    eo = "show",
    to = "showing",
    no = { animation: "boolean", autohide: "boolean", delay: "number" },
    io = { animation: !0, autohide: !0, delay: 500 },
    oo = '[data-dismiss="toast"]',
    ro = (function () {
      function i(e, t) {
        (this._element = e),
          (this._config = this._getConfig(t)),
          (this._timeout = null),
          this._setListeners();
      }
      var e = i.prototype;
      return (
        (e.show = function () {
          var e = this,
            t = p.Event($i.SHOW);
          if ((p(this._element).trigger(t), !t.isDefaultPrevented())) {
            this._config.animation && this._element.classList.add(Ji);
            var n = function () {
              e._element.classList.remove(to),
                e._element.classList.add(eo),
                p(e._element).trigger($i.SHOWN),
                e._config.autohide &&
                  (e._timeout = setTimeout(function () {
                    e.hide();
                  }, e._config.delay));
            };
            if (
              (this._element.classList.remove(Zi),
              m.reflow(this._element),
              this._element.classList.add(to),
              this._config.animation)
            ) {
              var i = m.getTransitionDurationFromElement(this._element);
              p(this._element).one(m.TRANSITION_END, n).emulateTransitionEnd(i);
            } else n();
          }
        }),
        (e.hide = function () {
          if (this._element.classList.contains(eo)) {
            var e = p.Event($i.HIDE);
            p(this._element).trigger(e),
              e.isDefaultPrevented() || this._close();
          }
        }),
        (e.dispose = function () {
          clearTimeout(this._timeout),
            (this._timeout = null),
            this._element.classList.contains(eo) &&
              this._element.classList.remove(eo),
            p(this._element).off($i.CLICK_DISMISS),
            p.removeData(this._element, zi),
            (this._element = null),
            (this._config = null);
        }),
        (e._getConfig = function (e) {
          return (
            (e = l(
              {},
              io,
              {},
              p(this._element).data(),
              {},
              "object" == typeof e && e ? e : {}
            )),
            m.typeCheckConfig(Yi, e, this.constructor.DefaultType),
            e
          );
        }),
        (e._setListeners = function () {
          var e = this;
          p(this._element).on($i.CLICK_DISMISS, oo, function () {
            return e.hide();
          });
        }),
        (e._close = function () {
          function e() {
            t._element.classList.add(Zi), p(t._element).trigger($i.HIDDEN);
          }
          var t = this;
          if ((this._element.classList.remove(eo), this._config.animation)) {
            var n = m.getTransitionDurationFromElement(this._element);
            p(this._element).one(m.TRANSITION_END, e).emulateTransitionEnd(n);
          } else e();
        }),
        (i._jQueryInterface = function (n) {
          return this.each(function () {
            var e = p(this),
              t = e.data(zi);
            if (
              (t ||
                ((t = new i(this, "object" == typeof n && n)), e.data(zi, t)),
              "string" == typeof n)
            ) {
              if ("undefined" == typeof t[n])
                throw new TypeError('No method named "' + n + '"');
              t[n](this);
            }
          });
        }),
        s(i, null, [
          {
            key: "VERSION",
            get: function () {
              return "4.4.1";
            },
          },
          {
            key: "DefaultType",
            get: function () {
              return no;
            },
          },
          {
            key: "Default",
            get: function () {
              return io;
            },
          },
        ]),
        i
      );
    })();
  (p.fn[Yi] = ro._jQueryInterface),
    (p.fn[Yi].Constructor = ro),
    (p.fn[Yi].noConflict = function () {
      return (p.fn[Yi] = Gi), ro._jQueryInterface;
    }),
    (e.Alert = _),
    (e.Button = x),
    (e.Carousel = he),
    (e.Collapse = De),
    (e.Dropdown = en),
    (e.Modal = wn),
    (e.Popover = ci),
    (e.Scrollspy = Oi),
    (e.Tab = Vi),
    (e.Toast = ro),
    (e.Tooltip = Xn),
    (e.Util = m),
    Object.defineProperty(e, "__esModule", { value: !0 });
});

/*jquery easing*/
!(function (n) {
  "function" == typeof define && define.amd
    ? define(["jquery"], function (e) {
        return n(e);
      })
    : "object" == typeof module && "object" == typeof module.exports
    ? (exports = n(require("jquery")))
    : n(jQuery);
})(function (n) {
  function e(n) {
    var e = 7.5625,
      t = 2.75;
    return n < 1 / t
      ? e * n * n
      : n < 2 / t
      ? e * (n -= 1.5 / t) * n + 0.75
      : n < 2.5 / t
      ? e * (n -= 2.25 / t) * n + 0.9375
      : e * (n -= 2.625 / t) * n + 0.984375;
  }
  n.easing.jswing = n.easing.swing;
  var t = Math.pow,
    u = Math.sqrt,
    r = Math.sin,
    i = Math.cos,
    a = Math.PI,
    c = 1.70158,
    o = 1.525 * c,
    s = (2 * a) / 3,
    f = (2 * a) / 4.5;
  n.extend(n.easing, {
    def: "easeOutQuad",
    swing: function (e) {
      return n.easing[n.easing.def](e);
    },
    easeInQuad: function (n) {
      return n * n;
    },
    easeOutQuad: function (n) {
      return 1 - (1 - n) * (1 - n);
    },
    easeInOutQuad: function (n) {
      return n < 0.5 ? 2 * n * n : 1 - t(-2 * n + 2, 2) / 2;
    },
    easeInCubic: function (n) {
      return n * n * n;
    },
    easeOutCubic: function (n) {
      return 1 - t(1 - n, 3);
    },
    easeInOutCubic: function (n) {
      return n < 0.5 ? 4 * n * n * n : 1 - t(-2 * n + 2, 3) / 2;
    },
    easeInQuart: function (n) {
      return n * n * n * n;
    },
    easeOutQuart: function (n) {
      return 1 - t(1 - n, 4);
    },
    easeInOutQuart: function (n) {
      return n < 0.5 ? 8 * n * n * n * n : 1 - t(-2 * n + 2, 4) / 2;
    },
    easeInQuint: function (n) {
      return n * n * n * n * n;
    },
    easeOutQuint: function (n) {
      return 1 - t(1 - n, 5);
    },
    easeInOutQuint: function (n) {
      return n < 0.5 ? 16 * n * n * n * n * n : 1 - t(-2 * n + 2, 5) / 2;
    },
    easeInSine: function (n) {
      return 1 - i((n * a) / 2);
    },
    easeOutSine: function (n) {
      return r((n * a) / 2);
    },
    easeInOutSine: function (n) {
      return -(i(a * n) - 1) / 2;
    },
    easeInExpo: function (n) {
      return 0 === n ? 0 : t(2, 10 * n - 10);
    },
    easeOutExpo: function (n) {
      return 1 === n ? 1 : 1 - t(2, -10 * n);
    },
    easeInOutExpo: function (n) {
      return 0 === n
        ? 0
        : 1 === n
        ? 1
        : n < 0.5
        ? t(2, 20 * n - 10) / 2
        : (2 - t(2, -20 * n + 10)) / 2;
    },
    easeInCirc: function (n) {
      return 1 - u(1 - t(n, 2));
    },
    easeOutCirc: function (n) {
      return u(1 - t(n - 1, 2));
    },
    easeInOutCirc: function (n) {
      return n < 0.5
        ? (1 - u(1 - t(2 * n, 2))) / 2
        : (u(1 - t(-2 * n + 2, 2)) + 1) / 2;
    },
    easeInElastic: function (n) {
      return 0 === n
        ? 0
        : 1 === n
        ? 1
        : -t(2, 10 * n - 10) * r((10 * n - 10.75) * s);
    },
    easeOutElastic: function (n) {
      return 0 === n
        ? 0
        : 1 === n
        ? 1
        : t(2, -10 * n) * r((10 * n - 0.75) * s) + 1;
    },
    easeInOutElastic: function (n) {
      return 0 === n
        ? 0
        : 1 === n
        ? 1
        : n < 0.5
        ? -(t(2, 20 * n - 10) * r((20 * n - 11.125) * f)) / 2
        : (t(2, -20 * n + 10) * r((20 * n - 11.125) * f)) / 2 + 1;
    },
    easeInBack: function (n) {
      return (c + 1) * n * n * n - c * n * n;
    },
    easeOutBack: function (n) {
      return 1 + (c + 1) * t(n - 1, 3) + c * t(n - 1, 2);
    },
    easeInOutBack: function (n) {
      return n < 0.5
        ? (t(2 * n, 2) * (7.189819 * n - o)) / 2
        : (t(2 * n - 2, 2) * ((o + 1) * (2 * n - 2) + o) + 2) / 2;
    },
    easeInBounce: function (n) {
      return 1 - e(1 - n);
    },
    easeOutBounce: e,
    easeInOutBounce: function (n) {
      return n < 0.5 ? (1 - e(1 - 2 * n)) / 2 : (1 + e(2 * n - 1)) / 2;
    },
  });
});
/*
 * @license jQuery Breakpoints | MIT | Jerry Low | https://www.github.com/jerrylow/breakpoints
 */
!(function (e) {
  var t = function (t, n) {
    var r = this;
    (r.n = "breakpoints"),
      (r.settings = {}),
      (r.currentBp = null),
      (r.getBreakpoint = function () {
        var e,
          t = a(),
          n = r.settings.breakpoints;
        return (
          n.forEach(function (n) {
            t >= n.width && (e = n.name);
          }),
          e || (e = n[n.length - 1].name),
          e
        );
      }),
      (r.getBreakpointWidth = function (e) {
        var t;
        return (
          r.settings.breakpoints.forEach(function (n) {
            e == n.name && (t = n.width);
          }),
          t
        );
      }),
      (r.compareCheck = function (e, t, n) {
        var i = a(),
          o = r.settings.breakpoints,
          s = r.getBreakpointWidth(t),
          u = !1;
        switch (e) {
          case "lessThan":
            u = i < s;
            break;
          case "lessEqualTo":
            u = i <= s;
            break;
          case "greaterThan":
          case "greaterEqualTo":
            u = i > s;
            break;
          case "inside":
            var g = o.findIndex(function (e) {
              return e.name === t;
            });
            if (g === o.length - 1) u = i > s;
            else {
              var d = r.getBreakpointWidth(o[g + 1].name);
              u = i >= s && i < d;
            }
        }
        u && n();
      }),
      (r.destroy = function () {
        e(window).unbind(r.n);
      });
    var i = function () {
        var t = a(),
          n = r.settings.breakpoints,
          i = r.currentBp;
        n.forEach(function (n) {
          i === n.name
            ? n.inside ||
              (e(window).trigger("inside-" + n.name), (n.inside = !0))
            : (n.inside = !1),
            t < n.width &&
              (n.less ||
                (e(window).trigger("lessThan-" + n.name),
                (n.less = !0),
                (n.greater = !1),
                (n.greaterEqual = !1))),
            t >= n.width &&
              (n.greaterEqual ||
                (e(window).trigger("greaterEqualTo-" + n.name),
                (n.greaterEqual = !0),
                (n.less = !1)),
              t > n.width &&
                (n.greater ||
                  (e(window).trigger("greaterThan-" + n.name),
                  (n.greater = !0),
                  (n.less = !1))));
        });
      },
      a = function () {
        var t = e(window);
        return r.outerWidth ? t.outerWidth() : t.width();
      },
      o = e.extend({}, e.fn.breakpoints.defaults, n);
    (r.settings = {
      breakpoints: o.breakpoints,
      buffer: o.buffer,
      triggerOnInit: o.triggerOnInit,
      outerWidth: o.outerWidth,
    }),
      t.data(r.n, this),
      (r.currentBp = r.getBreakpoint());
    var s = null;
    e.isFunction(e(window).on) &&
      e(window).on("resize." + r.n, function (t) {
        s && clearTimeout(s),
          (s = setTimeout(function (t) {
            var n;
            (n = r.getBreakpoint()) !== r.currentBp &&
              (e(window).trigger({
                type: "breakpoint-change",
                from: r.currentBp,
                to: n,
              }),
              (r.currentBp = n)),
              i();
          }, r.settings.buffer));
      }),
      r.settings.triggerOnInit &&
        setTimeout(function () {
          e(window).trigger({
            type: "breakpoint-change",
            from: r.currentBp,
            to: r.currentBp,
            initialInit: !0,
          });
        }, r.settings.buffer),
      setTimeout(function () {
        i();
      }, 0);
  };
  (e.fn.breakpoints = function (e, n, r) {
    if (this.data("breakpoints")) {
      var i = this.data("breakpoints");
      return "getBreakpoint" === e
        ? i.getBreakpoint()
        : "getBreakpointWidth" === e
        ? i.getBreakpointWidth(n)
        : [
            "lessThan",
            "lessEqualTo",
            "greaterThan",
            "greaterEqualTo",
            "inside",
          ].indexOf(e) >= 0
        ? i.compareCheck(e, n, r)
        : void ("destroy" === e && i.destroy());
    }
    new t(this, e);
  }),
    (e.fn.breakpoints.defaults = {
      breakpoints: [
        { name: "xs", width: 0 },
        { name: "sm", width: 768 },
        { name: "md", width: 992 },
        { name: "lg", width: 1200 },
      ],
      buffer: 300,
      triggerOnInit: !1,
      outerWidth: !1,
    });
})(jQuery);

/*!
 * Isotope PACKAGED v3.0.6
 *
 * Licensed GPLv3 for open source use
 * or Isotope Commercial License for commercial use
 *
 * https://isotope.metafizzy.co
 * Copyright 2010-2018 Metafizzy
 */

!(function (t, e) {
  "function" == typeof define && define.amd
    ? define("jquery-bridget/jquery-bridget", ["jquery"], function (i) {
        return e(t, i);
      })
    : "object" == typeof module && module.exports
    ? (module.exports = e(t, require("jquery")))
    : (t.jQueryBridget = e(t, t.jQuery));
})(window, function (t, e) {
  "use strict";
  function i(i, s, a) {
    function u(t, e, o) {
      var n,
        s = "$()." + i + '("' + e + '")';
      return (
        t.each(function (t, u) {
          var h = a.data(u, i);
          if (!h)
            return void r(
              i + " not initialized. Cannot call methods, i.e. " + s
            );
          var d = h[e];
          if (!d || "_" == e.charAt(0))
            return void r(s + " is not a valid method");
          var l = d.apply(h, o);
          n = void 0 === n ? l : n;
        }),
        void 0 !== n ? n : t
      );
    }
    function h(t, e) {
      t.each(function (t, o) {
        var n = a.data(o, i);
        n ? (n.option(e), n._init()) : ((n = new s(o, e)), a.data(o, i, n));
      });
    }
    (a = a || e || t.jQuery),
      a &&
        (s.prototype.option ||
          (s.prototype.option = function (t) {
            a.isPlainObject(t) &&
              (this.options = a.extend(!0, this.options, t));
          }),
        (a.fn[i] = function (t) {
          if ("string" == typeof t) {
            var e = n.call(arguments, 1);
            return u(this, t, e);
          }
          return h(this, t), this;
        }),
        o(a));
  }
  function o(t) {
    !t || (t && t.bridget) || (t.bridget = i);
  }
  var n = Array.prototype.slice,
    s = t.console,
    r =
      "undefined" == typeof s
        ? function () {}
        : function (t) {
            s.error(t);
          };
  return o(e || t.jQuery), i;
}),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define("ev-emitter/ev-emitter", e)
      : "object" == typeof module && module.exports
      ? (module.exports = e())
      : (t.EvEmitter = e());
  })("undefined" != typeof window ? window : this, function () {
    function t() {}
    var e = t.prototype;
    return (
      (e.on = function (t, e) {
        if (t && e) {
          var i = (this._events = this._events || {}),
            o = (i[t] = i[t] || []);
          return o.indexOf(e) == -1 && o.push(e), this;
        }
      }),
      (e.once = function (t, e) {
        if (t && e) {
          this.on(t, e);
          var i = (this._onceEvents = this._onceEvents || {}),
            o = (i[t] = i[t] || {});
          return (o[e] = !0), this;
        }
      }),
      (e.off = function (t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
          var o = i.indexOf(e);
          return o != -1 && i.splice(o, 1), this;
        }
      }),
      (e.emitEvent = function (t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
          (i = i.slice(0)), (e = e || []);
          for (
            var o = this._onceEvents && this._onceEvents[t], n = 0;
            n < i.length;
            n++
          ) {
            var s = i[n],
              r = o && o[s];
            r && (this.off(t, s), delete o[s]), s.apply(this, e);
          }
          return this;
        }
      }),
      (e.allOff = function () {
        delete this._events, delete this._onceEvents;
      }),
      t
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define("get-size/get-size", e)
      : "object" == typeof module && module.exports
      ? (module.exports = e())
      : (t.getSize = e());
  })(window, function () {
    "use strict";
    function t(t) {
      var e = parseFloat(t),
        i = t.indexOf("%") == -1 && !isNaN(e);
      return i && e;
    }
    function e() {}
    function i() {
      for (
        var t = {
            width: 0,
            height: 0,
            innerWidth: 0,
            innerHeight: 0,
            outerWidth: 0,
            outerHeight: 0,
          },
          e = 0;
        e < h;
        e++
      ) {
        var i = u[e];
        t[i] = 0;
      }
      return t;
    }
    function o(t) {
      var e = getComputedStyle(t);
      return (
        e ||
          a(
            "Style returned " +
              e +
              ". Are you running this code in a hidden iframe on Firefox? See https://bit.ly/getsizebug1"
          ),
        e
      );
    }
    function n() {
      if (!d) {
        d = !0;
        var e = document.createElement("div");
        (e.style.width = "200px"),
          (e.style.padding = "1px 2px 3px 4px"),
          (e.style.borderStyle = "solid"),
          (e.style.borderWidth = "1px 2px 3px 4px"),
          (e.style.boxSizing = "border-box");
        var i = document.body || document.documentElement;
        i.appendChild(e);
        var n = o(e);
        (r = 200 == Math.round(t(n.width))),
          (s.isBoxSizeOuter = r),
          i.removeChild(e);
      }
    }
    function s(e) {
      if (
        (n(),
        "string" == typeof e && (e = document.querySelector(e)),
        e && "object" == typeof e && e.nodeType)
      ) {
        var s = o(e);
        if ("none" == s.display) return i();
        var a = {};
        (a.width = e.offsetWidth), (a.height = e.offsetHeight);
        for (
          var d = (a.isBorderBox = "border-box" == s.boxSizing), l = 0;
          l < h;
          l++
        ) {
          var f = u[l],
            c = s[f],
            m = parseFloat(c);
          a[f] = isNaN(m) ? 0 : m;
        }
        var p = a.paddingLeft + a.paddingRight,
          y = a.paddingTop + a.paddingBottom,
          g = a.marginLeft + a.marginRight,
          v = a.marginTop + a.marginBottom,
          _ = a.borderLeftWidth + a.borderRightWidth,
          z = a.borderTopWidth + a.borderBottomWidth,
          I = d && r,
          x = t(s.width);
        x !== !1 && (a.width = x + (I ? 0 : p + _));
        var S = t(s.height);
        return (
          S !== !1 && (a.height = S + (I ? 0 : y + z)),
          (a.innerWidth = a.width - (p + _)),
          (a.innerHeight = a.height - (y + z)),
          (a.outerWidth = a.width + g),
          (a.outerHeight = a.height + v),
          a
        );
      }
    }
    var r,
      a =
        "undefined" == typeof console
          ? e
          : function (t) {
              console.error(t);
            },
      u = [
        "paddingLeft",
        "paddingRight",
        "paddingTop",
        "paddingBottom",
        "marginLeft",
        "marginRight",
        "marginTop",
        "marginBottom",
        "borderLeftWidth",
        "borderRightWidth",
        "borderTopWidth",
        "borderBottomWidth",
      ],
      h = u.length,
      d = !1;
    return s;
  }),
  (function (t, e) {
    "use strict";
    "function" == typeof define && define.amd
      ? define("desandro-matches-selector/matches-selector", e)
      : "object" == typeof module && module.exports
      ? (module.exports = e())
      : (t.matchesSelector = e());
  })(window, function () {
    "use strict";
    var t = (function () {
      var t = window.Element.prototype;
      if (t.matches) return "matches";
      if (t.matchesSelector) return "matchesSelector";
      for (var e = ["webkit", "moz", "ms", "o"], i = 0; i < e.length; i++) {
        var o = e[i],
          n = o + "MatchesSelector";
        if (t[n]) return n;
      }
    })();
    return function (e, i) {
      return e[t](i);
    };
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define(
          "fizzy-ui-utils/utils",
          ["desandro-matches-selector/matches-selector"],
          function (i) {
            return e(t, i);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = e(t, require("desandro-matches-selector")))
      : (t.fizzyUIUtils = e(t, t.matchesSelector));
  })(window, function (t, e) {
    var i = {};
    (i.extend = function (t, e) {
      for (var i in e) t[i] = e[i];
      return t;
    }),
      (i.modulo = function (t, e) {
        return ((t % e) + e) % e;
      });
    var o = Array.prototype.slice;
    (i.makeArray = function (t) {
      if (Array.isArray(t)) return t;
      if (null === t || void 0 === t) return [];
      var e = "object" == typeof t && "number" == typeof t.length;
      return e ? o.call(t) : [t];
    }),
      (i.removeFrom = function (t, e) {
        var i = t.indexOf(e);
        i != -1 && t.splice(i, 1);
      }),
      (i.getParent = function (t, i) {
        for (; t.parentNode && t != document.body; )
          if (((t = t.parentNode), e(t, i))) return t;
      }),
      (i.getQueryElement = function (t) {
        return "string" == typeof t ? document.querySelector(t) : t;
      }),
      (i.handleEvent = function (t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
      }),
      (i.filterFindElements = function (t, o) {
        t = i.makeArray(t);
        var n = [];
        return (
          t.forEach(function (t) {
            if (t instanceof HTMLElement) {
              if (!o) return void n.push(t);
              e(t, o) && n.push(t);
              for (var i = t.querySelectorAll(o), s = 0; s < i.length; s++)
                n.push(i[s]);
            }
          }),
          n
        );
      }),
      (i.debounceMethod = function (t, e, i) {
        i = i || 100;
        var o = t.prototype[e],
          n = e + "Timeout";
        t.prototype[e] = function () {
          var t = this[n];
          clearTimeout(t);
          var e = arguments,
            s = this;
          this[n] = setTimeout(function () {
            o.apply(s, e), delete s[n];
          }, i);
        };
      }),
      (i.docReady = function (t) {
        var e = document.readyState;
        "complete" == e || "interactive" == e
          ? setTimeout(t)
          : document.addEventListener("DOMContentLoaded", t);
      }),
      (i.toDashed = function (t) {
        return t
          .replace(/(.)([A-Z])/g, function (t, e, i) {
            return e + "-" + i;
          })
          .toLowerCase();
      });
    var n = t.console;
    return (
      (i.htmlInit = function (e, o) {
        i.docReady(function () {
          var s = i.toDashed(o),
            r = "data-" + s,
            a = document.querySelectorAll("[" + r + "]"),
            u = document.querySelectorAll(".js-" + s),
            h = i.makeArray(a).concat(i.makeArray(u)),
            d = r + "-options",
            l = t.jQuery;
          h.forEach(function (t) {
            var i,
              s = t.getAttribute(r) || t.getAttribute(d);
            try {
              i = s && JSON.parse(s);
            } catch (a) {
              return void (
                n &&
                n.error("Error parsing " + r + " on " + t.className + ": " + a)
              );
            }
            var u = new e(t, i);
            l && l.data(t, o, u);
          });
        });
      }),
      i
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define(
          "outlayer/item",
          ["ev-emitter/ev-emitter", "get-size/get-size"],
          e
        )
      : "object" == typeof module && module.exports
      ? (module.exports = e(require("ev-emitter"), require("get-size")))
      : ((t.Outlayer = {}), (t.Outlayer.Item = e(t.EvEmitter, t.getSize)));
  })(window, function (t, e) {
    "use strict";
    function i(t) {
      for (var e in t) return !1;
      return (e = null), !0;
    }
    function o(t, e) {
      t &&
        ((this.element = t),
        (this.layout = e),
        (this.position = { x: 0, y: 0 }),
        this._create());
    }
    function n(t) {
      return t.replace(/([A-Z])/g, function (t) {
        return "-" + t.toLowerCase();
      });
    }
    var s = document.documentElement.style,
      r = "string" == typeof s.transition ? "transition" : "WebkitTransition",
      a = "string" == typeof s.transform ? "transform" : "WebkitTransform",
      u = {
        WebkitTransition: "webkitTransitionEnd",
        transition: "transitionend",
      }[r],
      h = {
        transform: a,
        transition: r,
        transitionDuration: r + "Duration",
        transitionProperty: r + "Property",
        transitionDelay: r + "Delay",
      },
      d = (o.prototype = Object.create(t.prototype));
    (d.constructor = o),
      (d._create = function () {
        (this._transn = { ingProperties: {}, clean: {}, onEnd: {} }),
          this.css({ position: "absolute" });
      }),
      (d.handleEvent = function (t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
      }),
      (d.getSize = function () {
        this.size = e(this.element);
      }),
      (d.css = function (t) {
        var e = this.element.style;
        for (var i in t) {
          var o = h[i] || i;
          e[o] = t[i];
        }
      }),
      (d.getPosition = function () {
        var t = getComputedStyle(this.element),
          e = this.layout._getOption("originLeft"),
          i = this.layout._getOption("originTop"),
          o = t[e ? "left" : "right"],
          n = t[i ? "top" : "bottom"],
          s = parseFloat(o),
          r = parseFloat(n),
          a = this.layout.size;
        o.indexOf("%") != -1 && (s = (s / 100) * a.width),
          n.indexOf("%") != -1 && (r = (r / 100) * a.height),
          (s = isNaN(s) ? 0 : s),
          (r = isNaN(r) ? 0 : r),
          (s -= e ? a.paddingLeft : a.paddingRight),
          (r -= i ? a.paddingTop : a.paddingBottom),
          (this.position.x = s),
          (this.position.y = r);
      }),
      (d.layoutPosition = function () {
        var t = this.layout.size,
          e = {},
          i = this.layout._getOption("originLeft"),
          o = this.layout._getOption("originTop"),
          n = i ? "paddingLeft" : "paddingRight",
          s = i ? "left" : "right",
          r = i ? "right" : "left",
          a = this.position.x + t[n];
        (e[s] = this.getXValue(a)), (e[r] = "");
        var u = o ? "paddingTop" : "paddingBottom",
          h = o ? "top" : "bottom",
          d = o ? "bottom" : "top",
          l = this.position.y + t[u];
        (e[h] = this.getYValue(l)),
          (e[d] = ""),
          this.css(e),
          this.emitEvent("layout", [this]);
      }),
      (d.getXValue = function (t) {
        var e = this.layout._getOption("horizontal");
        return this.layout.options.percentPosition && !e
          ? (t / this.layout.size.width) * 100 + "%"
          : t + "px";
      }),
      (d.getYValue = function (t) {
        var e = this.layout._getOption("horizontal");
        return this.layout.options.percentPosition && e
          ? (t / this.layout.size.height) * 100 + "%"
          : t + "px";
      }),
      (d._transitionTo = function (t, e) {
        this.getPosition();
        var i = this.position.x,
          o = this.position.y,
          n = t == this.position.x && e == this.position.y;
        if ((this.setPosition(t, e), n && !this.isTransitioning))
          return void this.layoutPosition();
        var s = t - i,
          r = e - o,
          a = {};
        (a.transform = this.getTranslate(s, r)),
          this.transition({
            to: a,
            onTransitionEnd: { transform: this.layoutPosition },
            isCleaning: !0,
          });
      }),
      (d.getTranslate = function (t, e) {
        var i = this.layout._getOption("originLeft"),
          o = this.layout._getOption("originTop");
        return (
          (t = i ? t : -t),
          (e = o ? e : -e),
          "translate3d(" + t + "px, " + e + "px, 0)"
        );
      }),
      (d.goTo = function (t, e) {
        this.setPosition(t, e), this.layoutPosition();
      }),
      (d.moveTo = d._transitionTo),
      (d.setPosition = function (t, e) {
        (this.position.x = parseFloat(t)), (this.position.y = parseFloat(e));
      }),
      (d._nonTransition = function (t) {
        this.css(t.to), t.isCleaning && this._removeStyles(t.to);
        for (var e in t.onTransitionEnd) t.onTransitionEnd[e].call(this);
      }),
      (d.transition = function (t) {
        if (!parseFloat(this.layout.options.transitionDuration))
          return void this._nonTransition(t);
        var e = this._transn;
        for (var i in t.onTransitionEnd) e.onEnd[i] = t.onTransitionEnd[i];
        for (i in t.to)
          (e.ingProperties[i] = !0), t.isCleaning && (e.clean[i] = !0);
        if (t.from) {
          this.css(t.from);
          var o = this.element.offsetHeight;
          o = null;
        }
        this.enableTransition(t.to),
          this.css(t.to),
          (this.isTransitioning = !0);
      });
    var l = "opacity," + n(a);
    (d.enableTransition = function () {
      if (!this.isTransitioning) {
        var t = this.layout.options.transitionDuration;
        (t = "number" == typeof t ? t + "ms" : t),
          this.css({
            transitionProperty: l,
            transitionDuration: t,
            transitionDelay: this.staggerDelay || 0,
          }),
          this.element.addEventListener(u, this, !1);
      }
    }),
      (d.onwebkitTransitionEnd = function (t) {
        this.ontransitionend(t);
      }),
      (d.onotransitionend = function (t) {
        this.ontransitionend(t);
      });
    var f = { "-webkit-transform": "transform" };
    (d.ontransitionend = function (t) {
      if (t.target === this.element) {
        var e = this._transn,
          o = f[t.propertyName] || t.propertyName;
        if (
          (delete e.ingProperties[o],
          i(e.ingProperties) && this.disableTransition(),
          o in e.clean &&
            ((this.element.style[t.propertyName] = ""), delete e.clean[o]),
          o in e.onEnd)
        ) {
          var n = e.onEnd[o];
          n.call(this), delete e.onEnd[o];
        }
        this.emitEvent("transitionEnd", [this]);
      }
    }),
      (d.disableTransition = function () {
        this.removeTransitionStyles(),
          this.element.removeEventListener(u, this, !1),
          (this.isTransitioning = !1);
      }),
      (d._removeStyles = function (t) {
        var e = {};
        for (var i in t) e[i] = "";
        this.css(e);
      });
    var c = {
      transitionProperty: "",
      transitionDuration: "",
      transitionDelay: "",
    };
    return (
      (d.removeTransitionStyles = function () {
        this.css(c);
      }),
      (d.stagger = function (t) {
        (t = isNaN(t) ? 0 : t), (this.staggerDelay = t + "ms");
      }),
      (d.removeElem = function () {
        this.element.parentNode.removeChild(this.element),
          this.css({ display: "" }),
          this.emitEvent("remove", [this]);
      }),
      (d.remove = function () {
        return r && parseFloat(this.layout.options.transitionDuration)
          ? (this.once("transitionEnd", function () {
              this.removeElem();
            }),
            void this.hide())
          : void this.removeElem();
      }),
      (d.reveal = function () {
        delete this.isHidden, this.css({ display: "" });
        var t = this.layout.options,
          e = {},
          i = this.getHideRevealTransitionEndProperty("visibleStyle");
        (e[i] = this.onRevealTransitionEnd),
          this.transition({
            from: t.hiddenStyle,
            to: t.visibleStyle,
            isCleaning: !0,
            onTransitionEnd: e,
          });
      }),
      (d.onRevealTransitionEnd = function () {
        this.isHidden || this.emitEvent("reveal");
      }),
      (d.getHideRevealTransitionEndProperty = function (t) {
        var e = this.layout.options[t];
        if (e.opacity) return "opacity";
        for (var i in e) return i;
      }),
      (d.hide = function () {
        (this.isHidden = !0), this.css({ display: "" });
        var t = this.layout.options,
          e = {},
          i = this.getHideRevealTransitionEndProperty("hiddenStyle");
        (e[i] = this.onHideTransitionEnd),
          this.transition({
            from: t.visibleStyle,
            to: t.hiddenStyle,
            isCleaning: !0,
            onTransitionEnd: e,
          });
      }),
      (d.onHideTransitionEnd = function () {
        this.isHidden &&
          (this.css({ display: "none" }), this.emitEvent("hide"));
      }),
      (d.destroy = function () {
        this.css({
          position: "",
          left: "",
          right: "",
          top: "",
          bottom: "",
          transition: "",
          transform: "",
        });
      }),
      o
    );
  }),
  (function (t, e) {
    "use strict";
    "function" == typeof define && define.amd
      ? define(
          "outlayer/outlayer",
          [
            "ev-emitter/ev-emitter",
            "get-size/get-size",
            "fizzy-ui-utils/utils",
            "./item",
          ],
          function (i, o, n, s) {
            return e(t, i, o, n, s);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = e(
          t,
          require("ev-emitter"),
          require("get-size"),
          require("fizzy-ui-utils"),
          require("./item")
        ))
      : (t.Outlayer = e(
          t,
          t.EvEmitter,
          t.getSize,
          t.fizzyUIUtils,
          t.Outlayer.Item
        ));
  })(window, function (t, e, i, o, n) {
    "use strict";
    function s(t, e) {
      var i = o.getQueryElement(t);
      if (!i)
        return void (
          u &&
          u.error(
            "Bad element for " + this.constructor.namespace + ": " + (i || t)
          )
        );
      (this.element = i),
        h && (this.$element = h(this.element)),
        (this.options = o.extend({}, this.constructor.defaults)),
        this.option(e);
      var n = ++l;
      (this.element.outlayerGUID = n), (f[n] = this), this._create();
      var s = this._getOption("initLayout");
      s && this.layout();
    }
    function r(t) {
      function e() {
        t.apply(this, arguments);
      }
      return (
        (e.prototype = Object.create(t.prototype)),
        (e.prototype.constructor = e),
        e
      );
    }
    function a(t) {
      if ("number" == typeof t) return t;
      var e = t.match(/(^\d*\.?\d*)(\w*)/),
        i = e && e[1],
        o = e && e[2];
      if (!i.length) return 0;
      i = parseFloat(i);
      var n = m[o] || 1;
      return i * n;
    }
    var u = t.console,
      h = t.jQuery,
      d = function () {},
      l = 0,
      f = {};
    (s.namespace = "outlayer"),
      (s.Item = n),
      (s.defaults = {
        containerStyle: { position: "relative" },
        initLayout: !0,
        originLeft: !0,
        originTop: !0,
        resize: !0,
        resizeContainer: !0,
        transitionDuration: "0.4s",
        hiddenStyle: { opacity: 0, transform: "scale(0.001)" },
        visibleStyle: { opacity: 1, transform: "scale(1)" },
      });
    var c = s.prototype;
    o.extend(c, e.prototype),
      (c.option = function (t) {
        o.extend(this.options, t);
      }),
      (c._getOption = function (t) {
        var e = this.constructor.compatOptions[t];
        return e && void 0 !== this.options[e]
          ? this.options[e]
          : this.options[t];
      }),
      (s.compatOptions = {
        initLayout: "isInitLayout",
        horizontal: "isHorizontal",
        layoutInstant: "isLayoutInstant",
        originLeft: "isOriginLeft",
        originTop: "isOriginTop",
        resize: "isResizeBound",
        resizeContainer: "isResizingContainer",
      }),
      (c._create = function () {
        this.reloadItems(),
          (this.stamps = []),
          this.stamp(this.options.stamp),
          o.extend(this.element.style, this.options.containerStyle);
        var t = this._getOption("resize");
        t && this.bindResize();
      }),
      (c.reloadItems = function () {
        this.items = this._itemize(this.element.children);
      }),
      (c._itemize = function (t) {
        for (
          var e = this._filterFindItemElements(t),
            i = this.constructor.Item,
            o = [],
            n = 0;
          n < e.length;
          n++
        ) {
          var s = e[n],
            r = new i(s, this);
          o.push(r);
        }
        return o;
      }),
      (c._filterFindItemElements = function (t) {
        return o.filterFindElements(t, this.options.itemSelector);
      }),
      (c.getItemElements = function () {
        return this.items.map(function (t) {
          return t.element;
        });
      }),
      (c.layout = function () {
        this._resetLayout(), this._manageStamps();
        var t = this._getOption("layoutInstant"),
          e = void 0 !== t ? t : !this._isLayoutInited;
        this.layoutItems(this.items, e), (this._isLayoutInited = !0);
      }),
      (c._init = c.layout),
      (c._resetLayout = function () {
        this.getSize();
      }),
      (c.getSize = function () {
        this.size = i(this.element);
      }),
      (c._getMeasurement = function (t, e) {
        var o,
          n = this.options[t];
        n
          ? ("string" == typeof n
              ? (o = this.element.querySelector(n))
              : n instanceof HTMLElement && (o = n),
            (this[t] = o ? i(o)[e] : n))
          : (this[t] = 0);
      }),
      (c.layoutItems = function (t, e) {
        (t = this._getItemsForLayout(t)),
          this._layoutItems(t, e),
          this._postLayout();
      }),
      (c._getItemsForLayout = function (t) {
        return t.filter(function (t) {
          return !t.isIgnored;
        });
      }),
      (c._layoutItems = function (t, e) {
        if ((this._emitCompleteOnItems("layout", t), t && t.length)) {
          var i = [];
          t.forEach(function (t) {
            var o = this._getItemLayoutPosition(t);
            (o.item = t), (o.isInstant = e || t.isLayoutInstant), i.push(o);
          }, this),
            this._processLayoutQueue(i);
        }
      }),
      (c._getItemLayoutPosition = function () {
        return { x: 0, y: 0 };
      }),
      (c._processLayoutQueue = function (t) {
        this.updateStagger(),
          t.forEach(function (t, e) {
            this._positionItem(t.item, t.x, t.y, t.isInstant, e);
          }, this);
      }),
      (c.updateStagger = function () {
        var t = this.options.stagger;
        return null === t || void 0 === t
          ? void (this.stagger = 0)
          : ((this.stagger = a(t)), this.stagger);
      }),
      (c._positionItem = function (t, e, i, o, n) {
        o ? t.goTo(e, i) : (t.stagger(n * this.stagger), t.moveTo(e, i));
      }),
      (c._postLayout = function () {
        this.resizeContainer();
      }),
      (c.resizeContainer = function () {
        var t = this._getOption("resizeContainer");
        if (t) {
          var e = this._getContainerSize();
          e &&
            (this._setContainerMeasure(e.width, !0),
            this._setContainerMeasure(e.height, !1));
        }
      }),
      (c._getContainerSize = d),
      (c._setContainerMeasure = function (t, e) {
        if (void 0 !== t) {
          var i = this.size;
          i.isBorderBox &&
            (t += e
              ? i.paddingLeft +
                i.paddingRight +
                i.borderLeftWidth +
                i.borderRightWidth
              : i.paddingBottom +
                i.paddingTop +
                i.borderTopWidth +
                i.borderBottomWidth),
            (t = Math.max(t, 0)),
            (this.element.style[e ? "width" : "height"] = t + "px");
        }
      }),
      (c._emitCompleteOnItems = function (t, e) {
        function i() {
          n.dispatchEvent(t + "Complete", null, [e]);
        }
        function o() {
          r++, r == s && i();
        }
        var n = this,
          s = e.length;
        if (!e || !s) return void i();
        var r = 0;
        e.forEach(function (e) {
          e.once(t, o);
        });
      }),
      (c.dispatchEvent = function (t, e, i) {
        var o = e ? [e].concat(i) : i;
        if ((this.emitEvent(t, o), h))
          if (((this.$element = this.$element || h(this.element)), e)) {
            var n = h.Event(e);
            (n.type = t), this.$element.trigger(n, i);
          } else this.$element.trigger(t, i);
      }),
      (c.ignore = function (t) {
        var e = this.getItem(t);
        e && (e.isIgnored = !0);
      }),
      (c.unignore = function (t) {
        var e = this.getItem(t);
        e && delete e.isIgnored;
      }),
      (c.stamp = function (t) {
        (t = this._find(t)),
          t &&
            ((this.stamps = this.stamps.concat(t)),
            t.forEach(this.ignore, this));
      }),
      (c.unstamp = function (t) {
        (t = this._find(t)),
          t &&
            t.forEach(function (t) {
              o.removeFrom(this.stamps, t), this.unignore(t);
            }, this);
      }),
      (c._find = function (t) {
        if (t)
          return (
            "string" == typeof t && (t = this.element.querySelectorAll(t)),
            (t = o.makeArray(t))
          );
      }),
      (c._manageStamps = function () {
        this.stamps &&
          this.stamps.length &&
          (this._getBoundingRect(),
          this.stamps.forEach(this._manageStamp, this));
      }),
      (c._getBoundingRect = function () {
        var t = this.element.getBoundingClientRect(),
          e = this.size;
        this._boundingRect = {
          left: t.left + e.paddingLeft + e.borderLeftWidth,
          top: t.top + e.paddingTop + e.borderTopWidth,
          right: t.right - (e.paddingRight + e.borderRightWidth),
          bottom: t.bottom - (e.paddingBottom + e.borderBottomWidth),
        };
      }),
      (c._manageStamp = d),
      (c._getElementOffset = function (t) {
        var e = t.getBoundingClientRect(),
          o = this._boundingRect,
          n = i(t),
          s = {
            left: e.left - o.left - n.marginLeft,
            top: e.top - o.top - n.marginTop,
            right: o.right - e.right - n.marginRight,
            bottom: o.bottom - e.bottom - n.marginBottom,
          };
        return s;
      }),
      (c.handleEvent = o.handleEvent),
      (c.bindResize = function () {
        t.addEventListener("resize", this), (this.isResizeBound = !0);
      }),
      (c.unbindResize = function () {
        t.removeEventListener("resize", this), (this.isResizeBound = !1);
      }),
      (c.onresize = function () {
        this.resize();
      }),
      o.debounceMethod(s, "onresize", 100),
      (c.resize = function () {
        this.isResizeBound && this.needsResizeLayout() && this.layout();
      }),
      (c.needsResizeLayout = function () {
        var t = i(this.element),
          e = this.size && t;
        return e && t.innerWidth !== this.size.innerWidth;
      }),
      (c.addItems = function (t) {
        var e = this._itemize(t);
        return e.length && (this.items = this.items.concat(e)), e;
      }),
      (c.appended = function (t) {
        var e = this.addItems(t);
        e.length && (this.layoutItems(e, !0), this.reveal(e));
      }),
      (c.prepended = function (t) {
        var e = this._itemize(t);
        if (e.length) {
          var i = this.items.slice(0);
          (this.items = e.concat(i)),
            this._resetLayout(),
            this._manageStamps(),
            this.layoutItems(e, !0),
            this.reveal(e),
            this.layoutItems(i);
        }
      }),
      (c.reveal = function (t) {
        if ((this._emitCompleteOnItems("reveal", t), t && t.length)) {
          var e = this.updateStagger();
          t.forEach(function (t, i) {
            t.stagger(i * e), t.reveal();
          });
        }
      }),
      (c.hide = function (t) {
        if ((this._emitCompleteOnItems("hide", t), t && t.length)) {
          var e = this.updateStagger();
          t.forEach(function (t, i) {
            t.stagger(i * e), t.hide();
          });
        }
      }),
      (c.revealItemElements = function (t) {
        var e = this.getItems(t);
        this.reveal(e);
      }),
      (c.hideItemElements = function (t) {
        var e = this.getItems(t);
        this.hide(e);
      }),
      (c.getItem = function (t) {
        for (var e = 0; e < this.items.length; e++) {
          var i = this.items[e];
          if (i.element == t) return i;
        }
      }),
      (c.getItems = function (t) {
        t = o.makeArray(t);
        var e = [];
        return (
          t.forEach(function (t) {
            var i = this.getItem(t);
            i && e.push(i);
          }, this),
          e
        );
      }),
      (c.remove = function (t) {
        var e = this.getItems(t);
        this._emitCompleteOnItems("remove", e),
          e &&
            e.length &&
            e.forEach(function (t) {
              t.remove(), o.removeFrom(this.items, t);
            }, this);
      }),
      (c.destroy = function () {
        var t = this.element.style;
        (t.height = ""),
          (t.position = ""),
          (t.width = ""),
          this.items.forEach(function (t) {
            t.destroy();
          }),
          this.unbindResize();
        var e = this.element.outlayerGUID;
        delete f[e],
          delete this.element.outlayerGUID,
          h && h.removeData(this.element, this.constructor.namespace);
      }),
      (s.data = function (t) {
        t = o.getQueryElement(t);
        var e = t && t.outlayerGUID;
        return e && f[e];
      }),
      (s.create = function (t, e) {
        var i = r(s);
        return (
          (i.defaults = o.extend({}, s.defaults)),
          o.extend(i.defaults, e),
          (i.compatOptions = o.extend({}, s.compatOptions)),
          (i.namespace = t),
          (i.data = s.data),
          (i.Item = r(n)),
          o.htmlInit(i, t),
          h && h.bridget && h.bridget(t, i),
          i
        );
      });
    var m = { ms: 1, s: 1e3 };
    return (s.Item = n), s;
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define("isotope-layout/js/item", ["outlayer/outlayer"], e)
      : "object" == typeof module && module.exports
      ? (module.exports = e(require("outlayer")))
      : ((t.Isotope = t.Isotope || {}), (t.Isotope.Item = e(t.Outlayer)));
  })(window, function (t) {
    "use strict";
    function e() {
      t.Item.apply(this, arguments);
    }
    var i = (e.prototype = Object.create(t.Item.prototype)),
      o = i._create;
    (i._create = function () {
      (this.id = this.layout.itemGUID++), o.call(this), (this.sortData = {});
    }),
      (i.updateSortData = function () {
        if (!this.isIgnored) {
          (this.sortData.id = this.id),
            (this.sortData["original-order"] = this.id),
            (this.sortData.random = Math.random());
          var t = this.layout.options.getSortData,
            e = this.layout._sorters;
          for (var i in t) {
            var o = e[i];
            this.sortData[i] = o(this.element, this);
          }
        }
      });
    var n = i.destroy;
    return (
      (i.destroy = function () {
        n.apply(this, arguments), this.css({ display: "" });
      }),
      e
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define(
          "isotope-layout/js/layout-mode",
          ["get-size/get-size", "outlayer/outlayer"],
          e
        )
      : "object" == typeof module && module.exports
      ? (module.exports = e(require("get-size"), require("outlayer")))
      : ((t.Isotope = t.Isotope || {}),
        (t.Isotope.LayoutMode = e(t.getSize, t.Outlayer)));
  })(window, function (t, e) {
    "use strict";
    function i(t) {
      (this.isotope = t),
        t &&
          ((this.options = t.options[this.namespace]),
          (this.element = t.element),
          (this.items = t.filteredItems),
          (this.size = t.size));
    }
    var o = i.prototype,
      n = [
        "_resetLayout",
        "_getItemLayoutPosition",
        "_manageStamp",
        "_getContainerSize",
        "_getElementOffset",
        "needsResizeLayout",
        "_getOption",
      ];
    return (
      n.forEach(function (t) {
        o[t] = function () {
          return e.prototype[t].apply(this.isotope, arguments);
        };
      }),
      (o.needsVerticalResizeLayout = function () {
        var e = t(this.isotope.element),
          i = this.isotope.size && e;
        return i && e.innerHeight != this.isotope.size.innerHeight;
      }),
      (o._getMeasurement = function () {
        this.isotope._getMeasurement.apply(this, arguments);
      }),
      (o.getColumnWidth = function () {
        this.getSegmentSize("column", "Width");
      }),
      (o.getRowHeight = function () {
        this.getSegmentSize("row", "Height");
      }),
      (o.getSegmentSize = function (t, e) {
        var i = t + e,
          o = "outer" + e;
        if ((this._getMeasurement(i, o), !this[i])) {
          var n = this.getFirstItemSize();
          this[i] = (n && n[o]) || this.isotope.size["inner" + e];
        }
      }),
      (o.getFirstItemSize = function () {
        var e = this.isotope.filteredItems[0];
        return e && e.element && t(e.element);
      }),
      (o.layout = function () {
        this.isotope.layout.apply(this.isotope, arguments);
      }),
      (o.getSize = function () {
        this.isotope.getSize(), (this.size = this.isotope.size);
      }),
      (i.modes = {}),
      (i.create = function (t, e) {
        function n() {
          i.apply(this, arguments);
        }
        return (
          (n.prototype = Object.create(o)),
          (n.prototype.constructor = n),
          e && (n.options = e),
          (n.prototype.namespace = t),
          (i.modes[t] = n),
          n
        );
      }),
      i
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define(
          "masonry-layout/masonry",
          ["outlayer/outlayer", "get-size/get-size"],
          e
        )
      : "object" == typeof module && module.exports
      ? (module.exports = e(require("outlayer"), require("get-size")))
      : (t.Masonry = e(t.Outlayer, t.getSize));
  })(window, function (t, e) {
    var i = t.create("masonry");
    i.compatOptions.fitWidth = "isFitWidth";
    var o = i.prototype;
    return (
      (o._resetLayout = function () {
        this.getSize(),
          this._getMeasurement("columnWidth", "outerWidth"),
          this._getMeasurement("gutter", "outerWidth"),
          this.measureColumns(),
          (this.colYs = []);
        for (var t = 0; t < this.cols; t++) this.colYs.push(0);
        (this.maxY = 0), (this.horizontalColIndex = 0);
      }),
      (o.measureColumns = function () {
        if ((this.getContainerWidth(), !this.columnWidth)) {
          var t = this.items[0],
            i = t && t.element;
          this.columnWidth = (i && e(i).outerWidth) || this.containerWidth;
        }
        var o = (this.columnWidth += this.gutter),
          n = this.containerWidth + this.gutter,
          s = n / o,
          r = o - (n % o),
          a = r && r < 1 ? "round" : "floor";
        (s = Math[a](s)), (this.cols = Math.max(s, 1));
      }),
      (o.getContainerWidth = function () {
        var t = this._getOption("fitWidth"),
          i = t ? this.element.parentNode : this.element,
          o = e(i);
        this.containerWidth = o && o.innerWidth;
      }),
      (o._getItemLayoutPosition = function (t) {
        t.getSize();
        var e = t.size.outerWidth % this.columnWidth,
          i = e && e < 1 ? "round" : "ceil",
          o = Math[i](t.size.outerWidth / this.columnWidth);
        o = Math.min(o, this.cols);
        for (
          var n = this.options.horizontalOrder
              ? "_getHorizontalColPosition"
              : "_getTopColPosition",
            s = this[n](o, t),
            r = { x: this.columnWidth * s.col, y: s.y },
            a = s.y + t.size.outerHeight,
            u = o + s.col,
            h = s.col;
          h < u;
          h++
        )
          this.colYs[h] = a;
        return r;
      }),
      (o._getTopColPosition = function (t) {
        var e = this._getTopColGroup(t),
          i = Math.min.apply(Math, e);
        return { col: e.indexOf(i), y: i };
      }),
      (o._getTopColGroup = function (t) {
        if (t < 2) return this.colYs;
        for (var e = [], i = this.cols + 1 - t, o = 0; o < i; o++)
          e[o] = this._getColGroupY(o, t);
        return e;
      }),
      (o._getColGroupY = function (t, e) {
        if (e < 2) return this.colYs[t];
        var i = this.colYs.slice(t, t + e);
        return Math.max.apply(Math, i);
      }),
      (o._getHorizontalColPosition = function (t, e) {
        var i = this.horizontalColIndex % this.cols,
          o = t > 1 && i + t > this.cols;
        i = o ? 0 : i;
        var n = e.size.outerWidth && e.size.outerHeight;
        return (
          (this.horizontalColIndex = n ? i + t : this.horizontalColIndex),
          { col: i, y: this._getColGroupY(i, t) }
        );
      }),
      (o._manageStamp = function (t) {
        var i = e(t),
          o = this._getElementOffset(t),
          n = this._getOption("originLeft"),
          s = n ? o.left : o.right,
          r = s + i.outerWidth,
          a = Math.floor(s / this.columnWidth);
        a = Math.max(0, a);
        var u = Math.floor(r / this.columnWidth);
        (u -= r % this.columnWidth ? 0 : 1), (u = Math.min(this.cols - 1, u));
        for (
          var h = this._getOption("originTop"),
            d = (h ? o.top : o.bottom) + i.outerHeight,
            l = a;
          l <= u;
          l++
        )
          this.colYs[l] = Math.max(d, this.colYs[l]);
      }),
      (o._getContainerSize = function () {
        this.maxY = Math.max.apply(Math, this.colYs);
        var t = { height: this.maxY };
        return (
          this._getOption("fitWidth") &&
            (t.width = this._getContainerFitWidth()),
          t
        );
      }),
      (o._getContainerFitWidth = function () {
        for (var t = 0, e = this.cols; --e && 0 === this.colYs[e]; ) t++;
        return (this.cols - t) * this.columnWidth - this.gutter;
      }),
      (o.needsResizeLayout = function () {
        var t = this.containerWidth;
        return this.getContainerWidth(), t != this.containerWidth;
      }),
      i
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define(
          "isotope-layout/js/layout-modes/masonry",
          ["../layout-mode", "masonry-layout/masonry"],
          e
        )
      : "object" == typeof module && module.exports
      ? (module.exports = e(
          require("../layout-mode"),
          require("masonry-layout")
        ))
      : e(t.Isotope.LayoutMode, t.Masonry);
  })(window, function (t, e) {
    "use strict";
    var i = t.create("masonry"),
      o = i.prototype,
      n = { _getElementOffset: !0, layout: !0, _getMeasurement: !0 };
    for (var s in e.prototype) n[s] || (o[s] = e.prototype[s]);
    var r = o.measureColumns;
    o.measureColumns = function () {
      (this.items = this.isotope.filteredItems), r.call(this);
    };
    var a = o._getOption;
    return (
      (o._getOption = function (t) {
        return "fitWidth" == t
          ? void 0 !== this.options.isFitWidth
            ? this.options.isFitWidth
            : this.options.fitWidth
          : a.apply(this.isotope, arguments);
      }),
      i
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define("isotope-layout/js/layout-modes/fit-rows", ["../layout-mode"], e)
      : "object" == typeof exports
      ? (module.exports = e(require("../layout-mode")))
      : e(t.Isotope.LayoutMode);
  })(window, function (t) {
    "use strict";
    var e = t.create("fitRows"),
      i = e.prototype;
    return (
      (i._resetLayout = function () {
        (this.x = 0),
          (this.y = 0),
          (this.maxY = 0),
          this._getMeasurement("gutter", "outerWidth");
      }),
      (i._getItemLayoutPosition = function (t) {
        t.getSize();
        var e = t.size.outerWidth + this.gutter,
          i = this.isotope.size.innerWidth + this.gutter;
        0 !== this.x && e + this.x > i && ((this.x = 0), (this.y = this.maxY));
        var o = { x: this.x, y: this.y };
        return (
          (this.maxY = Math.max(this.maxY, this.y + t.size.outerHeight)),
          (this.x += e),
          o
        );
      }),
      (i._getContainerSize = function () {
        return { height: this.maxY };
      }),
      e
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define("isotope-layout/js/layout-modes/vertical", ["../layout-mode"], e)
      : "object" == typeof module && module.exports
      ? (module.exports = e(require("../layout-mode")))
      : e(t.Isotope.LayoutMode);
  })(window, function (t) {
    "use strict";
    var e = t.create("vertical", { horizontalAlignment: 0 }),
      i = e.prototype;
    return (
      (i._resetLayout = function () {
        this.y = 0;
      }),
      (i._getItemLayoutPosition = function (t) {
        t.getSize();
        var e =
            (this.isotope.size.innerWidth - t.size.outerWidth) *
            this.options.horizontalAlignment,
          i = this.y;
        return (this.y += t.size.outerHeight), { x: e, y: i };
      }),
      (i._getContainerSize = function () {
        return { height: this.y };
      }),
      e
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define(
          [
            "outlayer/outlayer",
            "get-size/get-size",
            "desandro-matches-selector/matches-selector",
            "fizzy-ui-utils/utils",
            "isotope-layout/js/item",
            "isotope-layout/js/layout-mode",
            "isotope-layout/js/layout-modes/masonry",
            "isotope-layout/js/layout-modes/fit-rows",
            "isotope-layout/js/layout-modes/vertical",
          ],
          function (i, o, n, s, r, a) {
            return e(t, i, o, n, s, r, a);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = e(
          t,
          require("outlayer"),
          require("get-size"),
          require("desandro-matches-selector"),
          require("fizzy-ui-utils"),
          require("isotope-layout/js/item"),
          require("isotope-layout/js/layout-mode"),
          require("isotope-layout/js/layout-modes/masonry"),
          require("isotope-layout/js/layout-modes/fit-rows"),
          require("isotope-layout/js/layout-modes/vertical")
        ))
      : (t.Isotope = e(
          t,
          t.Outlayer,
          t.getSize,
          t.matchesSelector,
          t.fizzyUIUtils,
          t.Isotope.Item,
          t.Isotope.LayoutMode
        ));
  })(window, function (t, e, i, o, n, s, r) {
    function a(t, e) {
      return function (i, o) {
        for (var n = 0; n < t.length; n++) {
          var s = t[n],
            r = i.sortData[s],
            a = o.sortData[s];
          if (r > a || r < a) {
            var u = void 0 !== e[s] ? e[s] : e,
              h = u ? 1 : -1;
            return (r > a ? 1 : -1) * h;
          }
        }
        return 0;
      };
    }
    var u = t.jQuery,
      h = String.prototype.trim
        ? function (t) {
            return t.trim();
          }
        : function (t) {
            return t.replace(/^\s+|\s+$/g, "");
          },
      d = e.create("isotope", {
        layoutMode: "masonry",
        isJQueryFiltering: !0,
        sortAscending: !0,
      });
    (d.Item = s), (d.LayoutMode = r);
    var l = d.prototype;
    (l._create = function () {
      (this.itemGUID = 0),
        (this._sorters = {}),
        this._getSorters(),
        e.prototype._create.call(this),
        (this.modes = {}),
        (this.filteredItems = this.items),
        (this.sortHistory = ["original-order"]);
      for (var t in r.modes) this._initLayoutMode(t);
    }),
      (l.reloadItems = function () {
        (this.itemGUID = 0), e.prototype.reloadItems.call(this);
      }),
      (l._itemize = function () {
        for (
          var t = e.prototype._itemize.apply(this, arguments), i = 0;
          i < t.length;
          i++
        ) {
          var o = t[i];
          o.id = this.itemGUID++;
        }
        return this._updateItemsSortData(t), t;
      }),
      (l._initLayoutMode = function (t) {
        var e = r.modes[t],
          i = this.options[t] || {};
        (this.options[t] = e.options ? n.extend(e.options, i) : i),
          (this.modes[t] = new e(this));
      }),
      (l.layout = function () {
        return !this._isLayoutInited && this._getOption("initLayout")
          ? void this.arrange()
          : void this._layout();
      }),
      (l._layout = function () {
        var t = this._getIsInstant();
        this._resetLayout(),
          this._manageStamps(),
          this.layoutItems(this.filteredItems, t),
          (this._isLayoutInited = !0);
      }),
      (l.arrange = function (t) {
        this.option(t), this._getIsInstant();
        var e = this._filter(this.items);
        (this.filteredItems = e.matches),
          this._bindArrangeComplete(),
          this._isInstant
            ? this._noTransition(this._hideReveal, [e])
            : this._hideReveal(e),
          this._sort(),
          this._layout();
      }),
      (l._init = l.arrange),
      (l._hideReveal = function (t) {
        this.reveal(t.needReveal), this.hide(t.needHide);
      }),
      (l._getIsInstant = function () {
        var t = this._getOption("layoutInstant"),
          e = void 0 !== t ? t : !this._isLayoutInited;
        return (this._isInstant = e), e;
      }),
      (l._bindArrangeComplete = function () {
        function t() {
          e &&
            i &&
            o &&
            n.dispatchEvent("arrangeComplete", null, [n.filteredItems]);
        }
        var e,
          i,
          o,
          n = this;
        this.once("layoutComplete", function () {
          (e = !0), t();
        }),
          this.once("hideComplete", function () {
            (i = !0), t();
          }),
          this.once("revealComplete", function () {
            (o = !0), t();
          });
      }),
      (l._filter = function (t) {
        var e = this.options.filter;
        e = e || "*";
        for (
          var i = [], o = [], n = [], s = this._getFilterTest(e), r = 0;
          r < t.length;
          r++
        ) {
          var a = t[r];
          if (!a.isIgnored) {
            var u = s(a);
            u && i.push(a),
              u && a.isHidden ? o.push(a) : u || a.isHidden || n.push(a);
          }
        }
        return { matches: i, needReveal: o, needHide: n };
      }),
      (l._getFilterTest = function (t) {
        return u && this.options.isJQueryFiltering
          ? function (e) {
              return u(e.element).is(t);
            }
          : "function" == typeof t
          ? function (e) {
              return t(e.element);
            }
          : function (e) {
              return o(e.element, t);
            };
      }),
      (l.updateSortData = function (t) {
        var e;
        t ? ((t = n.makeArray(t)), (e = this.getItems(t))) : (e = this.items),
          this._getSorters(),
          this._updateItemsSortData(e);
      }),
      (l._getSorters = function () {
        var t = this.options.getSortData;
        for (var e in t) {
          var i = t[e];
          this._sorters[e] = f(i);
        }
      }),
      (l._updateItemsSortData = function (t) {
        for (var e = t && t.length, i = 0; e && i < e; i++) {
          var o = t[i];
          o.updateSortData();
        }
      });
    var f = (function () {
      function t(t) {
        if ("string" != typeof t) return t;
        var i = h(t).split(" "),
          o = i[0],
          n = o.match(/^\[(.+)\]$/),
          s = n && n[1],
          r = e(s, o),
          a = d.sortDataParsers[i[1]];
        return (t = a
          ? function (t) {
              return t && a(r(t));
            }
          : function (t) {
              return t && r(t);
            });
      }
      function e(t, e) {
        return t
          ? function (e) {
              return e.getAttribute(t);
            }
          : function (t) {
              var i = t.querySelector(e);
              return i && i.textContent;
            };
      }
      return t;
    })();
    (d.sortDataParsers = {
      parseInt: function (t) {
        return parseInt(t, 10);
      },
      parseFloat: function (t) {
        return parseFloat(t);
      },
    }),
      (l._sort = function () {
        if (this.options.sortBy) {
          var t = n.makeArray(this.options.sortBy);
          this._getIsSameSortBy(t) ||
            (this.sortHistory = t.concat(this.sortHistory));
          var e = a(this.sortHistory, this.options.sortAscending);
          this.filteredItems.sort(e);
        }
      }),
      (l._getIsSameSortBy = function (t) {
        for (var e = 0; e < t.length; e++)
          if (t[e] != this.sortHistory[e]) return !1;
        return !0;
      }),
      (l._mode = function () {
        var t = this.options.layoutMode,
          e = this.modes[t];
        if (!e) throw new Error("No layout mode: " + t);
        return (e.options = this.options[t]), e;
      }),
      (l._resetLayout = function () {
        e.prototype._resetLayout.call(this), this._mode()._resetLayout();
      }),
      (l._getItemLayoutPosition = function (t) {
        return this._mode()._getItemLayoutPosition(t);
      }),
      (l._manageStamp = function (t) {
        this._mode()._manageStamp(t);
      }),
      (l._getContainerSize = function () {
        return this._mode()._getContainerSize();
      }),
      (l.needsResizeLayout = function () {
        return this._mode().needsResizeLayout();
      }),
      (l.appended = function (t) {
        var e = this.addItems(t);
        if (e.length) {
          var i = this._filterRevealAdded(e);
          this.filteredItems = this.filteredItems.concat(i);
        }
      }),
      (l.prepended = function (t) {
        var e = this._itemize(t);
        if (e.length) {
          this._resetLayout(), this._manageStamps();
          var i = this._filterRevealAdded(e);
          this.layoutItems(this.filteredItems),
            (this.filteredItems = i.concat(this.filteredItems)),
            (this.items = e.concat(this.items));
        }
      }),
      (l._filterRevealAdded = function (t) {
        var e = this._filter(t);
        return (
          this.hide(e.needHide),
          this.reveal(e.matches),
          this.layoutItems(e.matches, !0),
          e.matches
        );
      }),
      (l.insert = function (t) {
        var e = this.addItems(t);
        if (e.length) {
          var i,
            o,
            n = e.length;
          for (i = 0; i < n; i++)
            (o = e[i]), this.element.appendChild(o.element);
          var s = this._filter(e).matches;
          for (i = 0; i < n; i++) e[i].isLayoutInstant = !0;
          for (this.arrange(), i = 0; i < n; i++) delete e[i].isLayoutInstant;
          this.reveal(s);
        }
      });
    var c = l.remove;
    return (
      (l.remove = function (t) {
        t = n.makeArray(t);
        var e = this.getItems(t);
        c.call(this, t);
        for (var i = e && e.length, o = 0; i && o < i; o++) {
          var s = e[o];
          n.removeFrom(this.filteredItems, s);
        }
      }),
      (l.shuffle = function () {
        for (var t = 0; t < this.items.length; t++) {
          var e = this.items[t];
          e.sortData.random = Math.random();
        }
        (this.options.sortBy = "random"), this._sort(), this._layout();
      }),
      (l._noTransition = function (t, e) {
        var i = this.options.transitionDuration;
        this.options.transitionDuration = 0;
        var o = t.apply(this, e);
        return (this.options.transitionDuration = i), o;
      }),
      (l.getFilteredItemElements = function () {
        return this.filteredItems.map(function (t) {
          return t.element;
        });
      }),
      d
    );
  });

/*!
 * imagesLoaded PACKAGED v4.1.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
!(function (e, t) {
  "function" == typeof define && define.amd
    ? define("ev-emitter/ev-emitter", t)
    : "object" == typeof module && module.exports
    ? (module.exports = t())
    : (e.EvEmitter = t());
})("undefined" != typeof window ? window : this, function () {
  function e() {}
  var t = e.prototype;
  return (
    (t.on = function (e, t) {
      if (e && t) {
        var i = (this._events = this._events || {}),
          n = (i[e] = i[e] || []);
        return n.indexOf(t) == -1 && n.push(t), this;
      }
    }),
    (t.once = function (e, t) {
      if (e && t) {
        this.on(e, t);
        var i = (this._onceEvents = this._onceEvents || {}),
          n = (i[e] = i[e] || {});
        return (n[t] = !0), this;
      }
    }),
    (t.off = function (e, t) {
      var i = this._events && this._events[e];
      if (i && i.length) {
        var n = i.indexOf(t);
        return n != -1 && i.splice(n, 1), this;
      }
    }),
    (t.emitEvent = function (e, t) {
      var i = this._events && this._events[e];
      if (i && i.length) {
        (i = i.slice(0)), (t = t || []);
        for (
          var n = this._onceEvents && this._onceEvents[e], o = 0;
          o < i.length;
          o++
        ) {
          var r = i[o],
            s = n && n[r];
          s && (this.off(e, r), delete n[r]), r.apply(this, t);
        }
        return this;
      }
    }),
    (t.allOff = function () {
      delete this._events, delete this._onceEvents;
    }),
    e
  );
}),
  (function (e, t) {
    "use strict";
    "function" == typeof define && define.amd
      ? define(["ev-emitter/ev-emitter"], function (i) {
          return t(e, i);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = t(e, require("ev-emitter")))
      : (e.imagesLoaded = t(e, e.EvEmitter));
  })("undefined" != typeof window ? window : this, function (e, t) {
    function i(e, t) {
      for (var i in t) e[i] = t[i];
      return e;
    }
    function n(e) {
      if (Array.isArray(e)) return e;
      var t = "object" == typeof e && "number" == typeof e.length;
      return t ? d.call(e) : [e];
    }
    function o(e, t, r) {
      if (!(this instanceof o)) return new o(e, t, r);
      var s = e;
      return (
        "string" == typeof e && (s = document.querySelectorAll(e)),
        s
          ? ((this.elements = n(s)),
            (this.options = i({}, this.options)),
            "function" == typeof t ? (r = t) : i(this.options, t),
            r && this.on("always", r),
            this.getImages(),
            h && (this.jqDeferred = new h.Deferred()),
            void setTimeout(this.check.bind(this)))
          : void a.error("Bad element for imagesLoaded " + (s || e))
      );
    }
    function r(e) {
      this.img = e;
    }
    function s(e, t) {
      (this.url = e), (this.element = t), (this.img = new Image());
    }
    var h = e.jQuery,
      a = e.console,
      d = Array.prototype.slice;
    (o.prototype = Object.create(t.prototype)),
      (o.prototype.options = {}),
      (o.prototype.getImages = function () {
        (this.images = []), this.elements.forEach(this.addElementImages, this);
      }),
      (o.prototype.addElementImages = function (e) {
        "IMG" == e.nodeName && this.addImage(e),
          this.options.background === !0 && this.addElementBackgroundImages(e);
        var t = e.nodeType;
        if (t && u[t]) {
          for (var i = e.querySelectorAll("img"), n = 0; n < i.length; n++) {
            var o = i[n];
            this.addImage(o);
          }
          if ("string" == typeof this.options.background) {
            var r = e.querySelectorAll(this.options.background);
            for (n = 0; n < r.length; n++) {
              var s = r[n];
              this.addElementBackgroundImages(s);
            }
          }
        }
      });
    var u = { 1: !0, 9: !0, 11: !0 };
    return (
      (o.prototype.addElementBackgroundImages = function (e) {
        var t = getComputedStyle(e);
        if (t)
          for (
            var i = /url\((['"])?(.*?)\1\)/gi, n = i.exec(t.backgroundImage);
            null !== n;

          ) {
            var o = n && n[2];
            o && this.addBackground(o, e), (n = i.exec(t.backgroundImage));
          }
      }),
      (o.prototype.addImage = function (e) {
        var t = new r(e);
        this.images.push(t);
      }),
      (o.prototype.addBackground = function (e, t) {
        var i = new s(e, t);
        this.images.push(i);
      }),
      (o.prototype.check = function () {
        function e(e, i, n) {
          setTimeout(function () {
            t.progress(e, i, n);
          });
        }
        var t = this;
        return (
          (this.progressedCount = 0),
          (this.hasAnyBroken = !1),
          this.images.length
            ? void this.images.forEach(function (t) {
                t.once("progress", e), t.check();
              })
            : void this.complete()
        );
      }),
      (o.prototype.progress = function (e, t, i) {
        this.progressedCount++,
          (this.hasAnyBroken = this.hasAnyBroken || !e.isLoaded),
          this.emitEvent("progress", [this, e, t]),
          this.jqDeferred &&
            this.jqDeferred.notify &&
            this.jqDeferred.notify(this, e),
          this.progressedCount == this.images.length && this.complete(),
          this.options.debug && a && a.log("progress: " + i, e, t);
      }),
      (o.prototype.complete = function () {
        var e = this.hasAnyBroken ? "fail" : "done";
        if (
          ((this.isComplete = !0),
          this.emitEvent(e, [this]),
          this.emitEvent("always", [this]),
          this.jqDeferred)
        ) {
          var t = this.hasAnyBroken ? "reject" : "resolve";
          this.jqDeferred[t](this);
        }
      }),
      (r.prototype = Object.create(t.prototype)),
      (r.prototype.check = function () {
        var e = this.getIsImageComplete();
        return e
          ? void this.confirm(0 !== this.img.naturalWidth, "naturalWidth")
          : ((this.proxyImage = new Image()),
            this.proxyImage.addEventListener("load", this),
            this.proxyImage.addEventListener("error", this),
            this.img.addEventListener("load", this),
            this.img.addEventListener("error", this),
            void (this.proxyImage.src = this.img.src));
      }),
      (r.prototype.getIsImageComplete = function () {
        return this.img.complete && this.img.naturalWidth;
      }),
      (r.prototype.confirm = function (e, t) {
        (this.isLoaded = e), this.emitEvent("progress", [this, this.img, t]);
      }),
      (r.prototype.handleEvent = function (e) {
        var t = "on" + e.type;
        this[t] && this[t](e);
      }),
      (r.prototype.onload = function () {
        this.confirm(!0, "onload"), this.unbindEvents();
      }),
      (r.prototype.onerror = function () {
        this.confirm(!1, "onerror"), this.unbindEvents();
      }),
      (r.prototype.unbindEvents = function () {
        this.proxyImage.removeEventListener("load", this),
          this.proxyImage.removeEventListener("error", this),
          this.img.removeEventListener("load", this),
          this.img.removeEventListener("error", this);
      }),
      (s.prototype = Object.create(r.prototype)),
      (s.prototype.check = function () {
        this.img.addEventListener("load", this),
          this.img.addEventListener("error", this),
          (this.img.src = this.url);
        var e = this.getIsImageComplete();
        e &&
          (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"),
          this.unbindEvents());
      }),
      (s.prototype.unbindEvents = function () {
        this.img.removeEventListener("load", this),
          this.img.removeEventListener("error", this);
      }),
      (s.prototype.confirm = function (e, t) {
        (this.isLoaded = e),
          this.emitEvent("progress", [this, this.element, t]);
      }),
      (o.makeJQueryPlugin = function (t) {
        (t = t || e.jQuery),
          t &&
            ((h = t),
            (h.fn.imagesLoaded = function (e, t) {
              var i = new o(this, e, t);
              return i.jqDeferred.promise(h(this));
            }));
      }),
      o.makeJQueryPlugin(),
      o
    );
  });

/*!
 * Flickity PACKAGED v2.2.1
 * Touch, responsive, flickable carousels
 *
 * Licensed GPLv3 for open source use
 * or Flickity Commercial License for commercial use
 *
 * https://flickity.metafizzy.co
 * Copyright 2015-2019 Metafizzy
 */

!(function (e, i) {
  "function" == typeof define && define.amd
    ? define("jquery-bridget/jquery-bridget", ["jquery"], function (t) {
        return i(e, t);
      })
    : "object" == typeof module && module.exports
    ? (module.exports = i(e, require("jquery")))
    : (e.jQueryBridget = i(e, e.jQuery));
})(window, function (t, e) {
  "use strict";
  var i = Array.prototype.slice,
    n = t.console,
    d =
      void 0 === n
        ? function () {}
        : function (t) {
            n.error(t);
          };
  function s(h, s, c) {
    (c = c || e || t.jQuery) &&
      (s.prototype.option ||
        (s.prototype.option = function (t) {
          c.isPlainObject(t) && (this.options = c.extend(!0, this.options, t));
        }),
      (c.fn[h] = function (t) {
        return "string" == typeof t
          ? (function (t, o, r) {
              var a,
                l = "$()." + h + '("' + o + '")';
              return (
                t.each(function (t, e) {
                  var i = c.data(e, h);
                  if (i) {
                    var n = i[o];
                    if (n && "_" != o.charAt(0)) {
                      var s = n.apply(i, r);
                      a = void 0 === a ? s : a;
                    } else d(l + " is not a valid method");
                  } else d(h + " not initialized. Cannot call methods, i.e. " + l);
                }),
                void 0 !== a ? a : t
              );
            })(this, t, i.call(arguments, 1))
          : ((function (t, n) {
              t.each(function (t, e) {
                var i = c.data(e, h);
                i
                  ? (i.option(n), i._init())
                  : ((i = new s(e, n)), c.data(e, h, i));
              });
            })(this, t),
            this);
      }),
      o(c));
  }
  function o(t) {
    !t || (t && t.bridget) || (t.bridget = s);
  }
  return o(e || t.jQuery), s;
}),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define("ev-emitter/ev-emitter", e)
      : "object" == typeof module && module.exports
      ? (module.exports = e())
      : (t.EvEmitter = e());
  })("undefined" != typeof window ? window : this, function () {
    function t() {}
    var e = t.prototype;
    return (
      (e.on = function (t, e) {
        if (t && e) {
          var i = (this._events = this._events || {}),
            n = (i[t] = i[t] || []);
          return -1 == n.indexOf(e) && n.push(e), this;
        }
      }),
      (e.once = function (t, e) {
        if (t && e) {
          this.on(t, e);
          var i = (this._onceEvents = this._onceEvents || {});
          return ((i[t] = i[t] || {})[e] = !0), this;
        }
      }),
      (e.off = function (t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
          var n = i.indexOf(e);
          return -1 != n && i.splice(n, 1), this;
        }
      }),
      (e.emitEvent = function (t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
          (i = i.slice(0)), (e = e || []);
          for (
            var n = this._onceEvents && this._onceEvents[t], s = 0;
            s < i.length;
            s++
          ) {
            var o = i[s];
            n && n[o] && (this.off(t, o), delete n[o]), o.apply(this, e);
          }
          return this;
        }
      }),
      (e.allOff = function () {
        delete this._events, delete this._onceEvents;
      }),
      t
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define("get-size/get-size", e)
      : "object" == typeof module && module.exports
      ? (module.exports = e())
      : (t.getSize = e());
  })(window, function () {
    "use strict";
    function m(t) {
      var e = parseFloat(t);
      return -1 == t.indexOf("%") && !isNaN(e) && e;
    }
    var i =
        "undefined" == typeof console
          ? function () {}
          : function (t) {
              console.error(t);
            },
      y = [
        "paddingLeft",
        "paddingRight",
        "paddingTop",
        "paddingBottom",
        "marginLeft",
        "marginRight",
        "marginTop",
        "marginBottom",
        "borderLeftWidth",
        "borderRightWidth",
        "borderTopWidth",
        "borderBottomWidth",
      ],
      b = y.length;
    function E(t) {
      var e = getComputedStyle(t);
      return (
        e ||
          i(
            "Style returned " +
              e +
              ". Are you running this code in a hidden iframe on Firefox? See https://bit.ly/getsizebug1"
          ),
        e
      );
    }
    var S,
      C = !1;
    function x(t) {
      if (
        ((function () {
          if (!C) {
            C = !0;
            var t = document.createElement("div");
            (t.style.width = "200px"),
              (t.style.padding = "1px 2px 3px 4px"),
              (t.style.borderStyle = "solid"),
              (t.style.borderWidth = "1px 2px 3px 4px"),
              (t.style.boxSizing = "border-box");
            var e = document.body || document.documentElement;
            e.appendChild(t);
            var i = E(t);
            (S = 200 == Math.round(m(i.width))),
              (x.isBoxSizeOuter = S),
              e.removeChild(t);
          }
        })(),
        "string" == typeof t && (t = document.querySelector(t)),
        t && "object" == typeof t && t.nodeType)
      ) {
        var e = E(t);
        if ("none" == e.display)
          return (function () {
            for (
              var t = {
                  width: 0,
                  height: 0,
                  innerWidth: 0,
                  innerHeight: 0,
                  outerWidth: 0,
                  outerHeight: 0,
                },
                e = 0;
              e < b;
              e++
            ) {
              t[y[e]] = 0;
            }
            return t;
          })();
        var i = {};
        (i.width = t.offsetWidth), (i.height = t.offsetHeight);
        for (
          var n = (i.isBorderBox = "border-box" == e.boxSizing), s = 0;
          s < b;
          s++
        ) {
          var o = y[s],
            r = e[o],
            a = parseFloat(r);
          i[o] = isNaN(a) ? 0 : a;
        }
        var l = i.paddingLeft + i.paddingRight,
          h = i.paddingTop + i.paddingBottom,
          c = i.marginLeft + i.marginRight,
          d = i.marginTop + i.marginBottom,
          u = i.borderLeftWidth + i.borderRightWidth,
          f = i.borderTopWidth + i.borderBottomWidth,
          p = n && S,
          g = m(e.width);
        !1 !== g && (i.width = g + (p ? 0 : l + u));
        var v = m(e.height);
        return (
          !1 !== v && (i.height = v + (p ? 0 : h + f)),
          (i.innerWidth = i.width - (l + u)),
          (i.innerHeight = i.height - (h + f)),
          (i.outerWidth = i.width + c),
          (i.outerHeight = i.height + d),
          i
        );
      }
    }
    return x;
  }),
  (function (t, e) {
    "use strict";
    "function" == typeof define && define.amd
      ? define("desandro-matches-selector/matches-selector", e)
      : "object" == typeof module && module.exports
      ? (module.exports = e())
      : (t.matchesSelector = e());
  })(window, function () {
    "use strict";
    var i = (function () {
      var t = window.Element.prototype;
      if (t.matches) return "matches";
      if (t.matchesSelector) return "matchesSelector";
      for (var e = ["webkit", "moz", "ms", "o"], i = 0; i < e.length; i++) {
        var n = e[i] + "MatchesSelector";
        if (t[n]) return n;
      }
    })();
    return function (t, e) {
      return t[i](e);
    };
  }),
  (function (e, i) {
    "function" == typeof define && define.amd
      ? define(
          "fizzy-ui-utils/utils",
          ["desandro-matches-selector/matches-selector"],
          function (t) {
            return i(e, t);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = i(e, require("desandro-matches-selector")))
      : (e.fizzyUIUtils = i(e, e.matchesSelector));
  })(window, function (h, o) {
    var c = {
        extend: function (t, e) {
          for (var i in e) t[i] = e[i];
          return t;
        },
        modulo: function (t, e) {
          return ((t % e) + e) % e;
        },
      },
      e = Array.prototype.slice;
    (c.makeArray = function (t) {
      return Array.isArray(t)
        ? t
        : null == t
        ? []
        : "object" == typeof t && "number" == typeof t.length
        ? e.call(t)
        : [t];
    }),
      (c.removeFrom = function (t, e) {
        var i = t.indexOf(e);
        -1 != i && t.splice(i, 1);
      }),
      (c.getParent = function (t, e) {
        for (; t.parentNode && t != document.body; )
          if (((t = t.parentNode), o(t, e))) return t;
      }),
      (c.getQueryElement = function (t) {
        return "string" == typeof t ? document.querySelector(t) : t;
      }),
      (c.handleEvent = function (t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
      }),
      (c.filterFindElements = function (t, n) {
        t = c.makeArray(t);
        var s = [];
        return (
          t.forEach(function (t) {
            if (t instanceof HTMLElement)
              if (n) {
                o(t, n) && s.push(t);
                for (var e = t.querySelectorAll(n), i = 0; i < e.length; i++)
                  s.push(e[i]);
              } else s.push(t);
          }),
          s
        );
      }),
      (c.debounceMethod = function (t, e, n) {
        n = n || 100;
        var s = t.prototype[e],
          o = e + "Timeout";
        t.prototype[e] = function () {
          var t = this[o];
          clearTimeout(t);
          var e = arguments,
            i = this;
          this[o] = setTimeout(function () {
            s.apply(i, e), delete i[o];
          }, n);
        };
      }),
      (c.docReady = function (t) {
        var e = document.readyState;
        "complete" == e || "interactive" == e
          ? setTimeout(t)
          : document.addEventListener("DOMContentLoaded", t);
      }),
      (c.toDashed = function (t) {
        return t
          .replace(/(.)([A-Z])/g, function (t, e, i) {
            return e + "-" + i;
          })
          .toLowerCase();
      });
    var d = h.console;
    return (
      (c.htmlInit = function (a, l) {
        c.docReady(function () {
          var t = c.toDashed(l),
            s = "data-" + t,
            e = document.querySelectorAll("[" + s + "]"),
            i = document.querySelectorAll(".js-" + t),
            n = c.makeArray(e).concat(c.makeArray(i)),
            o = s + "-options",
            r = h.jQuery;
          n.forEach(function (e) {
            var t,
              i = e.getAttribute(s) || e.getAttribute(o);
            try {
              t = i && JSON.parse(i);
            } catch (t) {
              return void (
                d &&
                d.error("Error parsing " + s + " on " + e.className + ": " + t)
              );
            }
            var n = new a(e, t);
            r && r.data(e, l, n);
          });
        });
      }),
      c
    );
  }),
  (function (e, i) {
    "function" == typeof define && define.amd
      ? define("flickity/js/cell", ["get-size/get-size"], function (t) {
          return i(e, t);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = i(e, require("get-size")))
      : ((e.Flickity = e.Flickity || {}), (e.Flickity.Cell = i(e, e.getSize)));
  })(window, function (t, e) {
    function i(t, e) {
      (this.element = t), (this.parent = e), this.create();
    }
    var n = i.prototype;
    return (
      (n.create = function () {
        (this.element.style.position = "absolute"),
          this.element.setAttribute("aria-hidden", "true"),
          (this.x = 0),
          (this.shift = 0);
      }),
      (n.destroy = function () {
        this.unselect(), (this.element.style.position = "");
        var t = this.parent.originSide;
        this.element.style[t] = "";
      }),
      (n.getSize = function () {
        this.size = e(this.element);
      }),
      (n.setPosition = function (t) {
        (this.x = t), this.updateTarget(), this.renderPosition(t);
      }),
      (n.updateTarget = n.setDefaultTarget =
        function () {
          var t =
            "left" == this.parent.originSide ? "marginLeft" : "marginRight";
          this.target =
            this.x + this.size[t] + this.size.width * this.parent.cellAlign;
        }),
      (n.renderPosition = function (t) {
        var e = this.parent.originSide;
        this.element.style[e] = this.parent.getPositionValue(t);
      }),
      (n.select = function () {
        this.element.classList.add("is-selected"),
          this.element.removeAttribute("aria-hidden");
      }),
      (n.unselect = function () {
        this.element.classList.remove("is-selected"),
          this.element.setAttribute("aria-hidden", "true");
      }),
      (n.wrapShift = function (t) {
        (this.shift = t),
          this.renderPosition(this.x + this.parent.slideableWidth * t);
      }),
      (n.remove = function () {
        this.element.parentNode.removeChild(this.element);
      }),
      i
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define("flickity/js/slide", e)
      : "object" == typeof module && module.exports
      ? (module.exports = e())
      : ((t.Flickity = t.Flickity || {}), (t.Flickity.Slide = e()));
  })(window, function () {
    "use strict";
    function t(t) {
      (this.parent = t),
        (this.isOriginLeft = "left" == t.originSide),
        (this.cells = []),
        (this.outerWidth = 0),
        (this.height = 0);
    }
    var e = t.prototype;
    return (
      (e.addCell = function (t) {
        if (
          (this.cells.push(t),
          (this.outerWidth += t.size.outerWidth),
          (this.height = Math.max(t.size.outerHeight, this.height)),
          1 == this.cells.length)
        ) {
          this.x = t.x;
          var e = this.isOriginLeft ? "marginLeft" : "marginRight";
          this.firstMargin = t.size[e];
        }
      }),
      (e.updateTarget = function () {
        var t = this.isOriginLeft ? "marginRight" : "marginLeft",
          e = this.getLastCell(),
          i = e ? e.size[t] : 0,
          n = this.outerWidth - (this.firstMargin + i);
        this.target = this.x + this.firstMargin + n * this.parent.cellAlign;
      }),
      (e.getLastCell = function () {
        return this.cells[this.cells.length - 1];
      }),
      (e.select = function () {
        this.cells.forEach(function (t) {
          t.select();
        });
      }),
      (e.unselect = function () {
        this.cells.forEach(function (t) {
          t.unselect();
        });
      }),
      (e.getCellElements = function () {
        return this.cells.map(function (t) {
          return t.element;
        });
      }),
      t
    );
  }),
  (function (e, i) {
    "function" == typeof define && define.amd
      ? define("flickity/js/animate", ["fizzy-ui-utils/utils"], function (t) {
          return i(e, t);
        })
      : "object" == typeof module && module.exports
      ? (module.exports = i(e, require("fizzy-ui-utils")))
      : ((e.Flickity = e.Flickity || {}),
        (e.Flickity.animatePrototype = i(e, e.fizzyUIUtils)));
  })(window, function (t, e) {
    var i = {
      startAnimation: function () {
        this.isAnimating ||
          ((this.isAnimating = !0), (this.restingFrames = 0), this.animate());
      },
      animate: function () {
        this.applyDragForce(), this.applySelectedAttraction();
        var t = this.x;
        if (
          (this.integratePhysics(),
          this.positionSlider(),
          this.settle(t),
          this.isAnimating)
        ) {
          var e = this;
          requestAnimationFrame(function () {
            e.animate();
          });
        }
      },
      positionSlider: function () {
        var t = this.x;
        this.options.wrapAround &&
          1 < this.cells.length &&
          ((t = e.modulo(t, this.slideableWidth)),
          (t -= this.slideableWidth),
          this.shiftWrapCells(t)),
          this.setTranslateX(t, this.isAnimating),
          this.dispatchScrollEvent();
      },
      setTranslateX: function (t, e) {
        (t += this.cursorPosition), (t = this.options.rightToLeft ? -t : t);
        var i = this.getPositionValue(t);
        this.slider.style.transform = e
          ? "translate3d(" + i + ",0,0)"
          : "translateX(" + i + ")";
      },
      dispatchScrollEvent: function () {
        var t = this.slides[0];
        if (t) {
          var e = -this.x - t.target,
            i = e / this.slidesWidth;
          this.dispatchEvent("scroll", null, [i, e]);
        }
      },
      positionSliderAtSelected: function () {
        this.cells.length &&
          ((this.x = -this.selectedSlide.target),
          (this.velocity = 0),
          this.positionSlider());
      },
      getPositionValue: function (t) {
        return this.options.percentPosition
          ? 0.01 * Math.round((t / this.size.innerWidth) * 1e4) + "%"
          : Math.round(t) + "px";
      },
      settle: function (t) {
        this.isPointerDown ||
          Math.round(100 * this.x) != Math.round(100 * t) ||
          this.restingFrames++,
          2 < this.restingFrames &&
            ((this.isAnimating = !1),
            delete this.isFreeScrolling,
            this.positionSlider(),
            this.dispatchEvent("settle", null, [this.selectedIndex]));
      },
      shiftWrapCells: function (t) {
        var e = this.cursorPosition + t;
        this._shiftCells(this.beforeShiftCells, e, -1);
        var i =
          this.size.innerWidth -
          (t + this.slideableWidth + this.cursorPosition);
        this._shiftCells(this.afterShiftCells, i, 1);
      },
      _shiftCells: function (t, e, i) {
        for (var n = 0; n < t.length; n++) {
          var s = t[n],
            o = 0 < e ? i : 0;
          s.wrapShift(o), (e -= s.size.outerWidth);
        }
      },
      _unshiftCells: function (t) {
        if (t && t.length) for (var e = 0; e < t.length; e++) t[e].wrapShift(0);
      },
      integratePhysics: function () {
        (this.x += this.velocity), (this.velocity *= this.getFrictionFactor());
      },
      applyForce: function (t) {
        this.velocity += t;
      },
      getFrictionFactor: function () {
        return (
          1 -
          this.options[this.isFreeScrolling ? "freeScrollFriction" : "friction"]
        );
      },
      getRestingPosition: function () {
        return this.x + this.velocity / (1 - this.getFrictionFactor());
      },
      applyDragForce: function () {
        if (this.isDraggable && this.isPointerDown) {
          var t = this.dragX - this.x - this.velocity;
          this.applyForce(t);
        }
      },
      applySelectedAttraction: function () {
        if (
          !(this.isDraggable && this.isPointerDown) &&
          !this.isFreeScrolling &&
          this.slides.length
        ) {
          var t =
            (-1 * this.selectedSlide.target - this.x) *
            this.options.selectedAttraction;
          this.applyForce(t);
        }
      },
    };
    return i;
  }),
  (function (r, a) {
    if ("function" == typeof define && define.amd)
      define("flickity/js/flickity", [
        "ev-emitter/ev-emitter",
        "get-size/get-size",
        "fizzy-ui-utils/utils",
        "./cell",
        "./slide",
        "./animate",
      ], function (t, e, i, n, s, o) {
        return a(r, t, e, i, n, s, o);
      });
    else if ("object" == typeof module && module.exports)
      module.exports = a(
        r,
        require("ev-emitter"),
        require("get-size"),
        require("fizzy-ui-utils"),
        require("./cell"),
        require("./slide"),
        require("./animate")
      );
    else {
      var t = r.Flickity;
      r.Flickity = a(
        r,
        r.EvEmitter,
        r.getSize,
        r.fizzyUIUtils,
        t.Cell,
        t.Slide,
        t.animatePrototype
      );
    }
  })(window, function (n, t, e, a, i, r, s) {
    var l = n.jQuery,
      o = n.getComputedStyle,
      h = n.console;
    function c(t, e) {
      for (t = a.makeArray(t); t.length; ) e.appendChild(t.shift());
    }
    var d = 0,
      u = {};
    function f(t, e) {
      var i = a.getQueryElement(t);
      if (i) {
        if (((this.element = i), this.element.flickityGUID)) {
          var n = u[this.element.flickityGUID];
          return n.option(e), n;
        }
        l && (this.$element = l(this.element)),
          (this.options = a.extend({}, this.constructor.defaults)),
          this.option(e),
          this._create();
      } else h && h.error("Bad element for Flickity: " + (i || t));
    }
    (f.defaults = {
      accessibility: !0,
      cellAlign: "center",
      freeScrollFriction: 0.075,
      friction: 0.28,
      namespaceJQueryEvents: !0,
      percentPosition: !0,
      resize: !0,
      selectedAttraction: 0.025,
      setGallerySize: !0,
    }),
      (f.createMethods = []);
    var p = f.prototype;
    a.extend(p, t.prototype),
      (p._create = function () {
        var t = (this.guid = ++d);
        for (var e in ((this.element.flickityGUID = t),
        ((u[t] = this).selectedIndex = 0),
        (this.restingFrames = 0),
        (this.x = 0),
        (this.velocity = 0),
        (this.originSide = this.options.rightToLeft ? "right" : "left"),
        (this.viewport = document.createElement("div")),
        (this.viewport.className = "flickity-viewport"),
        this._createSlider(),
        (this.options.resize || this.options.watchCSS) &&
          n.addEventListener("resize", this),
        this.options.on)) {
          var i = this.options.on[e];
          this.on(e, i);
        }
        f.createMethods.forEach(function (t) {
          this[t]();
        }, this),
          this.options.watchCSS ? this.watchCSS() : this.activate();
      }),
      (p.option = function (t) {
        a.extend(this.options, t);
      }),
      (p.activate = function () {
        this.isActive ||
          ((this.isActive = !0),
          this.element.classList.add("flickity-enabled"),
          this.options.rightToLeft &&
            this.element.classList.add("flickity-rtl"),
          this.getSize(),
          c(this._filterFindCellElements(this.element.children), this.slider),
          this.viewport.appendChild(this.slider),
          this.element.appendChild(this.viewport),
          this.reloadCells(),
          this.options.accessibility &&
            ((this.element.tabIndex = 0),
            this.element.addEventListener("keydown", this)),
          this.emitEvent("activate"),
          this.selectInitialIndex(),
          (this.isInitActivated = !0),
          this.dispatchEvent("ready"));
      }),
      (p._createSlider = function () {
        var t = document.createElement("div");
        (t.className = "flickity-slider"),
          (t.style[this.originSide] = 0),
          (this.slider = t);
      }),
      (p._filterFindCellElements = function (t) {
        return a.filterFindElements(t, this.options.cellSelector);
      }),
      (p.reloadCells = function () {
        (this.cells = this._makeCells(this.slider.children)),
          this.positionCells(),
          this._getWrapShiftCells(),
          this.setGallerySize();
      }),
      (p._makeCells = function (t) {
        return this._filterFindCellElements(t).map(function (t) {
          return new i(t, this);
        }, this);
      }),
      (p.getLastCell = function () {
        return this.cells[this.cells.length - 1];
      }),
      (p.getLastSlide = function () {
        return this.slides[this.slides.length - 1];
      }),
      (p.positionCells = function () {
        this._sizeCells(this.cells), this._positionCells(0);
      }),
      (p._positionCells = function (t) {
        (t = t || 0), (this.maxCellHeight = (t && this.maxCellHeight) || 0);
        var e = 0;
        if (0 < t) {
          var i = this.cells[t - 1];
          e = i.x + i.size.outerWidth;
        }
        for (var n = this.cells.length, s = t; s < n; s++) {
          var o = this.cells[s];
          o.setPosition(e),
            (e += o.size.outerWidth),
            (this.maxCellHeight = Math.max(
              o.size.outerHeight,
              this.maxCellHeight
            ));
        }
        (this.slideableWidth = e),
          this.updateSlides(),
          this._containSlides(),
          (this.slidesWidth = n
            ? this.getLastSlide().target - this.slides[0].target
            : 0);
      }),
      (p._sizeCells = function (t) {
        t.forEach(function (t) {
          t.getSize();
        });
      }),
      (p.updateSlides = function () {
        if (((this.slides = []), this.cells.length)) {
          var n = new r(this);
          this.slides.push(n);
          var s = "left" == this.originSide ? "marginRight" : "marginLeft",
            o = this._getCanCellFit();
          this.cells.forEach(function (t, e) {
            if (n.cells.length) {
              var i =
                n.outerWidth - n.firstMargin + (t.size.outerWidth - t.size[s]);
              o.call(this, e, i) ||
                (n.updateTarget(), (n = new r(this)), this.slides.push(n)),
                n.addCell(t);
            } else n.addCell(t);
          }, this),
            n.updateTarget(),
            this.updateSelectedSlide();
        }
      }),
      (p._getCanCellFit = function () {
        var t = this.options.groupCells;
        if (!t)
          return function () {
            return !1;
          };
        if ("number" == typeof t) {
          var e = parseInt(t, 10);
          return function (t) {
            return t % e != 0;
          };
        }
        var i = "string" == typeof t && t.match(/^(\d+)%$/),
          n = i ? parseInt(i[1], 10) / 100 : 1;
        return function (t, e) {
          return e <= (this.size.innerWidth + 1) * n;
        };
      }),
      (p._init = p.reposition =
        function () {
          this.positionCells(), this.positionSliderAtSelected();
        }),
      (p.getSize = function () {
        (this.size = e(this.element)),
          this.setCellAlign(),
          (this.cursorPosition = this.size.innerWidth * this.cellAlign);
      });
    var g = {
      center: { left: 0.5, right: 0.5 },
      left: { left: 0, right: 1 },
      right: { right: 0, left: 1 },
    };
    return (
      (p.setCellAlign = function () {
        var t = g[this.options.cellAlign];
        this.cellAlign = t ? t[this.originSide] : this.options.cellAlign;
      }),
      (p.setGallerySize = function () {
        if (this.options.setGallerySize) {
          var t =
            this.options.adaptiveHeight && this.selectedSlide
              ? this.selectedSlide.height
              : this.maxCellHeight;
          this.viewport.style.height = t + "px";
        }
      }),
      (p._getWrapShiftCells = function () {
        if (this.options.wrapAround) {
          this._unshiftCells(this.beforeShiftCells),
            this._unshiftCells(this.afterShiftCells);
          var t = this.cursorPosition,
            e = this.cells.length - 1;
          (this.beforeShiftCells = this._getGapCells(t, e, -1)),
            (t = this.size.innerWidth - this.cursorPosition),
            (this.afterShiftCells = this._getGapCells(t, 0, 1));
        }
      }),
      (p._getGapCells = function (t, e, i) {
        for (var n = []; 0 < t; ) {
          var s = this.cells[e];
          if (!s) break;
          n.push(s), (e += i), (t -= s.size.outerWidth);
        }
        return n;
      }),
      (p._containSlides = function () {
        if (
          this.options.contain &&
          !this.options.wrapAround &&
          this.cells.length
        ) {
          var t = this.options.rightToLeft,
            e = t ? "marginRight" : "marginLeft",
            i = t ? "marginLeft" : "marginRight",
            n = this.slideableWidth - this.getLastCell().size[i],
            s = n < this.size.innerWidth,
            o = this.cursorPosition + this.cells[0].size[e],
            r = n - this.size.innerWidth * (1 - this.cellAlign);
          this.slides.forEach(function (t) {
            s
              ? (t.target = n * this.cellAlign)
              : ((t.target = Math.max(t.target, o)),
                (t.target = Math.min(t.target, r)));
          }, this);
        }
      }),
      (p.dispatchEvent = function (t, e, i) {
        var n = e ? [e].concat(i) : i;
        if ((this.emitEvent(t, n), l && this.$element)) {
          var s = (t += this.options.namespaceJQueryEvents ? ".flickity" : "");
          if (e) {
            var o = l.Event(e);
            (o.type = t), (s = o);
          }
          this.$element.trigger(s, i);
        }
      }),
      (p.select = function (t, e, i) {
        if (
          this.isActive &&
          ((t = parseInt(t, 10)),
          this._wrapSelect(t),
          (this.options.wrapAround || e) &&
            (t = a.modulo(t, this.slides.length)),
          this.slides[t])
        ) {
          var n = this.selectedIndex;
          (this.selectedIndex = t),
            this.updateSelectedSlide(),
            i ? this.positionSliderAtSelected() : this.startAnimation(),
            this.options.adaptiveHeight && this.setGallerySize(),
            this.dispatchEvent("select", null, [t]),
            t != n && this.dispatchEvent("change", null, [t]),
            this.dispatchEvent("cellSelect");
        }
      }),
      (p._wrapSelect = function (t) {
        var e = this.slides.length;
        if (!(this.options.wrapAround && 1 < e)) return t;
        var i = a.modulo(t, e),
          n = Math.abs(i - this.selectedIndex),
          s = Math.abs(i + e - this.selectedIndex),
          o = Math.abs(i - e - this.selectedIndex);
        !this.isDragSelect && s < n
          ? (t += e)
          : !this.isDragSelect && o < n && (t -= e),
          t < 0
            ? (this.x -= this.slideableWidth)
            : e <= t && (this.x += this.slideableWidth);
      }),
      (p.previous = function (t, e) {
        this.select(this.selectedIndex - 1, t, e);
      }),
      (p.next = function (t, e) {
        this.select(this.selectedIndex + 1, t, e);
      }),
      (p.updateSelectedSlide = function () {
        var t = this.slides[this.selectedIndex];
        t &&
          (this.unselectSelectedSlide(),
          (this.selectedSlide = t).select(),
          (this.selectedCells = t.cells),
          (this.selectedElements = t.getCellElements()),
          (this.selectedCell = t.cells[0]),
          (this.selectedElement = this.selectedElements[0]));
      }),
      (p.unselectSelectedSlide = function () {
        this.selectedSlide && this.selectedSlide.unselect();
      }),
      (p.selectInitialIndex = function () {
        var t = this.options.initialIndex;
        if (this.isInitActivated) this.select(this.selectedIndex, !1, !0);
        else {
          if (t && "string" == typeof t)
            if (this.queryCell(t)) return void this.selectCell(t, !1, !0);
          var e = 0;
          t && this.slides[t] && (e = t), this.select(e, !1, !0);
        }
      }),
      (p.selectCell = function (t, e, i) {
        var n = this.queryCell(t);
        if (n) {
          var s = this.getCellSlideIndex(n);
          this.select(s, e, i);
        }
      }),
      (p.getCellSlideIndex = function (t) {
        for (var e = 0; e < this.slides.length; e++) {
          if (-1 != this.slides[e].cells.indexOf(t)) return e;
        }
      }),
      (p.getCell = function (t) {
        for (var e = 0; e < this.cells.length; e++) {
          var i = this.cells[e];
          if (i.element == t) return i;
        }
      }),
      (p.getCells = function (t) {
        t = a.makeArray(t);
        var i = [];
        return (
          t.forEach(function (t) {
            var e = this.getCell(t);
            e && i.push(e);
          }, this),
          i
        );
      }),
      (p.getCellElements = function () {
        return this.cells.map(function (t) {
          return t.element;
        });
      }),
      (p.getParentCell = function (t) {
        var e = this.getCell(t);
        return (
          e || ((t = a.getParent(t, ".flickity-slider > *")), this.getCell(t))
        );
      }),
      (p.getAdjacentCellElements = function (t, e) {
        if (!t) return this.selectedSlide.getCellElements();
        e = void 0 === e ? this.selectedIndex : e;
        var i = this.slides.length;
        if (i <= 1 + 2 * t) return this.getCellElements();
        for (var n = [], s = e - t; s <= e + t; s++) {
          var o = this.options.wrapAround ? a.modulo(s, i) : s,
            r = this.slides[o];
          r && (n = n.concat(r.getCellElements()));
        }
        return n;
      }),
      (p.queryCell = function (t) {
        if ("number" == typeof t) return this.cells[t];
        if ("string" == typeof t) {
          if (t.match(/^[#\.]?[\d\/]/)) return;
          t = this.element.querySelector(t);
        }
        return this.getCell(t);
      }),
      (p.uiChange = function () {
        this.emitEvent("uiChange");
      }),
      (p.childUIPointerDown = function (t) {
        "touchstart" != t.type && t.preventDefault(), this.focus();
      }),
      (p.onresize = function () {
        this.watchCSS(), this.resize();
      }),
      a.debounceMethod(f, "onresize", 150),
      (p.resize = function () {
        if (this.isActive) {
          this.getSize(),
            this.options.wrapAround &&
              (this.x = a.modulo(this.x, this.slideableWidth)),
            this.positionCells(),
            this._getWrapShiftCells(),
            this.setGallerySize(),
            this.emitEvent("resize");
          var t = this.selectedElements && this.selectedElements[0];
          this.selectCell(t, !1, !0);
        }
      }),
      (p.watchCSS = function () {
        this.options.watchCSS &&
          (-1 != o(this.element, ":after").content.indexOf("flickity")
            ? this.activate()
            : this.deactivate());
      }),
      (p.onkeydown = function (t) {
        var e =
          document.activeElement && document.activeElement != this.element;
        if (this.options.accessibility && !e) {
          var i = f.keyboardHandlers[t.keyCode];
          i && i.call(this);
        }
      }),
      (f.keyboardHandlers = {
        37: function () {
          var t = this.options.rightToLeft ? "next" : "previous";
          this.uiChange(), this[t]();
        },
        39: function () {
          var t = this.options.rightToLeft ? "previous" : "next";
          this.uiChange(), this[t]();
        },
      }),
      (p.focus = function () {
        var t = n.pageYOffset;
        this.element.focus({ preventScroll: !0 }),
          n.pageYOffset != t && n.scrollTo(n.pageXOffset, t);
      }),
      (p.deactivate = function () {
        this.isActive &&
          (this.element.classList.remove("flickity-enabled"),
          this.element.classList.remove("flickity-rtl"),
          this.unselectSelectedSlide(),
          this.cells.forEach(function (t) {
            t.destroy();
          }),
          this.element.removeChild(this.viewport),
          c(this.slider.children, this.element),
          this.options.accessibility &&
            (this.element.removeAttribute("tabIndex"),
            this.element.removeEventListener("keydown", this)),
          (this.isActive = !1),
          this.emitEvent("deactivate"));
      }),
      (p.destroy = function () {
        this.deactivate(),
          n.removeEventListener("resize", this),
          this.allOff(),
          this.emitEvent("destroy"),
          l && this.$element && l.removeData(this.element, "flickity"),
          delete this.element.flickityGUID,
          delete u[this.guid];
      }),
      a.extend(p, s),
      (f.data = function (t) {
        var e = (t = a.getQueryElement(t)) && t.flickityGUID;
        return e && u[e];
      }),
      a.htmlInit(f, "flickity"),
      l && l.bridget && l.bridget("flickity", f),
      (f.setJQuery = function (t) {
        l = t;
      }),
      (f.Cell = i),
      (f.Slide = r),
      f
    );
  }),
  (function (e, i) {
    "function" == typeof define && define.amd
      ? define(
          "unipointer/unipointer",
          ["ev-emitter/ev-emitter"],
          function (t) {
            return i(e, t);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = i(e, require("ev-emitter")))
      : (e.Unipointer = i(e, e.EvEmitter));
  })(window, function (s, t) {
    function e() {}
    var i = (e.prototype = Object.create(t.prototype));
    (i.bindStartEvent = function (t) {
      this._bindStartEvent(t, !0);
    }),
      (i.unbindStartEvent = function (t) {
        this._bindStartEvent(t, !1);
      }),
      (i._bindStartEvent = function (t, e) {
        var i = (e = void 0 === e || e)
            ? "addEventListener"
            : "removeEventListener",
          n = "mousedown";
        s.PointerEvent
          ? (n = "pointerdown")
          : "ontouchstart" in s && (n = "touchstart"),
          t[i](n, this);
      }),
      (i.handleEvent = function (t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
      }),
      (i.getTouch = function (t) {
        for (var e = 0; e < t.length; e++) {
          var i = t[e];
          if (i.identifier == this.pointerIdentifier) return i;
        }
      }),
      (i.onmousedown = function (t) {
        var e = t.button;
        (e && 0 !== e && 1 !== e) || this._pointerDown(t, t);
      }),
      (i.ontouchstart = function (t) {
        this._pointerDown(t, t.changedTouches[0]);
      }),
      (i.onpointerdown = function (t) {
        this._pointerDown(t, t);
      }),
      (i._pointerDown = function (t, e) {
        t.button ||
          this.isPointerDown ||
          ((this.isPointerDown = !0),
          (this.pointerIdentifier =
            void 0 !== e.pointerId ? e.pointerId : e.identifier),
          this.pointerDown(t, e));
      }),
      (i.pointerDown = function (t, e) {
        this._bindPostStartEvents(t), this.emitEvent("pointerDown", [t, e]);
      });
    var n = {
      mousedown: ["mousemove", "mouseup"],
      touchstart: ["touchmove", "touchend", "touchcancel"],
      pointerdown: ["pointermove", "pointerup", "pointercancel"],
    };
    return (
      (i._bindPostStartEvents = function (t) {
        if (t) {
          var e = n[t.type];
          e.forEach(function (t) {
            s.addEventListener(t, this);
          }, this),
            (this._boundPointerEvents = e);
        }
      }),
      (i._unbindPostStartEvents = function () {
        this._boundPointerEvents &&
          (this._boundPointerEvents.forEach(function (t) {
            s.removeEventListener(t, this);
          }, this),
          delete this._boundPointerEvents);
      }),
      (i.onmousemove = function (t) {
        this._pointerMove(t, t);
      }),
      (i.onpointermove = function (t) {
        t.pointerId == this.pointerIdentifier && this._pointerMove(t, t);
      }),
      (i.ontouchmove = function (t) {
        var e = this.getTouch(t.changedTouches);
        e && this._pointerMove(t, e);
      }),
      (i._pointerMove = function (t, e) {
        this.pointerMove(t, e);
      }),
      (i.pointerMove = function (t, e) {
        this.emitEvent("pointerMove", [t, e]);
      }),
      (i.onmouseup = function (t) {
        this._pointerUp(t, t);
      }),
      (i.onpointerup = function (t) {
        t.pointerId == this.pointerIdentifier && this._pointerUp(t, t);
      }),
      (i.ontouchend = function (t) {
        var e = this.getTouch(t.changedTouches);
        e && this._pointerUp(t, e);
      }),
      (i._pointerUp = function (t, e) {
        this._pointerDone(), this.pointerUp(t, e);
      }),
      (i.pointerUp = function (t, e) {
        this.emitEvent("pointerUp", [t, e]);
      }),
      (i._pointerDone = function () {
        this._pointerReset(), this._unbindPostStartEvents(), this.pointerDone();
      }),
      (i._pointerReset = function () {
        (this.isPointerDown = !1), delete this.pointerIdentifier;
      }),
      (i.pointerDone = function () {}),
      (i.onpointercancel = function (t) {
        t.pointerId == this.pointerIdentifier && this._pointerCancel(t, t);
      }),
      (i.ontouchcancel = function (t) {
        var e = this.getTouch(t.changedTouches);
        e && this._pointerCancel(t, e);
      }),
      (i._pointerCancel = function (t, e) {
        this._pointerDone(), this.pointerCancel(t, e);
      }),
      (i.pointerCancel = function (t, e) {
        this.emitEvent("pointerCancel", [t, e]);
      }),
      (e.getPointerPoint = function (t) {
        return { x: t.pageX, y: t.pageY };
      }),
      e
    );
  }),
  (function (e, i) {
    "function" == typeof define && define.amd
      ? define(
          "unidragger/unidragger",
          ["unipointer/unipointer"],
          function (t) {
            return i(e, t);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = i(e, require("unipointer")))
      : (e.Unidragger = i(e, e.Unipointer));
  })(window, function (o, t) {
    function e() {}
    var i = (e.prototype = Object.create(t.prototype));
    (i.bindHandles = function () {
      this._bindHandles(!0);
    }),
      (i.unbindHandles = function () {
        this._bindHandles(!1);
      }),
      (i._bindHandles = function (t) {
        for (
          var e = (t = void 0 === t || t)
              ? "addEventListener"
              : "removeEventListener",
            i = t ? this._touchActionValue : "",
            n = 0;
          n < this.handles.length;
          n++
        ) {
          var s = this.handles[n];
          this._bindStartEvent(s, t),
            s[e]("click", this),
            o.PointerEvent && (s.style.touchAction = i);
        }
      }),
      (i._touchActionValue = "none"),
      (i.pointerDown = function (t, e) {
        this.okayPointerDown(t) &&
          ((this.pointerDownPointer = e),
          t.preventDefault(),
          this.pointerDownBlur(),
          this._bindPostStartEvents(t),
          this.emitEvent("pointerDown", [t, e]));
      });
    var s = { TEXTAREA: !0, INPUT: !0, SELECT: !0, OPTION: !0 },
      r = {
        radio: !0,
        checkbox: !0,
        button: !0,
        submit: !0,
        image: !0,
        file: !0,
      };
    return (
      (i.okayPointerDown = function (t) {
        var e = s[t.target.nodeName],
          i = r[t.target.type],
          n = !e || i;
        return n || this._pointerReset(), n;
      }),
      (i.pointerDownBlur = function () {
        var t = document.activeElement;
        t && t.blur && t != document.body && t.blur();
      }),
      (i.pointerMove = function (t, e) {
        var i = this._dragPointerMove(t, e);
        this.emitEvent("pointerMove", [t, e, i]), this._dragMove(t, e, i);
      }),
      (i._dragPointerMove = function (t, e) {
        var i = {
          x: e.pageX - this.pointerDownPointer.pageX,
          y: e.pageY - this.pointerDownPointer.pageY,
        };
        return (
          !this.isDragging && this.hasDragStarted(i) && this._dragStart(t, e), i
        );
      }),
      (i.hasDragStarted = function (t) {
        return 3 < Math.abs(t.x) || 3 < Math.abs(t.y);
      }),
      (i.pointerUp = function (t, e) {
        this.emitEvent("pointerUp", [t, e]), this._dragPointerUp(t, e);
      }),
      (i._dragPointerUp = function (t, e) {
        this.isDragging ? this._dragEnd(t, e) : this._staticClick(t, e);
      }),
      (i._dragStart = function (t, e) {
        (this.isDragging = !0),
          (this.isPreventingClicks = !0),
          this.dragStart(t, e);
      }),
      (i.dragStart = function (t, e) {
        this.emitEvent("dragStart", [t, e]);
      }),
      (i._dragMove = function (t, e, i) {
        this.isDragging && this.dragMove(t, e, i);
      }),
      (i.dragMove = function (t, e, i) {
        t.preventDefault(), this.emitEvent("dragMove", [t, e, i]);
      }),
      (i._dragEnd = function (t, e) {
        (this.isDragging = !1),
          setTimeout(
            function () {
              delete this.isPreventingClicks;
            }.bind(this)
          ),
          this.dragEnd(t, e);
      }),
      (i.dragEnd = function (t, e) {
        this.emitEvent("dragEnd", [t, e]);
      }),
      (i.onclick = function (t) {
        this.isPreventingClicks && t.preventDefault();
      }),
      (i._staticClick = function (t, e) {
        (this.isIgnoringMouseUp && "mouseup" == t.type) ||
          (this.staticClick(t, e),
          "mouseup" != t.type &&
            ((this.isIgnoringMouseUp = !0),
            setTimeout(
              function () {
                delete this.isIgnoringMouseUp;
              }.bind(this),
              400
            )));
      }),
      (i.staticClick = function (t, e) {
        this.emitEvent("staticClick", [t, e]);
      }),
      (e.getPointerPoint = t.getPointerPoint),
      e
    );
  }),
  (function (n, s) {
    "function" == typeof define && define.amd
      ? define(
          "flickity/js/drag",
          ["./flickity", "unidragger/unidragger", "fizzy-ui-utils/utils"],
          function (t, e, i) {
            return s(n, t, e, i);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = s(
          n,
          require("./flickity"),
          require("unidragger"),
          require("fizzy-ui-utils")
        ))
      : (n.Flickity = s(n, n.Flickity, n.Unidragger, n.fizzyUIUtils));
  })(window, function (i, t, e, a) {
    a.extend(t.defaults, { draggable: ">1", dragThreshold: 3 }),
      t.createMethods.push("_createDrag");
    var n = t.prototype;
    a.extend(n, e.prototype), (n._touchActionValue = "pan-y");
    var s = "createTouch" in document,
      o = !1;
    (n._createDrag = function () {
      this.on("activate", this.onActivateDrag),
        this.on("uiChange", this._uiChangeDrag),
        this.on("deactivate", this.onDeactivateDrag),
        this.on("cellChange", this.updateDraggable),
        s && !o && (i.addEventListener("touchmove", function () {}), (o = !0));
    }),
      (n.onActivateDrag = function () {
        (this.handles = [this.viewport]),
          this.bindHandles(),
          this.updateDraggable();
      }),
      (n.onDeactivateDrag = function () {
        this.unbindHandles(), this.element.classList.remove("is-draggable");
      }),
      (n.updateDraggable = function () {
        ">1" == this.options.draggable
          ? (this.isDraggable = 1 < this.slides.length)
          : (this.isDraggable = this.options.draggable),
          this.isDraggable
            ? this.element.classList.add("is-draggable")
            : this.element.classList.remove("is-draggable");
      }),
      (n.bindDrag = function () {
        (this.options.draggable = !0), this.updateDraggable();
      }),
      (n.unbindDrag = function () {
        (this.options.draggable = !1), this.updateDraggable();
      }),
      (n._uiChangeDrag = function () {
        delete this.isFreeScrolling;
      }),
      (n.pointerDown = function (t, e) {
        this.isDraggable
          ? this.okayPointerDown(t) &&
            (this._pointerDownPreventDefault(t),
            this.pointerDownFocus(t),
            document.activeElement != this.element && this.pointerDownBlur(),
            (this.dragX = this.x),
            this.viewport.classList.add("is-pointer-down"),
            (this.pointerDownScroll = l()),
            i.addEventListener("scroll", this),
            this._pointerDownDefault(t, e))
          : this._pointerDownDefault(t, e);
      }),
      (n._pointerDownDefault = function (t, e) {
        (this.pointerDownPointer = { pageX: e.pageX, pageY: e.pageY }),
          this._bindPostStartEvents(t),
          this.dispatchEvent("pointerDown", t, [e]);
      });
    var r = { INPUT: !0, TEXTAREA: !0, SELECT: !0 };
    function l() {
      return { x: i.pageXOffset, y: i.pageYOffset };
    }
    return (
      (n.pointerDownFocus = function (t) {
        r[t.target.nodeName] || this.focus();
      }),
      (n._pointerDownPreventDefault = function (t) {
        var e = "touchstart" == t.type,
          i = "touch" == t.pointerType,
          n = r[t.target.nodeName];
        e || i || n || t.preventDefault();
      }),
      (n.hasDragStarted = function (t) {
        return Math.abs(t.x) > this.options.dragThreshold;
      }),
      (n.pointerUp = function (t, e) {
        delete this.isTouchScrolling,
          this.viewport.classList.remove("is-pointer-down"),
          this.dispatchEvent("pointerUp", t, [e]),
          this._dragPointerUp(t, e);
      }),
      (n.pointerDone = function () {
        i.removeEventListener("scroll", this), delete this.pointerDownScroll;
      }),
      (n.dragStart = function (t, e) {
        this.isDraggable &&
          ((this.dragStartPosition = this.x),
          this.startAnimation(),
          i.removeEventListener("scroll", this),
          this.dispatchEvent("dragStart", t, [e]));
      }),
      (n.pointerMove = function (t, e) {
        var i = this._dragPointerMove(t, e);
        this.dispatchEvent("pointerMove", t, [e, i]), this._dragMove(t, e, i);
      }),
      (n.dragMove = function (t, e, i) {
        if (this.isDraggable) {
          t.preventDefault(), (this.previousDragX = this.dragX);
          var n = this.options.rightToLeft ? -1 : 1;
          this.options.wrapAround && (i.x = i.x % this.slideableWidth);
          var s = this.dragStartPosition + i.x * n;
          if (!this.options.wrapAround && this.slides.length) {
            var o = Math.max(-this.slides[0].target, this.dragStartPosition);
            s = o < s ? 0.5 * (s + o) : s;
            var r = Math.min(
              -this.getLastSlide().target,
              this.dragStartPosition
            );
            s = s < r ? 0.5 * (s + r) : s;
          }
          (this.dragX = s),
            (this.dragMoveTime = new Date()),
            this.dispatchEvent("dragMove", t, [e, i]);
        }
      }),
      (n.dragEnd = function (t, e) {
        if (this.isDraggable) {
          this.options.freeScroll && (this.isFreeScrolling = !0);
          var i = this.dragEndRestingSelect();
          if (this.options.freeScroll && !this.options.wrapAround) {
            var n = this.getRestingPosition();
            this.isFreeScrolling =
              -n > this.slides[0].target && -n < this.getLastSlide().target;
          } else
            this.options.freeScroll ||
              i != this.selectedIndex ||
              (i += this.dragEndBoostSelect());
          delete this.previousDragX,
            (this.isDragSelect = this.options.wrapAround),
            this.select(i),
            delete this.isDragSelect,
            this.dispatchEvent("dragEnd", t, [e]);
        }
      }),
      (n.dragEndRestingSelect = function () {
        var t = this.getRestingPosition(),
          e = Math.abs(this.getSlideDistance(-t, this.selectedIndex)),
          i = this._getClosestResting(t, e, 1),
          n = this._getClosestResting(t, e, -1);
        return i.distance < n.distance ? i.index : n.index;
      }),
      (n._getClosestResting = function (t, e, i) {
        for (
          var n = this.selectedIndex,
            s = 1 / 0,
            o =
              this.options.contain && !this.options.wrapAround
                ? function (t, e) {
                    return t <= e;
                  }
                : function (t, e) {
                    return t < e;
                  };
          o(e, s) &&
          ((n += i), (s = e), null !== (e = this.getSlideDistance(-t, n)));

        )
          e = Math.abs(e);
        return { distance: s, index: n - i };
      }),
      (n.getSlideDistance = function (t, e) {
        var i = this.slides.length,
          n = this.options.wrapAround && 1 < i,
          s = n ? a.modulo(e, i) : e,
          o = this.slides[s];
        if (!o) return null;
        var r = n ? this.slideableWidth * Math.floor(e / i) : 0;
        return t - (o.target + r);
      }),
      (n.dragEndBoostSelect = function () {
        if (
          void 0 === this.previousDragX ||
          !this.dragMoveTime ||
          100 < new Date() - this.dragMoveTime
        )
          return 0;
        var t = this.getSlideDistance(-this.dragX, this.selectedIndex),
          e = this.previousDragX - this.dragX;
        return 0 < t && 0 < e ? 1 : t < 0 && e < 0 ? -1 : 0;
      }),
      (n.staticClick = function (t, e) {
        var i = this.getParentCell(t.target),
          n = i && i.element,
          s = i && this.cells.indexOf(i);
        this.dispatchEvent("staticClick", t, [e, n, s]);
      }),
      (n.onscroll = function () {
        var t = l(),
          e = this.pointerDownScroll.x - t.x,
          i = this.pointerDownScroll.y - t.y;
        (3 < Math.abs(e) || 3 < Math.abs(i)) && this._pointerDone();
      }),
      t
    );
  }),
  (function (n, s) {
    "function" == typeof define && define.amd
      ? define(
          "flickity/js/prev-next-button",
          ["./flickity", "unipointer/unipointer", "fizzy-ui-utils/utils"],
          function (t, e, i) {
            return s(n, t, e, i);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = s(
          n,
          require("./flickity"),
          require("unipointer"),
          require("fizzy-ui-utils")
        ))
      : s(n, n.Flickity, n.Unipointer, n.fizzyUIUtils);
  })(window, function (t, e, i, n) {
    "use strict";
    var s = "http://www.w3.org/2000/svg";
    function o(t, e) {
      (this.direction = t), (this.parent = e), this._create();
    }
    ((o.prototype = Object.create(i.prototype))._create = function () {
      (this.isEnabled = !0), (this.isPrevious = -1 == this.direction);
      var t = this.parent.options.rightToLeft ? 1 : -1;
      this.isLeft = this.direction == t;
      var e = (this.element = document.createElement("button"));
      (e.className = "flickity-button flickity-prev-next-button"),
        (e.className += this.isPrevious ? " previous" : " next"),
        e.setAttribute("type", "button"),
        this.disable(),
        e.setAttribute("aria-label", this.isPrevious ? "Previous" : "Next");
      var i = this.createSVG();
      e.appendChild(i),
        this.parent.on("select", this.update.bind(this)),
        this.on(
          "pointerDown",
          this.parent.childUIPointerDown.bind(this.parent)
        );
    }),
      (o.prototype.activate = function () {
        this.bindStartEvent(this.element),
          this.element.addEventListener("click", this),
          this.parent.element.appendChild(this.element);
      }),
      (o.prototype.deactivate = function () {
        this.parent.element.removeChild(this.element),
          this.unbindStartEvent(this.element),
          this.element.removeEventListener("click", this);
      }),
      (o.prototype.createSVG = function () {
        var t = document.createElementNS(s, "svg");
        t.setAttribute("class", "flickity-button-icon"),
          t.setAttribute("viewBox", "0 0 100 100");
        var e = document.createElementNS(s, "path"),
          i = (function (t) {
            return "string" != typeof t
              ? "M " +
                  t.x0 +
                  ",50 L " +
                  t.x1 +
                  "," +
                  (t.y1 + 50) +
                  " L " +
                  t.x2 +
                  "," +
                  (t.y2 + 50) +
                  " L " +
                  t.x3 +
                  ",50  L " +
                  t.x2 +
                  "," +
                  (50 - t.y2) +
                  " L " +
                  t.x1 +
                  "," +
                  (50 - t.y1) +
                  " Z"
              : t;
          })(this.parent.options.arrowShape);
        return (
          e.setAttribute("d", i),
          e.setAttribute("class", "arrow"),
          this.isLeft ||
            e.setAttribute("transform", "translate(100, 100) rotate(180) "),
          t.appendChild(e),
          t
        );
      }),
      (o.prototype.handleEvent = n.handleEvent),
      (o.prototype.onclick = function () {
        if (this.isEnabled) {
          this.parent.uiChange();
          var t = this.isPrevious ? "previous" : "next";
          this.parent[t]();
        }
      }),
      (o.prototype.enable = function () {
        this.isEnabled || ((this.element.disabled = !1), (this.isEnabled = !0));
      }),
      (o.prototype.disable = function () {
        this.isEnabled && ((this.element.disabled = !0), (this.isEnabled = !1));
      }),
      (o.prototype.update = function () {
        var t = this.parent.slides;
        if (this.parent.options.wrapAround && 1 < t.length) this.enable();
        else {
          var e = t.length ? t.length - 1 : 0,
            i = this.isPrevious ? 0 : e;
          this[this.parent.selectedIndex == i ? "disable" : "enable"]();
        }
      }),
      (o.prototype.destroy = function () {
        this.deactivate(), this.allOff();
      }),
      n.extend(e.defaults, {
        prevNextButtons: !0,
        arrowShape: { x0: 10, x1: 60, y1: 50, x2: 70, y2: 40, x3: 30 },
      }),
      e.createMethods.push("_createPrevNextButtons");
    var r = e.prototype;
    return (
      (r._createPrevNextButtons = function () {
        this.options.prevNextButtons &&
          ((this.prevButton = new o(-1, this)),
          (this.nextButton = new o(1, this)),
          this.on("activate", this.activatePrevNextButtons));
      }),
      (r.activatePrevNextButtons = function () {
        this.prevButton.activate(),
          this.nextButton.activate(),
          this.on("deactivate", this.deactivatePrevNextButtons);
      }),
      (r.deactivatePrevNextButtons = function () {
        this.prevButton.deactivate(),
          this.nextButton.deactivate(),
          this.off("deactivate", this.deactivatePrevNextButtons);
      }),
      (e.PrevNextButton = o),
      e
    );
  }),
  (function (n, s) {
    "function" == typeof define && define.amd
      ? define(
          "flickity/js/page-dots",
          ["./flickity", "unipointer/unipointer", "fizzy-ui-utils/utils"],
          function (t, e, i) {
            return s(n, t, e, i);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = s(
          n,
          require("./flickity"),
          require("unipointer"),
          require("fizzy-ui-utils")
        ))
      : s(n, n.Flickity, n.Unipointer, n.fizzyUIUtils);
  })(window, function (t, e, i, n) {
    function s(t) {
      (this.parent = t), this._create();
    }
    ((s.prototype = Object.create(i.prototype))._create = function () {
      (this.holder = document.createElement("ol")),
        (this.holder.className = "flickity-page-dots"),
        (this.dots = []),
        (this.handleClick = this.onClick.bind(this)),
        this.on(
          "pointerDown",
          this.parent.childUIPointerDown.bind(this.parent)
        );
    }),
      (s.prototype.activate = function () {
        this.setDots(),
          this.holder.addEventListener("click", this.handleClick),
          this.bindStartEvent(this.holder),
          this.parent.element.appendChild(this.holder);
      }),
      (s.prototype.deactivate = function () {
        this.holder.removeEventListener("click", this.handleClick),
          this.unbindStartEvent(this.holder),
          this.parent.element.removeChild(this.holder);
      }),
      (s.prototype.setDots = function () {
        var t = this.parent.slides.length - this.dots.length;
        0 < t ? this.addDots(t) : t < 0 && this.removeDots(-t);
      }),
      (s.prototype.addDots = function (t) {
        for (
          var e = document.createDocumentFragment(),
            i = [],
            n = this.dots.length,
            s = n + t,
            o = n;
          o < s;
          o++
        ) {
          var r = document.createElement("li");
          (r.className = "dot"),
            r.setAttribute("aria-label", "Page dot " + (o + 1)),
            e.appendChild(r),
            i.push(r);
        }
        this.holder.appendChild(e), (this.dots = this.dots.concat(i));
      }),
      (s.prototype.removeDots = function (t) {
        this.dots.splice(this.dots.length - t, t).forEach(function (t) {
          this.holder.removeChild(t);
        }, this);
      }),
      (s.prototype.updateSelected = function () {
        this.selectedDot &&
          ((this.selectedDot.className = "dot"),
          this.selectedDot.removeAttribute("aria-current")),
          this.dots.length &&
            ((this.selectedDot = this.dots[this.parent.selectedIndex]),
            (this.selectedDot.className = "dot is-selected"),
            this.selectedDot.setAttribute("aria-current", "step"));
      }),
      (s.prototype.onTap = s.prototype.onClick =
        function (t) {
          var e = t.target;
          if ("LI" == e.nodeName) {
            this.parent.uiChange();
            var i = this.dots.indexOf(e);
            this.parent.select(i);
          }
        }),
      (s.prototype.destroy = function () {
        this.deactivate(), this.allOff();
      }),
      (e.PageDots = s),
      n.extend(e.defaults, { pageDots: !0 }),
      e.createMethods.push("_createPageDots");
    var o = e.prototype;
    return (
      (o._createPageDots = function () {
        this.options.pageDots &&
          ((this.pageDots = new s(this)),
          this.on("activate", this.activatePageDots),
          this.on("select", this.updateSelectedPageDots),
          this.on("cellChange", this.updatePageDots),
          this.on("resize", this.updatePageDots),
          this.on("deactivate", this.deactivatePageDots));
      }),
      (o.activatePageDots = function () {
        this.pageDots.activate();
      }),
      (o.updateSelectedPageDots = function () {
        this.pageDots.updateSelected();
      }),
      (o.updatePageDots = function () {
        this.pageDots.setDots();
      }),
      (o.deactivatePageDots = function () {
        this.pageDots.deactivate();
      }),
      (e.PageDots = s),
      e
    );
  }),
  (function (t, n) {
    "function" == typeof define && define.amd
      ? define(
          "flickity/js/player",
          ["ev-emitter/ev-emitter", "fizzy-ui-utils/utils", "./flickity"],
          function (t, e, i) {
            return n(t, e, i);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = n(
          require("ev-emitter"),
          require("fizzy-ui-utils"),
          require("./flickity")
        ))
      : n(t.EvEmitter, t.fizzyUIUtils, t.Flickity);
  })(window, function (t, e, i) {
    function n(t) {
      (this.parent = t),
        (this.state = "stopped"),
        (this.onVisibilityChange = this.visibilityChange.bind(this)),
        (this.onVisibilityPlay = this.visibilityPlay.bind(this));
    }
    ((n.prototype = Object.create(t.prototype)).play = function () {
      "playing" != this.state &&
        (document.hidden
          ? document.addEventListener("visibilitychange", this.onVisibilityPlay)
          : ((this.state = "playing"),
            document.addEventListener(
              "visibilitychange",
              this.onVisibilityChange
            ),
            this.tick()));
    }),
      (n.prototype.tick = function () {
        if ("playing" == this.state) {
          var t = this.parent.options.autoPlay;
          t = "number" == typeof t ? t : 3e3;
          var e = this;
          this.clear(),
            (this.timeout = setTimeout(function () {
              e.parent.next(!0), e.tick();
            }, t));
        }
      }),
      (n.prototype.stop = function () {
        (this.state = "stopped"),
          this.clear(),
          document.removeEventListener(
            "visibilitychange",
            this.onVisibilityChange
          );
      }),
      (n.prototype.clear = function () {
        clearTimeout(this.timeout);
      }),
      (n.prototype.pause = function () {
        "playing" == this.state && ((this.state = "paused"), this.clear());
      }),
      (n.prototype.unpause = function () {
        "paused" == this.state && this.play();
      }),
      (n.prototype.visibilityChange = function () {
        this[document.hidden ? "pause" : "unpause"]();
      }),
      (n.prototype.visibilityPlay = function () {
        this.play(),
          document.removeEventListener(
            "visibilitychange",
            this.onVisibilityPlay
          );
      }),
      e.extend(i.defaults, { pauseAutoPlayOnHover: !0 }),
      i.createMethods.push("_createPlayer");
    var s = i.prototype;
    return (
      (s._createPlayer = function () {
        (this.player = new n(this)),
          this.on("activate", this.activatePlayer),
          this.on("uiChange", this.stopPlayer),
          this.on("pointerDown", this.stopPlayer),
          this.on("deactivate", this.deactivatePlayer);
      }),
      (s.activatePlayer = function () {
        this.options.autoPlay &&
          (this.player.play(),
          this.element.addEventListener("mouseenter", this));
      }),
      (s.playPlayer = function () {
        this.player.play();
      }),
      (s.stopPlayer = function () {
        this.player.stop();
      }),
      (s.pausePlayer = function () {
        this.player.pause();
      }),
      (s.unpausePlayer = function () {
        this.player.unpause();
      }),
      (s.deactivatePlayer = function () {
        this.player.stop(),
          this.element.removeEventListener("mouseenter", this);
      }),
      (s.onmouseenter = function () {
        this.options.pauseAutoPlayOnHover &&
          (this.player.pause(),
          this.element.addEventListener("mouseleave", this));
      }),
      (s.onmouseleave = function () {
        this.player.unpause(),
          this.element.removeEventListener("mouseleave", this);
      }),
      (i.Player = n),
      i
    );
  }),
  (function (i, n) {
    "function" == typeof define && define.amd
      ? define(
          "flickity/js/add-remove-cell",
          ["./flickity", "fizzy-ui-utils/utils"],
          function (t, e) {
            return n(i, t, e);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = n(
          i,
          require("./flickity"),
          require("fizzy-ui-utils")
        ))
      : n(i, i.Flickity, i.fizzyUIUtils);
  })(window, function (t, e, n) {
    var i = e.prototype;
    return (
      (i.insert = function (t, e) {
        var i = this._makeCells(t);
        if (i && i.length) {
          var n = this.cells.length;
          e = void 0 === e ? n : e;
          var s = (function (t) {
              var e = document.createDocumentFragment();
              return (
                t.forEach(function (t) {
                  e.appendChild(t.element);
                }),
                e
              );
            })(i),
            o = e == n;
          if (o) this.slider.appendChild(s);
          else {
            var r = this.cells[e].element;
            this.slider.insertBefore(s, r);
          }
          if (0 === e) this.cells = i.concat(this.cells);
          else if (o) this.cells = this.cells.concat(i);
          else {
            var a = this.cells.splice(e, n - e);
            this.cells = this.cells.concat(i).concat(a);
          }
          this._sizeCells(i), this.cellChange(e, !0);
        }
      }),
      (i.append = function (t) {
        this.insert(t, this.cells.length);
      }),
      (i.prepend = function (t) {
        this.insert(t, 0);
      }),
      (i.remove = function (t) {
        var e = this.getCells(t);
        if (e && e.length) {
          var i = this.cells.length - 1;
          e.forEach(function (t) {
            t.remove();
            var e = this.cells.indexOf(t);
            (i = Math.min(e, i)), n.removeFrom(this.cells, t);
          }, this),
            this.cellChange(i, !0);
        }
      }),
      (i.cellSizeChange = function (t) {
        var e = this.getCell(t);
        if (e) {
          e.getSize();
          var i = this.cells.indexOf(e);
          this.cellChange(i);
        }
      }),
      (i.cellChange = function (t, e) {
        var i = this.selectedElement;
        this._positionCells(t),
          this._getWrapShiftCells(),
          this.setGallerySize();
        var n = this.getCell(i);
        n && (this.selectedIndex = this.getCellSlideIndex(n)),
          (this.selectedIndex = Math.min(
            this.slides.length - 1,
            this.selectedIndex
          )),
          this.emitEvent("cellChange", [t]),
          this.select(this.selectedIndex),
          e && this.positionSliderAtSelected();
      }),
      e
    );
  }),
  (function (i, n) {
    "function" == typeof define && define.amd
      ? define(
          "flickity/js/lazyload",
          ["./flickity", "fizzy-ui-utils/utils"],
          function (t, e) {
            return n(i, t, e);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = n(
          i,
          require("./flickity"),
          require("fizzy-ui-utils")
        ))
      : n(i, i.Flickity, i.fizzyUIUtils);
  })(window, function (t, e, o) {
    "use strict";
    e.createMethods.push("_createLazyload");
    var i = e.prototype;
    function s(t, e) {
      (this.img = t), (this.flickity = e), this.load();
    }
    return (
      (i._createLazyload = function () {
        this.on("select", this.lazyLoad);
      }),
      (i.lazyLoad = function () {
        var t = this.options.lazyLoad;
        if (t) {
          var e = "number" == typeof t ? t : 0,
            i = this.getAdjacentCellElements(e),
            n = [];
          i.forEach(function (t) {
            var e = (function (t) {
              if ("IMG" == t.nodeName) {
                var e = t.getAttribute("data-flickity-lazyload"),
                  i = t.getAttribute("data-flickity-lazyload-src"),
                  n = t.getAttribute("data-flickity-lazyload-srcset");
                if (e || i || n) return [t];
              }
              var s = t.querySelectorAll(
                "img[data-flickity-lazyload], img[data-flickity-lazyload-src], img[data-flickity-lazyload-srcset]"
              );
              return o.makeArray(s);
            })(t);
            n = n.concat(e);
          }),
            n.forEach(function (t) {
              new s(t, this);
            }, this);
        }
      }),
      (s.prototype.handleEvent = o.handleEvent),
      (s.prototype.load = function () {
        this.img.addEventListener("load", this),
          this.img.addEventListener("error", this);
        var t =
            this.img.getAttribute("data-flickity-lazyload") ||
            this.img.getAttribute("data-flickity-lazyload-src"),
          e = this.img.getAttribute("data-flickity-lazyload-srcset");
        (this.img.src = t),
          e && this.img.setAttribute("srcset", e),
          this.img.removeAttribute("data-flickity-lazyload"),
          this.img.removeAttribute("data-flickity-lazyload-src"),
          this.img.removeAttribute("data-flickity-lazyload-srcset");
      }),
      (s.prototype.onload = function (t) {
        this.complete(t, "flickity-lazyloaded");
      }),
      (s.prototype.onerror = function (t) {
        this.complete(t, "flickity-lazyerror");
      }),
      (s.prototype.complete = function (t, e) {
        this.img.removeEventListener("load", this),
          this.img.removeEventListener("error", this);
        var i = this.flickity.getParentCell(this.img),
          n = i && i.element;
        this.flickity.cellSizeChange(n),
          this.img.classList.add(e),
          this.flickity.dispatchEvent("lazyLoad", t, n);
      }),
      (e.LazyLoader = s),
      e
    );
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define(
          "flickity/js/index",
          [
            "./flickity",
            "./drag",
            "./prev-next-button",
            "./page-dots",
            "./player",
            "./add-remove-cell",
            "./lazyload",
          ],
          e
        )
      : "object" == typeof module &&
        module.exports &&
        (module.exports = e(
          require("./flickity"),
          require("./drag"),
          require("./prev-next-button"),
          require("./page-dots"),
          require("./player"),
          require("./add-remove-cell"),
          require("./lazyload")
        ));
  })(window, function (t) {
    return t;
  }),
  (function (t, e) {
    "function" == typeof define && define.amd
      ? define(
          "flickity-as-nav-for/as-nav-for",
          ["flickity/js/index", "fizzy-ui-utils/utils"],
          e
        )
      : "object" == typeof module && module.exports
      ? (module.exports = e(require("flickity"), require("fizzy-ui-utils")))
      : (t.Flickity = e(t.Flickity, t.fizzyUIUtils));
  })(window, function (n, s) {
    n.createMethods.push("_createAsNavFor");
    var t = n.prototype;
    return (
      (t._createAsNavFor = function () {
        this.on("activate", this.activateAsNavFor),
          this.on("deactivate", this.deactivateAsNavFor),
          this.on("destroy", this.destroyAsNavFor);
        var t = this.options.asNavFor;
        if (t) {
          var e = this;
          setTimeout(function () {
            e.setNavCompanion(t);
          });
        }
      }),
      (t.setNavCompanion = function (t) {
        t = s.getQueryElement(t);
        var e = n.data(t);
        if (e && e != this) {
          this.navCompanion = e;
          var i = this;
          (this.onNavCompanionSelect = function () {
            i.navCompanionSelect();
          }),
            e.on("select", this.onNavCompanionSelect),
            this.on("staticClick", this.onNavStaticClick),
            this.navCompanionSelect(!0);
        }
      }),
      (t.navCompanionSelect = function (t) {
        var e = this.navCompanion && this.navCompanion.selectedCells;
        if (e) {
          var i = e[0],
            n = this.navCompanion.cells.indexOf(i),
            s = n + e.length - 1,
            o = Math.floor(
              (function (t, e, i) {
                return (e - t) * i + t;
              })(n, s, this.navCompanion.cellAlign)
            );
          if (
            (this.selectCell(o, !1, t),
            this.removeNavSelectedElements(),
            !(o >= this.cells.length))
          ) {
            var r = this.cells.slice(n, 1 + s);
            (this.navSelectedElements = r.map(function (t) {
              return t.element;
            })),
              this.changeNavSelectedClass("add");
          }
        }
      }),
      (t.changeNavSelectedClass = function (e) {
        this.navSelectedElements.forEach(function (t) {
          t.classList[e]("is-nav-selected");
        });
      }),
      (t.activateAsNavFor = function () {
        this.navCompanionSelect(!0);
      }),
      (t.removeNavSelectedElements = function () {
        this.navSelectedElements &&
          (this.changeNavSelectedClass("remove"),
          delete this.navSelectedElements);
      }),
      (t.onNavStaticClick = function (t, e, i, n) {
        "number" == typeof n && this.navCompanion.selectCell(n);
      }),
      (t.deactivateAsNavFor = function () {
        this.removeNavSelectedElements();
      }),
      (t.destroyAsNavFor = function () {
        this.navCompanion &&
          (this.navCompanion.off("select", this.onNavCompanionSelect),
          this.off("staticClick", this.onNavStaticClick),
          delete this.navCompanion);
      }),
      n
    );
  }),
  (function (e, i) {
    "use strict";
    "function" == typeof define && define.amd
      ? define(
          "imagesloaded/imagesloaded",
          ["ev-emitter/ev-emitter"],
          function (t) {
            return i(e, t);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = i(e, require("ev-emitter")))
      : (e.imagesLoaded = i(e, e.EvEmitter));
  })("undefined" != typeof window ? window : this, function (e, t) {
    var s = e.jQuery,
      o = e.console;
    function r(t, e) {
      for (var i in e) t[i] = e[i];
      return t;
    }
    var a = Array.prototype.slice;
    function l(t, e, i) {
      if (!(this instanceof l)) return new l(t, e, i);
      var n = t;
      "string" == typeof t && (n = document.querySelectorAll(t)),
        n
          ? ((this.elements = (function (t) {
              return Array.isArray(t)
                ? t
                : "object" == typeof t && "number" == typeof t.length
                ? a.call(t)
                : [t];
            })(n)),
            (this.options = r({}, this.options)),
            "function" == typeof e ? (i = e) : r(this.options, e),
            i && this.on("always", i),
            this.getImages(),
            s && (this.jqDeferred = new s.Deferred()),
            setTimeout(this.check.bind(this)))
          : o.error("Bad element for imagesLoaded " + (n || t));
    }
    ((l.prototype = Object.create(t.prototype)).options = {}),
      (l.prototype.getImages = function () {
        (this.images = []), this.elements.forEach(this.addElementImages, this);
      }),
      (l.prototype.addElementImages = function (t) {
        "IMG" == t.nodeName && this.addImage(t),
          !0 === this.options.background && this.addElementBackgroundImages(t);
        var e = t.nodeType;
        if (e && h[e]) {
          for (var i = t.querySelectorAll("img"), n = 0; n < i.length; n++) {
            var s = i[n];
            this.addImage(s);
          }
          if ("string" == typeof this.options.background) {
            var o = t.querySelectorAll(this.options.background);
            for (n = 0; n < o.length; n++) {
              var r = o[n];
              this.addElementBackgroundImages(r);
            }
          }
        }
      });
    var h = { 1: !0, 9: !0, 11: !0 };
    function i(t) {
      this.img = t;
    }
    function n(t, e) {
      (this.url = t), (this.element = e), (this.img = new Image());
    }
    return (
      (l.prototype.addElementBackgroundImages = function (t) {
        var e = getComputedStyle(t);
        if (e)
          for (
            var i = /url\((['"])?(.*?)\1\)/gi, n = i.exec(e.backgroundImage);
            null !== n;

          ) {
            var s = n && n[2];
            s && this.addBackground(s, t), (n = i.exec(e.backgroundImage));
          }
      }),
      (l.prototype.addImage = function (t) {
        var e = new i(t);
        this.images.push(e);
      }),
      (l.prototype.addBackground = function (t, e) {
        var i = new n(t, e);
        this.images.push(i);
      }),
      (l.prototype.check = function () {
        var n = this;
        function e(t, e, i) {
          setTimeout(function () {
            n.progress(t, e, i);
          });
        }
        (this.progressedCount = 0),
          (this.hasAnyBroken = !1),
          this.images.length
            ? this.images.forEach(function (t) {
                t.once("progress", e), t.check();
              })
            : this.complete();
      }),
      (l.prototype.progress = function (t, e, i) {
        this.progressedCount++,
          (this.hasAnyBroken = this.hasAnyBroken || !t.isLoaded),
          this.emitEvent("progress", [this, t, e]),
          this.jqDeferred &&
            this.jqDeferred.notify &&
            this.jqDeferred.notify(this, t),
          this.progressedCount == this.images.length && this.complete(),
          this.options.debug && o && o.log("progress: " + i, t, e);
      }),
      (l.prototype.complete = function () {
        var t = this.hasAnyBroken ? "fail" : "done";
        if (
          ((this.isComplete = !0),
          this.emitEvent(t, [this]),
          this.emitEvent("always", [this]),
          this.jqDeferred)
        ) {
          var e = this.hasAnyBroken ? "reject" : "resolve";
          this.jqDeferred[e](this);
        }
      }),
      ((i.prototype = Object.create(t.prototype)).check = function () {
        this.getIsImageComplete()
          ? this.confirm(0 !== this.img.naturalWidth, "naturalWidth")
          : ((this.proxyImage = new Image()),
            this.proxyImage.addEventListener("load", this),
            this.proxyImage.addEventListener("error", this),
            this.img.addEventListener("load", this),
            this.img.addEventListener("error", this),
            (this.proxyImage.src = this.img.src));
      }),
      (i.prototype.getIsImageComplete = function () {
        return this.img.complete && this.img.naturalWidth;
      }),
      (i.prototype.confirm = function (t, e) {
        (this.isLoaded = t), this.emitEvent("progress", [this, this.img, e]);
      }),
      (i.prototype.handleEvent = function (t) {
        var e = "on" + t.type;
        this[e] && this[e](t);
      }),
      (i.prototype.onload = function () {
        this.confirm(!0, "onload"), this.unbindEvents();
      }),
      (i.prototype.onerror = function () {
        this.confirm(!1, "onerror"), this.unbindEvents();
      }),
      (i.prototype.unbindEvents = function () {
        this.proxyImage.removeEventListener("load", this),
          this.proxyImage.removeEventListener("error", this),
          this.img.removeEventListener("load", this),
          this.img.removeEventListener("error", this);
      }),
      ((n.prototype = Object.create(i.prototype)).check = function () {
        this.img.addEventListener("load", this),
          this.img.addEventListener("error", this),
          (this.img.src = this.url),
          this.getIsImageComplete() &&
            (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"),
            this.unbindEvents());
      }),
      (n.prototype.unbindEvents = function () {
        this.img.removeEventListener("load", this),
          this.img.removeEventListener("error", this);
      }),
      (n.prototype.confirm = function (t, e) {
        (this.isLoaded = t),
          this.emitEvent("progress", [this, this.element, e]);
      }),
      (l.makeJQueryPlugin = function (t) {
        (t = t || e.jQuery) &&
          ((s = t).fn.imagesLoaded = function (t, e) {
            return new l(this, t, e).jqDeferred.promise(s(this));
          });
      }),
      l.makeJQueryPlugin(),
      l
    );
  }),
  (function (i, n) {
    "function" == typeof define && define.amd
      ? define(
          ["flickity/js/index", "imagesloaded/imagesloaded"],
          function (t, e) {
            return n(i, t, e);
          }
        )
      : "object" == typeof module && module.exports
      ? (module.exports = n(i, require("flickity"), require("imagesloaded")))
      : (i.Flickity = n(i, i.Flickity, i.imagesLoaded));
  })(window, function (t, e, i) {
    "use strict";
    e.createMethods.push("_createImagesLoaded");
    var n = e.prototype;
    return (
      (n._createImagesLoaded = function () {
        this.on("activate", this.imagesLoaded);
      }),
      (n.imagesLoaded = function () {
        if (this.options.imagesLoaded) {
          var n = this;
          i(this.slider).on("progress", function (t, e) {
            var i = n.getParentCell(e.img);
            n.cellSizeChange(i && i.element),
              n.options.freeScroll || n.positionSliderAtSelected();
          });
        }
      }),
      e
    );
  });

!(function (e, t) {
  "function" == typeof define && define.amd
    ? define(["flickity/js/index", "fizzy-ui-utils/utils"], t)
    : "object" == typeof module && module.exports
    ? (module.exports = t(require("flickity"), require("fizzy-ui-utils")))
    : t(e.Flickity, e.fizzyUIUtils);
})(this, function (e, t) {
  var i = e.Slide,
    s = i.prototype.updateTarget;
  (i.prototype.updateTarget = function () {
    if ((s.apply(this, arguments), this.parent.options.fade)) {
      var e = this.target - this.x,
        t = this.cells[0].x;
      this.cells.forEach(function (i) {
        var s = i.x - t - e;
        i.renderPosition(s);
      });
    }
  }),
    (i.prototype.setOpacity = function (e) {
      this.cells.forEach(function (t) {
        t.element.style.opacity = e;
      });
    });
  var a = e.prototype;
  e.createMethods.push("_createFade"),
    (a._createFade = function () {
      (this.fadeIndex = this.selectedIndex),
        (this.prevSelectedIndex = this.selectedIndex),
        this.on("select", this.onSelectFade),
        this.on("dragEnd", this.onDragEndFade),
        this.on("settle", this.onSettleFade),
        this.on("activate", this.onActivateFade),
        this.on("deactivate", this.onDeactivateFade);
    });
  var n = a.updateSlides;
  (a.updateSlides = function () {
    n.apply(this, arguments),
      this.options.fade &&
        this.slides.forEach(function (e, t) {
          var i = t == this.selectedIndex ? 1 : 0;
          e.setOpacity(i);
        }, this);
  }),
    (a.onSelectFade = function () {
      (this.fadeIndex = Math.min(
        this.prevSelectedIndex,
        this.slides.length - 1
      )),
        (this.prevSelectedIndex = this.selectedIndex);
    }),
    (a.onSettleFade = function () {
      (delete this.didDragEnd, this.options.fade) &&
        (this.selectedSlide.setOpacity(1),
        this.slides[this.fadeIndex] &&
          this.fadeIndex != this.selectedIndex &&
          this.slides[this.fadeIndex].setOpacity(0));
    }),
    (a.onDragEndFade = function () {
      this.didDragEnd = !0;
    }),
    (a.onActivateFade = function () {
      this.options.fade && this.element.classList.add("is-fade");
    }),
    (a.onDeactivateFade = function () {
      this.options.fade &&
        (this.element.classList.remove("is-fade"),
        this.slides.forEach(function (e) {
          e.setOpacity("");
        }));
    });
  var d = a.positionSlider;
  a.positionSlider = function () {
    this.options.fade
      ? (this.fadeSlides(), this.dispatchScrollEvent())
      : d.apply(this, arguments);
  };
  var h = a.positionSliderAtSelected;
  (a.positionSliderAtSelected = function () {
    this.options.fade && this.setTranslateX(0), h.apply(this, arguments);
  }),
    (a.fadeSlides = function () {
      if (!(this.slides.length < 2)) {
        var e = this.getFadeIndexes(),
          t = this.slides[e.a],
          i = this.slides[e.b],
          s = this.wrapDifference(t.target, i.target),
          a = this.wrapDifference(t.target, -this.x);
        (a /= s), t.setOpacity(1 - a), i.setOpacity(a);
        var n = e.a;
        this.isDragging && (n = a > 0.5 ? e.a : e.b),
          null != this.fadeHideIndex &&
            this.fadeHideIndex != n &&
            this.fadeHideIndex != e.a &&
            this.fadeHideIndex != e.b &&
            this.slides[this.fadeHideIndex].setOpacity(0),
          (this.fadeHideIndex = n);
      }
    }),
    (a.getFadeIndexes = function () {
      return this.isDragging || this.didDragEnd
        ? this.options.wrapAround
          ? this.getFadeDragWrapIndexes()
          : this.getFadeDragLimitIndexes()
        : { a: this.fadeIndex, b: this.selectedIndex };
    }),
    (a.getFadeDragWrapIndexes = function () {
      var e = this.slides.map(function (e, t) {
          return this.getSlideDistance(-this.x, t);
        }, this),
        i = e.map(function (e) {
          return Math.abs(e);
        }),
        s = Math.min.apply(Math, i),
        a = i.indexOf(s),
        n = e[a],
        d = this.slides.length,
        h = n >= 0 ? 1 : -1;
      return { a: a, b: t.modulo(a + h, d) };
    }),
    (a.getFadeDragLimitIndexes = function () {
      for (var e = 0, t = 0; t < this.slides.length - 1; t++) {
        var i = this.slides[t];
        if (-this.x < i.target) break;
        e = t;
      }
      return { a: e, b: e + 1 };
    }),
    (a.wrapDifference = function (e, t) {
      var i = t - e;
      if (!this.options.wrapAround) return i;
      var s = i + this.slideableWidth,
        a = i - this.slideableWidth;
      return (
        Math.abs(s) < Math.abs(i) && (i = s),
        Math.abs(a) < Math.abs(i) && (i = a),
        i
      );
    });
  var o = a._getWrapShiftCells;
  a._getWrapShiftCells = function () {
    this.options.fade || o.apply(this, arguments);
  };
  var r = a.shiftWrapCells;
  return (
    (a.shiftWrapCells = function () {
      this.options.fade || r.apply(this, arguments);
    }),
    e
  );
});

!(function (e, t) {
  "function" == typeof define && define.amd
    ? define(["flickity/js/index", "fizzy-ui-utils/utils"], t)
    : "object" == typeof module && module.exports
    ? (module.exports = t(require("flickity"), require("fizzy-ui-utils")))
    : (e.Flickity = t(e.Flickity, e.fizzyUIUtils));
})(window, function (e, t) {
  "use strict";
  e.createMethods.push("_createAsNavFor");
  var i = e.prototype;
  return (
    (i._createAsNavFor = function () {
      this.on("activate", this.activateAsNavFor),
        this.on("deactivate", this.deactivateAsNavFor),
        this.on("destroy", this.destroyAsNavFor);
      var e = this.options.asNavFor;
      if (e) {
        var t = this;
        setTimeout(function () {
          t.setNavCompanion(e);
        });
      }
    }),
    (i.setNavCompanion = function (i) {
      i = t.getQueryElement(i);
      var n = e.data(i);
      if (n && n != this) {
        this.navCompanion = n;
        var a = this;
        (this.onNavCompanionSelect = function () {
          a.navCompanionSelect();
        }),
          n.on("select", this.onNavCompanionSelect),
          this.on("staticClick", this.onNavStaticClick),
          this.navCompanionSelect(!0);
      }
    }),
    (i.navCompanionSelect = function (e) {
      var t = this.navCompanion && this.navCompanion.selectedCells;
      if (t) {
        var i,
          n,
          a,
          o = t[0],
          s = this.navCompanion.cells.indexOf(o),
          c = s + t.length - 1,
          l = Math.floor(
            ((i = s),
            (n = c),
            (a = this.navCompanion.cellAlign),
            (n - i) * a + i)
          );
        if (
          (this.selectCell(l, !1, e),
          this.removeNavSelectedElements(),
          !(l >= this.cells.length))
        ) {
          var v = this.cells.slice(s, c + 1);
          (this.navSelectedElements = v.map(function (e) {
            return e.element;
          })),
            this.changeNavSelectedClass("add");
        }
      }
    }),
    (i.changeNavSelectedClass = function (e) {
      this.navSelectedElements.forEach(function (t) {
        t.classList[e]("is-nav-selected");
      });
    }),
    (i.activateAsNavFor = function () {
      this.navCompanionSelect(!0);
    }),
    (i.removeNavSelectedElements = function () {
      this.navSelectedElements &&
        (this.changeNavSelectedClass("remove"),
        delete this.navSelectedElements);
    }),
    (i.onNavStaticClick = function (e, t, i, n) {
      "number" == typeof n && this.navCompanion.selectCell(n);
    }),
    (i.deactivateAsNavFor = function () {
      this.removeNavSelectedElements();
    }),
    (i.destroyAsNavFor = function () {
      this.navCompanion &&
        (this.navCompanion.off("select", this.onNavCompanionSelect),
        this.off("staticClick", this.onNavStaticClick),
        delete this.navCompanion);
    }),
    e
  );
});

/*
 *  Project: Scrolly : parallax is easy as a matter of fact !
 *  Description: Based on jQuery boilerplate
 *  Author: Victor C. / Octave & Octave web agency
 *  Licence: MIT
 */
!(function (t, i) {
  "function" == typeof define && define.amd
    ? define(["jquery"], i)
    : i(t.jQuery);
})(this, function (t) {
  "use strict";
  function i(i, o) {
    (this.element = i),
      (this.$element = t(this.element)),
      (this.options = t.extend({}, e, o)),
      (this._defaults = e),
      (this._name = s),
      this.init();
  }
  var s = "scrolly",
    e = { bgParallax: !1 };
  (i.prototype.init = function () {
    var i = this;
    (this.startPosition = this.$element.position().top),
      (this.offsetTop = this.$element.offset().top),
      (this.height = this.$element.outerHeight(!0)),
      (this.velocity = this.$element.attr("data-velocity")),
      (this.bgStart = parseInt(this.$element.attr("data-fit"), 10)),
      t(document).scroll(function () {
        i.didScroll = !0;
      }),
      setInterval(function () {
        i.didScroll && ((i.didScroll = !1), i.scrolly());
      }, 10);
  }),
    (i.prototype.scrolly = function () {
      var i = t(window).scrollTop(),
        s = t(window).height(),
        e = this.startPosition;
      this.offsetTop >= i + s
        ? this.$element.addClass("scrolly-invisible")
        : (e = this.$element.hasClass("scrolly-invisible")
            ? this.startPosition + (i + (s - this.offsetTop)) * this.velocity
            : this.startPosition + i * this.velocity),
        this.bgStart && (e += this.bgStart),
        this.options.bgParallax === !0
          ? this.$element.css({ backgroundPositionY: e + "px" })
          : this.$element.css({ top: e });
    }),
    (t.fn[s] = function (e) {
      return this.each(function () {
        t.data(this, "plugin_" + s) ||
          t.data(this, "plugin_" + s, new i(this, e));
      });
    });
});

/*! Magnific Popup - v1.1.0 - 2016-02-20
 * http://dimsemenov.com/plugins/magnific-popup/
 * Copyright (c) 2016 Dmitry Semenov; */
!(function (a) {
  "function" == typeof define && define.amd
    ? define(["jquery"], a)
    : a(
        "object" == typeof exports
          ? require("jquery")
          : window.jQuery || window.Zepto
      );
})(function (a) {
  var b,
    c,
    d,
    e,
    f,
    g,
    h = "Close",
    i = "BeforeClose",
    j = "AfterClose",
    k = "BeforeAppend",
    l = "MarkupParse",
    m = "Open",
    n = "Change",
    o = "mfp",
    p = "." + o,
    q = "mfp-ready",
    r = "mfp-removing",
    s = "mfp-prevent-close",
    t = function () {},
    u = !!window.jQuery,
    v = a(window),
    w = function (a, c) {
      b.ev.on(o + a + p, c);
    },
    x = function (b, c, d, e) {
      var f = document.createElement("div");
      return (
        (f.className = "mfp-" + b),
        d && (f.innerHTML = d),
        e ? c && c.appendChild(f) : ((f = a(f)), c && f.appendTo(c)),
        f
      );
    },
    y = function (c, d) {
      b.ev.triggerHandler(o + c, d),
        b.st.callbacks &&
          ((c = c.charAt(0).toLowerCase() + c.slice(1)),
          b.st.callbacks[c] &&
            b.st.callbacks[c].apply(b, a.isArray(d) ? d : [d]));
    },
    z = function (c) {
      return (
        (c === g && b.currTemplate.closeBtn) ||
          ((b.currTemplate.closeBtn = a(
            b.st.closeMarkup.replace("%title%", b.st.tClose)
          )),
          (g = c)),
        b.currTemplate.closeBtn
      );
    },
    A = function () {
      a.magnificPopup.instance ||
        ((b = new t()), b.init(), (a.magnificPopup.instance = b));
    },
    B = function () {
      var a = document.createElement("p").style,
        b = ["ms", "O", "Moz", "Webkit"];
      if (void 0 !== a.transition) return !0;
      for (; b.length; ) if (b.pop() + "Transition" in a) return !0;
      return !1;
    };
  (t.prototype = {
    constructor: t,
    init: function () {
      var c = navigator.appVersion;
      (b.isLowIE = b.isIE8 = document.all && !document.addEventListener),
        (b.isAndroid = /android/gi.test(c)),
        (b.isIOS = /iphone|ipad|ipod/gi.test(c)),
        (b.supportsTransition = B()),
        (b.probablyMobile =
          b.isAndroid ||
          b.isIOS ||
          /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(
            navigator.userAgent
          )),
        (d = a(document)),
        (b.popupsCache = {});
    },
    open: function (c) {
      var e;
      if (c.isObj === !1) {
        (b.items = c.items.toArray()), (b.index = 0);
        var g,
          h = c.items;
        for (e = 0; e < h.length; e++)
          if (((g = h[e]), g.parsed && (g = g.el[0]), g === c.el[0])) {
            b.index = e;
            break;
          }
      } else
        (b.items = a.isArray(c.items) ? c.items : [c.items]),
          (b.index = c.index || 0);
      if (b.isOpen) return void b.updateItemHTML();
      (b.types = []),
        (f = ""),
        c.mainEl && c.mainEl.length ? (b.ev = c.mainEl.eq(0)) : (b.ev = d),
        c.key
          ? (b.popupsCache[c.key] || (b.popupsCache[c.key] = {}),
            (b.currTemplate = b.popupsCache[c.key]))
          : (b.currTemplate = {}),
        (b.st = a.extend(!0, {}, a.magnificPopup.defaults, c)),
        (b.fixedContentPos =
          "auto" === b.st.fixedContentPos
            ? !b.probablyMobile
            : b.st.fixedContentPos),
        b.st.modal &&
          ((b.st.closeOnContentClick = !1),
          (b.st.closeOnBgClick = !1),
          (b.st.showCloseBtn = !1),
          (b.st.enableEscapeKey = !1)),
        b.bgOverlay ||
          ((b.bgOverlay = x("bg").on("click" + p, function () {
            b.close();
          })),
          (b.wrap = x("wrap")
            .attr("tabindex", -1)
            .on("click" + p, function (a) {
              b._checkIfClose(a.target) && b.close();
            })),
          (b.container = x("container", b.wrap))),
        (b.contentContainer = x("content")),
        b.st.preloader &&
          (b.preloader = x("preloader", b.container, b.st.tLoading));
      var i = a.magnificPopup.modules;
      for (e = 0; e < i.length; e++) {
        var j = i[e];
        (j = j.charAt(0).toUpperCase() + j.slice(1)), b["init" + j].call(b);
      }
      y("BeforeOpen"),
        b.st.showCloseBtn &&
          (b.st.closeBtnInside
            ? (w(l, function (a, b, c, d) {
                c.close_replaceWith = z(d.type);
              }),
              (f += " mfp-close-btn-in"))
            : b.wrap.append(z())),
        b.st.alignTop && (f += " mfp-align-top"),
        b.fixedContentPos
          ? b.wrap.css({
              overflow: b.st.overflowY,
              overflowX: "hidden",
              overflowY: b.st.overflowY,
            })
          : b.wrap.css({ top: v.scrollTop(), position: "absolute" }),
        (b.st.fixedBgPos === !1 ||
          ("auto" === b.st.fixedBgPos && !b.fixedContentPos)) &&
          b.bgOverlay.css({ height: d.height(), position: "absolute" }),
        b.st.enableEscapeKey &&
          d.on("keyup" + p, function (a) {
            27 === a.keyCode && b.close();
          }),
        v.on("resize" + p, function () {
          b.updateSize();
        }),
        b.st.closeOnContentClick || (f += " mfp-auto-cursor"),
        f && b.wrap.addClass(f);
      var k = (b.wH = v.height()),
        n = {};
      if (b.fixedContentPos && b._hasScrollBar(k)) {
        var o = b._getScrollbarSize();
        o && (n.marginRight = o);
      }
      b.fixedContentPos &&
        (b.isIE7
          ? a("body, html").css("overflow", "hidden")
          : (n.overflow = "hidden"));
      var r = b.st.mainClass;
      return (
        b.isIE7 && (r += " mfp-ie7"),
        r && b._addClassToMFP(r),
        b.updateItemHTML(),
        y("BuildControls"),
        a("html").css(n),
        b.bgOverlay.add(b.wrap).prependTo(b.st.prependTo || a(document.body)),
        (b._lastFocusedEl = document.activeElement),
        setTimeout(function () {
          b.content
            ? (b._addClassToMFP(q), b._setFocus())
            : b.bgOverlay.addClass(q),
            d.on("focusin" + p, b._onFocusIn);
        }, 16),
        (b.isOpen = !0),
        b.updateSize(k),
        y(m),
        c
      );
    },
    close: function () {
      b.isOpen &&
        (y(i),
        (b.isOpen = !1),
        b.st.removalDelay && !b.isLowIE && b.supportsTransition
          ? (b._addClassToMFP(r),
            setTimeout(function () {
              b._close();
            }, b.st.removalDelay))
          : b._close());
    },
    _close: function () {
      y(h);
      var c = r + " " + q + " ";
      if (
        (b.bgOverlay.detach(),
        b.wrap.detach(),
        b.container.empty(),
        b.st.mainClass && (c += b.st.mainClass + " "),
        b._removeClassFromMFP(c),
        b.fixedContentPos)
      ) {
        var e = { marginRight: "" };
        b.isIE7 ? a("body, html").css("overflow", "") : (e.overflow = ""),
          a("html").css(e);
      }
      d.off("keyup" + p + " focusin" + p),
        b.ev.off(p),
        b.wrap.attr("class", "mfp-wrap").removeAttr("style"),
        b.bgOverlay.attr("class", "mfp-bg"),
        b.container.attr("class", "mfp-container"),
        !b.st.showCloseBtn ||
          (b.st.closeBtnInside && b.currTemplate[b.currItem.type] !== !0) ||
          (b.currTemplate.closeBtn && b.currTemplate.closeBtn.detach()),
        b.st.autoFocusLast && b._lastFocusedEl && a(b._lastFocusedEl).focus(),
        (b.currItem = null),
        (b.content = null),
        (b.currTemplate = null),
        (b.prevHeight = 0),
        y(j);
    },
    updateSize: function (a) {
      if (b.isIOS) {
        var c = document.documentElement.clientWidth / window.innerWidth,
          d = window.innerHeight * c;
        b.wrap.css("height", d), (b.wH = d);
      } else b.wH = a || v.height();
      b.fixedContentPos || b.wrap.css("height", b.wH), y("Resize");
    },
    updateItemHTML: function () {
      var c = b.items[b.index];
      b.contentContainer.detach(),
        b.content && b.content.detach(),
        c.parsed || (c = b.parseEl(b.index));
      var d = c.type;
      if (
        (y("BeforeChange", [b.currItem ? b.currItem.type : "", d]),
        (b.currItem = c),
        !b.currTemplate[d])
      ) {
        var f = b.st[d] ? b.st[d].markup : !1;
        y("FirstMarkupParse", f),
          f ? (b.currTemplate[d] = a(f)) : (b.currTemplate[d] = !0);
      }
      e && e !== c.type && b.container.removeClass("mfp-" + e + "-holder");
      var g = b["get" + d.charAt(0).toUpperCase() + d.slice(1)](
        c,
        b.currTemplate[d]
      );
      b.appendContent(g, d),
        (c.preloaded = !0),
        y(n, c),
        (e = c.type),
        b.container.prepend(b.contentContainer),
        y("AfterChange");
    },
    appendContent: function (a, c) {
      (b.content = a),
        a
          ? b.st.showCloseBtn && b.st.closeBtnInside && b.currTemplate[c] === !0
            ? b.content.find(".mfp-close").length || b.content.append(z())
            : (b.content = a)
          : (b.content = ""),
        y(k),
        b.container.addClass("mfp-" + c + "-holder"),
        b.contentContainer.append(b.content);
    },
    parseEl: function (c) {
      var d,
        e = b.items[c];
      if (
        (e.tagName
          ? (e = { el: a(e) })
          : ((d = e.type), (e = { data: e, src: e.src })),
        e.el)
      ) {
        for (var f = b.types, g = 0; g < f.length; g++)
          if (e.el.hasClass("mfp-" + f[g])) {
            d = f[g];
            break;
          }
        (e.src = e.el.attr("data-mfp-src")),
          e.src || (e.src = e.el.attr("href"));
      }
      return (
        (e.type = d || b.st.type || "inline"),
        (e.index = c),
        (e.parsed = !0),
        (b.items[c] = e),
        y("ElementParse", e),
        b.items[c]
      );
    },
    addGroup: function (a, c) {
      var d = function (d) {
        (d.mfpEl = this), b._openClick(d, a, c);
      };
      c || (c = {});
      var e = "click.magnificPopup";
      (c.mainEl = a),
        c.items
          ? ((c.isObj = !0), a.off(e).on(e, d))
          : ((c.isObj = !1),
            c.delegate
              ? a.off(e).on(e, c.delegate, d)
              : ((c.items = a), a.off(e).on(e, d)));
    },
    _openClick: function (c, d, e) {
      var f =
        void 0 !== e.midClick ? e.midClick : a.magnificPopup.defaults.midClick;
      if (
        f ||
        !(2 === c.which || c.ctrlKey || c.metaKey || c.altKey || c.shiftKey)
      ) {
        var g =
          void 0 !== e.disableOn
            ? e.disableOn
            : a.magnificPopup.defaults.disableOn;
        if (g)
          if (a.isFunction(g)) {
            if (!g.call(b)) return !0;
          } else if (v.width() < g) return !0;
        c.type && (c.preventDefault(), b.isOpen && c.stopPropagation()),
          (e.el = a(c.mfpEl)),
          e.delegate && (e.items = d.find(e.delegate)),
          b.open(e);
      }
    },
    updateStatus: function (a, d) {
      if (b.preloader) {
        c !== a && b.container.removeClass("mfp-s-" + c),
          d || "loading" !== a || (d = b.st.tLoading);
        var e = { status: a, text: d };
        y("UpdateStatus", e),
          (a = e.status),
          (d = e.text),
          b.preloader.html(d),
          b.preloader.find("a").on("click", function (a) {
            a.stopImmediatePropagation();
          }),
          b.container.addClass("mfp-s-" + a),
          (c = a);
      }
    },
    _checkIfClose: function (c) {
      if (!a(c).hasClass(s)) {
        var d = b.st.closeOnContentClick,
          e = b.st.closeOnBgClick;
        if (d && e) return !0;
        if (
          !b.content ||
          a(c).hasClass("mfp-close") ||
          (b.preloader && c === b.preloader[0])
        )
          return !0;
        if (c === b.content[0] || a.contains(b.content[0], c)) {
          if (d) return !0;
        } else if (e && a.contains(document, c)) return !0;
        return !1;
      }
    },
    _addClassToMFP: function (a) {
      b.bgOverlay.addClass(a), b.wrap.addClass(a);
    },
    _removeClassFromMFP: function (a) {
      this.bgOverlay.removeClass(a), b.wrap.removeClass(a);
    },
    _hasScrollBar: function (a) {
      return (
        (b.isIE7 ? d.height() : document.body.scrollHeight) > (a || v.height())
      );
    },
    _setFocus: function () {
      (b.st.focus ? b.content.find(b.st.focus).eq(0) : b.wrap).focus();
    },
    _onFocusIn: function (c) {
      return c.target === b.wrap[0] || a.contains(b.wrap[0], c.target)
        ? void 0
        : (b._setFocus(), !1);
    },
    _parseMarkup: function (b, c, d) {
      var e;
      d.data && (c = a.extend(d.data, c)),
        y(l, [b, c, d]),
        a.each(c, function (c, d) {
          if (void 0 === d || d === !1) return !0;
          if (((e = c.split("_")), e.length > 1)) {
            var f = b.find(p + "-" + e[0]);
            if (f.length > 0) {
              var g = e[1];
              "replaceWith" === g
                ? f[0] !== d[0] && f.replaceWith(d)
                : "img" === g
                ? f.is("img")
                  ? f.attr("src", d)
                  : f.replaceWith(
                      a("<img>").attr("src", d).attr("class", f.attr("class"))
                    )
                : f.attr(e[1], d);
            }
          } else b.find(p + "-" + c).html(d);
        });
    },
    _getScrollbarSize: function () {
      if (void 0 === b.scrollbarSize) {
        var a = document.createElement("div");
        (a.style.cssText =
          "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;"),
          document.body.appendChild(a),
          (b.scrollbarSize = a.offsetWidth - a.clientWidth),
          document.body.removeChild(a);
      }
      return b.scrollbarSize;
    },
  }),
    (a.magnificPopup = {
      instance: null,
      proto: t.prototype,
      modules: [],
      open: function (b, c) {
        return (
          A(),
          (b = b ? a.extend(!0, {}, b) : {}),
          (b.isObj = !0),
          (b.index = c || 0),
          this.instance.open(b)
        );
      },
      close: function () {
        return a.magnificPopup.instance && a.magnificPopup.instance.close();
      },
      registerModule: function (b, c) {
        c.options && (a.magnificPopup.defaults[b] = c.options),
          a.extend(this.proto, c.proto),
          this.modules.push(b);
      },
      defaults: {
        disableOn: 0,
        key: null,
        midClick: !1,
        mainClass: "",
        preloader: !0,
        focus: "",
        closeOnContentClick: !1,
        closeOnBgClick: !0,
        closeBtnInside: !0,
        showCloseBtn: !0,
        enableEscapeKey: !0,
        modal: !1,
        alignTop: !1,
        removalDelay: 0,
        prependTo: null,
        fixedContentPos: "auto",
        fixedBgPos: "auto",
        overflowY: "auto",
        closeMarkup:
          '<button title="%title%" type="button" class="mfp-close">&#215;</button>',
        tClose: "Close (Esc)",
        tLoading: "Loading...",
        autoFocusLast: !0,
      },
    }),
    (a.fn.magnificPopup = function (c) {
      A();
      var d = a(this);
      if ("string" == typeof c)
        if ("open" === c) {
          var e,
            f = u ? d.data("magnificPopup") : d[0].magnificPopup,
            g = parseInt(arguments[1], 10) || 0;
          f.items
            ? (e = f.items[g])
            : ((e = d), f.delegate && (e = e.find(f.delegate)), (e = e.eq(g))),
            b._openClick({ mfpEl: e }, d, f);
        } else
          b.isOpen && b[c].apply(b, Array.prototype.slice.call(arguments, 1));
      else
        (c = a.extend(!0, {}, c)),
          u ? d.data("magnificPopup", c) : (d[0].magnificPopup = c),
          b.addGroup(d, c);
      return d;
    });
  var C,
    D,
    E,
    F = "inline",
    G = function () {
      E && (D.after(E.addClass(C)).detach(), (E = null));
    };
  a.magnificPopup.registerModule(F, {
    options: {
      hiddenClass: "hide",
      markup: "",
      tNotFound: "Content not found",
    },
    proto: {
      initInline: function () {
        b.types.push(F),
          w(h + "." + F, function () {
            G();
          });
      },
      getInline: function (c, d) {
        if ((G(), c.src)) {
          var e = b.st.inline,
            f = a(c.src);
          if (f.length) {
            var g = f[0].parentNode;
            g &&
              g.tagName &&
              (D || ((C = e.hiddenClass), (D = x(C)), (C = "mfp-" + C)),
              (E = f.after(D).detach().removeClass(C))),
              b.updateStatus("ready");
          } else b.updateStatus("error", e.tNotFound), (f = a("<div>"));
          return (c.inlineElement = f), f;
        }
        return b.updateStatus("ready"), b._parseMarkup(d, {}, c), d;
      },
    },
  });
  var H,
    I = "ajax",
    J = function () {
      H && a(document.body).removeClass(H);
    },
    K = function () {
      J(), b.req && b.req.abort();
    };
  a.magnificPopup.registerModule(I, {
    options: {
      settings: null,
      cursor: "mfp-ajax-cur",
      tError: '<a href="%url%">The content</a> could not be loaded.',
    },
    proto: {
      initAjax: function () {
        b.types.push(I),
          (H = b.st.ajax.cursor),
          w(h + "." + I, K),
          w("BeforeChange." + I, K);
      },
      getAjax: function (c) {
        H && a(document.body).addClass(H), b.updateStatus("loading");
        var d = a.extend(
          {
            url: c.src,
            success: function (d, e, f) {
              var g = { data: d, xhr: f };
              y("ParseAjax", g),
                b.appendContent(a(g.data), I),
                (c.finished = !0),
                J(),
                b._setFocus(),
                setTimeout(function () {
                  b.wrap.addClass(q);
                }, 16),
                b.updateStatus("ready"),
                y("AjaxContentAdded");
            },
            error: function () {
              J(),
                (c.finished = c.loadError = !0),
                b.updateStatus(
                  "error",
                  b.st.ajax.tError.replace("%url%", c.src)
                );
            },
          },
          b.st.ajax.settings
        );
        return (b.req = a.ajax(d)), "";
      },
    },
  });
  var L,
    M = function (c) {
      if (c.data && void 0 !== c.data.title) return c.data.title;
      var d = b.st.image.titleSrc;
      if (d) {
        if (a.isFunction(d)) return d.call(b, c);
        if (c.el) return c.el.attr(d) || "";
      }
      return "";
    };
  a.magnificPopup.registerModule("image", {
    options: {
      markup:
        '<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',
      cursor: "mfp-zoom-out-cur",
      titleSrc: "title",
      verticalFit: !0,
      tError: '<a href="%url%">The image</a> could not be loaded.',
    },
    proto: {
      initImage: function () {
        var c = b.st.image,
          d = ".image";
        b.types.push("image"),
          w(m + d, function () {
            "image" === b.currItem.type &&
              c.cursor &&
              a(document.body).addClass(c.cursor);
          }),
          w(h + d, function () {
            c.cursor && a(document.body).removeClass(c.cursor),
              v.off("resize" + p);
          }),
          w("Resize" + d, b.resizeImage),
          b.isLowIE && w("AfterChange", b.resizeImage);
      },
      resizeImage: function () {
        var a = b.currItem;
        if (a && a.img && b.st.image.verticalFit) {
          var c = 0;
          b.isLowIE &&
            (c =
              parseInt(a.img.css("padding-top"), 10) +
              parseInt(a.img.css("padding-bottom"), 10)),
            a.img.css("max-height", b.wH - c);
        }
      },
      _onImageHasSize: function (a) {
        a.img &&
          ((a.hasSize = !0),
          L && clearInterval(L),
          (a.isCheckingImgSize = !1),
          y("ImageHasSize", a),
          a.imgHidden &&
            (b.content && b.content.removeClass("mfp-loading"),
            (a.imgHidden = !1)));
      },
      findImageSize: function (a) {
        var c = 0,
          d = a.img[0],
          e = function (f) {
            L && clearInterval(L),
              (L = setInterval(function () {
                return d.naturalWidth > 0
                  ? void b._onImageHasSize(a)
                  : (c > 200 && clearInterval(L),
                    c++,
                    void (3 === c
                      ? e(10)
                      : 40 === c
                      ? e(50)
                      : 100 === c && e(500)));
              }, f));
          };
        e(1);
      },
      getImage: function (c, d) {
        var e = 0,
          f = function () {
            c &&
              (c.img[0].complete
                ? (c.img.off(".mfploader"),
                  c === b.currItem &&
                    (b._onImageHasSize(c), b.updateStatus("ready")),
                  (c.hasSize = !0),
                  (c.loaded = !0),
                  y("ImageLoadComplete"))
                : (e++, 200 > e ? setTimeout(f, 100) : g()));
          },
          g = function () {
            c &&
              (c.img.off(".mfploader"),
              c === b.currItem &&
                (b._onImageHasSize(c),
                b.updateStatus("error", h.tError.replace("%url%", c.src))),
              (c.hasSize = !0),
              (c.loaded = !0),
              (c.loadError = !0));
          },
          h = b.st.image,
          i = d.find(".mfp-img");
        if (i.length) {
          var j = document.createElement("img");
          (j.className = "mfp-img"),
            c.el &&
              c.el.find("img").length &&
              (j.alt = c.el.find("img").attr("alt")),
            (c.img = a(j).on("load.mfploader", f).on("error.mfploader", g)),
            (j.src = c.src),
            i.is("img") && (c.img = c.img.clone()),
            (j = c.img[0]),
            j.naturalWidth > 0 ? (c.hasSize = !0) : j.width || (c.hasSize = !1);
        }
        return (
          b._parseMarkup(d, { title: M(c), img_replaceWith: c.img }, c),
          b.resizeImage(),
          c.hasSize
            ? (L && clearInterval(L),
              c.loadError
                ? (d.addClass("mfp-loading"),
                  b.updateStatus("error", h.tError.replace("%url%", c.src)))
                : (d.removeClass("mfp-loading"), b.updateStatus("ready")),
              d)
            : (b.updateStatus("loading"),
              (c.loading = !0),
              c.hasSize ||
                ((c.imgHidden = !0),
                d.addClass("mfp-loading"),
                b.findImageSize(c)),
              d)
        );
      },
    },
  });
  var N,
    O = function () {
      return (
        void 0 === N &&
          (N = void 0 !== document.createElement("p").style.MozTransform),
        N
      );
    };
  a.magnificPopup.registerModule("zoom", {
    options: {
      enabled: !1,
      easing: "ease-in-out",
      duration: 300,
      opener: function (a) {
        return a.is("img") ? a : a.find("img");
      },
    },
    proto: {
      initZoom: function () {
        var a,
          c = b.st.zoom,
          d = ".zoom";
        if (c.enabled && b.supportsTransition) {
          var e,
            f,
            g = c.duration,
            j = function (a) {
              var b = a
                  .clone()
                  .removeAttr("style")
                  .removeAttr("class")
                  .addClass("mfp-animated-image"),
                d = "all " + c.duration / 1e3 + "s " + c.easing,
                e = {
                  position: "fixed",
                  zIndex: 9999,
                  left: 0,
                  top: 0,
                  "-webkit-backface-visibility": "hidden",
                },
                f = "transition";
              return (
                (e["-webkit-" + f] = e["-moz-" + f] = e["-o-" + f] = e[f] = d),
                b.css(e),
                b
              );
            },
            k = function () {
              b.content.css("visibility", "visible");
            };
          w("BuildControls" + d, function () {
            if (b._allowZoom()) {
              if (
                (clearTimeout(e),
                b.content.css("visibility", "hidden"),
                (a = b._getItemToZoom()),
                !a)
              )
                return void k();
              (f = j(a)),
                f.css(b._getOffset()),
                b.wrap.append(f),
                (e = setTimeout(function () {
                  f.css(b._getOffset(!0)),
                    (e = setTimeout(function () {
                      k(),
                        setTimeout(function () {
                          f.remove(), (a = f = null), y("ZoomAnimationEnded");
                        }, 16);
                    }, g));
                }, 16));
            }
          }),
            w(i + d, function () {
              if (b._allowZoom()) {
                if ((clearTimeout(e), (b.st.removalDelay = g), !a)) {
                  if (((a = b._getItemToZoom()), !a)) return;
                  f = j(a);
                }
                f.css(b._getOffset(!0)),
                  b.wrap.append(f),
                  b.content.css("visibility", "hidden"),
                  setTimeout(function () {
                    f.css(b._getOffset());
                  }, 16);
              }
            }),
            w(h + d, function () {
              b._allowZoom() && (k(), f && f.remove(), (a = null));
            });
        }
      },
      _allowZoom: function () {
        return "image" === b.currItem.type;
      },
      _getItemToZoom: function () {
        return b.currItem.hasSize ? b.currItem.img : !1;
      },
      _getOffset: function (c) {
        var d;
        d = c ? b.currItem.img : b.st.zoom.opener(b.currItem.el || b.currItem);
        var e = d.offset(),
          f = parseInt(d.css("padding-top"), 10),
          g = parseInt(d.css("padding-bottom"), 10);
        e.top -= a(window).scrollTop() - f;
        var h = {
          width: d.width(),
          height: (u ? d.innerHeight() : d[0].offsetHeight) - g - f,
        };
        return (
          O()
            ? (h["-moz-transform"] = h.transform =
                "translate(" + e.left + "px," + e.top + "px)")
            : ((h.left = e.left), (h.top = e.top)),
          h
        );
      },
    },
  });
  var P = "iframe",
    Q = "//about:blank",
    R = function (a) {
      if (b.currTemplate[P]) {
        var c = b.currTemplate[P].find("iframe");
        c.length &&
          (a || (c[0].src = Q),
          b.isIE8 && c.css("display", a ? "block" : "none"));
      }
    };
  a.magnificPopup.registerModule(P, {
    options: {
      markup:
        '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',
      srcAction: "iframe_src",
      patterns: {
        youtube: {
          index: "youtube.com",
          id: "v=",
          src: "//www.youtube.com/embed/%id%?autoplay=1",
        },
        vimeo: {
          index: "vimeo.com/",
          id: "/",
          src: "//player.vimeo.com/video/%id%?autoplay=1",
        },
        gmaps: { index: "//maps.google.", src: "%id%&output=embed" },
      },
    },
    proto: {
      initIframe: function () {
        b.types.push(P),
          w("BeforeChange", function (a, b, c) {
            b !== c && (b === P ? R() : c === P && R(!0));
          }),
          w(h + "." + P, function () {
            R();
          });
      },
      getIframe: function (c, d) {
        var e = c.src,
          f = b.st.iframe;
        a.each(f.patterns, function () {
          return e.indexOf(this.index) > -1
            ? (this.id &&
                (e =
                  "string" == typeof this.id
                    ? e.substr(
                        e.lastIndexOf(this.id) + this.id.length,
                        e.length
                      )
                    : this.id.call(this, e)),
              (e = this.src.replace("%id%", e)),
              !1)
            : void 0;
        });
        var g = {};
        return (
          f.srcAction && (g[f.srcAction] = e),
          b._parseMarkup(d, g, c),
          b.updateStatus("ready"),
          d
        );
      },
    },
  });
  var S = function (a) {
      var c = b.items.length;
      return a > c - 1 ? a - c : 0 > a ? c + a : a;
    },
    T = function (a, b, c) {
      return a.replace(/%curr%/gi, b + 1).replace(/%total%/gi, c);
    };
  a.magnificPopup.registerModule("gallery", {
    options: {
      enabled: !1,
      arrowMarkup:
        '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
      preload: [0, 2],
      navigateByImgClick: !0,
      arrows: !0,
      tPrev: "Previous (Left arrow key)",
      tNext: "Next (Right arrow key)",
      tCounter: "%curr% of %total%",
    },
    proto: {
      initGallery: function () {
        var c = b.st.gallery,
          e = ".mfp-gallery";
        return (
          (b.direction = !0),
          c && c.enabled
            ? ((f += " mfp-gallery"),
              w(m + e, function () {
                c.navigateByImgClick &&
                  b.wrap.on("click" + e, ".mfp-img", function () {
                    return b.items.length > 1 ? (b.next(), !1) : void 0;
                  }),
                  d.on("keydown" + e, function (a) {
                    37 === a.keyCode ? b.prev() : 39 === a.keyCode && b.next();
                  });
              }),
              w("UpdateStatus" + e, function (a, c) {
                c.text &&
                  (c.text = T(c.text, b.currItem.index, b.items.length));
              }),
              w(l + e, function (a, d, e, f) {
                var g = b.items.length;
                e.counter = g > 1 ? T(c.tCounter, f.index, g) : "";
              }),
              w("BuildControls" + e, function () {
                if (b.items.length > 1 && c.arrows && !b.arrowLeft) {
                  var d = c.arrowMarkup,
                    e = (b.arrowLeft = a(
                      d.replace(/%title%/gi, c.tPrev).replace(/%dir%/gi, "left")
                    ).addClass(s)),
                    f = (b.arrowRight = a(
                      d
                        .replace(/%title%/gi, c.tNext)
                        .replace(/%dir%/gi, "right")
                    ).addClass(s));
                  e.click(function () {
                    b.prev();
                  }),
                    f.click(function () {
                      b.next();
                    }),
                    b.container.append(e.add(f));
                }
              }),
              w(n + e, function () {
                b._preloadTimeout && clearTimeout(b._preloadTimeout),
                  (b._preloadTimeout = setTimeout(function () {
                    b.preloadNearbyImages(), (b._preloadTimeout = null);
                  }, 16));
              }),
              void w(h + e, function () {
                d.off(e),
                  b.wrap.off("click" + e),
                  (b.arrowRight = b.arrowLeft = null);
              }))
            : !1
        );
      },
      next: function () {
        (b.direction = !0), (b.index = S(b.index + 1)), b.updateItemHTML();
      },
      prev: function () {
        (b.direction = !1), (b.index = S(b.index - 1)), b.updateItemHTML();
      },
      goTo: function (a) {
        (b.direction = a >= b.index), (b.index = a), b.updateItemHTML();
      },
      preloadNearbyImages: function () {
        var a,
          c = b.st.gallery.preload,
          d = Math.min(c[0], b.items.length),
          e = Math.min(c[1], b.items.length);
        for (a = 1; a <= (b.direction ? e : d); a++)
          b._preloadItem(b.index + a);
        for (a = 1; a <= (b.direction ? d : e); a++)
          b._preloadItem(b.index - a);
      },
      _preloadItem: function (c) {
        if (((c = S(c)), !b.items[c].preloaded)) {
          var d = b.items[c];
          d.parsed || (d = b.parseEl(c)),
            y("LazyLoad", d),
            "image" === d.type &&
              (d.img = a('<img class="mfp-img" />')
                .on("load.mfploader", function () {
                  d.hasSize = !0;
                })
                .on("error.mfploader", function () {
                  (d.hasSize = !0), (d.loadError = !0), y("LazyLoadError", d);
                })
                .attr("src", d.src)),
            (d.preloaded = !0);
        }
      },
    },
  });
  var U = "retina";
  a.magnificPopup.registerModule(U, {
    options: {
      replaceSrc: function (a) {
        return a.src.replace(/\.\w+$/, function (a) {
          return "@2x" + a;
        });
      },
      ratio: 1,
    },
    proto: {
      initRetina: function () {
        if (window.devicePixelRatio > 1) {
          var a = b.st.retina,
            c = a.ratio;
          (c = isNaN(c) ? c() : c),
            c > 1 &&
              (w("ImageHasSize." + U, function (a, b) {
                b.img.css({
                  "max-width": b.img[0].naturalWidth / c,
                  width: "100%",
                });
              }),
              w("ElementParse." + U, function (b, d) {
                d.src = a.replaceSrc(d, c);
              }));
        }
      },
    },
  }),
    A();
});
/*! js-cookie v2.2.1 | MIT */
!(function (a) {
  var b;
  if (
    ("function" == typeof define && define.amd && (define(a), (b = !0)),
    "object" == typeof exports && ((module.exports = a()), (b = !0)),
    !b)
  ) {
    var c = window.Cookies,
      d = (window.Cookies = a());
    d.noConflict = function () {
      return (window.Cookies = c), d;
    };
  }
})(function () {
  function a() {
    for (var a = 0, b = {}; a < arguments.length; a++) {
      var c = arguments[a];
      for (var d in c) b[d] = c[d];
    }
    return b;
  }
  function b(a) {
    return a.replace(/(%[0-9A-Z]{2})+/g, decodeURIComponent);
  }
  function c(d) {
    function e() {}
    function f(b, c, f) {
      if ("undefined" != typeof document) {
        (f = a({ path: "/" }, e.defaults, f)),
          "number" == typeof f.expires &&
            (f.expires = new Date(1 * new Date() + 864e5 * f.expires)),
          (f.expires = f.expires ? f.expires.toUTCString() : "");
        try {
          var g = JSON.stringify(c);
          /^[\{\[]/.test(g) && (c = g);
        } catch (j) {}
        (c = d.write
          ? d.write(c, b)
          : encodeURIComponent(c + "").replace(
              /%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,
              decodeURIComponent
            )),
          (b = encodeURIComponent(b + "")
            .replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent)
            .replace(/[\(\)]/g, escape));
        var h = "";
        for (var i in f)
          f[i] &&
            ((h += "; " + i), !0 !== f[i] && (h += "=" + f[i].split(";")[0]));
        return (document.cookie = b + "=" + c + h);
      }
    }
    function g(a, c) {
      if ("undefined" != typeof document) {
        for (
          var e = {},
            f = document.cookie ? document.cookie.split("; ") : [],
            g = 0;
          g < f.length;
          g++
        ) {
          var h = f[g].split("="),
            i = h.slice(1).join("=");
          c || '"' !== i.charAt(0) || (i = i.slice(1, -1));
          try {
            var j = b(h[0]);
            if (((i = (d.read || d)(i, j) || b(i)), c))
              try {
                i = JSON.parse(i);
              } catch (k) {}
            if (((e[j] = i), a === j)) break;
          } catch (k) {}
        }
        return a ? e[a] : e;
      }
    }
    return (
      (e.set = f),
      (e.get = function (a) {
        return g(a, !1);
      }),
      (e.getJSON = function (a) {
        return g(a, !0);
      }),
      (e.remove = function (b, c) {
        f(b, "", a(c, { expires: -1 }));
      }),
      (e.defaults = {}),
      (e.withConverter = c),
      e
    );
  }
  return c(function () {});
});
/**
 * Tweetie: A simple Twitter feed plugin
 * Author: Sonny T. <hi@sonnyt.com>, sonnyt.com
 */
!(function (e) {
  "use strict";
  e.fn.twittie = function () {
    var t = arguments[0] instanceof Object ? arguments[0] : {},
      a = "function" == typeof arguments[0] ? arguments[0] : arguments[1],
      r = e.extend(
        {
          username: null,
          list: null,
          hashtag: null,
          count: 10,
          hideReplies: !1,
          dateFormat: "%b/%d/%Y",
          template: "{{date}} - {{tweet}}",
          apiPath: "api/tweet.php",
          loadingText: "Loading...",
        },
        t
      );
    r.list &&
      !r.username &&
      e.error(
        "If you want to fetch tweets from a list, you must define the username of the list owner."
      );
    var n = function (e) {
        return e
          .replace(
            /(https?:\/\/([-\w\.]+)+(:\d+)?(\/([\w\/_\.]*(\?\S+)?)?)?)/gi,
            '<a href="$1" target="_blank" title="Visit this link">$1</a>'
          )
          .replace(
            /#([a-zA-Z0-9_]+)/g,
            '<a href="https://twitter.com/search?q=%23$1&amp;src=hash" target="_blank" title="Search for #$1">#$1</a>'
          )
          .replace(
            /@([a-zA-Z0-9_]+)/g,
            '<a href="https://twitter.com/$1" target="_blank" title="$1 on Twitter">@$1</a>'
          );
      },
      s = function (e) {
        for (
          var t = e.split(" "),
            a = [
              "January",
              "February",
              "March",
              "April",
              "May",
              "June",
              "July",
              "August",
              "September",
              "October",
              "November",
              "December",
            ],
            n = {
              "%d": (e = new Date(
                Date.parse(
                  t[1] + " " + t[2] + ", " + t[5] + " " + t[3] + " UTC"
                )
              )).getDate(),
              "%m": e.getMonth() + 1,
              "%b": a[e.getMonth()].substr(0, 3),
              "%B": a[e.getMonth()],
              "%y": String(e.getFullYear()).slice(-2),
              "%Y": e.getFullYear(),
            },
            s = r.dateFormat,
            i = r.dateFormat.match(/%[dmbByY]/g),
            u = 0,
            l = i.length;
          u < l;
          u++
        )
          s = s.replace(i[u], n[i[u]]);
        return s;
      },
      i = function (e) {
        for (
          var t = r.template,
            a = [
              "date",
              "tweet",
              "avatar",
              "url",
              "retweeted",
              "screen_name",
              "user_name",
            ],
            n = 0,
            s = a.length;
          n < s;
          n++
        )
          t = t.replace(new RegExp("{{" + a[n] + "}}", "gi"), e[a[n]]);
        return t;
      };
    this.html("<span>" + r.loadingText + "</span>");
    var u = this;
    e.getJSON(
      r.apiPath,
      {
        username: r.username,
        list: r.list,
        hashtag: r.hashtag,
        count: r.count,
        exclude_replies: r.hideReplies,
      },
      function (e) {
        u.find("span").fadeOut("fast", function () {
          u.html("<ul></ul>");
          for (var t = 0; t < r.count; t++) {
            var l = !1;
            if (e[t]) l = e[t];
            else {
              if (void 0 === e.statuses || !e.statuses[t]) break;
              l = e.statuses[t];
            }
            var o = l.user.profile_image_url;
            o.match("^http://") && (o = o.replace("http://", "https://"));
            var c = {
              user_name: l.user.name,
              date: s(l.created_at),
              tweet: l.retweeted
                ? n(
                    "RT @" + l.user.screen_name + ": " + l.retweeted_status.text
                  )
                : n(l.text),
              avatar: '<img src="' + o + '" />',
              url:
                "https://twitter.com/" +
                l.user.screen_name +
                "/status/" +
                l.id_str,
              retweeted: l.retweeted,
              screen_name: n("@" + l.user.screen_name),
            };
            u.find("ul").append("<li>" + i(c) + "</li>");
          }
          "function" == typeof a && a();
        });
      }
    );
  };
})(jQuery);
/*
 * Copyright (C) 2009 Joel Sutherland
 * Licenced under the MIT license
 * http://www.newmediacampaigns.com/page/jquery-flickr-plugin
 */
(function ($) {
  $.fn.jflickrfeed = function (settings, callback) {
    settings = $.extend(
      true,
      {
        flickrbase: "https://api.flickr.com/services/feeds/",
        feedapi: "photos_public.gne",
        limit: 20,
        qstrings: { lang: "en-us", format: "json", jsoncallback: "?" },
        cleanDescription: true,
        useTemplate: true,
        itemTemplate: "",
        itemCallback: function () {},
      },
      settings
    );
    var url = settings.flickrbase + settings.feedapi + "?";
    var first = true;
    for (var key in settings.qstrings) {
      if (!first) url += "&";
      url += key + "=" + settings.qstrings[key];
      first = false;
    }
    return $(this).each(function () {
      var $container = $(this);
      var container = this;
      $.getJSON(url, function (data) {
        $.each(data.items, function (i, item) {
          if (i < settings.limit) {
            if (settings.cleanDescription) {
              var regex = /<p>(.*?)<\/p>/g;
              var input = item.description;
              if (regex.test(input)) {
                item.description = input.match(regex)[2];
                if (item.description != undefined)
                  item.description = item.description
                    .replace("<p>", "")
                    .replace("</p>", "");
              }
            }
            item["image_s"] = item.media.m.replace("_m", "_s");
            item["image_t"] = item.media.m.replace("_m", "_t");
            item["image_m"] = item.media.m.replace("_m", "_m");
            item["image"] = item.media.m.replace("_m", "");
            item["image_b"] = item.media.m.replace("_m", "_b");
            delete item.media;
            if (settings.useTemplate) {
              var template = settings.itemTemplate;
              for (var key in item) {
                var rgx = new RegExp("{{" + key + "}}", "g");
                template = template.replace(rgx, item[key]);
              }
              $container.append(template);
            }
            settings.itemCallback.call(container, item);
          }
        });
        if ($.isFunction(callback)) {
          callback.call(container, data);
        }
      });
    });
  };
})(jQuery);
/* spectragram.js / by Adrian Quevedo */
if (typeof Object.create !== "function") {
  Object.create = function (obj) {
    function F() {}
    F.prototype = obj;
    return new F();
  };
}
(function ($, window, document, undefined) {
  var Instagram = {
    API_URL: "https://graph.instagram.com/me/media?fields=",
    API_FIELDS: "caption,media_url,media_type,permalink,timestamp,username",
    initialize: function (options, elem) {
      this.elem = elem;
      this.$elem = $(elem);
      (this.accessToken = $.fn.spectragram.accessData.accessToken),
        (this.options = $.extend({}, $.fn.spectragram.options, options));
      this.messages = {
        defaultImageAltText: "Instagram Photo",
        notFound: "This user account is private or doesn't have any photos.",
      };
      this.getPhotos();
    },
    getPhotos: function () {
      var self = this;
      self.fetch().done(function (results) {
        if (results.data && results.data.length) {
          self.displayPhotos(results);
        } else if (results.error.message) {
          $.error("Spectragram.js - Error: " + results.error.message);
        } else {
          $.error("Spectragram.js - Error: user does not have photos.");
        }
      });
    },
    fetch: function () {
      var getUrl =
        this.API_URL + this.API_FIELDS + "&access_token=" + this.accessToken;
      return $.ajax({
        type: "GET",
        dataType: "jsonp",
        cache: false,
        url: getUrl,
      });
    },
    displayPhotos: function (results) {
      var $element,
        $image,
        hasCaption,
        isWrapperEmpty,
        isImage,
        imageGroup = [],
        imageCaption,
        max,
        size;
      var sizeChart = { small: 160, medium: 320, large: 640 };
      isWrapperEmpty = $(this.options.wrapEachWith).length === 0;
      max =
        this.options.max >= results.data.length
          ? results.data.length
          : this.options.max;
      size = sizeChart[this.options.size];
      if (results.data === undefined || results.data.length === 0) {
        if (isWrapperEmpty) {
          this.$elem.append(this.messages.notFound);
        } else {
          this.$elem.append(
            $(this.options.wrapEachWith).append(this.messages.notFound)
          );
        }
        return;
      }
      for (var i = 0; i < max; i++) {
        isImage = results.data[i].media_type === "IMAGE";
        if (isImage) {
          hasCaption =
            results.data[i].caption !== null ||
            results.data[i].caption !== undefined;
          imageCaption = hasCaption
            ? $("<span>").text(results.data[i].caption).html()
            : this.messages.defaultImageAltText;
          $image = $("<img>", {
            alt: imageCaption,
            attr: { height: size, width: size },
            src: results.data[i].media_url,
          });
          $element = $("<a>", {
            href: results.data[i].permalink,
            target: "_blank",
            title: imageCaption,
          }).append($image);
          if (isWrapperEmpty) {
            imageGroup.push($element);
          } else {
            imageGroup.push($(this.options.wrapEachWith).append($element));
          }
        }
      }
      this.$elem.append(imageGroup);
      if (typeof this.options.complete === "function") {
        this.options.complete.call(this);
      }
    },
  };
  jQuery.fn.spectragram = function (options) {
    if (jQuery.fn.spectragram.accessData.accessToken) {
      this.each(function () {
        var instagram = Object.create(Instagram);
        instagram.initialize(options, this);
      });
    } else {
      $.error("You must define an accessToken on jQuery.spectragram");
    }
  };
  jQuery.fn.spectragram.options = {
    complete: null,
    max: 25,
    size: "large",
    wrapEachWith: "<li></li>",
  };
  jQuery.fn.spectragram.accessData = { accessToken: null };
})(jQuery, window, document);

/* https://github.com/mhuggins/jquery-countTo */
(function (e) {
  function t(e, t) {
    return e.toFixed(t.decimals);
  }
  e.fn.countTo = function (t) {
    t = t || {};
    return e(this).each(function () {
      function l() {
        a += i;
        u++;
        c(a);
        if (typeof n.onUpdate == "function") {
          n.onUpdate.call(s, a);
        }
        if (u >= r) {
          o.removeData("countTo");
          clearInterval(f.interval);
          a = n.to;
          if (typeof n.onComplete == "function") {
            n.onComplete.call(s, a);
          }
        }
      }
      function c(e) {
        var t = n.formatter.call(s, e, n);
        o.text(t);
      }
      var n = e.extend(
        {},
        e.fn.countTo.defaults,
        {
          from: e(this).data("from"),
          to: e(this).data("to"),
          speed: e(this).data("speed"),
          refreshInterval: e(this).data("refresh-interval"),
          decimals: e(this).data("decimals"),
        },
        t
      );
      var r = Math.ceil(n.speed / n.refreshInterval),
        i = (n.to - n.from) / r;
      var s = this,
        o = e(this),
        u = 0,
        a = n.from,
        f = o.data("countTo") || {};
      o.data("countTo", f);
      if (f.interval) {
        clearInterval(f.interval);
      }
      f.interval = setInterval(l, n.refreshInterval);
      c(a);
    });
  };
  e.fn.countTo.defaults = {
    from: 0,
    to: 0,
    speed: 1e3,
    refreshInterval: 100,
    decimals: 0,
    formatter: t,
    onUpdate: null,
    onComplete: null,
  };
})(jQuery);

/*! Morphext - v2.4.7 - 2016-11-04 */
!(function (a) {
  "use strict";
  function b(b, c) {
    (this.element = a(b)),
      (this.settings = a.extend({}, d, c)),
      (this._defaults = d),
      this._init();
  }
  var c = "Morphext",
    d = { animation: "bounceIn", separator: ",", speed: 2e3, complete: a.noop };
  (b.prototype = {
    _init: function () {
      var b = this;
      (this.phrases = []),
        this.element.addClass("morphext"),
        a.each(
          this.element.text().split(this.settings.separator),
          function (c, d) {
            b.phrases.push(a.trim(d));
          }
        ),
        (this.index = -1),
        this.animate(),
        this.start();
    },
    animate: function () {
      (this.index = ++this.index % this.phrases.length),
        (this.element[0].innerHTML =
          '<span class="animated ' +
          this.settings.animation +
          '">' +
          this.phrases[this.index] +
          "</span>"),
        a.isFunction(this.settings.complete) &&
          this.settings.complete.call(this);
    },
    start: function () {
      var a = this;
      this._interval = setInterval(function () {
        a.animate();
      }, this.settings.speed);
    },
    stop: function () {
      this._interval = clearInterval(this._interval);
    },
  }),
    (a.fn[c] = function (d) {
      return this.each(function () {
        a.data(this, "plugin_" + c) ||
          a.data(this, "plugin_" + c, new b(this, d));
      });
    });
})(jQuery);
/*
 * easy-pie-chart - Lightweight plugin to render simple, animated and retina optimized pie charts - http://robert-fleischmann.de
 */
!(function (a, b) {
  "function" == typeof define && define.amd
    ? define(["jquery"], function (a) {
        return b(a);
      })
    : "object" == typeof exports
    ? (module.exports = b(require("jquery")))
    : b(jQuery);
})(this, function (a) {
  var b = function (a, b) {
      var c,
        d = document.createElement("canvas");
      a.appendChild(d),
        "object" == typeof G_vmlCanvasManager &&
          G_vmlCanvasManager.initElement(d);
      var e = d.getContext("2d");
      d.width = d.height = b.size;
      var f = 1;
      window.devicePixelRatio > 1 &&
        ((f = window.devicePixelRatio),
        (d.style.width = d.style.height = [b.size, "px"].join("")),
        (d.width = d.height = b.size * f),
        e.scale(f, f)),
        e.translate(b.size / 2, b.size / 2),
        e.rotate((-0.5 + b.rotate / 180) * Math.PI);
      var g = (b.size - b.lineWidth) / 2;
      b.scaleColor && b.scaleLength && (g -= b.scaleLength + 2),
        (Date.now =
          Date.now ||
          function () {
            return +new Date();
          });
      var h = function (a, b, c) {
          c = Math.min(Math.max(-1, c || 0), 1);
          var d = 0 >= c ? !0 : !1;
          e.beginPath(),
            e.arc(0, 0, g, 0, 2 * Math.PI * c, d),
            (e.strokeStyle = a),
            (e.lineWidth = b),
            e.stroke();
        },
        i = function () {
          var a, c;
          (e.lineWidth = 1), (e.fillStyle = b.scaleColor), e.save();
          for (var d = 24; d > 0; --d)
            d % 6 === 0
              ? ((c = b.scaleLength), (a = 0))
              : ((c = 0.6 * b.scaleLength), (a = b.scaleLength - c)),
              e.fillRect(-b.size / 2 + a, 0, c, 1),
              e.rotate(Math.PI / 12);
          e.restore();
        },
        j = (function () {
          return (
            window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            function (a) {
              window.setTimeout(a, 1e3 / 60);
            }
          );
        })(),
        k = function () {
          b.scaleColor && i(),
            b.trackColor && h(b.trackColor, b.trackWidth || b.lineWidth, 1);
        };
      (this.getCanvas = function () {
        return d;
      }),
        (this.getCtx = function () {
          return e;
        }),
        (this.clear = function () {
          e.clearRect(b.size / -2, b.size / -2, b.size, b.size);
        }),
        (this.draw = function (a) {
          b.scaleColor || b.trackColor
            ? e.getImageData && e.putImageData
              ? c
                ? e.putImageData(c, 0, 0)
                : (k(), (c = e.getImageData(0, 0, b.size * f, b.size * f)))
              : (this.clear(), k())
            : this.clear(),
            (e.lineCap = b.lineCap);
          var d;
          (d = "function" == typeof b.barColor ? b.barColor(a) : b.barColor),
            h(d, b.lineWidth, a / 100);
        }.bind(this)),
        (this.animate = function (a, c) {
          var d = Date.now();
          b.onStart(a, c);
          var e = function () {
            var f = Math.min(Date.now() - d, b.animate.duration),
              g = b.easing(this, f, a, c - a, b.animate.duration);
            this.draw(g),
              b.onStep(a, c, g),
              f >= b.animate.duration ? b.onStop(a, c) : j(e);
          }.bind(this);
          j(e);
        }.bind(this));
    },
    c = function (a, c) {
      var d = {
        barColor: "#ef1e25",
        trackColor: "#f9f9f9",
        scaleColor: "#dfe0e0",
        scaleLength: 5,
        lineCap: "round",
        lineWidth: 3,
        trackWidth: void 0,
        size: 110,
        rotate: 0,
        animate: { duration: 1e3, enabled: !0 },
        easing: function (a, b, c, d, e) {
          return (
            (b /= e / 2),
            1 > b ? (d / 2) * b * b + c : (-d / 2) * (--b * (b - 2) - 1) + c
          );
        },
        onStart: function (a, b) {},
        onStep: function (a, b, c) {},
        onStop: function (a, b) {},
      };
      if ("undefined" != typeof b) d.renderer = b;
      else {
        if ("undefined" == typeof SVGRenderer)
          throw new Error("Please load either the SVG- or the CanvasRenderer");
        d.renderer = SVGRenderer;
      }
      var e = {},
        f = 0,
        g = function () {
          (this.el = a), (this.options = e);
          for (var b in d)
            d.hasOwnProperty(b) &&
              ((e[b] = c && "undefined" != typeof c[b] ? c[b] : d[b]),
              "function" == typeof e[b] && (e[b] = e[b].bind(this)));
          "string" == typeof e.easing &&
          "undefined" != typeof jQuery &&
          jQuery.isFunction(jQuery.easing[e.easing])
            ? (e.easing = jQuery.easing[e.easing])
            : (e.easing = d.easing),
            "number" == typeof e.animate &&
              (e.animate = { duration: e.animate, enabled: !0 }),
            "boolean" != typeof e.animate ||
              e.animate ||
              (e.animate = { duration: 1e3, enabled: e.animate }),
            (this.renderer = new e.renderer(a, e)),
            this.renderer.draw(f),
            a.dataset && a.dataset.percent
              ? this.update(parseFloat(a.dataset.percent))
              : a.getAttribute &&
                a.getAttribute("data-percent") &&
                this.update(parseFloat(a.getAttribute("data-percent")));
        }.bind(this);
      (this.update = function (a) {
        return (
          (a = parseFloat(a)),
          e.animate.enabled
            ? this.renderer.animate(f, a)
            : this.renderer.draw(a),
          (f = a),
          this
        );
      }.bind(this)),
        (this.disableAnimation = function () {
          return (e.animate.enabled = !1), this;
        }),
        (this.enableAnimation = function () {
          return (e.animate.enabled = !0), this;
        }),
        g();
    };
  a.fn.easyPieChart = function (b) {
    return this.each(function () {
      var d;
      a.data(this, "easyPieChart") ||
        ((d = a.extend({}, b, a(this).data())),
        a.data(this, "easyPieChart", new c(this, d)));
    });
  };
});
/*!
 * The Final Countdown for jQuery v2.2.0 (http://hilios.github.io/jQuery.countdown/)
 * Copyright (c) 2016 Edson Hilios
 */
!(function (a) {
  "use strict";
  "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery);
})(function (a) {
  "use strict";
  function b(a) {
    if (a instanceof Date) return a;
    if (String(a).match(g))
      return (
        String(a).match(/^[0-9]*$/) && (a = Number(a)),
        String(a).match(/\-/) && (a = String(a).replace(/\-/g, "/")),
        new Date(a)
      );
    throw new Error("Couldn't cast `" + a + "` to a date object.");
  }
  function c(a) {
    var b = a.toString().replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1");
    return new RegExp(b);
  }
  function d(a) {
    return function (b) {
      var d = b.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
      if (d)
        for (var f = 0, g = d.length; f < g; ++f) {
          var h = d[f].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),
            j = c(h[0]),
            k = h[1] || "",
            l = h[3] || "",
            m = null;
          (h = h[2]),
            i.hasOwnProperty(h) && ((m = i[h]), (m = Number(a[m]))),
            null !== m &&
              ("!" === k && (m = e(l, m)),
              "" === k && m < 10 && (m = "0" + m.toString()),
              (b = b.replace(j, m.toString())));
        }
      return (b = b.replace(/%%/, "%"));
    };
  }
  function e(a, b) {
    var c = "s",
      d = "";
    return (
      a &&
        ((a = a.replace(/(:|;|\s)/gi, "").split(/\,/)),
        1 === a.length ? (c = a[0]) : ((d = a[0]), (c = a[1]))),
      Math.abs(b) > 1 ? c : d
    );
  }
  var f = [],
    g = [],
    h = { precision: 100, elapse: !1, defer: !1 };
  g.push(/^[0-9]*$/.source),
    g.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),
    g.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),
    (g = new RegExp(g.join("|")));
  var i = {
      Y: "years",
      m: "months",
      n: "daysToMonth",
      d: "daysToWeek",
      w: "weeks",
      W: "weeksToMonth",
      H: "hours",
      M: "minutes",
      S: "seconds",
      D: "totalDays",
      I: "totalHours",
      N: "totalMinutes",
      T: "totalSeconds",
    },
    j = function (b, c, d) {
      (this.el = b),
        (this.$el = a(b)),
        (this.interval = null),
        (this.offset = {}),
        (this.options = a.extend({}, h)),
        (this.firstTick = !0),
        (this.instanceNumber = f.length),
        f.push(this),
        this.$el.data("countdown-instance", this.instanceNumber),
        d &&
          ("function" == typeof d
            ? (this.$el.on("update.countdown", d),
              this.$el.on("stoped.countdown", d),
              this.$el.on("finish.countdown", d))
            : (this.options = a.extend({}, h, d))),
        this.setFinalDate(c),
        this.options.defer === !1 && this.start();
    };
  a.extend(j.prototype, {
    start: function () {
      null !== this.interval && clearInterval(this.interval);
      var a = this;
      this.update(),
        (this.interval = setInterval(function () {
          a.update.call(a);
        }, this.options.precision));
    },
    stop: function () {
      clearInterval(this.interval),
        (this.interval = null),
        this.dispatchEvent("stoped");
    },
    toggle: function () {
      this.interval ? this.stop() : this.start();
    },
    pause: function () {
      this.stop();
    },
    resume: function () {
      this.start();
    },
    remove: function () {
      this.stop.call(this),
        (f[this.instanceNumber] = null),
        delete this.$el.data().countdownInstance;
    },
    setFinalDate: function (a) {
      this.finalDate = b(a);
    },
    update: function () {
      if (0 === this.$el.closest("html").length) return void this.remove();
      var a,
        b = new Date();
      return (
        (a = this.finalDate.getTime() - b.getTime()),
        (a = Math.ceil(a / 1e3)),
        (a = !this.options.elapse && a < 0 ? 0 : Math.abs(a)),
        this.totalSecsLeft === a || this.firstTick
          ? void (this.firstTick = !1)
          : ((this.totalSecsLeft = a),
            (this.elapsed = b >= this.finalDate),
            (this.offset = {
              seconds: this.totalSecsLeft % 60,
              minutes: Math.floor(this.totalSecsLeft / 60) % 60,
              hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
              days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
              daysToWeek: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
              daysToMonth: Math.floor(
                (this.totalSecsLeft / 60 / 60 / 24) % 30.4368
              ),
              weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
              weeksToMonth:
                Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7) % 4,
              months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30.4368),
              years: Math.abs(this.finalDate.getFullYear() - b.getFullYear()),
              totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
              totalHours: Math.floor(this.totalSecsLeft / 60 / 60),
              totalMinutes: Math.floor(this.totalSecsLeft / 60),
              totalSeconds: this.totalSecsLeft,
            }),
            void (this.options.elapse || 0 !== this.totalSecsLeft
              ? this.dispatchEvent("update")
              : (this.stop(), this.dispatchEvent("finish"))))
      );
    },
    dispatchEvent: function (b) {
      var c = a.Event(b + ".countdown");
      (c.finalDate = this.finalDate),
        (c.elapsed = this.elapsed),
        (c.offset = a.extend({}, this.offset)),
        (c.strftime = d(this.offset)),
        this.$el.trigger(c);
    },
  }),
    (a.fn.countdown = function () {
      var b = Array.prototype.slice.call(arguments, 0);
      return this.each(function () {
        var c = a(this).data("countdown-instance");
        if (void 0 !== c) {
          var d = f[c],
            e = b[0];
          j.prototype.hasOwnProperty(e)
            ? d[e].apply(d, b.slice(1))
            : null === String(e).match(/^[$A-Z_][0-9A-Z_$]*$/i)
            ? (d.setFinalDate.call(d, e), d.start())
            : a.error(
                "Method %s does not exist on jQuery.countdown".replace(
                  /\%s/gi,
                  e
                )
              );
        } else new j(this, b[0], b[1]);
      });
    });
});

/*sticky sidebar*/
!(function (i) {
  i.fn.theiaStickySidebar = function (t) {
    function e(t, e) {
      var a = o(t, e);
      a ||
        (console.log(
          "TSS: Body width smaller than options.minWidth. Init is delayed."
        ),
        i(document).on(
          "scroll." + t.namespace,
          (function (t, e) {
            return function (a) {
              var n = o(t, e);
              n && i(this).unbind(a);
            };
          })(t, e)
        ),
        i(window).on(
          "resize." + t.namespace,
          (function (t, e) {
            return function (a) {
              var n = o(t, e);
              n && i(this).unbind(a);
            };
          })(t, e)
        ));
    }
    function o(t, e) {
      return (
        t.initialized === !0 ||
        (!(i("body").width() < t.minWidth) && (a(t, e), !0))
      );
    }
    function a(t, e) {
      t.initialized = !0;
      var o = i("#theia-sticky-sidebar-stylesheet-" + t.namespace);
      0 === o.length &&
        i("head").append(
          i(
            '<style id="theia-sticky-sidebar-stylesheet-' +
              t.namespace +
              '">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>'
          )
        ),
        e.each(function () {
          function e() {
            (a.fixedScrollTop = 0),
              a.sidebar.css({ "min-height": "1px" }),
              a.stickySidebar.css({
                position: "static",
                width: "",
                transform: "none",
              });
          }
          function o(t) {
            var e = t.height();
            return (
              t.children().each(function () {
                e = Math.max(e, i(this).height());
              }),
              e
            );
          }
          var a = {};
          if (
            ((a.sidebar = i(this)),
            (a.options = t || {}),
            (a.container = i(a.options.containerSelector)),
            0 == a.container.length && (a.container = a.sidebar.parent()),
            a.sidebar.parents().css("-webkit-transform", "none"),
            a.sidebar.css({
              position: a.options.defaultPosition,
              overflow: "visible",
              "-webkit-box-sizing": "border-box",
              "-moz-box-sizing": "border-box",
              "box-sizing": "border-box",
            }),
            (a.stickySidebar = a.sidebar.find(".theiaStickySidebar")),
            0 == a.stickySidebar.length)
          ) {
            var s = /(?:text|application)\/(?:x-)?(?:javascript|ecmascript)/i;
            a.sidebar
              .find("script")
              .filter(function (i, t) {
                return 0 === t.type.length || t.type.match(s);
              })
              .remove(),
              (a.stickySidebar = i("<div>")
                .addClass("theiaStickySidebar")
                .append(a.sidebar.children())),
              a.sidebar.append(a.stickySidebar);
          }
          (a.marginBottom = parseInt(a.sidebar.css("margin-bottom"))),
            (a.paddingTop = parseInt(a.sidebar.css("padding-top"))),
            (a.paddingBottom = parseInt(a.sidebar.css("padding-bottom")));
          var r = a.stickySidebar.offset().top,
            d = a.stickySidebar.outerHeight();
          a.stickySidebar.css("padding-top", 1),
            a.stickySidebar.css("padding-bottom", 1),
            (r -= a.stickySidebar.offset().top),
            (d = a.stickySidebar.outerHeight() - d - r),
            0 == r
              ? (a.stickySidebar.css("padding-top", 0),
                (a.stickySidebarPaddingTop = 0))
              : (a.stickySidebarPaddingTop = 1),
            0 == d
              ? (a.stickySidebar.css("padding-bottom", 0),
                (a.stickySidebarPaddingBottom = 0))
              : (a.stickySidebarPaddingBottom = 1),
            (a.previousScrollTop = null),
            (a.fixedScrollTop = 0),
            e(),
            (a.onScroll = function (a) {
              if (a.stickySidebar.is(":visible")) {
                if (i("body").width() < a.options.minWidth) return void e();
                if (a.options.disableOnResponsiveLayouts) {
                  var s = a.sidebar.outerWidth(
                    "none" == a.sidebar.css("float")
                  );
                  if (s + 50 > a.container.width()) return void e();
                }
                var r = i(document).scrollTop(),
                  d = "static";
                if (
                  r >=
                  a.sidebar.offset().top +
                    (a.paddingTop - a.options.additionalMarginTop)
                ) {
                  var c,
                    p = a.paddingTop + t.additionalMarginTop,
                    b =
                      a.paddingBottom +
                      a.marginBottom +
                      t.additionalMarginBottom,
                    l = a.sidebar.offset().top,
                    f = a.sidebar.offset().top + o(a.container),
                    h = 0 + t.additionalMarginTop,
                    g =
                      a.stickySidebar.outerHeight() + p + b <
                      i(window).height();
                  c = g
                    ? h + a.stickySidebar.outerHeight()
                    : i(window).height() -
                      a.marginBottom -
                      a.paddingBottom -
                      t.additionalMarginBottom;
                  var u = l - r + a.paddingTop,
                    S = f - r - a.paddingBottom - a.marginBottom,
                    y = a.stickySidebar.offset().top - r,
                    m = a.previousScrollTop - r;
                  "fixed" == a.stickySidebar.css("position") &&
                    "modern" == a.options.sidebarBehavior &&
                    (y += m),
                    "stick-to-top" == a.options.sidebarBehavior &&
                      (y = t.additionalMarginTop),
                    "stick-to-bottom" == a.options.sidebarBehavior &&
                      (y = c - a.stickySidebar.outerHeight()),
                    (y =
                      m > 0
                        ? Math.min(y, h)
                        : Math.max(y, c - a.stickySidebar.outerHeight())),
                    (y = Math.max(y, u)),
                    (y = Math.min(y, S - a.stickySidebar.outerHeight()));
                  var k = a.container.height() == a.stickySidebar.outerHeight();
                  d =
                    (k || y != h) &&
                    (k || y != c - a.stickySidebar.outerHeight())
                      ? r + y - a.sidebar.offset().top - a.paddingTop <=
                        t.additionalMarginTop
                        ? "static"
                        : "absolute"
                      : "fixed";
                }
                if ("fixed" == d) {
                  var v = i(document).scrollLeft();
                  a.stickySidebar.css({
                    position: "fixed",
                    width: n(a.stickySidebar) + "px",
                    transform: "translateY(" + y + "px)",
                    left:
                      a.sidebar.offset().left +
                      parseInt(a.sidebar.css("padding-left")) -
                      v +
                      "px",
                    top: "0px",
                  });
                } else if ("absolute" == d) {
                  var x = {};
                  "absolute" != a.stickySidebar.css("position") &&
                    ((x.position = "absolute"),
                    (x.transform =
                      "translateY(" +
                      (r +
                        y -
                        a.sidebar.offset().top -
                        a.stickySidebarPaddingTop -
                        a.stickySidebarPaddingBottom) +
                      "px)"),
                    (x.top = "0px")),
                    (x.width = n(a.stickySidebar) + "px"),
                    (x.left = ""),
                    a.stickySidebar.css(x);
                } else "static" == d && e();
                "static" != d &&
                  1 == a.options.updateSidebarHeight &&
                  a.sidebar.css({
                    "min-height":
                      a.stickySidebar.outerHeight() +
                      a.stickySidebar.offset().top -
                      a.sidebar.offset().top +
                      a.paddingBottom,
                  }),
                  (a.previousScrollTop = r);
              }
            }),
            a.onScroll(a),
            i(document).on(
              "scroll." + a.options.namespace,
              (function (i) {
                return function () {
                  i.onScroll(i);
                };
              })(a)
            ),
            i(window).on(
              "resize." + a.options.namespace,
              (function (i) {
                return function () {
                  i.stickySidebar.css({ position: "static" }), i.onScroll(i);
                };
              })(a)
            ),
            "undefined" != typeof ResizeSensor &&
              new ResizeSensor(
                a.stickySidebar[0],
                (function (i) {
                  return function () {
                    i.onScroll(i);
                  };
                })(a)
              );
        });
    }
    function n(i) {
      var t;
      try {
        t = i[0].getBoundingClientRect().width;
      } catch (i) {}
      return "undefined" == typeof t && (t = i.width()), t;
    }
    var s = {
      containerSelector: "",
      additionalMarginTop: 0,
      additionalMarginBottom: 0,
      updateSidebarHeight: !0,
      minWidth: 0,
      disableOnResponsiveLayouts: !0,
      sidebarBehavior: "modern",
      defaultPosition: "relative",
      namespace: "TSS",
    };
    return (
      (t = i.extend(s, t)),
      (t.additionalMarginTop = parseInt(t.additionalMarginTop) || 0),
      (t.additionalMarginBottom = parseInt(t.additionalMarginBottom) || 0),
      e(t, this),
      this
    );
  };
})(jQuery);
/*
 * Project: Bootstrap Notify = v3.1.5
 * Description: Turns standard Bootstrap alerts into "Growl-like" notifications.
 * Author: Mouse0270 aka Robert McIntosh
 * License: MIT License
 * Website: https://github.com/mouse0270/bootstrap-growl
 */
!(function (t) {
  "function" == typeof define && define.amd
    ? define(["jquery"], t)
    : t("object" == typeof exports ? require("jquery") : jQuery);
})(function (t) {
  function s(s) {
    var i = !1;
    return (
      t('[data-notify="container"]').each(function (e, n) {
        var a = t(n),
          o = a.find('[data-notify="title"]').html().trim(),
          r = a.find('[data-notify="message"]').html().trim(),
          l =
            o ===
            t("<div>" + s.settings.content.title + "</div>")
              .html()
              .trim(),
          d =
            r ===
            t("<div>" + s.settings.content.message + "</div>")
              .html()
              .trim(),
          c = a.hasClass("alert-" + s.settings.type);
        return l && d && c && (i = !0), !i;
      }),
      i
    );
  }
  function i(i, n, a) {
    var o = {
      content: {
        message: "object" == typeof n ? n.message : n,
        title: n.title ? n.title : "",
        icon: n.icon ? n.icon : "",
        url: n.url ? n.url : "#",
        target: n.target ? n.target : "-",
      },
    };
    (a = t.extend(!0, {}, o, a)),
      (this.settings = t.extend(!0, {}, e, a)),
      (this._defaults = e),
      "-" === this.settings.content.target &&
        (this.settings.content.target = this.settings.url_target),
      (this.animations = {
        start:
          "webkitAnimationStart oanimationstart MSAnimationStart animationstart",
        end: "webkitAnimationEnd oanimationend MSAnimationEnd animationend",
      }),
      "number" == typeof this.settings.offset &&
        (this.settings.offset = {
          x: this.settings.offset,
          y: this.settings.offset,
        }),
      (this.settings.allow_duplicates ||
        (!this.settings.allow_duplicates && !s(this))) &&
        this.init();
  }
  var e = {
    element: "body",
    position: null,
    type: "info",
    allow_dismiss: !0,
    allow_duplicates: !0,
    newest_on_top: !1,
    showProgressbar: !1,
    placement: { from: "top", align: "right" },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 5e3,
    timer: 1e3,
    url_target: "_blank",
    mouse_over: null,
    animate: { enter: "animated fadeInDown", exit: "animated fadeOutUp" },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    onClick: null,
    icon_type: "class",
    template:
      '<div data-notify="container" class="col-11 col-md-4 alert alert-{0}" role="alert"><button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;</button><span data-notify="icon"></span> <span data-notify="title">{1}</span> <span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="p-progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>',
  };
  (String.format = function () {
    var t = arguments,
      s = arguments[0];
    return s.replace(/(\{\{\d\}\}|\{\d\})/g, function (s) {
      if ("{{" === s.substring(0, 2)) return s;
      var i = parseInt(s.match(/\d/)[0]);
      return t[i + 1];
    });
  }),
    t.extend(i.prototype, {
      init: function () {
        var t = this;
        this.buildNotify(),
          this.settings.content.icon && this.setIcon(),
          "#" != this.settings.content.url && this.styleURL(),
          this.styleDismiss(),
          this.placement(),
          this.bind(),
          (this.notify = {
            $ele: this.$ele,
            update: function (s, i) {
              var e = {};
              "string" == typeof s ? (e[s] = i) : (e = s);
              for (var n in e)
                switch (n) {
                  case "type":
                    this.$ele.removeClass("alert-" + t.settings.type),
                      this.$ele
                        .find('[data-notify="progressbar"] > .progress-bar')
                        .removeClass("p-progress-bar-" + t.settings.type),
                      (t.settings.type = e[n]),
                      this.$ele
                        .addClass("alert-" + e[n])
                        .find('[data-notify="progressbar"] > .progress-bar')
                        .addClass("p-progress-bar-" + e[n]);
                    break;
                  case "icon":
                    var a = this.$ele.find('[data-notify="icon"]');
                    "class" === t.settings.icon_type.toLowerCase()
                      ? a.removeClass(t.settings.content.icon).addClass(e[n])
                      : (a.is("img") || a.find("img"), a.attr("src", e[n])),
                      (t.settings.content.icon = e[s]);
                    break;
                  case "progress":
                    var o = t.settings.delay - t.settings.delay * (e[n] / 100);
                    this.$ele.data("notify-delay", o),
                      this.$ele
                        .find('[data-notify="progressbar"] > div')
                        .attr("aria-valuenow", e[n])
                        .css("width", e[n] + "%");
                    break;
                  case "url":
                    this.$ele.find('[data-notify="url"]').attr("href", e[n]);
                    break;
                  case "target":
                    this.$ele.find('[data-notify="url"]').attr("target", e[n]);
                    break;
                  default:
                    this.$ele.find('[data-notify="' + n + '"]').html(e[n]);
                }
              var r =
                this.$ele.outerHeight() +
                parseInt(t.settings.spacing) +
                parseInt(t.settings.offset.y);
              t.reposition(r);
            },
            close: function () {
              t.close();
            },
          });
      },
      buildNotify: function () {
        var s = this.settings.content;
        (this.$ele = t(
          String.format(
            this.settings.template,
            this.settings.type,
            s.title,
            s.message,
            s.url,
            s.target
          )
        )),
          this.$ele.attr(
            "data-notify-position",
            this.settings.placement.from + "-" + this.settings.placement.align
          ),
          this.settings.allow_dismiss ||
            this.$ele.find('[data-notify="dismiss"]').css("display", "none"),
          ((this.settings.delay <= 0 && !this.settings.showProgressbar) ||
            !this.settings.showProgressbar) &&
            this.$ele.find('[data-notify="progressbar"]').remove();
      },
      setIcon: function () {
        "class" === this.settings.icon_type.toLowerCase()
          ? this.$ele
              .find('[data-notify="icon"]')
              .addClass(this.settings.content.icon)
          : this.$ele.find('[data-notify="icon"]').is("img")
          ? this.$ele
              .find('[data-notify="icon"]')
              .attr("src", this.settings.content.icon)
          : this.$ele
              .find('[data-notify="icon"]')
              .append(
                '<img src="' +
                  this.settings.content.icon +
                  '" alt="Notify Icon" />'
              );
      },
      styleDismiss: function () {
        this.$ele
          .find('[data-notify="dismiss"]')
          .css({
            position: "absolute",
            right: "10px",
            top: "5px",
            zIndex: this.settings.z_index + 2,
          });
      },
      styleURL: function () {
        this.$ele
          .find('[data-notify="url"]')
          .css({
            backgroundImage:
              "url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)",
            height: "100%",
            left: 0,
            position: "absolute",
            top: 0,
            width: "100%",
            zIndex: this.settings.z_index + 1,
          });
      },
      placement: function () {
        var s = this,
          i = this.settings.offset.y,
          e = {
            display: "inline-block",
            margin: "0px auto",
            position: this.settings.position
              ? this.settings.position
              : "body" === this.settings.element
              ? "fixed"
              : "absolute",
            transition: "all .5s ease-in-out",
            zIndex: this.settings.z_index,
          },
          n = !1,
          a = this.settings;
        switch (
          (t(
            '[data-notify-position="' +
              this.settings.placement.from +
              "-" +
              this.settings.placement.align +
              '"]:not([data-closing="true"])'
          ).each(function () {
            i = Math.max(
              i,
              parseInt(t(this).css(a.placement.from)) +
                parseInt(t(this).outerHeight()) +
                parseInt(a.spacing)
            );
          }),
          this.settings.newest_on_top === !0 && (i = this.settings.offset.y),
          (e[this.settings.placement.from] = i + "px"),
          this.settings.placement.align)
        ) {
          case "left":
          case "right":
            e[this.settings.placement.align] = this.settings.offset.x + "px";
            break;
          case "center":
            (e.left = 0), (e.right = 0);
        }
        this.$ele.css(e).addClass(this.settings.animate.enter),
          t.each(Array("webkit-", "moz-", "o-", "ms-", ""), function (t, i) {
            s.$ele[0].style[i + "AnimationIterationCount"] = 1;
          }),
          t(this.settings.element).append(this.$ele),
          this.settings.newest_on_top === !0 &&
            ((i =
              parseInt(i) +
              parseInt(this.settings.spacing) +
              this.$ele.outerHeight()),
            this.reposition(i)),
          t.isFunction(s.settings.onShow) && s.settings.onShow.call(this.$ele),
          this.$ele
            .one(this.animations.start, function () {
              n = !0;
            })
            .one(this.animations.end, function () {
              s.$ele.removeClass(s.settings.animate.enter),
                t.isFunction(s.settings.onShown) &&
                  s.settings.onShown.call(this);
            }),
          setTimeout(function () {
            n ||
              (t.isFunction(s.settings.onShown) &&
                s.settings.onShown.call(this));
          }, 600);
      },
      bind: function () {
        var s = this;
        if (
          (this.$ele.find('[data-notify="dismiss"]').on("click", function () {
            s.close();
          }),
          t.isFunction(s.settings.onClick) &&
            this.$ele.on("click", function (t) {
              t.target != s.$ele.find('[data-notify="dismiss"]')[0] &&
                s.settings.onClick.call(this, t);
            }),
          this.$ele
            .mouseover(function () {
              t(this).data("data-hover", "true");
            })
            .mouseout(function () {
              t(this).data("data-hover", "false");
            }),
          this.$ele.data("data-hover", "false"),
          this.settings.delay > 0)
        ) {
          s.$ele.data("notify-delay", s.settings.delay);
          var i = setInterval(function () {
            var t = parseInt(s.$ele.data("notify-delay")) - s.settings.timer;
            if (
              ("false" === s.$ele.data("data-hover") &&
                "pause" === s.settings.mouse_over) ||
              "pause" != s.settings.mouse_over
            ) {
              var e = ((s.settings.delay - t) / s.settings.delay) * 100;
              s.$ele.data("notify-delay", t),
                s.$ele
                  .find('[data-notify="progressbar"] > div')
                  .attr("aria-valuenow", e)
                  .css("width", e + "%");
            }
            t <= -s.settings.timer && (clearInterval(i), s.close());
          }, s.settings.timer);
        }
      },
      close: function () {
        var s = this,
          i = parseInt(this.$ele.css(this.settings.placement.from)),
          e = !1;
        this.$ele
          .attr("data-closing", "true")
          .addClass(this.settings.animate.exit),
          s.reposition(i),
          t.isFunction(s.settings.onClose) &&
            s.settings.onClose.call(this.$ele),
          this.$ele
            .one(this.animations.start, function () {
              e = !0;
            })
            .one(this.animations.end, function () {
              t(this).remove(),
                t.isFunction(s.settings.onClosed) &&
                  s.settings.onClosed.call(this);
            }),
          setTimeout(function () {
            e ||
              (s.$ele.remove(),
              s.settings.onClosed && s.settings.onClosed(s.$ele));
          }, 600);
      },
      reposition: function (s) {
        var i = this,
          e =
            '[data-notify-position="' +
            this.settings.placement.from +
            "-" +
            this.settings.placement.align +
            '"]:not([data-closing="true"])',
          n = this.$ele.nextAll(e);
        this.settings.newest_on_top === !0 && (n = this.$ele.prevAll(e)),
          n.each(function () {
            t(this).css(i.settings.placement.from, s),
              (s =
                parseInt(s) +
                parseInt(i.settings.spacing) +
                t(this).outerHeight());
          });
      },
    }),
    (t.notify = function (t, s) {
      var e = new i(this, t, s);
      return e.notify;
    }),
    (t.notifyDefaults = function (s) {
      return (e = t.extend(!0, {}, e, s));
    }),
    (t.notifyClose = function (s) {
      "undefined" == typeof s || "all" === s
        ? t("[data-notify]").find('[data-notify="dismiss"]').trigger("click")
        : "success" === s || "info" === s || "warning" === s || "danger" === s
        ? t(".alert-" + s + "[data-notify]")
            .find('[data-notify="dismiss"]')
            .trigger("click")
        : s
        ? t(s + "[data-notify]")
            .find('[data-notify="dismiss"]')
            .trigger("click")
        : t('[data-notify-position="' + s + '"]')
            .find('[data-notify="dismiss"]')
            .trigger("click");
    }),
    (t.notifyCloseExcept = function (s) {
      "success" === s || "info" === s || "warning" === s || "danger" === s
        ? t("[data-notify]")
            .not(".alert-" + s)
            .find('[data-notify="dismiss"]')
            .trigger("click")
        : t("[data-notify]")
            .not(s)
            .find('[data-notify="dismiss"]')
            .trigger("click");
    });
});

/*! lazyload https://github.com/verlok/lazyload */
!(function (t, n) {
  "object" == typeof exports && "undefined" != typeof module
    ? (module.exports = n())
    : "function" == typeof define && define.amd
    ? define(n)
    : ((t = t || self).LazyLoad = n());
})(this, function () {
  "use strict";
  function t() {
    return (t =
      Object.assign ||
      function (t) {
        for (var n = 1; n < arguments.length; n++) {
          var e = arguments[n];
          for (var a in e)
            Object.prototype.hasOwnProperty.call(e, a) && (t[a] = e[a]);
        }
        return t;
      }).apply(this, arguments);
  }
  var n = "undefined" != typeof window,
    e =
      (n && !("onscroll" in window)) ||
      ("undefined" != typeof navigator &&
        /(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent)),
    a = n && "IntersectionObserver" in window,
    o = n && "classList" in document.createElement("p"),
    i = n && window.devicePixelRatio > 1,
    r = {
      elements_selector: "img",
      container: e || n ? document : null,
      threshold: 300,
      thresholds: null,
      data_src: "src",
      data_srcset: "srcset",
      data_sizes: "sizes",
      data_bg: "bg",
      data_bg_hidpi: "bg-hidpi",
      data_bg_multi: "bg-multi",
      data_bg_multi_hidpi: "bg-multi-hidpi",
      data_poster: "poster",
      class_applied: "applied",
      class_loading: "loading",
      class_loaded: "loaded",
      class_error: "error",
      load_delay: 0,
      auto_unobserve: !0,
      callback_enter: null,
      callback_exit: null,
      callback_applied: null,
      callback_loading: null,
      callback_loaded: null,
      callback_error: null,
      callback_finish: null,
      use_native: !1,
    },
    l = function (n) {
      return t({}, r, n);
    },
    c = function (t, n) {
      var e,
        a = new t(n);
      try {
        e = new CustomEvent("LazyLoad::Initialized", {
          detail: { instance: a },
        });
      } catch (t) {
        (e = document.createEvent("CustomEvent")).initCustomEvent(
          "LazyLoad::Initialized",
          !1,
          !1,
          { instance: a }
        );
      }
      window.dispatchEvent(e);
    },
    s = function (t, n) {
      return t.getAttribute("data-" + n);
    },
    u = function (t, n, e) {
      var a = "data-" + n;
      null !== e ? t.setAttribute(a, e) : t.removeAttribute(a);
    },
    d = function (t, n) {
      return u(t, "ll-status", n);
    },
    f = function (t, n) {
      return u(t, "ll-timeout", n);
    },
    _ = function (t) {
      return s(t, "ll-timeout");
    },
    g = function (t, n, e, a) {
      t && (void 0 === a ? (void 0 === e ? t(n) : t(n, e)) : t(n, e, a));
    },
    v = function (t, n) {
      o ? t.classList.add(n) : (t.className += (t.className ? " " : "") + n);
    },
    p = function (t, n) {
      o
        ? t.classList.remove(n)
        : (t.className = t.className
            .replace(new RegExp("(^|\\s+)" + n + "(\\s+|$)"), " ")
            .replace(/^\s+/, "")
            .replace(/\s+$/, ""));
    },
    b = function (t) {
      return t.llTempImage;
    },
    h = function (t) {
      t && (t.loadingCount += 1);
    },
    m = function (t) {
      for (var n, e = [], a = 0; (n = t.children[a]); a += 1)
        "SOURCE" === n.tagName && e.push(n);
      return e;
    },
    y = function (t, n, e) {
      e && t.setAttribute(n, e);
    },
    E = function (t, n) {
      y(t, "sizes", s(t, n.data_sizes)),
        y(t, "srcset", s(t, n.data_srcset)),
        y(t, "src", s(t, n.data_src));
    },
    w = {
      IMG: function (t, n) {
        var e = t.parentNode;
        e &&
          "PICTURE" === e.tagName &&
          m(e).forEach(function (t) {
            E(t, n);
          });
        E(t, n);
      },
      IFRAME: function (t, n) {
        y(t, "src", s(t, n.data_src));
      },
      VIDEO: function (t, n) {
        m(t).forEach(function (t) {
          y(t, "src", s(t, n.data_src));
        }),
          y(t, "poster", s(t, n.data_poster)),
          y(t, "src", s(t, n.data_src)),
          t.load();
      },
    },
    I = function (t, n, e) {
      var a = w[t.tagName];
      a &&
        (a(t, n),
        h(e),
        v(t, n.class_loading),
        d(t, "loading"),
        g(n.callback_loading, t, e),
        g(n.callback_reveal, t, e));
    },
    k = ["IMG", "IFRAME", "VIDEO"],
    L = function (t, n) {
      !n || n.toLoadCount || n.loadingCount || g(t.callback_finish, n);
    },
    C = function (t, n, e) {
      t.addEventListener(n, e);
    },
    A = function (t, n, e) {
      t.removeEventListener(n, e);
    },
    z = function (t, n, e) {
      A(t, "load", n), A(t, "loadeddata", n), A(t, "error", e);
    },
    O = function (t, n, e) {
      !(function (t) {
        delete t.llTempImage;
      })(t),
        (function (t, n) {
          n && (n.loadingCount -= 1);
        })(0, e),
        p(t, n.class_loading);
    },
    N = function (t, n, e) {
      var a = b(t) || t,
        o = function o(r) {
          !(function (t, n, e, a) {
            O(n, e, a),
              v(n, e.class_loaded),
              d(n, "loaded"),
              g(e.callback_loaded, n, a),
              L(e, a);
          })(0, t, n, e),
            z(a, o, i);
        },
        i = function i(r) {
          !(function (t, n, e, a) {
            O(n, e, a),
              v(n, e.class_error),
              d(n, "error"),
              g(e.callback_error, n, a),
              L(e, a);
          })(0, t, n, e),
            z(a, o, i);
        };
      !(function (t, n, e) {
        C(t, "load", n), C(t, "loadeddata", n), C(t, "error", e);
      })(a, o, i);
    },
    x = function (t, n) {
      n && (n.toLoadCount -= 1);
    },
    M = function (t, n, e) {
      !(function (t) {
        t.llTempImage = document.createElement("img");
      })(t),
        N(t, n, e),
        (function (t, n, e) {
          var a = s(t, n.data_bg),
            o = s(t, n.data_bg_hidpi),
            r = i && o ? o : a;
          r &&
            ((t.style.backgroundImage = 'url("'.concat(r, '")')),
            b(t).setAttribute("src", r),
            h(e),
            v(t, n.class_loading),
            d(t, "loading"),
            g(n.callback_loading, t, e),
            g(n.callback_reveal, t, e));
        })(t, n, e),
        (function (t, n, e) {
          var a = s(t, n.data_bg_multi),
            o = s(t, n.data_bg_multi_hidpi),
            r = i && o ? o : a;
          r &&
            ((t.style.backgroundImage = r),
            v(t, n.class_applied),
            d(t, "applied"),
            g(n.callback_applied, t, e));
        })(t, n, e);
    },
    R = function (t, n, e) {
      !(function (t) {
        return k.indexOf(t.tagName) > -1;
      })(t)
        ? M(t, n, e)
        : (function (t, n, e) {
            N(t, n, e), I(t, n, e);
          })(t, n, e),
        x(0, e),
        (function (t, n) {
          if (n) {
            var e = n._observer;
            e && n._settings.auto_unobserve && e.unobserve(t);
          }
        })(t, e),
        L(n, e);
    },
    T = function (t) {
      var n = _(t);
      n && (clearTimeout(n), f(t, null));
    },
    j = function (t, n, e) {
      var a = e._settings;
      g(a.callback_enter, t, n, e),
        a.load_delay
          ? (function (t, n, e) {
              var a = n.load_delay,
                o = _(t);
              o ||
                ((o = setTimeout(function () {
                  R(t, n, e), T(t);
                }, a)),
                f(t, o));
            })(t, a, e)
          : R(t, a, e);
    },
    F = ["IMG", "IFRAME"],
    G = function (t) {
      return t.use_native && "loading" in HTMLImageElement.prototype;
    },
    P = function (t, n, e) {
      t.forEach(function (t) {
        -1 !== F.indexOf(t.tagName) &&
          (t.setAttribute("loading", "lazy"),
          (function (t, n, e) {
            N(t, n, e), I(t, n, e), x(0, e), d(t, "native"), L(n, e);
          })(t, n, e));
      }),
        (e.toLoadCount = 0);
    },
    D = function (t, n) {
      !(function (t) {
        t.disconnect();
      })(t),
        (function (t, n) {
          n.forEach(function (n) {
            t.observe(n), d(n, "observed");
          });
        })(t, n);
    },
    S = function (t) {
      var n;
      a &&
        !G(t._settings) &&
        (t._observer = new IntersectionObserver(
          function (n) {
            n.forEach(function (n) {
              return (function (t) {
                return t.isIntersecting || t.intersectionRatio > 0;
              })(n)
                ? j(n.target, n, t)
                : (function (t, n, e) {
                    var a = e._settings;
                    g(a.callback_exit, t, n, e), a.load_delay && T(t);
                  })(n.target, n, t);
            });
          },
          {
            root: (n = t._settings).container === document ? null : n.container,
            rootMargin: n.thresholds || n.threshold + "px",
          }
        ));
    },
    U = function (t) {
      return Array.prototype.slice.call(t);
    },
    V = function (t) {
      return t.container.querySelectorAll(t.elements_selector);
    },
    $ = function (t) {
      return (
        !(function (t) {
          return null !== s(t, "ll-status");
        })(t) ||
        (function (t) {
          return "observed" === s(t, "ll-status");
        })(t)
      );
    },
    q = function (t) {
      return (function (t) {
        return "error" === s(t, "ll-status");
      })(t);
    },
    H = function (t, n) {
      return (function (t) {
        return U(t).filter($);
      })(t || V(n));
    },
    B = function (t) {
      var n,
        e = t._settings;
      ((n = V(e)), U(n).filter(q)).forEach(function (t) {
        p(t, e.class_error),
          (function (t) {
            u(t, "ll-status", null);
          })(t);
      }),
        t.update();
    },
    J = function (t, e) {
      var a;
      (this._settings = l(t)),
        (this.loadingCount = 0),
        S(this),
        (a = this),
        n &&
          window.addEventListener("online", function (t) {
            B(a);
          }),
        this.update(e);
    };
  return (
    (J.prototype = {
      update: function (t) {
        var n = this._settings,
          o = H(t, n);
        (this.toLoadCount = o.length),
          !e && a
            ? G(n)
              ? P(o, n, this)
              : D(this._observer, o)
            : this.loadAll(o);
      },
      destroy: function () {
        this._observer && this._observer.disconnect(),
          delete this._observer,
          delete this._settings,
          delete this.loadingCount,
          delete this.toLoadCount;
      },
      loadAll: function (t) {
        var n = this,
          e = this._settings;
        H(t, e).forEach(function (t) {
          R(t, e, n);
        });
      },
      load: function (t) {
        R(t, this._settings, this);
      },
    }),
    (J.load = function (t, n) {
      var e = l(n);
      R(t, e);
    }),
    n &&
      (function (t, n) {
        if (n)
          if (n.length) for (var e, a = 0; (e = n[a]); a += 1) c(t, e);
          else c(t, n);
      })(J, window.lazyLoadOptions),
    J
  );
});
/*!
Waypoints - 4.0.1
Copyright © 2011-2016 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/waypoints/blob/master/licenses.txt
*/
!(function () {
  "use strict";
  function t(o) {
    if (!o) throw new Error("No options passed to Waypoint constructor");
    if (!o.element)
      throw new Error("No element option passed to Waypoint constructor");
    if (!o.handler)
      throw new Error("No handler option passed to Waypoint constructor");
    (this.key = "waypoint-" + e),
      (this.options = t.Adapter.extend({}, t.defaults, o)),
      (this.element = this.options.element),
      (this.adapter = new t.Adapter(this.element)),
      (this.callback = o.handler),
      (this.axis = this.options.horizontal ? "horizontal" : "vertical"),
      (this.enabled = this.options.enabled),
      (this.triggerPoint = null),
      (this.group = t.Group.findOrCreate({
        name: this.options.group,
        axis: this.axis,
      })),
      (this.context = t.Context.findOrCreateByElement(this.options.context)),
      t.offsetAliases[this.options.offset] &&
        (this.options.offset = t.offsetAliases[this.options.offset]),
      this.group.add(this),
      this.context.add(this),
      (i[this.key] = this),
      (e += 1);
  }
  var e = 0,
    i = {};
  (t.prototype.queueTrigger = function (t) {
    this.group.queueTrigger(this, t);
  }),
    (t.prototype.trigger = function (t) {
      this.enabled && this.callback && this.callback.apply(this, t);
    }),
    (t.prototype.destroy = function () {
      this.context.remove(this), this.group.remove(this), delete i[this.key];
    }),
    (t.prototype.disable = function () {
      return (this.enabled = !1), this;
    }),
    (t.prototype.enable = function () {
      return this.context.refresh(), (this.enabled = !0), this;
    }),
    (t.prototype.next = function () {
      return this.group.next(this);
    }),
    (t.prototype.previous = function () {
      return this.group.previous(this);
    }),
    (t.invokeAll = function (t) {
      var e = [];
      for (var o in i) e.push(i[o]);
      for (var n = 0, r = e.length; r > n; n++) e[n][t]();
    }),
    (t.destroyAll = function () {
      t.invokeAll("destroy");
    }),
    (t.disableAll = function () {
      t.invokeAll("disable");
    }),
    (t.enableAll = function () {
      t.Context.refreshAll();
      for (var e in i) i[e].enabled = !0;
      return this;
    }),
    (t.refreshAll = function () {
      t.Context.refreshAll();
    }),
    (t.viewportHeight = function () {
      return window.innerHeight || document.documentElement.clientHeight;
    }),
    (t.viewportWidth = function () {
      return document.documentElement.clientWidth;
    }),
    (t.adapters = []),
    (t.defaults = {
      context: window,
      continuous: !0,
      enabled: !0,
      group: "default",
      horizontal: !1,
      offset: 0,
    }),
    (t.offsetAliases = {
      "bottom-in-view": function () {
        return this.context.innerHeight() - this.adapter.outerHeight();
      },
      "right-in-view": function () {
        return this.context.innerWidth() - this.adapter.outerWidth();
      },
    }),
    (window.Waypoint = t);
})(),
  (function () {
    "use strict";
    function t(t) {
      window.setTimeout(t, 1e3 / 60);
    }
    function e(t) {
      (this.element = t),
        (this.Adapter = n.Adapter),
        (this.adapter = new this.Adapter(t)),
        (this.key = "waypoint-context-" + i),
        (this.didScroll = !1),
        (this.didResize = !1),
        (this.oldScroll = {
          x: this.adapter.scrollLeft(),
          y: this.adapter.scrollTop(),
        }),
        (this.waypoints = { vertical: {}, horizontal: {} }),
        (t.waypointContextKey = this.key),
        (o[t.waypointContextKey] = this),
        (i += 1),
        n.windowContext ||
          ((n.windowContext = !0), (n.windowContext = new e(window))),
        this.createThrottledScrollHandler(),
        this.createThrottledResizeHandler();
    }
    var i = 0,
      o = {},
      n = window.Waypoint,
      r = window.onload;
    (e.prototype.add = function (t) {
      var e = t.options.horizontal ? "horizontal" : "vertical";
      (this.waypoints[e][t.key] = t), this.refresh();
    }),
      (e.prototype.checkEmpty = function () {
        var t = this.Adapter.isEmptyObject(this.waypoints.horizontal),
          e = this.Adapter.isEmptyObject(this.waypoints.vertical),
          i = this.element == this.element.window;
        t && e && !i && (this.adapter.off(".waypoints"), delete o[this.key]);
      }),
      (e.prototype.createThrottledResizeHandler = function () {
        function t() {
          e.handleResize(), (e.didResize = !1);
        }
        var e = this;
        this.adapter.on("resize.waypoints", function () {
          e.didResize || ((e.didResize = !0), n.requestAnimationFrame(t));
        });
      }),
      (e.prototype.createThrottledScrollHandler = function () {
        function t() {
          e.handleScroll(), (e.didScroll = !1);
        }
        var e = this;
        this.adapter.on("scroll.waypoints", function () {
          (!e.didScroll || n.isTouch) &&
            ((e.didScroll = !0), n.requestAnimationFrame(t));
        });
      }),
      (e.prototype.handleResize = function () {
        n.Context.refreshAll();
      }),
      (e.prototype.handleScroll = function () {
        var t = {},
          e = {
            horizontal: {
              newScroll: this.adapter.scrollLeft(),
              oldScroll: this.oldScroll.x,
              forward: "right",
              backward: "left",
            },
            vertical: {
              newScroll: this.adapter.scrollTop(),
              oldScroll: this.oldScroll.y,
              forward: "down",
              backward: "up",
            },
          };
        for (var i in e) {
          var o = e[i],
            n = o.newScroll > o.oldScroll,
            r = n ? o.forward : o.backward;
          for (var s in this.waypoints[i]) {
            var a = this.waypoints[i][s];
            if (null !== a.triggerPoint) {
              var l = o.oldScroll < a.triggerPoint,
                h = o.newScroll >= a.triggerPoint,
                p = l && h,
                u = !l && !h;
              (p || u) && (a.queueTrigger(r), (t[a.group.id] = a.group));
            }
          }
        }
        for (var c in t) t[c].flushTriggers();
        this.oldScroll = { x: e.horizontal.newScroll, y: e.vertical.newScroll };
      }),
      (e.prototype.innerHeight = function () {
        return this.element == this.element.window
          ? n.viewportHeight()
          : this.adapter.innerHeight();
      }),
      (e.prototype.remove = function (t) {
        delete this.waypoints[t.axis][t.key], this.checkEmpty();
      }),
      (e.prototype.innerWidth = function () {
        return this.element == this.element.window
          ? n.viewportWidth()
          : this.adapter.innerWidth();
      }),
      (e.prototype.destroy = function () {
        var t = [];
        for (var e in this.waypoints)
          for (var i in this.waypoints[e]) t.push(this.waypoints[e][i]);
        for (var o = 0, n = t.length; n > o; o++) t[o].destroy();
      }),
      (e.prototype.refresh = function () {
        var t,
          e = this.element == this.element.window,
          i = e ? void 0 : this.adapter.offset(),
          o = {};
        this.handleScroll(),
          (t = {
            horizontal: {
              contextOffset: e ? 0 : i.left,
              contextScroll: e ? 0 : this.oldScroll.x,
              contextDimension: this.innerWidth(),
              oldScroll: this.oldScroll.x,
              forward: "right",
              backward: "left",
              offsetProp: "left",
            },
            vertical: {
              contextOffset: e ? 0 : i.top,
              contextScroll: e ? 0 : this.oldScroll.y,
              contextDimension: this.innerHeight(),
              oldScroll: this.oldScroll.y,
              forward: "down",
              backward: "up",
              offsetProp: "top",
            },
          });
        for (var r in t) {
          var s = t[r];
          for (var a in this.waypoints[r]) {
            var l,
              h,
              p,
              u,
              c,
              d = this.waypoints[r][a],
              f = d.options.offset,
              w = d.triggerPoint,
              y = 0,
              g = null == w;
            d.element !== d.element.window &&
              (y = d.adapter.offset()[s.offsetProp]),
              "function" == typeof f
                ? (f = f.apply(d))
                : "string" == typeof f &&
                  ((f = parseFloat(f)),
                  d.options.offset.indexOf("%") > -1 &&
                    (f = Math.ceil((s.contextDimension * f) / 100))),
              (l = s.contextScroll - s.contextOffset),
              (d.triggerPoint = Math.floor(y + l - f)),
              (h = w < s.oldScroll),
              (p = d.triggerPoint >= s.oldScroll),
              (u = h && p),
              (c = !h && !p),
              !g && u
                ? (d.queueTrigger(s.backward), (o[d.group.id] = d.group))
                : !g && c
                ? (d.queueTrigger(s.forward), (o[d.group.id] = d.group))
                : g &&
                  s.oldScroll >= d.triggerPoint &&
                  (d.queueTrigger(s.forward), (o[d.group.id] = d.group));
          }
        }
        return (
          n.requestAnimationFrame(function () {
            for (var t in o) o[t].flushTriggers();
          }),
          this
        );
      }),
      (e.findOrCreateByElement = function (t) {
        return e.findByElement(t) || new e(t);
      }),
      (e.refreshAll = function () {
        for (var t in o) o[t].refresh();
      }),
      (e.findByElement = function (t) {
        return o[t.waypointContextKey];
      }),
      (window.onload = function () {
        r && r(), e.refreshAll();
      }),
      (n.requestAnimationFrame = function (e) {
        var i =
          window.requestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          window.webkitRequestAnimationFrame ||
          t;
        i.call(window, e);
      }),
      (n.Context = e);
  })(),
  (function () {
    "use strict";
    function t(t, e) {
      return t.triggerPoint - e.triggerPoint;
    }
    function e(t, e) {
      return e.triggerPoint - t.triggerPoint;
    }
    function i(t) {
      (this.name = t.name),
        (this.axis = t.axis),
        (this.id = this.name + "-" + this.axis),
        (this.waypoints = []),
        this.clearTriggerQueues(),
        (o[this.axis][this.name] = this);
    }
    var o = { vertical: {}, horizontal: {} },
      n = window.Waypoint;
    (i.prototype.add = function (t) {
      this.waypoints.push(t);
    }),
      (i.prototype.clearTriggerQueues = function () {
        this.triggerQueues = { up: [], down: [], left: [], right: [] };
      }),
      (i.prototype.flushTriggers = function () {
        for (var i in this.triggerQueues) {
          var o = this.triggerQueues[i],
            n = "up" === i || "left" === i;
          o.sort(n ? e : t);
          for (var r = 0, s = o.length; s > r; r += 1) {
            var a = o[r];
            (a.options.continuous || r === o.length - 1) && a.trigger([i]);
          }
        }
        this.clearTriggerQueues();
      }),
      (i.prototype.next = function (e) {
        this.waypoints.sort(t);
        var i = n.Adapter.inArray(e, this.waypoints),
          o = i === this.waypoints.length - 1;
        return o ? null : this.waypoints[i + 1];
      }),
      (i.prototype.previous = function (e) {
        this.waypoints.sort(t);
        var i = n.Adapter.inArray(e, this.waypoints);
        return i ? this.waypoints[i - 1] : null;
      }),
      (i.prototype.queueTrigger = function (t, e) {
        this.triggerQueues[e].push(t);
      }),
      (i.prototype.remove = function (t) {
        var e = n.Adapter.inArray(t, this.waypoints);
        e > -1 && this.waypoints.splice(e, 1);
      }),
      (i.prototype.first = function () {
        return this.waypoints[0];
      }),
      (i.prototype.last = function () {
        return this.waypoints[this.waypoints.length - 1];
      }),
      (i.findOrCreate = function (t) {
        return o[t.axis][t.name] || new i(t);
      }),
      (n.Group = i);
  })(),
  (function () {
    "use strict";
    function t(t) {
      this.$element = e(t);
    }
    var e = window.jQuery,
      i = window.Waypoint;
    e.each(
      [
        "innerHeight",
        "innerWidth",
        "off",
        "offset",
        "on",
        "outerHeight",
        "outerWidth",
        "scrollLeft",
        "scrollTop",
      ],
      function (e, i) {
        t.prototype[i] = function () {
          var t = Array.prototype.slice.call(arguments);
          return this.$element[i].apply(this.$element, t);
        };
      }
    ),
      e.each(["extend", "inArray", "isEmptyObject"], function (i, o) {
        t[o] = e[o];
      }),
      i.adapters.push({ name: "jquery", Adapter: t }),
      (i.Adapter = t);
  })(),
  (function () {
    "use strict";
    function t(t) {
      return function () {
        var i = [],
          o = arguments[0];
        return (
          t.isFunction(arguments[0]) &&
            ((o = t.extend({}, arguments[1])), (o.handler = arguments[0])),
          this.each(function () {
            var n = t.extend({}, o, { element: this });
            "string" == typeof n.context &&
              (n.context = t(this).closest(n.context)[0]),
              i.push(new e(n));
          }),
          i
        );
      };
    }
    var e = window.Waypoint;
    window.jQuery && (window.jQuery.fn.waypoint = t(window.jQuery)),
      window.Zepto && (window.Zepto.fn.waypoint = t(window.Zepto));
  })();
