/* =========================================================
   Apex Group template — shared JavaScript (all pages)
   Every block checks that its elements exist, so one file serves every page.
   ========================================================= */
(()=>{
const $=(s,c=document)=>c.querySelector(s),$$=(s,c=document)=>[...c.querySelectorAll(s)];
const reduce=matchMedia('(prefers-reduced-motion: reduce)').matches;

/* lift floor display follows the cabin */
(()=>{
  const q=s=>document.querySelector(s),cab=q('.cab'),shaft=q('.shaft'),disp=q('#floorNum');if(!cab||!shaft||!disp)return;
  setInterval(()=>{
    if(!shaft.offsetParent)return;
    const cr=cab.getBoundingClientRect(),sr=shaft.getBoundingClientRect();
    const range=sr.height-cr.height-28;if(range<=0)return;
    const ratio=Math.min(1,Math.max(0,(sr.bottom-14-cr.bottom)/range));
    const f=Math.round(ratio*11);disp.textContent=f===0?'G':f;
  },150);
})();

/* year */
const yr=$('#year');if(yr)yr.textContent=new Date().getFullYear();

/* preloader */
const pre=$('#preloader');
const hidePre=()=>pre&&pre.classList.add('hide');
let seen=null;try{seen=sessionStorage.getItem('pl')}catch(e){}
const MIN=seen?400:3300;          /* full logo animation only on the first page of a visit */
const t0=performance.now();
const finish=()=>setTimeout(hidePre,Math.max(0,MIN-(performance.now()-t0)));
if(document.readyState==='complete')finish();else addEventListener('load',finish);
setTimeout(hidePre,7000);
try{sessionStorage.setItem('pl','1')}catch(e){}

/* theme (remembered) */
const themeBtn=$('#themeBtn');
const setTheme=t=>{document.documentElement.dataset.theme=t;if(themeBtn)themeBtn.textContent=t==='dark'?'☀️':'🌙';try{localStorage.setItem('theme',t)}catch(e){}};
let saved=null;try{saved=localStorage.getItem('theme')}catch(e){}
setTheme('dark'); /* premium design is dark-only */
if(themeBtn)themeBtn.onclick=()=>setTheme(document.documentElement.dataset.theme==='dark'?'light':'dark');

/* header shadow, scroll progress, back-to-top */
const header=$('#header'),toTop=$('#toTop'),bar=$('#scrollBar');
const onScroll=()=>{
  if(header)header.classList.toggle('scrolled',scrollY>10);
  if(toTop)toTop.classList.toggle('show',scrollY>600);
  if(bar){const h=document.documentElement.scrollHeight-innerHeight;bar.style.width=(h>0?scrollY/h*100:0)+'%'}
};
addEventListener('scroll',onScroll,{passive:true});onScroll();
if(toTop)toTop.onclick=()=>scrollTo({top:0,behavior:'smooth'});

/* mobile menu + accordion sub-menus */
const burger=$('#burger'),nav=$('#nav');
if(burger&&nav)burger.onclick=()=>{burger.classList.toggle('open');nav.classList.toggle('open');document.body.style.overflow=nav.classList.contains('open')?'hidden':''};
$$('.menu a').forEach(a=>a.addEventListener('click',e=>{
  const li=a.parentElement;
  const hasSub=li.querySelector(':scope > .dropdown, :scope > .sub');
  if(a.getAttribute('href')==='#'){e.preventDefault()}
  if(innerWidth<=900&&hasSub){e.preventDefault();li.classList.toggle('open')}
}));

/* hero: text slider over the fixed photo */
const hero=$('.hero');
if(hero){
  const slides=$$('.slide',hero),dotsBox=$('#dots'),pbar=$('#progress');
  const DURATION=7000;let idx=0,start=null,raf,paused=false;
  slides.forEach((_,i)=>{const b=document.createElement('button');b.setAttribute('aria-label','Slide '+(i+1));b.onclick=()=>go(i);dotsBox.appendChild(b)});
  const dots=$$('button',dotsBox);
  function go(i){idx=(i+slides.length)%slides.length;slides.forEach((s,k)=>s.classList.toggle('active',k===idx));dots.forEach((d,k)=>d.classList.toggle('active',k===idx));restart()}
  function tick(t){
    if(start===null)start=t;
    if(!paused){const p=Math.min((t-start)/DURATION,1);pbar.style.width=p*100+'%';if(p>=1){go(idx+1);return}}
    else start=t-(parseFloat(pbar.style.width)||0)/100*DURATION;
    raf=requestAnimationFrame(tick);
  }
  function restart(){cancelAnimationFrame(raf);start=null;pbar.style.width='0';raf=requestAnimationFrame(tick)}
  $('#prev').onclick=()=>go(idx-1);$('#next').onclick=()=>go(idx+1);
  hero.addEventListener('mouseenter',()=>paused=true);hero.addEventListener('mouseleave',()=>paused=false);
  let sx=0;
  hero.addEventListener('touchstart',e=>sx=e.touches[0].clientX,{passive:true});
  hero.addEventListener('touchend',e=>{const d=e.changedTouches[0].clientX-sx;if(Math.abs(d)>50)go(idx+(d<0?1:-1))});
  go(0);

  /* mouse parallax */
  const lw=$('.lift-widget'),hb=$('.hero-bg');
  if(!reduce)hero.addEventListener('mousemove',e=>{
    const x=e.clientX/innerWidth-.5,y=e.clientY/innerHeight-.5;
    if(lw)lw.style.transform=`translate(${x*16}px,${y*12}px)`;
  });

  /* particles */
  const c=$('#particles');
  if(c&&!reduce){
    const ctx=c.getContext('2d');let W,H,pts=[],vis=true;
    const size=()=>{W=c.width=hero.clientWidth;H=c.height=hero.clientHeight;const n=Math.min(70,Math.floor(W/20));pts=Array.from({length:n},()=>({x:Math.random()*W,y:Math.random()*H,vx:(Math.random()-.5)*.35,vy:(Math.random()-.5)*.35,r:Math.random()*2+.8}))};
    size();addEventListener('resize',size);
    new IntersectionObserver(es=>vis=es[0].isIntersecting).observe(hero);
    (function draw(){
      if(vis){
        ctx.clearRect(0,0,W,H);
        for(const p of pts){p.x+=p.vx;p.y+=p.vy;if(p.x<0||p.x>W)p.vx*=-1;if(p.y<0||p.y>H)p.vy*=-1;ctx.beginPath();ctx.arc(p.x,p.y,p.r,0,6.283);ctx.fillStyle='rgba(255,203,107,.7)';ctx.fill()}
        for(let i=0;i<pts.length;i++)for(let j=i+1;j<pts.length;j++){
          const dx=pts[i].x-pts[j].x,dy=pts[i].y-pts[j].y,d=dx*dx+dy*dy;
          if(d<12000){ctx.strokeStyle=`rgba(125,200,255,${.22*(1-d/12000)})`;ctx.lineWidth=1;ctx.beginPath();ctx.moveTo(pts[i].x,pts[i].y);ctx.lineTo(pts[j].x,pts[j].y);ctx.stroke()}}
      }
      requestAnimationFrame(draw);
    })();
  }

  /* floor display follows the lift cabin */
  const cab=$('.cab'),shaft=$('.shaft'),disp=$('#floorNum');
  if(cab&&shaft&&disp)setInterval(()=>{
    const cr=cab.getBoundingClientRect(),sr=shaft.getBoundingClientRect();
    const range=sr.height-cr.height-28;if(range<=0)return;
    const ratio=Math.min(1,Math.max(0,(sr.bottom-14-cr.bottom)/range));
    const f=Math.round(ratio*11);disp.textContent=f===0?'G':f;
  },150);
}

/* marquees: duplicate content for a seamless loop */
['tick','track'].forEach(id=>{const t=document.getElementById(id);if(t)t.innerHTML+=t.innerHTML});

/* reveal on scroll, progress bars, counters */
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target)}}),{threshold:.12});
$$('.reveal').forEach(el=>io.observe(el));
const bio=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.style.width=e.target.dataset.w+'%';bio.unobserve(e.target)}}),{threshold:.5});
$$('.bar i').forEach(el=>bio.observe(el));
const counter=el=>{const end=+el.dataset.count,suf=el.dataset.suffix||'',t0=performance.now();
  (function step(t){const p=Math.min((t-t0)/1900,1),e=1-Math.pow(1-p,4);el.textContent=Math.floor(end*e).toLocaleString()+suf;if(p<1)requestAnimationFrame(step)})(t0)};
