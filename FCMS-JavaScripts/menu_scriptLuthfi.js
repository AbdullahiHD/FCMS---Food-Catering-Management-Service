// Get DOM elements
let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCart = document.querySelector('.listCart');
let body = document.querySelector('body');
let total = document.querySelector('.total');

// Event listener to open shopping cart
openShopping.addEventListener('click', () => {
    body.classList.add('active');
});

// Event listener to close shopping cart
closeShopping.addEventListener('click', () => {
    body.classList.remove('active');
});

// Array of products with their details
let products = [
    {
        id: 1,
        name: 'Menu A',
        image: "1.PNG",
        price: 100
    },
    {
        id: 2,
        name: 'Menu B',
        image: '2.PNG',
        price: 100
    },
    {
        id: 3,
        name: 'Menu C',
        image: '3.PNG',
        price: 100
    }
];

// Array to store items in the cart
let listCarts = [];

// Function to initialize the application by populating the product list
function initApp() {
    products.forEach((value, key) => {
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="../FCMS-Assets/images${value.image}">
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCart(${key})">Add To Cart</button>`;
        list.appendChild(newDiv);
    });
}

// Call the initApp function to populate the product list
initApp();

// Function to add a product to the cart
function addToCart(key) {
    if (listCarts[key] == null) {
        // Copy product from the products list to the cart list
        listCarts[key] = JSON.parse(JSON.stringify(products[key]));
    }
    // Reload the cart with updated items
    reloadCart();
}

// Function to reload the cart and update total price 
function reloadCart() {
    listCart.innerHTML = '';
    let totalPrice = 0;
    listCarts.forEach((value, key) => {
        totalPrice = value.price;
        if (value != null) {
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="../FCMS-Assets/images/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                `;
            listCart.appendChild(newDiv);
        }
    });
    // Update total price cart
    total.innerText = totalPrice.toLocaleString();
}

