const navSlide = () => {
  const mobnav = document.querySelector(".mobnav");
  const nav = document.querySelector(".navlinks");

  mobnav.addEventListener("click", () => {
    nav.classList.toggle("navactive");
  });
};

navSlide();

targetElement.ontouchend = (e) => {
  e.preventDefault();
};
