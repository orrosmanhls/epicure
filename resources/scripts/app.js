import { domReady } from "@roots/sage/client";

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  document
    .querySelector(".header .header-right .search img")
    .addEventListener("click", () => {
      const search = document.querySelector(".mobile-search");
      search.style.display = "flex";
      document.body.style.overflow = "hidden";
    });

  document
    .getElementById("mobile-search-close-btn")
    .addEventListener("click", () => {
      const menu = document.querySelector(".mobile-search");
      menu.style.display = "none";
      document.body.style.overflow = "initial";
    });

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

  document
    .querySelector(".hero .hero-text .search .search-input")
    .addEventListener("focus", () => {
      if (window.screen.width <= 768) {
        const search = document.querySelector(".mobile-search");
        search.style.display = "flex";
        document.body.style.overflow = "hidden";
      }
    });

  const restaurants = JSON.parse(
    document.getElementsByClassName("restaurants-value")[0].value
  );
  const categories = JSON.parse(
    document.getElementsByClassName("categories-value")[0].value
  );

  const inputs = document.getElementsByClassName("search-input");
  for (const input of inputs) {
    input.addEventListener("input", (event) => {
      const results = epicureSearch(
        event.target.value,
        restaurants,
        categories
      );

      const searchResults = event.target.nextElementSibling;

      input.addEventListener("blur", () => {
        searchResults.style.display = "none";
      });

      input.addEventListener("focus", () => {
        searchResults.style.display = "flex";
      });

      const searchData = {};

      if (results.restaurants.length > 0) {
        let restaurants = "";

        for (const restaurant of results.restaurants) {
          restaurants += `<div>${restaurant}</div>`;
        }

        searchData.restaurants = `<div class="result-type">Restaurants :</div>${restaurants}`;
      } else {
        searchData.restaurants = null;
      }

      if (results.categories.length > 0) {
        let categories = "";

        for (const category of results.categories) {
          categories += `<div>${category}</div>`;
        }

        searchData.categories = `<div class="result-type">Cuisine :</div>${categories}`;
      } else {
        searchData.categories = null;
      }

      searchResults.innerHTML =
        (searchData.restaurants ? searchData.restaurants : "") +
        (searchData.restaurants && searchData.categories
          ? "<div class='divider'></div>"
          : "") +
        (searchData.categories ? searchData.categories : "");
    });
  }

  const epicureSearch = (input, restaurants, categories) => {
    const results = {
      restaurants: [],
      categories: [],
    };
    if (input === "") {
      return results;
    }
    for (const restaurant of restaurants) {
      if (restaurant.name.toLowerCase().includes(input.toLowerCase())) {
        results.restaurants.push(restaurant.name);
      }
    }

    for (const category of categories) {
      if (category.name.toLowerCase().includes(input.toLowerCase())) {
        results.categories.push(category.name);
      }
    }

    return results;
  };
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
