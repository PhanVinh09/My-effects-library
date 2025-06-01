<template>
  <div class="container">
    <h2>Header</h2>
     <div class="menu-icon" @click="toggleSidebar">
      ☰
    </div>
    <div class="sidebar" :class="{ open: sidebarOpen }">
      <ul>
        <li><a @click.prevent="setSelectedType('')">Đầu Trang</a></li>
        <li v-for="type in types" :key="type">
          <a @click.prevent="setSelectedType(type)" :class="{ active: selectedType === type }">
            {{ type }}
          </a>
        </li>
      </ul>
    </div>

    <div v-for="layout in allHoverLayouts" :key="layout.id" :ref="setLayoutRef(layout)" style="margin-bottom: 60px;">
      <layoutTabs :layout="layout" />
    </div>
  </div>
</template>

<script>
import layoutTabs from './layoutTabs.vue';
import layoutsData from '../data/layout.json';

export default {
  components: { layoutTabs },
  data() {
    return {
      selectedType: '',
      layoutRefs: {},
      sidebarOpen: false 
    };
  },
  computed: {
    allHoverLayouts() {
      const group = layoutsData.find((g) => g.category === 'Layout_Components');
      return group ? group.layout : [];
    },
    types() {
      const typesSet = new Set(this.allHoverLayouts.map((e) => e.type));
      return Array.from(typesSet);
    }
  },
  watch: {
    selectedType(newType) {
      if (!newType) return;
      this.$nextTick(() => {
        const ref = this.layoutRefs[newType];
        if (ref && ref[0]) {
          ref[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    }
  },
  methods: {
    setLayoutRef(layout) {
      return (el) => {
        if (!el) return;
        if (!this.layoutRefs[layout.type]) {
          this.layoutRefs[layout.type] = [];
        }
        this.layoutRefs[layout.type].push(el);
      };
    },
    setSelectedType(type) {
      this.selectedType = type;
      this.sidebarOpen = false; 
      if (type === '') {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    },
    toggleSidebar() {
      this.sidebarOpen = !this.sidebarOpen;
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

h2 {
  display: flex;
  justify-content: center;
  font-size: 40px;
  margin-bottom: 30px;
}

.filter {
  display: flex;
  gap: 15px;
  justify-content: center;
  margin-bottom: 40px;
}

.menu-icon {
  display: none;
  position: fixed;
  top: 5%;
  left: 20px;
  font-size: 28px;
  cursor: pointer;
  z-index: 3;
  background-color: #2c3e50;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
}

.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 250px;
  height: 100%;
  background-color: #2c3e50;
  color: white;
  padding-top: 40px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  z-index: 2;
}

.sidebar:hover {
  width: 300px;
}

.sidebar ul {
  margin-top: 100px;
  list-style-type: none;
  padding: 0;
}

.sidebar ul li {
  padding: 15px;
  text-align: center;
  transition: all 0.3s ease;
}

.sidebar ul li a {
  color: white;
  text-decoration: none;
  font-size: 18px;
  display: block;
  transition: all 0.3s ease;
  font-weight: bold;
  text-transform: uppercase;
  cursor: pointer;
}

.sidebar ul li a:hover {
  background-color: #16a085;
  color: #ecf0f1;
}

.sidebar ul li a.active {
  background-color: #34495e;
  color: #ecf0f1;
}

.sidebar ul li:hover {
  background-color: #34495e;
  transform: scale(1.1);
}
@media (max-width: 768px) {
  .sidebar {
    transform: translateX(-100%);
    width: 200px;
  }

  .sidebar.open {
    transform: translateX(0);
  }

  .menu-icon {
    display: block;
  }
}
</style>
