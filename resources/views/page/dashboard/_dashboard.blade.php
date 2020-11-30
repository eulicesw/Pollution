@extends('layouts.user')

{{-- Content --}}
@section('content')
<div class="heading-text heading-section text-center">
    <!-- <h2>Monitoring</h2> -->
    <h2>Air Quality Index (AQI)</h2>
</div>
<div class="card m-4">
    <div class="row">
        <div class="col-12 text-center" style="padding-top:15px;padding-bottom:30px;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 m-auto">
                    <div>
                        <h4 class="mb-5">AQI <i class="fas fa-info-circle hover-green"></i></h4>
                        <h1 class="mb-4">25</h4>
                        <h5>Updated on: Today 05:00</h5>
                    </div>
                </div>
                @foreach($elements_configuration as $element_configuration)
                <div class="col-xs-12 col-sm-4 col-md-3 m-auto">
                    @if($element_configuration->switched_on)
                    <div>
                        <h5 class="title-chartstatus">{{ $element_configuration->name }}</h5>
                        <div id="{{ $element_configuration->name }}" style="width: 200px; height: 200px; margin: 0 auto;"></div>
                    </div>
                    @endif
                    @if(!$element_configuration->switched_on)
                    <strong>{{ $element_configuration->reason_disabled }}</strong>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @foreach($elements_configuration as $ec)
        <div class="col-lg-12 col-xl-6 mb-5">
            <div class="row">
                <div class="col-12 text-center">
                    <form class="form-inline justify-content-center">
                        <label for="from_date" class="mr-sm-2">From: </label>
                        <input type="date" class="form-control mr-2" id="fromDate_{{ $ec->id }}" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d')))) }}" max="{{ date('Y-m-d') }}" required>
                        <label for="to_date" class="mr-sm-2">To: </label>
                        <input type="date" class="form-control mr-4" id="toDate_{{ $ec->id }}" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-2 week', strtotime(date('Y-m-d')))) }}" max="{{ date('Y-m-d') }}" required>
                        <button id="button_{{ $ec->id }}" type="button" class="btn btn btn-outline-secondary btn-sm mb-2" onclick="getDataChart({!! $ec->id !!})" data-toggle="tooltip" data-placement="top" title="Search">Search</button>
                        <button id="pdf_{{ $ec->name }}" type="button" class="btn btn btn-outline-secondary btn-sm mb-2" onclick="printChartPDF('{!! $ec->name !!}')" data-toggle="tooltip" data-placement="top" title="Print chart to PDF"><span  class="fa fa-file-pdf-o" aria-hidden="true"></span></button>
                    </form>
                    <canvas id="canvas_{{ $ec->name }}"></canvas>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="title-modal w-100 text-center" id="exampleModalLongTitle">About the Air Quality Levels</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="air-information" class="table table-bordered" style="text-align:left;">
                    <thead style="background:#F6F9F9;">
                        <tr>
                            <td class="align-vertically">AQI</td>
                            <td class="align-vertically">Air Pollution Level</td>
                            <td class="align-vertically">Health Implications</td>
                            <td class="align-vertically">Cautionary Statement (for PM2.5)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-success text-white">
                            <td class="align-vertically" nowrap="true">0 - 50</td>
                            <td class="align-vertically">Good</td>
                            <td class="align-vertically">Air quality is considered satisfactory, and air pollution poses little or no risk</td>
                            <td class="align-vertically">None</td>
                        </tr>
                        <tr class="bg-warning">
                            <td class="align-vertically" nowrap="true">51 - 100</td>
                            <td class="align-vertically">Moderate</td>
                            <td class="align-vertically">Air quality is acceptable; however, for some pollutants there may be a moderate health concern for a very small number of people who are unusually sensitive to air pollution.</td>
                            <td class="align-vertically">Active children and adults, and people with respiratory disease, such as asthma, should limit prolonged outdoor exertion.</td>
                        </tr>
                        <tr class="bg-orange">
                            <td class="align-vertically" nowrap="true">101 - 150</td>
                            <td class="align-vertically">Unhealthy for Sensitive Groups</td>
                            <td class="align-vertically">Members of sensitive groups may experience health effects. The general public is not likely to be affected.</td>
                            <td class="align-vertically">Active children and adults, and people with respiratory disease, such as asthma, should limit prolonged outdoor exertion.</td>
                        </tr>
                        <tr class="bg-danger text-white">
                            <td class="align-vertically" nowrap="true">151 - 200</td>
                            <td class="align-vertically">Unhealthy</td>
                            <td class="align-vertically">Everyone may begin to experience health effects; members of sensitive groups may experience more serious health effects</td>
                            <td class="align-vertically">Active children and adults, and people with respiratory disease, such as asthma, should avoid prolonged outdoor exertion; everyone else, especially children, should limit prolonged outdoor exertion</td>
                        </tr>
                        <tr class="bg-purple text-white">
                            <td class="align-vertically" nowrap="true">201 - 300</td>
                            <td class="align-vertically">Very Unhealthy</td>
                            <td class="align-vertically">Health warnings of emergency conditions. The entire population is more likely to be affected.</td>
                            <td class="align-vertically">Active children and adults, and people with respiratory disease, such as asthma, should avoid all outdoor exertion; everyone else, especially children, should limit outdoor exertion.</td>
                        </tr>
                        <tr class="bg-blood text-white">
                            <td class="align-vertically" nowrap="true">300+</td>
                            <td class="align-vertically">Hazardous</td>
                            <td class="align-vertically">Health alert: everyone may experience more serious health effects</td>
                            <td class="align-vertically">Everyone should avoid all outdoor exertion</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    #information-air {
        color: inherit !important;
    }

    .icon-top {
        float: right;
        right: 10px !important;
        top: 0px !important;
    }

    .modal-body {
        overflow-x: auto;
    }

    .bg-orange {
        background-color: #FF9933;
    }

    .bg-purple {
        background-color: #660099;
    }

    .bg-blood {
        background-color: #7E0023;
    }

    .align-vertically {
        vertical-align: middle !important;
    }

    .title-modal {
        font-family: 'Lato', sans-serif;
        font-size: 2rem;
        line-height: 2;
        font-weight: bold !important;
    }
