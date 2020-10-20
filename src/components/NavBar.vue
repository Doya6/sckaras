<template>
  <v-card class="mx-auto overflow-hidden">
    <v-app-bar color="light-blue lighten-3" dark>
      <v-app-bar-nav-icon class="hidden-md-and-up" @click="drawer = true"></v-app-bar-nav-icon>
      <router-link to="/">
        <v-img src='@/assets/LOGO-Karas.jpg' alt="logo" max-height="50" max-width="50"></v-img>
      </router-link>
      <v-toolbar-title class='ml-5 hidden-xs-only'>Společenské Centrum Karas</v-toolbar-title>
      <v-toolbar-title class='ml-5 hidden-sm-and-up'>SC Karas</v-toolbar-title>
      <v-spacer></v-spacer>
      <div class="hidden-sm-and-down">
        <v-btn to="/" color="amber lighten-1" class="mx-1">Home</v-btn>
        <v-btn to="/Aktivity" color="amber lighten-1" class="mx-1">Aktivity</v-btn>
        <v-btn to="/Fotogalerie" color="amber lighten-1" class="mx-1">Fotogalerie</v-btn>
        <v-btn to="/Prihlaseni" color="amber lighten-1" class="mx-1">Příhlášení</v-btn>
        <v-btn to="/Kontakt"  color="amber lighten-1" class="mx-1">Kontakt</v-btn>
      </div>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" fixed temporary >
      <v-list nav dense>
        <v-list-item-group
          v-model="group"
          active-class="light-blue lighten-3"
        >
          <v-list-item to="/" >
            <v-list-item-icon>
              <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item>

          <v-list-item to="/Aktivity" >
            <v-list-item-icon>
              <v-icon>mdi-calendar-month</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Aktivity</v-list-item-title>
          </v-list-item>

          <v-list-item to="/Fotogalerie" >
            <v-list-item-icon>
              <v-icon>mdi-image</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Fotogalerie</v-list-item-title>
          </v-list-item>

          <v-list-item to="/Prihlaseni" >
            <v-list-item-icon>
              <v-icon>mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Přihlášení</v-list-item-title>
          </v-list-item>
          
          <v-list-item to="/Kontakt" >
            <v-list-item-icon>
              <v-icon>mdi-phone</v-icon>
            </v-list-item-icon>
            <v-list-item-title>Kontakt</v-list-item-title>
          </v-list-item>

        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    drawer: false,
    group: null,
  }),
};
</script>

<style scoped>
 
</style>
