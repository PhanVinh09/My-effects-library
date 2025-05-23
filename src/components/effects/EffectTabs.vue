<template>
  <div>
    <div class="tabs">
      <button
        v-for="tab in tabs"
        :key="tab"
        @click="activeTab = tab"
        :class="{ active: activeTab === tab }"
      >
        {{ tab.toUpperCase() }}
      </button>
    </div>

    <div v-if="activeTab === 'html'" class="tab-content">
      <pre><code class="language-html">{{ effect.html }}</code></pre>
    </div>
    <div v-else-if="activeTab === 'css'" class="tab-content">
      <pre><code class="language-css">{{ effect.css }}</code></pre>
    </div>
    <div v-else-if="activeTab === 'js'" class="tab-content">
      <pre><code class="language-js">{{ effect.js }}</code></pre>
    </div>
    <div v-else class="tab-content">
      <iframe :srcdoc="generatedPreview" />
    </div>
  </div>
</template>

<script>
import hljs from 'highlight.js'
import 'highlight.js/styles/github-dark.css' // hoặc theme khác

export default {
  props: {
    effect: Object,
  },
  data() {
    return {
      tabs: ['html', 'css', 'js', 'result'],
      activeTab: 'result',
    };
  },
  computed: {
    generatedPreview() {
      return `
        <html>
          <head><style>${this.effect.css}</style></head>
          <body>
            ${this.effect.html}
            <script>${this.effect.js}<\/script>
          </body>
        </html>
      `;
    },
  },
  mounted() {
    this.highlightCode();
  },
  updated() {
    this.highlightCode();
  },
  watch: {
    activeTab() {
      this.highlightCode();
    }
  },
  methods: {
    highlightCode() {
      this.$nextTick(() => {
        document.querySelectorAll('pre code').forEach((block) => {
          hljs.highlightElement(block);
        });
      });
    }
  }
};
</script>

<style scoped>
.tabs {
  display: flex;
  background: #2c3e50;
  padding: 10px;
}

.tabs button {
  background: transparent;
  color: #ecf0f1;
  border: none;
  padding: 10px 15px;
  margin-right: 5px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s;
}

.tabs button:hover,
.tabs button.active {
  background: #34495e;
  border-radius: 6px;
}

.tab-content {
  background: #fff;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 0 0 6px 6px;
  min-height: 200px;
  font-family: 'Courier New', Courier, monospace;
  font-size: 14px;
  overflow-x: auto;
}

iframe {
  width: 100%;
  height: 200px;
  border: none;
}
</style>
