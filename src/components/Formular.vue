<template>
    <v-container>
        <v-row no-gutters>jsem formular</v-row>
        <v-card min-height="150" min-width="150" class="pa-10">
            <v-row no-gutters justify="center">
                <div class="input-wrapper">
                    <v-text-field outlined label="Jmeno"></v-text-field>
                </div>
            </v-row>
            <v-row no-gutters justify="center">
                <div class="input-wrapper">
                    <v-text-field outlined label="Prijmeni"></v-text-field>
                </div>
            </v-row>
            <v-row no-gutters justify="center">
                <div class="input-wrapper">
                    <v-text-field outlined label="Adresa"></v-text-field>
                </div>
            </v-row>
            <v-row no-gutters justify="center" class="my-5">
                <v-btn> Odeslat </v-btn>
            </v-row>
            
        </v-card>  
    </v-container>
</template>

<script>
export default {
    data(){
        return{};
    }
};
</script>

<style>
.input-wrapper{
    width: 600px;
}
</style>