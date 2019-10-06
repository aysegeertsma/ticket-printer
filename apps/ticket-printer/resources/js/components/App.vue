<template>
    <div class="container">
        <div class="no-print">
            <titleBar />
        </div>
        <div class="no-print row">
            <sprint-selector v-on:sprintSelected="loadIssues" />
        </div>
        <div class="row">
            <ticket-display v-bind:tickets="issues" />
        </div>
    </div>
</template>


<script>
    import TitleBar from './TitleBar';
    import SprintSelector from './SprintSelector';
    import TicketDisplay from './TicketDisplay';

    export default {
        components: {
            TitleBar,
            SprintSelector,
            TicketDisplay
        },

        data: function() {
            return {
                issues: [],
            };
        },

        methods: {
            loadIssues(sprintId) {
                var self = this;

                this.issues = [];

                axios.get('/api/issues/' + sprintId)
                    .then(function (response) {
                        self.issues = response.data;
                    });

            }
        }
    }
</script>
