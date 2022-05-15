import "../css/main.scss";
import "../css/blog.scss";

import "./themer.js";
import { createApp } from 'https://unpkg.com/petite-vue?module';

import {likes} from "./likes.js";
import {blog} from "./blog-filter.js";

createApp({likes, blog, $delimiters: ['[{', '}]']}).mount();

const track = document.querySelector(".h-track");

if (track) {
  track.classList.add("invisible-scrollbar");
  const trackContainer = track.querySelector(".h-content-container");

  let registeredScroll = false;
  let outerWidth = track.offsetWidth;
  let innerWidth = trackContainer.scrollWidth;

  const updateScroll = (val) => {
    if (!isNaN(val)) {
      track.setAttribute("data-scroll", val);
    }
  };

  const updatePct = () => {
    const pct = (track.scrollLeft / (innerWidth - outerWidth)) * 100;

    track.dataset.scrollPercent = pct;
    document.documentElement.style.setProperty("--scroll-pct", `${track.dataset.scrollPercent}%`);
  };
  updatePct();

  window.addEventListener("resize", (e) => {
    outerWidth = track.offsetWidth;
    innerWidth = trackContainer.scrollWidth;
    updatePct();
  });

  track.addEventListener("scroll", (evt) => {
    if (!registeredScroll) {
      updateScroll(track.scrollLeft + evt.deltaY + evt.deltaX);
    }
  });

  track.addEventListener("wheel", (evt) => {
    registeredScroll = true;
    evt.preventDefault();
    const tpMultiplier = evt.deltaY % 1 === 0 ? 6 : 1.5;
    updateScroll(track.scrollLeft + evt.deltaY * tpMultiplier + evt.deltaX * tpMultiplier);
  });

  let pos = { top: 0, left: 0, x: 0, y: 0 };

  window.addEventListener("keydown", (e) => {
    if (e.key === "ArrowUp" || e.key === "ArrowLeft") {
      registeredScroll = true;
      updateScroll(track.scrollLeft - 100);
      // track.setAttribute('data-scroll', track.scrollLeft - 100)
    } else if (e.key === "ArrowDown" || e.key === "ArrowRight") {
      registeredScroll = true;
      updateScroll(track.scrollLeft + 100);
    }
  });

  document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener("click", (e) => {
      e.preventDefault();

      const offsetLeft = document.querySelector(a.hash).offsetLeft;

      const url = new URL(window.location);
      if (!(url.hash === a.hash)) {
        window.history.pushState({ scrollLeft: offsetLeft ?? 0 }, "", a.hash);
      }
      registeredScroll = true;
      updateScroll(offsetLeft);
    });
  });

  const initLoad = () => {
    const url = new URL(window.location);
    if (url.hash) {
      const offsetLeft = document.querySelector(url.hash).offsetLeft;
      window.history.pushState({ scrollLeft: offsetLeft ?? 0 }, "", url.hash);
      registeredScroll = true;
      updateScroll(offsetLeft);
    }
  };
  initLoad();

  window.addEventListener("popstate", (e) => {
    registeredScroll = true;
    if (e.state?.scrollLeft) {
      updateScroll(e.state.scrollLeft);
    } else {
      updateScroll(0);
    }
  });

  document.addEventListener("touchstart", (e) => {
    if (registeredScroll) {
      registeredScroll = false;
    }
  });

  //   const mouseDownHandler = (e) => {
  //     registeredScroll = true;

  //     track.style.cursor = 'grabbing';
  //     track.style.userSelect = 'none';

  //     pos = {
  //       left: track.scrollLeft,
  //       x: e.clientX ?? e.touches?.[0]?.clientX + e.touches?.[0]?.clientY ?? 0,
  //     };

  //     document.addEventListener('mousemove', mouseMoveHandler);
  //     document.addEventListener('mouseup', mouseUpHandler);

  //   };

  //   const mouseMoveHandler = (e) => {
  //     registeredScroll = true;

  //     const cx = e.clientX ?? e.touches?.[0]?.clientX + e.touches?.[0]?.clientY ?? 0
  //     const dx = cx - pos.x;
  //     updateScroll(pos.left - dx);
  //     // track.setAttribute('data-scroll', pos.left - dx)
  //   };

  //   const mouseUpHandler = () => {
  //     document.removeEventListener('mousemove', mouseMoveHandler);
  //     document.removeEventListener('mouseup', mouseUpHandler);

  //     track.style.cursor = 'grab';
  //     track.style.removeProperty('user-select');
  //   };

  //   track.addEventListener('mousedown', mouseDownHandler);

  const update = () => {
    if (registeredScroll) {
      const toX = parseFloat(track.getAttribute("data-scroll")) ?? 0;
      const dx = toX - track.scrollLeft;

      if (dx > 1 || dx < -1) {
        track.scrollLeft += dx * 0.1;
      } else {
        track.scrollLeft = toX;
        registeredScroll = false;
      }
    }
    updatePct();
    requestAnimationFrame(update);
  };

  requestAnimationFrame(update);
}

//Color changing sections

