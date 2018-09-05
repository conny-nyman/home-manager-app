<div class="row text-center">
    <div class="col-sm-12 table-striped table-responsive-md">
        <h3>Payments</h3>
        <div class="row">
            <div class="col-md-4">
                <app-multiselect v-model="tableData.filter.houseMembers" :options="paymentOptions.houseMembers" label="FirstName" track-by="FirstName"
                                 :multiple="true"></app-multiselect>
                <app-multiselect class="mt-1" v-model="tableData.filter.categories" :options="paymentOptions.categories" label="Title" track-by="Title"
                                 :multiple="true"></app-multiselect>
            </div>
            <div class="col-md-4">
                <app-multiselect v-model="tableData.filter.types" :options="paymentOptions.types" label="Title" track-by="Title"
                                 :multiple="true"></app-multiselect>
                <app-multiselect class="mt-1" v-model="tableData.filter.stores" :options="paymentOptions.stores" label="Title" track-by="Title"
                                 :multiple="true"></app-multiselect>
            </div>
            <div class="col-md-2">
                <app-datepicker placeholder="Select start date" format="dd/MM/yyyy" :bootstrap-styling="true"
                                v-model="tableData.filter.startDate"></app-datepicker>
                <app-datepicker class="mt-1" placeholder="Select end date" format="dd/MM/yyyy" :bootstrap-styling="true"
                                v-model="tableData.filter.endDate"></app-datepicker>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-info" @click="getPayments">Update table</button>
            </div>
        </div>
        <div v-if="sortedPayments.length > 0">
            <hr>
            <h5 class="mt-3"><strong>Sum</strong> {{ paymentSum | currency }}</h5>
            <hr>
        </div>
        <table v-if="sortedPayments.length > 0" class="table">
            <thead>
            <tr>
                <th scope="col">User</th>
                <th scope="col">Sum</th>
                <th scope="col">Category</th>
                <th scope="col">Type</th>
                <th scope="col">Store</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="payment in sortedPayments">
                <td>{{ payment.node.HouseMembers.edges[0].node.FirstName }} {{ payment.node.HouseMembers.edges[0].node.Surname }}</td>
                <td>{{ payment.node.Sum }}</td>
                <td>
                    <template v-for="category in payment.node.Categorys.edges">
                        {{ category.node.Title }}
                    </template>
                </td>
                <td>
                    <template v-for="type in payment.node.Types.edges">
                        {{ type.node.Title }}
                    </template>
                </td>
                <td>
                    <template v-for="store in payment.node.Stores.edges">
                        {{ store.node.Title }}
                    </template>
                </td>
                <td>{{ payment.node.DateOfPayment | formatDate }}</td>
            </tr>
            <!-- end -->
            </tbody>
        </table>
        <div v-else>
            <h4 class="m-3">No payments found. ¯\\_(ツ)_/¯</h4>
        </div>
    </div>
</div>

