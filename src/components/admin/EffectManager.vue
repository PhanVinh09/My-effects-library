<template>
  <div>
    <div class="table-container">
      <div class="table-header">
        <a class="btn-add" href="#" @click.prevent="openAddModal">Thêm hiệu ứng</a>
      </div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Effect Name</th>
            <th>Type</th>
            <th>Link</th>
            <th>HTML</th>
            <th>CSS</th>
            <th>JS</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="effect in effects" :key="effect.id">
            <td>{{ effect.id }}</td>
            <td>{{ effect.author }}</td>
            <td>{{ effect.title }}</td>
            <td>{{ effect.type }}</td>
            <td>{{ effect.link }}</td>
            <td>{{ effect.html }}</td>
            <td>{{ effect.css }}</td>
            <td>{{ effect.js }}</td>
            <td>
              <button class="action-btn btn-delete" @click="deleteEffect(effect.id)">Delete</button>
              <button class="action-btn btn-edit" @click="openEditModal(effect)">Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Add Modal -->
    <div v-if="showAddModal" class="modal" @click.self="closeModal">
      <div class="modal-content">
        <span class="close-btn" @click="closeModal">&times;</span>
        <h2>Thêm hiệu ứng mới</h2>
        <form @submit.prevent="saveNewEffect">
          <label>Author</label>
          <input v-model="newEffect.author" type="text" placeholder="Tên người làm..." required />
          <label>Effect Name</label>
          <input v-model="newEffect.title" type="text" placeholder="Tên hiệu ứng..." required />
          <label>Type</label>
          <input v-model="newEffect.type" type="text" placeholder="Loại hiệu ứng..." />
          <label>Link</label>
          <input v-model="newEffect.link" type="text" placeholder="Link CDN(nếu có)" />
          <label>HTML</label>
          <input v-model="newEffect.html" type="text" placeholder="HTML..." />
          <label>CSS</label>
          <input v-model="newEffect.css" type="text" placeholder="CSS..." />
          <label>JS</label>
          <input v-model="newEffect.js" type="text" placeholder="JS..." />
          <button type="submit" class="action-btn">Lưu</button>
        </form>
      </div>
    </div>

    <!-- Edit Modal -->
    <div v-if="showEditModal" class="modal" @click.self="closeModal">
      <div class="modal-content">
        <span class="close-btn" @click="closeModal">&times;</span>
        <h2>Sửa hiệu ứng</h2>
        <form @submit.prevent="saveEditEffect">
          <label>Author</label>
          <input v-model="editEffect.author" type="text" required />
          <label>Effect Name</label>
          <input v-model="editEffect.title" type="text" required />
          <label>Type</label>
          <input v-model="editEffect.type" type="text" />
          <label>Link</label>
          <input v-model="editEffect.link" type="text" />
          <label>HTML</label>
          <input v-model="editEffect.html" type="text" />
          <label>CSS</label>
          <input v-model="editEffect.css" type="text" />
          <label>JS</label>
          <input v-model="editEffect.js" type="text" />
          <button type="submit" class="action-btn">Lưu</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { getAllEffects } from '@/services/effectService'
import '@/assets/css/Admin.css'

export default {
  data() {
    return {
      effects: [],
      showAddModal: false,
      showEditModal: false,
      newEffect: {
        id: '',
        author: '',
        title: '',
        type: '',
        link: '',
        html: '',
        css: '',
        js: ''
      },
      editEffect: {}
    }
  },
  mounted() {
    this.fetchEffects()
  },
  methods: {
    fetchEffects() {
      getAllEffects()
        .then(res => {
          this.effects = res.data
        })
        .catch(e => console.error(e))
    },
    openAddModal() {
      this.resetNewEffect()
      this.showAddModal = true
    },
    openEditModal(effect) {
      this.editEffect = { ...effect }
      this.showEditModal = true
    },
    closeModal() {
      this.showAddModal = false
      this.showEditModal = false
    },
    resetNewEffect() {
      this.newEffect = {
        id: Date.now().toString(),
        author: '',
        title: '',
        type: '',
        link: '',
        html: '',
        css: '',
        js: ''
      }
    },
    saveNewEffect() {
      // Kiểm tra trùng id, hoặc gán id mới nếu muốn
      if (!this.newEffect.id) {
        this.newEffect.id = Date.now().toString()
      }
      this.effects.push({ ...this.newEffect })
      this.closeModal()
    },
    saveEditEffect() {
      const index = this.effects.findIndex(e => e.id === this.editEffect.id)
      if (index !== -1) {
        this.effects.splice(index, 1, { ...this.editEffect })
      }
      this.closeModal()
    },
    deleteEffect(id) {
      this.effects = this.effects.filter(e => e.id !== id)
    }
  }
}
</script>
