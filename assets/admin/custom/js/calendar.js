(function () {    
    'use strict';

    jQuery(function() {
        // Page is ready
        $('#calendar').fullCalendar({
            themeSystem: 'bootstrap4',
            businessHours: false,
            defaultView: 'month',
            editable: true,
            header: {
                left: 'title',
                center: 'month,agendaWeek,agendaDay',
                right: 'today prev,next'
            },
            events: function(start, end, timezone, callback) {
                jQuery.ajax({
                    url: base_url + 'admin/tour/get_tour_events',
                    type: 'GET',
                    dataType: 'json',
                    success: function(doc) {
                        console.log("Received Events:", doc); // Debugging के लिए चेक करें
                        var events = [];
                        if (doc && Array.isArray(doc)) {
                            $.each(doc, function(index, r) {
                                events.push({
                                    id: r.id,
                                    title: r.title || 'Tour Event', 
                                    start: r.start,
                                    end: r.end || null, 
                                    description: `<strong>Time Slot:</strong> ${r.t_time_slot || 'Not Available'}`,
                                    className: 'tour-event',
                                    icon: r.event_icon || '',
                                    
                                    // Child 1 Information
                                    t_child_name_1: r.t_child_name_1 || 'N/A',
                                    t_child_lname_1: r.t_child_lname_1 || '',
                                    t_gender_1: r.t_gender_1 || 'N/A',
                                    t_dob_1: r.t_dob_1 || 'N/A',
                                    t_class_1: r.t_class_1 || 'N/A',

                                    // Child 2 Information
                                    t_child_name_2: r.t_child_name_2 || 'N/A',
                                    t_child_lname_2: r.t_child_lname_2 || '',
                                    t_gender_2: r.t_gender_2 || 'N/A',
                                    t_dob_2: r.t_dob_2 || 'N/A',
                                    t_class_2: r.t_class_2 || 'N/A',

                                    // Family Information
                                    t_mother_name: r.t_mother_name || 'N/A',
                                    t_mother_phone: r.t_mother_phone || 'N/A',
                                    t_mother_email: r.t_mother_email || 'N/A',
                                    t_father_name: r.t_father_name || 'N/A',
                                    t_father_phone: r.t_father_phone || 'N/A',
                                    t_father_email: r.t_father_email || 'N/A',

                                    // Contact & Address Info
                                    t_address: r.t_address || 'N/A',
                                    t_city: r.t_city || 'N/A',
                                    t_state: r.t_state || 'N/A',
                                    t_zip_code: r.t_zip_code || 'N/A',

                                    // Other Information
                                    t_communication_method: r.t_communication_method || 'N/A',
                                    t_start_date_field: r.t_start_date_field || 'N/A',
                                    t_previous_school: r.t_previous_school || 'N/A',
                                    t_important_factors: r.t_important_factors || 'N/A',
                                    t_source: r.t_source || 'N/A',
                                    t_program: r.t_program || 'N/A',
                                    t_referral_name: r.t_referral_name || 'N/A',
                                    t_other_notes: r.t_other_notes || 'N/A',
                                    t_agegroups: r.t_agegroups || 'N/A',
                                });
                            });
                        }
                        callback(events);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                    }
                });
            },            
            eventRender: function(event, element) {
                element.css({
                    'background-color': '#ff5733', // Tour event color
                    'border-radius': '5px',
                    'color': '#fff',
                    'padding': '5px'
                });
                element.find(".fc-time").remove();
            },            
            eventClick: function(event) {
                console.log("Clicked Event Full Data:", event); // Debugging
                let startDateFormatted = event.start ? moment(event.start).format("M-D-YYYY") : 'N/A';
            
                let eventDetails = `
                    <h4 class="event-heading">Child 1 Information</h4>
                    <strong>Name:</strong> ${event.t_child_name_1 || 'N/A'} ${event.t_child_lname_1 || ''}<br>
                    <strong>Gender:</strong> ${event.t_gender_1 || 'N/A'}<br>
                    <strong>Date of Birth:</strong> ${event.t_dob_1 || 'N/A'}<br>
                    <strong>Class:</strong> ${event.t_class_1 || 'N/A'}<br><br>
                    
                    <h4 class="event-heading">Child 2 Information</h4>
                    <strong>Name:</strong> ${event.t_child_name_2 || 'N/A'} ${event.t_child_lname_2 || ''}<br>
                    <strong>Gender:</strong> ${event.t_gender_2 || 'N/A'}<br>
                    <strong>Date of Birth:</strong> ${event.t_dob_2 || 'N/A'}<br>
                    <strong>Class:</strong> ${event.t_class_2 || 'N/A'}<br><br>

                    <h4 class="event-heading">Family Information</h4>
                    <strong>Mother:</strong> ${event.title || 'N/A'}<br>
                    <strong>Mother's Phone:</strong> ${event.t_mother_phone || 'N/A'}<br>
                    <strong>Mother's Email:</strong> ${event.t_mother_email || 'N/A'}<br>
                    <strong>Father:</strong> ${event.t_father_name || 'N/A'}<br>
                    <strong>Father's Phone:</strong> ${event.t_father_phone || 'N/A'}<br>
                    <strong>Father's Email:</strong> ${event.t_father_email || 'N/A'}<br><br>

                   <h4 class="event-heading">Contact & Address</h4>
                    <strong>Address:</strong> ${event.t_address || 'N/A'}<br>
                    <strong>City:</strong> ${event.t_city || 'N/A'}<br>
                    <strong>State:</strong> ${event.t_state || 'N/A'}<br>
                    <strong>ZIP Code:</strong> ${event.t_zip_code || 'N/A'}<br><br>

                    <h4 class="event-heading">Other Information</h4>
                    <strong>Communication Method:</strong> ${event.t_communication_method || 'N/A'}<br>
                    <strong>Start Date:</strong> ${startDateFormatted}<br>
                    <strong>Previous School:</strong> ${event.t_previous_school || 'N/A'}<br>
                    <strong>Important Factors:</strong> ${event.t_important_factors || 'N/A'}<br>
                    <strong>Source:</strong> ${event.t_source || 'N/A'}<br>
                    <strong>Program:</strong> ${event.t_program || 'N/A'}<br>
                    <strong>Referral Name:</strong> ${event.t_referral_name || 'N/A'}<br>
                    <strong>Other Notes:</strong> ${event.t_other_notes || 'N/A'}<br>
                    <strong>Age Groups:</strong> ${event.t_agegroups || 'N/A'}<br>
                `;

                $('#modal-view-event .event-title').text(event.title);
                $('#modal-view-event .event-body').html(eventDetails);
                $('#modal-view-event').modal('show');
            }
        });
    });

})(jQuery);
