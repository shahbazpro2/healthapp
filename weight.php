<?php
$pgtitle = "Weight";
include_once('includes/header.php');
include_once("classes/DbFunctions.php");
include_once("classes/Validation.php");

$dbFunctions = new DbFunctions();
$validation = new Validation();
$id = $_SESSION['id'];
$result = $dbFunctions->getData("select * from weight where userID=$id ORDER BY ts DESC");
?>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">
        <?php include_once('includes/nav.php'); ?>
        <div class="main">
            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="mb-5 text-center display-6">Your Weight journey</h1>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Weight Chart</h5>
                                    <div class="d-flex">
                                        <button class="btn btn-primary me-2">Last 7 days</button>
                                        <button class="btn btn-primary me-2">Last 4 weeks</button>
                                        <button class="btn btn-primary me-2">1 year </button>
                                        <button class="btn btn-primary me-2">Set your own</button>
                                        <button class="btn btn-primary me-2">All</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart w-100">
                                        <div id="apexcharts-area"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="d-flex mt-3 mb-4">
                        <button class="btn btn-primary" onclick="addWeight()">Add Weight</button>
                    </div>
                    <div class="col-md-12" id="add-weight">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputEmail4">Enter Date</label>
                                            <input class="form-control" type="text" name="datesingle" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputPassword4">Enter Time</label>
                                            <input type="time" class="form-control">
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputAddress">Enter Weight</label>
                                            <div class="input-group mb-3">
                                                <input type="text" placeholder="Enter Weight" class="form-control">
                                                <span class="input-group-text">kg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center" style="height:100%">
                                                <button type=" submit" class="btn btn-warning">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card flex-fill">
                            <table id="datatables-dashboard-traffic" class="table table-striped my-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="text-end">Time</th>
                                        <th class="d-none d-xl-table-cell text-end">Timestamp</th>
                                        <th class="d-none d-xl-table-cell text-end">Unix</th>
                                        <th class="d-none d-xl-table-cell text-end">Weight (kg)</th>
                                        <th class="d-none d-xl-table-cell text-end">Change</th>
                                        <th class="d-none d-xl-table-cell text-end"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $key => $res) {
                                        $datetime = explode(" ", $res['ts']);
                                        $date = date('D d M Y', strtotime($datetime[0]));
                                        $time = date('h:i: A', strtotime($datetime[1]));

                                    ?>
                                    <tr>
                                        <td><?= $date; ?></td>
                                        <td class="text-end"><?= $time ?></td>
                                        <td class="d-none d-xl-table-cell text-end"><?= $res['ts']; ?></td>
                                        <td class="d-none d-xl-table-cell text-end"><?= $res['unix']; ?></td>
                                        <td class="d-none d-xl-table-cell text-end"><?= $res['weight']; ?></td>
                                        <td class="d-none d-xl-table-cell text-end text-success">1.8%</td>
                                        <td class="d-none d-xl-table-cell text-end ">
                                            <a class="dropdown-item text-danger" href="#"><i class="align-middle me-1"
                                                    data-feather="trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    }

                                    ?>
                                    <tr>
                                        <td>Tue 23 Mar 2021</td>
                                        <td class="text-end">11:07 AM</td>
                                        <td class="d-none d-xl-table-cell text-end">2021-03-23 11:07:00</td>
                                        <td class="d-none d-xl-table-cell text-end">1616458020000</td>
                                        <td class="d-none d-xl-table-cell text-end">119.1</td>
                                        <td class="d-none d-xl-table-cell text-end text-success">1.8%</td>
                                        <td class="d-none d-xl-table-cell text-end ">
                                            <a class="dropdown-item text-danger" href="#"><i class="align-middle me-1"
                                                    data-feather="trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Twitter</td>
                                        <td class="text-end">462</td>
                                        <td class="d-none d-xl-table-cell text-end">571</td>
                                        <td class="d-none d-xl-table-cell text-end text-success">31.53%</td>
                                        <td class="d-none d-xl-table-cell text-end">00:08:05</td>
                                    </tr>
                                    <tr>
                                        <td>Pinterest</td>
                                        <td class="text-end">623</td>
                                        <td class="d-none d-xl-table-cell text-end">770</td>
                                        <td class="d-none d-xl-table-cell text-end text-danger">52.81%</td>
                                        <td class="d-none d-xl-table-cell text-end">00:03:10</td>
                                    </tr>
                                    <tr>
                                        <td>Facebook</td>
                                        <td class="text-end">812</td>
                                        <td class="d-none d-xl-table-cell text-end">1003</td>
                                        <td class="d-none d-xl-table-cell text-end text-success">24.83%</td>
                                        <td class="d-none d-xl-table-cell text-end">00:05:56</td>
                                    </tr>
                                    <tr>
                                        <td>DuckDuckGo</td>
                                        <td class="text-end">693</td>
                                        <td class="d-none d-xl-table-cell text-end">856</td>
                                        <td class="d-none d-xl-table-cell text-end text-success">37.36%</td>
                                        <td class="d-none d-xl-table-cell text-end">00:09:12</td>
                                    </tr>
                                    <tr>
                                        <td>GitHub</td>
                                        <td class="text-end">713</td>
                                        <td class="d-none d-xl-table-cell text-end">881</td>
                                        <td class="d-none d-xl-table-cell text-end text-success">38.09%</td>
                                        <td class="d-none d-xl-table-cell text-end">00:06:19</td>
                                    </tr>
                                    <tr>
                                        <td>Direct</td>
                                        <td class="text-end">872</td>
                                        <td class="d-none d-xl-table-cell text-end">1077</td>
                                        <td class="d-none d-xl-table-cell text-end text-success">32.70%</td>
                                        <td class="d-none d-xl-table-cell text-end">00:09:18</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms of Service</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-0">
                                &copy; 2021 - <a href="index.html" class="text-muted">AppStack</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="lib/js/app.js"></script>

    <script>
    let isWeightBox = false;
    document.getElementById('add-weight').style.display = "none";

    function addWeight() {

        isWeightBox = !isWeightBox
        console.log(isWeightBox)
        if (isWeightBox == false) {
            document.getElementById('add-weight').style.display = "none";
        } else {
            document.getElementById('add-weight').style.display = "block";
        }

    }
    //date

    document.addEventListener("DOMContentLoaded", function() {
        // Select2
        $(".select2").each(function() {
            $(this)
                .wrap("<div class=\"position-relative\"></div>")
                .select2({
                    placeholder: "Select value",
                    dropdownParent: $(this).parent()
                });
        })
        // Daterangepicker

        $("input[name=\"datesingle\"]").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });


        // Datetimepicker
        $('#datetimepicker-minimum').datetimepicker();
        $('#datetimepicker-view-mode').datetimepicker({
            viewMode: 'years'
        });
        $('#datetimepicker-time').datetimepicker({
            format: 'LT'
        });
        $('#datetimepicker-date').datetimepicker({
            format: 'L'
        });
    });


    //end date
    document.addEventListener("DOMContentLoaded", function() {
        // Line chart
        var options = {
            chart: {
                height: 350,
                type: "line",
                zoom: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [5, 7, 5],
                curve: "straight",
                dashArray: [0, 8, 5]
            },
            series: [{
                name: "Session Duration",
                data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
            }, {
                name: "Page Views",
                data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
            }, {
                name: "Total Visits",
                data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
            }],
            markers: {
                size: 0,
                style: "hollow", // full, hollow, inverted
            },
            xaxis: {
                categories: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "08 Jan",
                    "09 Jan", "10 Jan", "11 Jan", "12 Jan"
                ],
            },
            tooltip: {
                y: [{
                    title: {
                        formatter: function(val) {
                            return val + " (mins)"
                        }
                    }
                }, {
                    title: {
                        formatter: function(val) {
                            return val + " per session"
                        }
                    }
                }, {
                    title: {
                        formatter: function(val) {
                            return val;
                        }
                    }
                }]
            },
            grid: {
                borderColor: "#f1f1f1",
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-line"),
            options
        );
        chart.render();
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Area chart
        var options = {
            chart: {
                height: 350,
                type: "area",
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth"
            },
            series: [{
                name: "series1",
                data: [31, 40, 28, 51, 42, 109, 100]
            }, {
                name: "series2",
                data: [11, 32, 45, 32, 34, 52, 41]
            }],
            xaxis: {
                type: "datetime",
                categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00",
                    "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00",
                    "2018-09-19T06:30:00"
                ],
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm"
                },
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-area"),
            options
        );
        chart.render();
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        var options = {
            chart: {
                height: 350,
                type: "bar",
                stacked: true,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                },
            },
            stroke: {
                width: 1,
                colors: ["#fff"]
            },
            series: [{
                name: "Marine Sprite",
                data: [44, 55, 41, 37, 22, 43, 21]
            }, {
                name: "Striking Calf",
                data: [53, 32, 33, 52, 13, 43, 32]
            }, {
                name: "Tank Picture",
                data: [12, 17, 11, 9, 15, 11, 20]
            }, {
                name: "Bucket Slope",
                data: [9, 7, 5, 8, 6, 9, 4]
            }, {
                name: "Reborn Kid",
                data: [25, 12, 19, 32, 25, 24, 10]
            }],
            xaxis: {
                categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
                labels: {
                    formatter: function(val) {
                        return val + "K"
                    }
                }
            },
            yaxis: {
                title: {
                    text: undefined
                },
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + "K"
                    }
                }
            },
            fill: {
                opacity: 1
            },
            legend: {
                position: "top",
                horizontalAlign: "left",
                offsetX: 40
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-bar"),
            options
        );
        chart.render();
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Column chart
        var options = {
            chart: {
                height: 350,
                type: "bar",
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: "rounded",
                    columnWidth: "55%",
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            series: [{
                name: "Net Profit",
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: "Revenue",
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
                name: "Free Cash Flow",
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            xaxis: {
                categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct"],
            },
            yaxis: {
                title: {
                    text: "$ (thousands)"
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-column"),
            options
        );
        chart.render();
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        var options = {
            chart: {
                height: 350,
                type: "donut",
            },
            dataLabels: {
                enabled: false
            },
            series: [44, 55, 13, 33]
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-pie"),
            options
        );
        chart.render();
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Heatmap chart
        function generateData(count, yrange) {
            var i = 0;
            var series = [];
            while (i < count) {
                var x = (i + 1).toString();
                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                series.push({
                    x: x,
                    y: y
                });
                i++;
            }
            return series;
        }
        var options = {
            chart: {
                height: 350,
                type: "heatmap",
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#008FFB"],
            series: [{
                name: "Metric1",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Metric2",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Metric3",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Metric4",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Metric5",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Metric6",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Metric7",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Metric8",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }, {
                name: "Metric9",
                data: generateData(20, {
                    min: 0,
                    max: 90
                })
            }],
            xaxis: {
                type: "category",
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-heatmap"),
            options
        );
        chart.render();
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mixed chart
        var options = {
            chart: {
                height: 350,
                type: "line",
                stacked: false,
            },
            stroke: {
                width: [0, 2, 5],
                curve: "smooth"
            },
            plotOptions: {
                bar: {
                    columnWidth: "50%"
                }
            },
            series: [{
                name: "TEAM A",
                type: "column",
                data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
            }, {
                name: "TEAM B",
                type: "area",
                data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
            }, {
                name: "TEAM C",
                type: "line",
                data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
            }],
            fill: {
                opacity: [0.85, 0.25, 1],
                gradient: {
                    inverseColors: false,
                    shade: "light",
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: ["01/01/2003", "02/01/2003", "03/01/2003", "04/01/2003", "05/01/2003", "06/01/2003",
                "07/01/2003", "08/01/2003", "09/01/2003", "10/01/2003",
                "11/01/2003"
            ],
            markers: {
                size: 0
            },
            xaxis: {
                type: "datetime"
            },
            yaxis: {
                title: {
                    text: "Points",
                },
                min: 0
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " points";
                        }
                        return y;
                    }
                }
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-mixed"), {
                chart: {
                    height: 350,
                    type: "line",
                    stacked: false,
                },
                stroke: {
                    width: [0, 2, 5],
                    curve: "smooth"
                },
                plotOptions: {
                    bar: {
                        columnWidth: "50%"
                    }
                },
                series: [{
                    name: "TEAM A",
                    type: "column",
                    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
                }, {
                    name: "TEAM B",
                    type: "area",
                    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
                }, {
                    name: "TEAM C",
                    type: "line",
                    data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
                }],
                fill: {
                    opacity: [0.85, 0.25, 1],
                    gradient: {
                        inverseColors: false,
                        shade: "light",
                        type: "vertical",
                        opacityFrom: 0.85,
                        opacityTo: 0.55,
                        stops: [0, 100, 100, 100]
                    }
                },
                labels: ["01/01/2003", "02/01/2003", "03/01/2003", "04/01/2003", "05/01/2003", "06/01/2003",
                    "07/01/2003", "08/01/2003", "09/01/2003", "10/01/2003",
                    "11/01/2003"
                ],
                markers: {
                    size: 0
                },
                xaxis: {
                    type: "datetime"
                },
                yaxis: {
                    title: {
                        text: "Points",
                    },
                    min: 0
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " points";
                            }
                            return y;
                        }
                    }
                }
            }
        );
        chart.render();
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Candlestick chart
        var seriesData = [{
            x: new Date(2016, 1, 1),
            y: [51.98, 56.29, 51.59, 53.85]
        }, {
            x: new Date(2016, 2, 1),
            y: [53.66, 54.99, 51.35, 52.95]
        }, {
            x: new Date(2016, 3, 1),
            y: [52.96, 53.78, 51.54, 52.48]
        }, {
            x: new Date(2016, 4, 1),
            y: [52.54, 52.79, 47.88, 49.24]
        }, {
            x: new Date(2016, 5, 1),
            y: [49.10, 52.86, 47.70, 52.78]
        }, {
            x: new Date(2016, 6, 1),
            y: [52.83, 53.48, 50.32, 52.29]
        }, {
            x: new Date(2016, 7, 1),
            y: [52.20, 54.48, 51.64, 52.58]
        }, {
            x: new Date(2016, 8, 1),
            y: [52.76, 57.35, 52.15, 57.03]
        }, {
            x: new Date(2016, 9, 1),
            y: [57.04, 58.15, 48.88, 56.19]
        }, {
            x: new Date(2016, 10, 1),
            y: [56.09, 58.85, 55.48, 58.79]
        }, {
            x: new Date(2016, 11, 1),
            y: [58.78, 59.65, 58.23, 59.05]
        }, {
            x: new Date(2017, 0, 1),
            y: [59.37, 61.11, 59.35, 60.34]
        }, {
            x: new Date(2017, 1, 1),
            y: [60.40, 60.52, 56.71, 56.93]
        }, {
            x: new Date(2017, 2, 1),
            y: [57.02, 59.71, 56.04, 56.82]
        }, {
            x: new Date(2017, 3, 1),
            y: [56.97, 59.62, 54.77, 59.30]
        }, {
            x: new Date(2017, 4, 1),
            y: [59.11, 62.29, 59.10, 59.85]
        }, {
            x: new Date(2017, 5, 1),
            y: [59.97, 60.11, 55.66, 58.42]
        }, {
            x: new Date(2017, 6, ),
            y: [58.34, 60.93, 56.75, 57.42]
        }, {
            x: new Date(2017, 7, 1),
            y: [57.76, 58.08, 51.18, 54.71]
        }, {
            x: new Date(2017, 8, 1),
            y: [54.80, 61.42, 53.18, 57.35]
        }, {
            x: new Date(2017, 9, 1),
            y: [57.56, 63.09, 57.00, 62.99]
        }, {
            x: new Date(2017, 10, 1),
            y: [62.89, 63.42, 59.72, 61.76]
        }, {
            x: new Date(2017, 11, 1),
            y: [61.71, 64.15, 61.29, 63.04]
        }];
        var options = {
            chart: {
                height: 350,
                type: "candlestick",
            },
            series: [{
                data: seriesData
            }],
            stroke: {
                width: 1
            },
            xaxis: {
                type: "datetime"
            }
        };
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-candlestick"),
            options
        );
        chart.render();
    });
    </script>

</body>

</html>