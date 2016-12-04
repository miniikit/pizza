var app = new Vue({

    el: '#app',

    data: {
        orders: []
    },

    created: function() {

        this.getOrders();
        setInterval(this.getOrders,5000);

    },

    methods: {

        getOrders: function() {

            this.$http.get('/pizzzzza/order/get').then(function (orders) {

                console.log(orders.body);
                this.orders = orders.body;
                // this.$set('orders', orders);
            });

        }

    }
});
