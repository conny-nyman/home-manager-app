<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="$ContentLocale">
<head>
    <% base_tag %>
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    $MetaTags(false)
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="your/path/here/favicon.ico"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
<div id="app" class="container-fluid">
    $Layout
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/js/mdb.min.js"></script>

<%--<script>--%>
    <%--//bar--%>
    <%--var ctxB = document.getElementById("barChart").getContext('2d');--%>

    <%--var users = [];--%>
    <%--var userValues = [];--%>
    <%--$(document).ready(function () {--%>
        <%--$("#payment-table tr td:nth-child(1)").each(function (i) {--%>
            <%--users.push($(this).text());--%>
        <%--});--%>

        <%--$("#payment-table tr td:nth-child(2)").each(function (i) {--%>
            <%--userValues.push($(this).text());--%>
        <%--});--%>

        <%--var myBarChart = new Chart(ctxB, {--%>
            <%--type: 'bar',--%>
            <%--data: {--%>
                <%--labels: users,--%>
                <%--datasets: [{--%>
                    <%--label: 'euros',--%>
                    <%--data: userValues,--%>
                    <%--backgroundColor: [--%>
                        <%--'rgba(255, 99, 132, 0.2)',--%>
                        <%--'rgba(54, 162, 235, 0.2)'--%>
                    <%--],--%>
                    <%--borderColor: [--%>
                        <%--'rgba(255,99,132,1)',--%>
                        <%--'rgba(54, 162, 235, 1)'--%>
                    <%--],--%>
                    <%--borderWidth: 1--%>
                <%--}]--%>
            <%--},--%>
            <%--options: {--%>
                <%--scales: {--%>
                    <%--yAxes: [{--%>
                        <%--ticks: {--%>
                            <%--beginAtZero: true--%>
                        <%--}--%>
                    <%--}]--%>
                <%--}--%>
            <%--}--%>
        <%--});--%>
    <%--});--%>
<%--</script>--%>


</body>
</html>
