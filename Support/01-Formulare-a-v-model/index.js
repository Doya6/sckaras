'use strict';

/*
Vyzkoušej si v-model na různých formulářových prvcích.
*/

new Vue({
	el: '#app',

	data: {
	jmeno: 'jana',
        komentar: '',
        cislo: 1,
        mesto: '',
        souhlas: false,
        ovoce: 'baban',
	datum: new Date(),
	xdny: 3
    },
  
    computed: {
        pocetZnaku() {
            return `Zbyva jeste ${140 - this.komentar.length} znaku.`;   
        },
	localDate(){
		return this.datum.toLocaleString('cz-CZ');
	},
	formatedDate(){
		let options = {
  			year: 'numeric', month: 'numeric', day: 'numeric',
  			hour: 'numeric', minute: 'numeric'
		};
		return (new Intl.DateTimeFormat('cz-CZ', options).format(this.datum)); 
		 
	},
	formatedDateShort(){
		let options = {
  			month: 'numeric', day: 'numeric',
  			hour: 'numeric', minute: 'numeric'
		};
		return (new Intl.DateTimeFormat('cz-CZ', options).format(this.datum)); 
		 
	},
	formatedTimeShort(){
		let options = {
  			hour: 'numeric', minute: 'numeric'
		};
		return (new Intl.DateTimeFormat('cz-CZ', options).format(this.datum)); 
		 
	},
	wkDay(){
		let den = (new Intl.DateTimeFormat('cz-CZ', { weekday: 'short'}).format(this.datum));
		return den.toUpperCase();
	},
	month(){
		let mesic = (new Intl.DateTimeFormat('cz-CZ', { month: 'long'}).format(this.datum));
		return mesic .toUpperCase();
	},
	year(){
		return (new Intl.DateTimeFormat('cz-CZ', { year: 'numeric'}).format(this.datum));

	},
	zaXDny(){
		let nextDay = new Date(this.datum.getTime()+(this.xdny*24*60*60*1000));
		return nextDay.toLocaleString('cz-CZ');
	}
        
    },

	methods: {
		prejmenujSe() {
            this.jmeno = "Alena";
        },
        jdiDoBrna() {
            this.mesto = "Brno";
		},
		
	}

	

});