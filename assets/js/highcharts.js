/*
 Highcharts JS v6.0.2 (2017-10-20)

 (c) 2009-2016 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(S, N) {
    "object" === typeof module && module.exports ? module.exports = S.document ? N(S) : N : S.Highcharts = N(S)
})("undefined" !== typeof window ? window : this, function(S) {
    var N = function() {
        var a = S.document,
            E = S.navigator && S.navigator.userAgent || "",
            C = a && a.createElementNS && !!a.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect,
            G = /(edge|msie|trident)/i.test(E) && !S.opera,
            q = /Firefox/.test(E),
            f = q && 4 > parseInt(E.split("Firefox/")[1], 10);
        return S.Highcharts ? S.Highcharts.error(16, !0) : {
            product: "Highcharts",
            version: "6.0.2",
            deg2rad: 2 * Math.PI / 360,
            doc: a,
            hasBidiBug: f,
            hasTouch: a && void 0 !== a.documentElement.ontouchstart,
            isMS: G,
            isWebKit: /AppleWebKit/.test(E),
            isFirefox: q,
            isTouchDevice: /(Mobile|Android|Windows Phone)/.test(E),
            SVG_NS: "http://www.w3.org/2000/svg",
            chartCount: 0,
            seriesTypes: {},
            symbolSizes: {},
            svg: C,
            win: S,
            marginNames: ["plotTop", "marginRight", "marginBottom", "plotLeft"],
            noop: function() {},
            charts: []
        }
    }();
    (function(a) {
        a.timers = [];
        var E = a.charts,
            C = a.doc,
            G = a.win;
        a.error = function(q, f) {
            q = a.isNumber(q) ? "Highcharts error #" +
                q + ": www.highcharts.com/errors/" + q : q;
            if (f) throw Error(q);
            G.console && console.log(q)
        };
        a.Fx = function(a, f, k) {
            this.options = f;
            this.elem = a;
            this.prop = k
        };
        a.Fx.prototype = {
            dSetter: function() {
                var a = this.paths[0],
                    f = this.paths[1],
                    k = [],
                    t = this.now,
                    m = a.length,
                    v;
                if (1 === t) k = this.toD;
                else if (m === f.length && 1 > t)
                    for (; m--;) v = parseFloat(a[m]), k[m] = isNaN(v) ? a[m] : t * parseFloat(f[m] - v) + v;
                else k = f;
                this.elem.attr("d", k, null, !0)
            },
            update: function() {
                var a = this.elem,
                    f = this.prop,
                    k = this.now,
                    t = this.options.step;
                if (this[f + "Setter"]) this[f +
                    "Setter"]();
                else a.attr ? a.element && a.attr(f, k, null, !0) : a.style[f] = k + this.unit;
                t && t.call(a, k, this)
            },
            run: function(q, f, k) {
                var t = this,
                    m = t.options,
                    v = function(a) {
                        return v.stopped ? !1 : t.step(a)
                    },
                    u = G.requestAnimationFrame || function(a) {
                        setTimeout(a, 13)
                    },
                    d = function() {
                        a.timers = a.grep(a.timers, function(a) {
                            return a()
                        });
                        a.timers.length && u(d)
                    };
                q === f ? (delete m.curAnim[this.prop], m.complete && 0 === a.keys(m.curAnim).length && m.complete()) : (this.startTime = +new Date, this.start = q, this.end = f, this.unit = k, this.now = this.start,
                    this.pos = 0, v.elem = this.elem, v.prop = this.prop, v() && 1 === a.timers.push(v) && u(d))
            },
            step: function(q) {
                var f = +new Date,
                    k, t = this.options,
                    m = this.elem,
                    v = t.complete,
                    u = t.duration,
                    d = t.curAnim;
                m.attr && !m.element ? q = !1 : q || f >= u + this.startTime ? (this.now = this.end, this.pos = 1, this.update(), k = d[this.prop] = !0, a.objectEach(d, function(a) {
                    !0 !== a && (k = !1)
                }), k && v && v.call(m), q = !1) : (this.pos = t.easing((f - this.startTime) / u), this.now = this.start + (this.end - this.start) * this.pos, this.update(), q = !0);
                return q
            },
            initPath: function(q, f, k) {
                function t(a) {
                    var c,
                        e;
                    for (b = a.length; b--;) c = "M" === a[b] || "L" === a[b], e = /[a-zA-Z]/.test(a[b + 3]), c && e && a.splice(b + 1, 0, a[b + 1], a[b + 2], a[b + 1], a[b + 2])
                }

                function m(a, d) {
                    for (; a.length < e;) {
                        a[0] = d[e - a.length];
                        var l = a.slice(0, c);
                        [].splice.apply(a, [0, 0].concat(l));
                        z && (l = a.slice(a.length - c), [].splice.apply(a, [a.length, 0].concat(l)), b--)
                    }
                    a[0] = "M"
                }

                function v(a, b) {
                    for (var d = (e - a.length) / c; 0 < d && d--;) l = a.slice().splice(a.length / A - c, c * A), l[0] = b[e - c - d * c], n && (l[c - 6] = l[c - 2], l[c - 5] = l[c - 1]), [].splice.apply(a, [a.length / A, 0].concat(l)), z && d--
                }
                f =
                    f || "";
                var u, d = q.startX,
                    g = q.endX,
                    n = -1 < f.indexOf("C"),
                    c = n ? 7 : 3,
                    e, l, b;
                f = f.split(" ");
                k = k.slice();
                var z = q.isArea,
                    A = z ? 2 : 1,
                    I;
                n && (t(f), t(k));
                if (d && g) {
                    for (b = 0; b < d.length; b++)
                        if (d[b] === g[0]) {
                            u = b;
                            break
                        } else if (d[0] === g[g.length - d.length + b]) {
                        u = b;
                        I = !0;
                        break
                    }
                    void 0 === u && (f = [])
                }
                f.length && a.isNumber(u) && (e = k.length + u * A * c, I ? (m(f, k), v(k, f)) : (m(k, f), v(f, k)));
                return [f, k]
            }
        };
        a.Fx.prototype.fillSetter = a.Fx.prototype.strokeSetter = function() {
            this.elem.attr(this.prop, a.color(this.start).tweenTo(a.color(this.end), this.pos),
                null, !0)
        };
        a.extend = function(a, f) {
            var k;
            a || (a = {});
            for (k in f) a[k] = f[k];
            return a
        };
        a.merge = function() {
            var q, f = arguments,
                k, t = {},
                m = function(k, u) {
                    "object" !== typeof k && (k = {});
                    a.objectEach(u, function(d, g) {
                        !a.isObject(d, !0) || a.isClass(d) || a.isDOMElement(d) ? k[g] = u[g] : k[g] = m(k[g] || {}, d)
                    });
                    return k
                };
            !0 === f[0] && (t = f[1], f = Array.prototype.slice.call(f, 2));
            k = f.length;
            for (q = 0; q < k; q++) t = m(t, f[q]);
            return t
        };
        a.pInt = function(a, f) {
            return parseInt(a, f || 10)
        };
        a.isString = function(a) {
            return "string" === typeof a
        };
        a.isArray = function(a) {
            a =
                Object.prototype.toString.call(a);
            return "[object Array]" === a || "[object Array Iterator]" === a
        };
        a.isObject = function(q, f) {
            return !!q && "object" === typeof q && (!f || !a.isArray(q))
        };
        a.isDOMElement = function(q) {
            return a.isObject(q) && "number" === typeof q.nodeType
        };
        a.isClass = function(q) {
            var f = q && q.constructor;
            return !(!a.isObject(q, !0) || a.isDOMElement(q) || !f || !f.name || "Object" === f.name)
        };
        a.isNumber = function(a) {
            return "number" === typeof a && !isNaN(a)
        };
        a.erase = function(a, f) {
            for (var k = a.length; k--;)
                if (a[k] === f) {
                    a.splice(k,
                        1);
                    break
                }
        };
        a.defined = function(a) {
            return void 0 !== a && null !== a
        };
        a.attr = function(q, f, k) {
            var t;
            a.isString(f) ? a.defined(k) ? q.setAttribute(f, k) : q && q.getAttribute && (t = q.getAttribute(f)) : a.defined(f) && a.isObject(f) && a.objectEach(f, function(a, k) {
                q.setAttribute(k, a)
            });
            return t
        };
        a.splat = function(q) {
            return a.isArray(q) ? q : [q]
        };
        a.syncTimeout = function(a, f, k) {
            if (f) return setTimeout(a, f, k);
            a.call(0, k)
        };
        a.pick = function() {
            var a = arguments,
                f, k, t = a.length;
            for (f = 0; f < t; f++)
                if (k = a[f], void 0 !== k && null !== k) return k
        };
        a.css =
            function(q, f) {
                a.isMS && !a.svg && f && void 0 !== f.opacity && (f.filter = "alpha(opacity\x3d" + 100 * f.opacity + ")");
                a.extend(q.style, f)
            };
        a.createElement = function(q, f, k, t, m) {
            q = C.createElement(q);
            var v = a.css;
            f && a.extend(q, f);
            m && v(q, {
                padding: 0,
                border: "none",
                margin: 0
            });
            k && v(q, k);
            t && t.appendChild(q);
            return q
        };
        a.extendClass = function(q, f) {
            var k = function() {};
            k.prototype = new q;
            a.extend(k.prototype, f);
            return k
        };
        a.pad = function(a, f, k) {
            return Array((f || 2) + 1 - String(a).length).join(k || 0) + a
        };
        a.relativeLength = function(a, f, k) {
            return /%$/.test(a) ?
                f * parseFloat(a) / 100 + (k || 0) : parseFloat(a)
        };
        a.wrap = function(a, f, k) {
            var q = a[f];
            a[f] = function() {
                var a = Array.prototype.slice.call(arguments),
                    v = arguments,
                    u = this;
                u.proceed = function() {
                    q.apply(u, arguments.length ? arguments : v)
                };
                a.unshift(q);
                a = k.apply(this, a);
                u.proceed = null;
                return a
            }
        };
        a.getTZOffset = function(q) {
            var f = a.Date;
            return 6E4 * (f.hcGetTimezoneOffset && f.hcGetTimezoneOffset(q) || f.hcTimezoneOffset || 0)
        };
        a.dateFormat = function(q, f, k) {
            if (!a.defined(f) || isNaN(f)) return a.defaultOptions.lang.invalidDate || "";
            q =
                a.pick(q, "%Y-%m-%d %H:%M:%S");
            var t = a.Date,
                m = new t(f - a.getTZOffset(f)),
                v = m[t.hcGetHours](),
                u = m[t.hcGetDay](),
                d = m[t.hcGetDate](),
                g = m[t.hcGetMonth](),
                n = m[t.hcGetFullYear](),
                c = a.defaultOptions.lang,
                e = c.weekdays,
                l = c.shortWeekdays,
                b = a.pad,
                t = a.extend({
                    a: l ? l[u] : e[u].substr(0, 3),
                    A: e[u],
                    d: b(d),
                    e: b(d, 2, " "),
                    w: u,
                    b: c.shortMonths[g],
                    B: c.months[g],
                    m: b(g + 1),
                    y: n.toString().substr(2, 2),
                    Y: n,
                    H: b(v),
                    k: v,
                    I: b(v % 12 || 12),
                    l: v % 12 || 12,
                    M: b(m[t.hcGetMinutes]()),
                    p: 12 > v ? "AM" : "PM",
                    P: 12 > v ? "am" : "pm",
                    S: b(m.getSeconds()),
                    L: b(Math.round(f %
                        1E3), 3)
                }, a.dateFormats);
            a.objectEach(t, function(a, b) {
                for (; - 1 !== q.indexOf("%" + b);) q = q.replace("%" + b, "function" === typeof a ? a(f) : a)
            });
            return k ? q.substr(0, 1).toUpperCase() + q.substr(1) : q
        };
        a.formatSingle = function(q, f) {
            var k = /\.([0-9])/,
                t = a.defaultOptions.lang;
            /f$/.test(q) ? (k = (k = q.match(k)) ? k[1] : -1, null !== f && (f = a.numberFormat(f, k, t.decimalPoint, -1 < q.indexOf(",") ? t.thousandsSep : ""))) : f = a.dateFormat(q, f);
            return f
        };
        a.format = function(q, f) {
            for (var k = "{", t = !1, m, v, u, d, g = [], n; q;) {
                k = q.indexOf(k);
                if (-1 === k) break;
                m = q.slice(0, k);
                if (t) {
                    m = m.split(":");
                    v = m.shift().split(".");
                    d = v.length;
                    n = f;
                    for (u = 0; u < d; u++) n && (n = n[v[u]]);
                    m.length && (n = a.formatSingle(m.join(":"), n));
                    g.push(n)
                } else g.push(m);
                q = q.slice(k + 1);
                k = (t = !t) ? "}" : "{"
            }
            g.push(q);
            return g.join("")
        };
        a.getMagnitude = function(a) {
            return Math.pow(10, Math.floor(Math.log(a) / Math.LN10))
        };
        a.normalizeTickInterval = function(q, f, k, t, m) {
            var v, u = q;
            k = a.pick(k, 1);
            v = q / k;
            f || (f = m ? [1, 1.2, 1.5, 2, 2.5, 3, 4, 5, 6, 8, 10] : [1, 2, 2.5, 5, 10], !1 === t && (1 === k ? f = a.grep(f, function(a) {
                    return 0 === a % 1
                }) : .1 >=
                k && (f = [1 / k])));
            for (t = 0; t < f.length && !(u = f[t], m && u * k >= q || !m && v <= (f[t] + (f[t + 1] || f[t])) / 2); t++);
            return u = a.correctFloat(u * k, -Math.round(Math.log(.001) / Math.LN10))
        };
        a.stableSort = function(a, f) {
            var k = a.length,
                q, m;
            for (m = 0; m < k; m++) a[m].safeI = m;
            a.sort(function(a, m) {
                q = f(a, m);
                return 0 === q ? a.safeI - m.safeI : q
            });
            for (m = 0; m < k; m++) delete a[m].safeI
        };
        a.arrayMin = function(a) {
            for (var f = a.length, k = a[0]; f--;) a[f] < k && (k = a[f]);
            return k
        };
        a.arrayMax = function(a) {
            for (var f = a.length, k = a[0]; f--;) a[f] > k && (k = a[f]);
            return k
        };
        a.destroyObjectProperties =
            function(q, f) {
                a.objectEach(q, function(a, t) {
                    a && a !== f && a.destroy && a.destroy();
                    delete q[t]
                })
            };
        a.discardElement = function(q) {
            var f = a.garbageBin;
            f || (f = a.createElement("div"));
            q && f.appendChild(q);
            f.innerHTML = ""
        };
        a.correctFloat = function(a, f) {
            return parseFloat(a.toPrecision(f || 14))
        };
        a.setAnimation = function(q, f) {
            f.renderer.globalAnimation = a.pick(q, f.options.chart.animation, !0)
        };
        a.animObject = function(q) {
            return a.isObject(q) ? a.merge(q) : {
                duration: q ? 500 : 0
            }
        };
        a.timeUnits = {
            millisecond: 1,
            second: 1E3,
            minute: 6E4,
            hour: 36E5,
            day: 864E5,
            week: 6048E5,
            month: 24192E5,
            year: 314496E5
        };
        a.numberFormat = function(q, f, k, t) {
            q = +q || 0;
            f = +f;
            var m = a.defaultOptions.lang,
                v = (q.toString().split(".")[1] || "").split("e")[0].length,
                u, d, g = q.toString().split("e"); - 1 === f ? f = Math.min(v, 20) : a.isNumber(f) || (f = 2);
            d = (Math.abs(g[1] ? g[0] : q) + Math.pow(10, -Math.max(f, v) - 1)).toFixed(f);
            v = String(a.pInt(d));
            u = 3 < v.length ? v.length % 3 : 0;
            k = a.pick(k, m.decimalPoint);
            t = a.pick(t, m.thousandsSep);
            q = (0 > q ? "-" : "") + (u ? v.substr(0, u) + t : "");
            q += v.substr(u).replace(/(\d{3})(?=\d)/g,
                "$1" + t);
            f && (q += k + d.slice(-f));
            g[1] && (q += "e" + g[1]);
            return q
        };
        Math.easeInOutSine = function(a) {
            return -.5 * (Math.cos(Math.PI * a) - 1)
        };
        a.getStyle = function(q, f, k) {
            if ("width" === f) return Math.min(q.offsetWidth, q.scrollWidth) - a.getStyle(q, "padding-left") - a.getStyle(q, "padding-right");
            if ("height" === f) return Math.min(q.offsetHeight, q.scrollHeight) - a.getStyle(q, "padding-top") - a.getStyle(q, "padding-bottom");
            G.getComputedStyle || a.error(27, !0);
            if (q = G.getComputedStyle(q, void 0)) q = q.getPropertyValue(f), a.pick(k, "opacity" !==
                f) && (q = a.pInt(q));
            return q
        };
        a.inArray = function(q, f) {
            return (a.indexOfPolyfill || Array.prototype.indexOf).call(f, q)
        };
        a.grep = function(q, f) {
            return (a.filterPolyfill || Array.prototype.filter).call(q, f)
        };
        a.find = Array.prototype.find ? function(a, f) {
            return a.find(f)
        } : function(a, f) {
            var k, t = a.length;
            for (k = 0; k < t; k++)
                if (f(a[k], k)) return a[k]
        };
        a.map = function(a, f) {
            for (var k = [], t = 0, m = a.length; t < m; t++) k[t] = f.call(a[t], a[t], t, a);
            return k
        };
        a.keys = function(q) {
            return (a.keysPolyfill || Object.keys).call(void 0, q)
        };
        a.reduce =
            function(q, f, k) {
                return (a.reducePolyfill || Array.prototype.reduce).call(q, f, k)
            };
        a.offset = function(a) {
            var f = C.documentElement;
            a = a.parentElement ? a.getBoundingClientRect() : {
                top: 0,
                left: 0
            };
            return {
                top: a.top + (G.pageYOffset || f.scrollTop) - (f.clientTop || 0),
                left: a.left + (G.pageXOffset || f.scrollLeft) - (f.clientLeft || 0)
            }
        };
        a.stop = function(q, f) {
            for (var k = a.timers.length; k--;) a.timers[k].elem !== q || f && f !== a.timers[k].prop || (a.timers[k].stopped = !0)
        };
        a.each = function(q, f, k) {
            return (a.forEachPolyfill || Array.prototype.forEach).call(q,
                f, k)
        };
        a.objectEach = function(a, f, k) {
            for (var t in a) a.hasOwnProperty(t) && f.call(k, a[t], t, a)
        };
        a.addEvent = function(q, f, k) {
            var t = q.hcEvents = q.hcEvents || {},
                m = q.addEventListener || a.addEventListenerPolyfill;
            m && m.call(q, f, k, !1);
            t[f] || (t[f] = []);
            t[f].push(k);
            return function() {
                a.removeEvent(q, f, k)
            }
        };
        a.removeEvent = function(q, f, k) {
            function t(d, n) {
                var c = q.removeEventListener || a.removeEventListenerPolyfill;
                c && c.call(q, d, n, !1)
            }

            function m() {
                var d, n;
                q.nodeName && (f ? (d = {}, d[f] = !0) : d = u, a.objectEach(d, function(a, e) {
                    if (u[e])
                        for (n =
                            u[e].length; n--;) t(e, u[e][n])
                }))
            }
            var v, u = q.hcEvents,
                d;
            u && (f ? (v = u[f] || [], k ? (d = a.inArray(k, v), -1 < d && (v.splice(d, 1), u[f] = v), t(f, k)) : (m(), u[f] = [])) : (m(), q.hcEvents = {}))
        };
        a.fireEvent = function(q, f, k, t) {
            var m;
            m = q.hcEvents;
            var v, u;
            k = k || {};
            if (C.createEvent && (q.dispatchEvent || q.fireEvent)) m = C.createEvent("Events"), m.initEvent(f, !0, !0), a.extend(m, k), q.dispatchEvent ? q.dispatchEvent(m) : q.fireEvent(f, m);
            else if (m)
                for (m = m[f] || [], v = m.length, k.target || a.extend(k, {
                        preventDefault: function() {
                            k.defaultPrevented = !0
                        },
                        target: q,
                        type: f
                    }), f = 0; f < v; f++)(u = m[f]) && !1 === u.call(q, k) && k.preventDefault();
            t && !k.defaultPrevented && t(k)
        };
        a.animate = function(q, f, k) {
            var t, m = "",
                v, u, d;
            a.isObject(k) || (d = arguments, k = {
                duration: d[2],
                easing: d[3],
                complete: d[4]
            });
            a.isNumber(k.duration) || (k.duration = 400);
            k.easing = "function" === typeof k.easing ? k.easing : Math[k.easing] || Math.easeInOutSine;
            k.curAnim = a.merge(f);
            a.objectEach(f, function(d, n) {
                a.stop(q, n);
                u = new a.Fx(q, k, n);
                v = null;
                "d" === n ? (u.paths = u.initPath(q, q.d, f.d), u.toD = f.d, t = 0, v = 1) : q.attr ? t = q.attr(n) :
                    (t = parseFloat(a.getStyle(q, n)) || 0, "opacity" !== n && (m = "px"));
                v || (v = d);
                v && v.match && v.match("px") && (v = v.replace(/px/g, ""));
                u.run(t, v, m)
            })
        };
        a.seriesType = function(q, f, k, t, m) {
            var v = a.getOptions(),
                u = a.seriesTypes;
            v.plotOptions[q] = a.merge(v.plotOptions[f], k);
            u[q] = a.extendClass(u[f] || function() {}, t);
            u[q].prototype.type = q;
            m && (u[q].prototype.pointClass = a.extendClass(a.Point, m));
            return u[q]
        };
        a.uniqueKey = function() {
            var a = Math.random().toString(36).substring(2, 9),
                f = 0;
            return function() {
                return "highcharts-" + a + "-" +
                    f++
            }
        }();
        G.jQuery && (G.jQuery.fn.highcharts = function() {
            var q = [].slice.call(arguments);
            if (this[0]) return q[0] ? (new(a[a.isString(q[0]) ? q.shift() : "Chart"])(this[0], q[0], q[1]), this) : E[a.attr(this[0], "data-highcharts-chart")]
        })
    })(N);
    (function(a) {
        var E = a.each,
            C = a.isNumber,
            G = a.map,
            q = a.merge,
            f = a.pInt;
        a.Color = function(k) {
            if (!(this instanceof a.Color)) return new a.Color(k);
            this.init(k)
        };
        a.Color.prototype = {
            parsers: [{
                regex: /rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]?(?:\.[0-9]+)?)\s*\)/,
                parse: function(a) {
                    return [f(a[1]), f(a[2]), f(a[3]), parseFloat(a[4], 10)]
                }
            }, {
                regex: /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/,
                parse: function(a) {
                    return [f(a[1]), f(a[2]), f(a[3]), 1]
                }
            }],
            names: {
                none: "rgba(255,255,255,0)",
                white: "#ffffff",
                black: "#000000"
            },
            init: function(k) {
                var f, m, v, u;
                if ((this.input = k = this.names[k && k.toLowerCase ? k.toLowerCase() : ""] || k) && k.stops) this.stops = G(k.stops, function(d) {
                    return new a.Color(d[1])
                });
                else if (k && k.charAt && "#" === k.charAt() && (f = k.length, k = parseInt(k.substr(1),
                        16), 7 === f ? m = [(k & 16711680) >> 16, (k & 65280) >> 8, k & 255, 1] : 4 === f && (m = [(k & 3840) >> 4 | (k & 3840) >> 8, (k & 240) >> 4 | k & 240, (k & 15) << 4 | k & 15, 1])), !m)
                    for (v = this.parsers.length; v-- && !m;) u = this.parsers[v], (f = u.regex.exec(k)) && (m = u.parse(f));
                this.rgba = m || []
            },
            get: function(a) {
                var k = this.input,
                    m = this.rgba,
                    f;
                this.stops ? (f = q(k), f.stops = [].concat(f.stops), E(this.stops, function(m, d) {
                    f.stops[d] = [f.stops[d][0], m.get(a)]
                })) : f = m && C(m[0]) ? "rgb" === a || !a && 1 === m[3] ? "rgb(" + m[0] + "," + m[1] + "," + m[2] + ")" : "a" === a ? m[3] : "rgba(" + m.join(",") + ")" : k;
                return f
            },
            brighten: function(a) {
                var k, m = this.rgba;
                if (this.stops) E(this.stops, function(m) {
                    m.brighten(a)
                });
                else if (C(a) && 0 !== a)
                    for (k = 0; 3 > k; k++) m[k] += f(255 * a), 0 > m[k] && (m[k] = 0), 255 < m[k] && (m[k] = 255);
                return this
            },
            setOpacity: function(a) {
                this.rgba[3] = a;
                return this
            },
            tweenTo: function(a, f) {
                var m = this.rgba,
                    k = a.rgba;
                k.length && m && m.length ? (a = 1 !== k[3] || 1 !== m[3], f = (a ? "rgba(" : "rgb(") + Math.round(k[0] + (m[0] - k[0]) * (1 - f)) + "," + Math.round(k[1] + (m[1] - k[1]) * (1 - f)) + "," + Math.round(k[2] + (m[2] - k[2]) * (1 - f)) + (a ? "," + (k[3] + (m[3] -
                    k[3]) * (1 - f)) : "") + ")") : f = a.input || "none";
                return f
            }
        };
        a.color = function(k) {
            return new a.Color(k)
        }
    })(N);
    (function(a) {
        var E, C, G = a.addEvent,
            q = a.animate,
            f = a.attr,
            k = a.charts,
            t = a.color,
            m = a.css,
            v = a.createElement,
            u = a.defined,
            d = a.deg2rad,
            g = a.destroyObjectProperties,
            n = a.doc,
            c = a.each,
            e = a.extend,
            l = a.erase,
            b = a.grep,
            z = a.hasTouch,
            A = a.inArray,
            I = a.isArray,
            r = a.isFirefox,
            J = a.isMS,
            w = a.isObject,
            D = a.isString,
            M = a.isWebKit,
            p = a.merge,
            B = a.noop,
            H = a.objectEach,
            F = a.pick,
            h = a.pInt,
            x = a.removeEvent,
            R = a.stop,
            K = a.svg,
            P = a.SVG_NS,
            L = a.symbolSizes,
            Q = a.win;
        E = a.SVGElement = function() {
            return this
        };
        e(E.prototype, {
            opacity: 1,
            SVG_NS: P,
            textProps: "direction fontSize fontWeight fontFamily fontStyle color lineHeight width textAlign textDecoration textOverflow textOutline".split(" "),
            init: function(a, h) {
                this.element = "span" === h ? v(h) : n.createElementNS(this.SVG_NS, h);
                this.renderer = a
            },
            animate: function(y, h, x) {
                h = a.animObject(F(h, this.renderer.globalAnimation, !0));
                0 !== h.duration ? (x && (h.complete = x), q(this, y, h)) : (this.attr(y, null, x), h.step && h.step.call(this));
                return this
            },
            colorGradient: function(y, h, x) {
                var b = this.renderer,
                    e, O, d, l, g, K, n, z, L, r, w = [],
                    m;
                y.radialGradient ? O = "radialGradient" : y.linearGradient && (O = "linearGradient");
                O && (d = y[O], g = b.gradients, n = y.stops, r = x.radialReference, I(d) && (y[O] = d = {
                        x1: d[0],
                        y1: d[1],
                        x2: d[2],
                        y2: d[3],
                        gradientUnits: "userSpaceOnUse"
                    }), "radialGradient" === O && r && !u(d.gradientUnits) && (l = d, d = p(d, b.getRadialAttr(r, l), {
                        gradientUnits: "userSpaceOnUse"
                    })), H(d, function(a, y) {
                        "id" !== y && w.push(y, a)
                    }), H(n, function(a) {
                        w.push(a)
                    }), w = w.join(","), g[w] ? r = g[w].attr("id") :
                    (d.id = r = a.uniqueKey(), g[w] = K = b.createElement(O).attr(d).add(b.defs), K.radAttr = l, K.stops = [], c(n, function(y) {
                        0 === y[1].indexOf("rgba") ? (e = a.color(y[1]), z = e.get("rgb"), L = e.get("a")) : (z = y[1], L = 1);
                        y = b.createElement("stop").attr({
                            offset: y[0],
                            "stop-color": z,
                            "stop-opacity": L
                        }).add(K);
                        K.stops.push(y)
                    })), m = "url(" + b.url + "#" + r + ")", x.setAttribute(h, m), x.gradient = w, y.toString = function() {
                        return m
                    })
            },
            applyTextOutline: function(y) {
                var h = this.element,
                    x, b, e, p, d; - 1 !== y.indexOf("contrast") && (y = y.replace(/contrast/g, this.renderer.getContrast(h.style.fill)));
                y = y.split(" ");
                b = y[y.length - 1];
                if ((e = y[0]) && "none" !== e && a.svg) {
                    this.fakeTS = !0;
                    y = [].slice.call(h.getElementsByTagName("tspan"));
                    this.ySetter = this.xSetter;
                    e = e.replace(/(^[\d\.]+)(.*?)$/g, function(a, y, h) {
                        return 2 * y + h
                    });
                    for (d = y.length; d--;) x = y[d], "highcharts-text-outline" === x.getAttribute("class") && l(y, h.removeChild(x));
                    p = h.firstChild;
                    c(y, function(a, y) {
                        0 === y && (a.setAttribute("x", h.getAttribute("x")), y = h.getAttribute("y"), a.setAttribute("y", y || 0), null === y && h.setAttribute("y", 0));
                        a = a.cloneNode(1);
                        f(a, {
                            "class": "highcharts-text-outline",
                            fill: b,
                            stroke: b,
                            "stroke-width": e,
                            "stroke-linejoin": "round"
                        });
                        h.insertBefore(a, p)
                    })
                }
            },
            attr: function(a, h, x, b) {
                var y, e = this.element,
                    c, O = this,
                    p, d;
                "string" === typeof a && void 0 !== h && (y = a, a = {}, a[y] = h);
                "string" === typeof a ? O = (this[a + "Getter"] || this._defaultGetter).call(this, a, e) : (H(a, function(y, h) {
                    p = !1;
                    b || R(this, h);
                    this.symbolName && /^(x|y|width|height|r|start|end|innerR|anchorX|anchorY)$/.test(h) && (c || (this.symbolAttr(a), c = !0), p = !0);
                    !this.rotation || "x" !== h && "y" !== h || (this.doTransform = !0);
                    p || (d = this[h + "Setter"] ||
                        this._defaultSetter, d.call(this, y, h, e), this.shadows && /^(width|height|visibility|x|y|d|transform|cx|cy|r)$/.test(h) && this.updateShadows(h, y, d))
                }, this), this.afterSetters());
                x && x();
                return O
            },
            afterSetters: function() {
                this.doTransform && (this.updateTransform(), this.doTransform = !1)
            },
            updateShadows: function(a, h, x) {
                for (var y = this.shadows, b = y.length; b--;) x.call(y[b], "height" === a ? Math.max(h - (y[b].cutHeight || 0), 0) : "d" === a ? this.d : h, a, y[b])
            },
            addClass: function(a, h) {
                var y = this.attr("class") || ""; - 1 === y.indexOf(a) &&
                    (h || (a = (y + (y ? " " : "") + a).replace("  ", " ")), this.attr("class", a));
                return this
            },
            hasClass: function(a) {
                return -1 !== A(a, (this.attr("class") || "").split(" "))
            },
            removeClass: function(a) {
                return this.attr("class", (this.attr("class") || "").replace(a, ""))
            },
            symbolAttr: function(a) {
                var y = this;
                c("x y r start end width height innerR anchorX anchorY".split(" "), function(h) {
                    y[h] = F(a[h], y[h])
                });
                y.attr({
                    d: y.renderer.symbols[y.symbolName](y.x, y.y, y.width, y.height, y)
                })
            },
            clip: function(a) {
                return this.attr("clip-path", a ? "url(" +
                    this.renderer.url + "#" + a.id + ")" : "none")
            },
            crisp: function(a, h) {
                var y = this,
                    x = {},
                    b;
                h = h || a.strokeWidth || 0;
                b = Math.round(h) % 2 / 2;
                a.x = Math.floor(a.x || y.x || 0) + b;
                a.y = Math.floor(a.y || y.y || 0) + b;
                a.width = Math.floor((a.width || y.width || 0) - 2 * b);
                a.height = Math.floor((a.height || y.height || 0) - 2 * b);
                u(a.strokeWidth) && (a.strokeWidth = h);
                H(a, function(a, h) {
                    y[h] !== a && (y[h] = x[h] = a)
                });
                return x
            },
            css: function(a) {
                var y = this.styles,
                    b = {},
                    x = this.element,
                    c, p = "",
                    d, l = !y,
                    g = ["textOutline", "textOverflow", "width"];
                a && a.color && (a.fill = a.color);
                y && H(a, function(a, h) {
                    a !== y[h] && (b[h] = a, l = !0)
                });
                l && (y && (a = e(y, b)), c = this.textWidth = a && a.width && "auto" !== a.width && "text" === x.nodeName.toLowerCase() && h(a.width), this.styles = a, c && !K && this.renderer.forExport && delete a.width, J && !K ? m(this.element, a) : (d = function(a, y) {
                    return "-" + y.toLowerCase()
                }, H(a, function(a, y) {
                    -1 === A(y, g) && (p += y.replace(/([A-Z])/g, d) + ":" + a + ";")
                }), p && f(x, "style", p)), this.added && ("text" === this.element.nodeName && this.renderer.buildText(this), a && a.textOutline && this.applyTextOutline(a.textOutline)));
                return this
            },
            strokeWidth: function() {
                return this["stroke-width"] || 0
            },
            on: function(a, h) {
                var y = this,
                    b = y.element;
                z && "click" === a ? (b.ontouchstart = function(a) {
                    y.touchEventFired = Date.now();
                    a.preventDefault();
                    h.call(b, a)
                }, b.onclick = function(a) {
                    (-1 === Q.navigator.userAgent.indexOf("Android") || 1100 < Date.now() - (y.touchEventFired || 0)) && h.call(b, a)
                }) : b["on" + a] = h;
                return this
            },
            setRadialReference: function(a) {
                var y = this.renderer.gradients[this.element.gradient];
                this.element.radialReference = a;
                y && y.radAttr && y.animate(this.renderer.getRadialAttr(a,
                    y.radAttr));
                return this
            },
            translate: function(a, h) {
                return this.attr({
                    translateX: a,
                    translateY: h
                })
            },
            invert: function(a) {
                this.inverted = a;
                this.updateTransform();
                return this
            },
            updateTransform: function() {
                var a = this.translateX || 0,
                    h = this.translateY || 0,
                    b = this.scaleX,
                    x = this.scaleY,
                    e = this.inverted,
                    c = this.rotation,
                    p = this.matrix,
                    d = this.element;
                e && (a += this.width, h += this.height);
                a = ["translate(" + a + "," + h + ")"];
                u(p) && a.push("matrix(" + p.join(",") + ")");
                e ? a.push("rotate(90) scale(-1,1)") : c && a.push("rotate(" + c + " " + F(this.rotationOriginX,
                    d.getAttribute("x"), 0) + " " + F(this.rotationOriginY, d.getAttribute("y") || 0) + ")");
                (u(b) || u(x)) && a.push("scale(" + F(b, 1) + " " + F(x, 1) + ")");
                a.length && d.setAttribute("transform", a.join(" "))
            },
            toFront: function() {
                var a = this.element;
                a.parentNode.appendChild(a);
                return this
            },
            align: function(a, h, b) {
                var y, x, e, c, p = {};
                x = this.renderer;
                e = x.alignedObjects;
                var d, O;
                if (a) {
                    if (this.alignOptions = a, this.alignByTranslate = h, !b || D(b)) this.alignTo = y = b || "renderer", l(e, this), e.push(this), b = null
                } else a = this.alignOptions, h = this.alignByTranslate,
                    y = this.alignTo;
                b = F(b, x[y], x);
                y = a.align;
                x = a.verticalAlign;
                e = (b.x || 0) + (a.x || 0);
                c = (b.y || 0) + (a.y || 0);
                "right" === y ? d = 1 : "center" === y && (d = 2);
                d && (e += (b.width - (a.width || 0)) / d);
                p[h ? "translateX" : "x"] = Math.round(e);
                "bottom" === x ? O = 1 : "middle" === x && (O = 2);
                O && (c += (b.height - (a.height || 0)) / O);
                p[h ? "translateY" : "y"] = Math.round(c);
                this[this.placed ? "animate" : "attr"](p);
                this.placed = !0;
                this.alignAttr = p;
                return this
            },
            getBBox: function(a, h) {
                var y, b = this.renderer,
                    x, p = this.element,
                    l = this.styles,
                    O, g = this.textStr,
                    K, n = b.cache,
                    z = b.cacheKeys,
                    L;
                h = F(h, this.rotation);
                x = h * d;
                O = l && l.fontSize;
                void 0 !== g && (L = g.toString(), -1 === L.indexOf("\x3c") && (L = L.replace(/[0-9]/g, "0")), L += ["", h || 0, O, l && l.width, l && l.textOverflow].join());
                L && !a && (y = n[L]);
                if (!y) {
                    if (p.namespaceURI === this.SVG_NS || b.forExport) {
                        try {
                            (K = this.fakeTS && function(a) {
                                c(p.querySelectorAll(".highcharts-text-outline"), function(h) {
                                    h.style.display = a
                                })
                            }) && K("none"), y = p.getBBox ? e({}, p.getBBox()) : {
                                width: p.offsetWidth,
                                height: p.offsetHeight
                            }, K && K("")
                        } catch (W) {}
                        if (!y || 0 > y.width) y = {
                            width: 0,
                            height: 0
                        }
                    } else y =
                        this.htmlGetBBox();
                    b.isSVG && (a = y.width, b = y.height, l && "11px" === l.fontSize && 17 === Math.round(b) && (y.height = b = 14), h && (y.width = Math.abs(b * Math.sin(x)) + Math.abs(a * Math.cos(x)), y.height = Math.abs(b * Math.cos(x)) + Math.abs(a * Math.sin(x))));
                    if (L && 0 < y.height) {
                        for (; 250 < z.length;) delete n[z.shift()];
                        n[L] || z.push(L);
                        n[L] = y
                    }
                }
                return y
            },
            show: function(a) {
                return this.attr({
                    visibility: a ? "inherit" : "visible"
                })
            },
            hide: function() {
                return this.attr({
                    visibility: "hidden"
                })
            },
            fadeOut: function(a) {
                var h = this;
                h.animate({
                    opacity: 0
                }, {
                    duration: a || 150,
                    complete: function() {
                        h.attr({
                            y: -9999
                        })
                    }
                })
            },
            add: function(a) {
                var h = this.renderer,
                    y = this.element,
                    b;
                a && (this.parentGroup = a);
                this.parentInverted = a && a.inverted;
                void 0 !== this.textStr && h.buildText(this);
                this.added = !0;
                if (!a || a.handleZ || this.zIndex) b = this.zIndexSetter();
                b || (a ? a.element : h.box).appendChild(y);
                if (this.onAdd) this.onAdd();
                return this
            },
            safeRemoveChild: function(a) {
                var h = a.parentNode;
                h && h.removeChild(a)
            },
            destroy: function() {
                var a = this,
                    h = a.element || {},
                    b = a.renderer.isSVG && "SPAN" === h.nodeName &&
                    a.parentGroup,
                    x = h.ownerSVGElement;
                h.onclick = h.onmouseout = h.onmouseover = h.onmousemove = h.point = null;
                R(a);
                a.clipPath && x && (c(x.querySelectorAll("[clip-path],[CLIP-PATH]"), function(h) {
                    h.getAttribute("clip-path").match(RegExp('[("]#' + a.clipPath.element.id + '[)"]')) && h.removeAttribute("clip-path")
                }), a.clipPath = a.clipPath.destroy());
                if (a.stops) {
                    for (x = 0; x < a.stops.length; x++) a.stops[x] = a.stops[x].destroy();
                    a.stops = null
                }
                a.safeRemoveChild(h);
                for (a.destroyShadows(); b && b.div && 0 === b.div.childNodes.length;) h = b.parentGroup,
                    a.safeRemoveChild(b.div), delete b.div, b = h;
                a.alignTo && l(a.renderer.alignedObjects, a);
                H(a, function(h, y) {
                    delete a[y]
                });
                return null
            },
            shadow: function(a, h, b) {
                var y = [],
                    x, e, c = this.element,
                    p, d, l, g;
                if (!a) this.destroyShadows();
                else if (!this.shadows) {
                    d = F(a.width, 3);
                    l = (a.opacity || .15) / d;
                    g = this.parentInverted ? "(-1,-1)" : "(" + F(a.offsetX, 1) + ", " + F(a.offsetY, 1) + ")";
                    for (x = 1; x <= d; x++) e = c.cloneNode(0), p = 2 * d + 1 - 2 * x, f(e, {
                        isShadow: "true",
                        stroke: a.color || "#000000",
                        "stroke-opacity": l * x,
                        "stroke-width": p,
                        transform: "translate" +
                            g,
                        fill: "none"
                    }), b && (f(e, "height", Math.max(f(e, "height") - p, 0)), e.cutHeight = p), h ? h.element.appendChild(e) : c.parentNode && c.parentNode.insertBefore(e, c), y.push(e);
                    this.shadows = y
                }
                return this
            },
            destroyShadows: function() {
                c(this.shadows || [], function(a) {
                    this.safeRemoveChild(a)
                }, this);
                this.shadows = void 0
            },
            xGetter: function(a) {
                "circle" === this.element.nodeName && ("x" === a ? a = "cx" : "y" === a && (a = "cy"));
                return this._defaultGetter(a)
            },
            _defaultGetter: function(a) {
                a = F(this[a], this.element ? this.element.getAttribute(a) : null,
                    0);
                /^[\-0-9\.]+$/.test(a) && (a = parseFloat(a));
                return a
            },
            dSetter: function(a, h, b) {
                a && a.join && (a = a.join(" "));
                /(NaN| {2}|^$)/.test(a) && (a = "M 0 0");
                this[h] !== a && (b.setAttribute(h, a), this[h] = a)
            },
            dashstyleSetter: function(a) {
                var b, x = this["stroke-width"];
                "inherit" === x && (x = 1);
                if (a = a && a.toLowerCase()) {
                    a = a.replace("shortdashdotdot", "3,1,1,1,1,1,").replace("shortdashdot", "3,1,1,1").replace("shortdot", "1,1,").replace("shortdash", "3,1,").replace("longdash", "8,3,").replace(/dot/g, "1,3,").replace("dash", "4,3,").replace(/,$/,
                        "").split(",");
                    for (b = a.length; b--;) a[b] = h(a[b]) * x;
                    a = a.join(",").replace(/NaN/g, "none");
                    this.element.setAttribute("stroke-dasharray", a)
                }
            },
            alignSetter: function(a) {
                this.element.setAttribute("text-anchor", {
                    left: "start",
                    center: "middle",
                    right: "end"
                }[a])
            },
            opacitySetter: function(a, h, b) {
                this[h] = a;
                b.setAttribute(h, a)
            },
            titleSetter: function(a) {
                var h = this.element.getElementsByTagName("title")[0];
                h || (h = n.createElementNS(this.SVG_NS, "title"), this.element.appendChild(h));
                h.firstChild && h.removeChild(h.firstChild);
                h.appendChild(n.createTextNode(String(F(a), "").replace(/<[^>]*>/g, "")))
            },
            textSetter: function(a) {
                a !== this.textStr && (delete this.bBox, this.textStr = a, this.added && this.renderer.buildText(this))
            },
            fillSetter: function(a, h, b) {
                "string" === typeof a ? b.setAttribute(h, a) : a && this.colorGradient(a, h, b)
            },
            visibilitySetter: function(a, h, b) {
                "inherit" === a ? b.removeAttribute(h) : this[h] !== a && b.setAttribute(h, a);
                this[h] = a
            },
            zIndexSetter: function(a, b) {
                var x = this.renderer,
                    y = this.parentGroup,
                    e = (y || x).element || x.box,
                    c, p = this.element,
                    d, l, x = e === x.box;
                c = this.added;
                var g;
                u(a) && (p.zIndex = a, a = +a, this[b] === a && (c = !1), this[b] = a);
                if (c) {
                    (a = this.zIndex) && y && (y.handleZ = !0);
                    b = e.childNodes;
                    for (g = b.length - 1; 0 <= g && !d; g--)
                        if (y = b[g], c = y.zIndex, l = !u(c), y !== p)
                            if (0 > a && l && !x && !g) e.insertBefore(p, b[g]), d = !0;
                            else if (h(c) <= a || l && (!u(a) || 0 <= a)) e.insertBefore(p, b[g + 1] || null), d = !0;
                    d || (e.insertBefore(p, b[x ? 3 : 0] || null), d = !0)
                }
                return d
            },
            _defaultSetter: function(a, h, b) {
                b.setAttribute(h, a)
            }
        });
        E.prototype.yGetter = E.prototype.xGetter;
        E.prototype.translateXSetter =
            E.prototype.translateYSetter = E.prototype.rotationSetter = E.prototype.verticalAlignSetter = E.prototype.rotationOriginXSetter = E.prototype.rotationOriginYSetter = E.prototype.scaleXSetter = E.prototype.scaleYSetter = E.prototype.matrixSetter = function(a, h) {
                this[h] = a;
                this.doTransform = !0
            };
        E.prototype["stroke-widthSetter"] = E.prototype.strokeSetter = function(a, h, b) {
            this[h] = a;
            this.stroke && this["stroke-width"] ? (E.prototype.fillSetter.call(this, this.stroke, "stroke", b), b.setAttribute("stroke-width", this["stroke-width"]),
                this.hasStroke = !0) : "stroke-width" === h && 0 === a && this.hasStroke && (b.removeAttribute("stroke"), this.hasStroke = !1)
        };
        C = a.SVGRenderer = function() {
            this.init.apply(this, arguments)
        };
        e(C.prototype, {
            Element: E,
            SVG_NS: P,
            init: function(a, h, b, x, e, c) {
                var y;
                x = this.createElement("svg").attr({
                    version: "1.1",
                    "class": "highcharts-root"
                }).css(this.getStyle(x));
                y = x.element;
                a.appendChild(y); - 1 === a.innerHTML.indexOf("xmlns") && f(y, "xmlns", this.SVG_NS);
                this.isSVG = !0;
                this.box = y;
                this.boxWrapper = x;
                this.alignedObjects = [];
                this.url = (r ||
                    M) && n.getElementsByTagName("base").length ? Q.location.href.replace(/#.*?$/, "").replace(/<[^>]*>/g, "").replace(/([\('\)])/g, "\\$1").replace(/ /g, "%20") : "";
                this.createElement("desc").add().element.appendChild(n.createTextNode("Created with Highcharts 6.0.2"));
                this.defs = this.createElement("defs").add();
                this.allowHTML = c;
                this.forExport = e;
                this.gradients = {};
                this.cache = {};
                this.cacheKeys = [];
                this.imgCount = 0;
                this.setSize(h, b, !1);
                var p;
                r && a.getBoundingClientRect && (h = function() {
                    m(a, {
                        left: 0,
                        top: 0
                    });
                    p = a.getBoundingClientRect();
                    m(a, {
                        left: Math.ceil(p.left) - p.left + "px",
                        top: Math.ceil(p.top) - p.top + "px"
                    })
                }, h(), this.unSubPixelFix = G(Q, "resize", h))
            },
            getStyle: function(a) {
                return this.style = e({
                    fontFamily: '"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif',
                    fontSize: "12px"
                }, a)
            },
            setStyle: function(a) {
                this.boxWrapper.css(this.getStyle(a))
            },
            isHidden: function() {
                return !this.boxWrapper.getBBox().width
            },
            destroy: function() {
                var a = this.defs;
                this.box = null;
                this.boxWrapper = this.boxWrapper.destroy();
                g(this.gradients || {});
                this.gradients =
                    null;
                a && (this.defs = a.destroy());
                this.unSubPixelFix && this.unSubPixelFix();
                return this.alignedObjects = null
            },
            createElement: function(a) {
                var h = new this.Element;
                h.init(this, a);
                return h
            },
            draw: B,
            getRadialAttr: function(a, h) {
                return {
                    cx: a[0] - a[2] / 2 + h.cx * a[2],
                    cy: a[1] - a[2] / 2 + h.cy * a[2],
                    r: h.r * a[2]
                }
            },
            getSpanWidth: function(a, h) {
                var b = a.getBBox(!0).width;
                !K && this.forExport && (b = this.measureSpanWidth(h.firstChild.data, a.styles));
                return b
            },
            applyEllipsis: function(a, h, b, x) {
                var e = a.rotation,
                    c = b,
                    y, p = 0,
                    d = b.length,
                    l = function(a) {
                        h.removeChild(h.firstChild);
                        a && h.appendChild(n.createTextNode(a))
                    },
                    g;
                a.rotation = 0;
                c = this.getSpanWidth(a, h);
                if (g = c > x) {
                    for (; p <= d;) y = Math.ceil((p + d) / 2), c = b.substring(0, y) + "\u2026", l(c), c = this.getSpanWidth(a, h), p === d ? p = d + 1 : c > x ? d = y - 1 : p = y;
                    0 === d && l("")
                }
                a.rotation = e;
                return g
            },
            escapes: {
                "\x26": "\x26amp;",
                "\x3c": "\x26lt;",
                "\x3e": "\x26gt;",
                "'": "\x26#39;",
                '"': "\x26quot"
            },
            buildText: function(a) {
                var x = a.element,
                    e = this,
                    p = e.forExport,
                    y = F(a.textStr, "").toString(),
                    d = -1 !== y.indexOf("\x3c"),
                    l = x.childNodes,
                    g, z, L, r, w = f(x, "x"),
                    B = a.styles,
                    A = a.textWidth,
                    k = B && B.lineHeight,
                    u = B && B.textOutline,
                    D = B && "ellipsis" === B.textOverflow,
                    R = B && "nowrap" === B.whiteSpace,
                    I = B && B.fontSize,
                    J, Q, v = l.length,
                    B = A && !a.added && this.box,
                    q = function(a) {
                        var b;
                        b = /(px|em)$/.test(a && a.style.fontSize) ? a.style.fontSize : I || e.style.fontSize || 12;
                        return k ? h(k) : e.fontMetrics(b, a.getAttribute("style") ? a : x).h
                    },
                    t = function(a) {
                        H(e.escapes, function(h, b) {
                            a = a.replace(new RegExp(h, "g"), b)
                        });
                        return a
                    };
                J = [y, D, R, k, u, I, A].join();
                if (J !== a.textCache) {
                    for (a.textCache = J; v--;) x.removeChild(l[v]);
                    d || u || D || A ||
                        -1 !== y.indexOf(" ") ? (g = /<.*class="([^"]+)".*>/, z = /<.*style="([^"]+)".*>/, L = /<.*href="([^"]+)".*>/, B && B.appendChild(x), y = d ? y.replace(/<(b|strong)>/g, '\x3cspan style\x3d"font-weight:bold"\x3e').replace(/<(i|em)>/g, '\x3cspan style\x3d"font-style:italic"\x3e').replace(/<a/g, "\x3cspan").replace(/<\/(b|strong|i|em|a)>/g, "\x3c/span\x3e").split(/<br.*?>/g) : [y], y = b(y, function(a) {
                            return "" !== a
                        }), c(y, function(h, b) {
                            var y, d = 0;
                            h = h.replace(/^\s+|\s+$/g, "").replace(/<span/g, "|||\x3cspan").replace(/<\/span>/g, "\x3c/span\x3e|||");
                            y = h.split("|||");
                            c(y, function(h) {
                                if ("" !== h || 1 === y.length) {
                                    var c = {},
                                        l = n.createElementNS(e.SVG_NS, "tspan"),
                                        B, H;
                                    g.test(h) && (B = h.match(g)[1], f(l, "class", B));
                                    z.test(h) && (H = h.match(z)[1].replace(/(;| |^)color([ :])/, "$1fill$2"), f(l, "style", H));
                                    L.test(h) && !p && (f(l, "onclick", 'location.href\x3d"' + h.match(L)[1] + '"'), f(l, "class", "highcharts-anchor"), m(l, {
                                        cursor: "pointer"
                                    }));
                                    h = t(h.replace(/<[a-zA-Z\/](.|\n)*?>/g, "") || " ");
                                    if (" " !== h) {
                                        l.appendChild(n.createTextNode(h));
                                        d ? c.dx = 0 : b && null !== w && (c.x = w);
                                        f(l, c);
                                        x.appendChild(l);
                                        !d && Q && (!K && p && m(l, {
                                            display: "block"
                                        }), f(l, "dy", q(l)));
                                        if (A) {
                                            c = h.replace(/([^\^])-/g, "$1- ").split(" ");
                                            B = 1 < y.length || b || 1 < c.length && !R;
                                            var O = [],
                                                k, u = q(l),
                                                I = a.rotation;
                                            for (D && (r = e.applyEllipsis(a, l, h, A)); !D && B && (c.length || O.length);) a.rotation = 0, k = e.getSpanWidth(a, l), h = k > A, void 0 === r && (r = h), h && 1 !== c.length ? (l.removeChild(l.firstChild), O.unshift(c.pop())) : (c = O, O = [], c.length && !R && (l = n.createElementNS(P, "tspan"), f(l, {
                                                dy: u,
                                                x: w
                                            }), H && f(l, "style", H), x.appendChild(l)), k > A && (A = k)), c.length && l.appendChild(n.createTextNode(c.join(" ").replace(/- /g,
                                                "-")));
                                            a.rotation = I
                                        }
                                        d++
                                    }
                                }
                            });
                            Q = Q || x.childNodes.length
                        }), r && a.attr("title", a.textStr), B && B.removeChild(x), u && a.applyTextOutline && a.applyTextOutline(u)) : x.appendChild(n.createTextNode(t(y)))
                }
            },
            getContrast: function(a) {
                a = t(a).rgba;
                return 510 < a[0] + a[1] + a[2] ? "#000000" : "#FFFFFF"
            },
            button: function(a, h, b, x, c, d, l, g, K) {
                var y = this.label(a, h, b, K, null, null, null, null, "button"),
                    n = 0;
                y.attr(p({
                    padding: 8,
                    r: 2
                }, c));
                var z, L, r, B;
                c = p({
                    fill: "#f7f7f7",
                    stroke: "#cccccc",
                    "stroke-width": 1,
                    style: {
                        color: "#333333",
                        cursor: "pointer",
                        fontWeight: "normal"
                    }
                }, c);
                z = c.style;
                delete c.style;
                d = p(c, {
                    fill: "#e6e6e6"
                }, d);
                L = d.style;
                delete d.style;
                l = p(c, {
                    fill: "#e6ebf5",
                    style: {
                        color: "#000000",
                        fontWeight: "bold"
                    }
                }, l);
                r = l.style;
                delete l.style;
                g = p(c, {
                    style: {
                        color: "#cccccc"
                    }
                }, g);
                B = g.style;
                delete g.style;
                G(y.element, J ? "mouseover" : "mouseenter", function() {
                    3 !== n && y.setState(1)
                });
                G(y.element, J ? "mouseout" : "mouseleave", function() {
                    3 !== n && y.setState(n)
                });
                y.setState = function(a) {
                    1 !== a && (y.state = n = a);
                    y.removeClass(/highcharts-button-(normal|hover|pressed|disabled)/).addClass("highcharts-button-" + ["normal", "hover", "pressed", "disabled"][a || 0]);
                    y.attr([c, d, l, g][a || 0]).css([z, L, r, B][a || 0])
                };
                y.attr(c).css(e({
                    cursor: "default"
                }, z));
                return y.on("click", function(a) {
                    3 !== n && x.call(y, a)
                })
            },
            crispLine: function(a, h) {
                a[1] === a[4] && (a[1] = a[4] = Math.round(a[1]) - h % 2 / 2);
                a[2] === a[5] && (a[2] = a[5] = Math.round(a[2]) + h % 2 / 2);
                return a
            },
            path: function(a) {
                var h = {
                    fill: "none"
                };
                I(a) ? h.d = a : w(a) && e(h, a);
                return this.createElement("path").attr(h)
            },
            circle: function(a, h, b) {
                a = w(a) ? a : {
                    x: a,
                    y: h,
                    r: b
                };
                h = this.createElement("circle");
                h.xSetter =
                    h.ySetter = function(a, h, b) {
                        b.setAttribute("c" + h, a)
                    };
                return h.attr(a)
            },
            arc: function(a, h, b, x, c, e) {
                w(a) ? (x = a, h = x.y, b = x.r, a = x.x) : x = {
                    innerR: x,
                    start: c,
                    end: e
                };
                a = this.symbol("arc", a, h, b, b, x);
                a.r = b;
                return a
            },
            rect: function(a, h, b, x, c, e) {
                c = w(a) ? a.r : c;
                var p = this.createElement("rect");
                a = w(a) ? a : void 0 === a ? {} : {
                    x: a,
                    y: h,
                    width: Math.max(b, 0),
                    height: Math.max(x, 0)
                };
                void 0 !== e && (a.strokeWidth = e, a = p.crisp(a));
                a.fill = "none";
                c && (a.r = c);
                p.rSetter = function(a, h, b) {
                    f(b, {
                        rx: a,
                        ry: a
                    })
                };
                return p.attr(a)
            },
            setSize: function(a, h, b) {
                var x =
                    this.alignedObjects,
                    c = x.length;
                this.width = a;
                this.height = h;
                for (this.boxWrapper.animate({
                        width: a,
                        height: h
                    }, {
                        step: function() {
                            this.attr({
                                viewBox: "0 0 " + this.attr("width") + " " + this.attr("height")
                            })
                        },
                        duration: F(b, !0) ? void 0 : 0
                    }); c--;) x[c].align()
            },
            g: function(a) {
                var h = this.createElement("g");
                return a ? h.attr({
                    "class": "highcharts-" + a
                }) : h
            },
            image: function(a, h, b, x, c) {
                var p = {
                    preserveAspectRatio: "none"
                };
                1 < arguments.length && e(p, {
                    x: h,
                    y: b,
                    width: x,
                    height: c
                });
                p = this.createElement("image").attr(p);
                p.element.setAttributeNS ?
                    p.element.setAttributeNS("http://www.w3.org/1999/xlink", "href", a) : p.element.setAttribute("hc-svg-href", a);
                return p
            },
            symbol: function(a, h, b, x, p, d) {
                var l = this,
                    y, g = /^url\((.*?)\)$/,
                    K = g.test(a),
                    z = !K && (this.symbols[a] ? a : "circle"),
                    r = z && this.symbols[z],
                    B = u(h) && r && r.call(this.symbols, Math.round(h), Math.round(b), x, p, d),
                    w, H;
                r ? (y = this.path(B), y.attr("fill", "none"), e(y, {
                    symbolName: z,
                    x: h,
                    y: b,
                    width: x,
                    height: p
                }), d && e(y, d)) : K && (w = a.match(g)[1], y = this.image(w), y.imgwidth = F(L[w] && L[w].width, d && d.width), y.imgheight =
                    F(L[w] && L[w].height, d && d.height), H = function() {
                        y.attr({
                            width: y.width,
                            height: y.height
                        })
                    }, c(["width", "height"], function(a) {
                        y[a + "Setter"] = function(a, h) {
                            var b = {},
                                x = this["img" + h],
                                c = "width" === h ? "translateX" : "translateY";
                            this[h] = a;
                            u(x) && (this.element && this.element.setAttribute(h, x), this.alignByTranslate || (b[c] = ((this[h] || 0) - x) / 2, this.attr(b)))
                        }
                    }), u(h) && y.attr({
                        x: h,
                        y: b
                    }), y.isImg = !0, u(y.imgwidth) && u(y.imgheight) ? H() : (y.attr({
                        width: 0,
                        height: 0
                    }), v("img", {
                        onload: function() {
                            var a = k[l.chartIndex];
                            0 === this.width &&
                                (m(this, {
                                    position: "absolute",
                                    top: "-999em"
                                }), n.body.appendChild(this));
                            L[w] = {
                                width: this.width,
                                height: this.height
                            };
                            y.imgwidth = this.width;
                            y.imgheight = this.height;
                            y.element && H();
                            this.parentNode && this.parentNode.removeChild(this);
                            l.imgCount--;
                            if (!l.imgCount && a && a.onload) a.onload()
                        },
                        src: w
                    }), this.imgCount++));
                return y
            },
            symbols: {
                circle: function(a, h, b, x) {
                    return this.arc(a + b / 2, h + x / 2, b / 2, x / 2, {
                        start: 0,
                        end: 2 * Math.PI,
                        open: !1
                    })
                },
                square: function(a, h, b, x) {
                    return ["M", a, h, "L", a + b, h, a + b, h + x, a, h + x, "Z"]
                },
                triangle: function(a,
                    h, b, x) {
                    return ["M", a + b / 2, h, "L", a + b, h + x, a, h + x, "Z"]
                },
                "triangle-down": function(a, h, b, x) {
                    return ["M", a, h, "L", a + b, h, a + b / 2, h + x, "Z"]
                },
                diamond: function(a, h, b, x) {
                    return ["M", a + b / 2, h, "L", a + b, h + x / 2, a + b / 2, h + x, a, h + x / 2, "Z"]
                },
                arc: function(a, h, b, x, c) {
                    var e = c.start,
                        p = c.r || b,
                        d = c.r || x || b,
                        l = c.end - .001;
                    b = c.innerR;
                    x = F(c.open, .001 > Math.abs(c.end - c.start - 2 * Math.PI));
                    var y = Math.cos(e),
                        g = Math.sin(e),
                        K = Math.cos(l),
                        l = Math.sin(l);
                    c = .001 > c.end - e - Math.PI ? 0 : 1;
                    p = ["M", a + p * y, h + d * g, "A", p, d, 0, c, 1, a + p * K, h + d * l];
                    u(b) && p.push(x ? "M" : "L", a + b *
                        K, h + b * l, "A", b, b, 0, c, 0, a + b * y, h + b * g);
                    p.push(x ? "" : "Z");
                    return p
                },
                callout: function(a, h, b, x, c) {
                    var e = Math.min(c && c.r || 0, b, x),
                        p = e + 6,
                        d = c && c.anchorX;
                    c = c && c.anchorY;
                    var l;
                    l = ["M", a + e, h, "L", a + b - e, h, "C", a + b, h, a + b, h, a + b, h + e, "L", a + b, h + x - e, "C", a + b, h + x, a + b, h + x, a + b - e, h + x, "L", a + e, h + x, "C", a, h + x, a, h + x, a, h + x - e, "L", a, h + e, "C", a, h, a, h, a + e, h];
                    d && d > b ? c > h + p && c < h + x - p ? l.splice(13, 3, "L", a + b, c - 6, a + b + 6, c, a + b, c + 6, a + b, h + x - e) : l.splice(13, 3, "L", a + b, x / 2, d, c, a + b, x / 2, a + b, h + x - e) : d && 0 > d ? c > h + p && c < h + x - p ? l.splice(33, 3, "L", a, c + 6, a - 6, c, a, c - 6,
                        a, h + e) : l.splice(33, 3, "L", a, x / 2, d, c, a, x / 2, a, h + e) : c && c > x && d > a + p && d < a + b - p ? l.splice(23, 3, "L", d + 6, h + x, d, h + x + 6, d - 6, h + x, a + e, h + x) : c && 0 > c && d > a + p && d < a + b - p && l.splice(3, 3, "L", d - 6, h, d, h - 6, d + 6, h, b - e, h);
                    return l
                }
            },
            clipRect: function(h, b, x, c) {
                var e = a.uniqueKey(),
                    p = this.createElement("clipPath").attr({
                        id: e
                    }).add(this.defs);
                h = this.rect(h, b, x, c, 0).add(p);
                h.id = e;
                h.clipPath = p;
                h.count = 0;
                return h
            },
            text: function(a, h, b, x) {
                var c = {};
                if (x && (this.allowHTML || !this.forExport)) return this.html(a, h, b);
                c.x = Math.round(h || 0);
                b && (c.y =
                    Math.round(b));
                if (a || 0 === a) c.text = a;
                a = this.createElement("text").attr(c);
                x || (a.xSetter = function(a, h, b) {
                    var x = b.getElementsByTagName("tspan"),
                        c, e = b.getAttribute(h),
                        p;
                    for (p = 0; p < x.length; p++) c = x[p], c.getAttribute(h) === e && c.setAttribute(h, a);
                    b.setAttribute(h, a)
                });
                return a
            },
            fontMetrics: function(a, b) {
                a = a || b && b.style && b.style.fontSize || this.style && this.style.fontSize;
                a = /px/.test(a) ? h(a) : /em/.test(a) ? parseFloat(a) * (b ? this.fontMetrics(null, b.parentNode).f : 16) : 12;
                b = 24 > a ? a + 3 : Math.round(1.2 * a);
                return {
                    h: b,
                    b: Math.round(.8 *
                        b),
                    f: a
                }
            },
            rotCorr: function(a, h, b) {
                var x = a;
                h && b && (x = Math.max(x * Math.cos(h * d), 4));
                return {
                    x: -a / 3 * Math.sin(h * d),
                    y: x
                }
            },
            label: function(h, b, d, l, g, K, n, z, L) {
                var y = this,
                    r = y.g("button" !== L && "label"),
                    w = r.text = y.text("", 0, 0, n).attr({
                        zIndex: 1
                    }),
                    B, H, m = 0,
                    A = 3,
                    k = 0,
                    f, D, I, R, J, Q = {},
                    F, v, P = /^url\((.*?)\)$/.test(l),
                    q = P,
                    t, O, M, T;
                L && r.addClass("highcharts-" + L);
                q = P;
                t = function() {
                    return (F || 0) % 2 / 2
                };
                O = function() {
                    var a = w.element.style,
                        h = {};
                    H = (void 0 === f || void 0 === D || J) && u(w.textStr) && w.getBBox();
                    r.width = (f || H.width || 0) + 2 * A + k;
                    r.height =
                        (D || H.height || 0) + 2 * A;
                    v = A + y.fontMetrics(a && a.fontSize, w).b;
                    q && (B || (r.box = B = y.symbols[l] || P ? y.symbol(l) : y.rect(), B.addClass(("button" === L ? "" : "highcharts-label-box") + (L ? " highcharts-" + L + "-box" : "")), B.add(r), a = t(), h.x = a, h.y = (z ? -v : 0) + a), h.width = Math.round(r.width), h.height = Math.round(r.height), B.attr(e(h, Q)), Q = {})
                };
                M = function() {
                    var a = k + A,
                        h;
                    h = z ? 0 : v;
                    u(f) && H && ("center" === J || "right" === J) && (a += {
                        center: .5,
                        right: 1
                    }[J] * (f - H.width));
                    if (a !== w.x || h !== w.y) w.attr("x", a), void 0 !== h && w.attr("y", h);
                    w.x = a;
                    w.y = h
                };
                T = function(a,
                    h) {
                    B ? B.attr(a, h) : Q[a] = h
                };
                r.onAdd = function() {
                    w.add(r);
                    r.attr({
                        text: h || 0 === h ? h : "",
                        x: b,
                        y: d
                    });
                    B && u(g) && r.attr({
                        anchorX: g,
                        anchorY: K
                    })
                };
                r.widthSetter = function(h) {
                    f = a.isNumber(h) ? h : null
                };
                r.heightSetter = function(a) {
                    D = a
                };
                r["text-alignSetter"] = function(a) {
                    J = a
                };
                r.paddingSetter = function(a) {
                    u(a) && a !== A && (A = r.padding = a, M())
                };
                r.paddingLeftSetter = function(a) {
                    u(a) && a !== k && (k = a, M())
                };
                r.alignSetter = function(a) {
                    a = {
                        left: 0,
                        center: .5,
                        right: 1
                    }[a];
                    a !== m && (m = a, H && r.attr({
                        x: I
                    }))
                };
                r.textSetter = function(a) {
                    void 0 !== a && w.textSetter(a);
                    O();
                    M()
                };
                r["stroke-widthSetter"] = function(a, h) {
                    a && (q = !0);
                    F = this["stroke-width"] = a;
                    T(h, a)
                };
                r.strokeSetter = r.fillSetter = r.rSetter = function(a, h) {
                    "r" !== h && ("fill" === h && a && (q = !0), r[h] = a);
                    T(h, a)
                };
                r.anchorXSetter = function(a, h) {
                    g = r.anchorX = a;
                    T(h, Math.round(a) - t() - I)
                };
                r.anchorYSetter = function(a, h) {
                    K = r.anchorY = a;
                    T(h, a - R)
                };
                r.xSetter = function(a) {
                    r.x = a;
                    m && (a -= m * ((f || H.width) + 2 * A));
                    I = Math.round(a);
                    r.attr("translateX", I)
                };
                r.ySetter = function(a) {
                    R = r.y = Math.round(a);
                    r.attr("translateY", R)
                };
                var U = r.css;
                return e(r, {
                    css: function(a) {
                        if (a) {
                            var h = {};
                            a = p(a);
                            c(r.textProps, function(b) {
                                void 0 !== a[b] && (h[b] = a[b], delete a[b])
                            });
                            w.css(h)
                        }
                        return U.call(r, a)
                    },
                    getBBox: function() {
                        return {
                            width: H.width + 2 * A,
                            height: H.height + 2 * A,
                            x: H.x - A,
                            y: H.y - A
                        }
                    },
                    shadow: function(a) {
                        a && (O(), B && B.shadow(a));
                        return r
                    },
                    destroy: function() {
                        x(r.element, "mouseenter");
                        x(r.element, "mouseleave");
                        w && (w = w.destroy());
                        B && (B = B.destroy());
                        E.prototype.destroy.call(r);
                        r = y = O = M = T = null
                    }
                })
            }
        });
        a.Renderer = C
    })(N);
    (function(a) {
        var E = a.attr,
            C = a.createElement,
            G = a.css,
            q = a.defined,
            f = a.each,
            k = a.extend,
            t = a.isFirefox,
            m = a.isMS,
            v = a.isWebKit,
            u = a.pInt,
            d = a.SVGRenderer,
            g = a.win,
            n = a.wrap;
        k(a.SVGElement.prototype, {
            htmlCss: function(a) {
                var c = this.element;
                if (c = a && "SPAN" === c.tagName && a.width) delete a.width, this.textWidth = c, this.updateTransform();
                a && "ellipsis" === a.textOverflow && (a.whiteSpace = "nowrap", a.overflow = "hidden");
                this.styles = k(this.styles, a);
                G(this.element, a);
                return this
            },
            htmlGetBBox: function() {
                var a = this.element;
                return {
                    x: a.offsetLeft,
                    y: a.offsetTop,
                    width: a.offsetWidth,
                    height: a.offsetHeight
                }
            },
            htmlUpdateTransform: function() {
                if (this.added) {
                    var a =
                        this.renderer,
                        e = this.element,
                        d = this.translateX || 0,
                        b = this.translateY || 0,
                        g = this.x || 0,
                        n = this.y || 0,
                        m = this.textAlign || "left",
                        r = {
                            left: 0,
                            center: .5,
                            right: 1
                        }[m],
                        k = this.styles;
                    G(e, {
                        marginLeft: d,
                        marginTop: b
                    });
                    this.shadows && f(this.shadows, function(a) {
                        G(a, {
                            marginLeft: d + 1,
                            marginTop: b + 1
                        })
                    });
                    this.inverted && f(e.childNodes, function(b) {
                        a.invertChild(b, e)
                    });
                    if ("SPAN" === e.tagName) {
                        var w = this.rotation,
                            D = u(this.textWidth),
                            t = k && k.whiteSpace,
                            p = [w, m, e.innerHTML, this.textWidth, this.textAlign].join();
                        p !== this.cTT && (k = a.fontMetrics(e.style.fontSize).b,
                            q(w) && this.setSpanRotation(w, r, k), G(e, {
                                width: "",
                                whiteSpace: t || "nowrap"
                            }), e.offsetWidth > D && /[ \-]/.test(e.textContent || e.innerText) && G(e, {
                                width: D + "px",
                                display: "block",
                                whiteSpace: t || "normal"
                            }), this.getSpanCorrection(e.offsetWidth, k, r, w, m));
                        G(e, {
                            left: g + (this.xCorr || 0) + "px",
                            top: n + (this.yCorr || 0) + "px"
                        });
                        v && (k = e.offsetHeight);
                        this.cTT = p
                    }
                } else this.alignOnAdd = !0
            },
            setSpanRotation: function(a, e, d) {
                var b = {},
                    c = this.renderer.getTransformKey();
                b[c] = b.transform = "rotate(" + a + "deg)";
                b[c + (t ? "Origin" : "-origin")] = b.transformOrigin =
                    100 * e + "% " + d + "px";
                G(this.element, b)
            },
            getSpanCorrection: function(a, e, d) {
                this.xCorr = -a * d;
                this.yCorr = -e
            }
        });
        k(d.prototype, {
            getTransformKey: function() {
                return m && !/Edge/.test(g.navigator.userAgent) ? "-ms-transform" : v ? "-webkit-transform" : t ? "MozTransform" : g.opera ? "-o-transform" : ""
            },
            html: function(a, e, d) {
                var b = this.createElement("span"),
                    c = b.element,
                    l = b.renderer,
                    g = l.isSVG,
                    r = function(a, b) {
                        f(["opacity", "visibility"], function(c) {
                            n(a, c + "Setter", function(a, c, e, d) {
                                a.call(this, c, e, d);
                                b[e] = c
                            })
                        })
                    };
                b.textSetter = function(a) {
                    a !==
                        c.innerHTML && delete this.bBox;
                    c.innerHTML = this.textStr = a;
                    b.htmlUpdateTransform()
                };
                g && r(b, b.element.style);
                b.xSetter = b.ySetter = b.alignSetter = b.rotationSetter = function(a, c) {
                    "align" === c && (c = "textAlign");
                    b[c] = a;
                    b.htmlUpdateTransform()
                };
                b.attr({
                    text: a,
                    x: Math.round(e),
                    y: Math.round(d)
                }).css({
                    fontFamily: this.style.fontFamily,
                    fontSize: this.style.fontSize,
                    position: "absolute"
                });
                c.style.whiteSpace = "nowrap";
                b.css = b.htmlCss;
                g && (b.add = function(a) {
                    var e, d = l.box.parentNode,
                        g = [];
                    if (this.parentGroup = a) {
                        if (e = a.div, !e) {
                            for (; a;) g.push(a),
                                a = a.parentGroup;
                            f(g.reverse(), function(a) {
                                function c(h, b) {
                                    a[b] = h;
                                    m ? p[l.getTransformKey()] = "translate(" + (a.x || a.translateX) + "px," + (a.y || a.translateY) + "px)" : "translateX" === b ? p.left = h + "px" : p.top = h + "px";
                                    a.doTransform = !0
                                }
                                var p, n = E(a.element, "class");
                                n && (n = {
                                    className: n
                                });
                                e = a.div = a.div || C("div", n, {
                                    position: "absolute",
                                    left: (a.translateX || 0) + "px",
                                    top: (a.translateY || 0) + "px",
                                    display: a.display,
                                    opacity: a.opacity,
                                    pointerEvents: a.styles && a.styles.pointerEvents
                                }, e || d);
                                p = e.style;
                                k(a, {
                                    classSetter: function(a) {
                                        this.element.setAttribute("class",
                                            a);
                                        e.className = a
                                    },
                                    on: function() {
                                        g[0].div && b.on.apply({
                                            element: g[0].div
                                        }, arguments);
                                        return a
                                    },
                                    translateXSetter: c,
                                    translateYSetter: c
                                });
                                r(a, p)
                            })
                        }
                    } else e = d;
                    e.appendChild(c);
                    b.added = !0;
                    b.alignOnAdd && b.htmlUpdateTransform();
                    return b
                });
                return b
            }
        })
    })(N);
    (function(a) {
        function E() {
            var m = a.defaultOptions.global,
                k = t.moment;
            if (m.timezone) {
                if (k) return function(a) {
                    return -k.tz(a, m.timezone).utcOffset()
                };
                a.error(25)
            }
            return m.useUTC && m.getTimezoneOffset
        }

        function C() {
            var m = a.defaultOptions.global,
                f, u = m.useUTC,
                d = u ? "getUTC" :
                "get",
                g = u ? "setUTC" : "set",
                n = "Minutes Hours Day Date Month FullYear".split(" "),
                c = n.concat(["Milliseconds", "Seconds"]);
            a.Date = f = m.Date || t.Date;
            f.hcTimezoneOffset = u && m.timezoneOffset;
            f.hcGetTimezoneOffset = E();
            f.hcMakeTime = function(a, c, b, d, g, n) {
                var e;
                u ? (e = f.UTC.apply(0, arguments), e += q(e)) : e = (new f(a, c, k(b, 1), k(d, 0), k(g, 0), k(n, 0))).getTime();
                return e
            };
            for (m = 0; m < n.length; m++) f["hcGet" + n[m]] = d + n[m];
            for (m = 0; m < c.length; m++) f["hcSet" + c[m]] = g + c[m]
        }
        var G = a.color,
            q = a.getTZOffset,
            f = a.merge,
            k = a.pick,
            t = a.win;
        a.defaultOptions = {
            colors: "#7cb5ec #434348 #90ed7d #f7a35c #8085e9 #f15c80 #e4d354 #2b908f #f45b5b #91e8e1".split(" "),
            symbols: ["circle", "diamond", "square", "triangle", "triangle-down"],
            lang: {
                loading: "Loading...",
                months: "January February March April May June July August September October November December".split(" "),
                shortMonths: "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(" "),
                weekdays: "Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "),
                decimalPoint: ".",
                numericSymbols: "kMGTPE".split(""),
                resetZoom: "Reset zoom",
                resetZoomTitle: "Reset zoom level 1:1",
                thousandsSep: " "
            },
            global: {
                useUTC: !0
            },
            chart: {
                borderRadius: 0,
                defaultSeriesType: "line",
                ignoreHiddenSeries: !0,
                spacing: [10, 10, 15, 10],
                resetZoomButton: {
                    theme: {
                        zIndex: 20
                    },
                    position: {
                        align: "right",
                        x: -10,
                        y: 10
                    }
                },
                width: null,
                height: null,
                borderColor: "#335cad",
                backgroundColor: "#ffffff",
                plotBorderColor: "#cccccc"
            },
            title: {
                text: "Chart title",
                align: "center",
                margin: 15,
                widthAdjust: -44
            },
            subtitle: {
                text: "",
                align: "center",
                widthAdjust: -44
            },
            plotOptions: {},
            labels: {
                style: {
                    position: "absolute",
                    color: "#333333"
                }
            },
            legend: {
                enabled: !0,
                align: "center",
                layout: "horizontal",
                labelFormatter: function() {
                    return this.name
                },
                borderColor: "#999999",
                borderRadius: 0,
                navigation: {
                    activeColor: "#003399",
                    inactiveColor: "#cccccc"
                },
                itemStyle: {
                    color: "#333333",
                    fontSize: "12px",
                    fontWeight: "bold",
                    textOverflow: "ellipsis"
                },
                itemHoverStyle: {
                    color: "#000000"
                },
                itemHiddenStyle: {
                    color: "#cccccc"
                },
                shadow: !1,
                itemCheckboxStyle: {
                    position: "absolute",
                    width: "13px",
                    height: "13px"
                },
                squareSymbol: !0,
                symbolPadding: 5,
                verticalAlign: "bottom",
                x: 0,
                y: 0,
                title: {
                    style: {
                        fontWeight: "bold"
                    }
                }
            },
            loading: {
                labelStyle: {
                    fontWeight: "bold",
                    position: "relative",
                    top: "45%"
                },
                style: {
                    position: "absolute",
                    backgroundColor: "#ffffff",
                    opacity: .5,
                    textAlign: "center"
                }
            },
            tooltip: {
                enabled: !0,
                animation: a.svg,
                borderRadius: 3,
                dateTimeLabelFormats: {
                    millisecond: "%A, %b %e, %H:%M:%S.%L",
                    second: "%A, %b %e, %H:%M:%S",
                    minute: "%A, %b %e, %H:%M",
                    hour: "%A, %b %e, %H:%M",
                    day: "%A, %b %e, %Y",
                    week: "Week from %A, %b %e, %Y",
                    month: "%B %Y",
                    year: "%Y"
                },
                footerFormat: "",
                padding: 8,
                snap: a.isTouchDevice ?
                    25 : 10,
                backgroundColor: G("#f7f7f7").setOpacity(.85).get(),
                borderWidth: 1,
                headerFormat: '\x3cspan style\x3d"font-size: 10px"\x3e{point.key}\x3c/span\x3e\x3cbr/\x3e',
                pointFormat: '\x3cspan style\x3d"color:{point.color}"\x3e\u25cf\x3c/span\x3e {series.name}: \x3cb\x3e{point.y}\x3c/b\x3e\x3cbr/\x3e',
                shadow: !0,
                style: {
                    color: "#333333",
                    cursor: "default",
                    fontSize: "12px",
                    pointerEvents: "none",
                    whiteSpace: "nowrap"
                }
            },
            credits: {
                enabled: !0,
                href: "http://www.highcharts.com",
                position: {
                    align: "right",
                    x: -10,
                    verticalAlign: "bottom",
                    y: -5
                },
                style: {
                    cursor: "pointer",
                    color: "#999999",
                    fontSize: "9px"
                },
                text: "Highcharts.com"
            }
        };
        a.setOptions = function(m) {
            a.defaultOptions = f(!0, a.defaultOptions, m);
            C();
            return a.defaultOptions
        };
        a.getOptions = function() {
            return a.defaultOptions
        };
        a.defaultPlotOptions = a.defaultOptions.plotOptions;
        C()
    })(N);
    (function(a) {
        var E = a.correctFloat,
            C = a.defined,
            G = a.destroyObjectProperties,
            q = a.isNumber,
            f = a.merge,
            k = a.pick,
            t = a.deg2rad;
        a.Tick = function(a, k, f, d) {
            this.axis = a;
            this.pos = k;
            this.type = f || "";
            this.isNewLabel = this.isNew = !0;
            f || d || this.addLabel()
        };
        a.Tick.prototype = {
            addLabel: function() {
                var a = this.axis,
                    v = a.options,
                    u = a.chart,
                    d = a.categories,
                    g = a.names,
                    n = this.pos,
                    c = v.labels,
                    e = a.tickPositions,
                    l = n === e[0],
                    b = n === e[e.length - 1],
                    g = d ? k(d[n], g[n], n) : n,
                    d = this.label,
                    e = e.info,
                    z;
                a.isDatetimeAxis && e && (z = v.dateTimeLabelFormats[e.higherRanks[n] || e.unitName]);
                this.isFirst = l;
                this.isLast = b;
                v = a.labelFormatter.call({
                    axis: a,
                    chart: u,
                    isFirst: l,
                    isLast: b,
                    dateTimeLabelFormat: z,
                    value: a.isLog ? E(a.lin2log(g)) : g,
                    pos: n
                });
                C(d) ? d && d.attr({
                    text: v
                }) : (this.labelLength =
                    (this.label = d = C(v) && c.enabled ? u.renderer.text(v, 0, 0, c.useHTML).css(f(c.style)).add(a.labelGroup) : null) && d.getBBox().width, this.rotation = 0)
            },
            getLabelSize: function() {
                return this.label ? this.label.getBBox()[this.axis.horiz ? "height" : "width"] : 0
            },
            handleOverflow: function(a) {
                var m = this.axis,
                    f = a.x,
                    d = m.chart.chartWidth,
                    g = m.chart.spacing,
                    n = k(m.labelLeft, Math.min(m.pos, g[3])),
                    g = k(m.labelRight, Math.max(m.pos + m.len, d - g[1])),
                    c = this.label,
                    e = this.rotation,
                    l = {
                        left: 0,
                        center: .5,
                        right: 1
                    }[m.labelAlign],
                    b = c.getBBox().width,
                    z = m.getSlotWidth(),
                    A = z,
                    I = 1,
                    r, J = {};
                if (e) 0 > e && f - l * b < n ? r = Math.round(f / Math.cos(e * t) - n) : 0 < e && f + l * b > g && (r = Math.round((d - f) / Math.cos(e * t)));
                else if (d = f + (1 - l) * b, f - l * b < n ? A = a.x + A * (1 - l) - n : d > g && (A = g - a.x + A * l, I = -1), A = Math.min(z, A), A < z && "center" === m.labelAlign && (a.x += I * (z - A - l * (z - Math.min(b, A)))), b > A || m.autoRotation && (c.styles || {}).width) r = A;
                r && (J.width = r, (m.options.labels.style || {}).textOverflow || (J.textOverflow = "ellipsis"), c.css(J))
            },
            getPosition: function(a, k, f, d) {
                var g = this.axis,
                    n = g.chart,
                    c = d && n.oldChartHeight ||
                    n.chartHeight;
                return {
                    x: a ? g.translate(k + f, null, null, d) + g.transB : g.left + g.offset + (g.opposite ? (d && n.oldChartWidth || n.chartWidth) - g.right - g.left : 0),
                    y: a ? c - g.bottom + g.offset - (g.opposite ? g.height : 0) : c - g.translate(k + f, null, null, d) - g.transB
                }
            },
            getLabelPosition: function(a, k, f, d, g, n, c, e) {
                var l = this.axis,
                    b = l.transA,
                    z = l.reversed,
                    A = l.staggerLines,
                    m = l.tickRotCorr || {
                        x: 0,
                        y: 0
                    },
                    r = g.y;
                C(r) || (r = 0 === l.side ? f.rotation ? -8 : -f.getBBox().height : 2 === l.side ? m.y + 8 : Math.cos(f.rotation * t) * (m.y - f.getBBox(!1, 0).height / 2));
                a = a + g.x +
                    m.x - (n && d ? n * b * (z ? -1 : 1) : 0);
                k = k + r - (n && !d ? n * b * (z ? 1 : -1) : 0);
                A && (f = c / (e || 1) % A, l.opposite && (f = A - f - 1), k += l.labelOffset / A * f);
                return {
                    x: a,
                    y: Math.round(k)
                }
            },
            getMarkPath: function(a, k, f, d, g, n) {
                return n.crispLine(["M", a, k, "L", a + (g ? 0 : -f), k + (g ? f : 0)], d)
            },
            renderGridLine: function(a, k, f) {
                var d = this.axis,
                    g = d.options,
                    n = this.gridLine,
                    c = {},
                    e = this.pos,
                    l = this.type,
                    b = d.tickmarkOffset,
                    z = d.chart.renderer,
                    A = l ? l + "Grid" : "grid",
                    m = g[A + "LineWidth"],
                    r = g[A + "LineColor"],
                    g = g[A + "LineDashStyle"];
                n || (c.stroke = r, c["stroke-width"] = m, g && (c.dashstyle =
                    g), l || (c.zIndex = 1), a && (c.opacity = 0), this.gridLine = n = z.path().attr(c).addClass("highcharts-" + (l ? l + "-" : "") + "grid-line").add(d.gridGroup));
                if (!a && n && (a = d.getPlotLinePath(e + b, n.strokeWidth() * f, a, !0))) n[this.isNew ? "attr" : "animate"]({
                    d: a,
                    opacity: k
                })
            },
            renderMark: function(a, f, u) {
                var d = this.axis,
                    g = d.options,
                    n = d.chart.renderer,
                    c = this.type,
                    e = c ? c + "Tick" : "tick",
                    l = d.tickSize(e),
                    b = this.mark,
                    z = !b,
                    A = a.x;
                a = a.y;
                var m = k(g[e + "Width"], !c && d.isXAxis ? 1 : 0),
                    g = g[e + "Color"];
                l && (d.opposite && (l[0] = -l[0]), z && (this.mark = b = n.path().addClass("highcharts-" +
                    (c ? c + "-" : "") + "tick").add(d.axisGroup), b.attr({
                    stroke: g,
                    "stroke-width": m
                })), b[z ? "attr" : "animate"]({
                    d: this.getMarkPath(A, a, l[0], b.strokeWidth() * u, d.horiz, n),
                    opacity: f
                }))
            },
            renderLabel: function(a, f, u, d) {
                var g = this.axis,
                    n = g.horiz,
                    c = g.options,
                    e = this.label,
                    l = c.labels,
                    b = l.step,
                    z = g.tickmarkOffset,
                    A = !0,
                    m = a.x;
                a = a.y;
                e && q(m) && (e.xy = a = this.getLabelPosition(m, a, e, n, l, z, d, b), this.isFirst && !this.isLast && !k(c.showFirstLabel, 1) || this.isLast && !this.isFirst && !k(c.showLastLabel, 1) ? A = !1 : !n || g.isRadial || l.step || l.rotation ||
                    f || 0 === u || this.handleOverflow(a), b && d % b && (A = !1), A && q(a.y) ? (a.opacity = u, e[this.isNewLabel ? "attr" : "animate"](a), this.isNewLabel = !1) : (e.attr("y", -9999), this.isNewLabel = !0))
            },
            render: function(a, f, u) {
                var d = this.axis,
                    g = d.horiz,
                    n = this.getPosition(g, this.pos, d.tickmarkOffset, f),
                    c = n.x,
                    e = n.y,
                    d = g && c === d.pos + d.len || !g && e === d.pos ? -1 : 1;
                u = k(u, 1);
                this.isActive = !0;
                this.renderGridLine(f, u, d);
                this.renderMark(n, u, d);
                this.renderLabel(n, f, u, a);
                this.isNew = !1
            },
            destroy: function() {
                G(this, this.axis)
            }
        }
    })(N);
    var V = function(a) {
        var E =
            a.addEvent,
            C = a.animObject,
            G = a.arrayMax,
            q = a.arrayMin,
            f = a.color,
            k = a.correctFloat,
            t = a.defaultOptions,
            m = a.defined,
            v = a.deg2rad,
            u = a.destroyObjectProperties,
            d = a.each,
            g = a.extend,
            n = a.fireEvent,
            c = a.format,
            e = a.getMagnitude,
            l = a.grep,
            b = a.inArray,
            z = a.isArray,
            A = a.isNumber,
            I = a.isString,
            r = a.merge,
            J = a.normalizeTickInterval,
            w = a.objectEach,
            D = a.pick,
            M = a.removeEvent,
            p = a.splat,
            B = a.syncTimeout,
            H = a.Tick,
            F = function() {
                this.init.apply(this, arguments)
            };
        a.extend(F.prototype, {
            defaultOptions: {
                dateTimeLabelFormats: {
                    millisecond: "%H:%M:%S.%L",
                    second: "%H:%M:%S",
                    minute: "%H:%M",
                    hour: "%H:%M",
                    day: "%e. %b",
                    week: "%e. %b",
                    month: "%b '%y",
                    year: "%Y"
                },
                endOnTick: !1,
                labels: {
                    enabled: !0,
                    style: {
                        color: "#666666",
                        cursor: "default",
                        fontSize: "11px"
                    },
                    x: 0
                },
                minPadding: .01,
                maxPadding: .01,
                minorTickLength: 2,
                minorTickPosition: "outside",
                startOfWeek: 1,
                startOnTick: !1,
                tickLength: 10,
                tickmarkPlacement: "between",
                tickPixelInterval: 100,
                tickPosition: "outside",
                title: {
                    align: "middle",
                    style: {
                        color: "#666666"
                    }
                },
                type: "linear",
                minorGridLineColor: "#f2f2f2",
                minorGridLineWidth: 1,
                minorTickColor: "#999999",
                lineColor: "#ccd6eb",
                lineWidth: 1,
                gridLineColor: "#e6e6e6",
                tickColor: "#ccd6eb"
            },
            defaultYAxisOptions: {
                endOnTick: !0,
                tickPixelInterval: 72,
                showLastLabel: !0,
                labels: {
                    x: -8
                },
                maxPadding: .05,
                minPadding: .05,
                startOnTick: !0,
                title: {
                    rotation: 270,
                    text: "Values"
                },
                stackLabels: {
                    allowOverlap: !1,
                    enabled: !1,
                    formatter: function() {
                        return a.numberFormat(this.total, -1)
                    },
                    style: {
                        fontSize: "11px",
                        fontWeight: "bold",
                        color: "#000000",
                        textOutline: "1px contrast"
                    }
                },
                gridLineWidth: 1,
                lineWidth: 0
            },
            defaultLeftAxisOptions: {
                labels: {
                    x: -15
                },
                title: {
                    rotation: 270
                }
            },
            defaultRightAxisOptions: {
                labels: {
                    x: 15
                },
                title: {
                    rotation: 90
                }
            },
            defaultBottomAxisOptions: {
                labels: {
                    autoRotation: [-45],
                    x: 0
                },
                title: {
                    rotation: 0
                }
            },
            defaultTopAxisOptions: {
                labels: {
                    autoRotation: [-45],
                    x: 0
                },
                title: {
                    rotation: 0
                }
            },
            init: function(a, x) {
                var h = x.isX,
                    c = this;
                c.chart = a;
                c.horiz = a.inverted && !c.isZAxis ? !h : h;
                c.isXAxis = h;
                c.coll = c.coll || (h ? "xAxis" : "yAxis");
                c.opposite = x.opposite;
                c.side = x.side || (c.horiz ? c.opposite ? 0 : 2 : c.opposite ? 1 : 3);
                c.setOptions(x);
                var e = this.options,
                    d = e.type;
                c.labelFormatter = e.labels.formatter ||
                    c.defaultLabelFormatter;
                c.userOptions = x;
                c.minPixelPadding = 0;
                c.reversed = e.reversed;
                c.visible = !1 !== e.visible;
                c.zoomEnabled = !1 !== e.zoomEnabled;
                c.hasNames = "category" === d || !0 === e.categories;
                c.categories = e.categories || c.hasNames;
                c.names = c.names || [];
                c.plotLinesAndBandsGroups = {};
                c.isLog = "logarithmic" === d;
                c.isDatetimeAxis = "datetime" === d;
                c.positiveValuesOnly = c.isLog && !c.allowNegativeLog;
                c.isLinked = m(e.linkedTo);
                c.ticks = {};
                c.labelEdge = [];
                c.minorTicks = {};
                c.plotLinesAndBands = [];
                c.alternateBands = {};
                c.len = 0;
                c.minRange =
                    c.userMinRange = e.minRange || e.maxZoom;
                c.range = e.range;
                c.offset = e.offset || 0;
                c.stacks = {};
                c.oldStacks = {};
                c.stacksTouched = 0;
                c.max = null;
                c.min = null;
                c.crosshair = D(e.crosshair, p(a.options.tooltip.crosshairs)[h ? 0 : 1], !1);
                x = c.options.events; - 1 === b(c, a.axes) && (h ? a.axes.splice(a.xAxis.length, 0, c) : a.axes.push(c), a[c.coll].push(c));
                c.series = c.series || [];
                a.inverted && !c.isZAxis && h && void 0 === c.reversed && (c.reversed = !0);
                w(x, function(a, h) {
                    E(c, h, a)
                });
                c.lin2log = e.linearToLogConverter || c.lin2log;
                c.isLog && (c.val2lin = c.log2lin,
                    c.lin2val = c.lin2log)
            },
            setOptions: function(a) {
                this.options = r(this.defaultOptions, "yAxis" === this.coll && this.defaultYAxisOptions, [this.defaultTopAxisOptions, this.defaultRightAxisOptions, this.defaultBottomAxisOptions, this.defaultLeftAxisOptions][this.side], r(t[this.coll], a))
            },
            defaultLabelFormatter: function() {
                var h = this.axis,
                    b = this.value,
                    e = h.categories,
                    d = this.dateTimeLabelFormat,
                    p = t.lang,
                    l = p.numericSymbols,
                    p = p.numericSymbolMagnitude || 1E3,
                    g = l && l.length,
                    n, r = h.options.labels.format,
                    h = h.isLog ? Math.abs(b) :
                    h.tickInterval;
                if (r) n = c(r, this);
                else if (e) n = b;
                else if (d) n = a.dateFormat(d, b);
                else if (g && 1E3 <= h)
                    for (; g-- && void 0 === n;) e = Math.pow(p, g + 1), h >= e && 0 === 10 * b % e && null !== l[g] && 0 !== b && (n = a.numberFormat(b / e, -1) + l[g]);
                void 0 === n && (n = 1E4 <= Math.abs(b) ? a.numberFormat(b, -1) : a.numberFormat(b, -1, void 0, ""));
                return n
            },
            getSeriesExtremes: function() {
                var a = this,
                    b = a.chart;
                a.hasVisibleSeries = !1;
                a.dataMin = a.dataMax = a.threshold = null;
                a.softThreshold = !a.isXAxis;
                a.buildStacks && a.buildStacks();
                d(a.series, function(h) {
                    if (h.visible ||
                        !b.options.chart.ignoreHiddenSeries) {
                        var c = h.options,
                            x = c.threshold,
                            e;
                        a.hasVisibleSeries = !0;
                        a.positiveValuesOnly && 0 >= x && (x = null);
                        if (a.isXAxis) c = h.xData, c.length && (h = q(c), A(h) || h instanceof Date || (c = l(c, function(a) {
                            return A(a)
                        }), h = q(c)), a.dataMin = Math.min(D(a.dataMin, c[0]), h), a.dataMax = Math.max(D(a.dataMax, c[0]), G(c)));
                        else if (h.getExtremes(), e = h.dataMax, h = h.dataMin, m(h) && m(e) && (a.dataMin = Math.min(D(a.dataMin, h), h), a.dataMax = Math.max(D(a.dataMax, e), e)), m(x) && (a.threshold = x), !c.softThreshold || a.positiveValuesOnly) a.softThreshold = !1
                    }
                })
            },
            translate: function(a, b, c, e, d, p) {
                var h = this.linkedParent || this,
                    x = 1,
                    l = 0,
                    g = e ? h.oldTransA : h.transA;
                e = e ? h.oldMin : h.min;
                var n = h.minPixelPadding;
                d = (h.isOrdinal || h.isBroken || h.isLog && d) && h.lin2val;
                g || (g = h.transA);
                c && (x *= -1, l = h.len);
                h.reversed && (x *= -1, l -= x * (h.sector || h.len));
                b ? (a = (a * x + l - n) / g + e, d && (a = h.lin2val(a))) : (d && (a = h.val2lin(a)), a = A(e) ? x * (a - e) * g + l + x * n + (A(p) ? g * p : 0) : void 0);
                return a
            },
            toPixels: function(a, b) {
                return this.translate(a, !1, !this.horiz, null, !0) + (b ? 0 : this.pos)
            },
            toValue: function(a, b) {
                return this.translate(a -
                    (b ? 0 : this.pos), !0, !this.horiz, null, !0)
            },
            getPlotLinePath: function(a, b, c, e, d) {
                var h = this.chart,
                    x = this.left,
                    p = this.top,
                    l, g, n = c && h.oldChartHeight || h.chartHeight,
                    r = c && h.oldChartWidth || h.chartWidth,
                    z;
                l = this.transB;
                var w = function(a, h, b) {
                    if (a < h || a > b) e ? a = Math.min(Math.max(h, a), b) : z = !0;
                    return a
                };
                d = D(d, this.translate(a, null, null, c));
                a = c = Math.round(d + l);
                l = g = Math.round(n - d - l);
                A(d) ? this.horiz ? (l = p, g = n - this.bottom, a = c = w(a, x, x + this.width)) : (a = x, c = r - this.right, l = g = w(l, p, p + this.height)) : (z = !0, e = !1);
                return z && !e ? null :
                    h.renderer.crispLine(["M", a, l, "L", c, g], b || 1)
            },
            getLinearTickPositions: function(a, b, c) {
                var h, x = k(Math.floor(b / a) * a);
                c = k(Math.ceil(c / a) * a);
                var e = [];
                if (this.single) return [b];
                for (b = x; b <= c;) {
                    e.push(b);
                    b = k(b + a);
                    if (b === h) break;
                    h = b
                }
                return e
            },
            getMinorTickInterval: function() {
                var a = this.options;
                return !0 === a.minorTicks ? D(a.minorTickInterval, "auto") : !1 === a.minorTicks ? null : a.minorTickInterval
            },
            getMinorTickPositions: function() {
                var a = this,
                    b = a.options,
                    c = a.tickPositions,
                    e = a.minorTickInterval,
                    p = [],
                    l = a.pointRangePadding ||
                    0,
                    g = a.min - l,
                    l = a.max + l,
                    n = l - g;
                if (n && n / e < a.len / 3)
                    if (a.isLog) d(this.paddedTicks, function(h, b, c) {
                        b && p.push.apply(p, a.getLogTickPositions(e, c[b - 1], c[b], !0))
                    });
                    else if (a.isDatetimeAxis && "auto" === this.getMinorTickInterval()) p = p.concat(a.getTimeTicks(a.normalizeTimeTickInterval(e), g, l, b.startOfWeek));
                else
                    for (b = g + (c[0] - g) % e; b <= l && b !== p[0]; b += e) p.push(b);
                0 !== p.length && a.trimTicks(p);
                return p
            },
            adjustForMinRange: function() {
                var a = this.options,
                    b = this.min,
                    c = this.max,
                    e, p, l, g, n, r, z, w;
                this.isXAxis && void 0 === this.minRange &&
                    !this.isLog && (m(a.min) || m(a.max) ? this.minRange = null : (d(this.series, function(a) {
                        r = a.xData;
                        for (g = z = a.xIncrement ? 1 : r.length - 1; 0 < g; g--)
                            if (n = r[g] - r[g - 1], void 0 === l || n < l) l = n
                    }), this.minRange = Math.min(5 * l, this.dataMax - this.dataMin)));
                c - b < this.minRange && (p = this.dataMax - this.dataMin >= this.minRange, w = this.minRange, e = (w - c + b) / 2, e = [b - e, D(a.min, b - e)], p && (e[2] = this.isLog ? this.log2lin(this.dataMin) : this.dataMin), b = G(e), c = [b + w, D(a.max, b + w)], p && (c[2] = this.isLog ? this.log2lin(this.dataMax) : this.dataMax), c = q(c), c - b < w &&
                    (e[0] = c - w, e[1] = D(a.min, c - w), b = G(e)));
                this.min = b;
                this.max = c
            },
            getClosest: function() {
                var a;
                this.categories ? a = 1 : d(this.series, function(h) {
                    var b = h.closestPointRange,
                        c = h.visible || !h.chart.options.chart.ignoreHiddenSeries;
                    !h.noSharedTooltip && m(b) && c && (a = m(a) ? Math.min(a, b) : b)
                });
                return a
            },
            nameToX: function(a) {
                var h = z(this.categories),
                    c = h ? this.categories : this.names,
                    e = a.options.x,
                    d;
                a.series.requireSorting = !1;
                m(e) || (e = !1 === this.options.uniqueNames ? a.series.autoIncrement() : b(a.name, c)); - 1 === e ? h || (d = c.length) : d =
                    e;
                void 0 !== d && (this.names[d] = a.name);
                return d
            },
            updateNames: function() {
                var a = this;
                0 < this.names.length && (this.names.length = 0, this.minRange = this.userMinRange, d(this.series || [], function(h) {
                    h.xIncrement = null;
                    if (!h.points || h.isDirtyData) h.processData(), h.generatePoints();
                    d(h.points, function(b, c) {
                        var e;
                        b.options && (e = a.nameToX(b), void 0 !== e && e !== b.x && (b.x = e, h.xData[c] = e))
                    })
                }))
            },
            setAxisTranslation: function(a) {
                var h = this,
                    b = h.max - h.min,
                    c = h.axisPointRange || 0,
                    e, p = 0,
                    l = 0,
                    g = h.linkedParent,
                    n = !!h.categories,
                    r = h.transA,
                    z = h.isXAxis;
                if (z || n || c) e = h.getClosest(), g ? (p = g.minPointOffset, l = g.pointRangePadding) : d(h.series, function(a) {
                    var b = n ? 1 : z ? D(a.options.pointRange, e, 0) : h.axisPointRange || 0;
                    a = a.options.pointPlacement;
                    c = Math.max(c, b);
                    h.single || (p = Math.max(p, I(a) ? 0 : b / 2), l = Math.max(l, "on" === a ? 0 : b))
                }), g = h.ordinalSlope && e ? h.ordinalSlope / e : 1, h.minPointOffset = p *= g, h.pointRangePadding = l *= g, h.pointRange = Math.min(c, b), z && (h.closestPointRange = e);
                a && (h.oldTransA = r);
                h.translationSlope = h.transA = r = h.options.staticScale || h.len / (b + l ||
                    1);
                h.transB = h.horiz ? h.left : h.bottom;
                h.minPixelPadding = r * p
            },
            minFromRange: function() {
                return this.max - this.range
            },
            setTickInterval: function(h) {
                var b = this,
                    c = b.chart,
                    p = b.options,
                    l = b.isLog,
                    g = b.log2lin,
                    r = b.isDatetimeAxis,
                    z = b.isXAxis,
                    w = b.isLinked,
                    B = p.maxPadding,
                    H = p.minPadding,
                    f = p.tickInterval,
                    u = p.tickPixelInterval,
                    I = b.categories,
                    F = b.threshold,
                    q = b.softThreshold,
                    t, v, M, C;
                r || I || w || this.getTickAmount();
                M = D(b.userMin, p.min);
                C = D(b.userMax, p.max);
                w ? (b.linkedParent = c[b.coll][p.linkedTo], c = b.linkedParent.getExtremes(),
                    b.min = D(c.min, c.dataMin), b.max = D(c.max, c.dataMax), p.type !== b.linkedParent.options.type && a.error(11, 1)) : (!q && m(F) && (b.dataMin >= F ? (t = F, H = 0) : b.dataMax <= F && (v = F, B = 0)), b.min = D(M, t, b.dataMin), b.max = D(C, v, b.dataMax));
                l && (b.positiveValuesOnly && !h && 0 >= Math.min(b.min, D(b.dataMin, b.min)) && a.error(10, 1), b.min = k(g(b.min), 15), b.max = k(g(b.max), 15));
                b.range && m(b.max) && (b.userMin = b.min = M = Math.max(b.dataMin, b.minFromRange()), b.userMax = C = b.max, b.range = null);
                n(b, "foundExtremes");
                b.beforePadding && b.beforePadding();
                b.adjustForMinRange();
                !(I || b.axisPointRange || b.usePercentage || w) && m(b.min) && m(b.max) && (g = b.max - b.min) && (!m(M) && H && (b.min -= g * H), !m(C) && B && (b.max += g * B));
                A(p.softMin) && (b.min = Math.min(b.min, p.softMin));
                A(p.softMax) && (b.max = Math.max(b.max, p.softMax));
                A(p.floor) && (b.min = Math.max(b.min, p.floor));
                A(p.ceiling) && (b.max = Math.min(b.max, p.ceiling));
                q && m(b.dataMin) && (F = F || 0, !m(M) && b.min < F && b.dataMin >= F ? b.min = F : !m(C) && b.max > F && b.dataMax <= F && (b.max = F));
                b.tickInterval = b.min === b.max || void 0 === b.min || void 0 === b.max ? 1 : w && !f && u === b.linkedParent.options.tickPixelInterval ?
                    f = b.linkedParent.tickInterval : D(f, this.tickAmount ? (b.max - b.min) / Math.max(this.tickAmount - 1, 1) : void 0, I ? 1 : (b.max - b.min) * u / Math.max(b.len, u));
                z && !h && d(b.series, function(a) {
                    a.processData(b.min !== b.oldMin || b.max !== b.oldMax)
                });
                b.setAxisTranslation(!0);
                b.beforeSetTickPositions && b.beforeSetTickPositions();
                b.postProcessTickInterval && (b.tickInterval = b.postProcessTickInterval(b.tickInterval));
                b.pointRange && !f && (b.tickInterval = Math.max(b.pointRange, b.tickInterval));
                h = D(p.minTickInterval, b.isDatetimeAxis && b.closestPointRange);
                !f && b.tickInterval < h && (b.tickInterval = h);
                r || l || f || (b.tickInterval = J(b.tickInterval, null, e(b.tickInterval), D(p.allowDecimals, !(.5 < b.tickInterval && 5 > b.tickInterval && 1E3 < b.max && 9999 > b.max)), !!this.tickAmount));
                this.tickAmount || (b.tickInterval = b.unsquish());
                this.setTickPositions()
            },
            setTickPositions: function() {
                var a = this.options,
                    b, c = a.tickPositions;
                b = this.getMinorTickInterval();
                var e = a.tickPositioner,
                    p = a.startOnTick,
                    d = a.endOnTick;
                this.tickmarkOffset = this.categories && "between" === a.tickmarkPlacement && 1 ===
                    this.tickInterval ? .5 : 0;
                this.minorTickInterval = "auto" === b && this.tickInterval ? this.tickInterval / 5 : b;
                this.single = this.min === this.max && m(this.min) && !this.tickAmount && (parseInt(this.min, 10) === this.min || !1 !== a.allowDecimals);
                this.tickPositions = b = c && c.slice();
                !b && (b = this.isDatetimeAxis ? this.getTimeTicks(this.normalizeTimeTickInterval(this.tickInterval, a.units), this.min, this.max, a.startOfWeek, this.ordinalPositions, this.closestPointRange, !0) : this.isLog ? this.getLogTickPositions(this.tickInterval, this.min, this.max) :
                    this.getLinearTickPositions(this.tickInterval, this.min, this.max), b.length > this.len && (b = [b[0], b.pop()]), this.tickPositions = b, e && (e = e.apply(this, [this.min, this.max]))) && (this.tickPositions = b = e);
                this.paddedTicks = b.slice(0);
                this.trimTicks(b, p, d);
                this.isLinked || (this.single && 2 > b.length && (this.min -= .5, this.max += .5), c || e || this.adjustTickAmount())
            },
            trimTicks: function(a, b, c) {
                var h = a[0],
                    e = a[a.length - 1],
                    p = this.minPointOffset || 0;
                if (!this.isLinked) {
                    if (b && -Infinity !== h) this.min = h;
                    else
                        for (; this.min - p > a[0];) a.shift();
                    if (c) this.max = e;
                    else
                        for (; this.max + p < a[a.length - 1];) a.pop();
                    0 === a.length && m(h) && a.push((e + h) / 2)
                }
            },
            alignToOthers: function() {
                var a = {},
                    b, c = this.options;
                !1 === this.chart.options.chart.alignTicks || !1 === c.alignTicks || this.isLog || d(this.chart[this.coll], function(h) {
                    var c = h.options,
                        c = [h.horiz ? c.left : c.top, c.width, c.height, c.pane].join();
                    h.series.length && (a[c] ? b = !0 : a[c] = 1)
                });
                return b
            },
            getTickAmount: function() {
                var a = this.options,
                    b = a.tickAmount,
                    c = a.tickPixelInterval;
                !m(a.tickInterval) && this.len < c && !this.isRadial &&
                    !this.isLog && a.startOnTick && a.endOnTick && (b = 2);
                !b && this.alignToOthers() && (b = Math.ceil(this.len / c) + 1);
                4 > b && (this.finalTickAmt = b, b = 5);
                this.tickAmount = b
            },
            adjustTickAmount: function() {
                var a = this.tickInterval,
                    b = this.tickPositions,
                    c = this.tickAmount,
                    e = this.finalTickAmt,
                    p = b && b.length;
                if (p < c) {
                    for (; b.length < c;) b.push(k(b[b.length - 1] + a));
                    this.transA *= (p - 1) / (c - 1);
                    this.max = b[b.length - 1]
                } else p > c && (this.tickInterval *= 2, this.setTickPositions());
                if (m(e)) {
                    for (a = c = b.length; a--;)(3 === e && 1 === a % 2 || 2 >= e && 0 < a && a < c - 1) && b.splice(a,
                        1);
                    this.finalTickAmt = void 0
                }
            },
            setScale: function() {
                var a, b;
                this.oldMin = this.min;
                this.oldMax = this.max;
                this.oldAxisLength = this.len;
                this.setAxisSize();
                b = this.len !== this.oldAxisLength;
                d(this.series, function(b) {
                    if (b.isDirtyData || b.isDirty || b.xAxis.isDirty) a = !0
                });
                b || a || this.isLinked || this.forceRedraw || this.userMin !== this.oldUserMin || this.userMax !== this.oldUserMax || this.alignToOthers() ? (this.resetStacks && this.resetStacks(), this.forceRedraw = !1, this.getSeriesExtremes(), this.setTickInterval(), this.oldUserMin =
                    this.userMin, this.oldUserMax = this.userMax, this.isDirty || (this.isDirty = b || this.min !== this.oldMin || this.max !== this.oldMax)) : this.cleanStacks && this.cleanStacks()
            },
            setExtremes: function(a, b, c, e, p) {
                var h = this,
                    l = h.chart;
                c = D(c, !0);
                d(h.series, function(a) {
                    delete a.kdTree
                });
                p = g(p, {
                    min: a,
                    max: b
                });
                n(h, "setExtremes", p, function() {
                    h.userMin = a;
                    h.userMax = b;
                    h.eventArgs = p;
                    c && l.redraw(e)
                })
            },
            zoom: function(a, b) {
                var h = this.dataMin,
                    c = this.dataMax,
                    e = this.options,
                    p = Math.min(h, D(e.min, h)),
                    e = Math.max(c, D(e.max, c));
                if (a !== this.min ||
                    b !== this.max) this.allowZoomOutside || (m(h) && (a < p && (a = p), a > e && (a = e)), m(c) && (b < p && (b = p), b > e && (b = e))), this.displayBtn = void 0 !== a || void 0 !== b, this.setExtremes(a, b, !1, void 0, {
                    trigger: "zoom"
                });
                return !0
            },
            setAxisSize: function() {
                var b = this.chart,
                    c = this.options,
                    e = c.offsets || [0, 0, 0, 0],
                    p = this.horiz,
                    d = this.width = Math.round(a.relativeLength(D(c.width, b.plotWidth - e[3] + e[1]), b.plotWidth)),
                    l = this.height = Math.round(a.relativeLength(D(c.height, b.plotHeight - e[0] + e[2]), b.plotHeight)),
                    g = this.top = Math.round(a.relativeLength(D(c.top,
                        b.plotTop + e[0]), b.plotHeight, b.plotTop)),
                    c = this.left = Math.round(a.relativeLength(D(c.left, b.plotLeft + e[3]), b.plotWidth, b.plotLeft));
                this.bottom = b.chartHeight - l - g;
                this.right = b.chartWidth - d - c;
                this.len = Math.max(p ? d : l, 0);
                this.pos = p ? c : g
            },
            getExtremes: function() {
                var a = this.isLog,
                    b = this.lin2log;
                return {
                    min: a ? k(b(this.min)) : this.min,
                    max: a ? k(b(this.max)) : this.max,
                    dataMin: this.dataMin,
                    dataMax: this.dataMax,
                    userMin: this.userMin,
                    userMax: this.userMax
                }
            },
            getThreshold: function(a) {
                var b = this.isLog,
                    h = this.lin2log,
                    c = b ?
                    h(this.min) : this.min,
                    b = b ? h(this.max) : this.max;
                null === a ? a = c : c > a ? a = c : b < a && (a = b);
                return this.translate(a, 0, 1, 0, 1)
            },
            autoLabelAlign: function(a) {
                a = (D(a, 0) - 90 * this.side + 720) % 360;
                return 15 < a && 165 > a ? "right" : 195 < a && 345 > a ? "left" : "center"
            },
            tickSize: function(a) {
                var b = this.options,
                    h = b[a + "Length"],
                    c = D(b[a + "Width"], "tick" === a && this.isXAxis ? 1 : 0);
                if (c && h) return "inside" === b[a + "Position"] && (h = -h), [h, c]
            },
            labelMetrics: function() {
                var a = this.tickPositions && this.tickPositions[0] || 0;
                return this.chart.renderer.fontMetrics(this.options.labels.style &&
                    this.options.labels.style.fontSize, this.ticks[a] && this.ticks[a].label)
            },
            unsquish: function() {
                var a = this.options.labels,
                    b = this.horiz,
                    c = this.tickInterval,
                    e = c,
                    p = this.len / (((this.categories ? 1 : 0) + this.max - this.min) / c),
                    l, g = a.rotation,
                    n = this.labelMetrics(),
                    r, z = Number.MAX_VALUE,
                    w, B = function(a) {
                        a /= p || 1;
                        a = 1 < a ? Math.ceil(a) : 1;
                        return a * c
                    };
                b ? (w = !a.staggerLines && !a.step && (m(g) ? [g] : p < D(a.autoRotationLimit, 80) && a.autoRotation)) && d(w, function(a) {
                    var b;
                    if (a === g || a && -90 <= a && 90 >= a) r = B(Math.abs(n.h / Math.sin(v * a))), b = r +
                        Math.abs(a / 360), b < z && (z = b, l = a, e = r)
                }) : a.step || (e = B(n.h));
                this.autoRotation = w;
                this.labelRotation = D(l, g);
                return e
            },
            getSlotWidth: function() {
                var a = this.chart,
                    b = this.horiz,
                    c = this.options.labels,
                    e = Math.max(this.tickPositions.length - (this.categories ? 0 : 1), 1),
                    p = a.margin[3];
                return b && 2 > (c.step || 0) && !c.rotation && (this.staggerLines || 1) * this.len / e || !b && (c.style && parseInt(c.style.width, 10) || p && p - a.spacing[3] || .33 * a.chartWidth)
            },
            renderUnsquish: function() {
                var a = this.chart,
                    b = a.renderer,
                    c = this.tickPositions,
                    e = this.ticks,
                    p = this.options.labels,
                    l = this.horiz,
                    g = this.getSlotWidth(),
                    n = Math.max(1, Math.round(g - 2 * (p.padding || 5))),
                    z = {},
                    w = this.labelMetrics(),
                    B = p.style && p.style.textOverflow,
                    H, f = 0,
                    k, A;
                I(p.rotation) || (z.rotation = p.rotation || 0);
                d(c, function(a) {
                    (a = e[a]) && a.labelLength > f && (f = a.labelLength)
                });
                this.maxLabelLength = f;
                if (this.autoRotation) f > n && f > w.h ? z.rotation = this.labelRotation : this.labelRotation = 0;
                else if (g && (H = {
                        width: n + "px"
                    }, !B))
                    for (H.textOverflow = "clip", k = c.length; !l && k--;)
                        if (A = c[k], n = e[A].label) n.styles && "ellipsis" ===
                            n.styles.textOverflow ? n.css({
                                textOverflow: "clip"
                            }) : e[A].labelLength > g && n.css({
                                width: g + "px"
                            }), n.getBBox().height > this.len / c.length - (w.h - w.f) && (n.specCss = {
                                textOverflow: "ellipsis"
                            });
                z.rotation && (H = {
                    width: (f > .5 * a.chartHeight ? .33 * a.chartHeight : a.chartHeight) + "px"
                }, B || (H.textOverflow = "ellipsis"));
                if (this.labelAlign = p.align || this.autoLabelAlign(this.labelRotation)) z.align = this.labelAlign;
                d(c, function(a) {
                    var b = (a = e[a]) && a.label;
                    b && (b.attr(z), H && b.css(r(H, b.specCss)), delete b.specCss, a.rotation = z.rotation)
                });
                this.tickRotCorr = b.rotCorr(w.b, this.labelRotation || 0, 0 !== this.side)
            },
            hasData: function() {
                return this.hasVisibleSeries || m(this.min) && m(this.max) && !!this.tickPositions
            },
            addTitle: function(a) {
                var b = this.chart.renderer,
                    h = this.horiz,
                    c = this.opposite,
                    e = this.options.title,
                    p;
                this.axisTitle || ((p = e.textAlign) || (p = (h ? {
                    low: "left",
                    middle: "center",
                    high: "right"
                } : {
                    low: c ? "right" : "left",
                    middle: "center",
                    high: c ? "left" : "right"
                })[e.align]), this.axisTitle = b.text(e.text, 0, 0, e.useHTML).attr({
                    zIndex: 7,
                    rotation: e.rotation || 0,
                    align: p
                }).addClass("highcharts-axis-title").css(e.style).add(this.axisGroup), this.axisTitle.isNew = !0);
                e.style.width || this.isRadial || this.axisTitle.css({
                    width: this.len
                });
                this.axisTitle[a ? "show" : "hide"](!0)
            },
            generateTick: function(a) {
                var b = this.ticks;
                b[a] ? b[a].addLabel() : b[a] = new H(this, a)
            },
            getOffset: function() {
                var a = this,
                    b = a.chart,
                    c = b.renderer,
                    e = a.options,
                    p = a.tickPositions,
                    l = a.ticks,
                    g = a.horiz,
                    n = a.side,
                    r = b.inverted && !a.isZAxis ? [1, 0, 3, 2][n] : n,
                    z, B, H = 0,
                    f, k = 0,
                    A = e.title,
                    u = e.labels,
                    F = 0,
                    I = b.axisOffset,
                    b = b.clipOffset,
                    J = [-1, 1, 1, -1][n],
                    q = e.className,
                    t = a.axisParent,
                    v = this.tickSize("tick");
                z = a.hasData();
                a.showAxis = B = z || D(e.showEmpty, !0);
                a.staggerLines = a.horiz && u.staggerLines;
                a.axisGroup || (a.gridGroup = c.g("grid").attr({
                    zIndex: e.gridZIndex || 1
                }).addClass("highcharts-" + this.coll.toLowerCase() + "-grid " + (q || "")).add(t), a.axisGroup = c.g("axis").attr({
                    zIndex: e.zIndex || 2
                }).addClass("highcharts-" + this.coll.toLowerCase() + " " + (q || "")).add(t), a.labelGroup = c.g("axis-labels").attr({
                    zIndex: u.zIndex || 7
                }).addClass("highcharts-" + a.coll.toLowerCase() +
                    "-labels " + (q || "")).add(t));
                z || a.isLinked ? (d(p, function(b, c) {
                    a.generateTick(b, c)
                }), a.renderUnsquish(), !1 === u.reserveSpace || 0 !== n && 2 !== n && {
                    1: "left",
                    3: "right"
                }[n] !== a.labelAlign && "center" !== a.labelAlign || d(p, function(a) {
                    F = Math.max(l[a].getLabelSize(), F)
                }), a.staggerLines && (F *= a.staggerLines, a.labelOffset = F * (a.opposite ? -1 : 1))) : w(l, function(a, b) {
                    a.destroy();
                    delete l[b]
                });
                A && A.text && !1 !== A.enabled && (a.addTitle(B), B && !1 !== A.reserveSpace && (a.titleOffset = H = a.axisTitle.getBBox()[g ? "height" : "width"], f = A.offset,
                    k = m(f) ? 0 : D(A.margin, g ? 5 : 10)));
                a.renderLine();
                a.offset = J * D(e.offset, I[n]);
                a.tickRotCorr = a.tickRotCorr || {
                    x: 0,
                    y: 0
                };
                c = 0 === n ? -a.labelMetrics().h : 2 === n ? a.tickRotCorr.y : 0;
                k = Math.abs(F) + k;
                F && (k = k - c + J * (g ? D(u.y, a.tickRotCorr.y + 8 * J) : u.x));
                a.axisTitleMargin = D(f, k);
                I[n] = Math.max(I[n], a.axisTitleMargin + H + J * a.offset, k, z && p.length && v ? v[0] + J * a.offset : 0);
                e = e.offset ? 0 : 2 * Math.floor(a.axisLine.strokeWidth() / 2);
                b[r] = Math.max(b[r], e)
            },
            getLinePath: function(a) {
                var b = this.chart,
                    c = this.opposite,
                    h = this.offset,
                    e = this.horiz,
                    p =
                    this.left + (c ? this.width : 0) + h,
                    h = b.chartHeight - this.bottom - (c ? this.height : 0) + h;
                c && (a *= -1);
                return b.renderer.crispLine(["M", e ? this.left : p, e ? h : this.top, "L", e ? b.chartWidth - this.right : p, e ? h : b.chartHeight - this.bottom], a)
            },
            renderLine: function() {
                this.axisLine || (this.axisLine = this.chart.renderer.path().addClass("highcharts-axis-line").add(this.axisGroup), this.axisLine.attr({
                    stroke: this.options.lineColor,
                    "stroke-width": this.options.lineWidth,
                    zIndex: 7
                }))
            },
            getTitlePosition: function() {
                var a = this.horiz,
                    b = this.left,
                    c = this.top,
                    e = this.len,
                    p = this.options.title,
                    d = a ? b : c,
                    l = this.opposite,
                    g = this.offset,
                    n = p.x || 0,
                    r = p.y || 0,
                    z = this.axisTitle,
                    w = this.chart.renderer.fontMetrics(p.style && p.style.fontSize, z),
                    z = Math.max(z.getBBox(null, 0).height - w.h - 1, 0),
                    e = {
                        low: d + (a ? 0 : e),
                        middle: d + e / 2,
                        high: d + (a ? e : 0)
                    }[p.align],
                    b = (a ? c + this.height : b) + (a ? 1 : -1) * (l ? -1 : 1) * this.axisTitleMargin + [-z, z, w.f, -z][this.side];
                return {
                    x: a ? e + n : b + (l ? this.width : 0) + g + n,
                    y: a ? b + r - (l ? this.height : 0) + g : e + r
                }
            },
            renderMinorTick: function(a) {
                var b = this.chart.hasRendered && A(this.oldMin),
                    c = this.minorTicks;
                c[a] || (c[a] = new H(this, a, "minor"));
                b && c[a].isNew && c[a].render(null, !0);
                c[a].render(null, !1, 1)
            },
            renderTick: function(a, b) {
                var c = this.isLinked,
                    h = this.ticks,
                    e = this.chart.hasRendered && A(this.oldMin);
                if (!c || a >= this.min && a <= this.max) h[a] || (h[a] = new H(this, a)), e && h[a].isNew && h[a].render(b, !0, .1), h[a].render(b)
            },
            render: function() {
                var b = this,
                    c = b.chart,
                    e = b.options,
                    p = b.isLog,
                    l = b.lin2log,
                    g = b.isLinked,
                    n = b.tickPositions,
                    r = b.axisTitle,
                    z = b.ticks,
                    f = b.minorTicks,
                    k = b.alternateBands,
                    m = e.stackLabels,
                    D = e.alternateGridColor,
                    u = b.tickmarkOffset,
                    F = b.axisLine,
                    I = b.showAxis,
                    J = C(c.renderer.globalAnimation),
                    q, t;
                b.labelEdge.length = 0;
                b.overlap = !1;
                d([z, f, k], function(a) {
                    w(a, function(a) {
                        a.isActive = !1
                    })
                });
                if (b.hasData() || g) b.minorTickInterval && !b.categories && d(b.getMinorTickPositions(), function(a) {
                    b.renderMinorTick(a)
                }), n.length && (d(n, function(a, c) {
                    b.renderTick(a, c)
                }), u && (0 === b.min || b.single) && (z[-1] || (z[-1] = new H(b, -1, null, !0)), z[-1].render(-1))), D && d(n, function(e, h) {
                    t = void 0 !== n[h + 1] ? n[h + 1] + u : b.max - u;
                    0 ===
                        h % 2 && e < b.max && t <= b.max + (c.polar ? -u : u) && (k[e] || (k[e] = new a.PlotLineOrBand(b)), q = e + u, k[e].options = {
                            from: p ? l(q) : q,
                            to: p ? l(t) : t,
                            color: D
                        }, k[e].render(), k[e].isActive = !0)
                }), b._addedPlotLB || (d((e.plotLines || []).concat(e.plotBands || []), function(a) {
                    b.addPlotBandOrLine(a)
                }), b._addedPlotLB = !0);
                d([z, f, k], function(a) {
                    var b, e = [],
                        h = J.duration;
                    w(a, function(a, b) {
                        a.isActive || (a.render(b, !1, 0), a.isActive = !1, e.push(b))
                    });
                    B(function() {
                            for (b = e.length; b--;) a[e[b]] && !a[e[b]].isActive && (a[e[b]].destroy(), delete a[e[b]])
                        },
                        a !== k && c.hasRendered && h ? h : 0)
                });
                F && (F[F.isPlaced ? "animate" : "attr"]({
                    d: this.getLinePath(F.strokeWidth())
                }), F.isPlaced = !0, F[I ? "show" : "hide"](!0));
                r && I && (e = b.getTitlePosition(), A(e.y) ? (r[r.isNew ? "attr" : "animate"](e), r.isNew = !1) : (r.attr("y", -9999), r.isNew = !0));
                m && m.enabled && b.renderStackTotals();
                b.isDirty = !1
            },
            redraw: function() {
                this.visible && (this.render(), d(this.plotLinesAndBands, function(a) {
                    a.render()
                }));
                d(this.series, function(a) {
                    a.isDirty = !0
                })
            },
            keepProps: "extKey hcEvents names series userMax userMin".split(" "),
            destroy: function(a) {
                var c = this,
                    e = c.stacks,
                    h = c.plotLinesAndBands,
                    p;
                a || M(c);
                w(e, function(a, b) {
                    u(a);
                    e[b] = null
                });
                d([c.ticks, c.minorTicks, c.alternateBands], function(a) {
                    u(a)
                });
                if (h)
                    for (a = h.length; a--;) h[a].destroy();
                d("stackTotalGroup axisLine axisTitle axisGroup gridGroup labelGroup cross".split(" "), function(a) {
                    c[a] && (c[a] = c[a].destroy())
                });
                for (p in c.plotLinesAndBandsGroups) c.plotLinesAndBandsGroups[p] = c.plotLinesAndBandsGroups[p].destroy();
                w(c, function(a, e) {
                    -1 === b(e, c.keepProps) && delete c[e]
                })
            },
            drawCrosshair: function(a,
                b) {
                var c, e = this.crosshair,
                    h = D(e.snap, !0),
                    p, d = this.cross;
                a || (a = this.cross && this.cross.e);
                this.crosshair && !1 !== (m(b) || !h) ? (h ? m(b) && (p = this.isXAxis ? b.plotX : this.len - b.plotY) : p = a && (this.horiz ? a.chartX - this.pos : this.len - a.chartY + this.pos), m(p) && (c = this.getPlotLinePath(b && (this.isXAxis ? b.x : D(b.stackY, b.y)), null, null, null, p) || null), m(c) ? (b = this.categories && !this.isRadial, d || (this.cross = d = this.chart.renderer.path().addClass("highcharts-crosshair highcharts-crosshair-" + (b ? "category " : "thin ") + e.className).attr({
                    zIndex: D(e.zIndex,
                        2)
                }).add(), d.attr({
                    stroke: e.color || (b ? f("#ccd6eb").setOpacity(.25).get() : "#cccccc"),
                    "stroke-width": D(e.width, 1)
                }).css({
                    "pointer-events": "none"
                }), e.dashStyle && d.attr({
                    dashstyle: e.dashStyle
                })), d.show().attr({
                    d: c
                }), b && !e.width && d.attr({
                    "stroke-width": this.transA
                }), this.cross.e = a) : this.hideCrosshair()) : this.hideCrosshair()
            },
            hideCrosshair: function() {
                this.cross && this.cross.hide()
            }
        });
        return a.Axis = F
    }(N);
    (function(a) {
        var E = a.Axis,
            C = a.Date,
            G = a.dateFormat,
            q = a.defaultOptions,
            f = a.defined,
            k = a.each,
            t = a.extend,
            m = a.getMagnitude,
            v = a.getTZOffset,
            u = a.normalizeTickInterval,
            d = a.pick,
            g = a.timeUnits;
        E.prototype.getTimeTicks = function(a, c, e, l) {
            var b = [],
                n = {},
                A = q.global.useUTC,
                m, r = new C(c - Math.max(v(c), v(e))),
                u = C.hcMakeTime,
                w = a.unitRange,
                D = a.count,
                M, p;
            if (f(c)) {
                r[C.hcSetMilliseconds](w >= g.second ? 0 : D * Math.floor(r.getMilliseconds() / D));
                if (w >= g.second) r[C.hcSetSeconds](w >= g.minute ? 0 : D * Math.floor(r.getSeconds() / D));
                if (w >= g.minute) r[C.hcSetMinutes](w >= g.hour ? 0 : D * Math.floor(r[C.hcGetMinutes]() / D));
                if (w >= g.hour) r[C.hcSetHours](w >=
                    g.day ? 0 : D * Math.floor(r[C.hcGetHours]() / D));
                if (w >= g.day) r[C.hcSetDate](w >= g.month ? 1 : D * Math.floor(r[C.hcGetDate]() / D));
                w >= g.month && (r[C.hcSetMonth](w >= g.year ? 0 : D * Math.floor(r[C.hcGetMonth]() / D)), m = r[C.hcGetFullYear]());
                if (w >= g.year) r[C.hcSetFullYear](m - m % D);
                if (w === g.week) r[C.hcSetDate](r[C.hcGetDate]() - r[C.hcGetDay]() + d(l, 1));
                m = r[C.hcGetFullYear]();
                l = r[C.hcGetMonth]();
                var B = r[C.hcGetDate](),
                    H = r[C.hcGetHours]();
                if (C.hcTimezoneOffset || C.hcGetTimezoneOffset) p = (!A || !!C.hcGetTimezoneOffset) && (e - c > 4 * g.month ||
                    v(c) !== v(e)), r = r.getTime(), M = v(r), r = new C(r + M);
                A = r.getTime();
                for (c = 1; A < e;) b.push(A), A = w === g.year ? u(m + c * D, 0) : w === g.month ? u(m, l + c * D) : !p || w !== g.day && w !== g.week ? p && w === g.hour ? u(m, l, B, H + c * D, 0, 0, M) - M : A + w * D : u(m, l, B + c * D * (w === g.day ? 1 : 7)), c++;
                b.push(A);
                w <= g.hour && 1E4 > b.length && k(b, function(a) {
                    0 === a % 18E5 && "000000000" === G("%H%M%S%L", a) && (n[a] = "day")
                })
            }
            b.info = t(a, {
                higherRanks: n,
                totalRange: w * D
            });
            return b
        };
        E.prototype.normalizeTimeTickInterval = function(a, c) {
            var e = c || [
                ["millisecond", [1, 2, 5, 10, 20, 25, 50, 100, 200, 500]],
                ["second", [1, 2, 5, 10, 15, 30]],
                ["minute", [1, 2, 5, 10, 15, 30]],
                ["hour", [1, 2, 3, 4, 6, 8, 12]],
                ["day", [1, 2]],
                ["week", [1, 2]],
                ["month", [1, 2, 3, 4, 6]],
                ["year", null]
            ];
            c = e[e.length - 1];
            var d = g[c[0]],
                b = c[1],
                n;
            for (n = 0; n < e.length && !(c = e[n], d = g[c[0]], b = c[1], e[n + 1] && a <= (d * b[b.length - 1] + g[e[n + 1][0]]) / 2); n++);
            d === g.year && a < 5 * d && (b = [1, 2, 5]);
            a = u(a / d, b, "year" === c[0] ? Math.max(m(a / d), 1) : 1);
            return {
                unitRange: d,
                count: a,
                unitName: c[0]
            }
        }
    })(N);
    (function(a) {
        var E = a.Axis,
            C = a.getMagnitude,
            G = a.map,
            q = a.normalizeTickInterval,
            f = a.pick;
        E.prototype.getLogTickPositions =
            function(a, t, m, v) {
                var k = this.options,
                    d = this.len,
                    g = this.lin2log,
                    n = this.log2lin,
                    c = [];
                v || (this._minorAutoInterval = null);
                if (.5 <= a) a = Math.round(a), c = this.getLinearTickPositions(a, t, m);
                else if (.08 <= a)
                    for (var d = Math.floor(t), e, l, b, z, A, k = .3 < a ? [1, 2, 4] : .15 < a ? [1, 2, 4, 6, 8] : [1, 2, 3, 4, 5, 6, 7, 8, 9]; d < m + 1 && !A; d++)
                        for (l = k.length, e = 0; e < l && !A; e++) b = n(g(d) * k[e]), b > t && (!v || z <= m) && void 0 !== z && c.push(z), z > m && (A = !0), z = b;
                else t = g(t), m = g(m), a = v ? this.getMinorTickInterval() : k.tickInterval, a = f("auto" === a ? null : a, this._minorAutoInterval,
                    k.tickPixelInterval / (v ? 5 : 1) * (m - t) / ((v ? d / this.tickPositions.length : d) || 1)), a = q(a, null, C(a)), c = G(this.getLinearTickPositions(a, t, m), n), v || (this._minorAutoInterval = a / 5);
                v || (this.tickInterval = a);
                return c
            };
        E.prototype.log2lin = function(a) {
            return Math.log(a) / Math.LN10
        };
        E.prototype.lin2log = function(a) {
            return Math.pow(10, a)
        }
    })(N);
    (function(a, E) {
        var C = a.arrayMax,
            G = a.arrayMin,
            q = a.defined,
            f = a.destroyObjectProperties,
            k = a.each,
            t = a.erase,
            m = a.merge,
            v = a.pick;
        a.PlotLineOrBand = function(a, d) {
            this.axis = a;
            d && (this.options =
                d, this.id = d.id)
        };
        a.PlotLineOrBand.prototype = {
            render: function() {
                var f = this,
                    d = f.axis,
                    g = d.horiz,
                    n = f.options,
                    c = n.label,
                    e = f.label,
                    l = n.to,
                    b = n.from,
                    z = n.value,
                    A = q(b) && q(l),
                    k = q(z),
                    r = f.svgElem,
                    J = !r,
                    w = [],
                    D = n.color,
                    t = v(n.zIndex, 0),
                    p = n.events,
                    w = {
                        "class": "highcharts-plot-" + (A ? "band " : "line ") + (n.className || "")
                    },
                    B = {},
                    H = d.chart.renderer,
                    F = A ? "bands" : "lines",
                    h = d.log2lin;
                d.isLog && (b = h(b), l = h(l), z = h(z));
                k ? (w = {
                    stroke: D,
                    "stroke-width": n.width
                }, n.dashStyle && (w.dashstyle = n.dashStyle)) : A && (D && (w.fill = D), n.borderWidth && (w.stroke =
                    n.borderColor, w["stroke-width"] = n.borderWidth));
                B.zIndex = t;
                F += "-" + t;
                (D = d.plotLinesAndBandsGroups[F]) || (d.plotLinesAndBandsGroups[F] = D = H.g("plot-" + F).attr(B).add());
                J && (f.svgElem = r = H.path().attr(w).add(D));
                if (k) w = d.getPlotLinePath(z, r.strokeWidth());
                else if (A) w = d.getPlotBandPath(b, l, n);
                else return;
                J && w && w.length ? (r.attr({
                    d: w
                }), p && a.objectEach(p, function(a, b) {
                    r.on(b, function(a) {
                        p[b].apply(f, [a])
                    })
                })) : r && (w ? (r.show(), r.animate({
                    d: w
                })) : (r.hide(), e && (f.label = e = e.destroy())));
                c && q(c.text) && w && w.length &&
                    0 < d.width && 0 < d.height && !w.flat ? (c = m({
                        align: g && A && "center",
                        x: g ? !A && 4 : 10,
                        verticalAlign: !g && A && "middle",
                        y: g ? A ? 16 : 10 : A ? 6 : -4,
                        rotation: g && !A && 90
                    }, c), this.renderLabel(c, w, A, t)) : e && e.hide();
                return f
            },
            renderLabel: function(a, d, g, n) {
                var c = this.label,
                    e = this.axis.chart.renderer;
                c || (c = {
                    align: a.textAlign || a.align,
                    rotation: a.rotation,
                    "class": "highcharts-plot-" + (g ? "band" : "line") + "-label " + (a.className || "")
                }, c.zIndex = n, this.label = c = e.text(a.text, 0, 0, a.useHTML).attr(c).add(), c.css(a.style));
                n = d.xBounds || [d[1], d[4],
                    g ? d[6] : d[1]
                ];
                d = d.yBounds || [d[2], d[5], g ? d[7] : d[2]];
                g = G(n);
                e = G(d);
                c.align(a, !1, {
                    x: g,
                    y: e,
                    width: C(n) - g,
                    height: C(d) - e
                });
                c.show()
            },
            destroy: function() {
                t(this.axis.plotLinesAndBands, this);
                delete this.axis;
                f(this)
            }
        };
        a.extend(E.prototype, {
            getPlotBandPath: function(a, d) {
                var g = this.getPlotLinePath(d, null, null, !0),
                    n = this.getPlotLinePath(a, null, null, !0),
                    c = [],
                    e = this.horiz,
                    l = 1,
                    b;
                a = a < this.min && d < this.min || a > this.max && d > this.max;
                if (n && g)
                    for (a && (b = n.toString() === g.toString(), l = 0), a = 0; a < n.length; a += 6) e && g[a + 1] === n[a +
                        1] ? (g[a + 1] += l, g[a + 4] += l) : e || g[a + 2] !== n[a + 2] || (g[a + 2] += l, g[a + 5] += l), c.push("M", n[a + 1], n[a + 2], "L", n[a + 4], n[a + 5], g[a + 4], g[a + 5], g[a + 1], g[a + 2], "z"), c.flat = b;
                return c
            },
            addPlotBand: function(a) {
                return this.addPlotBandOrLine(a, "plotBands")
            },
            addPlotLine: function(a) {
                return this.addPlotBandOrLine(a, "plotLines")
            },
            addPlotBandOrLine: function(f, d) {
                var g = (new a.PlotLineOrBand(this, f)).render(),
                    n = this.userOptions;
                g && (d && (n[d] = n[d] || [], n[d].push(f)), this.plotLinesAndBands.push(g));
                return g
            },
            removePlotBandOrLine: function(a) {
                for (var d =
                        this.plotLinesAndBands, g = this.options, n = this.userOptions, c = d.length; c--;) d[c].id === a && d[c].destroy();
                k([g.plotLines || [], n.plotLines || [], g.plotBands || [], n.plotBands || []], function(e) {
                    for (c = e.length; c--;) e[c].id === a && t(e, e[c])
                })
            },
            removePlotBand: function(a) {
                this.removePlotBandOrLine(a)
            },
            removePlotLine: function(a) {
                this.removePlotBandOrLine(a)
            }
        })
    })(N, V);
    (function(a) {
        var E = a.dateFormat,
            C = a.each,
            G = a.extend,
            q = a.format,
            f = a.isNumber,
            k = a.map,
            t = a.merge,
            m = a.pick,
            v = a.splat,
            u = a.syncTimeout,
            d = a.timeUnits;
        a.Tooltip =
            function() {
                this.init.apply(this, arguments)
            };
        a.Tooltip.prototype = {
            init: function(a, d) {
                this.chart = a;
                this.options = d;
                this.crosshairs = [];
                this.now = {
                    x: 0,
                    y: 0
                };
                this.isHidden = !0;
                this.split = d.split && !a.inverted;
                this.shared = d.shared || this.split
            },
            cleanSplit: function(a) {
                C(this.chart.series, function(d) {
                    var c = d && d.tt;
                    c && (!c.isActive || a ? d.tt = c.destroy() : c.isActive = !1)
                })
            },
            getLabel: function() {
                var a = this.chart.renderer,
                    d = this.options;
                this.label || (this.split ? this.label = a.g("tooltip") : (this.label = a.label("", 0, 0, d.shape ||
                    "callout", null, null, d.useHTML, null, "tooltip").attr({
                    padding: d.padding,
                    r: d.borderRadius
                }), this.label.attr({
                    fill: d.backgroundColor,
                    "stroke-width": d.borderWidth
                }).css(d.style).shadow(d.shadow)), this.label.attr({
                    zIndex: 8
                }).add());
                return this.label
            },
            update: function(a) {
                this.destroy();
                t(!0, this.chart.options.tooltip.userOptions, a);
                this.init(this.chart, t(!0, this.options, a))
            },
            destroy: function() {
                this.label && (this.label = this.label.destroy());
                this.split && this.tt && (this.cleanSplit(this.chart, !0), this.tt = this.tt.destroy());
                clearTimeout(this.hideTimer);
                clearTimeout(this.tooltipTimeout)
            },
            move: function(a, d, c, e) {
                var l = this,
                    b = l.now,
                    g = !1 !== l.options.animation && !l.isHidden && (1 < Math.abs(a - b.x) || 1 < Math.abs(d - b.y)),
                    n = l.followPointer || 1 < l.len;
                G(b, {
                    x: g ? (2 * b.x + a) / 3 : a,
                    y: g ? (b.y + d) / 2 : d,
                    anchorX: n ? void 0 : g ? (2 * b.anchorX + c) / 3 : c,
                    anchorY: n ? void 0 : g ? (b.anchorY + e) / 2 : e
                });
                l.getLabel().attr(b);
                g && (clearTimeout(this.tooltipTimeout), this.tooltipTimeout = setTimeout(function() {
                    l && l.move(a, d, c, e)
                }, 32))
            },
            hide: function(a) {
                var d = this;
                clearTimeout(this.hideTimer);
                a = m(a, this.options.hideDelay, 500);
                this.isHidden || (this.hideTimer = u(function() {
                    d.getLabel()[a ? "fadeOut" : "hide"]();
                    d.isHidden = !0
                }, a))
            },
            getAnchor: function(a, d) {
                var c, e = this.chart,
                    l = e.inverted,
                    b = e.plotTop,
                    g = e.plotLeft,
                    n = 0,
                    f = 0,
                    r, m;
                a = v(a);
                c = a[0].tooltipPos;
                this.followPointer && d && (void 0 === d.chartX && (d = e.pointer.normalize(d)), c = [d.chartX - e.plotLeft, d.chartY - b]);
                c || (C(a, function(a) {
                    r = a.series.yAxis;
                    m = a.series.xAxis;
                    n += a.plotX + (!l && m ? m.left - g : 0);
                    f += (a.plotLow ? (a.plotLow + a.plotHigh) / 2 : a.plotY) + (!l && r ? r.top -
                        b : 0)
                }), n /= a.length, f /= a.length, c = [l ? e.plotWidth - f : n, this.shared && !l && 1 < a.length && d ? d.chartY - b : l ? e.plotHeight - n : f]);
                return k(c, Math.round)
            },
            getPosition: function(a, d, c) {
                var e = this.chart,
                    l = this.distance,
                    b = {},
                    g = e.inverted && c.h || 0,
                    n, f = ["y", e.chartHeight, d, c.plotY + e.plotTop, e.plotTop, e.plotTop + e.plotHeight],
                    r = ["x", e.chartWidth, a, c.plotX + e.plotLeft, e.plotLeft, e.plotLeft + e.plotWidth],
                    k = !this.followPointer && m(c.ttBelow, !e.inverted === !!c.negative),
                    w = function(a, c, e, h, p, d) {
                        var n = e < h - l,
                            r = h + l + e < c,
                            z = h - l - e;
                        h += l;
                        if (k && r) b[a] = h;
                        else if (!k && n) b[a] = z;
                        else if (n) b[a] = Math.min(d - e, 0 > z - g ? z : z - g);
                        else if (r) b[a] = Math.max(p, h + g + e > c ? h : h + g);
                        else return !1
                    },
                    D = function(a, c, e, h) {
                        var p;
                        h < l || h > c - l ? p = !1 : b[a] = h < e / 2 ? 1 : h > c - e / 2 ? c - e - 2 : h - e / 2;
                        return p
                    },
                    t = function(a) {
                        var b = f;
                        f = r;
                        r = b;
                        n = a
                    },
                    p = function() {
                        !1 !== w.apply(0, f) ? !1 !== D.apply(0, r) || n || (t(!0), p()) : n ? b.x = b.y = 0 : (t(!0), p())
                    };
                (e.inverted || 1 < this.len) && t();
                p();
                return b
            },
            defaultFormatter: function(a) {
                var d = this.points || v(this),
                    c;
                c = [a.tooltipFooterHeaderFormatter(d[0])];
                c = c.concat(a.bodyFormatter(d));
                c.push(a.tooltipFooterHeaderFormatter(d[0], !0));
                return c
            },
            refresh: function(a, d) {
                var c, e = this.options,
                    l, b = a,
                    g, n = {},
                    f = [];
                c = e.formatter || this.defaultFormatter;
                var n = this.shared,
                    r;
                e.enabled && (clearTimeout(this.hideTimer), this.followPointer = v(b)[0].series.tooltipOptions.followPointer, g = this.getAnchor(b, d), d = g[0], l = g[1], !n || b.series && b.series.noSharedTooltip ? n = b.getLabelConfig() : (C(b, function(a) {
                        a.setState("hover");
                        f.push(a.getLabelConfig())
                    }), n = {
                        x: b[0].category,
                        y: b[0].y
                    }, n.points = f, b = b[0]), this.len = f.length,
                    n = c.call(n, this), r = b.series, this.distance = m(r.tooltipOptions.distance, 16), !1 === n ? this.hide() : (c = this.getLabel(), this.isHidden && c.attr({
                        opacity: 1
                    }).show(), this.split ? this.renderSplit(n, v(a)) : (e.style.width || c.css({
                        width: this.chart.spacingBox.width
                    }), c.attr({
                        text: n && n.join ? n.join("") : n
                    }), c.removeClass(/highcharts-color-[\d]+/g).addClass("highcharts-color-" + m(b.colorIndex, r.colorIndex)), c.attr({
                        stroke: e.borderColor || b.color || r.color || "#666666"
                    }), this.updatePosition({
                        plotX: d,
                        plotY: l,
                        negative: b.negative,
                        ttBelow: b.ttBelow,
                        h: g[2] || 0
                    })), this.isHidden = !1))
            },
            renderSplit: function(d, n) {
                var c = this,
                    e = [],
                    l = this.chart,
                    b = l.renderer,
                    g = !0,
                    f = this.options,
                    k = 0,
                    r = this.getLabel();
                a.isString(d) && (d = [!1, d]);
                C(d.slice(0, n.length + 1), function(a, d) {
                    if (!1 !== a) {
                        d = n[d - 1] || {
                            isHeader: !0,
                            plotX: n[0].plotX
                        };
                        var z = d.series || c,
                            w = z.tt,
                            p = d.series || {},
                            B = "highcharts-color-" + m(d.colorIndex, p.colorIndex, "none");
                        w || (z.tt = w = b.label(null, null, null, "callout", null, null, f.useHTML).addClass("highcharts-tooltip-box " + B).attr({
                            padding: f.padding,
                            r: f.borderRadius,
                            fill: f.backgroundColor,
                            stroke: f.borderColor || d.color || p.color || "#333333",
                            "stroke-width": f.borderWidth
                        }).add(r));
                        w.isActive = !0;
                        w.attr({
                            text: a
                        });
                        w.css(f.style).shadow(f.shadow);
                        a = w.getBBox();
                        p = a.width + w.strokeWidth();
                        d.isHeader ? (k = a.height, p = Math.max(0, Math.min(d.plotX + l.plotLeft - p / 2, l.chartWidth - p))) : p = d.plotX + l.plotLeft - m(f.distance, 16) - p;
                        0 > p && (g = !1);
                        a = (d.series && d.series.yAxis && d.series.yAxis.pos) + (d.plotY || 0);
                        a -= l.plotTop;
                        e.push({
                            target: d.isHeader ? l.plotHeight + k : a,
                            rank: d.isHeader ?
                                1 : 0,
                            size: z.tt.getBBox().height + 1,
                            point: d,
                            x: p,
                            tt: w
                        })
                    }
                });
                this.cleanSplit();
                a.distribute(e, l.plotHeight + k);
                C(e, function(a) {
                    var b = a.point,
                        c = b.series;
                    a.tt.attr({
                        visibility: void 0 === a.pos ? "hidden" : "inherit",
                        x: g || b.isHeader ? a.x : b.plotX + l.plotLeft + m(f.distance, 16),
                        y: a.pos + l.plotTop,
                        anchorX: b.isHeader ? b.plotX + l.plotLeft : b.plotX + c.xAxis.pos,
                        anchorY: b.isHeader ? a.pos + l.plotTop - 15 : b.plotY + c.yAxis.pos
                    })
                })
            },
            updatePosition: function(a) {
                var d = this.chart,
                    c = this.getLabel(),
                    c = (this.options.positioner || this.getPosition).call(this,
                        c.width, c.height, a);
                this.move(Math.round(c.x), Math.round(c.y || 0), a.plotX + d.plotLeft, a.plotY + d.plotTop)
            },
            getDateFormat: function(a, n, c, e) {
                var l = E("%m-%d %H:%M:%S.%L", n),
                    b, g, f = {
                        millisecond: 15,
                        second: 12,
                        minute: 9,
                        hour: 6,
                        day: 3
                    },
                    k = "millisecond";
                for (g in d) {
                    if (a === d.week && +E("%w", n) === c && "00:00:00.000" === l.substr(6)) {
                        g = "week";
                        break
                    }
                    if (d[g] > a) {
                        g = k;
                        break
                    }
                    if (f[g] && l.substr(f[g]) !== "01-01 00:00:00.000".substr(f[g])) break;
                    "week" !== g && (k = g)
                }
                g && (b = e[g]);
                return b
            },
            getXDateFormat: function(a, d, c) {
                d = d.dateTimeLabelFormats;
                var e = c && c.closestPointRange;
                return (e ? this.getDateFormat(e, a.x, c.options.startOfWeek, d) : d.day) || d.year
            },
            tooltipFooterHeaderFormatter: function(a, d) {
                d = d ? "footer" : "header";
                var c = a.series,
                    e = c.tooltipOptions,
                    l = e.xDateFormat,
                    b = c.xAxis,
                    g = b && "datetime" === b.options.type && f(a.key),
                    n = e[d + "Format"];
                g && !l && (l = this.getXDateFormat(a, e, b));
                g && l && C(a.point && a.point.tooltipDateKeys || ["key"], function(a) {
                    n = n.replace("{point." + a + "}", "{point." + a + ":" + l + "}")
                });
                return q(n, {
                    point: a,
                    series: c
                })
            },
            bodyFormatter: function(a) {
                return k(a,
                    function(a) {
                        var c = a.series.tooltipOptions;
                        return (c[(a.point.formatPrefix || "point") + "Formatter"] || a.point.tooltipFormatter).call(a.point, c[(a.point.formatPrefix || "point") + "Format"])
                    })
            }
        }
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.attr,
            G = a.charts,
            q = a.color,
            f = a.css,
            k = a.defined,
            t = a.each,
            m = a.extend,
            v = a.find,
            u = a.fireEvent,
            d = a.isObject,
            g = a.offset,
            n = a.pick,
            c = a.removeEvent,
            e = a.splat,
            l = a.Tooltip;
        a.Pointer = function(a, c) {
            this.init(a, c)
        };
        a.Pointer.prototype = {
            init: function(a, c) {
                this.options = c;
                this.chart = a;
                this.runChartClick =
                    c.chart.events && !!c.chart.events.click;
                this.pinchDown = [];
                this.lastValidTouch = {};
                l && (a.tooltip = new l(a, c.tooltip), this.followTouchMove = n(c.tooltip.followTouchMove, !0));
                this.setDOMEvents()
            },
            zoomOption: function(a) {
                var b = this.chart,
                    c = b.options.chart,
                    e = c.zoomType || "",
                    b = b.inverted;
                /touch/.test(a.type) && (e = n(c.pinchType, e));
                this.zoomX = a = /x/.test(e);
                this.zoomY = e = /y/.test(e);
                this.zoomHor = a && !b || e && b;
                this.zoomVert = e && !b || a && b;
                this.hasZoom = a || e
            },
            normalize: function(a, c) {
                var b;
                b = a.touches ? a.touches.length ? a.touches.item(0) :
                    a.changedTouches[0] : a;
                c || (this.chartPosition = c = g(this.chart.container));
                return m(a, {
                    chartX: Math.round(b.pageX - c.left),
                    chartY: Math.round(b.pageY - c.top)
                })
            },
            getCoordinates: function(a) {
                var b = {
                    xAxis: [],
                    yAxis: []
                };
                t(this.chart.axes, function(c) {
                    b[c.isXAxis ? "xAxis" : "yAxis"].push({
                        axis: c,
                        value: c.toValue(a[c.horiz ? "chartX" : "chartY"])
                    })
                });
                return b
            },
            findNearestKDPoint: function(a, c, e) {
                var b;
                t(a, function(a) {
                    var l = !(a.noSharedTooltip && c) && 0 > a.options.findNearestPointBy.indexOf("y");
                    a = a.searchPoint(e, l);
                    if ((l = d(a, !0)) && !(l = !d(b, !0))) var l = b.distX - a.distX,
                        g = b.dist - a.dist,
                        n = (a.series.group && a.series.group.zIndex) - (b.series.group && b.series.group.zIndex),
                        l = 0 < (0 !== l && c ? l : 0 !== g ? g : 0 !== n ? n : b.series.index > a.series.index ? -1 : 1);
                    l && (b = a)
                });
                return b
            },
            getPointFromEvent: function(a) {
                a = a.target;
                for (var b; a && !b;) b = a.point, a = a.parentNode;
                return b
            },
            getChartCoordinatesFromPoint: function(a, c) {
                var b = a.series,
                    e = b.xAxis,
                    b = b.yAxis;
                if (e && b) return c ? {
                    chartX: e.len + e.pos - a.clientX,
                    chartY: b.len + b.pos - a.plotY
                } : {
                    chartX: a.clientX + e.pos,
                    chartY: a.plotY +
                        b.pos
                }
            },
            getHoverData: function(b, c, e, l, g, f, w) {
                var r, k = [],
                    p = w && w.isBoosting;
                l = !(!l || !b);
                w = c && !c.stickyTracking ? [c] : a.grep(e, function(a) {
                    return a.visible && !(!g && a.directTouch) && n(a.options.enableMouseTracking, !0) && a.stickyTracking
                });
                c = (r = l ? b : this.findNearestKDPoint(w, g, f)) && r.series;
                r && (g && !c.noSharedTooltip ? (w = a.grep(e, function(a) {
                    return a.visible && !(!g && a.directTouch) && n(a.options.enableMouseTracking, !0) && !a.noSharedTooltip
                }), t(w, function(a) {
                    var b = v(a.points, function(a) {
                        return a.x === r.x && !a.isNull
                    });
                    d(b) && (p && (b = a.getPoint(b)), k.push(b))
                })) : k.push(r));
                return {
                    hoverPoint: r,
                    hoverSeries: c,
                    hoverPoints: k
                }
            },
            runPointActions: function(b, c) {
                var e = this.chart,
                    d = e.tooltip && e.tooltip.options.enabled ? e.tooltip : void 0,
                    l = d ? d.shared : !1,
                    g = c || e.hoverPoint,
                    f = g && g.series || e.hoverSeries,
                    f = this.getHoverData(g, f, e.series, !!c || f && f.directTouch && this.isDirectTouch, l, b, {
                        isBoosting: e.isBoosting
                    }),
                    k, g = f.hoverPoint;
                k = f.hoverPoints;
                c = (f = f.hoverSeries) && f.tooltipOptions.followPointer;
                l = l && f && !f.noSharedTooltip;
                if (g && (g !== e.hoverPoint ||
                        d && d.isHidden)) {
                    t(e.hoverPoints || [], function(b) {
                        -1 === a.inArray(b, k) && b.setState()
                    });
                    t(k || [], function(a) {
                        a.setState("hover")
                    });
                    if (e.hoverSeries !== f) f.onMouseOver();
                    e.hoverPoint && e.hoverPoint.firePointEvent("mouseOut");
                    if (!g.series) return;
                    g.firePointEvent("mouseOver");
                    e.hoverPoints = k;
                    e.hoverPoint = g;
                    d && d.refresh(l ? k : g, b)
                } else c && d && !d.isHidden && (g = d.getAnchor([{}], b), d.updatePosition({
                    plotX: g[0],
                    plotY: g[1]
                }));
                this.unDocMouseMove || (this.unDocMouseMove = E(e.container.ownerDocument, "mousemove", function(b) {
                    var c =
                        G[a.hoverChartIndex];
                    if (c) c.pointer.onDocumentMouseMove(b)
                }));
                t(e.axes, function(c) {
                    var e = n(c.crosshair.snap, !0),
                        d = e ? a.find(k, function(a) {
                            return a.series[c.coll] === c
                        }) : void 0;
                    d || !e ? c.drawCrosshair(b, d) : c.hideCrosshair()
                })
            },
            reset: function(a, c) {
                var b = this.chart,
                    d = b.hoverSeries,
                    l = b.hoverPoint,
                    g = b.hoverPoints,
                    n = b.tooltip,
                    f = n && n.shared ? g : l;
                a && f && t(e(f), function(b) {
                    b.series.isCartesian && void 0 === b.plotX && (a = !1)
                });
                if (a) n && f && (n.refresh(f), l && (l.setState(l.state, !0), t(b.axes, function(a) {
                    a.crosshair && a.drawCrosshair(null,
                        l)
                })));
                else {
                    if (l) l.onMouseOut();
                    g && t(g, function(a) {
                        a.setState()
                    });
                    if (d) d.onMouseOut();
                    n && n.hide(c);
                    this.unDocMouseMove && (this.unDocMouseMove = this.unDocMouseMove());
                    t(b.axes, function(a) {
                        a.hideCrosshair()
                    });
                    this.hoverX = b.hoverPoints = b.hoverPoint = null
                }
            },
            scaleGroups: function(a, c) {
                var b = this.chart,
                    e;
                t(b.series, function(d) {
                    e = a || d.getPlotBox();
                    d.xAxis && d.xAxis.zoomEnabled && d.group && (d.group.attr(e), d.markerGroup && (d.markerGroup.attr(e), d.markerGroup.clip(c ? b.clipRect : null)), d.dataLabelsGroup && d.dataLabelsGroup.attr(e))
                });
                b.clipRect.attr(c || b.clipBox)
            },
            dragStart: function(a) {
                var b = this.chart;
                b.mouseIsDown = a.type;
                b.cancelClick = !1;
                b.mouseDownX = this.mouseDownX = a.chartX;
                b.mouseDownY = this.mouseDownY = a.chartY
            },
            drag: function(a) {
                var b = this.chart,
                    c = b.options.chart,
                    e = a.chartX,
                    d = a.chartY,
                    l = this.zoomHor,
                    g = this.zoomVert,
                    n = b.plotLeft,
                    f = b.plotTop,
                    p = b.plotWidth,
                    k = b.plotHeight,
                    H, m = this.selectionMarker,
                    h = this.mouseDownX,
                    x = this.mouseDownY,
                    t = c.panKey && a[c.panKey + "Key"];
                m && m.touch || (e < n ? e = n : e > n + p && (e = n + p), d < f ? d = f : d > f + k && (d = f + k), this.hasDragged =
                    Math.sqrt(Math.pow(h - e, 2) + Math.pow(x - d, 2)), 10 < this.hasDragged && (H = b.isInsidePlot(h - n, x - f), b.hasCartesianSeries && (this.zoomX || this.zoomY) && H && !t && !m && (this.selectionMarker = m = b.renderer.rect(n, f, l ? 1 : p, g ? 1 : k, 0).attr({
                        fill: c.selectionMarkerFill || q("#335cad").setOpacity(.25).get(),
                        "class": "highcharts-selection-marker",
                        zIndex: 7
                    }).add()), m && l && (e -= h, m.attr({
                        width: Math.abs(e),
                        x: (0 < e ? 0 : e) + h
                    })), m && g && (e = d - x, m.attr({
                        height: Math.abs(e),
                        y: (0 < e ? 0 : e) + x
                    })), H && !m && c.panning && b.pan(a, c.panning)))
            },
            drop: function(a) {
                var b =
                    this,
                    c = this.chart,
                    e = this.hasPinched;
                if (this.selectionMarker) {
                    var d = {
                            originalEvent: a,
                            xAxis: [],
                            yAxis: []
                        },
                        l = this.selectionMarker,
                        g = l.attr ? l.attr("x") : l.x,
                        n = l.attr ? l.attr("y") : l.y,
                        q = l.attr ? l.attr("width") : l.width,
                        p = l.attr ? l.attr("height") : l.height,
                        B;
                    if (this.hasDragged || e) t(c.axes, function(c) {
                        if (c.zoomEnabled && k(c.min) && (e || b[{
                                xAxis: "zoomX",
                                yAxis: "zoomY"
                            }[c.coll]])) {
                            var l = c.horiz,
                                h = "touchend" === a.type ? c.minPixelPadding : 0,
                                f = c.toValue((l ? g : n) + h),
                                l = c.toValue((l ? g + q : n + p) - h);
                            d[c.coll].push({
                                axis: c,
                                min: Math.min(f,
                                    l),
                                max: Math.max(f, l)
                            });
                            B = !0
                        }
                    }), B && u(c, "selection", d, function(a) {
                        c.zoom(m(a, e ? {
                            animation: !1
                        } : null))
                    });
                    this.selectionMarker = this.selectionMarker.destroy();
                    e && this.scaleGroups()
                }
                c && (f(c.container, {
                    cursor: c._cursor
                }), c.cancelClick = 10 < this.hasDragged, c.mouseIsDown = this.hasDragged = this.hasPinched = !1, this.pinchDown = [])
            },
            onContainerMouseDown: function(a) {
                a = this.normalize(a);
                this.zoomOption(a);
                a.preventDefault && a.preventDefault();
                this.dragStart(a)
            },
            onDocumentMouseUp: function(b) {
                G[a.hoverChartIndex] && G[a.hoverChartIndex].pointer.drop(b)
            },
            onDocumentMouseMove: function(a) {
                var b = this.chart,
                    c = this.chartPosition;
                a = this.normalize(a, c);
                !c || this.inClass(a.target, "highcharts-tracker") || b.isInsidePlot(a.chartX - b.plotLeft, a.chartY - b.plotTop) || this.reset()
            },
            onContainerMouseLeave: function(b) {
                var c = G[a.hoverChartIndex];
                c && (b.relatedTarget || b.toElement) && (c.pointer.reset(), c.pointer.chartPosition = null)
            },
            onContainerMouseMove: function(b) {
                var c = this.chart;
                k(a.hoverChartIndex) && G[a.hoverChartIndex] && G[a.hoverChartIndex].mouseIsDown || (a.hoverChartIndex =
                    c.index);
                b = this.normalize(b);
                b.returnValue = !1;
                "mousedown" === c.mouseIsDown && this.drag(b);
                !this.inClass(b.target, "highcharts-tracker") && !c.isInsidePlot(b.chartX - c.plotLeft, b.chartY - c.plotTop) || c.openMenu || this.runPointActions(b)
            },
            inClass: function(a, c) {
                for (var b; a;) {
                    if (b = C(a, "class")) {
                        if (-1 !== b.indexOf(c)) return !0;
                        if (-1 !== b.indexOf("highcharts-container")) return !1
                    }
                    a = a.parentNode
                }
            },
            onTrackerMouseOut: function(a) {
                var b = this.chart.hoverSeries;
                a = a.relatedTarget || a.toElement;
                this.isDirectTouch = !1;
                if (!(!b ||
                        !a || b.stickyTracking || this.inClass(a, "highcharts-tooltip") || this.inClass(a, "highcharts-series-" + b.index) && this.inClass(a, "highcharts-tracker"))) b.onMouseOut()
            },
            onContainerClick: function(a) {
                var b = this.chart,
                    c = b.hoverPoint,
                    e = b.plotLeft,
                    d = b.plotTop;
                a = this.normalize(a);
                b.cancelClick || (c && this.inClass(a.target, "highcharts-tracker") ? (u(c.series, "click", m(a, {
                    point: c
                })), b.hoverPoint && c.firePointEvent("click", a)) : (m(a, this.getCoordinates(a)), b.isInsidePlot(a.chartX - e, a.chartY - d) && u(b, "click", a)))
            },
            setDOMEvents: function() {
                var b =
                    this,
                    c = b.chart.container,
                    e = c.ownerDocument;
                c.onmousedown = function(a) {
                    b.onContainerMouseDown(a)
                };
                c.onmousemove = function(a) {
                    b.onContainerMouseMove(a)
                };
                c.onclick = function(a) {
                    b.onContainerClick(a)
                };
                E(c, "mouseleave", b.onContainerMouseLeave);
                1 === a.chartCount && E(e, "mouseup", b.onDocumentMouseUp);
                a.hasTouch && (c.ontouchstart = function(a) {
                    b.onContainerTouchStart(a)
                }, c.ontouchmove = function(a) {
                    b.onContainerTouchMove(a)
                }, 1 === a.chartCount && E(e, "touchend", b.onDocumentTouchEnd))
            },
            destroy: function() {
                var b = this,
                    e = this.chart.container.ownerDocument;
                b.unDocMouseMove && b.unDocMouseMove();
                c(b.chart.container, "mouseleave", b.onContainerMouseLeave);
                a.chartCount || (c(e, "mouseup", b.onDocumentMouseUp), a.hasTouch && c(e, "touchend", b.onDocumentTouchEnd));
                clearInterval(b.tooltipTimeout);
                a.objectEach(b, function(a, c) {
                    b[c] = null
                })
            }
        }
    })(N);
    (function(a) {
        var E = a.charts,
            C = a.each,
            G = a.extend,
            q = a.map,
            f = a.noop,
            k = a.pick;
        G(a.Pointer.prototype, {
            pinchTranslate: function(a, f, k, q, d, g) {
                this.zoomHor && this.pinchTranslateDirection(!0, a, f, k, q, d, g);
                this.zoomVert && this.pinchTranslateDirection(!1,
                    a, f, k, q, d, g)
            },
            pinchTranslateDirection: function(a, f, k, q, d, g, n, c) {
                var e = this.chart,
                    l = a ? "x" : "y",
                    b = a ? "X" : "Y",
                    m = "chart" + b,
                    t = a ? "width" : "height",
                    u = e["plot" + (a ? "Left" : "Top")],
                    r, v, w = c || 1,
                    D = e.inverted,
                    M = e.bounds[a ? "h" : "v"],
                    p = 1 === f.length,
                    B = f[0][m],
                    H = k[0][m],
                    F = !p && f[1][m],
                    h = !p && k[1][m],
                    x;
                k = function() {
                    !p && 20 < Math.abs(B - F) && (w = c || Math.abs(H - h) / Math.abs(B - F));
                    v = (u - H) / w + B;
                    r = e["plot" + (a ? "Width" : "Height")] / w
                };
                k();
                f = v;
                f < M.min ? (f = M.min, x = !0) : f + r > M.max && (f = M.max - r, x = !0);
                x ? (H -= .8 * (H - n[l][0]), p || (h -= .8 * (h - n[l][1])), k()) :
                    n[l] = [H, h];
                D || (g[l] = v - u, g[t] = r);
                g = D ? 1 / w : w;
                d[t] = r;
                d[l] = f;
                q[D ? a ? "scaleY" : "scaleX" : "scale" + b] = w;
                q["translate" + b] = g * u + (H - g * B)
            },
            pinch: function(a) {
                var m = this,
                    t = m.chart,
                    u = m.pinchDown,
                    d = a.touches,
                    g = d.length,
                    n = m.lastValidTouch,
                    c = m.hasZoom,
                    e = m.selectionMarker,
                    l = {},
                    b = 1 === g && (m.inClass(a.target, "highcharts-tracker") && t.runTrackerClick || m.runChartClick),
                    z = {};
                1 < g && (m.initiated = !0);
                c && m.initiated && !b && a.preventDefault();
                q(d, function(a) {
                    return m.normalize(a)
                });
                "touchstart" === a.type ? (C(d, function(a, b) {
                    u[b] = {
                        chartX: a.chartX,
                        chartY: a.chartY
                    }
                }), n.x = [u[0].chartX, u[1] && u[1].chartX], n.y = [u[0].chartY, u[1] && u[1].chartY], C(t.axes, function(a) {
                    if (a.zoomEnabled) {
                        var b = t.bounds[a.horiz ? "h" : "v"],
                            c = a.minPixelPadding,
                            e = a.toPixels(k(a.options.min, a.dataMin)),
                            d = a.toPixels(k(a.options.max, a.dataMax)),
                            l = Math.max(e, d);
                        b.min = Math.min(a.pos, Math.min(e, d) - c);
                        b.max = Math.max(a.pos + a.len, l + c)
                    }
                }), m.res = !0) : m.followTouchMove && 1 === g ? this.runPointActions(m.normalize(a)) : u.length && (e || (m.selectionMarker = e = G({
                    destroy: f,
                    touch: !0
                }, t.plotBox)), m.pinchTranslate(u,
                    d, l, e, z, n), m.hasPinched = c, m.scaleGroups(l, z), m.res && (m.res = !1, this.reset(!1, 0)))
            },
            touch: function(f, m) {
                var q = this.chart,
                    t, d;
                if (q.index !== a.hoverChartIndex) this.onContainerMouseLeave({
                    relatedTarget: !0
                });
                a.hoverChartIndex = q.index;
                1 === f.touches.length ? (f = this.normalize(f), (d = q.isInsidePlot(f.chartX - q.plotLeft, f.chartY - q.plotTop)) && !q.openMenu ? (m && this.runPointActions(f), "touchmove" === f.type && (m = this.pinchDown, t = m[0] ? 4 <= Math.sqrt(Math.pow(m[0].chartX - f.chartX, 2) + Math.pow(m[0].chartY - f.chartY, 2)) : !1), k(t, !0) && this.pinch(f)) : m && this.reset()) : 2 === f.touches.length && this.pinch(f)
            },
            onContainerTouchStart: function(a) {
                this.zoomOption(a);
                this.touch(a, !0)
            },
            onContainerTouchMove: function(a) {
                this.touch(a)
            },
            onDocumentTouchEnd: function(f) {
                E[a.hoverChartIndex] && E[a.hoverChartIndex].pointer.drop(f)
            }
        })
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.charts,
            G = a.css,
            q = a.doc,
            f = a.extend,
            k = a.noop,
            t = a.Pointer,
            m = a.removeEvent,
            v = a.win,
            u = a.wrap;
        if (!a.hasTouch && (v.PointerEvent || v.MSPointerEvent)) {
            var d = {},
                g = !!v.PointerEvent,
                n = function() {
                    var c = [];
                    c.item = function(a) {
                        return this[a]
                    };
                    a.objectEach(d, function(a) {
                        c.push({
                            pageX: a.pageX,
                            pageY: a.pageY,
                            target: a.target
                        })
                    });
                    return c
                },
                c = function(c, d, b, g) {
                    "touch" !== c.pointerType && c.pointerType !== c.MSPOINTER_TYPE_TOUCH || !C[a.hoverChartIndex] || (g(c), g = C[a.hoverChartIndex].pointer, g[d]({
                        type: b,
                        target: c.currentTarget,
                        preventDefault: k,
                        touches: n()
                    }))
                };
            f(t.prototype, {
                onContainerPointerDown: function(a) {
                    c(a, "onContainerTouchStart", "touchstart", function(a) {
                        d[a.pointerId] = {
                            pageX: a.pageX,
                            pageY: a.pageY,
                            target: a.currentTarget
                        }
                    })
                },
                onContainerPointerMove: function(a) {
                    c(a, "onContainerTouchMove", "touchmove", function(a) {
                        d[a.pointerId] = {
                            pageX: a.pageX,
                            pageY: a.pageY
                        };
                        d[a.pointerId].target || (d[a.pointerId].target = a.currentTarget)
                    })
                },
                onDocumentPointerUp: function(a) {
                    c(a, "onDocumentTouchEnd", "touchend", function(a) {
                        delete d[a.pointerId]
                    })
                },
                batchMSEvents: function(a) {
                    a(this.chart.container, g ? "pointerdown" : "MSPointerDown", this.onContainerPointerDown);
                    a(this.chart.container, g ? "pointermove" : "MSPointerMove", this.onContainerPointerMove);
                    a(q, g ?
                        "pointerup" : "MSPointerUp", this.onDocumentPointerUp)
                }
            });
            u(t.prototype, "init", function(a, c, b) {
                a.call(this, c, b);
                this.hasZoom && G(c.container, {
                    "-ms-touch-action": "none",
                    "touch-action": "none"
                })
            });
            u(t.prototype, "setDOMEvents", function(a) {
                a.apply(this);
                (this.hasZoom || this.followTouchMove) && this.batchMSEvents(E)
            });
            u(t.prototype, "destroy", function(a) {
                this.batchMSEvents(m);
                a.call(this)
            })
        }
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.css,
            G = a.discardElement,
            q = a.defined,
            f = a.each,
            k = a.isFirefox,
            t = a.marginNames,
            m = a.merge,
            v = a.pick,
            u = a.setAnimation,
            d = a.stableSort,
            g = a.win,
            n = a.wrap;
        a.Legend = function(a, e) {
            this.init(a, e)
        };
        a.Legend.prototype = {
            init: function(a, e) {
                this.chart = a;
                this.setOptions(e);
                e.enabled && (this.render(), E(this.chart, "endResize", function() {
                    this.legend.positionCheckboxes()
                }))
            },
            setOptions: function(a) {
                var c = v(a.padding, 8);
                this.options = a;
                this.itemStyle = a.itemStyle;
                this.itemHiddenStyle = m(this.itemStyle, a.itemHiddenStyle);
                this.itemMarginTop = a.itemMarginTop || 0;
                this.padding = c;
                this.initialItemY = c - 5;
                this.itemHeight =
                    this.maxItemWidth = 0;
                this.symbolWidth = v(a.symbolWidth, 16);
                this.pages = []
            },
            update: function(a, e) {
                var c = this.chart;
                this.setOptions(m(!0, this.options, a));
                this.destroy();
                c.isDirtyLegend = c.isDirtyBox = !0;
                v(e, !0) && c.redraw()
            },
            colorizeItem: function(a, e) {
                a.legendGroup[e ? "removeClass" : "addClass"]("highcharts-legend-item-hidden");
                var c = this.options,
                    b = a.legendItem,
                    d = a.legendLine,
                    g = a.legendSymbol,
                    f = this.itemHiddenStyle.color,
                    c = e ? c.itemStyle.color : f,
                    n = e ? a.color || f : f,
                    k = a.options && a.options.marker,
                    m = {
                        fill: n
                    };
                b && b.css({
                    fill: c,
                    color: c
                });
                d && d.attr({
                    stroke: n
                });
                g && (k && g.isMarker && (m = a.pointAttribs(), e || (m.stroke = m.fill = f)), g.attr(m))
            },
            positionItem: function(a) {
                var c = this.options,
                    d = c.symbolPadding,
                    c = !c.rtl,
                    b = a._legendItemPos,
                    g = b[0],
                    b = b[1],
                    f = a.checkbox;
                (a = a.legendGroup) && a.element && a.translate(c ? g : this.legendWidth - g - 2 * d - 4, b);
                f && (f.x = g, f.y = b)
            },
            destroyItem: function(a) {
                var c = a.checkbox;
                f(["legendItem", "legendLine", "legendSymbol", "legendGroup"], function(c) {
                    a[c] && (a[c] = a[c].destroy())
                });
                c && G(a.checkbox)
            },
            destroy: function() {
                function a(a) {
                    this[a] &&
                        (this[a] = this[a].destroy())
                }
                f(this.getAllItems(), function(c) {
                    f(["legendItem", "legendGroup"], a, c)
                });
                f("clipRect up down pager nav box title group".split(" "), a, this);
                this.display = null
            },
            positionCheckboxes: function(a) {
                var c = this.group && this.group.alignAttr,
                    d, b = this.clipHeight || this.legendHeight,
                    g = this.titleHeight;
                c && (d = c.translateY, f(this.allItems, function(e) {
                    var l = e.checkbox,
                        f;
                    l && (f = d + g + l.y + (a || 0) + 3, C(l, {
                        left: c.translateX + e.checkboxOffset + l.x - 20 + "px",
                        top: f + "px",
                        display: f > d - 6 && f < d + b - 6 ? "" : "none"
                    }))
                }))
            },
            renderTitle: function() {
                var a = this.options,
                    e = this.padding,
                    d = a.title,
                    b = 0;
                d.text && (this.title || (this.title = this.chart.renderer.label(d.text, e - 3, e - 4, null, null, null, a.useHTML, null, "legend-title").attr({
                    zIndex: 1
                }).css(d.style).add(this.group)), a = this.title.getBBox(), b = a.height, this.offsetWidth = a.width, this.contentGroup.attr({
                    translateY: b
                }));
                this.titleHeight = b
            },
            setText: function(c) {
                var e = this.options;
                c.legendItem.attr({
                    text: e.labelFormat ? a.format(e.labelFormat, c) : e.labelFormatter.call(c)
                })
            },
            renderItem: function(a) {
                var c =
                    this.chart,
                    d = c.renderer,
                    b = this.options,
                    g = "horizontal" === b.layout,
                    f = this.symbolWidth,
                    n = b.symbolPadding,
                    r = this.itemStyle,
                    k = this.itemHiddenStyle,
                    w = this.padding,
                    q = g ? v(b.itemDistance, 20) : 0,
                    t = !b.rtl,
                    p = b.width,
                    B = b.itemMarginBottom || 0,
                    H = this.itemMarginTop,
                    F = a.legendItem,
                    h = !a.series,
                    x = !h && a.series.drawLegendSymbol ? a.series : a,
                    u = x.options,
                    K = this.createCheckboxForItem && u && u.showCheckbox,
                    u = f + n + q + (K ? 20 : 0),
                    P = b.useHTML,
                    L = a.options.className;
                F || (a.legendGroup = d.g("legend-item").addClass("highcharts-" + x.type + "-series highcharts-color-" +
                    a.colorIndex + (L ? " " + L : "") + (h ? " highcharts-series-" + a.index : "")).attr({
                    zIndex: 1
                }).add(this.scrollGroup), a.legendItem = F = d.text("", t ? f + n : -n, this.baseline || 0, P).css(m(a.visible ? r : k)).attr({
                    align: t ? "left" : "right",
                    zIndex: 2
                }).add(a.legendGroup), this.baseline || (f = r.fontSize, this.fontMetrics = d.fontMetrics(f, F), this.baseline = this.fontMetrics.f + 3 + H, F.attr("y", this.baseline)), this.symbolHeight = b.symbolHeight || this.fontMetrics.f, x.drawLegendSymbol(this, a), this.setItemEvents && this.setItemEvents(a, F, P), K && this.createCheckboxForItem(a));
                this.colorizeItem(a, a.visible);
                r.width || F.css({
                    width: (b.itemWidth || b.width || c.spacingBox.width) - u
                });
                this.setText(a);
                d = F.getBBox();
                r = a.checkboxOffset = b.itemWidth || a.legendItemWidth || d.width + u;
                this.itemHeight = d = Math.round(a.legendItemHeight || d.height || this.symbolHeight);
                g && this.itemX - w + r > (p || c.spacingBox.width - 2 * w - b.x) && (this.itemX = w, this.itemY += H + this.lastLineHeight + B, this.lastLineHeight = 0);
                this.maxItemWidth = Math.max(this.maxItemWidth, r);
                this.lastItemY = H + this.itemY + B;
                this.lastLineHeight = Math.max(d,
                    this.lastLineHeight);
                a._legendItemPos = [this.itemX, this.itemY];
                g ? this.itemX += r : (this.itemY += H + d + B, this.lastLineHeight = d);
                this.offsetWidth = p || Math.max((g ? this.itemX - w - (a.checkbox ? 0 : q) : r) + w, this.offsetWidth)
            },
            getAllItems: function() {
                var a = [];
                f(this.chart.series, function(c) {
                    var e = c && c.options;
                    c && v(e.showInLegend, q(e.linkedTo) ? !1 : void 0, !0) && (a = a.concat(c.legendItems || ("point" === e.legendType ? c.data : c)))
                });
                return a
            },
            adjustMargins: function(a, e) {
                var c = this.chart,
                    b = this.options,
                    d = b.align.charAt(0) + b.verticalAlign.charAt(0) +
                    b.layout.charAt(0);
                b.floating || f([/(lth|ct|rth)/, /(rtv|rm|rbv)/, /(rbh|cb|lbh)/, /(lbv|lm|ltv)/], function(g, l) {
                    g.test(d) && !q(a[l]) && (c[t[l]] = Math.max(c[t[l]], c.legend[(l + 1) % 2 ? "legendHeight" : "legendWidth"] + [1, -1, -1, 1][l] * b[l % 2 ? "x" : "y"] + v(b.margin, 12) + e[l]))
                })
            },
            render: function() {
                var a = this,
                    e = a.chart,
                    g = e.renderer,
                    b = a.group,
                    n, k, q, r, t = a.box,
                    w = a.options,
                    D = a.padding;
                a.itemX = D;
                a.itemY = a.initialItemY;
                a.offsetWidth = 0;
                a.lastItemY = 0;
                b || (a.group = b = g.g("legend").attr({
                        zIndex: 7
                    }).add(), a.contentGroup = g.g().attr({
                        zIndex: 1
                    }).add(b),
                    a.scrollGroup = g.g().add(a.contentGroup));
                a.renderTitle();
                n = a.getAllItems();
                d(n, function(a, b) {
                    return (a.options && a.options.legendIndex || 0) - (b.options && b.options.legendIndex || 0)
                });
                w.reversed && n.reverse();
                a.allItems = n;
                a.display = k = !!n.length;
                a.lastLineHeight = 0;
                f(n, function(b) {
                    a.renderItem(b)
                });
                q = (w.width || a.offsetWidth) + D;
                r = a.lastItemY + a.lastLineHeight + a.titleHeight;
                r = a.handleOverflow(r);
                r += D;
                t || (a.box = t = g.rect().addClass("highcharts-legend-box").attr({
                    r: w.borderRadius
                }).add(b), t.isNew = !0);
                t.attr({
                    stroke: w.borderColor,
                    "stroke-width": w.borderWidth || 0,
                    fill: w.backgroundColor || "none"
                }).shadow(w.shadow);
                0 < q && 0 < r && (t[t.isNew ? "attr" : "animate"](t.crisp.call({}, {
                    x: 0,
                    y: 0,
                    width: q,
                    height: r
                }, t.strokeWidth())), t.isNew = !1);
                t[k ? "show" : "hide"]();
                a.legendWidth = q;
                a.legendHeight = r;
                f(n, function(b) {
                    a.positionItem(b)
                });
                k && b.align(m(w, {
                    width: q,
                    height: r
                }), !0, "spacingBox");
                e.isResizing || this.positionCheckboxes()
            },
            handleOverflow: function(a) {
                var c = this,
                    d = this.chart,
                    b = d.renderer,
                    g = this.options,
                    n = g.y,
                    k = this.padding,
                    d = d.spacingBox.height + ("top" ===
                        g.verticalAlign ? -n : n) - k,
                    n = g.maxHeight,
                    r, m = this.clipRect,
                    w = g.navigation,
                    q = v(w.animation, !0),
                    t = w.arrowSize || 12,
                    p = this.nav,
                    B = this.pages,
                    H, F = this.allItems,
                    h = function(a) {
                        "number" === typeof a ? m.attr({
                            height: a
                        }) : m && (c.clipRect = m.destroy(), c.contentGroup.clip());
                        c.contentGroup.div && (c.contentGroup.div.style.clip = a ? "rect(" + k + "px,9999px," + (k + a) + "px,0)" : "auto")
                    };
                "horizontal" !== g.layout || "middle" === g.verticalAlign || g.floating || (d /= 2);
                n && (d = Math.min(d, n));
                B.length = 0;
                a > d && !1 !== w.enabled ? (this.clipHeight = r = Math.max(d -
                    20 - this.titleHeight - k, 0), this.currentPage = v(this.currentPage, 1), this.fullHeight = a, f(F, function(a, b) {
                    var c = a._legendItemPos[1];
                    a = Math.round(a.legendItem.getBBox().height);
                    var e = B.length;
                    if (!e || c - B[e - 1] > r && (H || c) !== B[e - 1]) B.push(H || c), e++;
                    b === F.length - 1 && c + a - B[e - 1] > r && B.push(c);
                    c !== H && (H = c)
                }), m || (m = c.clipRect = b.clipRect(0, k, 9999, 0), c.contentGroup.clip(m)), h(r), p || (this.nav = p = b.g().attr({
                        zIndex: 1
                    }).add(this.group), this.up = b.symbol("triangle", 0, 0, t, t).on("click", function() {
                        c.scroll(-1, q)
                    }).add(p), this.pager =
                    b.text("", 15, 10).addClass("highcharts-legend-navigation").css(w.style).add(p), this.down = b.symbol("triangle-down", 0, 0, t, t).on("click", function() {
                        c.scroll(1, q)
                    }).add(p)), c.scroll(0), a = d) : p && (h(), this.nav = p.destroy(), this.scrollGroup.attr({
                    translateY: 1
                }), this.clipHeight = 0);
                return a
            },
            scroll: function(a, e) {
                var c = this.pages,
                    b = c.length;
                a = this.currentPage + a;
                var d = this.clipHeight,
                    g = this.options.navigation,
                    n = this.pager,
                    f = this.padding;
                a > b && (a = b);
                0 < a && (void 0 !== e && u(e, this.chart), this.nav.attr({
                    translateX: f,
                    translateY: d +
                        this.padding + 7 + this.titleHeight,
                    visibility: "visible"
                }), this.up.attr({
                    "class": 1 === a ? "highcharts-legend-nav-inactive" : "highcharts-legend-nav-active"
                }), n.attr({
                    text: a + "/" + b
                }), this.down.attr({
                    x: 18 + this.pager.getBBox().width,
                    "class": a === b ? "highcharts-legend-nav-inactive" : "highcharts-legend-nav-active"
                }), this.up.attr({
                    fill: 1 === a ? g.inactiveColor : g.activeColor
                }).css({
                    cursor: 1 === a ? "default" : "pointer"
                }), this.down.attr({
                    fill: a === b ? g.inactiveColor : g.activeColor
                }).css({
                    cursor: a === b ? "default" : "pointer"
                }), e = -c[a -
                    1] + this.initialItemY, this.scrollGroup.animate({
                    translateY: e
                }), this.currentPage = a, this.positionCheckboxes(e))
            }
        };
        a.LegendSymbolMixin = {
            drawRectangle: function(a, e) {
                var c = a.symbolHeight,
                    b = a.options.squareSymbol;
                e.legendSymbol = this.chart.renderer.rect(b ? (a.symbolWidth - c) / 2 : 0, a.baseline - c + 1, b ? c : a.symbolWidth, c, v(a.options.symbolRadius, c / 2)).addClass("highcharts-point").attr({
                    zIndex: 3
                }).add(e.legendGroup)
            },
            drawLineMarker: function(a) {
                var c = this.options,
                    d = c.marker,
                    b = a.symbolWidth,
                    g = a.symbolHeight,
                    n = g / 2,
                    f = this.chart.renderer,
                    k = this.legendGroup;
                a = a.baseline - Math.round(.3 * a.fontMetrics.b);
                var q;
                q = {
                    "stroke-width": c.lineWidth || 0
                };
                c.dashStyle && (q.dashstyle = c.dashStyle);
                this.legendLine = f.path(["M", 0, a, "L", b, a]).addClass("highcharts-graph").attr(q).add(k);
                d && !1 !== d.enabled && (c = Math.min(v(d.radius, n), n), 0 === this.symbol.indexOf("url") && (d = m(d, {
                    width: g,
                    height: g
                }), c = 0), this.legendSymbol = d = f.symbol(this.symbol, b / 2 - c, a - c, 2 * c, 2 * c, d).addClass("highcharts-point").add(k), d.isMarker = !0)
            }
        };
        (/Trident\/7\.0/.test(g.navigator.userAgent) ||
            k) && n(a.Legend.prototype, "positionItem", function(a, e) {
            var c = this,
                b = function() {
                    e._legendItemPos && a.call(c, e)
                };
            b();
            setTimeout(b)
        })
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.animate,
            G = a.animObject,
            q = a.attr,
            f = a.doc,
            k = a.Axis,
            t = a.createElement,
            m = a.defaultOptions,
            v = a.discardElement,
            u = a.charts,
            d = a.css,
            g = a.defined,
            n = a.each,
            c = a.extend,
            e = a.find,
            l = a.fireEvent,
            b = a.grep,
            z = a.isNumber,
            A = a.isObject,
            I = a.isString,
            r = a.Legend,
            J = a.marginNames,
            w = a.merge,
            D = a.objectEach,
            M = a.Pointer,
            p = a.pick,
            B = a.pInt,
            H = a.removeEvent,
            F = a.seriesTypes,
            h = a.splat,
            x = a.svg,
            R = a.syncTimeout,
            K = a.win,
            P = a.Chart = function() {
                this.getArgs.apply(this, arguments)
            };
        a.chart = function(a, b, c) {
            return new P(a, b, c)
        };
        c(P.prototype, {
            callbacks: [],
            getArgs: function() {
                var a = [].slice.call(arguments);
                if (I(a[0]) || a[0].nodeName) this.renderTo = a.shift();
                this.init(a[0], a[1])
            },
            init: function(b, c) {
                var e, d, h = b.series,
                    p = b.plotOptions || {};
                b.series = null;
                e = w(m, b);
                for (d in e.plotOptions) e.plotOptions[d].tooltip = p[d] && w(p[d].tooltip) || void 0;
                e.tooltip.userOptions = b.chart && b.chart.forExport &&
                    b.tooltip.userOptions || b.tooltip;
                e.series = b.series = h;
                this.userOptions = b;
                b = e.chart;
                d = b.events;
                this.margin = [];
                this.spacing = [];
                this.bounds = {
                    h: {},
                    v: {}
                };
                this.labelCollectors = [];
                this.callback = c;
                this.isResizing = 0;
                this.options = e;
                this.axes = [];
                this.series = [];
                this.hasCartesianSeries = b.showAxes;
                var g = this;
                g.index = u.length;
                u.push(g);
                a.chartCount++;
                d && D(d, function(a, b) {
                    E(g, b, a)
                });
                g.xAxis = [];
                g.yAxis = [];
                g.pointCount = g.colorCounter = g.symbolCounter = 0;
                g.firstRender()
            },
            initSeries: function(b) {
                var c = this.options.chart;
                (c = F[b.type || c.type || c.defaultSeriesType]) || a.error(17, !0);
                c = new c;
                c.init(this, b);
                return c
            },
            orderSeries: function(a) {
                var b = this.series;
                for (a = a || 0; a < b.length; a++) b[a] && (b[a].index = a, b[a].name = b[a].name || "Series " + (b[a].index + 1))
            },
            isInsidePlot: function(a, b, c) {
                var e = c ? b : a;
                a = c ? a : b;
                return 0 <= e && e <= this.plotWidth && 0 <= a && a <= this.plotHeight
            },
            redraw: function(b) {
                var e = this.axes,
                    d = this.series,
                    h = this.pointer,
                    p = this.legend,
                    g = this.isDirtyLegend,
                    f, k, r = this.hasCartesianSeries,
                    B = this.isDirtyBox,
                    m, H = this.renderer,
                    x =
                    H.isHidden(),
                    w = [];
                this.setResponsive && this.setResponsive(!1);
                a.setAnimation(b, this);
                x && this.temporaryDisplay();
                this.layOutTitles();
                for (b = d.length; b--;)
                    if (m = d[b], m.options.stacking && (f = !0, m.isDirty)) {
                        k = !0;
                        break
                    }
                if (k)
                    for (b = d.length; b--;) m = d[b], m.options.stacking && (m.isDirty = !0);
                n(d, function(a) {
                    a.isDirty && "point" === a.options.legendType && (a.updateTotals && a.updateTotals(), g = !0);
                    a.isDirtyData && l(a, "updatedData")
                });
                g && p.options.enabled && (p.render(), this.isDirtyLegend = !1);
                f && this.getStacks();
                r && n(e, function(a) {
                    a.updateNames();
                    a.setScale()
                });
                this.getMargins();
                r && (n(e, function(a) {
                    a.isDirty && (B = !0)
                }), n(e, function(a) {
                    var b = a.min + "," + a.max;
                    a.extKey !== b && (a.extKey = b, w.push(function() {
                        l(a, "afterSetExtremes", c(a.eventArgs, a.getExtremes()));
                        delete a.eventArgs
                    }));
                    (B || f) && a.redraw()
                }));
                B && this.drawChartBox();
                l(this, "predraw");
                n(d, function(a) {
                    (B || a.isDirty) && a.visible && a.redraw();
                    a.isDirtyData = !1
                });
                h && h.reset(!0);
                H.draw();
                l(this, "redraw");
                l(this, "render");
                x && this.temporaryDisplay(!0);
                n(w, function(a) {
                    a.call()
                })
            },
            get: function(a) {
                function b(b) {
                    return b.id ===
                        a || b.options && b.options.id === a
                }
                var c, d = this.series,
                    h;
                c = e(this.axes, b) || e(this.series, b);
                for (h = 0; !c && h < d.length; h++) c = e(d[h].points || [], b);
                return c
            },
            getAxes: function() {
                var a = this,
                    b = this.options,
                    c = b.xAxis = h(b.xAxis || {}),
                    b = b.yAxis = h(b.yAxis || {});
                n(c, function(a, b) {
                    a.index = b;
                    a.isX = !0
                });
                n(b, function(a, b) {
                    a.index = b
                });
                c = c.concat(b);
                n(c, function(b) {
                    new k(a, b)
                })
            },
            getSelectedPoints: function() {
                var a = [];
                n(this.series, function(c) {
                    a = a.concat(b(c.data || [], function(a) {
                        return a.selected
                    }))
                });
                return a
            },
            getSelectedSeries: function() {
                return b(this.series,
                    function(a) {
                        return a.selected
                    })
            },
            setTitle: function(a, b, c) {
                var e = this,
                    d = e.options,
                    h;
                h = d.title = w({
                    style: {
                        color: "#333333",
                        fontSize: d.isStock ? "16px" : "18px"
                    }
                }, d.title, a);
                d = d.subtitle = w({
                    style: {
                        color: "#666666"
                    }
                }, d.subtitle, b);
                n([
                    ["title", a, h],
                    ["subtitle", b, d]
                ], function(a, b) {
                    var c = a[0],
                        d = e[c],
                        h = a[1];
                    a = a[2];
                    d && h && (e[c] = d = d.destroy());
                    a && !d && (e[c] = e.renderer.text(a.text, 0, 0, a.useHTML).attr({
                        align: a.align,
                        "class": "highcharts-" + c,
                        zIndex: a.zIndex || 4
                    }).add(), e[c].update = function(a) {
                        e.setTitle(!b && a, b && a)
                    }, e[c].css(a.style))
                });
                e.layOutTitles(c)
            },
            layOutTitles: function(a) {
                var b = 0,
                    e, d = this.renderer,
                    h = this.spacingBox;
                n(["title", "subtitle"], function(a) {
                    var e = this[a],
                        p = this.options[a];
                    a = "title" === a ? -3 : p.verticalAlign ? 0 : b + 2;
                    var g;
                    e && (g = p.style.fontSize, g = d.fontMetrics(g, e).b, e.css({
                        width: (p.width || h.width + p.widthAdjust) + "px"
                    }).align(c({
                        y: a + g
                    }, p), !1, "spacingBox"), p.floating || p.verticalAlign || (b = Math.ceil(b + e.getBBox(p.useHTML).height)))
                }, this);
                e = this.titleOffset !== b;
                this.titleOffset = b;
                !this.isDirtyBox && e && (this.isDirtyBox = e, this.hasRendered &&
                    p(a, !0) && this.isDirtyBox && this.redraw())
            },
            getChartSize: function() {
                var b = this.options.chart,
                    c = b.width,
                    b = b.height,
                    e = this.renderTo;
                g(c) || (this.containerWidth = a.getStyle(e, "width"));
                g(b) || (this.containerHeight = a.getStyle(e, "height"));
                this.chartWidth = Math.max(0, c || this.containerWidth || 600);
                this.chartHeight = Math.max(0, a.relativeLength(b, this.chartWidth) || (1 < this.containerHeight ? this.containerHeight : 400))
            },
            temporaryDisplay: function(b) {
                var c = this.renderTo;
                if (b)
                    for (; c && c.style;) c.hcOrigStyle && (a.css(c, c.hcOrigStyle),
                        delete c.hcOrigStyle), c.hcOrigDetached && (f.body.removeChild(c), c.hcOrigDetached = !1), c = c.parentNode;
                else
                    for (; c && c.style;) {
                        f.body.contains(c) || c.parentNode || (c.hcOrigDetached = !0, f.body.appendChild(c));
                        if ("none" === a.getStyle(c, "display", !1) || c.hcOricDetached) c.hcOrigStyle = {
                            display: c.style.display,
                            height: c.style.height,
                            overflow: c.style.overflow
                        }, b = {
                            display: "block",
                            overflow: "hidden"
                        }, c !== this.renderTo && (b.height = 0), a.css(c, b), c.offsetWidth || c.style.setProperty("display", "block", "important");
                        c = c.parentNode;
                        if (c === f.body) break
                    }
            },
            setClassName: function(a) {
                this.container.className = "highcharts-container " + (a || "")
            },
            getContainer: function() {
                var b, e = this.options,
                    d = e.chart,
                    h, p;
                b = this.renderTo;
                var g = a.uniqueKey(),
                    l;
                b || (this.renderTo = b = d.renderTo);
                I(b) && (this.renderTo = b = f.getElementById(b));
                b || a.error(13, !0);
                h = B(q(b, "data-highcharts-chart"));
                z(h) && u[h] && u[h].hasRendered && u[h].destroy();
                q(b, "data-highcharts-chart", this.index);
                b.innerHTML = "";
                d.skipClone || b.offsetWidth || this.temporaryDisplay();
                this.getChartSize();
                h = this.chartWidth;
                p = this.chartHeight;
                l = c({
                    position: "relative",
                    overflow: "hidden",
                    width: h + "px",
                    height: p + "px",
                    textAlign: "left",
                    lineHeight: "normal",
                    zIndex: 0,
                    "-webkit-tap-highlight-color": "rgba(0,0,0,0)"
                }, d.style);
                this.container = b = t("div", {
                    id: g
                }, l, b);
                this._cursor = b.style.cursor;
                this.renderer = new(a[d.renderer] || a.Renderer)(b, h, p, null, d.forExport, e.exporting && e.exporting.allowHTML);
                this.setClassName(d.className);
                this.renderer.setStyle(d.style);
                this.renderer.chartIndex = this.index
            },
            getMargins: function(a) {
                var b =
                    this.spacing,
                    c = this.margin,
                    e = this.titleOffset;
                this.resetMargins();
                e && !g(c[0]) && (this.plotTop = Math.max(this.plotTop, e + this.options.title.margin + b[0]));
                this.legend && this.legend.display && this.legend.adjustMargins(c, b);
                this.extraMargin && (this[this.extraMargin.type] = (this[this.extraMargin.type] || 0) + this.extraMargin.value);
                this.adjustPlotArea && this.adjustPlotArea();
                a || this.getAxisMargins()
            },
            getAxisMargins: function() {
                var a = this,
                    b = a.axisOffset = [0, 0, 0, 0],
                    c = a.margin;
                a.hasCartesianSeries && n(a.axes, function(a) {
                    a.visible &&
                        a.getOffset()
                });
                n(J, function(e, d) {
                    g(c[d]) || (a[e] += b[d])
                });
                a.setChartSize()
            },
            reflow: function(b) {
                var c = this,
                    e = c.options.chart,
                    d = c.renderTo,
                    h = g(e.width) && g(e.height),
                    p = e.width || a.getStyle(d, "width"),
                    e = e.height || a.getStyle(d, "height"),
                    d = b ? b.target : K;
                if (!h && !c.isPrinting && p && e && (d === K || d === f)) {
                    if (p !== c.containerWidth || e !== c.containerHeight) clearTimeout(c.reflowTimeout), c.reflowTimeout = R(function() {
                        c.container && c.setSize(void 0, void 0, !1)
                    }, b ? 100 : 0);
                    c.containerWidth = p;
                    c.containerHeight = e
                }
            },
            initReflow: function() {
                var a =
                    this,
                    b;
                b = E(K, "resize", function(b) {
                    a.reflow(b)
                });
                E(a, "destroy", b)
            },
            setSize: function(b, c, e) {
                var h = this,
                    p = h.renderer;
                h.isResizing += 1;
                a.setAnimation(e, h);
                h.oldChartHeight = h.chartHeight;
                h.oldChartWidth = h.chartWidth;
                void 0 !== b && (h.options.chart.width = b);
                void 0 !== c && (h.options.chart.height = c);
                h.getChartSize();
                b = p.globalAnimation;
                (b ? C : d)(h.container, {
                    width: h.chartWidth + "px",
                    height: h.chartHeight + "px"
                }, b);
                h.setChartSize(!0);
                p.setSize(h.chartWidth, h.chartHeight, e);
                n(h.axes, function(a) {
                    a.isDirty = !0;
                    a.setScale()
                });
                h.isDirtyLegend = !0;
                h.isDirtyBox = !0;
                h.layOutTitles();
                h.getMargins();
                h.redraw(e);
                h.oldChartHeight = null;
                l(h, "resize");
                R(function() {
                    h && l(h, "endResize", null, function() {
                        --h.isResizing
                    })
                }, G(b).duration)
            },
            setChartSize: function(a) {
                var b = this.inverted,
                    c = this.renderer,
                    e = this.chartWidth,
                    d = this.chartHeight,
                    h = this.options.chart,
                    p = this.spacing,
                    g = this.clipOffset,
                    l, f, k, r;
                this.plotLeft = l = Math.round(this.plotLeft);
                this.plotTop = f = Math.round(this.plotTop);
                this.plotWidth = k = Math.max(0, Math.round(e - l - this.marginRight));
                this.plotHeight = r = Math.max(0, Math.round(d - f - this.marginBottom));
                this.plotSizeX = b ? r : k;
                this.plotSizeY = b ? k : r;
                this.plotBorderWidth = h.plotBorderWidth || 0;
                this.spacingBox = c.spacingBox = {
                    x: p[3],
                    y: p[0],
                    width: e - p[3] - p[1],
                    height: d - p[0] - p[2]
                };
                this.plotBox = c.plotBox = {
                    x: l,
                    y: f,
                    width: k,
                    height: r
                };
                e = 2 * Math.floor(this.plotBorderWidth / 2);
                b = Math.ceil(Math.max(e, g[3]) / 2);
                c = Math.ceil(Math.max(e, g[0]) / 2);
                this.clipBox = {
                    x: b,
                    y: c,
                    width: Math.floor(this.plotSizeX - Math.max(e, g[1]) / 2 - b),
                    height: Math.max(0, Math.floor(this.plotSizeY -
                        Math.max(e, g[2]) / 2 - c))
                };
                a || n(this.axes, function(a) {
                    a.setAxisSize();
                    a.setAxisTranslation()
                })
            },
            resetMargins: function() {
                var a = this,
                    b = a.options.chart;
                n(["margin", "spacing"], function(c) {
                    var e = b[c],
                        d = A(e) ? e : [e, e, e, e];
                    n(["Top", "Right", "Bottom", "Left"], function(e, h) {
                        a[c][h] = p(b[c + e], d[h])
                    })
                });
                n(J, function(b, c) {
                    a[b] = p(a.margin[c], a.spacing[c])
                });
                a.axisOffset = [0, 0, 0, 0];
                a.clipOffset = [0, 0, 0, 0]
            },
            drawChartBox: function() {
                var a = this.options.chart,
                    b = this.renderer,
                    c = this.chartWidth,
                    e = this.chartHeight,
                    d = this.chartBackground,
                    h = this.plotBackground,
                    p = this.plotBorder,
                    g, l = this.plotBGImage,
                    f = a.backgroundColor,
                    n = a.plotBackgroundColor,
                    k = a.plotBackgroundImage,
                    r, m = this.plotLeft,
                    B = this.plotTop,
                    H = this.plotWidth,
                    x = this.plotHeight,
                    w = this.plotBox,
                    q = this.clipRect,
                    D = this.clipBox,
                    F = "animate";
                d || (this.chartBackground = d = b.rect().addClass("highcharts-background").add(), F = "attr");
                g = a.borderWidth || 0;
                r = g + (a.shadow ? 8 : 0);
                f = {
                    fill: f || "none"
                };
                if (g || d["stroke-width"]) f.stroke = a.borderColor, f["stroke-width"] = g;
                d.attr(f).shadow(a.shadow);
                d[F]({
                    x: r /
                        2,
                    y: r / 2,
                    width: c - r - g % 2,
                    height: e - r - g % 2,
                    r: a.borderRadius
                });
                F = "animate";
                h || (F = "attr", this.plotBackground = h = b.rect().addClass("highcharts-plot-background").add());
                h[F](w);
                h.attr({
                    fill: n || "none"
                }).shadow(a.plotShadow);
                k && (l ? l.animate(w) : this.plotBGImage = b.image(k, m, B, H, x).add());
                q ? q.animate({
                    width: D.width,
                    height: D.height
                }) : this.clipRect = b.clipRect(D);
                F = "animate";
                p || (F = "attr", this.plotBorder = p = b.rect().addClass("highcharts-plot-border").attr({
                    zIndex: 1
                }).add());
                p.attr({
                    stroke: a.plotBorderColor,
                    "stroke-width": a.plotBorderWidth ||
                        0,
                    fill: "none"
                });
                p[F](p.crisp({
                    x: m,
                    y: B,
                    width: H,
                    height: x
                }, -p.strokeWidth()));
                this.isDirtyBox = !1
            },
            propFromSeries: function() {
                var a = this,
                    b = a.options.chart,
                    c, e = a.options.series,
                    d, h;
                n(["inverted", "angular", "polar"], function(p) {
                    c = F[b.type || b.defaultSeriesType];
                    h = b[p] || c && c.prototype[p];
                    for (d = e && e.length; !h && d--;)(c = F[e[d].type]) && c.prototype[p] && (h = !0);
                    a[p] = h
                })
            },
            linkSeries: function() {
                var a = this,
                    b = a.series;
                n(b, function(a) {
                    a.linkedSeries.length = 0
                });
                n(b, function(b) {
                    var c = b.options.linkedTo;
                    I(c) && (c = ":previous" ===
                        c ? a.series[b.index - 1] : a.get(c)) && c.linkedParent !== b && (c.linkedSeries.push(b), b.linkedParent = c, b.visible = p(b.options.visible, c.options.visible, b.visible))
                })
            },
            renderSeries: function() {
                n(this.series, function(a) {
                    a.translate();
                    a.render()
                })
            },
            renderLabels: function() {
                var a = this,
                    b = a.options.labels;
                b.items && n(b.items, function(e) {
                    var d = c(b.style, e.style),
                        h = B(d.left) + a.plotLeft,
                        p = B(d.top) + a.plotTop + 12;
                    delete d.left;
                    delete d.top;
                    a.renderer.text(e.html, h, p).attr({
                        zIndex: 2
                    }).css(d).add()
                })
            },
            render: function() {
                var a =
                    this.axes,
                    b = this.renderer,
                    c = this.options,
                    e, d, h;
                this.setTitle();
                this.legend = new r(this, c.legend);
                this.getStacks && this.getStacks();
                this.getMargins(!0);
                this.setChartSize();
                c = this.plotWidth;
                e = this.plotHeight -= 21;
                n(a, function(a) {
                    a.setScale()
                });
                this.getAxisMargins();
                d = 1.1 < c / this.plotWidth;
                h = 1.05 < e / this.plotHeight;
                if (d || h) n(a, function(a) {
                    (a.horiz && d || !a.horiz && h) && a.setTickInterval(!0)
                }), this.getMargins();
                this.drawChartBox();
                this.hasCartesianSeries && n(a, function(a) {
                    a.visible && a.render()
                });
                this.seriesGroup ||
                    (this.seriesGroup = b.g("series-group").attr({
                        zIndex: 3
                    }).add());
                this.renderSeries();
                this.renderLabels();
                // this.addCredits();
                this.setResponsive && this.setResponsive();
                this.hasRendered = !0
            },
            addCredits: function(a) {
                var b = this;
                a = w(!0, this.options.credits, a);
                a.enabled && !this.credits && (this.credits = this.renderer.text(a.text + (this.mapCredits || ""), 0, 0).addClass("highcharts-credits").on("click", function() {
                        a.href && (K.location.href = a.href)
                    }).attr({
                        align: a.position.align,
                        zIndex: 8
                    }).css(a.style).add().align(a.position),
                    this.credits.update = function(a) {
                        b.credits = b.credits.destroy();
                        b.addCredits(a)
                    })
            },
            destroy: function() {
                var b = this,
                    c = b.axes,
                    e = b.series,
                    d = b.container,
                    h, p = d && d.parentNode;
                l(b, "destroy");
                b.renderer.forExport ? a.erase(u, b) : u[b.index] = void 0;
                a.chartCount--;
                b.renderTo.removeAttribute("data-highcharts-chart");
                H(b);
                for (h = c.length; h--;) c[h] = c[h].destroy();
                this.scroller && this.scroller.destroy && this.scroller.destroy();
                for (h = e.length; h--;) e[h] = e[h].destroy();
                n("title subtitle chartBackground plotBackground plotBGImage plotBorder seriesGroup clipRect credits pointer rangeSelector legend resetZoomButton tooltip renderer".split(" "),
                    function(a) {
                        var c = b[a];
                        c && c.destroy && (b[a] = c.destroy())
                    });
                d && (d.innerHTML = "", H(d), p && v(d));
                D(b, function(a, c) {
                    delete b[c]
                })
            },
            isReadyToRender: function() {
                var a = this;
                return x || K != K.top || "complete" === f.readyState ? !0 : (f.attachEvent("onreadystatechange", function() {
                    f.detachEvent("onreadystatechange", a.firstRender);
                    "complete" === f.readyState && a.firstRender()
                }), !1)
            },
            firstRender: function() {
                var a = this,
                    b = a.options;
                if (a.isReadyToRender()) {
                    a.getContainer();
                    l(a, "init");
                    a.resetMargins();
                    a.setChartSize();
                    a.propFromSeries();
                    a.getAxes();
                    n(b.series || [], function(b) {
                        a.initSeries(b)
                    });
                    a.linkSeries();
                    l(a, "beforeRender");
                    M && (a.pointer = new M(a, b));
                    a.render();
                    if (!a.renderer.imgCount && a.onload) a.onload();
                    a.temporaryDisplay(!0)
                }
            },
            onload: function() {
                n([this.callback].concat(this.callbacks), function(a) {
                    a && void 0 !== this.index && a.apply(this, [this])
                }, this);
                l(this, "load");
                l(this, "render");
                g(this.index) && !1 !== this.options.chart.reflow && this.initReflow();
                this.onload = null
            }
        })
    })(N);
    (function(a) {
        var E, C = a.each,
            G = a.extend,
            q = a.erase,
            f = a.fireEvent,
            k = a.format,
            t = a.isArray,
            m = a.isNumber,
            v = a.pick,
            u = a.removeEvent;
        a.Point = E = function() {};
        a.Point.prototype = {
            init: function(a, g, f) {
                this.series = a;
                this.color = a.color;
                this.applyOptions(g, f);
                a.options.colorByPoint ? (g = a.options.colors || a.chart.options.colors, this.color = this.color || g[a.colorCounter], g = g.length, f = a.colorCounter, a.colorCounter++, a.colorCounter === g && (a.colorCounter = 0)) : f = a.colorIndex;
                this.colorIndex = v(this.colorIndex, f);
                a.chart.pointCount++;
                return this
            },
            applyOptions: function(a, g) {
                var d = this.series,
                    c = d.options.pointValKey || d.pointValKey;
                a = E.prototype.optionsToObject.call(this, a);
                G(this, a);
                this.options = this.options ? G(this.options, a) : a;
                a.group && delete this.group;
                c && (this.y = this[c]);
                this.isNull = v(this.isValid && !this.isValid(), null === this.x || !m(this.y, !0));
                this.selected && (this.state = "select");
                "name" in this && void 0 === g && d.xAxis && d.xAxis.hasNames && (this.x = d.xAxis.nameToX(this));
                void 0 === this.x && d && (this.x = void 0 === g ? d.autoIncrement(this) : g);
                return this
            },
            optionsToObject: function(a) {
                var d = {},
                    f = this.series,
                    c = f.options.keys,
                    e = c || f.pointArrayMap || ["y"],
                    l = e.length,
                    b = 0,
                    k = 0;
                if (m(a) || null === a) d[e[0]] = a;
                else if (t(a))
                    for (!c && a.length > l && (f = typeof a[0], "string" === f ? d.name = a[0] : "number" === f && (d.x = a[0]), b++); k < l;) c && void 0 === a[b] || (d[e[k]] = a[b]), b++, k++;
                else "object" === typeof a && (d = a, a.dataLabels && (f._hasPointLabels = !0), a.marker && (f._hasPointMarkers = !0));
                return d
            },
            getClassName: function() {
                return "highcharts-point" + (this.selected ? " highcharts-point-select" : "") + (this.negative ? " highcharts-negative" : "") + (this.isNull ?
                    " highcharts-null-point" : "") + (void 0 !== this.colorIndex ? " highcharts-color-" + this.colorIndex : "") + (this.options.className ? " " + this.options.className : "") + (this.zone && this.zone.className ? " " + this.zone.className.replace("highcharts-negative", "") : "")
            },
            getZone: function() {
                var a = this.series,
                    g = a.zones,
                    a = a.zoneAxis || "y",
                    f = 0,
                    c;
                for (c = g[f]; this[a] >= c.value;) c = g[++f];
                c && c.color && !this.options.color && (this.color = c.color);
                return c
            },
            destroy: function() {
                var a = this.series.chart,
                    g = a.hoverPoints,
                    f;
                a.pointCount--;
                g && (this.setState(),
                    q(g, this), g.length || (a.hoverPoints = null));
                if (this === a.hoverPoint) this.onMouseOut();
                if (this.graphic || this.dataLabel) u(this), this.destroyElements();
                this.legendItem && a.legend.destroyItem(this);
                for (f in this) this[f] = null
            },
            destroyElements: function() {
                for (var a = ["graphic", "dataLabel", "dataLabelUpper", "connector", "shadowGroup"], g, f = 6; f--;) g = a[f], this[g] && (this[g] = this[g].destroy())
            },
            getLabelConfig: function() {
                return {
                    x: this.category,
                    y: this.y,
                    color: this.color,
                    colorIndex: this.colorIndex,
                    key: this.name || this.category,
                    series: this.series,
                    point: this,
                    percentage: this.percentage,
                    total: this.total || this.stackTotal
                }
            },
            tooltipFormatter: function(a) {
                var d = this.series,
                    f = d.tooltipOptions,
                    c = v(f.valueDecimals, ""),
                    e = f.valuePrefix || "",
                    l = f.valueSuffix || "";
                C(d.pointArrayMap || ["y"], function(b) {
                    b = "{point." + b;
                    if (e || l) a = a.replace(b + "}", e + b + "}" + l);
                    a = a.replace(b + "}", b + ":,." + c + "f}")
                });
                return k(a, {
                    point: this,
                    series: this.series
                })
            },
            firePointEvent: function(a, g, n) {
                var c = this,
                    e = this.series.options;
                (e.point.events[a] || c.options && c.options.events &&
                    c.options.events[a]) && this.importEvents();
                "click" === a && e.allowPointSelect && (n = function(a) {
                    c.select && c.select(null, a.ctrlKey || a.metaKey || a.shiftKey)
                });
                f(this, a, g, n)
            },
            visible: !0
        }
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.animObject,
            G = a.arrayMax,
            q = a.arrayMin,
            f = a.correctFloat,
            k = a.Date,
            t = a.defaultOptions,
            m = a.defaultPlotOptions,
            v = a.defined,
            u = a.each,
            d = a.erase,
            g = a.extend,
            n = a.fireEvent,
            c = a.grep,
            e = a.isArray,
            l = a.isNumber,
            b = a.isString,
            z = a.merge,
            A = a.objectEach,
            I = a.pick,
            r = a.removeEvent,
            J = a.splat,
            w = a.SVGElement,
            D =
            a.syncTimeout,
            M = a.win;
        a.Series = a.seriesType("line", null, {
            lineWidth: 2,
            allowPointSelect: !1,
            showCheckbox: !1,
            animation: {
                duration: 1E3
            },
            events: {},
            marker: {
                lineWidth: 0,
                lineColor: "#ffffff",
                radius: 4,
                states: {
                    hover: {
                        animation: {
                            duration: 50
                        },
                        enabled: !0,
                        radiusPlus: 2,
                        lineWidthPlus: 1
                    },
                    select: {
                        fillColor: "#cccccc",
                        lineColor: "#000000",
                        lineWidth: 2
                    }
                }
            },
            point: {
                events: {}
            },
            dataLabels: {
                align: "center",
                formatter: function() {
                    return null === this.y ? "" : a.numberFormat(this.y, -1)
                },
                style: {
                    fontSize: "11px",
                    fontWeight: "bold",
                    color: "contrast",
                    textOutline: "1px contrast"
                },
                verticalAlign: "bottom",
                x: 0,
                y: 0,
                padding: 5
            },
            cropThreshold: 300,
            pointRange: 0,
            softThreshold: !0,
            states: {
                hover: {
                    animation: {
                        duration: 50
                    },
                    lineWidthPlus: 1,
                    marker: {},
                    halo: {
                        size: 10,
                        opacity: .25
                    }
                },
                select: {
                    marker: {}
                }
            },
            stickyTracking: !0,
            turboThreshold: 1E3,
            findNearestPointBy: "x"
        }, {
            isCartesian: !0,
            pointClass: a.Point,
            sorted: !0,
            requireSorting: !0,
            directTouch: !1,
            axisTypes: ["xAxis", "yAxis"],
            colorCounter: 0,
            parallelArrays: ["x", "y"],
            coll: "series",
            init: function(a, b) {
                var c = this,
                    e, d = a.series,
                    p;
                c.chart =
                    a;
                c.options = b = c.setOptions(b);
                c.linkedSeries = [];
                c.bindAxes();
                g(c, {
                    name: b.name,
                    state: "",
                    visible: !1 !== b.visible,
                    selected: !0 === b.selected
                });
                e = b.events;
                A(e, function(a, b) {
                    E(c, b, a)
                });
                if (e && e.click || b.point && b.point.events && b.point.events.click || b.allowPointSelect) a.runTrackerClick = !0;
                c.getColor();
                c.getSymbol();
                u(c.parallelArrays, function(a) {
                    c[a + "Data"] = []
                });
                c.setData(b.data, !1);
                c.isCartesian && (a.hasCartesianSeries = !0);
                d.length && (p = d[d.length - 1]);
                c._i = I(p && p._i, -1) + 1;
                a.orderSeries(this.insert(d))
            },
            insert: function(a) {
                var b =
                    this.options.index,
                    c;
                if (l(b)) {
                    for (c = a.length; c--;)
                        if (b >= I(a[c].options.index, a[c]._i)) {
                            a.splice(c + 1, 0, this);
                            break
                        } - 1 === c && a.unshift(this);
                    c += 1
                } else a.push(this);
                return I(c, a.length - 1)
            },
            bindAxes: function() {
                var b = this,
                    c = b.options,
                    e = b.chart,
                    d;
                u(b.axisTypes || [], function(h) {
                    u(e[h], function(a) {
                        d = a.options;
                        if (c[h] === d.index || void 0 !== c[h] && c[h] === d.id || void 0 === c[h] && 0 === d.index) b.insert(a.series), b[h] = a, a.isDirty = !0
                    });
                    b[h] || b.optionalAxis === h || a.error(18, !0)
                })
            },
            updateParallelArrays: function(a, b) {
                var c =
                    a.series,
                    e = arguments,
                    d = l(b) ? function(e) {
                        var d = "y" === e && c.toYData ? c.toYData(a) : a[e];
                        c[e + "Data"][b] = d
                    } : function(a) {
                        Array.prototype[b].apply(c[a + "Data"], Array.prototype.slice.call(e, 2))
                    };
                u(c.parallelArrays, d)
            },
            autoIncrement: function() {
                var a = this.options,
                    b = this.xIncrement,
                    c, e = a.pointIntervalUnit,
                    b = I(b, a.pointStart, 0);
                this.pointInterval = c = I(this.pointInterval, a.pointInterval, 1);
                e && (a = new k(b), "day" === e ? a = +a[k.hcSetDate](a[k.hcGetDate]() + c) : "month" === e ? a = +a[k.hcSetMonth](a[k.hcGetMonth]() + c) : "year" === e &&
                    (a = +a[k.hcSetFullYear](a[k.hcGetFullYear]() + c)), c = a - b);
                this.xIncrement = b + c;
                return b
            },
            setOptions: function(a) {
                var b = this.chart,
                    c = b.options,
                    e = c.plotOptions,
                    d = (b.userOptions || {}).plotOptions || {},
                    p = e[this.type];
                this.userOptions = a;
                b = z(p, e.series, a);
                this.tooltipOptions = z(t.tooltip, t.plotOptions.series && t.plotOptions.series.tooltip, t.plotOptions[this.type].tooltip, c.tooltip.userOptions, e.series && e.series.tooltip, e[this.type].tooltip, a.tooltip);
                this.stickyTracking = I(a.stickyTracking, d[this.type] && d[this.type].stickyTracking,
                    d.series && d.series.stickyTracking, this.tooltipOptions.shared && !this.noSharedTooltip ? !0 : b.stickyTracking);
                null === p.marker && delete b.marker;
                this.zoneAxis = b.zoneAxis;
                a = this.zones = (b.zones || []).slice();
                !b.negativeColor && !b.negativeFillColor || b.zones || a.push({
                    value: b[this.zoneAxis + "Threshold"] || b.threshold || 0,
                    className: "highcharts-negative",
                    color: b.negativeColor,
                    fillColor: b.negativeFillColor
                });
                a.length && v(a[a.length - 1].value) && a.push({
                    color: this.color,
                    fillColor: this.fillColor
                });
                return b
            },
            getCyclic: function(a,
                b, c) {
                var e, d = this.chart,
                    p = this.userOptions,
                    g = a + "Index",
                    f = a + "Counter",
                    l = c ? c.length : I(d.options.chart[a + "Count"], d[a + "Count"]);
                b || (e = I(p[g], p["_" + g]), v(e) || (d.series.length || (d[f] = 0), p["_" + g] = e = d[f] % l, d[f] += 1), c && (b = c[e]));
                void 0 !== e && (this[g] = e);
                this[a] = b
            },
            getColor: function() {
                this.options.colorByPoint ? this.options.color = null : this.getCyclic("color", this.options.color || m[this.type].color, this.chart.options.colors)
            },
            getSymbol: function() {
                this.getCyclic("symbol", this.options.marker.symbol, this.chart.options.symbols)
            },
            drawLegendSymbol: a.LegendSymbolMixin.drawLineMarker,
            setData: function(c, d, g, f) {
                var h = this,
                    p = h.points,
                    n = p && p.length || 0,
                    k, r = h.options,
                    m = h.chart,
                    w = null,
                    B = h.xAxis,
                    q = r.turboThreshold,
                    H = this.xData,
                    D = this.yData,
                    t = (k = h.pointArrayMap) && k.length;
                c = c || [];
                k = c.length;
                d = I(d, !0);
                if (!1 !== f && k && n === k && !h.cropped && !h.hasGroupedData && h.visible) u(c, function(a, b) {
                    p[b].update && a !== r.data[b] && p[b].update(a, !1, null, !1)
                });
                else {
                    h.xIncrement = null;
                    h.colorCounter = 0;
                    u(this.parallelArrays, function(a) {
                        h[a + "Data"].length = 0
                    });
                    if (q &&
                        k > q) {
                        for (g = 0; null === w && g < k;) w = c[g], g++;
                        if (l(w))
                            for (g = 0; g < k; g++) H[g] = this.autoIncrement(), D[g] = c[g];
                        else if (e(w))
                            if (t)
                                for (g = 0; g < k; g++) w = c[g], H[g] = w[0], D[g] = w.slice(1, t + 1);
                            else
                                for (g = 0; g < k; g++) w = c[g], H[g] = w[0], D[g] = w[1];
                        else a.error(12)
                    } else
                        for (g = 0; g < k; g++) void 0 !== c[g] && (w = {
                            series: h
                        }, h.pointClass.prototype.applyOptions.apply(w, [c[g]]), h.updateParallelArrays(w, g));
                    D && b(D[0]) && a.error(14, !0);
                    h.data = [];
                    h.options.data = h.userOptions.data = c;
                    for (g = n; g--;) p[g] && p[g].destroy && p[g].destroy();
                    B && (B.minRange =
                        B.userMinRange);
                    h.isDirty = m.isDirtyBox = !0;
                    h.isDirtyData = !!p;
                    g = !1
                }
                "point" === r.legendType && (this.processData(), this.generatePoints());
                d && m.redraw(g)
            },
            processData: function(b) {
                var c = this.xData,
                    e = this.yData,
                    d = c.length,
                    h;
                h = 0;
                var p, g, f = this.xAxis,
                    l, n = this.options;
                l = n.cropThreshold;
                var k = this.getExtremesFromAll || n.getExtremesFromAll,
                    r = this.isCartesian,
                    n = f && f.val2lin,
                    m = f && f.isLog,
                    w, q;
                if (r && !this.isDirty && !f.isDirty && !this.yAxis.isDirty && !b) return !1;
                f && (b = f.getExtremes(), w = b.min, q = b.max);
                if (r && this.sorted &&
                    !k && (!l || d > l || this.forceCrop))
                    if (c[d - 1] < w || c[0] > q) c = [], e = [];
                    else if (c[0] < w || c[d - 1] > q) h = this.cropData(this.xData, this.yData, w, q), c = h.xData, e = h.yData, h = h.start, p = !0;
                for (l = c.length || 1; --l;) d = m ? n(c[l]) - n(c[l - 1]) : c[l] - c[l - 1], 0 < d && (void 0 === g || d < g) ? g = d : 0 > d && this.requireSorting && a.error(15);
                this.cropped = p;
                this.cropStart = h;
                this.processedXData = c;
                this.processedYData = e;
                this.closestPointRange = g
            },
            cropData: function(a, b, c, e) {
                var d = a.length,
                    p = 0,
                    g = d,
                    f = I(this.cropShoulder, 1),
                    l;
                for (l = 0; l < d; l++)
                    if (a[l] >= c) {
                        p = Math.max(0,
                            l - f);
                        break
                    }
                for (c = l; c < d; c++)
                    if (a[c] > e) {
                        g = c + f;
                        break
                    }
                return {
                    xData: a.slice(p, g),
                    yData: b.slice(p, g),
                    start: p,
                    end: g
                }
            },
            generatePoints: function() {
                var a = this.options,
                    b = a.data,
                    c = this.data,
                    e, d = this.processedXData,
                    g = this.processedYData,
                    f = this.pointClass,
                    l = d.length,
                    n = this.cropStart || 0,
                    k, r = this.hasGroupedData,
                    a = a.keys,
                    m, w = [],
                    q;
                c || r || (c = [], c.length = b.length, c = this.data = c);
                a && r && (this.options.keys = !1);
                for (q = 0; q < l; q++) k = n + q, r ? (m = (new f).init(this, [d[q]].concat(J(g[q]))), m.dataGroup = this.groupMap[q]) : (m = c[k]) || void 0 ===
                    b[k] || (c[k] = m = (new f).init(this, b[k], d[q])), m && (m.index = k, w[q] = m);
                this.options.keys = a;
                if (c && (l !== (e = c.length) || r))
                    for (q = 0; q < e; q++) q !== n || r || (q += l), c[q] && (c[q].destroyElements(), c[q].plotX = void 0);
                this.data = c;
                this.points = w
            },
            getExtremes: function(a) {
                var b = this.yAxis,
                    c = this.processedXData,
                    d, h = [],
                    g = 0;
                d = this.xAxis.getExtremes();
                var p = d.min,
                    f = d.max,
                    n, k, r, m;
                a = a || this.stackedYData || this.processedYData || [];
                d = a.length;
                for (m = 0; m < d; m++)
                    if (k = c[m], r = a[m], n = (l(r, !0) || e(r)) && (!b.positiveValuesOnly || r.length || 0 < r),
                        k = this.getExtremesFromAll || this.options.getExtremesFromAll || this.cropped || (c[m + 1] || k) >= p && (c[m - 1] || k) <= f, n && k)
                        if (n = r.length)
                            for (; n--;) null !== r[n] && (h[g++] = r[n]);
                        else h[g++] = r;
                this.dataMin = q(h);
                this.dataMax = G(h)
            },
            translate: function() {
                this.processedXData || this.processData();
                this.generatePoints();
                var a = this.options,
                    b = a.stacking,
                    c = this.xAxis,
                    e = c.categories,
                    d = this.yAxis,
                    g = this.points,
                    n = g.length,
                    k = !!this.modifyValue,
                    r = a.pointPlacement,
                    m = "between" === r || l(r),
                    w = a.threshold,
                    q = a.startFromThreshold ? w : 0,
                    D, t, z,
                    u, A = Number.MAX_VALUE;
                "between" === r && (r = .5);
                l(r) && (r *= I(a.pointRange || c.pointRange));
                for (a = 0; a < n; a++) {
                    var J = g[a],
                        M = J.x,
                        C = J.y;
                    t = J.low;
                    var E = b && d.stacks[(this.negStacks && C < (q ? 0 : w) ? "-" : "") + this.stackKey],
                        G;
                    d.positiveValuesOnly && null !== C && 0 >= C && (J.isNull = !0);
                    J.plotX = D = f(Math.min(Math.max(-1E5, c.translate(M, 0, 0, 0, 1, r, "flags" === this.type)), 1E5));
                    b && this.visible && !J.isNull && E && E[M] && (u = this.getStackIndicator(u, M, this.index), G = E[M], C = G.points[u.key], t = C[0], C = C[1], t === q && u.key === E[M].base && (t = I(w, d.min)), d.positiveValuesOnly &&
                        0 >= t && (t = null), J.total = J.stackTotal = G.total, J.percentage = G.total && J.y / G.total * 100, J.stackY = C, G.setOffset(this.pointXOffset || 0, this.barW || 0));
                    J.yBottom = v(t) ? d.translate(t, 0, 1, 0, 1) : null;
                    k && (C = this.modifyValue(C, J));
                    J.plotY = t = "number" === typeof C && Infinity !== C ? Math.min(Math.max(-1E5, d.translate(C, 0, 1, 0, 1)), 1E5) : void 0;
                    J.isInside = void 0 !== t && 0 <= t && t <= d.len && 0 <= D && D <= c.len;
                    J.clientX = m ? f(c.translate(M, 0, 0, 0, 1, r)) : D;
                    J.negative = J.y < (w || 0);
                    J.category = e && void 0 !== e[J.x] ? e[J.x] : J.x;
                    J.isNull || (void 0 !== z && (A =
                        Math.min(A, Math.abs(D - z))), z = D);
                    J.zone = this.zones.length && J.getZone()
                }
                this.closestPointRangePx = A
            },
            getValidPoints: function(a, b) {
                var e = this.chart;
                return c(a || this.points || [], function(a) {
                    return b && !e.isInsidePlot(a.plotX, a.plotY, e.inverted) ? !1 : !a.isNull
                })
            },
            setClip: function(a) {
                var b = this.chart,
                    c = this.options,
                    e = b.renderer,
                    d = b.inverted,
                    g = this.clipBox,
                    p = g || b.clipBox,
                    f = this.sharedClipKey || ["_sharedClip", a && a.duration, a && a.easing, p.height, c.xAxis, c.yAxis].join(),
                    l = b[f],
                    n = b[f + "m"];
                l || (a && (p.width = 0, d && (p.x =
                    b.plotSizeX), b[f + "m"] = n = e.clipRect(d ? b.plotSizeX + 99 : -99, d ? -b.plotLeft : -b.plotTop, 99, d ? b.chartWidth : b.chartHeight)), b[f] = l = e.clipRect(p), l.count = {
                    length: 0
                });
                a && !l.count[this.index] && (l.count[this.index] = !0, l.count.length += 1);
                !1 !== c.clip && (this.group.clip(a || g ? l : b.clipRect), this.markerGroup.clip(n), this.sharedClipKey = f);
                a || (l.count[this.index] && (delete l.count[this.index], --l.count.length), 0 === l.count.length && f && b[f] && (g || (b[f] = b[f].destroy()), b[f + "m"] && (b[f + "m"] = b[f + "m"].destroy())))
            },
            animate: function(a) {
                var b =
                    this.chart,
                    c = C(this.options.animation),
                    e;
                a ? this.setClip(c) : (e = this.sharedClipKey, (a = b[e]) && a.animate({
                    width: b.plotSizeX,
                    x: 0
                }, c), b[e + "m"] && b[e + "m"].animate({
                    width: b.plotSizeX + 99,
                    x: 0
                }, c), this.animate = null)
            },
            afterAnimate: function() {
                this.setClip();
                n(this, "afterAnimate");
                this.finishedAnimating = !0
            },
            drawPoints: function() {
                var a = this.points,
                    b = this.chart,
                    c, e, d, g, f = this.options.marker,
                    n, k, r, m, w = this[this.specialGroup] || this.markerGroup,
                    q = I(f.enabled, this.xAxis.isRadial ? !0 : null, this.closestPointRangePx >= 2 * f.radius);
                if (!1 !== f.enabled || this._hasPointMarkers)
                    for (e = 0; e < a.length; e++) d = a[e], c = d.plotY, g = d.graphic, n = d.marker || {}, k = !!d.marker, r = q && void 0 === n.enabled || n.enabled, m = d.isInside, r && l(c) && null !== d.y ? (c = I(n.symbol, this.symbol), d.hasImage = 0 === c.indexOf("url"), r = this.markerAttribs(d, d.selected && "select"), g ? g[m ? "show" : "hide"](!0).animate(r) : m && (0 < r.width || d.hasImage) && (d.graphic = g = b.renderer.symbol(c, r.x, r.y, r.width, r.height, k ? n : f).add(w)), g && g.attr(this.pointAttribs(d, d.selected && "select")), g && g.addClass(d.getClassName(), !0)) : g && (d.graphic = g.destroy())
            },
            markerAttribs: function(a, b) {
                var c = this.options.marker,
                    e = a.marker || {},
                    d = I(e.radius, c.radius);
                b && (c = c.states[b], b = e.states && e.states[b], d = I(b && b.radius, c && c.radius, d + (c && c.radiusPlus || 0)));
                a.hasImage && (d = 0);
                a = {
                    x: Math.floor(a.plotX) - d,
                    y: a.plotY - d
                };
                d && (a.width = a.height = 2 * d);
                return a
            },
            pointAttribs: function(a, b) {
                var c = this.options.marker,
                    e = a && a.options,
                    d = e && e.marker || {},
                    g = this.color,
                    p = e && e.color,
                    f = a && a.color,
                    e = I(d.lineWidth, c.lineWidth);
                a = a && a.zone && a.zone.color;
                g = p || a ||
                    f || g;
                a = d.fillColor || c.fillColor || g;
                g = d.lineColor || c.lineColor || g;
                b && (c = c.states[b], b = d.states && d.states[b] || {}, e = I(b.lineWidth, c.lineWidth, e + I(b.lineWidthPlus, c.lineWidthPlus, 0)), a = b.fillColor || c.fillColor || a, g = b.lineColor || c.lineColor || g);
                return {
                    stroke: g,
                    "stroke-width": e,
                    fill: a
                }
            },
            destroy: function() {
                var a = this,
                    b = a.chart,
                    c = /AppleWebKit\/533/.test(M.navigator.userAgent),
                    e, h, g = a.data || [],
                    f, l;
                n(a, "destroy");
                r(a);
                u(a.axisTypes || [], function(b) {
                    (l = a[b]) && l.series && (d(l.series, a), l.isDirty = l.forceRedraw = !0)
                });
                a.legendItem && a.chart.legend.destroyItem(a);
                for (h = g.length; h--;)(f = g[h]) && f.destroy && f.destroy();
                a.points = null;
                clearTimeout(a.animationTimeout);
                A(a, function(a, b) {
                    a instanceof w && !a.survive && (e = c && "group" === b ? "hide" : "destroy", a[e]())
                });
                b.hoverSeries === a && (b.hoverSeries = null);
                d(b.series, a);
                b.orderSeries();
                A(a, function(b, c) {
                    delete a[c]
                })
            },
            getGraphPath: function(a, b, c) {
                var e = this,
                    d = e.options,
                    g = d.step,
                    f, p = [],
                    l = [],
                    n;
                a = a || e.points;
                (f = a.reversed) && a.reverse();
                (g = {
                    right: 1,
                    center: 2
                }[g] || g && 3) && f && (g = 4 -
                    g);
                !d.connectNulls || b || c || (a = this.getValidPoints(a));
                u(a, function(h, f) {
                    var k = h.plotX,
                        r = h.plotY,
                        m = a[f - 1];
                    (h.leftCliff || m && m.rightCliff) && !c && (n = !0);
                    h.isNull && !v(b) && 0 < f ? n = !d.connectNulls : h.isNull && !b ? n = !0 : (0 === f || n ? f = ["M", h.plotX, h.plotY] : e.getPointSpline ? f = e.getPointSpline(a, h, f) : g ? (f = 1 === g ? ["L", m.plotX, r] : 2 === g ? ["L", (m.plotX + k) / 2, m.plotY, "L", (m.plotX + k) / 2, r] : ["L", k, m.plotY], f.push("L", k, r)) : f = ["L", k, r], l.push(h.x), g && l.push(h.x), p.push.apply(p, f), n = !1)
                });
                p.xMap = l;
                return e.graphPath = p
            },
            drawGraph: function() {
                var a =
                    this,
                    b = this.options,
                    c = (this.gappedPath || this.getGraphPath).call(this),
                    e = [
                        ["graph", "highcharts-graph", b.lineColor || this.color, b.dashStyle]
                    ];
                u(this.zones, function(c, d) {
                    e.push(["zone-graph-" + d, "highcharts-graph highcharts-zone-graph-" + d + " " + (c.className || ""), c.color || a.color, c.dashStyle || b.dashStyle])
                });
                u(e, function(e, d) {
                    var h = e[0],
                        g = a[h];
                    g ? (g.endX = c.xMap, g.animate({
                        d: c
                    })) : c.length && (a[h] = a.chart.renderer.path(c).addClass(e[1]).attr({
                        zIndex: 1
                    }).add(a.group), g = {
                        stroke: e[2],
                        "stroke-width": b.lineWidth,
                        fill: a.fillGraph && a.color || "none"
                    }, e[3] ? g.dashstyle = e[3] : "square" !== b.linecap && (g["stroke-linecap"] = g["stroke-linejoin"] = "round"), g = a[h].attr(g).shadow(2 > d && b.shadow));
                    g && (g.startX = c.xMap, g.isArea = c.isArea)
                })
            },
            applyZones: function() {
                var a = this,
                    b = this.chart,
                    c = b.renderer,
                    e = this.zones,
                    d, g, f = this.clips || [],
                    l, n = this.graph,
                    k = this.area,
                    r = Math.max(b.chartWidth, b.chartHeight),
                    m = this[(this.zoneAxis || "y") + "Axis"],
                    w, q, D = b.inverted,
                    t, z, v, J, A = !1;
                e.length && (n || k) && m && void 0 !== m.min && (q = m.reversed, t = m.horiz, n && n.hide(),
                    k && k.hide(), w = m.getExtremes(), u(e, function(e, h) {
                        d = q ? t ? b.plotWidth : 0 : t ? 0 : m.toPixels(w.min);
                        d = Math.min(Math.max(I(g, d), 0), r);
                        g = Math.min(Math.max(Math.round(m.toPixels(I(e.value, w.max), !0)), 0), r);
                        A && (d = g = m.toPixels(w.max));
                        z = Math.abs(d - g);
                        v = Math.min(d, g);
                        J = Math.max(d, g);
                        m.isXAxis ? (l = {
                            x: D ? J : v,
                            y: 0,
                            width: z,
                            height: r
                        }, t || (l.x = b.plotHeight - l.x)) : (l = {
                            x: 0,
                            y: D ? J : v,
                            width: r,
                            height: z
                        }, t && (l.y = b.plotWidth - l.y));
                        D && c.isVML && (l = m.isXAxis ? {
                            x: 0,
                            y: q ? v : J,
                            height: l.width,
                            width: b.chartWidth
                        } : {
                            x: l.y - b.plotLeft - b.spacingBox.x,
                            y: 0,
                            width: l.height,
                            height: b.chartHeight
                        });
                        f[h] ? f[h].animate(l) : (f[h] = c.clipRect(l), n && a["zone-graph-" + h].clip(f[h]), k && a["zone-area-" + h].clip(f[h]));
                        A = e.value > w.max
                    }), this.clips = f)
            },
            invertGroups: function(a) {
                function b() {
                    u(["group", "markerGroup"], function(b) {
                        c[b] && (e.renderer.isVML && c[b].attr({
                            width: c.yAxis.len,
                            height: c.xAxis.len
                        }), c[b].width = c.yAxis.len, c[b].height = c.xAxis.len, c[b].invert(a))
                    })
                }
                var c = this,
                    e = c.chart,
                    d;
                c.xAxis && (d = E(e, "resize", b), E(c, "destroy", d), b(a), c.invertGroups = b)
            },
            plotGroup: function(a,
                b, c, e, d) {
                var h = this[a],
                    g = !h;
                g && (this[a] = h = this.chart.renderer.g().attr({
                    zIndex: e || .1
                }).add(d));
                h.addClass("highcharts-" + b + " highcharts-series-" + this.index + " highcharts-" + this.type + "-series " + (v(this.colorIndex) ? "highcharts-color-" + this.colorIndex + " " : "") + (this.options.className || "") + (h.hasClass("highcharts-tracker") ? " highcharts-tracker" : ""), !0);
                h.attr({
                    visibility: c
                })[g ? "attr" : "animate"](this.getPlotBox());
                return h
            },
            getPlotBox: function() {
                var a = this.chart,
                    b = this.xAxis,
                    c = this.yAxis;
                a.inverted && (b = c,
                    c = this.xAxis);
                return {
                    translateX: b ? b.left : a.plotLeft,
                    translateY: c ? c.top : a.plotTop,
                    scaleX: 1,
                    scaleY: 1
                }
            },
            render: function() {
                var a = this,
                    b = a.chart,
                    c, e = a.options,
                    d = !!a.animate && b.renderer.isSVG && C(e.animation).duration,
                    g = a.visible ? "inherit" : "hidden",
                    f = e.zIndex,
                    l = a.hasRendered,
                    n = b.seriesGroup,
                    k = b.inverted;
                c = a.plotGroup("group", "series", g, f, n);
                a.markerGroup = a.plotGroup("markerGroup", "markers", g, f, n);
                d && a.animate(!0);
                c.inverted = a.isCartesian ? k : !1;
                a.drawGraph && (a.drawGraph(), a.applyZones());
                a.drawDataLabels &&
                    a.drawDataLabels();
                a.visible && a.drawPoints();
                a.drawTracker && !1 !== a.options.enableMouseTracking && a.drawTracker();
                a.invertGroups(k);
                !1 === e.clip || a.sharedClipKey || l || c.clip(b.clipRect);
                d && a.animate();
                l || (a.animationTimeout = D(function() {
                    a.afterAnimate()
                }, d));
                a.isDirty = !1;
                a.hasRendered = !0
            },
            redraw: function() {
                var a = this.chart,
                    b = this.isDirty || this.isDirtyData,
                    c = this.group,
                    e = this.xAxis,
                    d = this.yAxis;
                c && (a.inverted && c.attr({
                    width: a.plotWidth,
                    height: a.plotHeight
                }), c.animate({
                    translateX: I(e && e.left, a.plotLeft),
                    translateY: I(d && d.top, a.plotTop)
                }));
                this.translate();
                this.render();
                b && delete this.kdTree
            },
            kdAxisArray: ["clientX", "plotY"],
            searchPoint: function(a, b) {
                var c = this.xAxis,
                    e = this.yAxis,
                    d = this.chart.inverted;
                return this.searchKDTree({
                    clientX: d ? c.len - a.chartY + c.pos : a.chartX - c.pos,
                    plotY: d ? e.len - a.chartX + e.pos : a.chartY - e.pos
                }, b)
            },
            buildKDTree: function() {
                function a(c, e, d) {
                    var h, g;
                    if (g = c && c.length) return h = b.kdAxisArray[e % d], c.sort(function(a, b) {
                        return a[h] - b[h]
                    }), g = Math.floor(g / 2), {
                        point: c[g],
                        left: a(c.slice(0,
                            g), e + 1, d),
                        right: a(c.slice(g + 1), e + 1, d)
                    }
                }
                this.buildingKdTree = !0;
                var b = this,
                    c = -1 < b.options.findNearestPointBy.indexOf("y") ? 2 : 1;
                delete b.kdTree;
                D(function() {
                    b.kdTree = a(b.getValidPoints(null, !b.directTouch), c, c);
                    b.buildingKdTree = !1
                }, b.options.kdNow ? 0 : 1)
            },
            searchKDTree: function(a, b) {
                function c(a, b, h, l) {
                    var n = b.point,
                        p = e.kdAxisArray[h % l],
                        k, r, m = n;
                    r = v(a[d]) && v(n[d]) ? Math.pow(a[d] - n[d], 2) : null;
                    k = v(a[g]) && v(n[g]) ? Math.pow(a[g] - n[g], 2) : null;
                    k = (r || 0) + (k || 0);
                    n.dist = v(k) ? Math.sqrt(k) : Number.MAX_VALUE;
                    n.distX = v(r) ?
                        Math.sqrt(r) : Number.MAX_VALUE;
                    p = a[p] - n[p];
                    k = 0 > p ? "left" : "right";
                    r = 0 > p ? "right" : "left";
                    b[k] && (k = c(a, b[k], h + 1, l), m = k[f] < m[f] ? k : n);
                    b[r] && Math.sqrt(p * p) < m[f] && (a = c(a, b[r], h + 1, l), m = a[f] < m[f] ? a : m);
                    return m
                }
                var e = this,
                    d = this.kdAxisArray[0],
                    g = this.kdAxisArray[1],
                    f = b ? "distX" : "dist";
                b = -1 < e.options.findNearestPointBy.indexOf("y") ? 2 : 1;
                this.kdTree || this.buildingKdTree || this.buildKDTree();
                if (this.kdTree) return c(a, this.kdTree, b, b)
            }
        })
    })(N);
    (function(a) {
        var E = a.Axis,
            C = a.Chart,
            G = a.correctFloat,
            q = a.defined,
            f = a.destroyObjectProperties,
            k = a.each,
            t = a.format,
            m = a.objectEach,
            v = a.pick,
            u = a.Series;
        a.StackItem = function(a, g, f, c, e) {
            var d = a.chart.inverted;
            this.axis = a;
            this.isNegative = f;
            this.options = g;
            this.x = c;
            this.total = null;
            this.points = {};
            this.stack = e;
            this.rightCliff = this.leftCliff = 0;
            this.alignOptions = {
                align: g.align || (d ? f ? "left" : "right" : "center"),
                verticalAlign: g.verticalAlign || (d ? "middle" : f ? "bottom" : "top"),
                y: v(g.y, d ? 4 : f ? 14 : -6),
                x: v(g.x, d ? f ? -6 : 6 : 0)
            };
            this.textAlign = g.textAlign || (d ? f ? "right" : "left" : "center")
        };
        a.StackItem.prototype = {
            destroy: function() {
                f(this,
                    this.axis)
            },
            render: function(a) {
                var d = this.options,
                    f = d.format,
                    f = f ? t(f, this) : d.formatter.call(this);
                this.label ? this.label.attr({
                    text: f,
                    visibility: "hidden"
                }) : this.label = this.axis.chart.renderer.text(f, null, null, d.useHTML).css(d.style).attr({
                    align: this.textAlign,
                    rotation: d.rotation,
                    visibility: "hidden"
                }).add(a)
            },
            setOffset: function(a, g) {
                var d = this.axis,
                    c = d.chart,
                    e = d.translate(d.usePercentage ? 100 : this.total, 0, 0, 0, 1),
                    d = d.translate(0),
                    d = Math.abs(e - d);
                a = c.xAxis[0].translate(this.x) + a;
                e = this.getStackBox(c, this,
                    a, e, g, d);
                if (g = this.label) g.align(this.alignOptions, null, e), e = g.alignAttr, g[!1 === this.options.crop || c.isInsidePlot(e.x, e.y) ? "show" : "hide"](!0)
            },
            getStackBox: function(a, g, f, c, e, l) {
                var b = g.axis.reversed,
                    d = a.inverted;
                a = a.plotHeight;
                g = g.isNegative && !b || !g.isNegative && b;
                return {
                    x: d ? g ? c : c - l : f,
                    y: d ? a - f - e : g ? a - c - l : a - c,
                    width: d ? l : e,
                    height: d ? e : l
                }
            }
        };
        C.prototype.getStacks = function() {
            var a = this;
            k(a.yAxis, function(a) {
                a.stacks && a.hasVisibleSeries && (a.oldStacks = a.stacks)
            });
            k(a.series, function(d) {
                !d.options.stacking || !0 !==
                    d.visible && !1 !== a.options.chart.ignoreHiddenSeries || (d.stackKey = d.type + v(d.options.stack, ""))
            })
        };
        E.prototype.buildStacks = function() {
            var a = this.series,
                g = v(this.options.reversedStacks, !0),
                f = a.length,
                c;
            if (!this.isXAxis) {
                this.usePercentage = !1;
                for (c = f; c--;) a[g ? c : f - c - 1].setStackedPoints();
                for (c = 0; c < f; c++) a[c].modifyStacks()
            }
        };
        E.prototype.renderStackTotals = function() {
            var a = this.chart,
                g = a.renderer,
                f = this.stacks,
                c = this.stackTotalGroup;
            c || (this.stackTotalGroup = c = g.g("stack-labels").attr({
                visibility: "visible",
                zIndex: 6
            }).add());
            c.translate(a.plotLeft, a.plotTop);
            m(f, function(a) {
                m(a, function(a) {
                    a.render(c)
                })
            })
        };
        E.prototype.resetStacks = function() {
            var a = this,
                g = a.stacks;
            a.isXAxis || m(g, function(d) {
                m(d, function(c, e) {
                    c.touched < a.stacksTouched ? (c.destroy(), delete d[e]) : (c.total = null, c.cum = null)
                })
            })
        };
        E.prototype.cleanStacks = function() {
            var a;
            this.isXAxis || (this.oldStacks && (a = this.stacks = this.oldStacks), m(a, function(a) {
                m(a, function(a) {
                    a.cum = a.total
                })
            }))
        };
        u.prototype.setStackedPoints = function() {
            if (this.options.stacking &&
                (!0 === this.visible || !1 === this.chart.options.chart.ignoreHiddenSeries)) {
                var d = this.processedXData,
                    g = this.processedYData,
                    f = [],
                    c = g.length,
                    e = this.options,
                    l = e.threshold,
                    b = e.startFromThreshold ? l : 0,
                    k = e.stack,
                    e = e.stacking,
                    m = this.stackKey,
                    t = "-" + m,
                    r = this.negStacks,
                    u = this.yAxis,
                    w = u.stacks,
                    D = u.oldStacks,
                    M, p, B, H, F, h, x;
                u.stacksTouched += 1;
                for (F = 0; F < c; F++) h = d[F], x = g[F], M = this.getStackIndicator(M, h, this.index), H = M.key, B = (p = r && x < (b ? 0 : l)) ? t : m, w[B] || (w[B] = {}), w[B][h] || (D[B] && D[B][h] ? (w[B][h] = D[B][h], w[B][h].total = null) :
                    w[B][h] = new a.StackItem(u, u.options.stackLabels, p, h, k)), B = w[B][h], null !== x && (B.points[H] = B.points[this.index] = [v(B.cum, b)], q(B.cum) || (B.base = H), B.touched = u.stacksTouched, 0 < M.index && !1 === this.singleStacks && (B.points[H][0] = B.points[this.index + "," + h + ",0"][0])), "percent" === e ? (p = p ? m : t, r && w[p] && w[p][h] ? (p = w[p][h], B.total = p.total = Math.max(p.total, B.total) + Math.abs(x) || 0) : B.total = G(B.total + (Math.abs(x) || 0))) : B.total = G(B.total + (x || 0)), B.cum = v(B.cum, b) + (x || 0), null !== x && (B.points[H].push(B.cum), f[F] = B.cum);
                "percent" === e && (u.usePercentage = !0);
                this.stackedYData = f;
                u.oldStacks = {}
            }
        };
        u.prototype.modifyStacks = function() {
            var a = this,
                g = a.stackKey,
                f = a.yAxis.stacks,
                c = a.processedXData,
                e, l = a.options.stacking;
            a[l + "Stacker"] && k([g, "-" + g], function(b) {
                for (var d = c.length, g, k; d--;)
                    if (g = c[d], e = a.getStackIndicator(e, g, a.index, b), k = (g = f[b] && f[b][g]) && g.points[e.key]) a[l + "Stacker"](k, g, d)
            })
        };
        u.prototype.percentStacker = function(a, g, f) {
            g = g.total ? 100 / g.total : 0;
            a[0] = G(a[0] * g);
            a[1] = G(a[1] * g);
            this.stackedYData[f] = a[1]
        };
        u.prototype.getStackIndicator =
            function(a, g, f, c) {
                !q(a) || a.x !== g || c && a.key !== c ? a = {
                    x: g,
                    index: 0,
                    key: c
                } : a.index++;
                a.key = [f, g, a.index].join();
                return a
            }
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.animate,
            G = a.Axis,
            q = a.createElement,
            f = a.css,
            k = a.defined,
            t = a.each,
            m = a.erase,
            v = a.extend,
            u = a.fireEvent,
            d = a.inArray,
            g = a.isNumber,
            n = a.isObject,
            c = a.isArray,
            e = a.merge,
            l = a.objectEach,
            b = a.pick,
            z = a.Point,
            A = a.Series,
            I = a.seriesTypes,
            r = a.setAnimation,
            J = a.splat;
        v(a.Chart.prototype, {
            addSeries: function(a, c, e) {
                var d, g = this;
                a && (c = b(c, !0), u(g, "addSeries", {
                        options: a
                    },
                    function() {
                        d = g.initSeries(a);
                        g.isDirtyLegend = !0;
                        g.linkSeries();
                        c && g.redraw(e)
                    }));
                return d
            },
            addAxis: function(a, c, d, g) {
                var f = c ? "xAxis" : "yAxis",
                    l = this.options;
                a = e(a, {
                    index: this[f].length,
                    isX: c
                });
                c = new G(this, a);
                l[f] = J(l[f] || {});
                l[f].push(a);
                b(d, !0) && this.redraw(g);
                return c
            },
            showLoading: function(a) {
                var b = this,
                    c = b.options,
                    e = b.loadingDiv,
                    d = c.loading,
                    g = function() {
                        e && f(e, {
                            left: b.plotLeft + "px",
                            top: b.plotTop + "px",
                            width: b.plotWidth + "px",
                            height: b.plotHeight + "px"
                        })
                    };
                e || (b.loadingDiv = e = q("div", {
                        className: "highcharts-loading highcharts-loading-hidden"
                    },
                    null, b.container), b.loadingSpan = q("span", {
                    className: "highcharts-loading-inner"
                }, null, e), E(b, "redraw", g));
                e.className = "highcharts-loading";
                b.loadingSpan.innerHTML = a || c.lang.loading;
                f(e, v(d.style, {
                    zIndex: 10
                }));
                f(b.loadingSpan, d.labelStyle);
                b.loadingShown || (f(e, {
                    opacity: 0,
                    display: ""
                }), C(e, {
                    opacity: d.style.opacity || .5
                }, {
                    duration: d.showDuration || 0
                }));
                b.loadingShown = !0;
                g()
            },
            hideLoading: function() {
                var a = this.options,
                    b = this.loadingDiv;
                b && (b.className = "highcharts-loading highcharts-loading-hidden", C(b, {
                    opacity: 0
                }, {
                    duration: a.loading.hideDuration || 100,
                    complete: function() {
                        f(b, {
                            display: "none"
                        })
                    }
                }));
                this.loadingShown = !1
            },
            propsRequireDirtyBox: "backgroundColor borderColor borderWidth margin marginTop marginRight marginBottom marginLeft spacing spacingTop spacingRight spacingBottom spacingLeft borderRadius plotBackgroundColor plotBackgroundImage plotBorderColor plotBorderWidth plotShadow shadow".split(" "),
            propsRequireUpdateSeries: "chart.inverted chart.polar chart.ignoreHiddenSeries chart.type colors plotOptions tooltip".split(" "),
            update: function(a, c, f) {
                var p = this,
                    n = {
                        credits: "addCredits",
                        title: "setTitle",
                        subtitle: "setSubtitle"
                    },
                    r = a.chart,
                    m, h, w = [];
                if (r) {
                    e(!0, p.options.chart, r);
                    "className" in r && p.setClassName(r.className);
                    if ("inverted" in r || "polar" in r) p.propFromSeries(), m = !0;
                    "alignTicks" in r && (m = !0);
                    l(r, function(a, b) {
                        -1 !== d("chart." + b, p.propsRequireUpdateSeries) && (h = !0); - 1 !== d(b, p.propsRequireDirtyBox) && (p.isDirtyBox = !0)
                    });
                    "style" in r && p.renderer.setStyle(r.style)
                }
                a.colors && (this.options.colors = a.colors);
                a.plotOptions && e(!0,
                    this.options.plotOptions, a.plotOptions);
                l(a, function(a, b) {
                    if (p[b] && "function" === typeof p[b].update) p[b].update(a, !1);
                    else if ("function" === typeof p[n[b]]) p[n[b]](a);
                    "chart" !== b && -1 !== d(b, p.propsRequireUpdateSeries) && (h = !0)
                });
                t("xAxis yAxis zAxis series colorAxis pane".split(" "), function(b) {
                    a[b] && (t(J(a[b]), function(a, c) {
                        (c = k(a.id) && p.get(a.id) || p[b][c]) && c.coll === b && (c.update(a, !1), f && (c.touched = !0));
                        if (!c && f)
                            if ("series" === b) p.addSeries(a, !1).touched = !0;
                            else if ("xAxis" === b || "yAxis" === b) p.addAxis(a,
                            "xAxis" === b, !1).touched = !0
                    }), f && t(p[b], function(a) {
                        a.touched ? delete a.touched : w.push(a)
                    }))
                });
                t(w, function(a) {
                    a.remove(!1)
                });
                m && t(p.axes, function(a) {
                    a.update({}, !1)
                });
                h && t(p.series, function(a) {
                    a.update({}, !1)
                });
                a.loading && e(!0, p.options.loading, a.loading);
                m = r && r.width;
                r = r && r.height;
                g(m) && m !== p.chartWidth || g(r) && r !== p.chartHeight ? p.setSize(m, r) : b(c, !0) && p.redraw()
            },
            setSubtitle: function(a) {
                this.setTitle(void 0, a)
            }
        });
        v(z.prototype, {
            update: function(a, c, e, d) {
                function g() {
                    f.applyOptions(a);
                    null === f.y && h &&
                        (f.graphic = h.destroy());
                    n(a, !0) && (h && h.element && a && a.marker && void 0 !== a.marker.symbol && (f.graphic = h.destroy()), a && a.dataLabels && f.dataLabel && (f.dataLabel = f.dataLabel.destroy()), f.connector && (f.connector = f.connector.destroy()));
                    p = f.index;
                    l.updateParallelArrays(f, p);
                    r.data[p] = n(r.data[p], !0) || n(a, !0) ? f.options : a;
                    l.isDirty = l.isDirtyData = !0;
                    !l.fixedBox && l.hasCartesianSeries && (k.isDirtyBox = !0);
                    "point" === r.legendType && (k.isDirtyLegend = !0);
                    c && k.redraw(e)
                }
                var f = this,
                    l = f.series,
                    h = f.graphic,
                    p, k = l.chart,
                    r = l.options;
                c = b(c, !0);
                !1 === d ? g() : f.firePointEvent("update", {
                    options: a
                }, g)
            },
            remove: function(a, b) {
                this.series.removePoint(d(this, this.series.data), a, b)
            }
        });
        v(A.prototype, {
            addPoint: function(a, c, e, d) {
                var g = this.options,
                    f = this.data,
                    l = this.chart,
                    h = this.xAxis,
                    h = h && h.hasNames && h.names,
                    p = g.data,
                    k, r, n = this.xData,
                    m, w;
                c = b(c, !0);
                k = {
                    series: this
                };
                this.pointClass.prototype.applyOptions.apply(k, [a]);
                w = k.x;
                m = n.length;
                if (this.requireSorting && w < n[m - 1])
                    for (r = !0; m && n[m - 1] > w;) m--;
                this.updateParallelArrays(k, "splice", m, 0, 0);
                this.updateParallelArrays(k,
                    m);
                h && k.name && (h[w] = k.name);
                p.splice(m, 0, a);
                r && (this.data.splice(m, 0, null), this.processData());
                "point" === g.legendType && this.generatePoints();
                e && (f[0] && f[0].remove ? f[0].remove(!1) : (f.shift(), this.updateParallelArrays(k, "shift"), p.shift()));
                this.isDirtyData = this.isDirty = !0;
                c && l.redraw(d)
            },
            removePoint: function(a, c, e) {
                var d = this,
                    g = d.data,
                    f = g[a],
                    l = d.points,
                    h = d.chart,
                    k = function() {
                        l && l.length === g.length && l.splice(a, 1);
                        g.splice(a, 1);
                        d.options.data.splice(a, 1);
                        d.updateParallelArrays(f || {
                                series: d
                            }, "splice",
                            a, 1);
                        f && f.destroy();
                        d.isDirty = !0;
                        d.isDirtyData = !0;
                        c && h.redraw()
                    };
                r(e, h);
                c = b(c, !0);
                f ? f.firePointEvent("remove", null, k) : k()
            },
            remove: function(a, c, e) {
                function d() {
                    g.destroy();
                    f.isDirtyLegend = f.isDirtyBox = !0;
                    f.linkSeries();
                    b(a, !0) && f.redraw(c)
                }
                var g = this,
                    f = g.chart;
                !1 !== e ? u(g, "remove", null, d) : d()
            },
            update: function(a, c) {
                var d = this,
                    g = d.chart,
                    f = d.userOptions,
                    l = d.oldType || d.type,
                    k = a.type || f.type || g.options.chart.type,
                    h = I[l].prototype,
                    r, n = ["group", "markerGroup", "dataLabelsGroup"],
                    m = ["navigatorSeries", "baseSeries"],
                    w = d.finishedAnimating && {
                        animation: !1
                    };
                if (Object.keys && "data" === Object.keys(a).toString()) return this.setData(a.data, c);
                if (k && k !== l || void 0 !== a.zIndex) n.length = 0;
                d.options.isInternal && (m.length = 0);
                m = n.concat(m);
                t(m, function(a) {
                    m[a] = d[a];
                    delete d[a]
                });
                a = e(f, w, {
                    index: d.index,
                    pointStart: d.xData[0]
                }, {
                    data: d.options.data
                }, a);
                d.remove(!1, null, !1);
                for (r in h) d[r] = void 0;
                v(d, I[k || l].prototype);
                t(m, function(a) {
                    d[a] = m[a]
                });
                d.init(g, a);
                d.oldType = l;
                g.linkSeries();
                b(c, !0) && g.redraw(!1)
            }
        });
        v(G.prototype, {
            update: function(a,
                c) {
                var d = this.chart;
                a = d.options[this.coll][this.options.index] = e(this.userOptions, a);
                this.destroy(!0);
                this.init(d, v(a, {
                    events: void 0
                }));
                d.isDirtyBox = !0;
                b(c, !0) && d.redraw()
            },
            remove: function(a) {
                for (var e = this.chart, d = this.coll, g = this.series, f = g.length; f--;) g[f] && g[f].remove(!1);
                m(e.axes, this);
                m(e[d], this);
                c(e.options[d]) ? e.options[d].splice(this.options.index, 1) : delete e.options[d];
                t(e[d], function(a, b) {
                    a.options.index = b
                });
                this.destroy();
                e.isDirtyBox = !0;
                b(a, !0) && e.redraw()
            },
            setTitle: function(a, b) {
                this.update({
                        title: a
                    },
                    b)
            },
            setCategories: function(a, b) {
                this.update({
                    categories: a
                }, b)
            }
        })
    })(N);
    (function(a) {
        var E = a.color,
            C = a.each,
            G = a.map,
            q = a.pick,
            f = a.Series,
            k = a.seriesType;
        k("area", "line", {
            softThreshold: !1,
            threshold: 0
        }, {
            singleStacks: !1,
            getStackPoints: function(f) {
                var k = [],
                    t = [],
                    u = this.xAxis,
                    d = this.yAxis,
                    g = d.stacks[this.stackKey],
                    n = {},
                    c = this.index,
                    e = d.series,
                    l = e.length,
                    b, z = q(d.options.reversedStacks, !0) ? 1 : -1,
                    A;
                f = f || this.points;
                if (this.options.stacking) {
                    for (A = 0; A < f.length; A++) n[f[A].x] = f[A];
                    a.objectEach(g, function(a, b) {
                        null !==
                            a.total && t.push(b)
                    });
                    t.sort(function(a, b) {
                        return a - b
                    });
                    b = G(e, function() {
                        return this.visible
                    });
                    C(t, function(a, e) {
                        var f = 0,
                            r, m;
                        if (n[a] && !n[a].isNull) k.push(n[a]), C([-1, 1], function(d) {
                            var f = 1 === d ? "rightNull" : "leftNull",
                                k = 0,
                                w = g[t[e + d]];
                            if (w)
                                for (A = c; 0 <= A && A < l;) r = w.points[A], r || (A === c ? n[a][f] = !0 : b[A] && (m = g[a].points[A]) && (k -= m[1] - m[0])), A += z;
                            n[a][1 === d ? "rightCliff" : "leftCliff"] = k
                        });
                        else {
                            for (A = c; 0 <= A && A < l;) {
                                if (r = g[a].points[A]) {
                                    f = r[1];
                                    break
                                }
                                A += z
                            }
                            f = d.translate(f, 0, 1, 0, 1);
                            k.push({
                                isNull: !0,
                                plotX: u.translate(a,
                                    0, 0, 0, 1),
                                x: a,
                                plotY: f,
                                yBottom: f
                            })
                        }
                    })
                }
                return k
            },
            getGraphPath: function(a) {
                var k = f.prototype.getGraphPath,
                    t = this.options,
                    u = t.stacking,
                    d = this.yAxis,
                    g, n, c = [],
                    e = [],
                    l = this.index,
                    b, z = d.stacks[this.stackKey],
                    A = t.threshold,
                    I = d.getThreshold(t.threshold),
                    r, t = t.connectNulls || "percent" === u,
                    J = function(g, f, k) {
                        var r = a[g];
                        g = u && z[r.x].points[l];
                        var n = r[k + "Null"] || 0;
                        k = r[k + "Cliff"] || 0;
                        var m, q, r = !0;
                        k || n ? (m = (n ? g[0] : g[1]) + k, q = g[0] + k, r = !!n) : !u && a[f] && a[f].isNull && (m = q = A);
                        void 0 !== m && (e.push({
                            plotX: b,
                            plotY: null === m ? I : d.getThreshold(m),
                            isNull: r,
                            isCliff: !0
                        }), c.push({
                            plotX: b,
                            plotY: null === q ? I : d.getThreshold(q),
                            doCurve: !1
                        }))
                    };
                a = a || this.points;
                u && (a = this.getStackPoints(a));
                for (g = 0; g < a.length; g++)
                    if (n = a[g].isNull, b = q(a[g].rectPlotX, a[g].plotX), r = q(a[g].yBottom, I), !n || t) t || J(g, g - 1, "left"), n && !u && t || (e.push(a[g]), c.push({
                        x: g,
                        plotX: b,
                        plotY: r
                    })), t || J(g, g + 1, "right");
                g = k.call(this, e, !0, !0);
                c.reversed = !0;
                n = k.call(this, c, !0, !0);
                n.length && (n[0] = "L");
                n = g.concat(n);
                k = k.call(this, e, !1, t);
                n.xMap = g.xMap;
                this.areaPath = n;
                return k
            },
            drawGraph: function() {
                this.areaPath = [];
                f.prototype.drawGraph.apply(this);
                var a = this,
                    k = this.areaPath,
                    v = this.options,
                    u = [
                        ["area", "highcharts-area", this.color, v.fillColor]
                    ];
                C(this.zones, function(d, g) {
                    u.push(["zone-area-" + g, "highcharts-area highcharts-zone-area-" + g + " " + d.className, d.color || a.color, d.fillColor || v.fillColor])
                });
                C(u, function(d) {
                    var g = d[0],
                        f = a[g];
                    f ? (f.endX = k.xMap, f.animate({
                        d: k
                    })) : (f = a[g] = a.chart.renderer.path(k).addClass(d[1]).attr({
                        fill: q(d[3], E(d[2]).setOpacity(q(v.fillOpacity, .75)).get()),
                        zIndex: 0
                    }).add(a.group), f.isArea = !0);
                    f.startX = k.xMap;
                    f.shiftUnit = v.step ? 2 : 1
                })
            },
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle
        })
    })(N);
    (function(a) {
        var E = a.pick;
        a = a.seriesType;
        a("spline", "line", {}, {
            getPointSpline: function(a, G, q) {
                var f = G.plotX,
                    k = G.plotY,
                    t = a[q - 1];
                q = a[q + 1];
                var m, v, u, d;
                if (t && !t.isNull && !1 !== t.doCurve && !G.isCliff && q && !q.isNull && !1 !== q.doCurve && !G.isCliff) {
                    a = t.plotY;
                    u = q.plotX;
                    q = q.plotY;
                    var g = 0;
                    m = (1.5 * f + t.plotX) / 2.5;
                    v = (1.5 * k + a) / 2.5;
                    u = (1.5 * f + u) / 2.5;
                    d = (1.5 * k + q) / 2.5;
                    u !== m && (g = (d - v) * (u - f) / (u - m) + k - d);
                    v += g;
                    d += g;
                    v > a && v > k ? (v =
                        Math.max(a, k), d = 2 * k - v) : v < a && v < k && (v = Math.min(a, k), d = 2 * k - v);
                    d > q && d > k ? (d = Math.max(q, k), v = 2 * k - d) : d < q && d < k && (d = Math.min(q, k), v = 2 * k - d);
                    G.rightContX = u;
                    G.rightContY = d
                }
                G = ["C", E(t.rightContX, t.plotX), E(t.rightContY, t.plotY), E(m, f), E(v, k), f, k];
                t.rightContX = t.rightContY = null;
                return G
            }
        })
    })(N);
    (function(a) {
        var E = a.seriesTypes.area.prototype,
            C = a.seriesType;
        C("areaspline", "spline", a.defaultPlotOptions.area, {
            getStackPoints: E.getStackPoints,
            getGraphPath: E.getGraphPath,
            drawGraph: E.drawGraph,
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle
        })
    })(N);
    (function(a) {
        var E = a.animObject,
            C = a.color,
            G = a.each,
            q = a.extend,
            f = a.isNumber,
            k = a.merge,
            t = a.pick,
            m = a.Series,
            v = a.seriesType,
            u = a.svg;
        v("column", "line", {
            borderRadius: 0,
            crisp: !0,
            groupPadding: .2,
            marker: null,
            pointPadding: .1,
            minPointLength: 0,
            cropThreshold: 50,
            pointRange: null,
            states: {
                hover: {
                    halo: !1,
                    brightness: .1,
                    shadow: !1
                },
                select: {
                    color: "#cccccc",
                    borderColor: "#000000",
                    shadow: !1
                }
            },
            dataLabels: {
                align: null,
                verticalAlign: null,
                y: null
            },
            softThreshold: !1,
            startFromThreshold: !0,
            stickyTracking: !1,
            tooltip: {
                distance: 6
            },
            threshold: 0,
            borderColor: "#ffffff"
        }, {
            cropShoulder: 0,
            directTouch: !0,
            trackerGroups: ["group", "dataLabelsGroup"],
            negStacks: !0,
            init: function() {
                m.prototype.init.apply(this, arguments);
                var a = this,
                    g = a.chart;
                g.hasRendered && G(g.series, function(d) {
                    d.type === a.type && (d.isDirty = !0)
                })
            },
            getColumnMetrics: function() {
                var a = this,
                    g = a.options,
                    f = a.xAxis,
                    c = a.yAxis,
                    e = f.reversed,
                    l, b = {},
                    k = 0;
                !1 === g.grouping ? k = 1 : G(a.chart.series, function(e) {
                    var d = e.options,
                        g = e.yAxis,
                        f;
                    e.type !== a.type || !e.visible && a.chart.options.chart.ignoreHiddenSeries ||
                        c.len !== g.len || c.pos !== g.pos || (d.stacking ? (l = e.stackKey, void 0 === b[l] && (b[l] = k++), f = b[l]) : !1 !== d.grouping && (f = k++), e.columnIndex = f)
                });
                var m = Math.min(Math.abs(f.transA) * (f.ordinalSlope || g.pointRange || f.closestPointRange || f.tickInterval || 1), f.len),
                    q = m * g.groupPadding,
                    r = (m - 2 * q) / (k || 1),
                    g = Math.min(g.maxPointWidth || f.len, t(g.pointWidth, r * (1 - 2 * g.pointPadding)));
                a.columnMetrics = {
                    width: g,
                    offset: (r - g) / 2 + (q + ((a.columnIndex || 0) + (e ? 1 : 0)) * r - m / 2) * (e ? -1 : 1)
                };
                return a.columnMetrics
            },
            crispCol: function(a, g, f, c) {
                var e =
                    this.chart,
                    d = this.borderWidth,
                    b = -(d % 2 ? .5 : 0),
                    d = d % 2 ? .5 : 1;
                e.inverted && e.renderer.isVML && (d += 1);
                this.options.crisp && (f = Math.round(a + f) + b, a = Math.round(a) + b, f -= a);
                c = Math.round(g + c) + d;
                b = .5 >= Math.abs(g) && .5 < c;
                g = Math.round(g) + d;
                c -= g;
                b && c && (--g, c += 1);
                return {
                    x: a,
                    y: g,
                    width: f,
                    height: c
                }
            },
            translate: function() {
                var a = this,
                    g = a.chart,
                    f = a.options,
                    c = a.dense = 2 > a.closestPointRange * a.xAxis.transA,
                    c = a.borderWidth = t(f.borderWidth, c ? 0 : 1),
                    e = a.yAxis,
                    l = a.translatedThreshold = e.getThreshold(f.threshold),
                    b = t(f.minPointLength, 5),
                    k = a.getColumnMetrics(),
                    q = k.width,
                    u = a.barW = Math.max(q, 1 + 2 * c),
                    r = a.pointXOffset = k.offset;
                g.inverted && (l -= .5);
                f.pointPadding && (u = Math.ceil(u));
                m.prototype.translate.apply(a);
                G(a.points, function(c) {
                    var d = t(c.yBottom, l),
                        f = 999 + Math.abs(d),
                        f = Math.min(Math.max(-f, c.plotY), e.len + f),
                        k = c.plotX + r,
                        p = u,
                        n = Math.min(f, d),
                        m, z = Math.max(f, d) - n;
                    b && Math.abs(z) < b && (z = b, m = !e.reversed && !c.negative || e.reversed && c.negative, 0 === c.y && 0 >= a.dataMax && (m = !m), n = Math.abs(n - l) > b ? d - b : l - (m ? b : 0));
                    c.barX = k;
                    c.pointWidth = q;
                    c.tooltipPos = g.inverted ? [e.len + e.pos - g.plotLeft - f, a.xAxis.len - k - p / 2, z] : [k + p / 2, f + e.pos - g.plotTop, z];
                    c.shapeType = "rect";
                    c.shapeArgs = a.crispCol.apply(a, c.isNull ? [k, l, p, 0] : [k, n, p, z])
                })
            },
            getSymbol: a.noop,
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle,
            drawGraph: function() {
                this.group[this.dense ? "addClass" : "removeClass"]("highcharts-dense-data")
            },
            pointAttribs: function(a, g) {
                var d = this.options,
                    c, e = this.pointAttrToOptions || {};
                c = e.stroke || "borderColor";
                var f = e["stroke-width"] || "borderWidth",
                    b = a && a.color || this.color,
                    m = a && a[c] || d[c] ||
                    this.color || b,
                    q = a && a[f] || d[f] || this[f] || 0,
                    e = d.dashStyle;
                a && this.zones.length && (b = a.getZone(), b = a.options.color || b && b.color || this.color);
                g && (a = k(d.states[g], a.options.states && a.options.states[g] || {}), g = a.brightness, b = a.color || void 0 !== g && C(b).brighten(a.brightness).get() || b, m = a[c] || m, q = a[f] || q, e = a.dashStyle || e);
                c = {
                    fill: b,
                    stroke: m,
                    "stroke-width": q
                };
                e && (c.dashstyle = e);
                return c
            },
            drawPoints: function() {
                var a = this,
                    g = this.chart,
                    m = a.options,
                    c = g.renderer,
                    e = m.animationLimit || 250,
                    l;
                G(a.points, function(b) {
                    var d =
                        b.graphic;
                    if (f(b.plotY) && null !== b.y) {
                        l = b.shapeArgs;
                        if (d) d[g.pointCount < e ? "animate" : "attr"](k(l));
                        else b.graphic = d = c[b.shapeType](l).add(b.group || a.group);
                        m.borderRadius && d.attr({
                            r: m.borderRadius
                        });
                        d.attr(a.pointAttribs(b, b.selected && "select")).shadow(m.shadow, null, m.stacking && !m.borderRadius);
                        d.addClass(b.getClassName(), !0)
                    } else d && (b.graphic = d.destroy())
                })
            },
            animate: function(a) {
                var d = this,
                    f = this.yAxis,
                    c = d.options,
                    e = this.chart.inverted,
                    l = {},
                    b = e ? "translateX" : "translateY",
                    k;
                u && (a ? (l.scaleY = .001, a = Math.min(f.pos +
                    f.len, Math.max(f.pos, f.toPixels(c.threshold))), e ? l.translateX = a - f.len : l.translateY = a, d.group.attr(l)) : (k = d.group.attr(b), d.group.animate({
                    scaleY: 1
                }, q(E(d.options.animation), {
                    step: function(a, c) {
                        l[b] = k + c.pos * (f.pos - k);
                        d.group.attr(l)
                    }
                })), d.animate = null))
            },
            remove: function() {
                var a = this,
                    f = a.chart;
                f.hasRendered && G(f.series, function(d) {
                    d.type === a.type && (d.isDirty = !0)
                });
                m.prototype.remove.apply(a, arguments)
            }
        })
    })(N);
    (function(a) {
        a = a.seriesType;
        a("bar", "column", null, {
            inverted: !0
        })
    })(N);
    (function(a) {
        var E = a.Series;
        a = a.seriesType;
        a("scatter", "line", {
            lineWidth: 0,
            findNearestPointBy: "xy",
            marker: {
                enabled: !0
            },
            tooltip: {
                headerFormat: '\x3cspan style\x3d"color:{point.color}"\x3e\u25cf\x3c/span\x3e \x3cspan style\x3d"font-size: 0.85em"\x3e {series.name}\x3c/span\x3e\x3cbr/\x3e',
                pointFormat: "x: \x3cb\x3e{point.x}\x3c/b\x3e\x3cbr/\x3ey: \x3cb\x3e{point.y}\x3c/b\x3e\x3cbr/\x3e"
            }
        }, {
            sorted: !1,
            requireSorting: !1,
            noSharedTooltip: !0,
            trackerGroups: ["group", "markerGroup", "dataLabelsGroup"],
            takeOrdinalPosition: !1,
            drawGraph: function() {
                this.options.lineWidth &&
                    E.prototype.drawGraph.call(this)
            }
        })
    })(N);
    (function(a) {
        var E = a.deg2rad,
            C = a.isNumber,
            G = a.pick,
            q = a.relativeLength;
        a.CenteredSeriesMixin = {
            getCenter: function() {
                var a = this.options,
                    k = this.chart,
                    t = 2 * (a.slicedOffset || 0),
                    m = k.plotWidth - 2 * t,
                    k = k.plotHeight - 2 * t,
                    v = a.center,
                    v = [G(v[0], "50%"), G(v[1], "50%"), a.size || "100%", a.innerSize || 0],
                    u = Math.min(m, k),
                    d, g;
                for (d = 0; 4 > d; ++d) g = v[d], a = 2 > d || 2 === d && /%$/.test(g), v[d] = q(g, [m, k, u, v[2]][d]) + (a ? t : 0);
                v[3] > v[2] && (v[3] = v[2]);
                return v
            },
            getStartAndEndRadians: function(a, k) {
                a = C(a) ?
                    a : 0;
                k = C(k) && k > a && 360 > k - a ? k : a + 360;
                return {
                    start: E * (a + -90),
                    end: E * (k + -90)
                }
            }
        }
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.CenteredSeriesMixin,
            G = a.defined,
            q = a.each,
            f = a.extend,
            k = C.getStartAndEndRadians,
            t = a.inArray,
            m = a.noop,
            v = a.pick,
            u = a.Point,
            d = a.Series,
            g = a.seriesType,
            n = a.setAnimation;
        g("pie", "line", {
            center: [null, null],
            clip: !1,
            colorByPoint: !0,
            dataLabels: {
                distance: 30,
                enabled: !0,
                formatter: function() {
                    return this.point.isNull ? void 0 : this.point.name
                },
                x: 0
            },
            ignoreHiddenPoint: !0,
            legendType: "point",
            marker: null,
            size: null,
            showInLegend: !1,
            slicedOffset: 10,
            stickyTracking: !1,
            tooltip: {
                followPointer: !0
            },
            borderColor: "#ffffff",
            borderWidth: 1,
            states: {
                hover: {
                    brightness: .1,
                    shadow: !1
                }
            }
        }, {
            isCartesian: !1,
            requireSorting: !1,
            directTouch: !0,
            noSharedTooltip: !0,
            trackerGroups: ["group", "dataLabelsGroup"],
            axisTypes: [],
            pointAttribs: a.seriesTypes.column.prototype.pointAttribs,
            animate: function(a) {
                var c = this,
                    d = c.points,
                    b = c.startAngleRad;
                a || (q(d, function(a) {
                    var e = a.graphic,
                        d = a.shapeArgs;
                    e && (e.attr({
                        r: a.startR || c.center[3] / 2,
                        start: b,
                        end: b
                    }), e.animate({
                        r: d.r,
                        start: d.start,
                        end: d.end
                    }, c.options.animation))
                }), c.animate = null)
            },
            updateTotals: function() {
                var a, e = 0,
                    d = this.points,
                    b = d.length,
                    f, g = this.options.ignoreHiddenPoint;
                for (a = 0; a < b; a++) f = d[a], e += g && !f.visible ? 0 : f.isNull ? 0 : f.y;
                this.total = e;
                for (a = 0; a < b; a++) f = d[a], f.percentage = 0 < e && (f.visible || !g) ? f.y / e * 100 : 0, f.total = e
            },
            generatePoints: function() {
                d.prototype.generatePoints.call(this);
                this.updateTotals()
            },
            translate: function(a) {
                this.generatePoints();
                var c = 0,
                    d = this.options,
                    b = d.slicedOffset,
                    f = b + (d.borderWidth || 0),
                    g, m, r, n = k(d.startAngle, d.endAngle),
                    q = this.startAngleRad = n.start,
                    n = (this.endAngleRad = n.end) - q,
                    t = this.points,
                    u, p = d.dataLabels.distance,
                    d = d.ignoreHiddenPoint,
                    B, H = t.length,
                    F;
                a || (this.center = a = this.getCenter());
                this.getX = function(b, c, e) {
                    r = Math.asin(Math.min((b - a[1]) / (a[2] / 2 + e.labelDistance), 1));
                    return a[0] + (c ? -1 : 1) * Math.cos(r) * (a[2] / 2 + e.labelDistance)
                };
                for (B = 0; B < H; B++) {
                    F = t[B];
                    F.labelDistance = v(F.options.dataLabels && F.options.dataLabels.distance, p);
                    this.maxLabelDistance = Math.max(this.maxLabelDistance ||
                        0, F.labelDistance);
                    g = q + c * n;
                    if (!d || F.visible) c += F.percentage / 100;
                    m = q + c * n;
                    F.shapeType = "arc";
                    F.shapeArgs = {
                        x: a[0],
                        y: a[1],
                        r: a[2] / 2,
                        innerR: a[3] / 2,
                        start: Math.round(1E3 * g) / 1E3,
                        end: Math.round(1E3 * m) / 1E3
                    };
                    r = (m + g) / 2;
                    r > 1.5 * Math.PI ? r -= 2 * Math.PI : r < -Math.PI / 2 && (r += 2 * Math.PI);
                    F.slicedTranslation = {
                        translateX: Math.round(Math.cos(r) * b),
                        translateY: Math.round(Math.sin(r) * b)
                    };
                    m = Math.cos(r) * a[2] / 2;
                    u = Math.sin(r) * a[2] / 2;
                    F.tooltipPos = [a[0] + .7 * m, a[1] + .7 * u];
                    F.half = r < -Math.PI / 2 || r > Math.PI / 2 ? 1 : 0;
                    F.angle = r;
                    g = Math.min(f, F.labelDistance /
                        5);
                    F.labelPos = [a[0] + m + Math.cos(r) * F.labelDistance, a[1] + u + Math.sin(r) * F.labelDistance, a[0] + m + Math.cos(r) * g, a[1] + u + Math.sin(r) * g, a[0] + m, a[1] + u, 0 > F.labelDistance ? "center" : F.half ? "right" : "left", r]
                }
            },
            drawGraph: null,
            drawPoints: function() {
                var a = this,
                    e = a.chart.renderer,
                    d, b, g, k, m = a.options.shadow;
                m && !a.shadowGroup && (a.shadowGroup = e.g("shadow").add(a.group));
                q(a.points, function(c) {
                    b = c.graphic;
                    if (c.isNull) b && (c.graphic = b.destroy());
                    else {
                        k = c.shapeArgs;
                        d = c.getTranslate();
                        var l = c.shadowGroup;
                        m && !l && (l = c.shadowGroup =
                            e.g("shadow").add(a.shadowGroup));
                        l && l.attr(d);
                        g = a.pointAttribs(c, c.selected && "select");
                        b ? b.setRadialReference(a.center).attr(g).animate(f(k, d)) : (c.graphic = b = e[c.shapeType](k).setRadialReference(a.center).attr(d).add(a.group), c.visible || b.attr({
                            visibility: "hidden"
                        }), b.attr(g).attr({
                            "stroke-linejoin": "round"
                        }).shadow(m, l));
                        b.addClass(c.getClassName())
                    }
                })
            },
            searchPoint: m,
            sortByAngle: function(a, e) {
                a.sort(function(a, b) {
                    return void 0 !== a.angle && (b.angle - a.angle) * e
                })
            },
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle,
            getCenter: C.getCenter,
            getSymbol: m
        }, {
            init: function() {
                u.prototype.init.apply(this, arguments);
                var a = this,
                    e;
                a.name = v(a.name, "Slice");
                e = function(c) {
                    a.slice("select" === c.type)
                };
                E(a, "select", e);
                E(a, "unselect", e);
                return a
            },
            isValid: function() {
                return a.isNumber(this.y, !0) && 0 <= this.y
            },
            setVisible: function(a, e) {
                var c = this,
                    b = c.series,
                    d = b.chart,
                    f = b.options.ignoreHiddenPoint;
                e = v(e, f);
                a !== c.visible && (c.visible = c.options.visible = a = void 0 === a ? !c.visible : a, b.options.data[t(c, b.data)] = c.options, q(["graphic", "dataLabel",
                    "connector", "shadowGroup"
                ], function(b) {
                    if (c[b]) c[b][a ? "show" : "hide"](!0)
                }), c.legendItem && d.legend.colorizeItem(c, a), a || "hover" !== c.state || c.setState(""), f && (b.isDirty = !0), e && d.redraw())
            },
            slice: function(a, e, d) {
                var b = this.series;
                n(d, b.chart);
                v(e, !0);
                this.sliced = this.options.sliced = G(a) ? a : !this.sliced;
                b.options.data[t(this, b.data)] = this.options;
                this.graphic.animate(this.getTranslate());
                this.shadowGroup && this.shadowGroup.animate(this.getTranslate())
            },
            getTranslate: function() {
                return this.sliced ? this.slicedTranslation : {
                    translateX: 0,
                    translateY: 0
                }
            },
            haloPath: function(a) {
                var c = this.shapeArgs;
                return this.sliced || !this.visible ? [] : this.series.chart.renderer.symbols.arc(c.x, c.y, c.r + a, c.r + a, {
                    innerR: this.shapeArgs.r,
                    start: c.start,
                    end: c.end
                })
            }
        })
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.arrayMax,
            G = a.defined,
            q = a.each,
            f = a.extend,
            k = a.format,
            t = a.map,
            m = a.merge,
            v = a.noop,
            u = a.pick,
            d = a.relativeLength,
            g = a.Series,
            n = a.seriesTypes,
            c = a.stableSort;
        a.distribute = function(a, d) {
            function b(a, b) {
                return a.target - b.target
            }
            var e, f = !0,
                g = a,
                k = [],
                l;
            l =
                0;
            for (e = a.length; e--;) l += a[e].size;
            if (l > d) {
                c(a, function(a, b) {
                    return (b.rank || 0) - (a.rank || 0)
                });
                for (l = e = 0; l <= d;) l += a[e].size, e++;
                k = a.splice(e - 1, a.length)
            }
            c(a, b);
            for (a = t(a, function(a) {
                    return {
                        size: a.size,
                        targets: [a.target]
                    }
                }); f;) {
                for (e = a.length; e--;) f = a[e], l = (Math.min.apply(0, f.targets) + Math.max.apply(0, f.targets)) / 2, f.pos = Math.min(Math.max(0, l - f.size / 2), d - f.size);
                e = a.length;
                for (f = !1; e--;) 0 < e && a[e - 1].pos + a[e - 1].size > a[e].pos && (a[e - 1].size += a[e].size, a[e - 1].targets = a[e - 1].targets.concat(a[e].targets), a[e -
                    1].pos + a[e - 1].size > d && (a[e - 1].pos = d - a[e - 1].size), a.splice(e, 1), f = !0)
            }
            e = 0;
            q(a, function(a) {
                var b = 0;
                q(a.targets, function() {
                    g[e].pos = a.pos + b;
                    b += g[e].size;
                    e++
                })
            });
            g.push.apply(g, k);
            c(g, b)
        };
        g.prototype.drawDataLabels = function() {
            var c = this,
                d = c.options,
                b = d.dataLabels,
                f = c.points,
                g, n, r = c.hasRendered || 0,
                t, w, v = u(b.defer, !!d.animation),
                C = c.chart.renderer;
            if (b.enabled || c._hasPointLabels) c.dlProcessOptions && c.dlProcessOptions(b), w = c.plotGroup("dataLabelsGroup", "data-labels", v && !r ? "hidden" : "visible", b.zIndex || 6),
                v && (w.attr({
                    opacity: +r
                }), r || E(c, "afterAnimate", function() {
                    c.visible && w.show(!0);
                    w[d.animation ? "animate" : "attr"]({
                        opacity: 1
                    }, {
                        duration: 200
                    })
                })), n = b, q(f, function(e) {
                    var f, l = e.dataLabel,
                        r, h, p = e.connector,
                        q = !l,
                        v;
                    g = e.dlOptions || e.options && e.options.dataLabels;
                    if (f = u(g && g.enabled, n.enabled) && !e.isNull) b = m(n, g), r = e.getLabelConfig(), v = b[e.formatPrefix + "Format"] || b.format, t = G(v) ? k(v, r) : (b[e.formatPrefix + "Formatter"] || b.formatter).call(r, b), v = b.style, r = b.rotation, v.color = u(b.color, v.color, c.color, "#000000"),
                        "contrast" === v.color && (e.contrastColor = C.getContrast(e.color || c.color), v.color = b.inside || 0 > u(e.labelDistance, b.distance) || d.stacking ? e.contrastColor : "#000000"), d.cursor && (v.cursor = d.cursor), h = {
                            fill: b.backgroundColor,
                            stroke: b.borderColor,
                            "stroke-width": b.borderWidth,
                            r: b.borderRadius || 0,
                            rotation: r,
                            padding: b.padding,
                            zIndex: 1
                        }, a.objectEach(h, function(a, b) {
                            void 0 === a && delete h[b]
                        });
                    !l || f && G(t) ? f && G(t) && (l ? h.text = t : (l = e.dataLabel = C[r ? "text" : "label"](t, 0, -9999, b.shape, null, null, b.useHTML, null, "data-label"),
                        l.addClass("highcharts-data-label-color-" + e.colorIndex + " " + (b.className || "") + (b.useHTML ? "highcharts-tracker" : ""))), l.attr(h), l.css(v).shadow(b.shadow), l.added || l.add(w), c.alignDataLabel(e, l, b, null, q)) : (e.dataLabel = l = l.destroy(), p && (e.connector = p.destroy()))
                })
        };
        g.prototype.alignDataLabel = function(a, c, b, d, g) {
            var e = this.chart,
                k = e.inverted,
                l = u(a.plotX, -9999),
                m = u(a.plotY, -9999),
                n = c.getBBox(),
                q, p = b.rotation,
                t = b.align,
                v = this.visible && (a.series.forceDL || e.isInsidePlot(l, Math.round(m), k) || d && e.isInsidePlot(l,
                    k ? d.x + 1 : d.y + d.height - 1, k)),
                z = "justify" === u(b.overflow, "justify");
            if (v && (q = b.style.fontSize, q = e.renderer.fontMetrics(q, c).b, d = f({
                    x: k ? this.yAxis.len - m : l,
                    y: Math.round(k ? this.xAxis.len - l : m),
                    width: 0,
                    height: 0
                }, d), f(b, {
                    width: n.width,
                    height: n.height
                }), p ? (z = !1, l = e.renderer.rotCorr(q, p), l = {
                    x: d.x + b.x + d.width / 2 + l.x,
                    y: d.y + b.y + {
                        top: 0,
                        middle: .5,
                        bottom: 1
                    }[b.verticalAlign] * d.height
                }, c[g ? "attr" : "animate"](l).attr({
                    align: t
                }), m = (p + 720) % 360, m = 180 < m && 360 > m, "left" === t ? l.y -= m ? n.height : 0 : "center" === t ? (l.x -= n.width / 2, l.y -=
                    n.height / 2) : "right" === t && (l.x -= n.width, l.y -= m ? 0 : n.height)) : (c.align(b, null, d), l = c.alignAttr), z ? a.isLabelJustified = this.justifyDataLabel(c, b, l, n, d, g) : u(b.crop, !0) && (v = e.isInsidePlot(l.x, l.y) && e.isInsidePlot(l.x + n.width, l.y + n.height)), b.shape && !p)) c[g ? "attr" : "animate"]({
                anchorX: k ? e.plotWidth - a.plotY : a.plotX,
                anchorY: k ? e.plotHeight - a.plotX : a.plotY
            });
            v || (c.attr({
                y: -9999
            }), c.placed = !1)
        };
        g.prototype.justifyDataLabel = function(a, c, b, d, f, g) {
            var e = this.chart,
                k = c.align,
                l = c.verticalAlign,
                m, n, p = a.box ? 0 : a.padding ||
                0;
            m = b.x + p;
            0 > m && ("right" === k ? c.align = "left" : c.x = -m, n = !0);
            m = b.x + d.width - p;
            m > e.plotWidth && ("left" === k ? c.align = "right" : c.x = e.plotWidth - m, n = !0);
            m = b.y + p;
            0 > m && ("bottom" === l ? c.verticalAlign = "top" : c.y = -m, n = !0);
            m = b.y + d.height - p;
            m > e.plotHeight && ("top" === l ? c.verticalAlign = "bottom" : c.y = e.plotHeight - m, n = !0);
            n && (a.placed = !g, a.align(c, null, f));
            return n
        };
        n.pie && (n.pie.prototype.drawDataLabels = function() {
            var c = this,
                d = c.data,
                b, f = c.chart,
                k = c.options.dataLabels,
                m = u(k.connectorPadding, 10),
                r = u(k.connectorWidth, 1),
                n = f.plotWidth,
                w = f.plotHeight,
                t, v = c.center,
                p = v[2] / 2,
                B = v[1],
                E, F, h, x, N = [
                    [],
                    []
                ],
                K, P, L, Q, y = [0, 0, 0, 0];
            c.visible && (k.enabled || c._hasPointLabels) && (q(d, function(a) {
                a.dataLabel && a.visible && a.dataLabel.shortened && (a.dataLabel.attr({
                    width: "auto"
                }).css({
                    width: "auto",
                    textOverflow: "clip"
                }), a.dataLabel.shortened = !1)
            }), g.prototype.drawDataLabels.apply(c), q(d, function(a) {
                a.dataLabel && a.visible && (N[a.half].push(a), a.dataLabel._pos = null)
            }), q(N, function(e, d) {
                var g, l, r = e.length,
                    t = [],
                    D;
                if (r)
                    for (c.sortByAngle(e, d - .5), 0 < c.maxLabelDistance &&
                        (g = Math.max(0, B - p - c.maxLabelDistance), l = Math.min(B + p + c.maxLabelDistance, f.plotHeight), q(e, function(a) {
                            0 < a.labelDistance && a.dataLabel && (a.top = Math.max(0, B - p - a.labelDistance), a.bottom = Math.min(B + p + a.labelDistance, f.plotHeight), D = a.dataLabel.getBBox().height || 21, a.positionsIndex = t.push({
                                target: a.labelPos[1] - a.top + D / 2,
                                size: D,
                                rank: a.y
                            }) - 1)
                        }), a.distribute(t, l + D - g)), Q = 0; Q < r; Q++) b = e[Q], l = b.positionsIndex, h = b.labelPos, E = b.dataLabel, L = !1 === b.visible ? "hidden" : "inherit", P = g = h[1], t && G(t[l]) && (void 0 === t[l].pos ?
                        L = "hidden" : (x = t[l].size, P = b.top + t[l].pos)), delete b.positionIndex, K = k.justify ? v[0] + (d ? -1 : 1) * (p + b.labelDistance) : c.getX(P < b.top + 2 || P > b.bottom - 2 ? g : P, d, b), E._attr = {
                        visibility: L,
                        align: h[6]
                    }, E._pos = {
                        x: K + k.x + ({
                            left: m,
                            right: -m
                        }[h[6]] || 0),
                        y: P + k.y - 10
                    }, h.x = K, h.y = P, u(k.crop, !0) && (F = E.getBBox().width, g = null, K - F < m ? (g = Math.round(F - K + m), y[3] = Math.max(g, y[3])) : K + F > n - m && (g = Math.round(K + F - n + m), y[1] = Math.max(g, y[1])), 0 > P - x / 2 ? y[0] = Math.max(Math.round(-P + x / 2), y[0]) : P + x / 2 > w && (y[2] = Math.max(Math.round(P + x / 2 - w), y[2])), E.sideOverflow =
                        g)
            }), 0 === C(y) || this.verifyDataLabelOverflow(y)) && (this.placeDataLabels(), r && q(this.points, function(a) {
                var b;
                t = a.connector;
                if ((E = a.dataLabel) && E._pos && a.visible && 0 < a.labelDistance) {
                    L = E._attr.visibility;
                    if (b = !t) a.connector = t = f.renderer.path().addClass("highcharts-data-label-connector  highcharts-color-" + a.colorIndex).add(c.dataLabelsGroup), t.attr({
                        "stroke-width": r,
                        stroke: k.connectorColor || a.color || "#666666"
                    });
                    t[b ? "attr" : "animate"]({
                        d: c.connectorPath(a.labelPos)
                    });
                    t.attr("visibility", L)
                } else t && (a.connector =
                    t.destroy())
            }))
        }, n.pie.prototype.connectorPath = function(a) {
            var c = a.x,
                b = a.y;
            return u(this.options.dataLabels.softConnector, !0) ? ["M", c + ("left" === a[6] ? 5 : -5), b, "C", c, b, 2 * a[2] - a[4], 2 * a[3] - a[5], a[2], a[3], "L", a[4], a[5]] : ["M", c + ("left" === a[6] ? 5 : -5), b, "L", a[2], a[3], "L", a[4], a[5]]
        }, n.pie.prototype.placeDataLabels = function() {
            q(this.points, function(a) {
                var c = a.dataLabel;
                c && a.visible && ((a = c._pos) ? (c.sideOverflow && (c._attr.width = c.getBBox().width - c.sideOverflow, c.css({
                        width: c._attr.width + "px",
                        textOverflow: "ellipsis"
                    }),
                    c.shortened = !0), c.attr(c._attr), c[c.moved ? "animate" : "attr"](a), c.moved = !0) : c && c.attr({
                    y: -9999
                }))
            }, this)
        }, n.pie.prototype.alignDataLabel = v, n.pie.prototype.verifyDataLabelOverflow = function(a) {
            var c = this.center,
                b = this.options,
                e = b.center,
                f = b.minSize || 80,
                g, k = null !== b.size;
            k || (null !== e[0] ? g = Math.max(c[2] - Math.max(a[1], a[3]), f) : (g = Math.max(c[2] - a[1] - a[3], f), c[0] += (a[3] - a[1]) / 2), null !== e[1] ? g = Math.max(Math.min(g, c[2] - Math.max(a[0], a[2])), f) : (g = Math.max(Math.min(g, c[2] - a[0] - a[2]), f), c[1] += (a[0] - a[2]) / 2), g <
                c[2] ? (c[2] = g, c[3] = Math.min(d(b.innerSize || 0, g), g), this.translate(c), this.drawDataLabels && this.drawDataLabels()) : k = !0);
            return k
        });
        n.column && (n.column.prototype.alignDataLabel = function(a, c, b, d, f) {
            var e = this.chart.inverted,
                k = a.series,
                l = a.dlBox || a.shapeArgs,
                n = u(a.below, a.plotY > u(this.translatedThreshold, k.yAxis.len)),
                q = u(b.inside, !!this.options.stacking);
            l && (d = m(l), 0 > d.y && (d.height += d.y, d.y = 0), l = d.y + d.height - k.yAxis.len, 0 < l && (d.height -= l), e && (d = {
                x: k.yAxis.len - d.y - d.height,
                y: k.xAxis.len - d.x - d.width,
                width: d.height,
                height: d.width
            }), q || (e ? (d.x += n ? 0 : d.width, d.width = 0) : (d.y += n ? d.height : 0, d.height = 0)));
            b.align = u(b.align, !e || q ? "center" : n ? "right" : "left");
            b.verticalAlign = u(b.verticalAlign, e || q ? "middle" : n ? "top" : "bottom");
            g.prototype.alignDataLabel.call(this, a, c, b, d, f);
            a.isLabelJustified && a.contrastColor && a.dataLabel.css({
                color: a.contrastColor
            })
        })
    })(N);
    (function(a) {
        var E = a.Chart,
            C = a.each,
            G = a.objectEach,
            q = a.pick,
            f = a.addEvent;
        E.prototype.callbacks.push(function(a) {
            f(a, "render", function() {
                var f = [];
                C(a.labelCollectors || [], function(a) {
                    f = f.concat(a())
                });
                C(a.yAxis || [], function(a) {
                    a.options.stackLabels && !a.options.stackLabels.allowOverlap && G(a.stacks, function(a) {
                        G(a, function(a) {
                            f.push(a.label)
                        })
                    })
                });
                C(a.series || [], function(a) {
                    var k = a.options.dataLabels,
                        m = a.dataLabelCollections || ["dataLabel"];
                    (k.enabled || a._hasPointLabels) && !k.allowOverlap && a.visible && C(m, function(d) {
                        C(a.points, function(a) {
                            a[d] && (a[d].labelrank = q(a.labelrank, a.shapeArgs && a.shapeArgs.height), f.push(a[d]))
                        })
                    })
                });
                a.hideOverlappingLabels(f)
            })
        });
        E.prototype.hideOverlappingLabels =
            function(a) {
                var f = a.length,
                    k, q, u, d, g, n, c, e, l, b = function(a, b, c, d, e, f, g, k) {
                        return !(e > a + c || e + g < a || f > b + d || f + k < b)
                    };
                for (q = 0; q < f; q++)
                    if (k = a[q]) k.oldOpacity = k.opacity, k.newOpacity = 1, k.width || (u = k.getBBox(), k.width = u.width, k.height = u.height);
                a.sort(function(a, b) {
                    return (b.labelrank || 0) - (a.labelrank || 0)
                });
                for (q = 0; q < f; q++)
                    for (u = a[q], k = q + 1; k < f; ++k)
                        if (d = a[k], u && d && u !== d && u.placed && d.placed && 0 !== u.newOpacity && 0 !== d.newOpacity && (g = u.alignAttr, n = d.alignAttr, c = u.parentGroup, e = d.parentGroup, l = 2 * (u.box ? 0 : u.padding ||
                                0), g = b(g.x + c.translateX, g.y + c.translateY, u.width - l, u.height - l, n.x + e.translateX, n.y + e.translateY, d.width - l, d.height - l)))(u.labelrank < d.labelrank ? u : d).newOpacity = 0;
                C(a, function(a) {
                    var b, c;
                    a && (c = a.newOpacity, a.oldOpacity !== c && a.placed && (c ? a.show(!0) : b = function() {
                        a.hide()
                    }, a.alignAttr.opacity = c, a[a.isOld ? "animate" : "attr"](a.alignAttr, null, b)), a.isOld = !0)
                })
            }
    })(N);
    (function(a) {
        var E = a.addEvent,
            C = a.Chart,
            G = a.createElement,
            q = a.css,
            f = a.defaultOptions,
            k = a.defaultPlotOptions,
            t = a.each,
            m = a.extend,
            v = a.fireEvent,
            u = a.hasTouch,
            d = a.inArray,
            g = a.isObject,
            n = a.Legend,
            c = a.merge,
            e = a.pick,
            l = a.Point,
            b = a.Series,
            z = a.seriesTypes,
            A = a.svg,
            I;
        I = a.TrackerMixin = {
            drawTrackerPoint: function() {
                var a = this,
                    b = a.chart.pointer,
                    c = function(a) {
                        var c = b.getPointFromEvent(a);
                        void 0 !== c && (b.isDirectTouch = !0, c.onMouseOver(a))
                    };
                t(a.points, function(a) {
                    a.graphic && (a.graphic.element.point = a);
                    a.dataLabel && (a.dataLabel.div ? a.dataLabel.div.point = a : a.dataLabel.element.point = a)
                });
                a._hasTracking || (t(a.trackerGroups, function(d) {
                    if (a[d]) {
                        a[d].addClass("highcharts-tracker").on("mouseover",
                            c).on("mouseout", function(a) {
                            b.onTrackerMouseOut(a)
                        });
                        if (u) a[d].on("touchstart", c);
                        a.options.cursor && a[d].css(q).css({
                            cursor: a.options.cursor
                        })
                    }
                }), a._hasTracking = !0)
            },
            drawTrackerGraph: function() {
                var a = this,
                    b = a.options,
                    c = b.trackByArea,
                    d = [].concat(c ? a.areaPath : a.graphPath),
                    e = d.length,
                    f = a.chart,
                    g = f.pointer,
                    k = f.renderer,
                    l = f.options.tooltip.snap,
                    h = a.tracker,
                    m, n = function() {
                        if (f.hoverSeries !== a) a.onMouseOver()
                    },
                    q = "rgba(192,192,192," + (A ? .0001 : .002) + ")";
                if (e && !c)
                    for (m = e + 1; m--;) "M" === d[m] && d.splice(m + 1, 0, d[m +
                        1] - l, d[m + 2], "L"), (m && "M" === d[m] || m === e) && d.splice(m, 0, "L", d[m - 2] + l, d[m - 1]);
                h ? h.attr({
                    d: d
                }) : a.graph && (a.tracker = k.path(d).attr({
                    "stroke-linejoin": "round",
                    visibility: a.visible ? "visible" : "hidden",
                    stroke: q,
                    fill: c ? q : "none",
                    "stroke-width": a.graph.strokeWidth() + (c ? 0 : 2 * l),
                    zIndex: 2
                }).add(a.group), t([a.tracker, a.markerGroup], function(a) {
                    a.addClass("highcharts-tracker").on("mouseover", n).on("mouseout", function(a) {
                        g.onTrackerMouseOut(a)
                    });
                    b.cursor && a.css({
                        cursor: b.cursor
                    });
                    if (u) a.on("touchstart", n)
                }))
            }
        };
        z.column &&
            (z.column.prototype.drawTracker = I.drawTrackerPoint);
        z.pie && (z.pie.prototype.drawTracker = I.drawTrackerPoint);
        z.scatter && (z.scatter.prototype.drawTracker = I.drawTrackerPoint);
        m(n.prototype, {
            setItemEvents: function(a, b, d) {
                var e = this,
                    f = e.chart.renderer.boxWrapper,
                    g = "highcharts-legend-" + (a.series ? "point" : "series") + "-active";
                (d ? b : a.legendGroup).on("mouseover", function() {
                    a.setState("hover");
                    f.addClass(g);
                    b.css(e.options.itemHoverStyle)
                }).on("mouseout", function() {
                    b.css(c(a.visible ? e.itemStyle : e.itemHiddenStyle));
                    f.removeClass(g);
                    a.setState()
                }).on("click", function(b) {
                    var c = function() {
                        a.setVisible && a.setVisible()
                    };
                    b = {
                        browserEvent: b
                    };
                    a.firePointEvent ? a.firePointEvent("legendItemClick", b, c) : v(a, "legendItemClick", b, c)
                })
            },
            createCheckboxForItem: function(a) {
                a.checkbox = G("input", {
                    type: "checkbox",
                    checked: a.selected,
                    defaultChecked: a.selected
                }, this.options.itemCheckboxStyle, this.chart.container);
                E(a.checkbox, "click", function(b) {
                    v(a.series || a, "checkboxClick", {
                        checked: b.target.checked,
                        item: a
                    }, function() {
                        a.select()
                    })
                })
            }
        });
        f.legend.itemStyle.cursor = "pointer";
        m(C.prototype, {
            showResetZoom: function() {
                var a = this,
                    b = f.lang,
                    c = a.options.chart.resetZoomButton,
                    d = c.theme,
                    e = d.states,
                    g = "chart" === c.relativeTo ? null : "plotBox";
                this.resetZoomButton = a.renderer.button(b.resetZoom, null, null, function() {
                    a.zoomOut()
                }, d, e && e.hover).attr({
                    align: c.position.align,
                    title: b.resetZoomTitle
                }).addClass("highcharts-reset-zoom").add().align(c.position, !1, g)
            },
            zoomOut: function() {
                var a = this;
                v(a, "selection", {
                    resetSelection: !0
                }, function() {
                    a.zoom()
                })
            },
            zoom: function(a) {
                var b,
                    c = this.pointer,
                    d = !1,
                    f;
                !a || a.resetSelection ? (t(this.axes, function(a) {
                    b = a.zoom()
                }), c.initiated = !1) : t(a.xAxis.concat(a.yAxis), function(a) {
                    var e = a.axis;
                    c[e.isXAxis ? "zoomX" : "zoomY"] && (b = e.zoom(a.min, a.max), e.displayBtn && (d = !0))
                });
                f = this.resetZoomButton;
                d && !f ? this.showResetZoom() : !d && g(f) && (this.resetZoomButton = f.destroy());
                b && this.redraw(e(this.options.chart.animation, a && a.animation, 100 > this.pointCount))
            },
            pan: function(a, b) {
                var c = this,
                    d = c.hoverPoints,
                    e;
                d && t(d, function(a) {
                    a.setState()
                });
                t("xy" === b ? [1, 0] : [1], function(b) {
                    b = c[b ? "xAxis" : "yAxis"][0];
                    var d = b.horiz,
                        f = a[d ? "chartX" : "chartY"],
                        d = d ? "mouseDownX" : "mouseDownY",
                        g = c[d],
                        h = (b.pointRange || 0) / 2,
                        k = b.getExtremes(),
                        l = b.toValue(g - f, !0) + h,
                        h = b.toValue(g + b.len - f, !0) - h,
                        m = h < l,
                        g = m ? h : l,
                        l = m ? l : h,
                        h = Math.min(k.dataMin, b.toValue(b.toPixels(k.min) - b.minPixelPadding)),
                        m = Math.max(k.dataMax, b.toValue(b.toPixels(k.max) + b.minPixelPadding)),
                        n;
                    n = h - g;
                    0 < n && (l += n, g = h);
                    n = l - m;
                    0 < n && (l = m, g -= n);
                    b.series.length && g !== k.min && l !== k.max && (b.setExtremes(g, l, !1, !1, {
                        trigger: "pan"
                    }), e = !0);
                    c[d] = f
                });
                e && c.redraw(!1);
                q(c.container, {
                    cursor: "move"
                })
            }
        });
        m(l.prototype, {
            select: function(a, b) {
                var c = this,
                    f = c.series,
                    g = f.chart;
                a = e(a, !c.selected);
                c.firePointEvent(a ? "select" : "unselect", {
                    accumulate: b
                }, function() {
                    c.selected = c.options.selected = a;
                    f.options.data[d(c, f.data)] = c.options;
                    c.setState(a && "select");
                    b || t(g.getSelectedPoints(), function(a) {
                        a.selected && a !== c && (a.selected = a.options.selected = !1, f.options.data[d(a, f.data)] = a.options, a.setState(""), a.firePointEvent("unselect"))
                    })
                })
            },
            onMouseOver: function(a) {
                var b =
                    this.series.chart,
                    c = b.pointer;
                a = a ? c.normalize(a) : c.getChartCoordinatesFromPoint(this, b.inverted);
                c.runPointActions(a, this)
            },
            onMouseOut: function() {
                var a = this.series.chart;
                this.firePointEvent("mouseOut");
                t(a.hoverPoints || [], function(a) {
                    a.setState()
                });
                a.hoverPoints = a.hoverPoint = null
            },
            importEvents: function() {
                if (!this.hasImportedEvents) {
                    var b = this,
                        d = c(b.series.options.point, b.options).events;
                    b.events = d;
                    a.objectEach(d, function(a, c) {
                        E(b, c, a)
                    });
                    this.hasImportedEvents = !0
                }
            },
            setState: function(a, b) {
                var c = Math.floor(this.plotX),
                    d = this.plotY,
                    f = this.series,
                    g = f.options.states[a] || {},
                    l = k[f.type].marker && f.options.marker,
                    n = l && !1 === l.enabled,
                    r = l && l.states && l.states[a] || {},
                    h = !1 === r.enabled,
                    q = f.stateMarkerGraphic,
                    t = this.marker || {},
                    u = f.chart,
                    v = f.halo,
                    z, A = l && f.markerAttribs;
                a = a || "";
                if (!(a === this.state && !b || this.selected && "select" !== a || !1 === g.enabled || a && (h || n && !1 === r.enabled) || a && t.states && t.states[a] && !1 === t.states[a].enabled)) {
                    A && (z = f.markerAttribs(this, a));
                    if (this.graphic) this.state && this.graphic.removeClass("highcharts-point-" +
                        this.state), a && this.graphic.addClass("highcharts-point-" + a), this.graphic.animate(f.pointAttribs(this, a), e(u.options.chart.animation, g.animation)), z && this.graphic.animate(z, e(u.options.chart.animation, r.animation, l.animation)), q && q.hide();
                    else {
                        if (a && r) {
                            l = t.symbol || f.symbol;
                            q && q.currentSymbol !== l && (q = q.destroy());
                            if (q) q[b ? "animate" : "attr"]({
                                x: z.x,
                                y: z.y
                            });
                            else l && (f.stateMarkerGraphic = q = u.renderer.symbol(l, z.x, z.y, z.width, z.height).add(f.markerGroup), q.currentSymbol = l);
                            q && q.attr(f.pointAttribs(this,
                                a))
                        }
                        q && (q[a && u.isInsidePlot(c, d, u.inverted) ? "show" : "hide"](), q.element.point = this)
                    }(c = g.halo) && c.size ? (v || (f.halo = v = u.renderer.path().add((this.graphic || q).parentGroup)), v[b ? "animate" : "attr"]({
                        d: this.haloPath(c.size)
                    }), v.attr({
                        "class": "highcharts-halo highcharts-color-" + e(this.colorIndex, f.colorIndex)
                    }), v.point = this, v.attr(m({
                        fill: this.color || f.color,
                        "fill-opacity": c.opacity,
                        zIndex: -1
                    }, c.attributes))) : v && v.point && v.point.haloPath && v.animate({
                        d: v.point.haloPath(0)
                    });
                    this.state = a
                }
            },
            haloPath: function(a) {
                return this.series.chart.renderer.symbols.circle(Math.floor(this.plotX) -
                    a, this.plotY - a, 2 * a, 2 * a)
            }
        });
        m(b.prototype, {
            onMouseOver: function() {
                var a = this.chart,
                    b = a.hoverSeries;
                if (b && b !== this) b.onMouseOut();
                this.options.events.mouseOver && v(this, "mouseOver");
                this.setState("hover");
                a.hoverSeries = this
            },
            onMouseOut: function() {
                var a = this.options,
                    b = this.chart,
                    c = b.tooltip,
                    d = b.hoverPoint;
                b.hoverSeries = null;
                if (d) d.onMouseOut();
                this && a.events.mouseOut && v(this, "mouseOut");
                !c || this.stickyTracking || c.shared && !this.noSharedTooltip || c.hide();
                this.setState()
            },
            setState: function(a) {
                var b = this,
                    c = b.options,
                    d = b.graph,
                    f = c.states,
                    g = c.lineWidth,
                    c = 0;
                a = a || "";
                if (b.state !== a && (t([b.group, b.markerGroup, b.dataLabelsGroup], function(c) {
                        c && (b.state && c.removeClass("highcharts-series-" + b.state), a && c.addClass("highcharts-series-" + a))
                    }), b.state = a, !f[a] || !1 !== f[a].enabled) && (a && (g = f[a].lineWidth || g + (f[a].lineWidthPlus || 0)), d && !d.dashstyle))
                    for (g = {
                            "stroke-width": g
                        }, d.animate(g, e(b.chart.options.chart.animation, f[a] && f[a].animation)); b["zone-graph-" + c];) b["zone-graph-" + c].attr(g), c += 1
            },
            setVisible: function(a,
                b) {
                var c = this,
                    d = c.chart,
                    e = c.legendItem,
                    f, g = d.options.chart.ignoreHiddenSeries,
                    k = c.visible;
                f = (c.visible = a = c.options.visible = c.userOptions.visible = void 0 === a ? !k : a) ? "show" : "hide";
                t(["group", "dataLabelsGroup", "markerGroup", "tracker", "tt"], function(a) {
                    if (c[a]) c[a][f]()
                });
                if (d.hoverSeries === c || (d.hoverPoint && d.hoverPoint.series) === c) c.onMouseOut();
                e && d.legend.colorizeItem(c, a);
                c.isDirty = !0;
                c.options.stacking && t(d.series, function(a) {
                    a.options.stacking && a.visible && (a.isDirty = !0)
                });
                t(c.linkedSeries, function(b) {
                    b.setVisible(a, !1)
                });
                g && (d.isDirtyBox = !0);
                !1 !== b && d.redraw();
                v(c, f, {
                    redraw: b
                })
            },
            show: function() {
                this.setVisible(!0)
            },
            hide: function() {
                this.setVisible(!1)
            },
            select: function(a) {
                this.selected = a = void 0 === a ? !this.selected : a;
                this.checkbox && (this.checkbox.checked = a);
                v(this, a ? "select" : "unselect")
            },
            drawTracker: I.drawTrackerGraph
        })
    })(N);
    (function(a) {
        var E = a.Chart,
            C = a.each,
            G = a.inArray,
            q = a.isArray,
            f = a.isObject,
            k = a.pick,
            t = a.splat;
        E.prototype.setResponsive = function(f) {
            var k = this.options.responsive,
                m = [],
                d = this.currentResponsive;
            k && k.rules && C(k.rules, function(d) {
                void 0 === d._id && (d._id = a.uniqueKey());
                this.matchResponsiveRule(d, m, f)
            }, this);
            var g = a.merge.apply(0, a.map(m, function(d) {
                    return a.find(k.rules, function(a) {
                        return a._id === d
                    }).chartOptions
                })),
                m = m.toString() || void 0;
            m !== (d && d.ruleIds) && (d && this.update(d.undoOptions, f), m ? (this.currentResponsive = {
                ruleIds: m,
                mergedOptions: g,
                undoOptions: this.currentOptions(g)
            }, this.update(g, f)) : this.currentResponsive = void 0)
        };
        E.prototype.matchResponsiveRule = function(a, f) {
            var m = a.condition;
            (m.callback || function() {
                return this.chartWidth <= k(m.maxWidth, Number.MAX_VALUE) && this.chartHeight <= k(m.maxHeight, Number.MAX_VALUE) && this.chartWidth >= k(m.minWidth, 0) && this.chartHeight >= k(m.minHeight, 0)
            }).call(this) && f.push(a._id)
        };
        E.prototype.currentOptions = function(k) {
            function m(d, g, k, c) {
                var e;
                a.objectEach(d, function(a, b) {
                    if (!c && -1 < G(b, ["series", "xAxis", "yAxis"]))
                        for (d[b] = t(d[b]), k[b] = [], e = 0; e < d[b].length; e++) g[b][e] && (k[b][e] = {}, m(a[e], g[b][e], k[b][e], c + 1));
                    else f(a) ? (k[b] = q(a) ? [] : {}, m(a, g[b] || {},
                        k[b], c + 1)) : k[b] = g[b] || null
                })
            }
            var u = {};
            m(k, this.options, u, 0);
            return u
        }
    })(N);
    return N
});