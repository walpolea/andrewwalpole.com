var f=["eggplant","watermelon","yolk","berry","mintchip","peachtree","bloggy"],h=new IntersectionObserver((r,s)=>{r.forEach(i=>{i.isIntersecting&&(document.documentElement.classList.remove(...f),document.documentElement.classList.add(i.target.dataset.theme))})},{rootMargin:"0px",threshold:[.33,.66]});document.querySelectorAll("[data-theme]").forEach(r=>{h.observe(r)});import{createApp as u}from"https://unpkg.com/petite-vue?module";var p=({title:r})=>{let s="https://likes.walpolea.workers.dev/";return{title:r,likes:0,likeAdded:!1,async mounted(){console.log("mounted"),await this.loadLikes()},async loadLikes(){this.likes=(await(await fetch(`${s}?title=${this.title}`)).json()).likes},async postLike(){if(!this.likeAdded){let i=await(await fetch(s,{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json"},body:JSON.stringify({title:r})})).json();this.likes=i.likes,this.likeAdded=!0}}}};u({likes:p,$delimiters:["${","}"]}).mount();var t=document.querySelector(".h-track");if(t){t.classList.add("invisible-scrollbar");let r=t.querySelector(".h-content-container"),s=!1,i=t.offsetWidth,c=r.scrollWidth,l=e=>{isNaN(e)||t.setAttribute("data-scroll",e)},n=()=>{let e=t.scrollLeft/(c-i)*100;t.dataset.scrollPercent=e,document.documentElement.style.setProperty("--scroll-pct",`${t.dataset.scrollPercent}%`)};n(),window.addEventListener("resize",e=>{i=t.offsetWidth,c=r.scrollWidth,n()}),t.addEventListener("scroll",e=>{s||l(t.scrollLeft+e.deltaY+e.deltaX)}),t.addEventListener("wheel",e=>{s=!0,e.preventDefault();let o=e.deltaY%1==0?6:1.5;l(t.scrollLeft+e.deltaY*o+e.deltaX*o)});let m={top:0,left:0,x:0,y:0};window.addEventListener("keydown",e=>{e.key==="ArrowUp"||e.key==="ArrowLeft"?(s=!0,l(t.scrollLeft-100)):(e.key==="ArrowDown"||e.key==="ArrowRight")&&(s=!0,l(t.scrollLeft+100))}),document.querySelectorAll('a[href^="#"]').forEach(e=>{e.addEventListener("click",o=>{o.preventDefault();let d=document.querySelector(e.hash).offsetLeft;new URL(window.location).hash!==e.hash&&window.history.pushState({scrollLeft:d??0},"",e.hash),s=!0,l(d)})}),(()=>{let e=new URL(window.location);if(e.hash){let o=document.querySelector(e.hash).offsetLeft;window.history.pushState({scrollLeft:o??0},"",e.hash),s=!0,l(o)}})(),window.addEventListener("popstate",e=>{s=!0,e.state?.scrollLeft?l(e.state.scrollLeft):l(0)}),document.addEventListener("touchstart",e=>{s&&(s=!1)});let a=()=>{if(s){let e=parseFloat(t.getAttribute("data-scroll"))??0,o=e-t.scrollLeft;o>1||o<-1?t.scrollLeft+=o*.1:(t.scrollLeft=e,s=!1)}n(),requestAnimationFrame(a)};requestAnimationFrame(a)}
//# sourceMappingURL=main.js.map
