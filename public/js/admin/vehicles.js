$(document).ready(function () {
  $('#vehiclesTable').DataTable({
    pageLength: 10,
    dom: '<"d-flex align-items-center justify-content-between mb-3"lf>tip',
    language: {
      search: '',
      searchPlaceholder: 'Search users…',
      info: 'Showing _START_ to _END_ of _TOTAL_ users',
      paginate: {
        previous: '<i class="bi bi-chevron-left"></i>',
        next: '<i class="bi bi-chevron-right"></i>',
      },
    },
    columnDefs: [{ orderable: false, targets: -1 }],
  });

});
