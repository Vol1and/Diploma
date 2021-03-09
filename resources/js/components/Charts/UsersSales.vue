<script>
import {Bar} from 'vue-chartjs'
import mixin_charts from "../../code/mixins/mixin_charts";
import moment from "moment";

export default {
    extends: Bar,
    mixins: [mixin_charts],
    name: "UsersSales",
    mounted() {
        this.start_date = this.$route.params.start
        this.end_date = this.$route.params.end
        this.update();
    },
    data() {
        return {

            start_date: null,
            end_date: null,
            users: [],
            values: [],
            chart_data: {

                labels: ["Продажи за период"],
                datasets: [],

            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                borderWidth: 3,
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
            axios.get("/api/charts/users-sales",
                {
                    params: {
                        start: this.start_date === undefined ? null : moment(this.start_date).format("YYYY-MM-DD"),
                        end: this.end_date === undefined ? null : moment(this.end_date).format("YYYY-MM-DD")
                    }
                }).then((response) => {

                console.log(response.data)

                response.data.forEach(p => {
                    let dataset = this.createNewColoredDataset();


                    dataset.label = p.user;
                    dataset.data.push(p.summing);

                    this.chart_data.datasets.push(dataset);
                })

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
