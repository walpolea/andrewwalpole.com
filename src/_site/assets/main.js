(()=>{var t=document.querySelector(".h-track");if(t){t.classList.add("invisible-scrollbar");let l=t.querySelector(".h-content-container"),s=!1,c=t.offsetWidth,a=l.scrollWidth,r=e=>{isNaN(e)||t.setAttribute("data-scroll",e)},n=()=>{let e=t.scrollLeft/(a-c)*100;t.dataset.scrollPercent=e,document.documentElement.style.setProperty("--scroll-pct",`${t.dataset.scrollPercent}%`)};n(),window.addEventListener("resize",e=>{c=t.offsetWidth,a=l.scrollWidth,n()}),t.addEventListener("scroll",e=>{s||r(t.scrollLeft+e.deltaY+e.deltaX)}),t.addEventListener("wheel",e=>{s=!0,e.preventDefault();let o=e.deltaY%1==0?6:1.5;r(t.scrollLeft+e.deltaY*o+e.deltaX*o)});let u={top:0,left:0,x:0,y:0};window.addEventListener("keydown",e=>{e.key==="ArrowUp"||e.key==="ArrowLeft"?(s=!0,r(t.scrollLeft-100)):(e.key==="ArrowDown"||e.key==="ArrowRight")&&(s=!0,r(t.scrollLeft+100))}),document.querySelectorAll('a[href^="#"]').forEach(e=>{e.addEventListener("click",o=>{o.preventDefault();let d=document.querySelector(e.hash).offsetLeft;new URL(window.location).hash!==e.hash&&window.history.pushState({scrollLeft:d??0},"",e.hash),s=!0,r(d)})}),(()=>{let e=new URL(window.location);if(e.hash){let o=document.querySelector(e.hash).offsetLeft;window.history.pushState({scrollLeft:o??0},"",e.hash),s=!0,r(o)}})(),window.addEventListener("popstate",e=>{s=!0,e.state?.scrollLeft?r(e.state.scrollLeft):r(0)}),document.addEventListener("touchstart",e=>{s&&(s=!1)});let i=()=>{if(s){let e=parseFloat(t.getAttribute("data-scroll"))??0,o=e-t.scrollLeft;o>1||o<-1?t.scrollLeft+=o*.1:(t.scrollLeft=e,s=!1)}n(),requestAnimationFrame(i)};requestAnimationFrame(i)}var f=["eggplant","watermelon","yolk","berry","mintchip","peachtree"],h=new IntersectionObserver((l,s)=>{l.forEach(c=>{c.isIntersecting&&(document.documentElement.classList.remove(...f),document.documentElement.classList.add(c.target.dataset.theme))})},{rootMargin:"0px",threshold:.501});document.querySelectorAll("[data-theme]").forEach(l=>{h.observe(l)});})();
//# sourceMappingURL=main.js.map