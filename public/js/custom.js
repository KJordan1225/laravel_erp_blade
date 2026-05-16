document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('erpSidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
    }

    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const confirmed = confirm('Are you sure you want to delete this record?');

            if (!confirmed) {
                event.preventDefault();
            }
        });
    });

    const lineItemTables = document.querySelectorAll('[data-line-items]');

    lineItemTables.forEach(function (table) {
        table.addEventListener('input', function () {
            calculateLineItems(table);
        });
    });
});

function calculateLineItems(table) {
    let subtotal = 0;

    const rows = table.querySelectorAll('[data-line-row]');

    rows.forEach(function (row) {
        const quantityInput = row.querySelector('[data-quantity]');
        const priceInput = row.querySelector('[data-price]');
        const totalInput = row.querySelector('[data-line-total]');

        const quantity = parseFloat(quantityInput?.value || 0);
        const price = parseFloat(priceInput?.value || 0);
        const lineTotal = quantity * price;

        if (totalInput) {
            totalInput.value = lineTotal.toFixed(2);
        }

        subtotal += lineTotal;
    });

    const subtotalInput = document.querySelector('[data-subtotal]');
    const taxInput = document.querySelector('[data-tax]');
    const discountInput = document.querySelector('[data-discount]');
    const totalInput = document.querySelector('[data-total]');

    const tax = parseFloat(taxInput?.value || 0);
    const discount = parseFloat(discountInput?.value || 0);
    const total = subtotal + tax - discount;

    if (subtotalInput) subtotalInput.value = subtotal.toFixed(2);
    if (totalInput) totalInput.value = total.toFixed(2);
}
