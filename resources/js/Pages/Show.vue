<template>
    <layout :title="'Product' + product.name_ind">
        <div class="row mt-5">
            <div class="col-md-4">
                <img :src="product.image" class="img-fluid mb-3" :alt="product.name_ind">
                <canvas id="price-chart" width="400" height="400"></canvas>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-secondary">{{ product.name_ind }}</h5>
                        <h6 class="text-secondary">{{ product.name_eng }}</h6>
                        <small class="text-secondary">Last updated {{ product.last_updated | fromNow }}</small>
                        <hr>
                    </div>
                    <div class="col-md-12 my-2">
                        <label class="font-weight-bold" for="">Harga</label>
                        <h4 class="text-danger">Rp. {{ product.price | convertToCurrency }}</h4>
                        <hr>
                    </div>
                    <div class="col-md-12 my-2">
                        <label class="font-weight-bold" for="">Tentang Produk</label>
                        <p>
                            <span v-html="product.description"></span>
                        </p>
                        <hr>
                    </div>
                    <div class="col-md-12 my-2">
                        <label class="font-weight-bold" for="">Spesifikasi Produk</label>
                        <p>
                            <span v-html="product.additional_info"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
    import Layout from './Layout';

    export default {
        components: {
            Layout,
        },
        props: ['product','slug'],
        filters: {
            fromNow: function(val) {
                return moment(val).fromNow();
            },
            convertToCurrency: function(val) {
                return numeral(val).format('0,0')
            }
        },
        mounted() {
            var ctx = document.getElementById('price-chart').getContext('2d');

            let labels = [];
            let graphData = [];

            this.product.histories.forEach(function(item,index) {
                labels.push(moment(item.created_at).format('MMM DD YYYY HH:mm'));
                graphData.push(item.price);
            });

            let data = {
                labels: labels,
                datasets: [{
                    label: 'Price History',
                    data: graphData,
                    borderWidth: 2,
                    borderColor: '#69d6c0',
                    borderCapStyle: 'square',
                    backgroundColor: '#ddf7f1'
                }]
            };

            new Chart(ctx, {
                type: 'line',
                data: data
            });
        }
    }
</script>

<style>

</style>
