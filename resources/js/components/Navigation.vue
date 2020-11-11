<template>
  <div>
    <ul>
      <li>
        <router-link :to="{ name: 'register' }" class="link">Register</router-link>
      </li>
       <li>
        <router-link :to="{ name: 'login' }">Login</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {};
</script>
<style scoped lang='scss'>
  li{
    a{
      color:green;
    }
  }
</style>