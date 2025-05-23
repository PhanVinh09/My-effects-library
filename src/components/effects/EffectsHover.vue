<template>
  <div class="container">
    <h2>Hover Effects</h2>
    <div v-for="effect in hoverEffects" :key="effect.id" style="margin-bottom: 60px">
      <EffectTabs :effect="effect" />
    </div>
  </div>
</template>

<script>
import EffectTabs from './EffectTabs.vue';
import effectsData from '../data/effect.json';

export default {
  components: { EffectTabs },
  computed: {
    hoverEffects() {
      return effectsData.find(group => group.category === 'hover')?.effects || [];
    }
  }
};
</script>
<style scoped>
.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 40px 20px;
}
h2{
  display: flex;
  justify-content: center;
  font-size: 40px;
}
</style>
