var app = new Vue({

    el: '#app',

    data: {
        orders: [],
        detail: []
    },

    created: function() {


        this.init();
        setInterval(this.getOrders,5000);

    },

    methods: {

        init: function () {

            this.$http.get('/pizzzzza/order/get').then(function (orders) {

                this.orders = orders.body;

                this.$set(this,'detail',this.orders[0]);

            });

        },

        getOrders: function() {

            this.$http.get('/pizzzzza/order/get').then(function (orders) {

                if (this.orders.length != orders.body.length) {

                    this.orders = orders.body;

                    this.newOrderAlert();

                }
            });

        },

        destroy: function () {

            this.$http.post('/pizzzzza/order/destroy',this.detail).then(function (response) {

                console.log(this.detail);
                console.log(response);

            })


            this.detail = this.orders[0];
        },

        success: function () {

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

        showdetail: function (index) {

            this.detail = this.orders[index];

        }

    }
});
