<template>
<div class="vizitka">
    <div class="jmeno">Jmeno: {{ osoba.jmeno }}</div>
    <div class="prijmeni">Prijmeni: {{ osoba.prijmeni }}</div>
    <div class="adresa">Adresa: {{ osoba.adresa }}</div>
</div>
</template>
<script>
    export default{
        props: ['osoba']
    };
</script>
<style>
.vizitka{
    padding:20px 40px;
    background-color: pink;
    border: 2px solid lime;
}
.jmeno,
.prijmeni,
.adresa {
    color: white;
    font-weight: 700;
    font-size: 24px;
}
</style>