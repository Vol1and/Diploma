
<script>
import { Line } from 'vue-chartjs'

export default {
    extends: Line,
    name: "TotalSales",
    mounted() {
        this.update();
    },
    data() {
        return {

            dates: [],
            values: [],
            chart_data: {
                labels: null,
                datasets: [{
                    label: 'Размер продаж за день',
                    data: null,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }

        };
    },
    methods:{
        update(){
            axios.get("/api/charts/total-sales").then((response) => {

                console.log(response.data)

                response.data.forEach(p => { this.dates.push(p.date); this.values.push(p.summing)})
                this.chart_data.datasets[0].data = this.values;
                this.chart_data.labels = this.dates;
                this.renderChart(this.chart_data, this.options)

            })//.catch((error) => {
              //  //ошибка - выводим
              //  this.$notify.error({
//
              //      title: 'Ошибка!',
              //      message: "Сообщение ошибки - " + error.response.data.message,
              //  })
              //  this.loaded = true;
            //})
        }
    }

}
</script>

<style scoped>

</style>
