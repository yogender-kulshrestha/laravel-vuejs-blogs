<template>
    <div>
        <h2 class="text-center">Products List</h2>

<!--        <v-data-table
            :headers="headers"
            :items="products"
            :items-per-page="10"
            :loading="loading" loading-text="Loading... Please wait"
            :search="search"
            :sort-desc="[true]"
            multi-sort
            class="elevation-1"
        ></v-data-table>-->
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Detail</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.detail }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: product.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                loading: null,
                error: null,
                headers: [
                    {
                        text: 'ID',
                        align: 'start',
                        sortable: false,
                        value: 'id',
                    },
                    { text: 'Name', value: 'name' },
                    { text: 'Detail', value: 'detail' },
                    { text: 'Actions', value: 'actions' },
                ],
                products : {

                }
                // products: [
                //
                // ]
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/products/')
                .then(response => {
                    if(response.data.success == true) {
                        this.products = response.data.data;
                    } else {
                        this.$noty.error(response.data.message)
                    }
                });
        },
        methods: {
            deleteProduct(id) {
                this.axios
                    .delete(`http://localhost:8000/api/products/${id}`)
                    .then(response => {
                        let i = this.products.map(data => data.id).indexOf(id);
                        this.products.splice(i, 1)
                        if(response.data.success == true) {
                            this.$noty.success(response.data.message)
                        } else {
                            this.$noty.error(response.data.message)
                        }
                    });
            }
        }
    }
</script>
