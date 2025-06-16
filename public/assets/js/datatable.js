$(document).ready( function () {

    $('#product_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/product",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'available', name: 'available' },
            { data: 'sold', name: 'sold' },
            { data: 'date', name: 'date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });


     $('#vendor_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/vendor",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'total_voucher', name: 'total_voucher' },
            { data: 'available_voucher', name: 'available_voucher' },
            { data: 'redeem_voucher', name: 'redeem_voucher' },
            { data: 'date', name: 'date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });

     $('#supplier_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/supplier",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'contact', name: 'contact' },
            { data: 'total_license', name: 'total_license' },
            { data: 'date', name: 'date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });

     $('#license_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/license",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'key', name: 'key' },
            { data: 'product', name: 'product' },
            { data: 'reference', name: 'reference' },
            { data: 'date', name: 'date' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });
     
     $('#voucher_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/voucher",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'id', name: 'id' },
            { data: 'voucher', name: 'voucher' },
            { data: 'product', name: 'product' },
            { data: 'vendor', name: 'vendor' },
            { data: 'date', name: 'date' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });
     
     
     $('#blocking_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/blocking",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'order_id', name: 'order_id' },
            { data: 'reason', name: 'reason' },
            { data: 'date', name: 'date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });


     $('#replacement_license_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/license-replacement",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'username', name: 'username' },
            { data: 'key', name: 'key' },
            { data: 'product', name: 'product' },
            { data: 'reference', name: 'reference' },
            { data: 'supplier', name: 'supplier' },
            { data: 'date', name: 'date' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });


     $('#request_license_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/license-request",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'id', name: 'id' },
            { data: 'user', name: 'user' },
            { data: 'vendor', name: 'vendor' },
            { data: 'product', name: 'product' },
            { data: 'order_id', name: 'order_id' },
            { data: 'order_email', name: 'order_email' },
            { data: 'key', name: 'key' },
            { data: 'reason', name: 'reason' },
            { data: 'date', name: 'date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });



     $('#voucher_redeem_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/voucher-redeem-list",
        columns: [
            { data: 'voucher_code', name: 'voucher_code' },
            { data: 'product_name', name: 'product_name' },
            { data: 'vendor_name', name: 'vendor_name' },
            { data: 'order_id', name: 'order_id' },
            { data: 'order_email', name: 'order_email' },
            { data: 'license_key', name: 'license_key' },
            { data: 'redeem_date', name: 'redeem_date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });

     $('#user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/dashboard/user",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'type', name: 'type' },
            { data: 'date', name: 'date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });


    //  for clientarea 

    $('#client_voucher_redeem_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/clientarea/voucher-redeem-list",
        columns: [
            { data: 'voucher_code', name: 'voucher_code' },
            { data: 'product_name', name: 'product_name' },
            { data: 'vendor_name', name: 'vendor_name' },
            { data: 'order_id', name: 'order_id' },
            { data: 'order_email', name: 'order_email' },
            { data: 'license_key', name: 'license_key' },
            { data: 'redeem_date', name: 'redeem_date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
     });

     $('#client_request_license_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/clientarea/license-request",
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
            { data: 'vendor', name: 'vendor' },
            { data: 'product', name: 'product' },
            { data: 'order_id', name: 'order_id' },
            { data: 'order_email', name: 'order_email' },
            { data: 'key', name: 'key' },
            { data: 'reason', name: 'reason' },
            { data: 'date', name: 'date' },
        ],
     });


});