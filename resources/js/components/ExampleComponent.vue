<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{result}}</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    const url = '../api/status';
    export default {
        mounted() {
            axios.get(url).then(response => {
            this.result = response.data
          })
        }, 
        data(){
            return{
                result: 'test'
            }
        }
    }
</script>
