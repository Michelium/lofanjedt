$(document).ready(function () {
    init()
});

function init() {
    initDataTable();
    initFormModal();
    initMeasurementConverter();
    initTemperatureConverter();
}

function initDataTable() {
    $('.DataTable').DataTable({
        pageLength: 25,
    });
}

function initFormModal() {
    $('.form-modal-button').on('click', function () {
        const id = $(this).data('id');

        $.ajax({
            url: '/entry/get-form',
            data: {
                id: id,
            },
        })
            .done(function (data) {
                let body = $('.modal-body');
                $(body).empty();
                $(body).append(data);

                let form = $(body).find('form');
                $(form).attr('action', '/entry/form/' + id)
            });
    });
}

function initMeasurementConverter() {
    document.getElementById('meter').addEventListener('keydown', meterToJodjorami);
    document.getElementById('jodjorami').addEventListener('keydown', jodjoramiToMeter);

    function meterToJodjorami() {
        let meter = document.getElementById('meter').value;

        let jodjoramiValue = meter * 1.17554375;

        document.getElementById('jodjorami').value = jodjoramiValue;
        document.getElementById('madirami').innerHTML = "(" + jodjoramiValue * 3 + " madirami)";
    }

    function jodjoramiToMeter() {
        let jodjorami = document.getElementById('jodjorami').value;

        document.getElementById('meter').value = jodjorami * 0.85067016859;
    }
}

function initTemperatureConverter() {
    document.getElementById('fahrenheit').addEventListener('keydown', fahrenheitToGambino);
    document.getElementById('gambino').addEventListener('keydown', gambinoToFahrenheit);

    function fahrenheitToGambino() {
        let fahrenheit = document.getElementById('fahrenheit').value;

        document.getElementById('gambino').value = Math.round((fahrenheit - 32) / (178 / 169));
    }

    function gambinoToFahrenheit() {
        let gambino = document.getElementById('gambino').value;

        document.getElementById('fahrenheit').value = Math.round(gambino * (178 / 169) + 32);
    }
}
