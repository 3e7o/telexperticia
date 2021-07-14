$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample2').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample2').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample3').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample3').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample4').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample4').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample5').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample5').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample6').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample6').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample7').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample7').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample8').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample8').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';
  $(function() {
    $('#dataTableExample9').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "Todos"]
      ],
	  "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	  "responsive": true,
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample9').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample10').DataTable({
      "lengthMenu": false,
      "info":     false,
      "iDisplayLength": 5,
	    "responsive": true,
      "scrollY":        "200px",
      "scrollCollapse": true,
      "paging":         false,
      "language": {
                  url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                  }
    });
    $('#dataTableExample10').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
  

});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample11').DataTable({
      "lengthMenu": false,
      "info":     false,
	    "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	    "responsive": true,
      "paging":         true,
      "bLengthChange" : false,
      
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#dataTableExample11').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
});

$(function() {
  'use strict';

  $(function() {
    $('#pacientes1').DataTable({
      "lengthMenu": false,
      "info":     false,
	    "order": [[ 0, "desc" ]],
      "iDisplayLength": 10,
	    "responsive": true,
      "paging":         true,
      "bLengthChange" : false,
      
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#pacientes1').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
});

$(function() {
  'use strict';

  $(function() {
    $('#pacientes2').DataTable({
      "lengthMenu": false,
      "info":     false,
	    "order": [[ 0, "desc" ]],
      "iDisplayLength": 4,
	    "responsive": true,
      "paging":         true,
      "bLengthChange" : false,
      
      "language": {
		url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    });
    $('#pacientes2').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });
});