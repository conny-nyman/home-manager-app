<div class="row text-center">
    <div class="col-md-12">
        <h1>Budget manager</h1>
        <hr>
    </div>
    <div class="col-md-4">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="add-payment-options" value="add-payment-options" v-model="extraFields.showAddPaymentOptions">
            <label class="custom-control-label" for="add-payment-options">Add payment options</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="add-payments" value="add-payments" v-model="extraFields.showAddPayments">
            <label class="custom-control-label" for="add-payments">Add payments</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="show-payment-table" value="show-payment-table" v-model="extraFields.showPaymentTable">
            <label class="custom-control-label" for="show-payment-table">Show payment table</label>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
</div>