const cio=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){counter(e.target);cio.unobserve(e.target)}}),{threshold:.6});
$$('[data-count]').forEach(el=>cio.observe(el));

/* 3D tilt cards */
if(!reduce&&matchMedia('(hover:hover)').matches)$$('.tilt').forEach(card=>{
  card.addEventListener('mousemove',e=>{
    const r=card.getBoundingClientRect(),x=(e.clientX-r.left)/r.width-.5,y=(e.clientY-r.top)/r.height-.5;
    card.style.transform=`perspective(900px) rotateX(${-y*9}deg) rotateY(${x*11}deg) translateY(-8px)`;
  });
  card.addEventListener('mouseleave',()=>card.style.transform='');
});

/* filters (products / projects) */
$$('.filters').forEach(box=>{
  const grid=document.getElementById(box.dataset.target);if(!grid)return;
  $$('button',box).forEach(b=>b.addEventListener('click',()=>{
    $$('button',box).forEach(x=>x.classList.toggle('active',x===b));
    const f=b.dataset.f;
    $$('.item',grid).forEach(it=>{
      const show=f==='all'||it.dataset.cat===f;
      it.classList.toggle('hide',!show);
      if(show){it.style.opacity=0;it.style.transform='scale(.94)';requestAnimationFrame(()=>requestAnimationFrame(()=>{it.style.opacity=1;it.style.transform=''}))}
    });
  }));
});

