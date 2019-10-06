<template>
    <div v-bind:class="['ticket-page-frame', { selected: isSelected }]" v-on:click="ticketClick">
        <div class="print-icon">
            <div class="print-icon-image"></div>
        </div>
        <div class="ticket-page-margin">
            <div class="header">
                <div class="title">{{ ticket.key }}</div>
                <div class="points">{{ ticket.points }}</div>
            </div>
            <div class="body">
                <div class="description" v-html="ticket.description">{{ ticket.description }}</div>
            </div>
            <div class="footer">
                <div class="logo-mini"></div>
                <div class="epic label">{{ ticket.epic }}</div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    props: {
        ticket: {
            type: Object,
            default: {},
        },
    },

    data: function() {
        return {
            isSelected: true,
        }
    },

    methods: {
        ticketClick: function() {
            console.log('click');
            this.isSelected = !this.isSelected;
        },
    },
}

</script>
