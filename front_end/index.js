const shoppingIcon = document.querySelector(".checkout");
const cartBox = document.querySelector(".cart-box");
const cartCloseBtn = document.querySelector(".cart-box svg");
const cardBoxTable = cartBox.querySelector("table");
let items = [];
window.onload = function () {
  shoppingIcon.addEventListener("click", function () {
    cartBox.classList.add("active");
    displayTable();
  });

  cartCloseBtn.addEventListener("click", function () {
    cartBox.classList.remove("active");
  });

  if (localStorage.getItem("items")) {
    try {
      items = JSON.parse(localStorage.getItem("items"));
      if (!Array.isArray(items)) {
        throw new Error("items is not an array");
      }
    } catch (error) {
      console.error(error);
      localStorage.removeItem("items");
    }
  }

  const addToCartButtons = document.getElementsByClassName("cart");
  for (let i = 0; i < addToCartButtons.length; i++) {
    addToCartButtons[i].addEventListener("click", function (e) {
      // let productId = i + 1;
      let item = {
        id: i + 1,
        name: e.target.parentElement.parentElement.parentElement.parentElement.querySelector(
          "h5"
        ).innerText,
        brand:
          e.target.parentElement.parentElement.parentElement.parentElement.querySelector(
            "span"
          ).innerText,
        productId: e.target.parentElement.parentElement.parentElement.parentElement.getAttribute("id")
      };
      console.log(items.hiddenInput);

      items.push(item);
      localStorage.setItem("items", JSON.stringify(items));
      shoppingIcon.querySelector("span").innerText = items.length;
    });
  }
};

function displayTable() {
  let tableData = "";
  if (items.length === 0) {
    tableData = "<tr class ='table'><td colspan='5'>No items found</td></tr>";
  } else {
    for (let i = 0; i < items.length; i++) {
      tableData += `<tr class ='ele${i}'><td>${i + 1}</td><td>${
        items[i].name
      }</td><td>${
        items[i].brand
      }</td><td><button class="delete-btn" onclick="deleteItem(${i})">Delete</button></td></tr>
      <input type="hidden" name="product_id" value='${items[i].productId}'>`;
    }
  }
  cardBoxTable.innerHTML = tableData;
}
function deleteItem(index) {
  items = JSON.parse(localStorage.getItem("items"));
  items.splice(index, 1);

  localStorage.setItem("items", JSON.stringify(items));
  document.querySelector(".checkout span").innerText = items.length;
  displayTable();
}
