@include('_partials.head')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <canvas id="PieChart1"></canvas>
        </div>
        <div class="col-md-6 col-sm-12">
            <canvas id="PieChart2"></canvas>
        </div>
        <div class="col-sm-12">
            <canvas id="BarChart1"></canvas>
        </div>
    </div>
</div>
@include('_partials.js-includes')
<script>
    getTopTenComputerModels();
    getOperatingSystemCounts();
    getLocationCounts();
</script>
@include('_partials.footer')
