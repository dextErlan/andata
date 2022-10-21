<script setup>
import DocumentationIcon from './icons/IconDocumentation.vue'
import ToolingIcon from './icons/IconTooling.vue'
import EcosystemIcon from './icons/IconEcosystem.vue'
import CommunityIcon from './icons/IconCommunity.vue'
import SupportIcon from './icons/IconSupport.vue'
</script>

<template>
  <footer>
    <a href="#">
      <i>
        <DocumentationIcon />
      </i>
    </a>
    <a href="#">
      <i>
        <ToolingIcon/>
      </i>
    </a>
    <a href="#">
      <i>
        <EcosystemIcon/>
      </i>
    </a>
    <a href="#">
      <i>
        <CommunityIcon/>
      </i>
    </a>
    <a href="#">
      <i>
        <SupportIcon/>
      </i>
    </a>
  </footer>
</template>

<script>
export default {
  name: "Footer"
}
</script>

<style scoped>
footer {
  border-top: solid 1px;
  min-height: 75px;
  display: flex;
  align-items: flex-end;
  justify-content: flex-end;
  padding-bottom: 10px;
  column-gap: 10px;
}

i {
  display: flex;
  place-items: center;
  place-content: center;
  color: var(--color-text);
  border: 1px solid var(--color-border);
  background: var(--color-background);
  border-radius: 8px;
  width: 50px;
  height: 50px;
}
</style>