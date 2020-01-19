<template>
    <layout title="Add new item">
        <div class="row mt-5">
            <div class="col-md-4">
                <h4 class="text-secondary">Product URL</h4>
                <p>
                    This is an fetching form of DOM designated for fabelio.com
                </p>
            </div>
            <div class="col-md-8">
                <form @submit.prevent="store">
                    <div class="form-group">
                        <label>Product Url</label>
                        <input v-model="data.url" name="url" type="text" class="form-control" placeholder="Paste url here...">
                        <template v-if="!is_saving">
                            <button class="btn btn-success btn-sm mt-3" type="submit">Add Product</button>
                        </template>
                        <template v-else>
                            <button class="btn btn-success btn-sm mt-3 disabled" type="submit">Adding Product...</button>
                        </template>
                    </div>
                </form>
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
        data() {
            return {
                data: {
                    url: '',
                },
                is_saving: false
            }
        },
        methods: {
            store() {
                this.is_saving = true;

                this.$inertia.post('/', this.data);
            }
        }
    }
</script>

<style>

</style>
