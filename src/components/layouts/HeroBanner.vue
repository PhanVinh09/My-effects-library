<template>
  <div class="container">
    <h2>HeroBanner Layout</h2>
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

    <!-- Loading text -->
    <div v-if="loading" style="text-align: center; font-size: 20px; margin-top: 40px;">
      Đang tải...
    </div>

    <!-- List Layouts -->
    <div v-for="type in types" :key="type">
      <h3 class="group-title">{{ type.toUpperCase() }}</h3>

      <div v-for="(layout, index) in LayoutsByType(type)" :key="layout.id" :ref="setLayoutRef(layout)"
        class="layout-item" :data-layout-id="layout.id" :data-layout-type="layout.type"
        :style="{ animationDelay: `${index * 150}ms` }">
        <LayoutTabs :layout="layout" :index="index" />
      </div>
    </div>

  </div>
</template>

<script>
import LayoutTabs from './layoutTabs.vue';
const backendUrl = import.meta.env.VITE_BACKEND_URL;

export default {
  components: { LayoutTabs },
  data() {
    return {
      LayoutsData: [],
      types: [],
      selectedType: '',
      layoutRefs: {},
      sidebarOpen: false,
      loading: true,
    };
  },
  created() {
    this.fetchLayouts();
  },
  computed: {
    allLayouts() {
      return this.LayoutsData.filter(layout => layout.layout_name === 'HeroBanner');
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
    async fetchLayouts() {
      try {
        this.loading = true;
        const res = await fetch(`${backendUrl}/api/layouts`);
        const data = await res.json();
        this.LayoutsData = data;
        this.initTypes();
      } catch (err) {
        console.error(err);
      } finally {
        this.loading = false;
      }
    },
    initTypes() {
      const set = new Set(this.allLayouts.map(e => e.type));
      this.types = Array.from(set);
    },
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
    },
    LayoutsByType(type) {
      return this.allLayouts.filter(layout => layout.type === type);
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



.layout-item {
  opacity: 0;
  transform: translateY(30px);
  animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.group-title {
  margin-top: 100px;
  font-size: 40px;
  font-weight: bold;
  background: linear-gradient(90deg, red, rgb(251, 0, 255), red);
  background-size: 200%;
  background-position: left;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  transition: 0.5s ease;
  margin-bottom: 20px;
  border-bottom: 2px solid #00ffcc;
  padding-bottom: 6px;
  cursor: pointer;
}

.group-title:hover {
  animation: moveGradient 1s infinite linear alternate-reverse;
}

@keyframes moveGradient {
  0% {
    background-position: 100%;
  }

  100% {
    background-position: 0%;
  }
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
    margin-top: 50px;
    display: block;
  }

  .group-title {
    margin-top: 50px;
    font-size: 30px;
  }

}
</style>
