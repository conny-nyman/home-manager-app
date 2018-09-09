<div class="container p-0 shadow-all-corners">
    <% include Header %>
    <div class="container py-3 bg-white" :class="{'bg-dark': darkMode, 'text-white': darkMode}">
        <% include MenuHeader %>
        <template v-if="extraFields.showAddPaymentOptions">
            <% include AddPaymentOptions %>
        </template>
        <template v-if="extraFields.showAddPayments">
            <% include AddPayment %>
        </template>
        <template v-if="extraFields.showPaymentTable">
            <% include DynamicPaymentTable %>
        </template>
    </div>
</div>
