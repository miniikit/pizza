
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
        setInterval(this.getOrders,10000);

    },

    methods: {

        init: function () {

            this.$http.get('/pizzzzza/order/get').then(function (orders) {

                this.$set(this,'orders',orders.body);

                if (this.orders.length) {
                    this.$set(this,'detail',this.orders[0]);
                }else {
                    this.$set(this,'detail',null);
                }
            });

        },

        getOrders: function() {

            this.$http.get('/pizzzzza/order/get').then(function (orders) {

                if (this.orders.length < orders.body.length) {

                    this.$set(this,'orders',orders.body);

                    if (this.orders.length) {
                        this.$set(this,'detail',this.orders[0]);
                    }else {
                        this.$set(this,'detail',null);
                    }

                    this.newOrderAlert();

                }else if (this.orders.length > orders.body.length) {
                    console.log('えらー');
                }
            });

        },

        showdetail: function (index) {

            this.$set(this,'order_id',index);

            this.detail = this.orders[index];

        },

        destroy: function () {

            var loading = document.querySelector('#loading');
            loading.style.display = 'block';

            this.$http.post('/pizzzzza/order/destroy',this.detail.id).then(function (response) {


                this.orders.pop(this.order_id);
                this.detail = this.orders[0];


                var self = this;

                setTimeout(function () {

                    self.getOrders();

                    loading.style.display = 'none';
                    self.deletedOrderAlert();

                },2000);



            });
        },

        success: function () {

            var loading = document.querySelector('#loading');
            loading.style.display = 'block';


            this.$http.post('/pizzzzza/order/success',this.detail.id).then(function (response) {


                this.orders.pop(this.order_id);
                this.detail = this.orders[0];

                var self = this;

                setTimeout(function () {

                    self.getOrders();

                    loading.style.display = 'none';
                    self.successOrderAlert();

                },2000);

            });

        },

        newOrderAlert : function () {
            notif({
                msg: "新しい注文がありました。",
                type: "info",
                position: "right",
                bgcolor: "#2c485b",
                opacity: 1,
                width: 300,
                fade: true
            });
        },

        successOrderAlert : function () {
            notif({
                msg: "注文を完了しました。",
                type: "info",
                position: "right",
                bgcolor: "#2c485b",
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
        }

    }
});
