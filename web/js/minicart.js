// MiniCart
function MiniCart(id){

    this.id = id;

    this.item_template =
        '<li>\
            <span class="item">\
                <span class="item-left"> \
                    <img src="http://lorempixel.com/50/50/" alt="" /> \
                    <span class="item-info"> \
                        <span>{{qty}}x {{name}}</span> \
                        <span>{{price}}</span> \
                    </span> \
                </span> \
                <span class="item-right"> \
                    <button class="btn btn-xs btn-danger pull-right">x</button> \
                </span> \
            </span> \
        </li>\
        ';

    this.update = function(cart){
        var qtySum = 0;
        var priceSum = 0;

        //$(this.id).effect("highlight", {}, 3000);

        var currency = "";

        $(this.id + " .minicart-items li span.item").parent().remove();

        for(var i = cart.items.length - 1; i >= 0; i--){
            item = cart.items[i];

            formated_price = (item.price.amount / 100) + " " + item.price.currency;

            $(this.id + " .minicart-items li").first().before(
                this.item_template
                    .replace('{{price}}', formated_price)
                    .replace('{{name}}', item.name)
                    .replace('{{qty}}', item.qty)
            );

            qtySum += item.qty;
            priceSum += (item.qty * item.price.amount);
            currency = item.price.currency;
        }

        $(this.id + " .minicart-items-qty").text(qtySum);


    }

}