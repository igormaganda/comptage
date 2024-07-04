/*
Template Name: Judia - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Calendar init js
*/

var start_date = document.getElementById("event-start-date");
var timepicker1 = document.getElementById("timepicker1");
var timepicker2 = document.getElementById("timepicker2");

var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
var defaultEvents = [
    {
        id: 1,
        title: 'All Day Event',
        start: new Date(y, m, 1),
        className: 'bg-primary-subtle',
        location: 'San Francisco, US',
        allDay: true,
        extendedProps: {
            department: 'All Day Event',
            category: "Business",
        },
        description: 'An all-day event is an event that lasts an entire day or longer'
    },
    {
        id: 2,
        title: 'Visit Online Course',
        start: new Date(y, m, d - 5),
        end: new Date(y, m, d - 2),
        allDay: true,
        className: 'bg-warning-subtle',
        extendedProps: {
            department: 'Long Event',
            category: "Business",
        },
        description: 'Long Term Event means an incident that last longer than 12 hours.'
    },
    {
        id: 3,
        title: 'Client Meeting with Alexis',
        start: new Date(y, m, d + 22, 20, 0),
        end: new Date(y, m, d + 24, 16, 0),
        allDay: true,
        className: 'bg-danger-subtle',
        location: 'California, US',
        extendedProps: {
            department: 'Meeting with Alexis',
            category: "Business",
        },
        description: 'A meeting is a gathering of two or more people that has been convened for the purpose of achieving a common goal through verbal interaction, such as sharing information or reaching agreement.'
    },
    {
        id: 4,
        title: 'Repeating Event',
        start: new Date(y, m, d + 4, 16, 0),
        end: new Date(y, m, d + 9, 16, 0),
        allDay: true,
        className: 'bg-primary-subtle',
        location: 'Las Vegas, US',
        extendedProps: {
            department: 'Repeating Event',
            category: "Holiday",
        },
        description: 'A recurring or repeating event is simply any event that you will occur more than once on your calendar. ',
    },
    {
        id: 5,
        title: 'Meeting With Designer',
        start: new Date(y, m, d, 12, 30),
        allDay: true,
        className: 'bg-success-subtle',
        location: 'Head Office, US',
        extendedProps: {
            department: 'Meeting',
            category: "Business",
        },
        description: 'Tell how to boost website traffic'
    },
    {
        id: 6,
        title: 'Weekly Strategy Planning',
        start: new Date(y, m, d + 9),
        end: new Date(y, m, d + 11),
        allDay: true,
        className: 'bg-danger-subtle',
        location: 'Head Office, US',
        extendedProps: {
            department: 'Lunch',
            category: "Holiday",
        },
        description: 'Strategies for Creating Your Weekly Schedule'
    },
    {
        id: 7,
        title: 'Birthday Party',
        start: new Date(y, m, d + 1, 19, 0),
        allDay: true,
        className: 'bg-success-subtle',
        location: 'Los Angeles, US',
        extendedProps: {
            department: 'Birthday Party',
            category: "Family",
        },
        description: 'Family slumber party – Bring out the blankets and pillows and have a family slumber party! Play silly party games, share special snacks and wind down the fun with a special movie.'
    },
    {
        id: 8,
        title: 'Click for Google',
        start: new Date(y, m, 28),
        end: new Date(y, m, 29),
        allDay: true,
        url: 'http://google.com/',
        className: 'bg-dark-subtle',
        extendedProps: {
            department: 'All Day Event',
            category: "Business",
        },
    },
    {
        id: 9,
        title: 'Steex Deadline',
        start: new Date(y, m, 12),
        end: new Date(y, m, 13),
        allDay: true,
        className: 'bg-danger-subtle',
        extendedProps: {
            department: 'All Day Event',
            category: "Business",
        },
    },
    {
        id: 10,
        title: 'Meeting with Developer',
        start: new Date(y, m, 12),
        end: new Date(y, m, 13),
        allDay: true,
        className: 'bg-info-subtle',
        extendedProps: {
            department: 'All Day Event',
            category: "Business",
        },
    },
    {
        id: 11,
        title: 'Personal Work',
        start: new Date(y, m, 12),
        end: new Date(y, m, 13),
        allDay: true,
        className: 'bg-primary-subtle',
        extendedProps: {
            department: 'All Day Event',
            category: "Personal",
        },
    },
    {
        id: 12,
        title: 'Scrum Meeting',
        start: new Date(y, m, 12),
        end: new Date(y, m, 13),
        allDay: true,
        className: 'bg-dark-subtle',
        extendedProps: {
            department: 'All Day Event',
            category: "Business",
        },
    },
    {
        id: 13,
        title: 'Hybrix Project',
        start: new Date(y, m, d + 23, 20, 0),
        end: new Date(y, m, d + 24, 16, 0),
        allDay: true,
        className: 'bg-info-subtle',
        location: 'Head Office, US',
        extendedProps: {
            department: 'Discussion',
            category: "Personal",
        },
        description: 'Tell how to boost website traffic'
    },
];

