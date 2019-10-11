<template>
    <div class="container">
        <div class="no-print">
            <titleBar />
        </div>
        <div class="no-print row">
            <sprint-selector v-on:sprintSelected="loadIssues" />
        </div>
        <div class="no-print row">
            <ticket-filter v-on:textFilterChange="filter" v-on:selectAll="selectAll" v-on:selectNone="selectNone" v-on:invertSelection="invertSelection" />
        </div>
        <div class="row">
            <ticket-display v-bind:issues="issues" />
        </div>
    </div>
</template>


<script>
    import axios from 'axios';

    import TitleBar from './TitleBar';
    import SprintSelector from './SprintSelector';
    import TicketFilter from './TicketFilter';
    import TicketDisplay from './TicketDisplay';
    import Issue from '../models/issue';
    import IssueFilter from '../models/issue-filter';

    export default {
        components: {
            TitleBar,
            SprintSelector,
            TicketFilter,
            TicketDisplay
        },

        data: function() {
            return {
                loadedIssues: [],
                issues: [],
            };
        },

        methods: {
            loadIssues(sprintId) {
                var self = this;

                this.loadedIssues = [];
                this.issues = [];

                axios.get('/api/issues/' + sprintId)
                    .then(function (response) {
                        response.data.forEach(function(value) {
                            self.issues.push(Issue.fromObject(value));
                            self.loadedIssues.push(Issue.fromObject(value));
                        });
                    });

            },

            selectAll() {
                this.issues.forEach(function(issue) {
                    issue.select();
                })
            },

            selectNone() {
                this.issues.forEach(function(issue) {
                    issue.deselect();
                })
            },

            invertSelection() {
                this.issues.forEach(function(issue) {
                    issue.toggleSelected();
                })
            },

            filter(string) {
                this.issues = IssueFilter.filter(string,this.loadedIssues);
            }
        }
    }
</script>
