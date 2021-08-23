<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-6">
                <b-button v-b-modal.modalPopover>Show Modal</b-button>

                <b-modal id="modalPopover" title="Modal with Popover" hide-footer>
                    <form @submit.prevent="updateProduct">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" v-model="product.name">
                        </div>
                        <div class="form-group">
                            <label>Detail</label>
                            <input type="text" class="form-control" v-model="product.detail">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </b-modal>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                product: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
                .then((response) => {
                    if(response.data.success == true) {
                        // console.log(response.data.data);
                        this.product = response.data.data;
                    } else {
                        this.$noty.error(response.data.message)
                        this.$router.push({ name: 'home' })
                    }
                })
                .catch(err => console.log(err));
        },
        methods: {
            updateProduct() {
                this.axios
                    .patch(`http://localhost:8000/api/products/${this.$route.params.id}`, this.product)
                    // .then((res) => {
                    //     this.$router.push({ name: 'home' });
                    // });
                    .then(response => {
                        if(response.data.success == true) {
                            this.$noty.success(response.data.message)
                            this.$router.push({ name: 'home' })
                        } else {
                            this.$noty.error(response.data.message)
                        }
                    });
            }
        }
    }
</script>
