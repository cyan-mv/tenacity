<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
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
                    <!-- Display Teams -->
                    <div>
                        <h1>Your Teams</h1>
                        <p v-if="!teams.length">You don't have any teams.</p>
                        <ul>
                            <li v-for="team in teams" :key="team.id">
                                {{ team.name }}
                            </li>
                        </ul>
                    </div>

                    <!-- Display Groups -->
                    <div class="mt-8">
                        <h1> Avaliable groups </h1>
                        <p v-if="!groups.length">No groups available.</p>
                        <ul v-else>
                            <li v-for="group in groups" :key="group.id">
                                <strong>{{ group.description }}</strong>
                                (Code: {{ group.code }}, Prefix: {{ group.prefix }})
                                <div>
                                    <span
                                        :style="{ backgroundColor: group.color, display: 'inline-block', width: '20px', height: '20px', marginRight: '10px' }">
                                    </span>
                                    <img
                                        v-if="group.image"
                                        :src="`/storage/${group.image}`"
                                        alt="Group image"
                                        style="width: 50px; height: 50px; object-fit: cover;"
                                    />
                                </div>
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
        groups: Array, // Add groups as a prop
    },
    mounted() {
        console.log('User:', this.user);
        console.log('Teams:', this.teams);
        console.log('Groups:', this.groups);
    },
};
</script>
