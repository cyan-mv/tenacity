<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!--                    <Welcome />-->
                    <div>
                        <h1>Your Teams</h1>
                        <p v-if="!teams.length">You don't have any teams.</p>
                        <ul>
                            <li v-for="team in teams" :key="team.id">
                                {{ team.name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
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
