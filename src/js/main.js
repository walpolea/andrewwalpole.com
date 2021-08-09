import "../css/main.scss";

// let isSmall = false;
// window.addEventListener("scroll", () => {
//   if (!isSmall && window.scrollY > 3) {
//     isSmall = true;
//     document.querySelector("header").style.setProperty("--header-min-height", "25vh");
//   } else if (window.scrollY <= 3) {
//     isSmall = false;
//     document.querySelector("header").style.setProperty("--header-min-height", "75vh");
//   }
// });

function updateScroll() {
  document.documentElement.style.setProperty("--scrollY", window.scrollY + "px");
  // console.log("SCROLL: ", window.scrollY, document.documentElement.style.getPropertyValue("--scrollY"));
}

window.addEventListener("scroll", () => {
  updateScroll();
});

updateScroll();
