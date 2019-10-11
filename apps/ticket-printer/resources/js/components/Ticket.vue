<template>
    <div v-bind:class="['ticket-page-frame', { selected: issue.selected }]" v-on:click="ticketClick">
        <div class="print-icon">
            <div class="print-icon-image"></div>
        </div>
        <div class="ticket-page-margin">
            <div class="header">
                <div class="title">{{ issue.key }}</div>
                <div class="points">{{ issue.points }}</div>
            </div>
            <div class="body">
                <div class="description" v-html="issue.description">{{ issue.description }}</div>
            </div>
            <div class="footer">
                <div class="logo-mini"></div>
                <div class="epic label">{{ issue.epic }}</div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    props: {
        issue: {
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
            this.issue.toggleSelected();
        },
    },
}

</script>
