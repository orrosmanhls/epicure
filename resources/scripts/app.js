import { domReady } from "@roots/sage/client";

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  const isOnScreen = (element) => {
    const rect = element.getBoundingClientRect();
    const viewHeight = Math.max(
      document.documentElement.clientHeight,
      window.innerHeight
    );
    return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
  };

  const heroSearch = document.querySelector(".hero .hero-text .search");
  const headerSearch = document.querySelector(".header .header-right .search");
  document.addEventListener("scroll", (e) => {
    if (isOnScreen(heroSearch)) {
      headerSearch.style.display = "none";
    } else {
      headerSearch.style.display = "grid";
    }
  });

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
  const categories = Object.values(
    JSON.parse(document.getElementsByClassName("categories-value")[0].value)
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
      searchResults.style.display = "flex";

      const clearButton = event.target.parentNode.querySelector(".clear-btn");
      clearButton.style.display = "block";

      clearButton.addEventListener("click", () => {
        event.target.value = "";
        clearButton.style.display = "none";
      });

      if (event.target.value == "") {
        clearButton.style.display = "none";
        searchResults.style.display = "none";
      } else {
        clearButton.style.display = "block";
      }

      document.addEventListener("mousedown", (e) => {
        if (
          e.target != searchResults &&
          e.target != input &&
          !Array.from(searchResults.children).some((child) => child == e.target)
        ) {
          searchResults.style.display = "none";
        }

        if (e.target != clearButton && e.target != input) {
          clearButton.style.display = "none";
        }
      });

      input.addEventListener("focus", () => {
        // searchResults.style.display = "flex";
        clearButton.style.display = "block";
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

      searchResults.innerHTML =
        !searchData.restaurants &&
        !searchData.categories &&
        event.target.value != ""
          ? `<div class='no-data'>
      <h2>Hmmm...</h2>
      <p>We couldn't find any matches for "${event.target.value}"</p>
      </div>`
          : (searchData.restaurants ? searchData.restaurants : "") +
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

  const focusOnMobileSearch = () => {
    const searchInput = document.querySelector(
      ".mobile-search .search .search-input"
    );
    searchInput.focus();
  };

  document
    .querySelector(".header .header-right .search img")
    .addEventListener("click", () => {
      if (window.screen.width <= 768) {
        const search = document.querySelector(".mobile-search");
        search.style.display = "flex";
        document.body.style.overflow = "hidden";
        document.querySelector(".header").style.display = "none";
        focusOnMobileSearch();
      }
    });

  document
    .getElementById("mobile-search-close-btn")
    .addEventListener("click", () => {
      const menu = document.querySelector(".mobile-search");
      menu.style.display = "none";
      document.body.style.overflow = "initial";
      document.querySelector(".header").style.display = "flex";
    });
  let currentPos = window.pageYOffset;
  document.getElementById("mobile-menu-btn").addEventListener("click", () => {
    const menu = document.getElementById("mobile-menu");
    menu.style.display = "flex";
    window.scrollTo(0, 0);
    document.body.style.overflow = "hidden";
  });

  document
    .getElementById("mobile-menu-close-btn")
    .addEventListener("click", () => {
      const menu = document.getElementById("mobile-menu");
      menu.style.display = "none";
      document.body.style.overflow = "initial";
      window.scrollTo(0, currentPos);
    });

  document
    .querySelector(".hero .hero-text .search .search-input")
    .addEventListener("focus", () => {
      if (window.screen.width <= 768) {
        const search = document.querySelector(".mobile-search");
        search.style.display = "flex";
        document.body.style.overflow = "hidden";
        document.querySelector(".header").style.display = "none";
        focusOnMobileSearch();
      }
    });
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
