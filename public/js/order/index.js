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

                if (this.orders != orders.body) {

                    this.orders = orders.body;
                    // this.$set('orders', orders);
                    
                    this.newOrderAlert();

                }
            });

        },

        newOrderAlert : function () {
            notif({
                msg: "新しい注文がありました。",
                type: "info",
                position: "right",
                bgcolor: "#75999f",
                opacity: 0.9,
                width: 300,
                fade: true
            });
        }

    }
});
