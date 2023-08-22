;
(function ($) {

    function getDashboardData() {
        let url = $("#get-dashboard-url").val();
        $.ajax({
            type: 'GET',
            url: url,
            success: function(res){
                $('.quiz_category').text(res.quiz_category);
                $('.total_balance').text(res.total_balance);
                $('.total_quizes').text(res.total_quizes);
                $('.total_questions').text(res.total_questions);
                $('.total_withdraw').text(res.total_withdraw);
                $('.pending_withdraw').text(res.pending_withdraw);
                $('.approved_withdraw').text(res.approved_withdraw);
                $('.rejected_withdraw').text(res.rejected_withdraw);
                $('.total_user').text(res.total_user);
                $('.total_currency').text(res.total_currency);
                $('.currency_covert').text(res.currency_covert);
                $('.total_rewards').text(res.total_rewards);

                var dates = [];
                var totals = [];
                $.each(res.withdraws_data, function (index, value) {
                    dates.push(value.month + ', ' + value.year);
                    totals.push(value.total);
                });
                mtChart(dates, totals)
            },
        })
    }

    $("img").unveil();
    getDashboardData();

    function mtChart(dates, totals) {
        if ($('#timeline-chart').length) {
            let statiStics = $("#timeline-chart");
            let statiSticsValu = new Chart(statiStics, {
                type: "line",
                data: {
                    labels: dates,
                    datasets: [
                        {
                            label: "Withdraw",
                            backgroundColor: "#FE4F4F",
                            borderWidth: 1,
                            borderColor: "#FE4F4F",
                            data: totals,
                        },
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        // mode: 'index',
                        intersect: false,
                    },
                    elements: {
                        point: {
                            radius: 0,
                        }
                    },
                    tooltips: {
                        displayColors: true,
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        title: {
                            // display: true,
                        }
                    },
                    scales: {

                        x: {
                            display: false,
                            stacked: true,
                        },
                        y: {
                            beginAtZero: true
                        },
                    },
                }
            });
        };
    };
})(jQuery);
