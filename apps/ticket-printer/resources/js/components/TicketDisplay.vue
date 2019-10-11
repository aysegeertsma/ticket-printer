<template>
    <div class="ticket-content">
        <span v-for="i in issues">
            <ticket :issue="i"/>
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
        issues: {
            type: Array,
            default: [],
        }
    }

}

</script>
