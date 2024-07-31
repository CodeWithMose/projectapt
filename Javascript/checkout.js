document.addEventListener('DOMContentLoaded', () => {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const checkoutCart = document.getElementById('checkout-cart');
  const totalPriceElement = document.getElementById('total-price');

  if (cart.length === 0) {
      checkoutCart.innerHTML = '<p>No items in cart.</p>';
      return;
  }

  const ul = document.createElement('ul');
  cart.forEach((item) => {
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

  checkoutCart.appendChild(ul);

  const total = cart.reduce((sum, item) => sum + item.price, 0);
  totalPriceElement.textContent = `Ksh.${total.toFixed(2)}`;

  document.getElementById('confirm-checkout').addEventListener('click', () => {
      alert('Checkout confirmed!');
      localStorage.removeItem('cart');
      window.location.href = 'product2 check.html';
  });
});