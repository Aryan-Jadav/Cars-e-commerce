let itemsArray = ["1","1","1","1","1"];

const containers = document.querySelectorAll('#mainContainer');

containers.forEach(container => {
  const gridContainer = container.querySelector('#container');
  const items = gridContainer.children;

  itemsArray = new Array(items.length).fill("1");

  Array.prototype.forEach.call(items, item => {
    item.addEventListener('mouseover', function(event) {
      const itemId = Array.prototype.indexOf.call(items, item);
      itemsArray = new Array(items.length).fill("1");
      itemsArray[itemId] = 3;
      gridContainer.style.gridTemplateColumns = itemsArray.join("fr ") + "fr";
    });
  });

  Array.prototype.forEach.call(items, item => {
    item.addEventListener('mouseout', function(event) {
      itemsArray = new Array(items.length).fill("1");
      gridContainer.style.gridTemplateColumns = itemsArray.join("fr ") + "fr";
    });
  });
});
// Carousel
const carouselKenBurns = document.querySelector('#carouselKenBurns');
if (carouselKenBurns) {
  const firstAnimatingElems = carouselKenBurns.querySelectorAll('.carousel-item:first-child [data-animation^="animated"]');
  doAnimations(firstAnimatingElems);

  carouselKenBurns.addEventListener('slid.bs.carousel', (e) => {
    const animatingElems = e.relatedTarget.querySelectorAll("[data-animation^='animated']");
    doAnimations(animatingElems);
  });
}

function doAnimations(elems) {
  elems.forEach((elem) => {
    elem.classList.add('animate__animated', 'animate__flipInX');
    elem.addEventListener('animationend', () => {
      elem.classList.remove('animate__animated', 'animate__flipInX');
    });
  });
}

// Accordion
jQuery(document).ready(function(){
  jQuery('.titleWrapper').click(function(){
    var toggle = jQuery(this).next('div#descwrapper');
    if (toggle.length) {
      toggle.slideToggle("slow");
    }
  });
  jQuery('.inactive').click(function(){
    jQuery(this).toggleClass('inactive active');
  });
});

// Buy
const slider = document.querySelector('#priceSlider');
if (slider) {
  const display = document.querySelector('#sliderValue');
  const products = document.querySelectorAll('.product');

  slider.oninput = function() {
    const sliderValue = parseInt(this.value);
    if (isNaN(sliderValue)) return;
    display.textContent = `\$${sliderValue}`;

    products.forEach((product) => {
      const price = parseInt(product.dataset.price);
      if (isNaN(price)) return;
      if (sliderValue > parseInt(this.min) && sliderValue < parseInt(this.max)) {
        if (sliderValue >= price) {
          gsap.to(product, {autoAlpha: 1, scale: 1, duration: 0.5});
        } else {
          gsap.to(product, {autoAlpha: 0, scale: 0.8, duration: 0.5});
        }
      } else {
        gsap.to(product, {autoAlpha: 1, scale: 1, duration: 0.5});
      }
    });
  };
}

// news card page
$(function(){
  $(".post-module").hover(function(){
    $(this).find(".description").css("display", "block");
    $(this).find(".date").hide();
  }, function(){
    $(this).find(".description").css("display", "none");
    $(this).find(".date").show();
  });
});

// car details image
const lightbox = GLightbox({
  touchNavigation: true,
  loop: true,
  width: "90vw",
  height: "90vh"
});

// buy page

// ************************************************
// Shopping Cart API
// ************************************************

$(document).ready(function() {
  var shoppingCart = (function() {
    var cart = [];

    function Item(name, price, count) {
      this.name = name;
      this.price = price;
      this.count = count;
    }

    function saveCart() {
      sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    function loadCart() {
      cart = JSON.parse(sessionStorage.getItem('shoppingCart')) || [];
    }

    if (sessionStorage.getItem("shoppingCart") != null) {
      loadCart();
    }

    var obj = {};

    obj.addItemToCart = function(name, price, count) {
      var found = false;
      for (var i in cart) {
        if (cart[i].name === name) {
          cart[i].count += count;
          found = true;
          break;
        }
      }
      if (!found) {
        var item = new Item(name, price, count);
        cart.push(item);
      }
      saveCart();
    };

    obj.setCountForItem = function(name, count) {
      for (var i in cart) {
        if (cart[i].name === name) {
          cart[i].count = count;
          break;
        }
      }
      saveCart();
    };

    obj.removeItemFromCart = function(name) {
      for (var i in cart) {
        if (cart[i].name === name) {
          cart[i].count--;
          if (cart[i].count === 0) {
            cart.splice(i, 1);
          }
          break;
        }
      }
      saveCart();
    };

    obj.removeItemFromCartAll = function(name) {
      for (var i in cart) {
        if (cart[i].name === name) {
          cart.splice(i, 1);
          break;
        }
      }
      saveCart();
    };

    obj.clearCart = function() {
      cart = [];
      saveCart();
    };

    obj.totalCount = function() {
      var totalCount = 0;
      for (var i in cart) {
        totalCount += cart[i].count;
      }
      return totalCount;
    };

    obj.totalCart = function() {
      var totalCart = 0;
      for (var i in cart) {
        totalCart += cart[i].price * cart[i].count;
      }
      return Number(totalCart.toFixed(2));
    };

    obj.listCart = function() {
      var cartCopy = [];
      for (var i in cart) {
        var item = cart[i];
        var itemCopy = {};
        for (var p in item) {
          itemCopy[p] = item[p];
        }
        itemCopy.total = Number(item.price * item.count).toFixed(2);
        cartCopy.push(itemCopy);
      }
      return cartCopy;
    };

    return obj;
  })();

  // Event listeners
  $(document).on('click', '.add-to-cart', function(event) {
    event.preventDefault();
    var name = $(this).data('name');
    var price = Number($(this).data('price'));
    shoppingCart.addItemToCart(name, price, 1);
    displayCart();
  });

  $(document).on('click', '.clear-cart', function() {
    shoppingCart.clearCart();
    displayCart();
  });

  function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    for (var i in cartArray) {
      output += "<tr>"
        + "<td>" + cartArray[i].name + "</td>"
        + "<td>(" + cartArray[i].price + ")</td>"
        + "<td><div class='input-group'><button class='minus-item btn btn-primary' data-name='" + cartArray[i].name + "'>-</button>"
        + "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"
        + "<button class='plus-item btn btn-primary' data-name='" + cartArray[i].name + "'>+</button></div></td>"
        + "<td><button class='delete-item btn btn-danger' data-name='" + cartArray[i].name + "'>X</button></td>"
        + " = "
        + "<td>" + cartArray[i].total + "</td>"
        + "</tr>";
    }
    $('.show-cart').html(output);
    $('.total-cart').html(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
  }

  $(document).on('click', '.delete-item', function() {
    var name = $(this).data('name');
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
  });

  $(document).on('click', '.minus-item', function() {
    var name = $(this).data('name');
    shoppingCart.removeItemFromCart(name);
    displayCart();
  });

  $(document).on('click', '.plus-item', function() {
    var name = $(this).data('name');
    shoppingCart.addItemToCart(name, Number($(this).data('price')), 1);
    displayCart();
  });

  $(document).on('change', '.item-count', function() {
    var name = $(this).data('name');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
  });

  displayCart();
});