// document.addEventListener("DOMContentLoaded", function () {
    flatPickrInit();
    var addEvent = new bootstrap.Modal(document.getElementById('event-modal'), {
        keyboard: false
    });
    document.getElementById('event-modal');
    var modalTitle = document.getElementById('modal-title');
    var formEvent = document.getElementById('form-event');
    var selectedEvent = null;
    var forms = document.getElementsByClassName('needs-validation');
    /* initialize the calendar */

    var Draggable = FullCalendar.Draggable;
    var externalEventContainerEl = document.getElementById('external-events');

    
    // init draggable
    if (document.querySelector(".external-event")) {
        new Draggable(externalEventContainerEl, {
            itemSelector: '.external-event',
            eventData: function (eventEl) {
                return {
                    id: Math.floor(Math.random() * 11000),
                    title: eventEl.innerText,
                    allDay: true,
                    start: new Date(),
                    className: eventEl.getAttribute('data-class')
                };
            }
        });
    }


    var calendarEl = document.getElementById('calendar');

    function addNewEvent(info) {
        document.getElementById('form-event').reset();
        document.getElementById('btn-delete-event').setAttribute('hidden', true);
        addEvent.show();
        formEvent.classList.remove("was-validated");
        formEvent.reset();
        selectedEvent = null;
        modalTitle.innerText = 'Add Event';
        newEventData = info;
        document.getElementById("edit-event-btn").setAttribute("data-id", "new-event");
        document.getElementById('edit-event-btn').click();
        document.getElementById("edit-event-btn").setAttribute("hidden", true);
    }

    function getInitialView() {
        if (window.innerWidth >= 768 && window.innerWidth < 1200) {
            return 'timeGridWeek';
        } else if (window.innerWidth <= 768) {
            return 'listMonth';
        } else {
            return 'dayGridMonth';
        }
    }

    var eventCategoryChoice = new Choices("#event-category", {
        searchEnabled: false
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'local',
        editable: true,
        droppable: true,
        selectable: true,
        navLinks: true,
        locale: 'en',
        direction: 'ltr',
        dayMaxEvents: 2,
        initialView: getInitialView(),
        themeSystem: 'bootstrap',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay,listMonth',
        },
        windowResize: function (view) {
            var newView = getInitialView();
            calendar.changeView(newView);
        },
        eventResize: function (info) {
            var indexOfSelectedEvent = defaultEvents.findIndex(function (x) {
                return x.id == info.event.id
            });
            if (defaultEvents[indexOfSelectedEvent]) {
                defaultEvents[indexOfSelectedEvent].title = info.event.title;
                defaultEvents[indexOfSelectedEvent].start = info.event.start;
                defaultEvents[indexOfSelectedEvent].end = (info.event.end) ? info.event.end : null;
                defaultEvents[indexOfSelectedEvent].allDay = info.event.allDay;
                defaultEvents[indexOfSelectedEvent].className = info.event.classNames[0];
                defaultEvents[indexOfSelectedEvent].description = (info.event._def.extendedProps.description) ? info.event._def.extendedProps.description : '';
                defaultEvents[indexOfSelectedEvent].location = (info.event._def.extendedProps.location) ? info.event._def.extendedProps.location : '';
            }

        },
        eventClick: function (info) {
            document.getElementById("edit-event-btn").removeAttribute("hidden");
            document.getElementById('btn-save-event').setAttribute("hidden", true);
            document.getElementById("edit-event-btn").setAttribute("data-id", "edit-event");
            document.getElementById("edit-event-btn").innerHTML = "Edit";
            eventClicked();
            flatPickrInit();
            flatpicekrValueClear();
            addEvent.show();
            formEvent.reset();
            selectedEvent = info.event;

            // First Modal
            document.getElementById("modal-title").innerHTML = "";
            document.getElementById("event-location-tag").innerHTML = selectedEvent.extendedProps.location === undefined ? "No Location" : selectedEvent.extendedProps.location;
            document.getElementById("event-description-tag").innerHTML = selectedEvent.extendedProps.description === undefined ? "No Description" : selectedEvent.extendedProps.description;

            // Edit Modal
            document.getElementById("event-title").value = selectedEvent.title;
            document.getElementById("event-location").value = selectedEvent.extendedProps.location === undefined ? "No Location" : selectedEvent.extendedProps.location;
            document.getElementById("event-description").value = selectedEvent.extendedProps.description === undefined ? "No Description" : selectedEvent.extendedProps.description;
            document.getElementById("eventid").value = selectedEvent.id;

            if (selectedEvent.classNames[0]) {
                eventCategoryChoice.destroy();
                eventCategoryChoice = new Choices("#event-category", {
                    searchEnabled: false
                });
                eventCategoryChoice.setChoiceByValue(selectedEvent.classNames[0]);
            }
            var st_date = selectedEvent.start;
            var ed_date = selectedEvent.end;

            var date_r = function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();
                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;
                return [year, month, day].join('-');
            };
            var r_date = ed_date == null ? (str_dt(st_date)) : (str_dt(st_date)) + ' to ' + (str_dt(ed_date));
            var er_date = ed_date == null ? (date_r(st_date)) : (date_r(st_date)) + ' to ' + (date_r(ed_date));

            flatpickr(start_date, {
                defaultDate: er_date,
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
                mode: ed_date !== null ? "range" : "range",
                onChange: function (selectedDates, dateStr) {
                    var date_range = dateStr;
                    var dates = date_range.split("to");
                    if (dates.length > 1) {
                        document.getElementById('event-time').setAttribute("hidden", true);
                    } else {
                        document.getElementById("timepicker1").parentNode.classList.remove("d-none");
                        document.getElementById("timepicker1").classList.replace("d-none", "d-block");
                        document.getElementById("timepicker2").parentNode.classList.remove("d-none");
                        document.getElementById("timepicker2").classList.replace("d-none", "d-block");
                        document.getElementById('event-time').removeAttribute("hidden");
                    }
                },
            });
            document.getElementById("event-start-date-tag").innerHTML = r_date;

            var gt_time = getTime(selectedEvent.start);
            var ed_time = getTime(selectedEvent.end);

            if (gt_time == ed_time) {
                document.getElementById('event-time').setAttribute("hidden", true);
                flatpickr(document.getElementById("timepicker1"), {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                });
                flatpickr(document.getElementById("timepicker2"), {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                });
            } else {
                document.getElementById('event-time').removeAttribute("hidden");
                flatpickr(document.getElementById("timepicker1"), {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    defaultDate: gt_time
                });

                flatpickr(document.getElementById("timepicker2"), {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    defaultDate: ed_time
                });
                document.getElementById("event-timepicker1-tag").innerHTML = tConvert(gt_time);
                document.getElementById("event-timepicker2-tag").innerHTML = tConvert(ed_time);
            }
            newEventData = null;
            modalTitle.innerText = selectedEvent.title;

            // formEvent.classList.add("view-event");
            document.getElementById('btn-delete-event').removeAttribute('hidden');
        },
        dateClick: function (info) {
            addNewEvent(info);
        },
        events: fetchEvents,
        eventReceive: function (info) {
            var newid = parseInt(info.event.id);
            var newEvent = {
                id: newid,
                title: info.event.title,
                start: info.event.start,
                allDay: info.event.allDay,
                className: info.event.classNames[0]
            };
            defaultEvents.push(newEvent);

        },
        eventDrop: function (info) {
            var indexOfSelectedEvent = defaultEvents.findIndex(function (x) {
                return x.id == info.event.id
            });
            if (defaultEvents[indexOfSelectedEvent]) {
                defaultEvents[indexOfSelectedEvent].title = info.event.title;
                defaultEvents[indexOfSelectedEvent].start = info.event.start;
                defaultEvents[indexOfSelectedEvent].end = (info.event.end) ? info.event.end : null;
                defaultEvents[indexOfSelectedEvent].allDay = info.event.allDay;
                defaultEvents[indexOfSelectedEvent].className = info.event.classNames[0];
                defaultEvents[indexOfSelectedEvent].description = (info.event._def.extendedProps.description) ? info.event._def.extendedProps.description : '';
                defaultEvents[indexOfSelectedEvent].location = (info.event._def.extendedProps.location) ? info.event._def.extendedProps.location : '';
            }

        }
    });

    // localization
    function changeLocale() {
        var selectedLocale = document.getElementById('locale-select').value;
        calendar.setOption('locale', selectedLocale);
    }

    // direction
    function changeDirection() {
        var selectedDirection = document.getElementById('direction-select').value;
        calendar.setOption('direction', selectedDirection);
    }
    
    setTimeout(() => {
        calendar.render();
    }, 0);

    /*Add new event*/
    // Form to add new event
    formEvent.addEventListener('submit', function (ev) {
        ev.preventDefault();
        var updatedTitle = document.getElementById("event-title").value;
        var updatedCategory = document.getElementById('event-category').value;
        var start_date = (document.getElementById("event-start-date").value).split("to");
        var updateStartDate = new Date(start_date[0].trim());
        var updateEndDate = (start_date[1]) ? new Date(start_date[1].trim()) : '';

        var end_date = null;
        var event_location = document.getElementById("event-location").value;
        var eventDescription = document.getElementById("event-description").value;
        var eventid = document.getElementById("eventid").value;
        var all_day = false;
        if (start_date.length > 1) {
            var end_date = new Date(start_date[1]);
            end_date.setDate(end_date.getDate() + 1);
            start_date = new Date(start_date[0]);
            all_day = true;
        } else {
            var e_date = start_date;
            var start_time = (document.getElementById("timepicker1").value).trim();
            var end_time = (document.getElementById("timepicker2").value).trim();
            start_date = new Date(start_date + "T" + start_time);
            end_date = new Date(e_date + "T" + end_time);
        }
        var e_id = defaultEvents.length + 1;

        // validation
        if (forms[0].checkValidity() === false) {
            forms[0].classList.add('was-validated');
        } else {
            if (selectedEvent) {
                selectedEvent.setProp("id", eventid);
                selectedEvent.setProp("title", updatedTitle);
                selectedEvent.setProp("classNames", [updatedCategory]);
                selectedEvent.setStart(updateStartDate);
                selectedEvent.setEnd(updateEndDate);
                selectedEvent.setAllDay(all_day);
                selectedEvent.setExtendedProp("description", eventDescription);
                selectedEvent.setExtendedProp("location", event_location);
                var indexOfSelectedEvent = defaultEvents.findIndex(function (x) {
                    return x.id == selectedEvent.id
                });
                if (defaultEvents[indexOfSelectedEvent]) {
                    defaultEvents[indexOfSelectedEvent].title = updatedTitle;
                    defaultEvents[indexOfSelectedEvent].start = updateStartDate;
                    defaultEvents[indexOfSelectedEvent].end = updateEndDate;
                    defaultEvents[indexOfSelectedEvent].allDay = all_day;
                    defaultEvents[indexOfSelectedEvent].className = updatedCategory;
                    defaultEvents[indexOfSelectedEvent].description = eventDescription;
                    defaultEvents[indexOfSelectedEvent].location = event_location;
                }
                calendar.render();
                // default
            } else {
                var newEvent = {
                    id: e_id,
                    title: updatedTitle,
                    start: start_date,
                    end: end_date,
                    allDay: all_day,
                    className: updatedCategory,
                    description: eventDescription,
                    location: event_location
                };
                calendar.addEvent(newEvent);
                defaultEvents.push(newEvent);
            }
            addEvent.hide();

        }
    });

    document.getElementById("btn-delete-event").addEventListener("click", function (e) {
        if (selectedEvent) {
            for (var i = 0; i < defaultEvents.length; i++) {
                if (defaultEvents[i].id == selectedEvent.id) {
                    defaultEvents.splice(i, 1);
                    i--;
                }
            }

            selectedEvent.remove();
            selectedEvent = null;
            addEvent.hide();
        }
    });
    document.getElementById("btn-new-event").addEventListener("click", function (e) {
        flatpicekrValueClear();
        flatPickrInit();
        addNewEvent();
        document.getElementById("edit-event-btn").setAttribute("data-id", "new-event");
        document.getElementById('edit-event-btn').click();
        document.getElementById("edit-event-btn").setAttribute("hidden", true);
    });
