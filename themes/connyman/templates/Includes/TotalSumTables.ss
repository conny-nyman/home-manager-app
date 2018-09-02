<div class="row text-center">
    <div class="col-sm-12 table-striped table-responsive-md">
        <hr>
        <h3>Payments - $Now.Month</h3>
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
                    <td>$Created.Nice</td>
                </tr>
                <% end_loop %>
            </tbody>
        </table>
    </div>
    <!-- Total sum tables -->
    <div class="col-sm-12  table-striped table-responsive-md">
        <h5>Total sums</h5>
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
    <!-- Total sum by category -->
    <div class="col-sm-12  table-striped table-responsive-md">
        <% loop $Users %>
            <h5>$FirstName $Surname - Category</h5>
            <table id="payment-table" class="table">
                <thead>
                <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Sum</th>
                </tr>
                </thead>
                <tbody>
                    <% loop $Categories %>
                    <tr>
                        <td>$Title</td>
                        <td>
                            <% loop $Payments.Filter('Categorys.Title', $Title).Filter('HouseMembers.FirstName', $Up.FirstName).sum(Sum) %>
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
        <% end_loop %>
    </div>
    <!-- Total sum by type -->
    <div class="col-sm-12  table-striped table-responsive-md">
        <% loop $Users %>
            <h5>$FirstName $Surname - Type</h5>
            <table id="payment-table" class="table">
                <thead>
                <tr>
                    <th scope="col">Types</th>
                    <th scope="col">Sum</th>
                </tr>
                </thead>
                <tbody>
                    <% loop $Types %>
                    <tr>
                        <td>$Title</td>
                        <td>
                            <% loop $Payments.Filter('Types.Title', $Title).Filter('HouseMembers.FirstName', $Up.FirstName).sum(Sum) %>
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
        <% end_loop %>
    </div>
    <!-- Total sum by store -->
    <div class="col-sm-12  table-striped table-responsive-md">
        <% loop $Users %>
            <h5>$FirstName $Surname - Store </h5>
            <table id="payment-table" class="table">
                <thead>
                <tr>
                    <th scope="col">Stores</th>
                    <th scope="col">Sum</th>
                </tr>
                </thead>
                <tbody>
                    <% loop $Stores %>
                    <tr>
                        <td>$Title</td>
                        <td>
                            <% loop $Payments.Filter('Stores.Title', $Title).Filter('HouseMembers.FirstName', $Up.FirstName).sum(Sum) %>
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
        <% end_loop %>
    </div>
</div>
