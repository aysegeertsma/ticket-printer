<template>
    <div class="container sprint-selector">
        <div class="row">
            <dropdown dropdown-title="Boards" v-bind:list-options="boards" v-on:change="selectBoard" />
            <dropdown dropdown-title="Sprints" v-bind:list-options="sprints" v-on:change="selectSprint" />
        </div>
    </div>
</template>

<script>
    // todo:
    // Redesign wiring

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
                        response.data.forEach(function (item, key, fullArray) {
                            self.sprints.push({
                                'title': item.name,
                                'value': item.id,
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
