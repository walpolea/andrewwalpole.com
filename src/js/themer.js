//Color changing sections
const themes = ["eggplant", "watermelon", "yolk", "berry", "mintchip", "peachtree", "bloggy"];

const themeObserver = new IntersectionObserver(
  (entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        document.documentElement.classList.remove(...themes);
        document.documentElement.classList.add(entry.target.dataset.theme);
      }
    });
  },
  {
    rootMargin: "0px",
    threshold: [0.33, 0.66],
  }
);

document.querySelectorAll("[data-theme]").forEach((changer) => {
  themeObserver.observe(changer);
});
