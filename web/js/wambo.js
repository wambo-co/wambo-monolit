// Cart

function Cart(){

    this.items = [];

    /**
     * Init Cart from localStorage
     */
    this.init = function ()
    {
        var val = localStorage.getItem('cart');
        if(val != null) {
            this.items = JSON.parse(val).items;
        }
        console.log(this);
    };

    /**
     * Add an item to cart
     * @param cartItem
     */
    this.add = function (cartItem)
    {
        var newItem = true;
        $(this.items).each(function(index, item){
            if(item.sku == cartItem.sku){
                item.qty = item.qty + cartItem.qty;
                newItem = false;
            }
        });

        if(newItem){
            this.items.push(cartItem);
        }

        localStorage.setItem('cart', JSON.stringify(this));
    }
}

// CartItem
function CartItem(sku, qty, price, name) {
    this.sku = sku;
    this.qty = parseFloat(qty);
    this.price = price;
    this.name = name;
}

function Price(amount, currency) {
    this.amount = parseInt(amount);
    this.currency = currency;
}
