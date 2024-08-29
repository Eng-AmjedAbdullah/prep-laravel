<template>
    <div>
        <h2>User Profile</h2>
        <div v-if="profile">
            <p><strong>Email:</strong> {{ profile.email }}</p>
            <p><strong>Age:</strong> {{ profile.age }}</p>
            <!-- Add more profile fields as needed -->
        </div>
    </div>
</template>

<script>
import { supabase } from "../supabase";
export default {
    data() {
        return {
            profile: null,
        };
    },
    async mounted() {
        const user = supabase.auth.user();
        if (user) {
            const { data: profile, error } = await supabase
                .from("profiles")
                .select("*")
                .eq("user_id", user.id)
                .single();

            if (error) console.error("Error fetching profile:", error.message);
            else this.profile = profile;
        }
    },
};
</script>
