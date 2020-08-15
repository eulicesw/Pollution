@extends('layouts.user')

{{-- Content --}}
@section('content')
<div class="heading-text heading-section text-center">
        <!-- <h2>Monitoring</h2> -->
        <h2>Air Quality Index (AQI)</h2>
</div>
<div class="card m-4">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
			<div class="row">
				<div class="col-xs-12 col-md-12 p-3">
					<div class="d-flex justify-content-center">
						<div id="airvalue-index" class="col-5 col-lg-3 col-xl-2 p-3 mb-2 bg-success text-white w-25 text-center display-1 rounded">
							23
							<a id="information-air" href="#" data-toggle="modal" data-target="#exampleModalCenter">
								<i  class="fas fa-info-circle icon-top" style="font-size:25px;"></i>
							</a>
						</div>
						<div class="ml-3">
							<div id="airvalue-text" class="airvalue-text text-success display-3">
								Good
							</div>
							<div class="dateupdate">
								Updated on 
								<span id="updated-day">Friday </span><b id="updated-time">08:00</b>.	
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<canvas id="canvas"></canvas>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-5 text-center" style="padding-top:15px;padding-bottom:10px;">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 m-auto">
					@if($elements_configuration[0]->switched_on)
					<div>
						<h5 class="title-chartstatus">{{ $elements_configuration[0]->name }}</h5>
						<div id="Temperature" style="width: 200px; height: 200px; margin: 0 auto;"></div>
					</div>
					@endif
					@if(!$elements_configuration[0]->switched_on)
						<strong>{{ $elements_configuration[0]->reason_disabled }}</strong>
					@endif
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 m-auto">
					@if($elements_configuration[1]->switched_on)
					<div>
						<h5 class="title-chartstatus">{{ $elements_configuration[1]->name }}</h5>
						<div id="Humidity" style="width: 200px; height: 200px; margin: 0 auto;"></div>
					</div>
					@endif
					@if(!$elements_configuration[1]->switched_on)
						<strong>{{ $elements_configuration[1]->reason_disabled }}</strong>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 m-auto">
					@if($elements_configuration[2]->switched_on)
					<div>
						<h5 class="title-chartstatus">{{ $elements_configuration[2]->name }}</h5>
						<div id="CarbonDioxide" style="width: 200px; height: 200px; margin: 0 auto;"></div>
					</div>
					@endif
					@if(!$elements_configuration[2]->switched_on)
					<strong>{{ $elements_configuration[2]->reason_disabled }}</strong>
					@endif
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 m-auto">
					@if($elements_configuration[3]->switched_on)
					<div>
						<h5 class="title-chartstatus">{{ $elements_configuration[3]->name }}</h5>
						<div id="Monoxide" style="width: 200px; height: 200px; margin: 0 auto;"></div>
					</div>
					@endif
					@if(!$elements_configuration[3]->switched_on)
						<strong>{{ $elements_configuration[3]->reason_disabled }}</strong>
					@endif
				</div>
			</div>
		</div>
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
var elements;
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
    drawMainChart(false);
    drawStatusCharts(true);
    setInterval(() => {
    drawMainChart(true);
    drawStatusCharts(true);
    }, 5000);
});

