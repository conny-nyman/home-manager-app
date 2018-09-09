<div class="row text-center">
    <div class="col-sm-12 table-striped table-responsive-md p-0">
        <h3>Payments</h3>
        <div class="row p-3">
            <div class="col-md-4">
                <app-multiselect v-model="tableData.filter.houseMembers" :searchable="false" placeholder="Select member" :options="paymentOptions.houseMembers" label="FirstName" track-by="FirstName"
                                 :multiple="true"></app-multiselect>
                <app-multiselect class="mt-1" v-model="tableData.filter.categories" :searchable="false" placeholder="Select category" :options="paymentOptions.categories" label="Title" track-by="Title"
                                 :multiple="true"></app-multiselect>
            </div>
            <div class="col-md-4">
                <app-multiselect v-model="tableData.filter.types" :searchable="false" placeholder="Select type" :options="paymentOptions.types" label="Title" track-by="Title"
                                 :multiple="true"></app-multiselect>
                <app-multiselect class="mt-1" v-model="tableData.filter.stores" :searchable="false" placeholder="Select store" :options="paymentOptions.stores" label="Title" track-by="Title"
                                 :multiple="true"></app-multiselect>
            </div>
            <div class="col-md-2">
                <app-datepicker class="text-dark" placeholder="Select start date" format="dd/MM/yyyy" :clear-button="true" :bootstrap-styling="true"
                                v-model="tableData.filter.startDate"></app-datepicker>
                <app-datepicker class="mt-1 text-dark" placeholder="Select end date" format="dd/MM/yyyy" :clear-button="true" :bootstrap-styling="true"
                                v-model="tableData.filter.endDate"></app-datepicker>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-outline-info" @click="getPayments">Update table</button>
            </div>
        </div>
        <div v-if="sortedPayments.length > 0">
            <hr :class="{'bg-white' : darkMode}">
            <h5 class="mt-3"><strong>Sum</strong> {{ paymentSum | currency }}</h5>
            <hr :class="{'bg-white' : darkMode}">
        </div>
        <table v-if="sortedPayments.length > 0" class="table" :class="{'table-dark': darkMode}">
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
                <td>{{ payment.HouseMembers[0].FirstName }} {{ payment.HouseMembers[0].Surname }}</td>
                <td>{{ payment.Sum }}</td>
                <td>
                    <template v-for="category in payment.Categories">
                        {{ category.Title }}
                    </template>
                </td>
                <td>
                    <template v-for="type in payment.Types">
                        {{ type.Title }}
                    </template>
                </td>
                <td>
                    <template v-for="store in payment.Stores">
                        {{ store.Title }}
                    </template>
                </td>
                <td>{{ payment.DateOfPayment | formatDate }}</td>
            </tr>
            <!-- end -->
            </tbody>
        </table>
        <div v-else>
            <h4 class="m-3">No payments found. ¯\\_(ツ)_/¯</h4>
        </div>
    </div>
</div>

