var basket = function () {
    "use strict";

    function t() {
    }

    function n(t) {
        return t()
    }

    function e() {
        return Object.create(null)
    }

    function o(t) {
        t.forEach(n)
    }

    function s(t) {
        return "function" == typeof t
    }

    function l(t, n) {
        return t != t ? n == n : t !== n || t && "object" == typeof t || "function" == typeof t
    }

    function i(t, n) {
        t.appendChild(n)
    }

    function c(t, n, e) {
        t.insertBefore(n, e || null)
    }

    function r(t) {
        t.parentNode.removeChild(t)
    }

    function u(t, n) {
        for (let e = 0; e < t.length; e += 1) t[e] && t[e].d(n)
    }

    function a(t) {
        return document.createElement(t)
    }

    function d(t) {
        return document.createTextNode(t)
    }

    function m() {
        return d(" ")
    }

    function _(t, n, e, o) {
        return t.addEventListener(n, e, o), () => t.removeEventListener(n, e, o)
    }

    function f(t, n, e) {
        null == e ? t.removeAttribute(n) : t.getAttribute(n) !== e && t.setAttribute(n, e)
    }

    function p(t, n) {
        n = "" + n, t.wholeText !== n && (t.data = n)
    }

    function h(t, n) {
        for (let e = 0; e < t.options.length; e += 1) {
            const o = t.options[e];
            if (o.__value === n) return void (o.selected = !0)
        }
    }

    let b;

    function g(t) {
        b = t
    }

    const $ = [], v = [], y = [], x = [], w = Promise.resolve();
    let k = !1;

    function j(t) {
        y.push(t)
    }

    let C = !1;
    const O = new Set;

    function S() {
        if (!C) {
            C = !0;
            do {
                for (let t = 0; t < $.length; t += 1) {
                    const n = $[t];
                    g(n), N(n.$$)
                }
                for (g(null), $.length = 0; v.length;) v.pop()();
                for (let t = 0; t < y.length; t += 1) {
                    const n = y[t];
                    O.has(n) || (O.add(n), n())
                }
                y.length = 0
            } while ($.length);
            for (; x.length;) x.pop()();
            k = !1, C = !1, O.clear()
        }
    }

    function N(t) {
        if (null !== t.fragment) {
            t.update(), o(t.before_update);
            const n = t.dirty;
            t.dirty = [-1], t.fragment && t.fragment.p(t.ctx, n), t.after_update.forEach(j)
        }
    }

    const T = new Set;

    function A(t, n) {
        -1 === t.$$.dirty[0] && ($.push(t), k || (k = !0, w.then(S)), t.$$.dirty.fill(0)), t.$$.dirty[n / 31 | 0] |= 1 << n % 31
    }

    function E(l, i, c, u, a, d, m, _ = [-1]) {
        const f = b;
        g(l);
        const p = l.$$ = {
            fragment: null,
            ctx: null,
            props: d,
            update: t,
            not_equal: a,
            bound: e(),
            on_mount: [],
            on_destroy: [],
            on_disconnect: [],
            before_update: [],
            after_update: [],
            context: new Map(f ? f.$$.context : i.context || []),
            callbacks: e(),
            dirty: _,
            skip_bound: !1,
            root: i.target || f.$$.root
        };
        m && m(p.root);
        let h = !1;
        if (p.ctx = c ? c(l, i.props || {}, ((t, n, ...e) => {
            const o = e.length ? e[0] : n;
            return p.ctx && a(p.ctx[t], p.ctx[t] = o) && (!p.skip_bound && p.bound[t] && p.bound[t](o), h && A(l, t)), n
        })) : [], p.update(), h = !0, o(p.before_update), p.fragment = !!u && u(p.ctx), i.target) {
            if (i.hydrate) {
                const t = function (t) {
                    return Array.from(t.childNodes)
                }(i.target);
                p.fragment && p.fragment.l(t), t.forEach(r)
            } else p.fragment && p.fragment.c();
            i.intro && (($ = l.$$.fragment) && $.i && (T.delete($), $.i(v))), function (t, e, l, i) {
                const {fragment: c, on_mount: r, on_destroy: u, after_update: a} = t.$$;
                c && c.m(e, l), i || j((() => {
                    const e = r.map(n).filter(s);
                    u ? u.push(...e) : o(e), t.$$.on_mount = []
                })), a.forEach(j)
            }(l, i.target, i.anchor, i.customElement), S()
        }
        var $, v;
        g(f)
    }

    function M(t, n, e) {
        const o = t.slice();
        return o[1] = n[e], o
    }

    function F(t, n, e) {
        const o = t.slice();
        return o[16] = n[e], o
    }

    function H(t) {
        let n, e, o, s, l, u, _, h, b, g, $, v, y, x, w, k = t[16].title + "", j = t[16].name1 + "",
            C = t[16].name2 + "", O = t[16].gift + "";
        return {
            c() {
                n = a("div"), e = a("p"), o = d(k), s = m(), l = a("div"), u = a("span"), _ = d(j), h = m(), b = a("span"), g = d(C), $ = m(), v = a("div"), y = a("span"), x = d(O), w = m(), f(e, "class", "solutions__bottom_row-left"), f(l, "class", "solutions__bottom_row-center"), f(v, "class", "solutions__bottom_row-right"), f(n, "class", "solutions__bottom_row")
            }, m(t, r) {
                c(t, n, r), i(n, e), i(e, o), i(n, s), i(n, l), i(l, u), i(u, _), i(l, h), i(l, b), i(b, g), i(n, $), i(n, v), i(v, y), i(y, x), i(n, w)
            }, p(t, n) {
                4 & n && k !== (k = t[16].title + "") && p(o, k), 4 & n && j !== (j = t[16].name1 + "") && p(_, j), 4 & n && C !== (C = t[16].name2 + "") && p(g, C), 4 & n && O !== (O = t[16].gift + "") && p(x, O)
            }, d(t) {
                t && r(n)
            }
        }
    }

    function z(t) {
        let n, e = t[16].active && H(t);
        return {
            c() {
                e && e.c(), n = d("")
            }, m(t, o) {
                e && e.m(t, o), c(t, n, o)
            }, p(t, o) {
                t[16].active ? e ? e.p(t, o) : (e = H(t), e.c(), e.m(n.parentNode, n)) : e && (e.d(1), e = null)
            }, d(t) {
                e && e.d(t), t && r(n)
            }
        }
    }

    function U(n) {
        let e;
        return {
            c() {
                e = a("button"), e.textContent = "купить", f(e, "data-payment", "card"), f(e, "class", "js-modal js-modal-auth solutions__bottom_column-btn grey")
            }, m(t, n) {
                c(t, e, n)
            }, p: t, d(t) {
                t && r(e)
            }
        }
    }

    function B(n) {
        let e, o, s;
        return {
            c() {
                e = a("button"), e.textContent = "купить", f(e, "class", "solutions__bottom_column-btn grey")
            }, m(t, l) {
                c(t, e, l), o || (s = _(e, "click", n[10]), o = !0)
            }, p: t, d(t) {
                t && r(e), o = !1, s()
            }
        }
    }

    function L(t) {
        let n, e, s, l, b, g, $, v, y, x, w, k, C, O, S, N, T, A, E = t[5], F = [];
        for (let n = 0; n < E.length; n += 1) F[n] = P(M(t, E, n));

        function H(t, n) {
            return t[6] ? D : q
        }

        let z = H(t), U = z(t);
        return {
            c() {
                n = a("div"), e = a("div"), e.textContent = "Рассрочка без процентов", s = m(), l = a("div"), l.innerHTML = "<p>все проценты<br/>\n платит vincko:</p>", b = m(), g = a("div"), $ = a("div"), v = a("select");
                for (let t = 0; t < F.length; t += 1) F[t].c();
                y = m(), x = a("p"), x.textContent = "по", w = m(), k = a("div"), C = a("span"), O = d(t[0]), S = d("\r\n₽"), N = m(), U.c(), f(e, "class", "solutions__bottom_column-title"), f(l, "class", "solutions__bottom_column-interest"), f(v, "class", "installment-period__select js-installment-period"), f(v, "data-price", t[3]), void 0 === t[1] && j((() => t[11].call(v))), f(C, "class", "js-installment-price"), f(k, "class", "solutions__bottom_column-price nowrap"), f(g, "class", "solutions__bottom_column-monthprice js-installment"), f(n, "class", "solutions__bottom_column")
            }, m(o, r) {
                c(o, n, r), i(n, e), i(n, s), i(n, l), i(n, b), i(n, g), i(g, $), i($, v);
                for (let t = 0; t < F.length; t += 1) F[t].m(v, null);
                h(v, t[1]), i(g, y), i(g, x), i(g, w), i(g, k), i(k, C), i(C, O), i(k, S), i(n, N), U.m(n, null), T || (A = [_(v, "change", t[11]), _(v, "change", t[12])], T = !0)
            }, p(t, e) {
                if (32 & e) {
                    let n;
                    for (E = t[5], n = 0; n < E.length; n += 1) {
                        const o = M(t, E, n);
                        F[n] ? F[n].p(o, e) : (F[n] = P(o), F[n].c(), F[n].m(v, null))
                    }
                    for (; n < F.length; n += 1) F[n].d(1);
                    F.length = E.length
                }
                8 & e && f(v, "data-price", t[3]), 34 & e && h(v, t[1]), 1 & e && p(O, t[0]), z === (z = H(t)) && U ? U.p(t, e) : (U.d(1), U = z(t), U && (U.c(), U.m(n, null)))
            }, d(t) {
                t && r(n), u(F, t), U.d(), T = !1, o(A)
            }
        }
    }

    function P(t) {
        let n, e, o, s, l = t[1].UF_MONTHS + "";
        return {
            c() {
                n = a("option"), e = d(l), o = d(" мес."), n.__value = s = t[1].UF_MONTHS, n.value = n.__value
            }, m(t, s) {
                c(t, n, s), i(n, e), i(n, o)
            }, p(t, o) {
                32 & o && l !== (l = t[1].UF_MONTHS + "") && p(e, l), 32 & o && s !== (s = t[1].UF_MONTHS) && (n.__value = s, n.value = n.__value)
            }, d(t) {
                t && r(n)
            }
        }
    }

    function q(n) {
        let e;
        return {
            c() {
                e = a("button"), e.innerHTML = "<svg class=\"sber-svg\" width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n" +
                    "<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M14.3251 3.66502L16.2759 2.2266C14.5616 0.84729 12.3744 0 9.99016 0V0.0199143C7.41905 0.024905 5.07156 1.00551 3.29912 2.61029L3.29065 2.60097C1.26914 4.42621 0.0100175 7.05293 5.95061e-05 9.9749C2.02687e-05 9.97999 0 9.98507 0 9.99012C0 9.9934 1.58444e-06 9.99668 4.7526e-06 9.99995C1.58457e-06 10.0032 0 10.0065 0 10.0098H1.90953e-05C0.00500391 12.581 0.985653 14.9285 2.5905 16.701L2.58127 16.7094C4.40682 18.7312 7.03412 19.9904 9.95667 19.9999L9.97044 20L9.97723 20L9.99015 20V20C12.5665 19.995 14.9184 19.0104 16.6921 17.3997L16.7094 17.4187C18.7192 15.6059 20 12.9458 20 10.0098C20 9.39899 19.9409 8.80786 19.8424 8.21673L17.6946 9.81278V10.0098C17.6946 12.14 16.8239 14.0612 15.4264 15.4461L15.4089 15.4286C14.0296 16.8473 12.1182 17.6946 9.99015 17.6946H9.9817C9.91537 17.6946 9.85347 17.6945 9.79153 17.6921C9.72801 17.6896 9.66446 17.6846 9.59606 17.6749L9.59556 17.6846C7.62825 17.5846 5.86161 16.7414 4.56368 15.4363L4.57144 15.4285C3.17242 14.0492 2.30542 12.1379 2.30542 10.0098C2.30542 9.94231 2.30631 9.87497 2.30808 9.80782C2.31061 9.74543 2.31553 9.68293 2.32513 9.61574L2.31558 9.61525C2.41628 7.6626 3.25932 5.88279 4.56372 4.58359L4.57145 4.59132C5.95076 3.19231 7.8818 2.32531 9.99018 2.32531C10.1281 2.32531 10.2463 2.32531 10.3843 2.34502L10.3856 2.31976C11.8499 2.40838 13.2037 2.88728 14.3251 3.66502ZM19.1133 5.89161C18.7784 5.18225 18.3843 4.5123 17.9114 3.90146L9.99017 9.71426L6.18721 7.33003V10.2069L10.0099 12.6108L19.1133 5.89161Z\" fill=\"white\"/>\n" +
                    "</svg>В рассрочку", f(e, "data-payment", "installment"), f(e, "class", "js-modal js-modal-auth solutions__bottom_column-btn green-sber")
            }, m(t, n) {
                c(t, e, n)
            }, p: t, d(t) {
                t && r(e)
            }
        }
    }

    function D(n) {
        let e, o, s;
        return {
            c() {
                e = a("button"), e.innerHTML = "<svg class=\"sber-svg\" width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n" +
                    "<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M14.3251 3.66502L16.2759 2.2266C14.5616 0.84729 12.3744 0 9.99016 0V0.0199143C7.41905 0.024905 5.07156 1.00551 3.29912 2.61029L3.29065 2.60097C1.26914 4.42621 0.0100175 7.05293 5.95061e-05 9.9749C2.02687e-05 9.97999 0 9.98507 0 9.99012C0 9.9934 1.58444e-06 9.99668 4.7526e-06 9.99995C1.58457e-06 10.0032 0 10.0065 0 10.0098H1.90953e-05C0.00500391 12.581 0.985653 14.9285 2.5905 16.701L2.58127 16.7094C4.40682 18.7312 7.03412 19.9904 9.95667 19.9999L9.97044 20L9.97723 20L9.99015 20V20C12.5665 19.995 14.9184 19.0104 16.6921 17.3997L16.7094 17.4187C18.7192 15.6059 20 12.9458 20 10.0098C20 9.39899 19.9409 8.80786 19.8424 8.21673L17.6946 9.81278V10.0098C17.6946 12.14 16.8239 14.0612 15.4264 15.4461L15.4089 15.4286C14.0296 16.8473 12.1182 17.6946 9.99015 17.6946H9.9817C9.91537 17.6946 9.85347 17.6945 9.79153 17.6921C9.72801 17.6896 9.66446 17.6846 9.59606 17.6749L9.59556 17.6846C7.62825 17.5846 5.86161 16.7414 4.56368 15.4363L4.57144 15.4285C3.17242 14.0492 2.30542 12.1379 2.30542 10.0098C2.30542 9.94231 2.30631 9.87497 2.30808 9.80782C2.31061 9.74543 2.31553 9.68293 2.32513 9.61574L2.31558 9.61525C2.41628 7.6626 3.25932 5.88279 4.56372 4.58359L4.57145 4.59132C5.95076 3.19231 7.8818 2.32531 9.99018 2.32531C10.1281 2.32531 10.2463 2.32531 10.3843 2.34502L10.3856 2.31976C11.8499 2.40838 13.2037 2.88728 14.3251 3.66502ZM19.1133 5.89161C18.7784 5.18225 18.3843 4.5123 17.9114 3.90146L9.99017 9.71426L6.18721 7.33003V10.2069L10.0099 12.6108L19.1133 5.89161Z\" fill=\"white\"/>\n" +
                    "</svg>В рассрочку", f(e, "class", "solutions__bottom_column-btn green-sber")
            }, m(t, l) {
                c(t, e, l), o || (s = _(e, "click", n[13]), o = !0)
            }, p: t, d(t) {
                t && r(e), o = !1, s()
            }
        }
    }

    function J(n) {
        let e, o, s, l, _, h, b, g, $, v, y, x, w, k, j, C, O, S, N, T, A = n[2], E = [];
        for (let t = 0; t < A.length; t += 1) E[t] = z(F(n, A, t));

        function M(t, n) {
            return t[6] ? B : U
        }

        let H = M(n), P = H(n), q = n[5] && L(n);
        return {
            c() {
                e = a("div"), o = a("div"), s = a("div"), s.textContent = "Итого, в ваше Готовое решение входит:", l = m(), _ = a("div"), h = a("div");
                for (let t = 0; t < E.length; t += 1) E[t].c();
                b = m(), g = a("div"), $ = a("div"), v = a("div"), v.textContent = "Всего", y = m(), x = a("div"), w = d(n[4]), k = d(" ₽"), j = m(), C = a("div"), O = d(n[3]), S = d(" ₽"), N = m(), P.c(), T = m(), q && q.c(), f(s, "class", "solutions__bottom_title"), f(h, "class", "solutions__bottom_left"), f(v, "class", "solutions__bottom_column-title"), f(x, "class", "solutions__bottom_column-oldprice"), f(C, "class", "solutions__bottom_column-newprice"), f($, "class", "solutions__bottom_column"), f(g, "class", "solutions__bottom_right"), f(_, "class", "solutions__bottom_wrapper"), f(o, "class", "container"), f(e, "class", "solutions__bottom")
            }, m(t, n) {
                c(t, e, n), i(e, o), i(o, s), i(o, l), i(o, _), i(_, h);
                for (let t = 0; t < E.length; t += 1) E[t].m(h, null);
                i(_, b), i(_, g), i(g, $), i($, v), i($, y), i($, x), i(x, w), i(x, k), i($, j), i($, C), i(C, O), i(C, S), i($, N), P.m($, null), i(g, T), q && q.m(g, null)
            }, p(t, [n]) {
                if (4 & n) {
                    let e;
                    for (A = t[2], e = 0; e < A.length; e += 1) {
                        const o = F(t, A, e);
                        E[e] ? E[e].p(o, n) : (E[e] = z(o), E[e].c(), E[e].m(h, null))
                    }
                    for (; e < E.length; e += 1) E[e].d(1);
                    E.length = A.length
                }
                16 & n && p(w, t[4]), 8 & n && p(O, t[3]), H === (H = M(t)) && P ? P.p(t, n) : (P.d(1), P = H(t), P && (P.c(), P.m($, null))), t[5] ? q ? q.p(t, n) : (q = L(t), q.c(), q.m(g, null)) : q && (q.d(1), q = null)
            }, i: t, o: t, d(t) {
                t && r(e), u(E, t), P.d(), q && q.d()
            }
        }
    }

    function G(t, n, e) {
        let {items: o} = n, {sum: s} = n, {old_sum: l} = n, {periods: i} = n, {period: c} = n, {credit_sum: r} = n, {subscribe_sum: u} = n, {isAuthorized: a} = n;

        function d() {
            var t = new FormData;
            t.append("period", c), t.append("sum", s), fetch("/ajax/recount.php", {
                method: "POST",
                body: t
            }).then((t => {
                t.text().then((t => {
                    e(0, r = t)
                }))
            }))
        }

        function m(t) {
            const n = "/ajax/addtobasket.php";
            var e = new FormData,
                i = {paymentMethod: t, items: o, total: {total_sum: s, total_old_sum: l, total_subscribe_sum: u}};
            e.append("data", JSON.stringify(i)), fetch(n, {method: "POST", body: e}).then((t => {
                t.redirected && (window.location.href = t.url)
            })).catch((function (t) {
                console.info(t + " url: " + n)
            }))
        }

        return t.$$set = t => {
            "items" in t && e(2, o = t.items), "sum" in t && e(3, s = t.sum), "old_sum" in t && e(4, l = t.old_sum), "periods" in t && e(5, i = t.periods), "period" in t && e(1, c = t.period), "credit_sum" in t && e(0, r = t.credit_sum), "subscribe_sum" in t && e(9, u = t.subscribe_sum), "isAuthorized" in t && e(6, a = t.isAuthorized)
        }, [r, c, o, s, l, i, a, d, m, u, () => m("card"), function () {
            c = function (t) {
                const n = t.querySelector(":checked") || t.options[0];
                return n && n.__value
            }(this), e(1, c), e(5, i)
        }, () => d(), () => m("installment")]
    }

    return class extends class {
        $destroy() {
            !function (t, n) {
                const e = t.$$;
                null !== e.fragment && (o(e.on_destroy), e.fragment && e.fragment.d(n), e.on_destroy = e.fragment = null, e.ctx = [])
            }(this, 1), this.$destroy = t
        }

        $on(t, n) {
            const e = this.$$.callbacks[t] || (this.$$.callbacks[t] = []);
            return e.push(n), () => {
                const t = e.indexOf(n);
                -1 !== t && e.splice(t, 1)
            }
        }

        $set(t) {
            var n;
            this.$$set && (n = t, 0 !== Object.keys(n).length) && (this.$$.skip_bound = !0, this.$$set(t), this.$$.skip_bound = !1)
        }
    } {
        constructor(t) {
            super(), E(this, t, G, J, l, {
                items: 2,
                sum: 3,
                old_sum: 4,
                periods: 5,
                period: 1,
                credit_sum: 0,
                subscribe_sum: 9,
                isAuthorized: 6,
                checked: 7,
                handleBuy: 8
            })
        }

        get checked() {
            return this.$$.ctx[7]
        }

        get handleBuy() {
            return this.$$.ctx[8]
        }
    }
}();