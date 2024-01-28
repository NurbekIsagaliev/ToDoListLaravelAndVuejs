<template>
    <navigation @updateComponent="updateComponent" :key="componentKey"></navigation>
    <div id="main">
        <router-view @updateComponent="updateComponent" class="m-3"></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                componentKey: 0,
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            updateComponent: function() {
                this.componentKey = !this.componentKey;
            }
        }
    }
</script>
