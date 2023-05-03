"use strict";
const show = () => {
  const element = document.querySelector(".site-meme-wrapper");

  element.classList.add("site-meme-wrapper--visible");

  setTimeout(() => {
    element.classList.remove("site-meme-wrapper--visible");
    element.classList.add("site-meme-wrapper--leaving");
  }, 3000);

  setTimeout(() => {
    element.classList.remove("site-meme-wrapper--leaving");
  }, 3500);
};

const robux = () => {
  const element = document.querySelector(".site-meme-wrapper");

  element.classList.add("site-meme-wrapper--visible");

  element.innerHTML = `
  <img style="transform:translateY(-11rem);" src="img/robux.gif" width="100%" height="100%" />
  `;

  setTimeout(() => {
    element.classList.remove("site-meme-wrapper--visible");
    element.classList.add("site-meme-wrapper--leaving");
  }, 3000);

  setTimeout(() => {
    element.classList.remove("site-meme-wrapper--leaving");
  }, 3500);
};

const nuke = () => {
  const label = document.querySelector(".site-countdown__label");
  const header = document.querySelector(".site-countdown__header");
  const button = document.querySelector("#nuke_button");
  button.disabled = true;
  /** @type number | null */
  let flashTextInterval = null;
  /** @type number | null */
  let countDownInterval = null;
  /** @type number */
  let countDownTime = 15.0;

  label.style.color = "red";
  header.innerHTML = "ENABLED";
  header.style.color = "red";

  flashTextInterval = setInterval(() => {
    label.hidden = !label.hidden;
    header.hidden = !header.hidden;
  }, 300);

  setTimeout(() => {
    clearInterval(flashTextInterval);
    flashTextInterval = null;
    label.innerHTML = "WARHEAD COUNTDOWN";
    header.innerHTML = countDownTime;
    countDownInterval = setInterval(() => {
      countDownTime -= 0.01;
      if (countDownTime <= 0.0) {
        header.innerHTML = "DETONATED";
        label.innerHTML = "WARHEAD STATUS";
        document.documentElement.classList.add("animate-detonate");
        document
          .querySelector(".site-meme-wrapper")
          .classList.add("site-meme-wrapper--visible");
        document.querySelector(".site-meme-wrapper").innerHTML = `
        <img style="transform:translateY(-11rem);" src="img/nuke.gif" width="100%" height="100%" />
        `;
        clearInterval(countDownInterval);
        countDownInterval = null;
      } else {
        header.innerHTML = countDownTime.toFixed(2);
      }
    }, 10);
  }, 2000);
};
