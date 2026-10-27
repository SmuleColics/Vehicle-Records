$(document).ready(function () {
  $('#vehiclesTable').DataTable({
    pageLength: 10,
    dom: '<"d-flex align-items-center justify-content-between mb-3"lf>tip',
    // dashboard cards link here with ?search=... to open a filtered list
    search: { search: new URLSearchParams(window.location.search).get('search') || '' },
    order: [],
    language: {
      search: '',
      searchPlaceholder: 'Search vehicles…',
      info: 'Showing _START_ to _END_ of _TOTAL_ vehicles',
      paginate: {
        previous: '<i class="bi bi-chevron-left"></i>',
        next: '<i class="bi bi-chevron-right"></i>',
      },
    },
    columnDefs: [{ orderable: false, targets: -1 }],
  });

});
