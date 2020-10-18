<template>
    <div>
        <NavBar/>
        Prihlaseni
        <Formular/>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'
import Formular from '@/components/Formular.vue'
export default {
  name: 'Prihlaseni',
  components: {
    NavBar,
    Formular
  }
}
</script>