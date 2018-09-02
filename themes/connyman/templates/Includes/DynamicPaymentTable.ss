<div class="row text-center">
    <div class="col-sm-12 table-striped table-responsive-md">
        <h3>Payments</h3>
        <table class="table">
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
            <tr v-for="payment in tableData.payments.edges">
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
                <td>{{ payment.node.Created | formatDate }}</td>
            </tr>
            <!-- end -->
            </tbody>
        </table>
    </div>
</div>
