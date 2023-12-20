mobiscroll.setOptions({
    theme: 'ios',
    themeVariant: 'light'
});

var min = '2023-12-20T00:00';
var max = '2024-06-20T00:00';

mobiscroll.datepicker('#demo-booking-single', {
    display: 'inline',
    controls: ['calendar'],
    min: min,
    max: max,
    pages: 'auto',
    onPageLoading: function (event, inst) {
        getPrices(event.firstDay, function callback(bookings) {
            inst.setOptions({
                labels: bookings.labels,
                invalid: bookings.invalid
            });
        });
    }
});

mobiscroll.datepicker('#demo-booking-datetime', {
    display: 'inline',
    controls: ['calendar', 'timegrid'],
    min: min,
    max: max,
    minTime: '08:00',
    maxTime: '19:59',
    stepMinute: 60,
    width: null,
    onPageLoading: function (event, inst) {
        getDatetimes(event.firstDay, function callback(bookings) {
            inst.setOptions({
                labels: bookings.labels,
                invalid: bookings.invalid
            });
        });
    }
});

mobiscroll.datepicker('#demo-booking-multiple', {
    display: 'inline',
    controls: ['calendar'],
    min: min,
    max: max,
    pages: 'auto',
    selectMultiple: true,
    onInit: function (event, inst) {
        inst.setVal([
            '2023-12-11T00:00',
            '2023-12-16T00:00',
            '2023-12-17T00:00'
        ], true);
    },
    onPageLoading: function (event, inst) {
        getBookings(event.firstDay, function callback(bookings) {
            inst.setOptions({
                labels: bookings.labels,
                invalid: bookings.invalid
            });
        });
    }
});

function getPrices(d, callback) {
    var invalid = [],
        labels = [];

    mobiscroll.getJson('https://trial.mobiscroll.com/getprices/?year=' + d.getFullYear() + '&month=' + d.getMonth(), function (bookings) {
        for (var i = 0; i < bookings.length; ++i) {
            var booking = bookings[i],
                d = new Date(booking.d);

            if (booking.price > 0) {
                labels.push({
                    start: d,
                    title: '$' + booking.price,
                    textColor: '#e1528f'
                });
            } else {
                invalid.push(d);
            }
        }
        callback({ labels: labels, invalid: invalid });
    }, 'jsonp');
}


function getDatetimes(day, callback) {
    var invalid = [];
    var labels = [];

    mobiscroll.getJson('https://trial.mobiscroll.com/getbookingtime/?year=' + day.getFullYear() + '&month=' + day.getMonth(), function (bookings) {
        for (var i = 0; i < bookings.length; ++i) {
            var booking = bookings[i];
            var bDate = new Date(booking.d);

            if (booking.nr > 0) {
                labels.push({
                    start: bDate,
                    title: booking.nr + ' SPOTS',
                    textColor: '#e1528f'
                });
                invalid = invalid.concat(booking.invalid);
            } else {
                invalid.push(bDate);
            }
        }
        callback({ labels: labels, invalid: invalid });
    }, 'jsonp');
}

function getBookings(d, callback) {
    var invalid = [],
        labels = [];

    mobiscroll.getJson('https://trial.mobiscroll.com/getbookings/?year=' + d.getFullYear() + '&month=' + d.getMonth(), function (bookings) {
        for (var i = 0; i < bookings.length; ++i) {
            var booking = bookings[i],
                d = new Date(booking.d);

            if (booking.nr > 0) {
                labels.push({
                    start: d,
                    title: booking.nr + ' SPOTS',
                    textColor: '#e1528f'
                });
            } else {
                invalid.push(d);
            }
        }
        callback({ labels: labels, invalid: invalid });
    }, 'jsonp');
}