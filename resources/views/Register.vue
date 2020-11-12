<template>
  <div class="register">
    <h1>Register</h1>
     <div v-if="error" class="error-message">
      <p>{{ error }}</p>
    </div>
    <form
      autocomplete="off"
      @submit.prevent="register"
      method="post"
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
        <!-- <div>
         <label for="file">Imagem</label>
         <input 
         type="file"
         id="file"
         ref="file"
         v-on:change="handleFileUpload()"
         >
       </div> -->
        <button type="submit" class="">Accede</button>
      </div>
      <div class="second">
        <img src="../images/banner.jpeg" alt="" />
        <img src="../images/banner.jpeg" alt="" />
        <img src="../images/banner.jpeg" alt="" />
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
        error:null
        //file: null
      },
    };
  },
  methods: {
    register() {
      axios
        .post("api/auth/signup", this.form)
        .then((response) => {
           const status = 
        JSON.parse(response.data.response.status);
          console.log(status)
          this.$router.push({ name: "/" });
        })
        .catch((error) => {
           this.error = error.response.data.message;
        });
    },
  },

  // handleFileUpload(){
  //   this.file = this.$refs.file.files[0];
  // }
};
</script>