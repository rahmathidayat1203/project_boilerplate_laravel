// Import Bootstrap 4 (jQuery should already be available from jquery.js)
import 'bootstrap';

// Import DataTables (which also depends on jQuery)
import 'datatables.net-bs4';
import 'datatables.net-buttons-bs4';

// Ensure DataTables defaults exist for compatibility
if (window.DataTable && !window.DataTable.defaults) {
    window.DataTable.defaults = {};
}

// Import AdminLTE (jQuery should already be available)
import 'admin-lte/dist/js/adminlte.min.js';

// Import DataTables CSS
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css';
