$(function() {

  // sample calendar events data

  var curYear = moment().format('YYYY');
  var curMonth = moment().format('MM');

  // Calendar Event Source
  var calendarEvents = {
    id: 1,
    backgroundColor: 'rgba(0.06, 0.72, 0.35)',
    borderColor: '#10B759',
  };

  // Birthday Events Source
  var birthdayEvents = {
    id: 2,
    backgroundColor: 'rgba(0.06, 0.72, 0.35)',
    borderColor: '#10B759',
  };


  // initialize the external events
  $('#external-events .fc-event').each(function() {
    // store data so the calendar knows to render an event upon drop

    $(this).data('event', {
      title: $.trim($(this).text()), // use the element's text as the event title
      stick: true, // maintain when user navigates (see docs on the renderEvent method)
    });
    // make the event draggable using jQuery UI
    $(this).draggable({
      zIndex: 999,
      revert: true,      // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
    });

  });


  // initialize the calendar
  $('#fullcalendar').fullCalendar({
    header: {
      left: 'prev,today,next',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listMonth'
    },
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar
    dragRevertDuration: 0,
    defaultView: 'month',
    eventLimit: true, // allow "more" link when too many events
    eventSources: [calendarEvents, birthdayEvents, holidayEvents, discoveredEvents, meetupEvents, otherEvents],
    eventClick:  function(event, jsEvent, view) {
      $('#modalTitle1').html(event.title);
      $('#modalBody1').html(event.description);
      $('#eventUrl').attr('href',event.url);
      $('#fullCalModal').modal();
    },

    eventDragStop: function( event, jsEvent, ui, view ) {
      if(isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
        // $('#calendar').fullCalendar('removeEvents', event._id);
        var el = $( "<div class='fc-event'>" ).appendTo( '#external-events-listing' ).text( event.title );
        el.draggable({
          zIndex: 999,
          revert: true,
          revertDuration: 0
        });
        el.data('event', { title: event.title, id :event.id, stick: true });
      }
    }
  });


  var isEventOverDiv = function(x, y) {
    var external_events = $( '#external-events' );
    var offset = external_events.offset();
    offset.right = external_events.width() + offset.left;
    offset.bottom = external_events.height() + offset.top;

    // Compare
    if (x >= offset.left
      && y >= offset.top
      && x <= offset.right
      && y <= offset .bottom) { return true; }
    return false;
  }

});
