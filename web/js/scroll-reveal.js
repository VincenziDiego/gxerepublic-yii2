document.addEventListener("DOMContentLoaded", function () {
  const scrollElements = document.querySelectorAll(".scroll-reveal");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("scrolled");
        }
      });
    },
    { threshold: 0.2 }
  );

  scrollElements.forEach((el) => observer.observe(el));
});

/* Aggiungi questo JavaScript nello scroll-reveal.js */
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".navbar-modern");
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
});

const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("scrolled");
      }
    });
  },
  {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }
);

document
  .querySelectorAll(".scroll-reveal")
  .forEach((el) => observer.observe(el));
