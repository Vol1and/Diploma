<script>
import {Pie} from 'vue-chartjs'
import moment from "moment";

export default {
    extends: Pie,
    name: "AgentsCash",
    mounted() {
        this.update();
    },
    data() {
        return {


            agents: [],
            values: [],
            chart_data: {
                datasets: [{
                    data: [10, 20, 30],

                },],

            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

            }

        };
    },
    methods: {
        update() {
            this.agents = [];
            this.values = [];
            let backgroundColors = [];
            axios.get("/api/charts/agents-cash").then((response) => {


                response.data.forEach(a => {

                    this.agents.push(a.name)

                    this.values.push(a.counting)
                    let r = Math.floor(Math.random() * 255);
                    let g = Math.floor(Math.random() * 255);
                    let b = Math.floor(Math.random() * 255);
                    backgroundColors.push( "rgb(" + r + "," + g + "," + b + ", 0.7)")
                    //this.chart_data.datasets[0].data.push(res != null ? res.summing : 0)
                })

                this.chart_data.datasets[0].data = this.values;
                this.chart_data.datasets[0].backgroundColor = backgroundColors;
                this.chart_data.labels = this.agents;
                this.renderChart(this.chart_data, this.options)

            })
        }
    }

}
</script>

<style scoped>

</style>
