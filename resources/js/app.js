$(document).ready(function () {

    const today = new Date();
    const year = today.getFullYear();
    let month = today.getMonth() + 1;
    if (month < 10) {
        month = `0${month}`;
    }
    let day = today.getDate();
    if (day < 10) {
        day = `0${day}`;
    }
    const formattedDate = `${year}-${month}-${day}`;
    $(".date").attr("min", formattedDate);

    $('.status').on('change', function (){
        var bookId = $(this).data('id');
        var selectedValue = $(this).val();
        var csrfToken = $('.csrf').val();
        $.ajax({
            url: '/admin/change-book',
            type: 'POST',
            data: {
                'bookId': bookId,
                '_token': csrfToken,
                'status': selectedValue,
            },
            success: function(response) {
                console.log('Змінено успішно.');
            },
            error: function(error) {
                console.error(error);
            }
        });
    });

    $('.delete').on('click', function (e){
        e.preventDefault()
        var bookId = $(this).data('id');
        var csrfToken = $('.csrf').val();
        var clickedTrElement = $(this).closest('tr');
        $.ajax({
            url: '/admin/delete-book',
            type: 'POST',
            data: {
                'bookId': bookId,
                '_token': csrfToken,
            },
            success: function(response) {
                clickedTrElement.hide();
            },
            error: function(error) {
            }
        });
    });

    getDates()


});

function getDates(){
    $.ajax({
        url: '/get-dates',
        type: 'GET',
        success: function(response) {
            var bookedDates  = response.dates;

            function isDateBooked(date) {
                var formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
                return bookedDates.includes(formattedDate);
            }
            var minSelectableDate = new Date();

            $('#check-in, #check-out').datepicker({
                dateFormat: 'dd.mm.yy',
                minDate: minSelectableDate,
                monthNames: ['Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'],
                monthNamesShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
                dayNames: ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'П\'ятниця', 'Субота'],
                dayNamesShort: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                dayNamesMin: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                firstDay: 1,
                prevText: '&#x3c;Поп',
                nextText: 'Наст&#x3e;',
                currentText: 'Сьогодні',
                closeText: 'Закрити',
                showMonthAfterYear: false,
                yearSuffix: '',
                beforeShowDay: function(date) {
                    var dayIsBooked = isDateBooked(date);
                    return [!dayIsBooked, dayIsBooked ? 'booked' : ''];
                }
            });
        },
        error: function(error) {
            console.error(error);
        }
    });

}
