<div class="jumbotron text-center bg-dark text-white">
    <h1>House manager dashboard - $Group.Title</h1>
    <p>Keep your shit together!</p>
</div>
<div class="container p-3 bg-white rounded">
    <% include Header %>
    <template v-if="extraFields.showAddPaymentOptions">
        <% include AddPaymentOptions %>
    </template>
    <template v-if="extraFields.showAddPayments">
        <% include AddPayment %>
    </template>
    <template v-if="extraFields.showPaymentTable">
        <% include DynamicPaymentTable %>
    </template>
    <div class="row">
        <div class="col-sm-12">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>


