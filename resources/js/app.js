import './bootstrap'; // Import any necessary Bootstrap or setup files
import { createApp } from 'vue';

// Import your Vue components
import LoginRegisterComponent from './components/LoginRegisterComponent.vue'; // This component handles both login and registration
import ProfileComponent from './components/ProfileComponent.vue';
import ParentMonitoringComponent from './components/ParentMonitoringComponent.vue';

// Create a Vue application instance
const app = createApp({});

// Register your components globally
app.component('login-register-component', LoginRegisterComponent); // Register the combined login/register component
app.component('profile-component', ProfileComponent); // Register the profile component
app.component('parent-monitoring-component', ParentMonitoringComponent); // Register the parent monitoring component

// Mount the Vue instance to an element with id `app`
app.mount('#app');