/* testimonials */
const tmTrack=$('#tmTrack');
if(tmTrack){
  const n=tmTrack.children.length,tnav=$('#tmNav');let i=0,t;
  for(let k=0;k<n;k++){const b=document.createElement('button');b.setAttribute('aria-label','Testimonial '+(k+1));b.onclick=()=>{show(k);auto()};tnav.appendChild(b)}
  const bs=$$('button',tnav);
  function show(k){i=(k+n)%n;tmTrack.style.transform=`translateX(-${i*100}%)`;bs.forEach((b,x)=>b.classList.toggle('active',x===i))}
  function auto(){clearInterval(t);t=setInterval(()=>show(i+1),6000)}
  show(0);auto();
}

/* FAQ accordion */
const faqs=$$('.faq');
faqs.forEach(f=>f.firstElementChild.addEventListener('click',()=>{
  const open=f.classList.contains('open');
  faqs.forEach(x=>{x.classList.remove('open');x.querySelector('.ans').style.maxHeight=null});
  if(!open){f.classList.add('open');const a=f.querySelector('.ans');a.style.maxHeight=a.scrollHeight+'px'}
}));
if(faqs[0])faqs[0].firstElementChild.click();

/* lightbox */
const lb=$('#lightbox');
const closeLb=()=>{lb.classList.remove('open');document.body.style.overflow=''};
if(lb){
  const lbImg=$('#lbImg'),lbCap=$('#lbCap');
  $$('.gal').forEach(g=>g.addEventListener('click',()=>{
    lbImg.src=g.dataset.full;
    const b=g.querySelector('b'),s=g.querySelector('small');
    lbCap.textContent=(b?b.textContent:'')+(s?' — '+s.textContent:'');
    lb.classList.add('open');document.body.style.overflow='hidden';
  }));
  $('#lbClose').onclick=closeLb;lb.addEventListener('click',e=>{if(e.target===lb)closeLb()});
}

/* quote modal */
const modal=$('#modal');let lastFocus;
const closeM=()=>{modal.classList.remove('open');document.body.style.overflow='';lastFocus&&lastFocus.focus()};
if(modal){
  const openM=()=>{lastFocus=document.activeElement;modal.classList.add('open');document.body.style.overflow='hidden';setTimeout(()=>$('input',modal).focus(),150)};
  $$('[data-open-quote]').forEach(b=>b.addEventListener('click',openM));
  $('#closeModal').onclick=closeM;
  modal.addEventListener('click',e=>{if(e.target===modal)closeM()});
}
addEventListener('keydown',e=>{if(e.key==='Escape'){if(modal&&modal.classList.contains('open'))closeM();if(lb&&lb.classList.contains('open'))closeLb()}});

/* form validation */
const rules={name:v=>v.trim().length>1,email:v=>/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),phone:v=>/^[+()\d\s-]{7,}$/.test(v)};
function wire(form,onOk){
  if(!form)return;
  form.addEventListener('submit',ev=>{
    ev.preventDefault();let valid=true;
    $$('[data-v]',form).forEach(inp=>{const good=rules[inp.dataset.v](inp.value);inp.closest('.field').classList.toggle('invalid',!good);if(!good)valid=false});
    if(!valid)return;
    const tok=document.querySelector('meta[name=csrf-token]');
    fetch(form.action,{method:'POST',headers:{'X-CSRF-TOKEN':tok?tok.content:'','Accept':'application/json'},body:new FormData(form)})
      .then(r=>{if(!r.ok)throw new Error(r.status);onOk()})
      .catch(()=>alert('Sorry, we could not send your message. Please call us instead.'));
  });
  $$('input',form).forEach(i=>i.addEventListener('input',()=>i.closest('.field').classList.remove('invalid')));
}
const qf=$('#quoteForm');
wire(qf,()=>{const w=$('#formWrap'),ok=$('#formOk');w.style.display='none';ok.style.display='block';
  setTimeout(()=>{closeM();qf.reset();w.style.display='';ok.style.display='none'},2800)});
const cf=$('#contactForm');
wire(cf,()=>{const w=$('#cFormWrap'),ok=$('#cOk');w.style.display='none';ok.style.display='block';
  setTimeout(()=>{cf.reset();w.style.display='';ok.style.display='none'},3500)});
})();
