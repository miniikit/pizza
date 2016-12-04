var app = new Vue({

    el: '#app',

    data: {

        list: []
    },

    created: function() {

        this.getOrders();
        this.log();

    },

    methods: {

        getOrders: function() {

            this.$http.get('/pizzzzza/order/get', function (orders) {

                this.$set('orders', orders);

            });

        },

        log: function () {
            console.log('おっけーやで');
        }
    }
});