function drawMainChart(newRequest) {
    if (newRequest) {
        $.ajax({
        url: 'dashboard/update',
            type: 'GET',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        data: null,
        success: function(data, textStatus, xhr) {
            if( xhr.status === 200 ) {
                // Updating main chart.
                temperatures = data.temperatures;
                humidities = data.humidities;
                co2s = data.carbondioxides;
                monoxides = data.monoxides;
                window.myLine.data.labels.splice(0, 1); // Remove first label.
                window.myLine.data.datasets[0].data.splice(0, 1);
                window.myLine.data.datasets[1].data.splice(0, 1);
                window.myLine.data.datasets[2].data.splice(0, 1);
                window.myLine.data.datasets[3].data.splice(0, 1);
                // var totalTemp = temperatures.length;
                // var totalHum = humidities.length;
                window.myLine.data.labels.push(temperatures.hour); // Se actualiza la hora.
                window.myLine.data.datasets[0].data[9] = temperatures.grade; // Actualiza los grados.
                window.myLine.data.datasets[1].data[9] = humidities.grade; // Actualiza los grados.
                window.myLine.data.datasets[2].data[9] = co2s.grade; // Actualiza el CO2.
                window.myLine.data.datasets[3].data[9] = monoxides.grade; // Actualiza el Monoxido de carbono.
                window.myLine.update();
            } else {
                console.log('%c Error: ', 'color:red;font-size:16px;', 'Error server.');
            }
        }
    });
    } else {
        // Get data from controller and pass to js variable.
        temperatures = {!! json_encode($temperatures->toArray()) !!};
        humidities = {!! json_encode($humidities->toArray()) !!};
        co2s = {!! json_encode($carbonDioxides->toArray()) !!};
        monoxides = {!! json_encode($monoxides->toArray()) !!};
        createMainChart(); // Creating main chart.
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
    function createMainChart() {
        var config = {
        type: 'line',
            data: {
            labels: getLabels(),
                datasets: [{
                label: 'Temperature (°C)',
                    backgroundColor: window.chartColors.orange,
                    borderColor: window.chartColors.orange,
                    data: getData('temperature'), // Function get grades from the type of enviorment.
                    fill: false,
    }, {
    label: 'Humidity (% RH)',
        fill: false,
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        data: getData('humidity'), // Function get grades from the type of enviorment.
    }, {
    label: 'Carbon Dioxide (ppm)',
        fill: false,
        backgroundColor: window.chartColors.green,
        borderColor: window.chartColors.green,
        data: getData('carbonDioxide'), // Change for dinamyc data.
    }, {
    label: 'Carbon Monoxide (ppm)',
        fill: false,
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        data: getData('monoxide'), // Change for dinamyc data.
    }]
    },
        options: {
        responsive: true,
            title: {
            display: true,
                text: 'Environmental Quality Index'// ['Environmental Quality Index', 'current past 10 hours data']
    },
        scales: {
        yAxes: [{
        ticks: {
        // the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
        suggestedMin: getMinimum(), // Get the minimum grade.
            // the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
            suggestedMax: getMaximum() // Get the miximum grade.
    },
        scaleLabel: {
        display: true
            // labelString: 'Grades' // To show name of left side main chart.
    }
    }],
        xAxes: [{
        scaleLabel: {
        display: true,
            labelString: 'Time'
    }
    }]
    },
        legend: { // Logica para cambiar el labelString de mainChart, como le hice, no se, pero ya funciona xd.
        onClick: function(e, legendItem) {
            var index = legendItem.datasetIndex;
            var ci = this.chart;
            var alreadyHidden = (ci.getDatasetMeta(index).hidden === null) ? false : ci.getDatasetMeta(index).hidden;
            ci.data.datasets.forEach(function(e, i) {
                var title = "";
                var meta = ci.getDatasetMeta(i);
                if (i !== index) {
                    if (!alreadyHidden) {
                        meta.hidden = meta.hidden === null ? !meta.hidden : null;
                        if (meta.hidden === null) {
                            window.myLine.options.scales.yAxes[0].scaleLabel.labelString = title;
                        } else if (meta.hidden === false) {
                            switch (i) {
                            case 0: title = "°C"; break;
                            case 1: title = "% RH"; break;
                            case 2: title = "PPM"; break;
                            case 3: title = "PPM"; break;
                            default: title = "";
                            }
                            window.myLine.options.scales.yAxes[0].scaleLabel.labelString = title;
                        }
                    } else if (meta.hidden === null) {
                        meta.hidden = true;
                    }
                } else if (i === index) {
                    meta.hidden = null;
                    switch (i) {
                    case 0: title = "°C"; break;
                    case 1: title = "% RH"; break;
                    case 2: title = "PPM"; break;
                    case 3: title = "PPM"; break;
                    default: title = "";
                    }
                    window.myLine.options.scales.yAxes[0].scaleLabel.labelString = title;
                }
            });
            ci.update();
        },
            onHover: function(event, legendItem) {
                document.getElementById("canvas").style.cursor = 'pointer';
            }
    }
    }
    };
        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };
    }
}

