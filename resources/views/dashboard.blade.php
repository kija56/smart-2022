<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name') ?? 'Smart Tech Inc.'}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @livewireStyles
    <style>
        .highcharts-credits {
            display: none !important;
        }
    </style>
</head>

<body class="leading-normal tracking-wider text-gray-900 bg-gray-100">
    <header class="text-gray-700 border-b border-gray-200 body-font">
        <div class="container flex flex-col flex-wrap items-center justify-between p-5 mx-auto md:flex-row">
            <a class="flex items-center mb-4 font-medium text-gray-900 title-font md:mb-0" href="https://tailblocks.cc" target="_blank">
                <img src="{{asset('sc-logo.png')}}" alt="" class="w-16 px-2 bg-[#FF0D33]">
            </a>
            <div class="flex mx-8 space-x-4">
                <a href="{{route('home')}}">Home</a>
                <a class="border-b border-[#FF0D33]" href="{{route('dashboard')}}">Dashboard</a>
            </div>
        </div>
    </header>

    <!--Container-->
    <div class="container w-4/5 px-2 mx-auto mt-4">

        <div class="p-8 mt-6 bg-white rounded shadow lg:mt-0">
            <div>
                <form action="{{route('dashboard')}}">
                    <select name="q" id="q" onchange="this.form.submit()">
                        @foreach($countries as $country)
                        <option value="{{$country}}" {{ $q == $country ? 'selected' : '' }}>{{$country}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <figure class="highcharts-figure">
                <div id="container"></div>
            </figure>
        </div>
    </div>

    @livewireScripts
</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script>
    let data = <?php echo $data ?>;
    let seriesName = <?php echo json_encode($q) ?>;
    var keys = [];
    let dataArrays = [];

    //console.log(data);
    Object.entries(data).map((value) => {
        dataArrays.push(
            value[1][1]
        );
        keys.push(value[1][0])
    });

    let HC = Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: seriesName + ' Life Expectancy (1990-2020)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: keys,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Years '
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} years</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: seriesName,
            data: dataArrays

        }, ]
    });

    let input = document.getElementById('q')

    input.addEventListener('change', function(ev) {

        HC.series[0].update({
            name: ev.target.value

        })
    })
</script>


</html>