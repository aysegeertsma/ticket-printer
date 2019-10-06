<template>
    <div class="col-md-6 col-sm-12">
        <div class="row">
            <div class="col-12"><h4>{{dropdownTitle}}</h4></div>
<!--            <div class="col-5">reload</div>-->
        </div>
        <div class="row">
            <div class="col-12"><select :disabled="listOptions.length < 1" v-on:change="$emit('change', $event.target.value)">
                <option>Choose an option</option>
                <option v-for="option in listOptions" :value="option.value">{{option.title}}</option>
            </select></div>
        </div>
    </div>
</template>


<script>

    export default {

        props: {
            dropdownTitle: {
                type: String,
            },

            listOptions: {
                type: Array,
                default: [],
            }
        },

        mounted() {
            console.log(this.options);
        },

    }


</script>
