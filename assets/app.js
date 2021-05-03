/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

const newItem = (e) => {
  const collectionHolder = document.querySelector(e.currentTarget.dataset.collection);

  const item = document.createElement("div");
  item.classList.add("col-4");
  item.innerHTML = collectionHolder
    .dataset
    .prototype
    .replace(
      /__name__/g,
      collectionHolder.dataset.index
    );

  item.querySelector(".btn-remove").addEventListener("click", () => item.remove());

  collectionHolder.appendChild(item);

  collectionHolder.dataset.index++;
};

document
  .querySelectorAll('.btn-remove')
  .forEach(btn => btn.addEventListener("click", (e) => e.currentTarget.closest(".col-4").remove()));

document
  .querySelectorAll('.btn-new')
  .forEach(btn => btn.addEventListener("click", newItem));
