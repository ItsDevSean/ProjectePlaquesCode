<template>
    <div>
        <h1>Principal</h1>
        <router-view></router-view>
    </div>
</template>

<script>
import ListComponent from "./ComponentsVue/ListComponent.vue";

export default {
    components: {
        ListComponent
    }
};
</script>
