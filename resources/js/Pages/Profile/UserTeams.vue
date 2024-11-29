<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import { ref } from 'vue';
import axios from 'axios';

// Function to handle joining a group
const handleJoinGroup = async (groupId) => {
    try {
        const response = await axios.post('/user/join-group', {group_id: groupId});
        alert(response.data.message || 'Successfully joined the group!');
        location.reload(); // Refresh the page to update the user's groups
    } catch (error) {
        console.error('Error:', error.response ? error.response.data : error.message);
        alert(error.response?.data?.error || 'Failed to join the group. Please try again.');
    }
};
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
                    <!-- Your Groups Section -->
                    <div class="mt-8">
                        <h1>Your Groups</h1>
                        <p v-if="!userGroups.length">You don't belong to any groups.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" v-else>
                            <div v-for="group in userGroups" :key="group.id"
                                 class="card bg-base-100 image-full shadow-xl">
                                <figure>
                                    <img
                                        v-if="group.image"
                                        :src="`/storage/${group.image}`"
                                        alt="Group Image"
                                    />
                                </figure>
                                <div class="card-body">
                                    <h2 class="card-title">{{ group.description }}</h2>
<!--                                    <p>Code: {{ group.code }}, Prefix: {{ group.prefix }}</p>-->
                                    <p>Card Number: {{ group.pivot.card_number }}</p>
                                    <div class="card-actions justify-end">
                                        <button class="btn btn-primary">View Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Available Groups Section -->
                    <div class="mt-8">
                        <h1>Available Groups</h1>
                        <p v-if="!availableGroups.length">No groups available.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" v-else>
                            <div v-for="group in availableGroups" :key="group.id"
                                 class="card bg-base-100 image-full shadow-xl">
                                <figure>
                                    <img
                                        v-if="group.image"
                                        :src="`/storage/${group.image}`"
                                        alt="Group Image"
                                    />
                                </figure>
                                <div class="card-body">
                                    <h2 class="card-title">{{ group.description }}</h2>
                                    <p>Code: {{ group.code }}, Prefix: {{ group.prefix }}</p>
                                    <div class="card-actions justify-end">
                                        <button class="btn btn-secondary" @click="handleJoinGroup(group.id)">Join
                                            Group
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        userGroups: Array, // Groups specific to the user
        availableGroups: Array, // All available groups
    },
    mounted() {
        console.log('User:', this.user);
        console.log('Teams:', this.teams);
        console.log('User Groups:', this.userGroups); // Debugging "Your Groups"
        console.log('Available Groups:', this.availableGroups); // Debugging "Available Groups"
    },
};
</script>


