<template>
    <header>
        <!-- Aggiungiamo i link delle rotte -->
        <nav>
            <li><router-link :to="{ name: 'home' }">HOME</router-link></li>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style lang="scss" scoped>

    li{
        list-style: none;
    }
</style>