<script>
import {Line} from 'vue-chartjs'
import moment from "moment";

export default {
    extends: Line,
    name: "TotalSales",
    mounted() {
        this.start_date = this.$route.params.start
        this.end_date = this.$route.params.end
        this.update();
    },
    data() {
        return {

            start_date: null,
            end_date: null,

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
    methods: {
        update() {
            axios.get("/api/charts/total-sales", {
                params: {
                    start: this.start_date === undefined ? null : moment(this.start_date).format("YYYY-MM-DD"),
                    end: this.end_date === undefined ? null : moment(this.end_date).format("YYYY-MM-DD")
                }
            }).then((response) => {

                console.log(response.data)

                response.data.forEach(p => {
                    this.dates.push(p.date);
                    this.values.push(p.summing)
                })
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
