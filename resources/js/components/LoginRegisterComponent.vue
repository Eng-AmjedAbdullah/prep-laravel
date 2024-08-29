<template>
    <div class="container" :class="{ 'sign-up-mode': !isLogin }">
      <div class="forms-container">
        <div class="signin-signup">
          <!-- Sign-in Form -->
          <form @submit.prevent="login" class="sign-in-form" v-if="isLogin">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" v-model="loginForm.email" placeholder="Email" required />
              <p class="error-message" v-if="errors.email">
                {{ errors.email }}
              </p>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" v-model="loginForm.password" placeholder="Password" required />
              <p class="error-message" v-if="errors.password">
                {{ errors.password }}
              </p>
            </div>
            <input type="submit" value="Login" class="btn" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon" @click.prevent="loginWithProvider('google')">
                <!-- Google SVG Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24px" height="24px">
                  <path fill="#4285F4" d="M23.92 14.72v8.56h11.9c-.48 2.4-1.88 4.44-3.94 5.78v4.8h6.32c3.7-3.4 5.82-8.38 5.82-14.14 0-1.02-.08-2.02-.22-3h-19.8z"></path>
                  <path fill="#34A853" d="M24 46c5.4 0 9.94-1.8 13.24-4.82l-6.32-4.8c-1.74 1.16-3.94 1.86-6.92 1.86-5.32 0-9.84-3.6-11.46-8.5H6.1v5.04C9.4 41.78 16.2 46 24 46z"></path>
                  <path fill="#FBBC05" d="M12.54 29.64a11.98 11.98 0 0 1-.64-3.64c0-1.26.22-2.48.64-3.64V17.3H6.1A19.8 19.8 0 0 0 4 24c0 2.74.5 5.38 1.9 7.7l6.64-5.06z"></path>
                  <path fill="#EA4335" d="M24 9.5c3.16 0 5.28 1.24 6.5 2.28L35.96 8C32.86 5.2 28.8 3.5 24 3.5 16.2 3.5 9.4 7.72 6.1 13.5l6.44 5.06C14.16 13.1 18.68 9.5 24 9.5z"></path>
                </svg>
              </a>
              <a href="#" class="social-icon" @click.prevent="loginWithProvider('facebook')">
                <!-- Facebook SVG Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                  <path fill="#3b5998" d="M24 12a12 12 0 1 0-13.848 11.901v-8.4h-2.83v-3.5h2.83v-2.678c0-2.798 1.65-4.339 4.178-4.339 1.21 0 2.477.217 2.477.217v2.719h-1.397c-1.377 0-1.806.86-1.806 1.74v2.342h3.064l-.49 3.5h-2.574v8.4A12 12 0 0 0 24 12z"></path>
                </svg>
              </a>
              <a href="#" class="social-icon" @click.prevent="loginWithProvider('apple')">
                <!-- Apple SVG Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                  <path fill="#000" d="M19.41 13.34c-.03-3.07 2.51-4.53 2.63-4.6-1.44-2.11-3.67-2.4-4.47-2.45-1.92-.19-3.75 1.12-4.72 1.12-.97 0-2.47-1.09-4.08-1.06-2.09.03-4.02 1.23-5.1 3.14-2.17 3.75-.55 9.29 1.55 12.35.92 1.34 2.02 2.84 3.45 2.79 1.39-.05 1.91-.9 3.58-.9s2.13.89 3.59.88c1.49-.02 2.42-1.36 3.33-2.71 1.04-1.51 1.46-2.99 1.48-3.07-.03-.01-2.84-1.09-2.87-4.31zM15.39 5.63c.82-.98 1.37-2.34 1.22-3.72-1.18.05-2.59.8-3.41 1.78-.75.88-1.4 2.26-1.23 3.6 1.29.09 2.6-.66 3.42-1.66z"></path>
                </svg>
              </a>
            </div>
          </form>

          <!-- Sign-up Form -->
          <form @submit.prevent="register" class="sign-up-form" v-else>
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" v-model="registerForm.username" placeholder="Username" required />
              <p class="error-message" v-if="errors.username">
                {{ errors.username }}
              </p>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" v-model="registerForm.email" placeholder="Email" required />
              <p class="error-message" v-if="errors.email">
                {{ errors.email }}
              </p>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" v-model="registerForm.password" placeholder="Password" required />
              <p class="error-message" v-if="errors.password">
                {{ errors.password }}
              </p>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" v-model="registerForm.password_confirmation" placeholder="Confirm Password" required />
              <p class="error-message" v-if="errors.password_confirmation">
                {{ errors.password_confirmation }}
              </p>
            </div>
            <div class="input-field">
              <i class="fas fa-calendar-alt"></i>
              <input type="number" v-model="registerForm.age" placeholder="Age" min="4" max="100" @input="checkAge" required />
              <p class="error-message" v-if="errors.age">
                {{ errors.age }}
              </p>
            </div>
            <div class="input-field" v-if="showParentEmail">
              <i class="fas fa-envelope"></i>
              <input type="email" v-model="registerForm.parent_email" placeholder="Parent's Email" />
              <p class="error-message" v-if="errors.parent_email">
                {{ errors.parent_email }}
              </p>
            </div>
            <input type="submit" class="btn" value="Sign up" />
          </form>
        </div>
      </div>

      <!-- Panels for sign-in/sign-up toggle -->
      <div class="panels-container">
        <div class="panel left-panel" v-if="isLogin">
          <div class="content">
            <h3>New here?</h3>
            <p>Join our community and start your safety journey today!</p>
            <button class="btn transparent" @click="toggleForm">
              Sign up
            </button>
          </div>
        </div>
        <div class="panel right-panel" v-else>
          <div class="content">
            <h3>One of us?</h3>
            <p>Welcome back! Sign in to continue your safety journey.</p>
            <button class="btn transparent" @click="toggleForm">
              Sign in
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  import { ref } from "vue";
  import { createClient } from "@supabase/supabase-js";

  const supabaseUrl = "https://fythiupuumejvdhgrzey.supabase.co";
  const supabaseAnonKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImZ5dGhpdXB1dW1lanZkaGdyemV5Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjQwNjg4MDgsImV4cCI6MjAzOTY0NDgwOH0.hIIOZAqCxVcdSD22dW76GSQNINHnr_OLAQET9bfSBa0"; // Your Supabase anon key
  const supabase = createClient(supabaseUrl, supabaseAnonKey);

  export default {
    setup() {
      const isLogin = ref(true);
      const showParentEmail = ref(false);
      const errors = ref({});

      const loginForm = ref({
        email: "",
        password: "",
      });

      const registerForm = ref({
        username: "",
        email: "",
        password: "",
        password_confirmation: "",
        age: null,
        parent_email: "",
      });

      const toggleForm = () => {
        isLogin.value = !isLogin.value;
        clearErrors();
      };

      const checkAge = () => {
        showParentEmail.value = registerForm.value.age < 13;
      };

      const clearErrors = () => {
        errors.value = {}; // Clear errors on form switch
      };

      const login = async () => {
        try {
          const { error } = await supabase.auth.signInWithPassword({
            email: loginForm.value.email,
            password: loginForm.value.password,
          });

          if (error) {
            console.error("Error logging in:", error.message);
            if (error.message.includes("invalid")) {
              errors.value.email = "Invalid email or password.";
              errors.value.password = "Invalid email or password.";
            } else {
              errors.value.general = error.message;
            }
          } else {
            window.location.href = "/profile";
          }
        } catch (e) {
          console.error("Unexpected error:", e);
          errors.value.general = "An unexpected error occurred. Please try again.";
        }
      };

      const register = async () => {
        clearErrors();
        try {
          const { data, error } = await supabase.auth.signUp({
            email: registerForm.value.email,
            password: registerForm.value.password,
          });

          if (error) {
            console.error("Error registering:", error.message);
            if (error.message.includes("rate limit")) {
              errors.value.email = "Too many requests. Please wait before trying again.";
            } else {
              errors.value.general = error.message;
            }
          } else {
            // Send notification email to parent
            if (registerForm.value.parent_email) {
              await sendParentNotification(
                registerForm.value.email,
                registerForm.value.username,
                registerForm.value.parent_email
              );
            }
            localStorage.setItem("supabase.auth.token", data.session.access_token);
            window.location.href = "/profile";
          }
        } catch (e) {
          console.error("Unexpected error:", e);
          errors.value.general = "An unexpected error occurred. Please try again.";
        }
      };

      const loginWithProvider = async (provider) => {
        const { error } = await supabase.auth.signInWithOAuth({ provider });

        if (error) {
          console.error("Error with social login:", error.message);
          alert("Error with social login: " + error.message);
        }
      };

      const sendParentNotification = async (childEmail, childUsername, parentEmail) => {
        try {
          await fetch("/send-parent-notification", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
              childEmail,
              childUsername,
              parentEmail,
            }),
          });
        } catch (error) {
          console.error("Error sending parent notification email:", error);
        }
      };

      return {
        isLogin,
        loginForm,
        registerForm,
        showParentEmail,
        errors,
        toggleForm,
        login,
        register,
        loginWithProvider,
        checkAge,
        clearErrors,
      };
    },
  };
  </script>

