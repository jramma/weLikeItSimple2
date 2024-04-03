import domReady from "@roots/sage/client/dom-ready";
import Debug from "./debug.js";
import Swiper from "swiper";
import {Pagination, Navigation} from "swiper/modules";

/**
 * Application entrypoint
 */
domReady(async () => {
  /*
   * Application Code
   */

  // Set header height CSS var on resize and on load
  window.addEventListener("resize", (event) => {
    let headerHeight = document.querySelector("header").offsetHeight;
    document.documentElement.style.setProperty(
      "--header-height",
      `${headerHeight}px`
    );
  });
  window.dispatchEvent(new Event("resize"));

  const mySwiper = new Swiper(".mySwiper", {
    modules: [Pagination, Navigation],
    speed: 400,
    spaceBetween: 500,
    loop: true,
    //autoHeight: true,
    centeredSlides: true,
    pagination: {
      el: ".mySwiper-pagination",
      type: "bullets",
    },
    navigation: {
      nextEl: ".mySwiper-button-next",
      prevEl: ".mySwiper-button-prev",
    },
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
  });

  /**
   * Basics Scripts
   */
  // Development scripts
  if (
    typeof basics.wp_env !== "undefined" &&
    (basics.wp_env === "development" || basics.wp_env === "staging")
  ) {
    new Debug();
  }

});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
