<div class="jumbotron text-center bg-dark text-white">
    <h1>House manager dashboard - $Group.Title</h1>
    <p>Keep your shit together!</p>
</div>
<div class="container p-3 bg-white rounded">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Budget manager</h1>
            <hr>
        </div>
    </div>
    <% include AddPaymentOptions %>
    <% include AddPayment %>
    <% include DynamicPaymentTable %>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="showTotalSumTables" v-model="showTotalSumTables">
        <label class="custom-control-label" for="showTotalSumTables">Show all tables</label>
    </div>
    <template v-if="showTotalSumTables">
        <% include TotalSumTables %>
    </template>
    <div class="row">
        <div class="col-sm-12">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>


