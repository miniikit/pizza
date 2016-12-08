
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

var app = new Vue({

    el: '#app',

    data: {
        orders: [],
        order_id: [],
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

            this.$http.post('/pizzzzza/order/destroy',this.detail.id).then(function (response) {


                this.orders.pop(this.order_id);
                this.detail = this.orders[0];

                this.deletedOrderAlert();

            });
        },

        success: function () {

            this.$http.post('/pizzzzza/order/success',this.detail.id).then(function (response) {


                this.orders.pop(this.order_id);
                this.detail = this.orders[0];

                this.successOrderAlert();

            });

        },

        newOrderAlert : function () {
            notif({
                msg: "新しい注文がありました。",
                type: "info",
                position: "right",
                bgcolor: "#e2e2e2",
                opacity: 1,
                width: 300,
                fade: true
            });
        },

        deletedOrderAlert : function () {
            notif({
                msg: "注文を破棄しました",
                type: "info",
                position: "right",
                bgcolor: "#c14646",
                opacity: 1,
                width: 300,
                fade: true
            });
        },

        showdetail: function (index) {

            this.$set(this,'order_id',index);

            this.detail = this.orders[index];

        }

    }
});