// });


function flatPickrInit() {
    var config = {
        enableTime: true,
        noCalendar: true,
    };
    var date_range = flatpickr(
        start_date, {
        enableTime: false,
        mode: "range",
        minDate: "today",
        onChange: function (selectedDates, dateStr, instance) {
            var date_range = dateStr;
            var dates = date_range.split("to");
            if (dates.length > 1) {
                document.getElementById('event-time').setAttribute("hidden", true);
            } else {
                document.getElementById("timepicker1").parentNode.classList.remove("d-none");
                document.getElementById("timepicker1").classList.replace("d-none", "d-block");
                document.getElementById("timepicker2").parentNode.classList.remove("d-none");
                document.getElementById("timepicker2").classList.replace("d-none", "d-block");
                document.getElementById('event-time').removeAttribute("hidden");
            }
        },
    });
    flatpickr(timepicker1, config);
    flatpickr(timepicker2, config);
}

function flatpicekrValueClear() {
    start_date.flatpickr().clear();
    timepicker1.flatpickr().clear();
    timepicker2.flatpickr().clear();
}


function eventClicked() {
    document.getElementById('form-event').classList.add("view-event");
    document.getElementById("event-title").classList.replace("d-block", "d-none");
    document.getElementById("event-category").classList.replace("d-block", "d-none");
    document.getElementById("event-start-date").parentNode.classList.add("d-none");
    document.getElementById("event-start-date").classList.replace("d-block", "d-none");
    document.getElementById('event-time').setAttribute("hidden", true);
    document.getElementById("timepicker1").parentNode.classList.add("d-none");
    document.getElementById("timepicker1").classList.replace("d-block", "d-none");
    document.getElementById("timepicker2").parentNode.classList.add("d-none");
    document.getElementById("timepicker2").classList.replace("d-block", "d-none");
    document.getElementById("event-location").classList.replace("d-block", "d-none");
    document.getElementById("event-description").classList.replace("d-block", "d-none");
    document.getElementById("event-start-date-tag").classList.replace("d-none", "d-block");
    document.getElementById("event-timepicker1-tag").classList.replace("d-none", "d-block");
    document.getElementById("event-timepicker2-tag").classList.replace("d-none", "d-block");
    document.getElementById("event-location-tag").classList.replace("d-none", "d-block");
    document.getElementById("event-description-tag").classList.replace("d-none", "d-block");
    document.getElementById('btn-save-event').setAttribute("hidden", true);
}

