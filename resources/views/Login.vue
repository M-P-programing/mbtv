<template>
  <div class="login">
    <h1 class="">Login</h1>
    <div v-if="error">
      <p>{{ error }}</p>
    </div>
    <form
      autocomplete="off"
      @submit.prevent="login"
      method="post"
      class="login-form"
    >
      <div class="first">
        <div class="field">
          <label for="email">Email</label><br />
          <input
            type="email"
            class="input"
            placeholder="user@example.com"
            v-model="email"
          />
        </div>
        <div class="field">
          <label for="password">Password</label><br />
          <input type="password" class="input" v-model="password" />
        </div>
        <button type="submit" class="">Accede</button>
      </div>
      <div class="second">
        <img src="../images/banner.jpeg" alt="">
        <img src="../images/banner.jpeg" alt="">
        <img src="../images/banner.jpeg" alt="">
      </div>
    </form>
  </div>
</template>
<script>
import Navigation from "../js/components/Navigation.vue";

export default {
  components: {
    Navigation,
  },
  data() {
    return {
      email: null,
      password: null,
      error: null,
    };
  },
  methods: {
    login() {
      this.$store
        .dispatch("retrieveToken", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          this.$router.push({ name: "home" });
        })
        .catch((error) => {
          this.error = error.response.data;
        });
    },
  },
};
</script>