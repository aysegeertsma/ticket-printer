<template>
    <div class="ticket-content">
        <span v-for="n in tickets">
            <ticket :ticket="n"/>
        </span>
    </div>
</template>

<script>

    import Ticket from './Ticket';

    export default {

    components: {
        Ticket
    },

    props: {
        tickets: {
            type: Array,
            default: [],
        }
    }

}

</script>