function editEvent(data) {
    var data_id = data.getAttribute("data-id");
    if (data_id == 'new-event') {
        document.getElementById('modal-title').innerHTML = "";
        document.getElementById('modal-title').innerHTML = "Add Event";
        document.getElementById("btn-save-event").innerHTML = "Add Event";
        eventTyped();
    } else if (data_id == 'edit-event') {
        data.innerHTML = "Cancel";
        data.setAttribute("data-id", 'cancel-event');
        document.getElementById("btn-save-event").innerHTML = "Update Event";
        data.removeAttribute("hidden");
        eventTyped();
    } else {
        data.innerHTML = "Edit";
        data.setAttribute("data-id", 'edit-event');
        eventClicked();
    }
}

function eventTyped() {
    document.getElementById('form-event').classList.remove("view-event");
    document.getElementById("event-title").classList.replace("d-none", "d-block");
    document.getElementById("event-category").classList.replace("d-none", "d-block");
    document.getElementById("event-start-date").parentNode.classList.remove("d-none");
    document.getElementById("event-start-date").classList.replace("d-none", "d-block");
    document.getElementById("timepicker1").parentNode.classList.remove("d-none");
    document.getElementById("timepicker1").classList.replace("d-none", "d-block");
    document.getElementById("timepicker2").parentNode.classList.remove("d-none");
    document.getElementById("timepicker2").classList.replace("d-none", "d-block");
    document.getElementById("event-location").classList.replace("d-none", "d-block");
    document.getElementById("event-description").classList.replace("d-none", "d-block");
    document.getElementById("event-start-date-tag").classList.replace("d-block", "d-none");
    document.getElementById("event-timepicker1-tag").classList.replace("d-block", "d-none");
    document.getElementById("event-timepicker2-tag").classList.replace("d-block", "d-none");
    document.getElementById("event-location-tag").classList.replace("d-block", "d-none");
    document.getElementById("event-description-tag").classList.replace("d-block", "d-none");
    document.getElementById('btn-save-event').removeAttribute("hidden");
}

