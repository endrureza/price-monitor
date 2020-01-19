<template>
    <div>
        <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-white">
            <inertia-link class="navbar-brand text-secondary" href="/">Price Monitor</inertia-link>
            <div class="input-group input-group-sm mx-auto col-md-6">
                <!-- <input type="text" class="form-control" placeholder="Search item..."> -->
                <!-- <div class="input-group-append">
                    <div class="input-group-text">Search</div>
                </div> -->
            </div>
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <inertia-link href="/create" class="btn btn-success btn-sm my-2 my-sm-0">Add New Product</inertia-link>
                </li>
            </ul>
        </nav>
        <div class="container">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: String,
        },
        watch: {
            title: {
                immediate: true,
                handler(title) {
                    document.title = title;
                }
            }
        }
    }
</script>

<style>

</style>
