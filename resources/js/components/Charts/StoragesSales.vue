<script>
import {Line} from 'vue-chartjs'
import moment from "moment";
import {uniq} from 'lodash'
import mixin_charts from "../../code/mixins/mixin_charts";

export default {
    extends: Line,
    name: "StoragesSales",
    mixins: [mixin_charts],
    mounted() {
        this.update();
    },
    props: {
        start: String,
        end: String
    },
    data() {
        return {


            dates: [],
            values: [],
            chart_data: {
                labels: null,
                datasets: []
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
            this.chart_data.datasets = [];
            this.dates = [];
            this.values = [];
            axios.get("/api/charts/storages-sales", {
                params: {
                    start: this.start === undefined ? null : moment(this.start).format("YYYY-MM-DD"),
                    end: this.end === undefined ? null : moment(this.end).format("YYYY-MM-DD")
                }
            }).then((response) => {

                console.log(response.data)

                this.dates = response.data.period;

                response.data.storage_data.forEach(p => {
                    let dataset = this.createNewColoredDataset();

                    dataset.label = `${p.storage.name}`;

                    this.dates.forEach(a => {

                        let res = p.data.filter(obj => {
                            return obj.date === a
                        })[0];
                        dataset.data.push(res != null ? res.summing : 0)
                    })

                    this.chart_data.datasets.push(dataset);
                });

                this.chart_data.labels = response.data.period;
                this.renderChart(this.chart_data, this.options)
            })
        }
    }

}
</script>

<style scoped>

</style>
