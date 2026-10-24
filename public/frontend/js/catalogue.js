/* =========================================================
   Catalogue flip-book: shows a PDF like a book.
   - arrow buttons, keyboard left/right arrows, swipe, click on a page
   - uses PDF.js (loaded only when the section comes near the screen)
   ========================================================= */
(() => {
  'use strict';

  const LIB = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
  const WORKER = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
  const PAGE_W = 900;      // pixel width each page is drawn at
  const MOBILE = 700;      // below this width: one page at a time
  const FLIP_MS = 750;

  let libPromise = null;
  function loadLib() {
    if (!libPromise) {
      libPromise = new Promise((resolve, reject) => {
        const ready = () => {
          const lib = window.pdfjsLib;
          if (!lib.GlobalWorkerOptions.workerSrc) lib.GlobalWorkerOptions.workerSrc = WORKER;
          resolve(lib);
        };
        if (window.pdfjsLib) return ready();
        const s = document.createElement('script');
        s.src = LIB;
        s.onload = ready;
        s.onerror = () => { libPromise = null; reject(new Error('PDF.js could not be loaded')); };
        document.head.appendChild(s);
      });
    }
    return libPromise;
  }

  const sleep = ms => new Promise(r => setTimeout(r, ms));

  function Flipbook(root) {
    const url = root.dataset.pdf;
    const $ = s => root.querySelector(s);
    const book = $('.fb-book'), spread = $('.fb-spread'), L = $('.fb-left'), R = $('.fb-right');
    const prevB = $('.fb-prev'), nextB = $('.fb-next'), count = $('.fb-count'), goIn = $('.fb-go');
    const fsB = $('.fb-full'), loading = $('.fb-loading');

    let pdf = null, total = 0, single = false, cur = 0, busy = false, queued = 0, visible = false;
    const cache = new Map();   // page number -> Promise<blob url>
    const urls = new Map();    // page number -> blob url (when ready)
    const jobs = []; let running = 0;

    /* ---------- which pages are on which view ---------- */
    const nViews = () => single ? total : Math.floor(total / 2) + 1;
    const pagesFor = v => {
      if (single) return { l: null, r: v + 1 };
      if (v === 0) return { l: null, r: 1 };                       // cover
      const l = 2 * v, r = 2 * v + 1;
      return { l, r: r <= total ? r : null };                        // last page can be alone
    };
    const viewOf = p => single ? p - 1 : Math.floor(p / 2);

    /* ---------- drawing pages (PDF -> image) ---------- */
    function pump() {
      while (running < 2 && jobs.length) { running++; jobs.shift()(); }
    }
    async function draw(n) {
      const page = await pdf.getPage(n);
      const base = page.getViewport({ scale: 1 });
      const vp = page.getViewport({ scale: PAGE_W / base.width });
      const canvas = document.createElement('canvas');
      canvas.width = Math.floor(vp.width);
      canvas.height = Math.floor(vp.height);
      const ctx = canvas.getContext('2d');
      ctx.fillStyle = '#fff';
      ctx.fillRect(0, 0, canvas.width, canvas.height);
      await page.render({ canvasContext: ctx, canvas, viewport: vp }).promise;
      const blob = await new Promise(res => canvas.toBlob(res, 'image/jpeg', 0.86));
      if (page.cleanup) page.cleanup();
      return URL.createObjectURL(blob);
    }
    function pageUrl(n, urgent) {
      if (!cache.has(n)) {
        const p = new Promise((resolve, reject) => {
          const job = () => draw(n).then(resolve, reject).finally(() => { running--; pump(); });
          urgent ? jobs.unshift(job) : jobs.push(job);
          pump();
        }).then(u => { urls.set(n, u); return u; }, e => { cache.delete(n); throw e; });
        cache.set(n, p);
      }
      return cache.get(n);
    }
    const ready = ns => Promise.race([
      Promise.all(ns.filter(Boolean).map(n => pageUrl(n, true))).catch(() => { }),
      sleep(3500)
    ]);
    function prefetch() {
      [1, -1, 2, -2].forEach(k => {
        const v = cur + k;
        if (v < 0 || v >= nViews()) return;
        const p = pagesFor(v);
        [p.l, p.r].filter(Boolean).forEach(n => pageUrl(n, false).catch(() => { }));
      });
      // free memory of pages far away
      const keep = new Set();
      for (let v = cur - 3; v <= cur + 3; v++) {
        if (v < 0 || v >= nViews()) continue;
        const p = pagesFor(v); keep.add(p.l); keep.add(p.r);
      }
      cache.forEach((pr, n) => {
        if (keep.has(n)) return;
        cache.delete(n);
        const u = urls.get(n); urls.delete(n);
        if (u) URL.revokeObjectURL(u);
      });
    }

    /* ---------- faces ---------- */
    function setFace(el, n) {
      const img = el.querySelector('img');
      el.dataset.p = n || '';
      if (!n) { el.classList.add('empty'); el.classList.remove('loading'); img.removeAttribute('src'); return; }
      el.classList.remove('empty');
      if (urls.has(n)) { img.src = urls.get(n); el.classList.remove('loading'); return; }
      el.classList.add('loading');
      pageUrl(n, true).then(u => {
        if (el.dataset.p == n) { img.src = u; el.classList.remove('loading'); }
      }).catch(() => el.classList.remove('loading'));
    }
    function makeFace(n, back) {
      const f = document.createElement('div');
      f.className = 'face' + (back ? ' bk' : '');
      const img = document.createElement('img');
      img.alt = '';
      f.appendChild(img);
      if (n) { if (urls.has(n)) img.src = urls.get(n); else pageUrl(n, true).then(u => { img.src = u; }).catch(() => { }); }
      return f;
    }

    /* ---------- screen state ---------- */
    function layout() {
      if (single) { spread.style.transform = ''; return; }
      const p = pagesFor(cur);
      spread.style.transform = !p.l ? 'translateX(-25%)' : !p.r ? 'translateX(25%)' : 'none';
    }
    function ui() {
      const p = pagesFor(cur);
      count.textContent = (!p.l || !p.r) ? `Page ${p.l || p.r} / ${total}` : `Pages ${p.l}\u2013${p.r} / ${total}`;
      prevB.disabled = cur === 0;
      nextB.disabled = cur === nViews() - 1;
      goIn.max = total;
      goIn.placeholder = p.l || p.r;
    }
    function show(v, instant) {
      cur = v;
      const p = pagesFor(v);
      if (instant) { spread.style.transition = 'none'; }
      setFace(L, p.l); setFace(R, p.r);
      layout(); ui(); prefetch();
      if (instant) { spread.offsetHeight; spread.style.transition = ''; }
    }

    /* ---------- turning pages ---------- */
    const turned = (el, ms) => new Promise(res => {
      let done = false;
      const end = () => { if (!done) { done = true; res(); } };
      el.addEventListener('transitionend', e => { if (e.target === el && e.propertyName === 'transform') end(); });
      setTimeout(end, ms);
    });

    async function go(v) {
      v = Math.max(0, Math.min(nViews() - 1, v));
      if (busy) { queued = v > cur ? 1 : v < cur ? -1 : 0; return; }
      if (v === cur) return;
      busy = true;
      try {
        const fwd = v > cur;
        if (single || Math.abs(v - cur) !== 1) {
          // phone / jump: quick fade instead of a page turn
          book.classList.add('fb-fade');
          await Promise.all([sleep(170), ready(pagesFor(v).l ? [pagesFor(v).l, pagesFor(v).r] : [pagesFor(v).r])]);
          show(v, true);
          book.classList.remove('fb-fade');
        } else {
          const o = pagesFor(cur), n = pagesFor(v);
          await ready([o.l, o.r, n.l, n.r]);
          const leaf = document.createElement('div');
          leaf.className = 'fb-leaf ' + (fwd ? 'fwd' : 'back');
          leaf.append(makeFace(fwd ? o.r : o.l, false), makeFace(fwd ? n.l : n.r, true));
          spread.appendChild(leaf);
          if (fwd) setFace(R, n.r); else setFace(L, n.l);   // the page that is uncovered
          cur = v; layout(); ui();
          leaf.getBoundingClientRect();
          requestAnimationFrame(() => { leaf.style.transform = fwd ? 'rotateY(-180deg)' : 'rotateY(180deg)'; });
          await turned(leaf, FLIP_MS + 200);
          if (fwd) setFace(L, n.l); else setFace(R, n.r);
          requestAnimationFrame(() => leaf.remove());
          prefetch();
        }
      } finally {
        busy = false;
        if (queued) { const q = queued; queued = 0; go(cur + q); }
      }
    }

    /* ---------- controls ---------- */
    prevB.addEventListener('click', () => go(cur - 1));
    nextB.addEventListener('click', () => go(cur + 1));

    book.addEventListener('click', e => {
      const r = book.getBoundingClientRect(), x = (e.clientX - r.left) / r.width;
      (single ? x < 0.35 : x < 0.5) ? go(cur - 1) : go(cur + 1);
    });

    let sx = 0, sy = 0;
    book.addEventListener('touchstart', e => { sx = e.touches[0].clientX; sy = e.touches[0].clientY; }, { passive: true });
    book.addEventListener('touchend', e => {
      const dx = e.changedTouches[0].clientX - sx, dy = e.changedTouches[0].clientY - sy;
      if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) { go(cur + (dx < 0 ? 1 : -1)); e.preventDefault(); }
    });

    document.addEventListener('keydown', e => {
      if (!pdf || !(visible || document.fullscreenElement === root)) return;
      if (e.altKey || e.ctrlKey || e.metaKey || e.shiftKey) return;
      const t = e.target;
      if (t && (/^(INPUT|TEXTAREA|SELECT)$/.test(t.tagName) || t.isContentEditable)) return;
      if (e.key === 'ArrowRight') { e.preventDefault(); go(cur + 1); }
      else if (e.key === 'ArrowLeft') { e.preventDefault(); go(cur - 1); }
    });

    goIn.addEventListener('keydown', e => {
      if (e.key !== 'Enter') return;
      const p = Math.max(1, Math.min(total, parseInt(goIn.value, 10) || 1));
      goIn.value = '';
      goIn.blur();
      go(viewOf(p));
    });

    if (fsB) {
      if (!root.requestFullscreen) fsB.hidden = true;
      fsB.addEventListener('click', () => {
        if (document.fullscreenElement) document.exitFullscreen(); else root.requestFullscreen();
      });
      document.addEventListener('fullscreenchange', () => {
        const on = document.fullscreenElement === root;
        root.classList.toggle('is-full', on);
        const t = fsB.querySelector('.fb-fulltxt');
        if (t) t.textContent = on ? 'Exit full screen' : 'Full screen';
        fsB.classList.toggle('fb-exit', on);
      });
    }

    let rz;
    addEventListener('resize', () => {
      clearTimeout(rz);
      rz = setTimeout(() => {
        if (!pdf) return;
        const s = innerWidth <= MOBILE;
        if (s === single) return;
        const p = pagesFor(cur), page = p.l || p.r;
        single = s; root.classList.toggle('single', s);
        show(viewOf(page), true);
      }, 150);
    });

    new IntersectionObserver(es => { visible = es[0].isIntersecting; }, { threshold: 0.2 }).observe(root);

    /* ---------- start ---------- */
    async function init() {
      try {
        const lib = await loadLib();
        pdf = await lib.getDocument({ url }).promise;
        total = pdf.numPages;
        const first = await pdf.getPage(1);
        const vp = first.getViewport({ scale: 1 });
        root.style.setProperty('--r', (vp.height / vp.width).toFixed(4));
        single = innerWidth <= MOBILE;
        root.classList.toggle('single', single);
        show(0, true);
        await ready(pagesFor(0).r ? [pagesFor(0).r] : []);
        root.classList.add('ready');
        root.dataset.state = 'ready';
      } catch (err) {
        console.error(err);
        loading.textContent = 'Sorry, the catalogue could not be opened right now.';
        root.dataset.state = 'error';
      }
    }
    let started = false;
    new IntersectionObserver((es, io) => {
      if (es[0].isIntersecting && !started) { started = true; io.disconnect(); init(); }
    }, { rootMargin: '400px 0px' }).observe(root);
  }

  document.querySelectorAll('.flipbook').forEach(Flipbook);
})();
