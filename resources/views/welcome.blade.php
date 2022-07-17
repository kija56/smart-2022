<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name') ?? 'Smart Codes.'}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <style>
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #FF0D33;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
            line-height: 1.25;
            border-width: 2px;
            border-radius: .25rem;
            border-color: #edf2f7;
            background-color: #edf2f7;
        }

        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            border-radius: .25rem;
            border: 1px solid transparent;
        }

        table.dataTable tr td:first-child {
            text-align: left !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            font-weight: 700;
            border-radius: .25rem;
            background: #FF0D33 !important;
            border: 1px solid transparent;
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            font-weight: 700;
            border-radius: .25rem;
            background: #FF0D33 !important;
            border: 1px solid transparent;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #FF0D33 !important;
        }
    </style>


</head>

<body class="leading-normal tracking-wider text-gray-900 bg-gray-100">
    <header class="text-gray-700 border-b border-gray-200 body-font">
        <div class="container flex flex-col flex-wrap items-center justify-between p-5 mx-auto md:flex-row">
            <a class="flex items-center mb-4 font-medium text-gray-900 title-font md:mb-0" href="https://tailblocks.cc" target="_blank">
                <img src="{{asset('sc-logo.png')}}" alt="" class="w-16 px-2 bg-[#FF0D33]">
            </a>
            <div class="flex mx-8 space-x-4 ">
                <a class=" border-b border-[#FF0D33]" href="{{route('home')}}">Home</a>
                <a href="{{route('dashboard')}}">Dashboard</a>
            </div>
        </div>
    </header>

    <!--Container-->
    <div class="container w-4/5 px-2 mx-auto mt-4">
        <div class="my-4">
            @if ($errors->any() && $errors->has('file'))
            {!! $errors->first(
            'file',
            '<p id="cv_name_help_block" class="my-1 text-red-800">
                :message</p>',
            ) !!}
            @endif
            @include('shared._flash')
            @include('shared.error')
        </div>

        <div id='recipients' class="p-8 mt-6 bg-white rounded shadow lg:mt-0">

            <div class="flex justify-between my-4" x-data="{ isShowing: false }">

                <div x-show="isShowing" class="flex items-center justify-end w-full bg-grey-lighter">
                    <form action="{{ route('data.store') }}" class="flex" method="post" enctype="multipart/form-data">
                        @csrf

                        <label class="block">
                            <span class="sr-only">Choose file</span>
                            <input type="file" name="file" accept="text/plain, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 " />
                        </label>
                        <button type="submit" class="px-4 py-2 mx-8 text-white bg-[#FF0D33] rounded-sm ">Submit</button>
                    </form>
                </div>
                <div x-show="!isShowing" class="flex items-center justify-end w-full">
                    <button @click="isShowing=true" class="inline-flex bg-[#FF0D33] px-2 py-2 text-[#fff] self-end ">
                        <svg class="w-4 h-4 mt-1 mx-1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512" fill="currentColor">
                            <path d="M453.546814,273.4485474h-81.4267578l0.000061-40.7133179h81.4266968V273.4485474z M453.546814,296.7133179h-81.4266968l-0.000061,40.7133789h81.4267578V296.7133179z M453.546814,104.7789307h-81.4266968l-0.000061,40.7133789h81.4267578V104.7789307z M453.546814,168.7570801h-81.4266968l-0.000061,40.7133789h81.4267578V168.7570801z M453.546814,360.6914673h-81.4266968l-0.000061,40.7133789h81.4267578V360.6914673z M509.7894897,440.9549561c-2.3264771,12.0977173-16.8670044,12.3884888-26.5800171,12.7956543h-180.883606v52.3457031h-36.1185913L0,459.5667725V52.491333L267.7775879,5.9036255h34.5482178v46.3553734L476.986084,52.258667c9.8294067,0.4071655,20.647522-0.2907715,29.1973267,5.5835571C512.1740723,66.4501953,511.5928345,77.3846436,512,87.2722168l-0.2330322,302.7910767C511.4761353,406.9884033,513.3373413,424.2625122,509.7894897,440.9549561z M213.2798462,349.6988525c-16.0526733-32.5706787-32.3961792-64.9087524-48.3907471-97.4794312c15.8200684-31.6982422,31.4074707-63.5128174,46.9367065-95.3273926c-13.2027588,0.6397705-26.4055176,1.4540405-39.5501099,2.3846436c-9.8293457,23.9046021-21.2872925,47.1693726-28.9646606,71.8881836c-7.1539307-23.322937-16.6343384-45.7734375-25.300415-68.5147705c-12.7956543,0.697937-25.5912476,1.4540405-38.3869019,2.210144c13.4935913,29.7789307,27.8595581,59.1506958,40.9459839,89.104126c-15.4129028,29.0809326-29.8370361,58.5690308-44.784668,87.8245239c12.7374268,0.5234375,25.4749146,1.046875,38.2124023,1.2213745c9.0732422-23.1484375,20.3566895-45.4244995,28.2666626-69.038208c7.0957642,25.3585815,19.1353149,48.7978516,29.0228271,73.0513916C185.3039551,348.012207,199.2628174,348.8846436,213.2798462,349.6988525z M484.2601929,79.8817749H302.3258057l-0.000061,24.8971558h46.529541v40.7133789h-46.529541v23.2647705h46.529541v40.7133789h-46.529541v23.2647705h46.529541v40.7133179h-46.529541v23.2647705h46.529541v40.7133789h-46.529541v23.2647705h46.529541v40.7133789h-46.529541v26.8971558h181.9344482V79.8817749z"></path>
                        </svg>
                        Import File
                    </button>
                </div>
            </div>
            <hr class="mb-8">

            <table id="countryData" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">Country Name</th>
                        <th data-priority="2">Country Code</th>
                        <th data-priority="3">Average Life Expectancy(Years)</th>
                        <th data-priority="4">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>

        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script>
        'use strict';
        let url = <?php echo json_encode(route('home')) ?>;
    </script>
    <script>
        $(document).ready(function() {
            $('#countryData').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    'searching': true,
                    destroy: true,
                    ajax: {
                        url: url
                    },
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'age',
                            name: 'age'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    columnDefs: [{
                        searchable: false,
                        'targets': 2
                    }],
                    'aaSorting': [
                        [0, 'asc']
                    ],
                    'lengthMenu': [
                        [10, 50, 100, 200, 300, -1],
                        [10, 50, 100, 200, 300, 'All']
                    ]
                })
                .columns.adjust()
                .responsive.recalc();;
        });
    </script>

</body>

</html>