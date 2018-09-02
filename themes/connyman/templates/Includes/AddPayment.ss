<div class="row">
    <div class="col-md-3">
        <h3>Sum</h3>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="Sum"><i class="fas fa-euro-sign"></i></span>
            </div>
            <input type="number" class="form-control" placeholder="Sum" value="0" min="0" step="0.1" aria-label="Sum" aria-describedby="Sum"
                   v-model="formData.sum">
        </div>
    </div>
    <div class="col-md-2">
        <h3>Category</h3>
        <% loop $Categories %>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="$Title" value="$ID" v-model="formData.categoryIds">
                <label class="custom-control-label" for="$Title">$Title</label>
            </div>
        <% end_loop %>
    </div>
    <div class="col-md-2">
        <h3>Type</h3>
        <% loop $Types %>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="$Title" value="$ID" v-model="formData.typeIds">
                <label class="custom-control-label" for="$Title">$Title</label>
            </div>
        <% end_loop %>
    </div>
    <div class="col-md-2">
        <h3>Store</h3>
        <% loop $Stores %>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="$Title" value="$ID" v-model="formData.storeIds">
                <label class="custom-control-label" for="$Title">$Title</label>
            </div>
        <% end_loop %>
    </div>
    <div class="col-md-3">
        <div class="row">
            <h3>Date of payment</h3>
            <app-datepicker placeholder="Select date" format="dd/MM/yyyy" v-model="formData.dateOfPayment"></app-datepicker>
        </div>
        <div class="row my-4 d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-primary" @click="savePayment">Save</button>
            <button type="button" class="btn btn-sm btn-info" @click="getPayments">Update table</button>
        </div>
    </div>
</div>
