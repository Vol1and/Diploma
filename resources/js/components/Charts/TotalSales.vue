
<script>
import {Line} from 'vue-chartjs'
import moment from "moment";

export default {
    extends: Line,
    name: "TotalSales",
    mounted() {
        this.update();
    },
    props:{
        start: String,
        end :String
    },
    data() {
        return {



            dates: [],
            values: [],
            chart_data: {
                labels: null,
                datasets: [{
                    label: 'Размер продаж за день',
                    data: [],
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
            this.dates = [];
            this.values = [];
            axios.get("/api/charts/total-sales", {
                params: {
                    start: this.start === undefined ? null : moment(this.start).format("YYYY-MM-DD"),
                    end: this.end === undefined ? null : moment(this.end).format("YYYY-MM-DD")
                }
            }).then((response) => {

                console.log(response.data)

                this.dates = response.data.period;


                this.dates.forEach(a => {

                    let res = response.data.data.filter(obj => {
                        return obj.date === a
                    })[0];
                    this.chart_data.datasets[0].data.push(res != null ? res.summing : 0)
                })

               // response.data.data.forEach(p => {
               //     this.dates.push(p.date);
               //     this.values.push(p.summing)
               // })
                this.chart_data.labels = this.dates;
                this.renderChart(this.chart_data, this.options)

            })
        }
    }

}
</script>

<style scoped>

</style>
