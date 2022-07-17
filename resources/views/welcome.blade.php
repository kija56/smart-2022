<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name') ?? 'Smart Tech Inc.'}}</title>
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
                        <svg class="w-6 h-6 mr-2 fill-current" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12H12M18 12H12M12 12V6M12 12V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Import CSV
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