export default {


    data: function () {
        return {

            backgroundColors: [],
            borderColors: []

        };
    },
    methods: {

        addNewRandomColorToBackgrounds() {

            let r = Math.floor(Math.random() * 255);
            let g = Math.floor(Math.random() * 255);
            let b = Math.floor(Math.random() * 255);
            this.backgroundColors.push( "rgb(" + r + "," + g + "," + b + ", 0.2)")
            this.borderColors.push( "rgb(" + r + "," + g + "," + b + ", 1)")
        },

        createNewColoredDataset(){
            let r = Math.floor(Math.random() * 255);
            let g = Math.floor(Math.random() * 255);
            let b = Math.floor(Math.random() * 255);
            return {backgroundColor : ["rgb(" + r + "," + g + "," + b + ", 0.2)"],
            borderColor : ["rgb(" + r + "," + g + "," + b + ", 1)"], data: [], borderWidth : 3, label: null}

        }
    }

}

