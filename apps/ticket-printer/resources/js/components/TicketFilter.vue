<template>
    <div class="container ticket-filter">
        <div class="row">
            <div class="col-1">
<!--                Find-->
            </div>
            <div class="col-8">
<!--                <input type="text">-->
            </div>
            <div class="col-1">
                Select
            </div>
            <div class="col-2">
                <button v-on:click="$emit('selectAll')">All</button> /
                <button v-on:click="$emit('invertSelection')">Invert</button> /
                <button v-on:click="$emit('selectNone')">None</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Dropdown from './Dropdown';

    export default {

        components: {
            Dropdown,
        },

        data: function() {
            return {
                boards: [],
                sprints: [],
                issues: [],
            }
        },

        methods: {
            loadBoards: function () {
                var self = this;

                self.boards = [];

                axios.get('/api/boards')
                    .then(function (response) {
                        response.data.forEach(function (item, key, fullArray) {
                            self.boards.push({
                                'title': item.name,
                                'value': item.id,
                            });
                        });
                    });
            },

            selectBoard: function(boardId) {
                this.loadSprints(boardId);
            },

            loadSprints: function(boardId) {
                var self = this;

                self.sprints = [];

                axios.get('/api/sprints/' + boardId)
                    .then(function (response) {
                        response.data.forEach(function (value) {
                            self.sprints.push({
                                'title': value.name,
                                'value': value.id,
                            });
                        });
                    });
            },

            selectSprint: function(sprintId) {
                this.$emit('sprintSelected', sprintId)
//                this.loadIssues(sprintId);
            },
        },

        mounted() {
            // load boards
            this.loadBoards();

            // listen to board changes and reload sprints

            // listen to sprint changes and reload issues
        }

    }

</script>
