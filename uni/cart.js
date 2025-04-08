let cart = [];

// Load cart from localStorage
function loadCartFromLocalStorage() {
    const savedCart = JSON.parse(localStorage.getItem("cart"));
    if (savedCart) {
        cart = savedCart;
        showCart();
        updateCartCount();
    }
}

// Save cart to localStorage
function saveCartToLocalStorage() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Function to add items to the cart
function addToCart(productName, price) {
    const existingProduct = cart.find(item => item.name === productName);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ name: productName, price: price, quantity: 1 });
    }
    saveCartToLocalStorage();
    updateCartCount();
}

// Function to update the cart count in the navbar
function updateCartCount() {
    const cartCount = cart.reduce((acc, item) => acc + item.quantity, 0);
    document.getElementById("cart-count").innerText = cartCount;
}

// Function to clear the cart
function clearCart() {
    cart = [];
    saveCartToLocalStorage();
    showCart();
    updateCartCount();
}

// Function to show cart items
function showCart() {
    let cartContent = '';
    let totalPrice = 0;
    
    cart.forEach(item => {
        totalPrice += item.price * item.quantity;
        cartContent += `
            <div>
                <h4>${item.name}</h4>
                <p>Price: $${item.price}</p>
                <p>Quantity: ${item.quantity}</p>
                <p>Total: $${(item.price * item.quantity).toFixed(2)}</p>
                <button onclick="removeItemFromCart('${item.name}')">Remove</button>
            </div>
        `;
    });

    cartContent += `<h3>Total Price: $${totalPrice.toFixed(2)}</h3>`;
    document.getElementById("cart-items-container").innerHTML = cartContent;
}

// Function to remove items from the cart
function removeItemFromCart(productName) {
    cart = cart.filter(item => item.name !== productName);
    saveCartToLocalStorage();
    showCart();
    updateCartCount();
}

// Call this function when the page loads
window.onload = function() {
    loadCartFromLocalStorage();
};
