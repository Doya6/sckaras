<template>
    
    
      <v-form>
        <v-container fluid>
          <v-row>
            <v-col
              cols="12"
              sm="6"
            >
              <v-text-field
              v-model="username"
              label="Uživatel"
              >
              </v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col
              cols="12"
              sm="6"
            >
              <v-text-field
                v-model="password"
                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.required, rules.min]"
                :type="show1 ? 'text' : 'password'"
                name="input-10-1"
                label="Heslo"
                hint="Alespoň 8 znaků"
                counter
                @click:append="show1 = !show1"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col
              cols="12"
              sm="6"
            >
              <router-link to="/Login">
                Nová registrace
              </router-link>
            </v-col>
          </v-row>
        </v-container>
    </v-form>
    
    <!--
        <v-row no-gutters>Login</v-row>
        <v-card min-height="150" min-width="150" width="400" class="mt-10 pa-6">
            <v-row no-gutters justify="center" class="height ">
                <div class="input-wrapper">
                    <v-text-field outlined label="Uživatelské jméno"></v-text-field>
                </div>
            </v-row>
            <v-row no-gutters justify="center">
                <div class="input-wrapper">
                    <v-text-field outlined label="Heslo"></v-text-field>
                </div>
            </v-row>
            <v-row no-gutters justify="center" class="my-5">
                <v-btn> Odeslat </v-btn>
            </v-row>
            
        </v-card>  -->
    
</template>

<script>
export default {
    data(){
        return{
      show1: false,
      username: '',
      password: '',
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 8 || 'Min 8 characters',
        emailMatch: () => ('The email and password you entered don\'t match'),
      },
    }
  }
};
</script>

<style>
.input-wrapper{
    width: 600px;
}
</style>
