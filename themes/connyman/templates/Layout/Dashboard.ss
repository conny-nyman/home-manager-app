<div class="jumbotron text-center">
    <h1>House manager dashboard</h1>
    <p>Resize responsive page to see the effect!</p>
</div>
<div class="container p-1">
    <div class="row">
        <div class="col-md-4 custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="add-category" v-model="extraFields.showCategoryField">
            <label class="custom-control-label" for="add-category">Add new category</label>
            <div class="row d-flex align-items-center" v-if="extraFields.showCategoryField">
                <div class="col-md-6">
                    <input type="text" class="form-control" v-model="paymentOptions.categoryTitle">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" @click="addCategory">Add</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="add-type" v-model="extraFields.showTypesField">
            <label class="custom-control-label" for="add-type">Add new type</label>
            <div class="row d-flex align-items-center" v-if="extraFields.showTypesField">
                <div class="col-md-6">
                    <input type="text" class="form-control" v-model="paymentOptions.typeTitle">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" @click="addType">Add</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="add-store" v-model="extraFields.showStoreField">
            <label class="custom-control-label" for="add-store">Add new store</label>
            <div class="row d-flex align-items-center" v-if="extraFields.showStoreField">
                <div class="col-md-6">
                    <input type="text" class="form-control" v-model="paymentOptions.storeTitle">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" @click="addStore">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container p-1">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Budget manager</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 px-5">
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
        <div class="col-md-3 d-flex align-items-center">
            <button type="button" class="btn btn-info" @click="savePayment">Save</button>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-12">
            <hr>
            <h3>Payments</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Sum</th>
                    <th scope="col">Category</th>
                    <th scope="col">Type</th>
                    <th scope="col">Store</th>
                </tr>
                </thead>
                <tbody>
                    <% loop $Payments %>
                    <tr>
                        <% loop $HouseMembers %>
                            <td>$FirstName $Surname</td>
                        <% end_loop %>
                        <td>$Sum</td>
                        <% loop $Categorys %>
                            <% if $First %>
                            <td><% end_if %>
                            $Title<% if not $Last %>,<% end_if %>
                            <% if $Last %></td><% end_if %>
                        <% end_loop %>
                        <% loop $Types %>
                            <% if $First %>
                            <td><% end_if %>
                            $Title<% if not $Last %>,<% end_if %>
                            <% if $Last %></td><% end_if %>
                        <% end_loop %>
                        <% loop $Stores %>
                            <% if $First %>
                            <td><% end_if %>
                            $Title<% if not $Last %>,<% end_if %>
                            <% if $Last %></td><% end_if %>
                        <% end_loop %>
                    </tr>
                    <% end_loop %>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12">
            <h4>Total sums</h4>
            <table id="payment-table" class="table">
                <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Sum</th>
                </tr>
                </thead>
                <tbody>
                    <% loop $Users %>
                    <tr>
                        <td>$FirstName $Surname</td>
                        <td>
                            <% loop $Payments.sum(Sum) %>
                                <strong>
                                    <% if $Me %>
                                        $Me
                                    <% else %>
                                        0
                                    <% end_if %>
                                </strong>
                            <% end_loop %>
                        </td>
                    </tr>
                    <% end_loop %>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>


