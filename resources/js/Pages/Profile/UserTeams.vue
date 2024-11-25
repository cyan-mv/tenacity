<template>
    <div>
        <h1>Your Teams</h1>
        <p v-if="!teams.length">You don't have any teams.</p>
        <ul>
            <li v-for="team in teams" :key="team.id">
                {{ team.name }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        user: Object,
        teams: Array,
    },
    mounted() {
        console.log('User:', this.user);
        console.log('Teams:', this.teams);
    },
};
</script>
