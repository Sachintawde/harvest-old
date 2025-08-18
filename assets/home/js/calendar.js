jQuery(document).ready(function(){
    jQuery('.datetimepicker').datepicker({
        timepicker: true,
        language: 'en',
        range: true,
        multipleDates: true,
            multipleDatesSeparator: " - "
      });
    jQuery("#add-event").submit(function(){
        alert("Submitted");
        var values = {};
        $.each($('#add-event').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        console.log(
          values
        );
    });
  });
  
  (function () {    
      'use strict';
      // ------------------------------------------------------- //
      // Calendar
      // ------------------------------------------------------ //
      jQuery(function() {
          // page is ready
          $('#calendar').fullCalendar({
            themeSystem: 'bootstrap4',
            // emphasizes business hours
            businessHours: false,
            defaultView: 'month',
            // event dragging & resizing
            editable: true,
            // header
            header: {
                left: 'title',
                center: 'month,agendaWeek,agendaDay',
                right: 'today prev,next'
            },
            events: function(start, end, timezone, callback) {
                jQuery.ajax({
                    url: base_url+'calendar/calendar_event',
                    type: 'POST',
                    dataType: 'json',
                    // data: {
                    //     start: start.format(),
                    //     end: end.format()
                    // },
                    success: function(doc) {
                        console.log(doc);
                        var events = [];
                        if(!!doc){
                            $.map( doc, function( r ) {
                                events.push({
                                    id: r.event_id,
                                    title: r.event_name,
                                    start: r.event_start,
                                    end: r.event_end,
                                    description: r.event_desc,
                                    className: r.event_classname,
                                    icon : r.event_icon,
                                    type: r.event_type
                                });
                            });
                        }
                        callback(events);
                    }
                });
            },
            eventRender: function(event, element) {
                console.log(element);
                            if (event.type == "Early Dismissal Day for all students"){
                                element.css('background-color', '#90D052');
                            }else if (event.type == "School Closed"){
                                element.css('background-color', '#F93005');
                            }else if (event.type == "Parent Teacher Conf."){
                                element.css('background-color', '#EEC4B8');
                            }else if (event.type == "Special Events") {
                                element.css('background-color', '#CD97FF');
                            }else if (event.type == "Picture Days"){
                                element.css('background-color', '#986C08');
                            }else if (event.type == "First & Last Day of School"){
                                element.css('background-color', '#A5A4A7');
                            }else if (event.type == "APC/Academic program closed! Full-time students only"){
                                element.css('background-color', '#006EC8');
                            }
                            
                            // Remove time
                            element.find(".fc-time").remove();
                        
                            // Remove icon
                            element.find(".fa").remove();
                          if(event.icon){
                              element.find(".fc-time").prepend("<i class='fa fa-"+event.icon+"'></i>");
                          } 
                        },
                      dayClick: function() {
                          jQuery('#modal-view-event-add').modal();
                      },
                      eventClick: function(event, jsEvent, view) {
                        var startTime = moment(event.start).format('h:mmA');
                        console.log(event);
                              jQuery('.event-icon').html("<i class='fa fa-"+event.icon+"'></i>");
                              jQuery('.event-title').html(event.title);
                              jQuery('.event-time').html(startTime);
                              jQuery('.event-body').html(event.description);
                              jQuery('.eventUrl').attr('href',event.url);
                              jQuery('#modal-view-event').modal();
                      },
        });
      });
    
  })(jQuery);