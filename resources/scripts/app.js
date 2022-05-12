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
    document.querySelector(".header").style.display = "none";
  });

  document
    .getElementById("mobile-menu-close-btn")
    .addEventListener("click", () => {
      const menu = document.getElementById("mobile-menu");
      menu.style.display = "none";
      document.body.style.overflow = "initial";
      document.querySelector(".header").style.display = "flex";
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

      document.addEventListener("mousedown", (e) => {
        console.log(
          e.target != searchResults,
          Array.from(searchResults.children).some((child) => child == e.target)
        );

        if (
          e.target != searchResults &&
          !Array.from(searchResults.children).some((child) => child == e.target)
        ) {
          searchResults.style.display = "none";
        }
      });

      input.addEventListener("focus", () => {
        searchResults.style.display = "flex";
      });

      const searchData = {};

      if (results.restaurants.length > 0) {
        let restaurants = "";

        for (const restaurant of results.restaurants) {
          restaurants += `<a href='/coming-soon'>${restaurant}</a>`;
        }

        searchData.restaurants = `<div class="result-type">Restaurants :</div>${restaurants}`;
      } else {
        searchData.restaurants = null;
      }

      if (results.categories.length > 0) {
        let categories = "";

        for (const category of results.categories) {
          categories += `<a href='/coming-soon'>${category}</a>`;
        }

        searchData.categories = `<div class="result-type">Cuisine :</div>${categories}`;
      } else {
        searchData.categories = null;
      }
      console.log(searchData);
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
    console.log(results);
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