// Draw each element.
function drawStatusCharts(newRequest) {	
    if (newRequest) {
        google.charts.load('current', {'packages':['gauge']});
        google.charts.setOnLoadCallback(() => {
        elements = {!! json_encode($elements_configuration->toArray()) !!};
        axios.get("dashboard/update")
            .then(response => {

            var temperature = response.data.temperatures.grade;
            var humidity = response.data.humidities.grade;
            var carbonDioxide = response.data.carbondioxides.grade;
            var monoxide = response.data.monoxides.grade;

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
                        ticks = [30, 25, 20, 15, 10, 5, 0];
                        max = 30;
                        minorTicks = 5;
                        break;
                    case 2: 
                        value = humidity;
                        ticks = [100, 90, 80, 70, 60, 50, 40, 30, 20, 10, 0];
                        max = 100;
                        minorTicks = 10;
                        break;
                    case 3: 
                        value = carbonDioxide;
                        ticks = [500, 400, 300, 200, 100, 0];
                        max = 500;
                        minorTicks = 10;
                        break;
                    case 4: 
                        value = monoxide;
                        ticks = [50, 30, 10, 8, 5, 0];
                        max = 50;
                        minorTicks = 10;
                        break;
                    default: 
                        console.log('Error to find element.');
                    }
                    var data = google.visualization.arrayToDataTable([
                        ['Label', 'Value'],
                        [elements[x].unit, parseInt(value)]
                    ]);
                    var options = {
                    width: 200,
                        height: 200,
                        redFrom: max,
                        redTo: elements[x].max,
                        yellowFrom: elements[x].min,
                        yellowTo: min,
                        greenFrom: elements[x].max,
                        greenTo: elements[x].min,
                        // minorTicks: max,
                        max: min,
                        min: max,
                        majorTicks: ticks,
                        minorTicks: minorTicks,
                        animation : {
                        duration : 500,
                            easing : "in"
                    }
                    };
                    var chart = new google.visualization.Gauge(document.getElementById(elements[x].name));
                    chart.draw(data, options);
                }
            }
        })
            .catch(error => console.log(error));
        }) 
    }

}

function getLabels() {
    var qty = temperatures.length; 
    // BUG: If the data is less than 10, make an error.
    return [temperatures[qty-10].hour, temperatures[qty-9].hour, temperatures[qty-8].hour, 
        temperatures[qty-7].hour, temperatures[qty-6].hour, temperatures[qty-5].hour, 
        temperatures[qty-4].hour, temperatures[qty-3].hour, temperatures[qty-2].hour, 
        temperatures[qty-1].hour];
}

// By id
function getData(data) {
    if (data == "temperature") {
        var typeData = temperatures;
    } else if (data == "humidity") {
        var typeData = humidities;
    } else if (data == "carbonDioxide") {
        var typeData = co2s;
    } else if (data == "monoxide") {
        var typeData = monoxides;
    }

    var total = typeData.length;
    return [typeData[total-10].grade, typeData[total-9].grade, typeData[total-8].grade, typeData[total-7].grade, typeData[total-6].grade, typeData[total-5].grade, typeData[total-4].grade, typeData[total-3].grade, typeData[total-2].grade, typeData[total-1].grade];
}

function getMinimum() {
    var minimum = 0;
    var index = 0;
    var total = temperatures.length;
    // For temperatures.
    for (var i = 0;i < 10; i++) {
        index = index - 1;
        if (temperatures[total + index].grade < minimum) {
            minimum = temperatures[total + index].grade;
        }
    }
    var total = humidities.length;
    var index = 0;
    // For humidities.
    for (var x = 0;x < 10; x++) {
        index = index - 1;
        if (humidities[total + index].grade < minimum) {
            minimum = humidities[total + index].grade;
        }
    }
    return minimum;
}

function getMaximum() {
    var maximum = 0;
    var index = 0;
    var total = temperatures.length;
    // For temperatures.
    for (var i = 0;i < 10; i++) {
        index = index - 1;
        if (temperatures[total + index].grade > maximum) {
            maximum = temperatures[total + index].grade;
        }
    }
    var total = humidities.length;
    var index = 0;
    // For humidities.
    for (var x = 0;x < 10; x++) {
        index = index - 1;
        if (humidities[total + index].grade > maximum) {
            maximum = humidities[total + index].grade;
        }
    }
    return maximum;
}

// Using round to the nearest 10.
function getNearest(number) {
    // console.log(Math.ceil((number) / 10) * 10);
    return Math.ceil((number) / 10) * 10;
}

</script>
@endsection
