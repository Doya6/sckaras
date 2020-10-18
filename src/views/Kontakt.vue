<template>
    <div>
        <NavBar/>
        <Kontakt/>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'
import Kontakt from '@/components/Kontakt.vue'
export default {
  name: 'Home',
  components: {
    NavBar,
    Kontakt
  }
}
</script>


