<template>
  <div>
    <h1>Danh sách hiệu ứng</h1>
    <ul>
      <li v-for="effect in effects" :key="effect.id">
        <strong>{{ effect.title }}</strong> - bởi {{ effect.author }}
      </li>
    </ul>
  </div>
</template>

<script>
import { getAllEffects } from '@/services/effectService'

export default {
  data() {
    return {
      effects: [],
    }
  },
  mounted() {
    getAllEffects()
      .then(res => {
        this.effects = res.data
      })
      .catch(e => console.error(e))
  },
}
</script>
