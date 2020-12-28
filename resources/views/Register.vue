<template>
  <div class="register">
    <div class="opacity"></div>
    <div class="title"><h1>Registro</h1></div>
    <div v-if="error" class="error-message">
      <p>{{ error }}</p>
    </div>
    <form
      autocomplete="off"
      @submit.prevent="register"
      method="post"
      enctype="multipart/form-data"
      class="register-form"
    >
      <div class="first">
        <div class="field">
          <label for="email">Email</label><br />
          <input
            type="email"
            class="input"
            placeholder="user@example.com"
            v-model="form.email"
          />
        </div>
        <div class="field">
          <label for="name">Nome</label><br />
          <input
            type="text"
            class="input"
            placeholder="John"
            v-model="form.name"
          />
        </div>
        <div class="field">
          <label for="surname">Apelido</label><br />
          <input
            type="text"
            class="input"
            placeholder="Doe"
            v-model="form.surname"
          />
        </div>
        <div class="field">
          <label for="password">Password</label><br />
          <input type="password" class="input" v-model="form.password" />
        </div>
        <button type="submit" class="">Inscreve-te</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        email: null,
        name: null,
        surname: null,
        password: null,
        error: null,
      },
    };
  },
  methods: {
    register() {
      axios
        .post("api/auth/signup", this.form)
        .then((response) => {
          const status = JSON.parse(response.data.response.status);
          this.$router.push({ name: "/" });
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
  },
};
</script>