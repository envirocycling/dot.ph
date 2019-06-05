<link class="include" rel="stylesheet" type="text/css" href="../jquery.jqplot.min.css" />


<script class="include" type="text/javascript" src="../jquery.min.js"></script>

<script>
    $(document).ready(function () {
        var s1 = [[1, 15.5], [2, 15.5], [3, 15.5], [4, 15.5], [5, 14.75], [6, 12.75], [7, 12], [8, 11.5], [9, 12.25], [10,12.5], [11,12.5], [12, 12.5]];
        var s2 = [[1, 3002.91], [2, 3090], [3, 3230], [4, 4115], [5, 4306], [6, 4871], [7, 3521], [8, 3904], [9, 3409], [10,3625], [11,2760], [12, 2440]];
        var s4 = [[1, 16], [2, 16], [3, 15.5], [4, 15.8], [5,15.3], [6,14 ], [7, 11.5], [8,12], [9, 13], [10, 13], [11, 13], [12, 13]];

        plot1 = $.jqplot("chart1", [s2, s1,s4], {
            // Turns on animatino for all series in this plot.
            animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
            cursor: {
                show: true,
                zoom: true,
                looseZoom: true,
                showTooltip: false
            },
            series:[
                {
                    pointLabels: {
                        show: true
                    },
                    renderer: $.jqplot.BarRenderer,
                    showHighlight: false,
                    yaxis: 'y2axis',
                    rendererOptions: {
                        // Speed up the animation a little bit.
                        // This is a number of milliseconds.
                        // Default for bar series is 3000.
                        animation: {
                            speed: 2500
                        },
                        barWidth: 15,
                        barPadding: -15,
                        barMargin: 0,
                        highlightMouseOver: false
                    }
                },
                {
                    rendererOptions: {
                        // speed up the animation a little bit.
                        // This is a number of milliseconds.
                        // Default for a line series is 2500.
                        animation: {
                            speed: 5000
                        }
                    }
                }
            ],
            axesDefaults: {
                pad: 0
            },
            axes: {
                // These options will set up the x axis like a category axis.
                xaxis: {
                    tickInterval: 1,
                    drawMajorGridlines: false,
                    drawMinorGridlines: true,
                    drawMajorTickMarks: false,
                    rendererOptions: {
                        tickInset: 0.5,
                        minorTicks: 1,
                        tickOptions: {
                            formatString: " "

                        },
                        rendererOptions: {
                            forceTickAt0: true
                        }

                    }
                },
                yaxis: {
                    tickOptions: {
                        formatString: "%' .2f"
                    },
                    rendererOptions: {
                        forceTickAt0: true
                    }
                },


                y2axis: {
                    tickOptions: {
                        formatString: "%' .2f"
                    },
                    rendererOptions: {
                        // align the ticks on the y2 axis with the y axis.
                        alignTicks: true,
                        forceTickAt0: true
                    }
                }
            },
            highlighter: {
                show: true,
                showLabel: true,
                tooltipAxes: 'y',
                sizeAdjust: 7.5 , tooltipLocation : 'ne'
            }
        });

    });
</script>


<script class="include" type="text/javascript" src="../jquery.jqplot.min.js"></script>

<script class="include" type="text/javascript" src="../plugins/jqplot.barRenderer.min.js"></script>

<script type="text/javascript" src="../plugins/jqplot.cursor.min.js"></script>


<div id="chart1" style=""></div>