function getTime(params) {
    params = new Date(params);
    if (params.getHours() != null) {
        var hour = params.getHours();
        var minute = (params.getMinutes()) ? params.getMinutes() : 0;
        return hour + ":" + minute;
    }
}

function tConvert(time) {
    var t = time.split(":");
    var hours = t[0];
    var minutes = t[1];
    var newformat = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    return (hours + ':' + minutes + ' ' + newformat);
}

var str_dt = function formatDate(date) {
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date(date),
        month = '' + monthNames[(d.getMonth())],
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;
    return [day + " " + month, year].join(',');
};

// Calender filter functionality
// ------------------------------------------------
const selectAll = document.querySelector('.select-all');
const filterInput = [].slice.call(document.querySelectorAll('.input-filter'));

if (selectAll) {
    selectAll.addEventListener('click', e => {
        if (e.currentTarget.checked) {
            document.querySelectorAll('.input-filter').forEach(c => (c.checked = 1));
        } else {
            document.querySelectorAll('.input-filter').forEach(c => (c.checked = 0));
        }
        calendar.refetchEvents();
    });
}

if (filterInput) {
    filterInput.forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.input-filter:checked').length < document.querySelectorAll('.input-filter').length
                ? (selectAll.checked = false)
                : (selectAll.checked = true);
            calendar.refetchEvents();
        });
    });
}

// Filter events by calender
function selectedCalendars() {
    let selected = [],
      filterInputChecked = [].slice.call(document.querySelectorAll('.input-filter:checked'));

      filterInputChecked.forEach(item => {
          selected.push(item.getAttribute('data-value'));
        });
        return selected;
    }
    
function fetchEvents(info, eventCallback) {
    let calendars = selectedCalendars();
    let selectedEvents = defaultEvents.filter(function (event) {
        return calendars.includes(event.extendedProps.category.toLowerCase());
    });
    eventCallback(selectedEvents);
  }