</style>
<script type="text/javascript">
    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

    (function(global) {
        var MONTHS = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        var COLORS = [
            '#4dc9f6',
            '#f67019',
            '#f53794',
            '#537bc4',
            '#acc236',
            '#166a8f',
            '#00a950',
            '#58595b',
            '#8549ba'
        ];

        var Samples = global.Samples || (global.Samples = {});
        var Color = global.Color;

        Samples.utils = {
            // Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
            srand: function(seed) {
                this._seed = seed;
            },

            rand: function(min, max) {
                var seed = this._seed;
                min = min === undefined ? 0 : min;
                max = max === undefined ? 1 : max;
                this._seed = (seed * 9301 + 49297) % 233280;
                return min + (this._seed / 233280) * (max - min);
            },

            numbers: function(config) {
                var cfg = config || {};
                var min = cfg.min || 0;
                var max = cfg.max || 1;
                var from = cfg.from || [];
                var count = cfg.count || 8;
                var decimals = cfg.decimals || 8;
                var continuity = cfg.continuity || 1;
                var dfactor = Math.pow(10, decimals) || 0;
                var data = [];
                var i, value;

                for (i = 0; i < count; ++i) {
                    value = (from[i] || 0) + this.rand(min, max);
                    if (this.rand() <= continuity) {
                        data.push(Math.round(dfactor * value) / dfactor);
                    } else {
                        data.push(null);
                    }
                }

                return data;
            },

            labels: function(config) {
                var cfg = config || {};
                var min = cfg.min || 0;
                var max = cfg.max || 100;
                var count = cfg.count || 8;
                var step = (max - min) / count;
                var decimals = cfg.decimals || 8;
                var dfactor = Math.pow(10, decimals) || 0;
                var prefix = cfg.prefix || '';
                var values = [];
                var i;

                for (i = min; i < max; i += step) {
                    values.push(prefix + Math.round(dfactor * i) / dfactor);
                }

                return values;
            },

            months: function(config) {
                var cfg = config || {};
                var count = cfg.count || 12;
                var section = cfg.section;
                var values = [];
                var i, value;

                for (i = 0; i < count; ++i) {
                    value = MONTHS[Math.ceil(i) % 12];
                    values.push(value.substring(0, section));
                }

                return values;
            },

            color: function(index) {
                return COLORS[index % COLORS.length];
            },

            transparentize: function(color, opacity) {
                var alpha = opacity === undefined ? 0.5 : 1 - opacity;
                return Color(color).alpha(alpha).rgbString();
            }
        };

        Samples.utils.srand(Date.now());

    }(this));
    // Global variables.
    var temperatures;
    var humidities;
    var monoxides;
    var co2s;
    var nitrogens;
    var ozones;
    var last_temperature;
    var last_humidity;
    var last_monoxide;
    var last_co2;
    var last_nitrogen;
    var last_ozone;
    var elements;
    var charts = [];
    var fromDate;
    var toDate;
    var intervals = [];
    $(document).ready(function() {
        $('a[href="/"]').removeClass("active");
        $('a[href="/dashboard"]').addClass("active");
        $('#textHeader').html("");
        if (isMobile.any()) {
            $('#headerInicio').css("height", "60vh");
            $('#headerInicio').css("min-height", "20vh");
        } else {
            $('#headerInicio').css("height", "20vh");
            $('#headerInicio').css("min-height", "auto");
        }
        // Get data from controller and pass to js variable.
        temperatures = {!! json_encode($temperatures->toArray()) !!};
        humidities = {!! json_encode($humidities->toArray()) !!};
        co2s = {!! json_encode($carbonDioxides->toArray()) !!};
        monoxides = {!! json_encode($monoxides->toArray()) !!};
        nitrogens = {!! json_encode($nitrogens->toArray()) !!};
        ozones = {!! json_encode($ozones->toArray()) !!};
        elements = {!! json_encode($elements_configuration->toArray()) !!};
        drawStatusCharts(true);
        drawMainChart(false);
        updateStatusCharts();
        // updateMainsCharts();
    });

    function drawMainChart(newRequest, element_id) {
        if (newRequest) {
            $.ajax({
                url: 'dashboard/update',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: null,
                success: function(data, textStatus, xhr) {
                    if (xhr.status === 200) {
                        // Updating main chart.
                        var new_grade;
                        var new_time;
                        var chart;
                        // last_temperature = data.temperatures;
                        // last_humidity = data.humidities;
                        // last_co2 = data.carbondioxides;
                        // last_monoxide = data.monoxides;
                        // console.log('%c Last data temp: ', 'color:green;font-size:16px;', last_temperature.grade);
                        // console.log('%c Last data humi: ', 'color:green;font-size:16px;', last_humidity.grade);
                        // console.log('%c Last data co2: ', 'color:green;font-size:16px;', last_co2.grade);
                        // console.log('%c Last data mono: ', 'color:green;font-size:16px;', last_monoxide.grade);
                        // window.myLine.data.labels.splice(0, 1); // Remove first label.
                        // window.myLine.data.datasets[0].data.splice(0, 1);
                        // window.myLine.data.datasets[1].data.splice(0, 1);
                        // window.myLine.data.datasets[2].data.splice(0, 1);
                        // window.myLine.data.datasets[3].data.splice(0, 1);
                        // var totalTemp = temperatures.length;
                        // var totalHum = humidities.length;
                        switch (element_id) {
                            case 1:
                                chart = charts[element_id - 1];
                                last_temperature = data.temperatures;
                                new_grade = last_temperature.grade;
                                new_time = last_temperature.hour;
                                chart.config.data.datasets[0].data.push({
                                    t: new Date(), //new_time
                                    y: new_grade
                                });
                                break;
                            case 2:
                                chart = charts[element_id - 1];
                                last_humidity = data.humidities;
                                new_grade = last_humidity.grade;
                                new_time = last_humidity.hour;
                                chart.config.data.datasets[0].data.push({
                                    t: new Date(), //new_time
                                    y: new_grade
                                });
                                break;
                            case 3:
                                chart = charts[element_id - 1];
                                last_co2 = data.carbondioxides;
                                new_grade = last_co2.grade;
                                new_time = last_co2.hour;
                                chart.config.data.datasets[0].data.push({
                                    t: new Date(), //new_time
                                    y: new_grade
                                });
                                break;
                            case 4:
                                chart = charts[element_id - 1];
                                last_monoxide = data.monoxides;
                                new_grade = last_monoxide.grade;
                                new_time = last_monoxide.hour;
                                chart.config.data.datasets[0].data.push({
                                    t: new Date(), //new_time
                                    y: new_grade
                                });
                                break;
                            case 5:
                                chart = charts[element_id - 1];
                                last_nitrogen = data.nitrogens;
                                new_grade = last_nitrogen.grade;
                                new_time = last_nitrogen.hour;
                                chart.config.data.datasets[0].data.push({
                                    t: new Date(), //new_time
                                    y: new_grade
                                });
                                break;
                            case 6:
                                chart = charts[element_id - 1];
                                last_ozone = data.ozones;
                                new_grade = last_ozone.grade;
                                new_time = last_ozone.hour;
                                chart.config.data.datasets[0].data.push({
                                    t: new Date(), //new_time
                                    y: new_grade
                                });
                                break;
                        }
                        chart.update();
                        // elements.forEach(element => {
                        //     // switch (element.id) {
                        //     //     case 1: charts[element.id - 1].config.data.dataset
                        //     // }
                        //     var new_grade;
                        //     var new_time;
                        //     var index = element.id - 1;
                        //     var chart = charts[index];
                        //     console.log('%c Chart: ', 'color:green;font-size:16px;', chart);
                        //     console.log('%c Element id : ', 'color:green;font-size:16px;', element.id);
                        //     switch(element.id) {
                        //         case 1: new_grade = last_temperature.grade;
                        //                 new_time = last_temperature.hour;
                        //             break;
                        //         case 2: new_grade = last_humidity.grade;
                        //                 new_time = last_humidity.hour;
                        //             break;
                        //         case 3: new_grade = last_co2.grade;
                        //                 new_time = last_co2.hour;
                        //             break;
                        //         case 4: new_grade = last_monoxide.grade;
                        //                 new_time = last_monoxide.hour;
                        //             break;
                        //     }
                        //     console.log('%c Dataset: ', 'color:green;font-size:16px;', chart.config.data.datasets[0]);
                        //     chart.config.data.datasets[0].data.push({
                        //         t: new Date(), //new_time
                        //         y: new_grade
                        //     });
                        //     chart.update();
                        // });

                        // window.myLine.data.labels.push(temperatures.hour); // Se actualiza la hora.
                        // window.myLine.data.datasets[0].data[9] = temperatures.grade; // Actualiza los grados.
                        // window.myLine.data.datasets[1].data[9] = humidities.grade; // Actualiza los grados.
                        // window.myLine.data.datasets[2].data[9] = co2s.grade; // Actualiza el CO2.
                        // window.myLine.data.datasets[3].data[9] = monoxides.grade; // Actualiza el Monoxido de carbono.
                        // window.myLine.update();
                        updateTimeLabel();
                    } else {
                        console.log('%c Error: ', 'color:red;font-size:16px;', 'Error server.');
                    }
                }
            });
        } else {
            elements.forEach(element => createMainChart(element));
            /*document.getElementById("canvas").onclick = function(e) {
                var activeElement = window.myLine.lastTooltipActive;
            console.log(activeElement);
                    var hiddenDatasets = [];
                    var count = 0;
                    console.log(window.myLine.data.datasets.length);
                    for(var i = 0; i < window.myLine.data.datasets.length; i++) {
                            console.log('%c IsDataSetVisible:', 'color:green;font-size:16px;', window.myLine.isDatasetVisible(i));
                            if (!window.myLine.isDatasetVisible(i)) {
                                    console.log('Inside if');
                                    count++;
                                    hiddenDatasets.push(window.myLine.data.datasets[i]);
                            }
                            console.log(count);
                    }
                    console.log(hiddenDatasets);
            };*/
        }

        // Creating main chart.
        function createMainChart(element) {
            var config = {
                type: 'line',
                data: {
                    labels: getLabels(null, null),
                    datasets: [{
                            label: element.name + " (" + element.unit + ")",
                            backgroundColor: element.colour,
                            borderColor: element.colour,
                            data: getData(element.name), // Function get grades from the type of enviorment.
                            fill: false,
                            pointRadius: 0,
                            lineTension: 0,
                            borderWidth: 2
                        } //, 
                        // {
                        //     label: 'Humidity (% RH)',
                        //     fill: false,
                        //     backgroundColor: window.chartColors.blue,
                        //     borderColor: window.chartColors.blue,
                        //     data: getData('humidity'), // Function get grades from the type of enviorment.
                        // }, 
                        // {
                        //     label: 'Carbon Dioxide (ppm)',
                        //     fill: false,
                        //     backgroundColor: window.chartColors.green,
                        //     borderColor: window.chartColors.green,
                        //     data: getData('carbonDioxide'), // Change for dinamyc data.
                        // }, 
                        // {
                        //     label: 'Carbon Monoxide (ppm)',
                        //     fill: false,
                        //     backgroundColor: window.chartColors.red,
                        //     borderColor: window.chartColors.red,
                        //     data: getData('monoxide'), // Change for dinamyc data.
                        // }
                    ]
                },
                options: getSettingsChart(element.name, element.unit)
            };
            var ctx = document.getElementById('canvas_' + element.name).getContext('2d');
            switch (element.id) {
                case 1: //window.temperature = new Chart(ctx, config);
                    ctx = new Chart(ctx, config);
                    break;
                case 2: //window.humidity = new Chart(ctx, config);
                    ctx = new Chart(ctx, config);
                    break;
                case 3: //window.carbonDioxide = new Chart(ctx, config);
                    ctx = new Chart(ctx, config);
                    break;
                case 4: //window.monoxide = new Chart(ctx, config);
                    ctx = new Chart(ctx, config);
                    break;
                case 5: //window.monoxide = new Chart(ctx, config);
                    ctx = new Chart(ctx, config);
                    break;
                case 6: //window.monoxide = new Chart(ctx, config);
                    ctx = new Chart(ctx, config);
                    break;
            }
            charts.push(ctx);
            var inter = setInterval(() => {
                drawMainChart(true, element.id);
            }, 5000);
            intervals.push(inter);
        }

        function getSettingsChart(element_name, element_unit) {
            var titleChart = "Today's record";
            return {
                responsive: true,
                    title: {
                        display: true,
                        text: titleChart
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                // the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
                                suggestedMin: getMinimum(), // Get the minimum grade.
                                // the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
                                suggestedMax: getMaximum(element_name) // Get the miximum grade.
                            },
                            scaleLabel: {
                                display: true,
                                labelString: element_unit
                            }
                        }],
                        xAxes: [{
                            type: "time",
                            time: {
                                unit: 'hour',
                                unitStepSize: 1,
                                round: 'minute',
                                tooltipFormat: "h:mm:ss a",
                                displayFormats: {
                                    hour: 'MMM D, h:mm A'
                                }
                            },
                            distribution: 'linear', // 'linear'
                            ticks: {
                                major: {
                                    enabled: true,
                                    fontStyle: 'bold'
                                },
                                // Cuanda la hora sea menor a la 12:30am, utilizar 'data'.
                                // Si es mayor, utilizar 'auto'.
                                source: 'auto',
                                autoSkip: true,
                                autoSkipPadding: 75,
                                maxRotation: 0,
                                sampleSize: 100
                            }
                        }]
                    }//,
                    // legend: {
                    //     onHover: function(event, legendItem) {
                    //     document.getElementById("canvas").style.cursor = 'pointer';
                    // }
            }
        }
    }

    // Draw each element.
    function drawStatusCharts(newRequest) {
        // if (newRequest) {
            google.charts.load('current', {
                'packages': ['gauge']
            });
            google.charts.setOnLoadCallback(() => {
                axios.get("dashboard/update")
                    .then(response => {

                        var temperature = response.data.temperatures.grade;
                        var humidity = response.data.humidities.grade;
                        var carbonDioxide = response.data.carbondioxides.grade;
                        var monoxide = response.data.monoxides.grade;
                        var nitrogen = response.data.nitrogens.grade;
                        var ozone = response.data.ozones.grade;

                        // Gauges Graficas
                        for (var x = 0; x < elements.length; x++) {
                            if (elements[x].switched_on) { // Verifica si se debe mostrar
                                var value;
                                // Ticks por grafica o secciones
                                var ticks;
                                var min = (elements[x].min < '0') ? elements[x].min - 10 : 0;
                                var max = getNearest(elements[x].max);
                                switch (elements[x].id) {
                                    case 1:
                                        value = temperature;
                                        // console.log('%c Gauge value: ', 'color:green;font-size:16px;', value);
                                        ticks = [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50];
                                        max = elements[x].max;
                                        min = 0;
                                        greenTo = elements[x].min;
                                        yellowTo = elements[x].neutral;
                                        redTo = elements[x].max;
                                        minorTicks = 5;
                                        break;
                                    case 2:
                                        value = humidity;
                                        ticks = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
                                        max = elements[x].max;
                                        min = 0;
                                        greenTo = elements[x].min;
                                        yellowTo = elements[x].neutral;
                                        redTo = elements[x].max;
                                        minorTicks = 10;
                                        break;
                                    case 3:
                                        value = carbonDioxide;
                                        ticks = [0, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];
                                        max = elements[x].max;
                                        min = 0;
                                        greenTo = elements[x].min;
                                        yellowTo = elements[x].neutral;
                                        redTo = elements[x].max;
                                        minorTicks = 10;
                                        break;
                                    case 4:
                                        value = monoxide;
                                        ticks = [0, 10, 20, 30, 40, 50, 60, 70, 80, 80, 100];
                                        max = elements[x].max;
                                        min = 0;
                                        greenTo = elements[x].min;
                                        yellowTo = elements[x].neutral;
                                        redTo = elements[x].max;
                                        minorTicks = 10;
                                        break;
                                    case 5:
                                        value = nitrogen;
                                        ticks = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
                                        max = elements[x].max;
                                        min = 0;
                                        greenTo = elements[x].min;
                                        yellowTo = elements[x].neutral;
                                        redTo = elements[x].max;
                                        minorTicks = 10;
                                        break;
                                    case 6:
                                        value = ozone;
                                        ticks = [0, 100, 200, 300, 400, 500];
                                        max = elements[x].max;
                                        min = 0;
                                        greenTo = elements[x].min;
                                        yellowTo = elements[x].neutral;
                                        redTo = elements[x].max;
                                        minorTicks = 10;
                                        break;
                                    default:
                                        console.log('Error to find element.');
                                }
                                var data = google.visualization.arrayToDataTable([
                                    ['Label', 'Value'],
                                    [elements[x].unit, parseInt(value)]
                                ]);
                                // var options = {
                                //     width: 200, height: 200,
                                //     // redFrom: max, redTo: elements[x].max,
                                //     // yellowFrom: elements[x].min, yellowTo: min,
                                //     // greenFrom: elements[x].max, greenTo: elements[x].min,
                                //     redFrom: 25, redTo: 50,
                                //     yellowFrom: 10, yellowTo: 25,
                                //     greenFrom: 0, greenTo: 10,
                                //     // minorTicks: max,
                                //     max: 50,
                                //     min: 0,
                                //     majorTicks: ticks,
                                //     minorTicks: minorTicks,
                                //     animation: {
                                //         duration: 500,
                                //         easing: "in"
                                //     }
                                // };

                                var options = {
                                    width: 200, height: 200,
                                    redFrom: yellowTo, redTo: redTo,
                                    yellowFrom: greenTo, yellowTo: yellowTo,
                                    greenFrom: min, greenTo: greenTo,
                                    minorTicks: minorTicks,
                                    // Agregue desde aqui
                                    majorTicks: ticks,
                                    max: max, // Debe coincider el valor maximo con el ultimo numero de ticks.
                                    min: min,
                                    animation: {
                                        duration: 500,
                                        easing: "in"
                                    }
                                };

                                var chart = new google.visualization.Gauge(document.getElementById(elements[x].name));
                                chart.draw(data, options);
                            }
                        }
                    })
                    .catch(error => console.log(error));
            });
        // }

    }

    // Update gauges chart each 5 seconds.
    function updateStatusCharts() {
        setInterval(() => {
            drawStatusCharts(true);
        }, 5000);
    }

    // Update main chart each 5 seconds.
    // function updateMainsCharts() {
    //     intervalMainChart = setInterval(() => {
    //         drawMainChart(true);
    //     }, 5000);
    // }

    function getLabels(fromDate, toDate) {
        if (fromDate === undefined && toDate === undefined) {
            var hours = new Array();
            var date = new Date();
            for (var i = 1; date.getHours() >= 1; date.setHours(date.getHours() - i)) {
                var ajam = date;
                hours.push(moment(ajam).format('YYYY-MM-DD HH:mm:ss'));
                if (ajam.getHours() == 1) {
                    ajam.setHours(0);
                    ajam.setMinutes(30);
                    console.log(ajam);
                    console.log("Actual array date: " + hours);
                    hours.push(moment(ajam).format('YYYY-MM-DD HH:mm:ss'));
                    return hours;
                }
            }
        }
        //Esto me trae la informacion de cada hora.
        // console.log(temperatures);
        // var time = new Array();
        // temperatures.forEach(data => time.push(data.hour));
        // return time;
    }

    // By element name
    function getData(data) {
        var typeData;
        switch (data) {
            case "Temperature": typeData = temperatures;
                break;
            case "Humidity": typeData = humidities;
                break;
            case "CarbonDioxide": typeData = co2s;
                break;
            case "Monoxide": typeData = monoxides;
                break;
            case "Nitrogen": typeData = nitrogens;
                break;
            case "Ozone": typeData = ozones;
                break;
        }
        // if (data == "Temperature") {
        //     var typeData = temperatures;
        // } else if (data == "Humidity") {
        //     var typeData = humidities;
        // } else if (data == "CarbonDioxide") {
        //     var typeData = co2s;
        // } else if (data == "Monoxide") {
        //     var typeData = monoxides;
        // }
        var grades = [];
        typeData.forEach(element => grades.push({
            t: element.hour,
            y: element.grade
        }));
        return grades;
    }

    function getMinimum() {
        var minimum = 0;
        var index = 0;
        var total = temperatures.length;
        // For temperatures.
        for (var i = 0; i < 10; i++) {
            index = index - 1;
            if (temperatures[total + index].grade < minimum) {
                minimum = temperatures[total + index].grade;
            }
        }
        return minimum;
    }

    function getMaximum(element_name) {
        var data;
        switch (element_name) {
            case "Temperature": data = temperatures;
                break;
            case "Humidity": data = humidities;
                break;
            case "CarbonDioxide": data = co2s;
                break;
            case "Monoxide": data = monoxides;
                break;
            case "Nitrogen": data = nitrogens;
                break;
            case "Ozone": data = ozones;
                break;
        }
        var maximum = 0;
        var index = 0;
        var total = data.length;
        // For temperatures.
        for (var i = 0; i < total; i++) {
            index = index - 1;
            if (data[total + index].grade > maximum) {
                maximum = data[total + index].grade;
            }
        }
        return maximum;
    }

    // Using round to the nearest 10.
    function getNearest(number) {
        // console.log(Math.ceil((number) / 10) * 10);
        return Math.ceil((number) / 10) * 10;
    }

    function updateTimeLabel() {
        let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

        let todayDate = new Date();
        let day = days[todayDate.getDay()];

        $('#updated-day').text(day + " ");

        let hours = todayDate.getHours();
        let minutes = todayDate.getMinutes();

        if (hours < 10) hours = "0" + hours;
        if (minutes < 10) minutes = "0" + minutes;

        $('#updated-time').text(hours + ":" + minutes);
    }

    function getDate() {
        return new Date();
    }

    function getDataChart(id) {
        $('#button_' + id).html('<span class="spinner-border text-dark" role="status"></span><span class="sr-only">Loading...</span>');
        $('#button_' + id).attr("disabled", true);
        fromDate = $('#fromDate_' + id).val();
        toDate = $('#toDate_' + id).val();
        var data = {
            id: id,
            fromDate: fromDate,
            toDate: toDate
        }
        clearInterval(intervals[id - 1]); // Stop update main chart
        url = 'dashboard/getdata/chart';
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function(data, textStatus, xhr) {
                $('#button_' + id).attr("disabled", false);
                $('#button_' + id).html("Search");
                if (xhr.status === 200) {
                    if (data.data.length > 0) {
                        updateChart(id, data.data);
                    } else {
                        alert('Data could not be obtained between date ' + data.fromDate +' and ' + data.toDate);
                    }
                } else {
                    alert('Something was wrong, try again!');
                }
            },
            error: function(data, textStatus, xhr) {
                $('#button_' + id).attr("disabled", false);
                $('#button_' + id).html("Search");
                alert('Server error, try again.');
            }
        });
    }

    function updateChart(element_id, data) {
        assignDataToElement(element_id, data); // Pass new data to variable.
        var chart = charts[element_id - 1]; // Search chart selected.
        var dataset = chart.config.data.datasets[0]; // Get dataset.
        var f_date = new Date(fromDate + ' 00:00:00'); // To get the correct date.
        var t_date = new Date(toDate + ' 00:00:00'); // To get the correct date.
        var diff_date = dateDifference(f_date, t_date);
        var txt_date_complement;
        var today = getDate();
        today.setHours(00);
        today.setMinutes(00);
        today.setSeconds(00);
        today.setMilliseconds(00);
        if (f_date.getTime() === today.getTime() && t_date.getTime() === today.getTime()) {
            chart.config.options.title.text = "Today's record";
            chart.config.options.scales.xAxes[0].time.tooltipFormat = 'h:mm:ss a';
            var inter = setInterval(() => {
                drawMainChart(true, element_id);
            }, 5000);
            intervals[element_id - 1] = inter;
        } else if (f_date.getTime() === t_date.getTime()) {
            chart.config.options.title.text = 'History of day ' + formatDate(f_date);
            chart.config.options.scales.xAxes[0].time.tooltipFormat = 'h:mm:ss a';
        } else if (diff_date < 7) {
            txt_date_complement = (diff_date == 1) ? 'day' : 'days';
            chart.config.options.title.text = 'History between ' + diff_date + ' ' + txt_date_complement + ' (' + formatDate(f_date) + ' - ' + formatDate(t_date) + ')';
            chart.config.options.scales.xAxes[0].time.tooltipFormat = 'MMM D, h:mm A';
        } else {
            diff_date = Math.trunc(diff_date / 7);
            txt_date_complement = (diff_date == 1) ? 'week' : 'weeks';
            chart.config.options.title.text = 'History between ' + diff_date + ' ' + txt_date_complement + ' (' + formatDate(f_date) + ' - ' + formatDate(t_date) + ')';
            chart.config.options.scales.xAxes[0].time.tooltipFormat = 'MMM D, h:mm A';
        }
        dataset.data = getData(elements[element_id - 1].name); // Update dataset with data obtained by dates.
        chart.update();
    }

    function assignDataToElement(element_id, data) {
        switch (element_id) {
            case 1: temperatures = data;
                break;
            case 2: humidities = data;
                break;
            case 3: co2s = data;
                break;
            case 4: monoxides = data;
                break;
            case 5: nitrogens = data;
                break;
            case 6: ozones = data;
                break;
        }
    }

    function dateDifference(firstDate, secondDate) {
        // Hasta - desde.
        var diff_in_time =  secondDate.getTime() - firstDate.getTime();
        return diff_in_time / (1000 * 3600 * 24);
    }

    function formatDate(date) {
        return date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear();
    }

    function printChartPDF(element_name) {
        $('#pdf_' + element_name).html('<span class="spinner-border text-dark" role="status"></span><span class="sr-only">Loading...</span>');
        $('#pdf_' + element_name).attr("disabled", true);
        // get size of report page
        var canvas = $('#canvas_' + element_name);
        var reportPageHeight = canvas.innerHeight();
        var reportPageWidth = canvas.innerWidth();

        var pdfCanvas = $('<canvas />').attr({
            id: "canvaspdf",
            width: reportPageWidth,
            height: reportPageHeight
        });

        // keep track canvas position
        var pdfctx = $(pdfCanvas)[0].getContext('2d');
        var pdfctxX = 0;
        var pdfctxY = 0;
        var buffer = 100;

        // for each chart.js chart
        // $("canvas_" + element_name).each(function(index) {
        //     // get the chart height/width
        //     var canvasHeight = $(this).innerHeight();
        //     var canvasWidth = $(this).innerWidth();
            
        //     // draw the chart into the new canvas
        //     pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
        //     pdfctxX += canvasWidth + buffer;
            
        //     // our report page is in a grid pattern so replicate that in the new canvas
        //     if (index % 2 === 1) {
        //         pdfctxX = 0;
        //         pdfctxY += canvasHeight + buffer;
        //     }
        // });

        // draw the chart into the new canvas
        pdfctx.drawImage(canvas[0], pdfctxX, pdfctxY, reportPageWidth, reportPageHeight);
        pdfctxX += reportPageWidth + buffer;

        // create new pdf and add our new canvas as an image
        var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
        pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
        
        // download the pdf
        pdf.save(element_name + '.pdf');
        $('#pdf_' + element_name).attr("disabled", false);
        $('#pdf_' + element_name).html('<span class="fa fa-file-pdf-o" aria-hidden="true"></span>');
    }

</script>
@endsection