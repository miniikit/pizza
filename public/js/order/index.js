new Vue({
    el: '#app',


    ready: function() {
        this.getOrders();
    },


    methods: {

        getOrders: function() {

            this.$http.get('/pizzzzza/order/get', function (orders) {

                this.$set('orders', orders);

            });

        }
    }
});
