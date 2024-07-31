// Retrieve cart from localStorage or initialize an empty array
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Function to save cart to localStorage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to add item to the cart
function addToCart(productName, productPrice, productImage) {
    const product = { name: productName, price: productPrice, image: productImage };
    cart.push(product);
    saveCart();
    displayCart();
}

// Function to display cart items
function displayCart() {
    const cartContainer = document.getElementById('cart');
    cartContainer.innerHTML = '';

    if (cart.length === 0) {
        cartContainer.innerHTML = '<p>No items in cart.</p>';
        return;
    }

    const ul = document.createElement('ul');
    cart.forEach((item, index) => {
        const li = document.createElement('li');
        li.className = 'cart-item';

        const img = document.createElement('img');
        img.src = item.image;
        img.alt = item.name;

        const itemInfo = document.createElement('span');
        itemInfo.textContent = `${item.name} - Ksh.${item.price.toFixed(2)}`;

        li.appendChild(img);
        li.appendChild(itemInfo);
        ul.appendChild(li);
    });

    cartContainer.appendChild(ul);

    const total = cart.reduce((sum, item) => sum + item.price, 0);
    const totalElement = document.createElement('p');
    totalElement.textContent = `Total: Ksh.${total.toFixed(2)}`;
    cartContainer.appendChild(totalElement);

    // Update the cart count
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = cart.length;
    }
}

// Initialize cart display on page load
document.addEventListener('DOMContentLoaded', displayCart);

// Event listeners for adding to cart buttons
document.querySelectorAll('.add-to-cart-button').forEach(button => {
    button.addEventListener('click', () => {
        const productName = button.getAttribute('data-name');
        const productPrice = parseFloat(button.getAttribute('data-price'));
        const productImage = button.getAttribute('data-image');
        addToCart(productName, productPrice, productImage);
    });
});

// Shopping cart toggle functionality
let iconCart = document.querySelector('.icon-cart');
let closeCart = document.querySelector('.close');
let body = document.querySelector('body');

iconCart.addEventListener('click', () => {
    body.classList.toggle('shopcart');
});

closeCart.addEventListener('click', () => {
    body.classList.remove('shopcart');
});

// Checkout button event listener
document.getElementById('checkout-btn').addEventListener('click', () => {
  window.location.href = 'checkout.html';
});