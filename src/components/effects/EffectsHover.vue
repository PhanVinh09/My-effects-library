<template>
  <div>
    <EffectTabs :effect="myEffect" />
  </div>
</template>
<script>
import EffectTabs from './EffectTabs.vue';

export default {
  components: { EffectTabs },
  data() {
    return {
      myEffect: {
        title: "Hover Scale",
        html: "<div class='box'>Hover me</div>",
        css: ".box { transition: 0.3s; } .box:hover { transform: scale(1.2); }",
        js: ""
      }
    };
  }
};
</script>