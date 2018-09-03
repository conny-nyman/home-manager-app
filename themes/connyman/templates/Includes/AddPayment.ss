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
        <div class="custom-control custom-checkbox" v-for="category in paymentOptions.categories">
            <input type="checkbox" class="custom-control-input" :id="category.Title" :value="category.ID" v-model="formData.categoryIds">
            <label class="custom-control-label" :for="category.Title">{{ category.Title }}</label>
        </div>
    </div>
    <div class="col-md-2">
        <h3>Type</h3>
        <div class="custom-control custom-checkbox" v-for="type in paymentOptions.types">
            <input type="checkbox" class="custom-control-input" :id="type.Title" :value="type.ID" v-model="formData.typeIds">
            <label class="custom-control-label" :for="type.Title">{{ type.Title }}</label>
        </div>
    </div>
    <div class="col-md-2">
        <h3>Store</h3>
        <div class="custom-control custom-checkbox" v-for="store in paymentOptions.stores">
            <input type="checkbox" class="custom-control-input" :id="store.Title" :value="store.ID" v-model="formData.storeIds">
            <label class="custom-control-label" :for="store.Title">{{ store.Title }}</label>
        </div>
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
