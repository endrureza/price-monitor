<template>
    <layout title="Price Monitor">
        <div class="row mt-5">
            <div class="col-md-12 mb-3">
                <h4 class="text-secondary">
                    Product List
                </h4>
            </div>
        </div>
        <div class="row">
            <template v-if="products.length > 0">
                    <div class="col-md-12">
                        <div class="card-deck">
                            <template v-for="product in products">
                                <div class="col-md-3 my-3" :key="product.id">
                                    <div class="card">
                                        <img class="card-img-top" :src="product.image" alt="Card image cap">
                                        <div class="card-body">
                                            <inertia-link class="text-decoration-none text-dark" :href="'/product/' + product.slug">
                                                <h5 class="card-title">{{ product.name_ind }}</h5>
                                            </inertia-link>
                                            <h3 class="card-title">Rp. {{ product.price | convertToCurrency }}</h3>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-secondary">
                                                Last updated {{ product.last_updated | fromNow }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
            </template>
            <template v-else>
                <div class="col-md-12 text-center">
                    <h1 class="text-secondary mt-5">You have empty product</h1>
                    <inertia-link href="/create" class="btn btn-success btn-sm">Add New Product</inertia-link>
                </div>
            </template>
        </div>
    </layout>
</template>

<script>
    import Layout from './Layout';

    export default {
        components: {
            Layout,
        },
        props: ['products'],
        filters: {
            fromNow: function(val) {
                return moment(val).fromNow();
            },
            convertToCurrency: function(val) {
                return numeral(val).format('0,0')
            }
        }
    }
</script>

<style>

</style>
