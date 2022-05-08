import { domReady } from "@roots/sage/client";

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  document.getElementById("mobile-menu-btn").addEventListener("click", () => {
    const menu = document.getElementById("mobile-menu");
    menu.style.display = "flex";
    document.body.style.overflow = "hidden";
  });

  document
    .getElementById("mobile-menu-close-btn")
    .addEventListener("click", () => {
      const menu = document.getElementById("mobile-menu");
      menu.style.display = "none";
      document.body.style.overflow = "initial";
    });
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
