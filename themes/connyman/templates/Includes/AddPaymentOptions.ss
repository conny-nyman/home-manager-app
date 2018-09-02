<div class="row m-3">
    <div class="col-md-4 custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="add-category" v-model="extraFields.showCategoryField">
        <label class="custom-control-label" for="add-category">Add new category</label>
        <transition name="fade">
            <div class="row d-flex align-items-center" v-if="extraFields.showCategoryField">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Title" v-model="paymentOptions.categoryTitle">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-outline-info waves-effect" @click="saveCategory">Add</button>
                </div>
            </div>
        </transition>
    </div>
    <div class="col-md-4 custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="add-type" v-model="extraFields.showTypesField">
        <label class="custom-control-label" for="add-type">Add new type</label>
        <transition name="fade">
            <div class="row d-flex align-items-center" v-if="extraFields.showTypesField">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Title" v-model="paymentOptions.typeTitle">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-outline-default waves-effect" @click="saveType">Add</button>
                </div>
            </div>
        </transition>
    </div>
    <div class="col-md-4 custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="add-store" v-model="extraFields.showStoreField">
        <label class="custom-control-label" for="add-store">Add new store</label>
        <transition name="fade">
            <div class="row d-flex align-items-center" v-if="extraFields.showStoreField">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Title" v-model="paymentOptions.storeTitle">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-outline-success waves-effect" @click="saveStore">Add</button>
                </div>
            </div>
        </transition>
    </div>
</div>
