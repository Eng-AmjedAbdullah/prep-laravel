<template>
    <div>
        <h2>Parent Monitoring</h2>
        <div v-if="children.length">
            <h3>Children</h3>
            <ul>
                <li v-for="child in children" :key="child.id">
                    {{ child.email }}
                </li>
            </ul>
        </div>
        <div v-else>
            <p>No children found.</p>
        </div>
    </div>
</template>

<script>
import { supabase } from "../supabase";
export default {
    data() {
        return {
            children: [],
        };
    },
    async mounted() {
        const user = supabase.auth.user();
        const { data: children, error } = await supabase
            .from("profiles")
            .select("*")
            .eq("parent_id", user.id);

        if (error) console.error("Error fetching children:", error.message);
        else this.children = children;
    },
};
</script>
