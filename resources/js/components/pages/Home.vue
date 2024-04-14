<template>
    <br/>
    <div class="container text-center">
        <div class="row">
                <div class="mb-3 col-sm-8 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Generate shortcut URL</h3>
                            <div class="alert alert-success" role="alert" v-if="message" >
                                {{ message}}
                            </div>
                            <label for="url" class="form-label me-1 mt-2">URL</label>
                            <input type="text" id="url" class="form-control" v-model="url">
                            <p v-if="errors" v-for="url in errors.url" class="text-danger">{{ url}}</p>
                            <br/>
                            <button type="submit" class="btn btn-primary" @click="generateShortcutUrl">Submit</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<style >

</style>
<script>
export default  {
    data() {
        return {
            errors: [],
            url: '',
            message: ''
        }
    },
    methods: {
        generateShortcutUrl() {
            this.errors = [];
            this.message = '';
            axios.post('/api/generate-url', {
              'url': this.url
            })
                .then(response => {
                    this.message = response.data.message;
                    this.url = '';
                })
                .catch(error => {
                    console.log(error);
                    this.errors = error.response.data.errors;
                });
        }
    }
}
</script>
