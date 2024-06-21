import js from '@eslint/js';
import eslintConfigPrettier from 'eslint-config-prettier';
import pluginVue from 'eslint-plugin-vue';

export default [
  js.configs.recommended,
  ...pluginVue.configs['flat/recommended'],
  eslintConfigPrettier,
  {
    files: ['resources/**/*.js', 'resources/**/*.vue'],
    rules: {
      'no-undef': 'off',
      'vue/multi-word-component-names': 'off',
      'vue/no-v-html': 'off',
      'vue/require-default-prop': 'off',
    },
  },
];
