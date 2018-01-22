<div ng-controller="AdminController as vm">
    <menu page="admin"></menu>
    <div class="col-md-12">
        <h1>Admin</h1>
    </div>
    <div class="col-md-12">
        <uib-tabset active="0" vertical="true" type="pill" class="my-tabs">
            <uib-tab index="0" heading="Products" classes="my-tab">
                <div class="col-md-6">
                    <h2>Available Products</h2>
                    <table class="table table-striped table-hover">
                        <!-- <thead>
                            <tr>
                                <th>
                                    Product
                                </th>
                                <th>
                                    Price
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in vm.products">
                                <td>
                                    <% item.name %>
                                </td>
                                <td>
                                    <% item.price | currency %>
                                </td>
                                <td>
                                    <button ng-click="vm.edit(item)">Edit</button>
                                    <button ng-click="vm.remove(item)">Remove</button>
                                </td>
                            </tr>
                        </tbody> -->
                    </table>
                    <!-- <button ng-click="vm.add()">Add New</button> -->
                </div>
                <div class="col-md-6">
                    <h2>Current Orders</h2>
                    <!-- <div ng-if="vm.orders.length == 0">
                        Nothing to show
                    </div> -->
                    <div>
                        <table class="table table-striped table-hover">
                            <!-- <thead>
                                <tr>
                                    <th>
                                        Product
                                    </th>
                                    <th>
                                        Order Time
                                    </th>
                                    <th>
                                        Fulfilled?
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in vm.orders">
                                    <td>
                                        <% item.product.name %>
                                    </td>
                                    <td>
                                        <% item.when | date : 'yyyy-MM-dd HH:mm:ss' %>
                                    </td>
                                    <td ng-if="item.fulfilled">
                                        Yes
                                    </td>
                                    <td ng-if="!item.fulfilled">
                                        No
                                    </td>
                                    <td>
                                        <button ng-click="vm.fulfillOrder(item.id)" ng-disabled="item.fulfilled">Fulfill Order</button>
                                        <button ng-click="vm.cancelOrder(item.id)">Cancel Order</button>
                                    </td>
                                </tr>
                            </tbody> -->
                        </table>
                    </div>
                </div>
            </uib-tab>
            <uib-tab index="1" heading="Users" classes="my-tab">
                <h2>Users</h2>
                <table class="table table-striped table-hover">
                    <!-- <thead>
                        <tr>
                            <th>
                                Username
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Role
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="user in vm.users">
                            <td>
                                <% user.username %>
                            </td>
                            <td>
                                <% user.name %>
                            </td>
                            <td>
                                <% user.role %>
                            </td>
                            <td>
                                <button ng-click="vm.editUser(user)">Edit</button>
                                <button ng-click="vm.changePassword(user)">Change Password</button>
                                <button ng-click="vm.deleteUser(user)">Remove</button>
                            </td>
                        </tr>
                    </tbody> -->
                </table>
                <!-- <button ng-click="vm.addUser()">Add New</button> -->
            </uib-tab>
        </uib-tabset>
    </div>
</div>
