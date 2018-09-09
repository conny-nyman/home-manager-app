<div class="row">
    <div class="col-md-4">
        <h3>Sum</h3>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="Sum"><i class="fas fa-euro-sign"></i></span>
            </div>
            <input type="number" class="form-control" placeholder="Sum" value="0" min="0" step="0.1" aria-label="Sum" aria-describedby="Sum"
                   v-model="formData.sum">
        </div>
    </div>
    <div class="col-md-4">
        <h3>Category, Type & Store</h3>
        <app-multiselect v-model="formData.categoryIds" :searchable="false" placeholder="Select category" :options="paymentOptions.categories" label="Title" track-by="ID" :multiple="true"></app-multiselect>
        <app-multiselect class="mt-1" v-model="formData.typeIds" :searchable="false" placeholder="Select type" :options="paymentOptions.types" label="Title" track-by="ID" :multiple="true"></app-multiselect>
        <app-multiselect class="mt-1" v-model="formData.storeIds" :searchable="false" placeholder="Select store" :options="paymentOptions.stores" label="Title" track-by="ID" :multiple="true"></app-multiselect>
    </div>
    <div class="col-md-3">
        <div class="row">
            <h3>Date of payment</h3>
            <app-datepicker class="text-dark" placeholder="Select date" format="dd/MM/yyyy" :clear-button="true" :bootstrap-styling="true" v-model="formData.dateOfPayment"></app-datepicker>
        </div>
        <div class="row my-4 d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-outline-info" @click="savePayment">Save</button>
        </div>
    </div>
</div>
<hr :class="{'bg-white' : darkMode}">