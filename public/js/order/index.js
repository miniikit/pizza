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

                if (this.orders.length != orders.body.length) {

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
                bgcolor: "#455A64",
                opacity: 1,
                width: 300,
                fade: true
            });
        },

        say: function (message) {
          alert(message)
        }

    }
});
