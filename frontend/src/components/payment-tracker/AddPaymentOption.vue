<template>
    <div class="col-md-4 custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" :id="`add-${name}`" v-model="showInput">
        <label class="custom-control-label" :for="`add-${name}`">Add new {{name}}</label>
        <transition name="fade">
            <div class="row d-flex align-items-center" v-if="showInput">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Title" v-model="title">
                </div>
                <div class="col-md-6">
                    <button type="button" class="my-3 btn btn-sm btn-outline-info waves-effect" @click="createPaymentOption()">Add</button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "AddPaymentOption",
        props: {
            name: {
                type: String,
                required: true
            },
            query: {
                type: Object,
                required: true
            },
            updateAction: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                showInput: false,
                title: ''
            }
        },
        methods: {
            createPaymentOption() {
                const {title} = this.$data
                this.$apollo.mutate({
                    mutation: this.query,
                    variables: {
                        title
                    }
                }).then(response => {
                    this.$snotify.success(`${this.title} saved`)
                    this.title = ''
                    // update category list with vuex
                    this.$store.dispatch(this.updateAction).then(() => console.log(`Updated ${this.name} list`))
                }).catch(error => {
                    this.$snotify.error(error.message)
                })
            }
        }
    }
</script>

<style scoped>

</style>