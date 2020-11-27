<template>
  <div>
    <section class="section">
      <main>
        <router-view></router-view>
      </main>
    </section>
  </div>
</template>

<script>
import Navigation from '../js/components/Navigation.vue';
export default {
  components: { Navigation },};
</script>